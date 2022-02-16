<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Admin\Admin as Admin;
use App\Models\Manager\AdminManager as AdminManager;

class AdminController
{
    protected AdminManager $manager;

    public function __construct(AdminManager $manager)
    {
        if (isset($manager)) {
            $this->manager = $manager;
        }
    }

    /**
     * Find admin in database with id
     * @param int $id
     * @return Admin
     */
    public function getOne(int $id): Admin
    {
        if (!isset($id) || $id <= 0) {
            throw new \Exception('Cet utilisateur n\'existe pas');
        }

        return $this->manager->getAdminById($id);
    }

    /**
     * Find all admins in database
     * @return array
     */
    public function getAllAdmins(): array
    {
        return array(
            'admin' => $this->manager->getAllAdmins(),
            'number' => $this->manager->countUsers()
        );
    }

    /**
     * Remove admin in database with id
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        if (!isset($id) || $id <= 0) {
            throw new \Exception('Cet utilisateur n\'existe pas');
        }

        $this->manager->deleteUser($id);
    }

    /**
     * Update information about admin in database
     * @param Admin $admin
     * @return void
     */
    public function update(Admin $admin): void
    {
        if (!($admin instanceof Admin) && !isset($admin)) {
            throw new \Exception('Impossible d\'éffectuer la mise à jour');
        }

        $this->manager->updateAdmin($admin);
    }

    /**
     * Add information about admin in database
     * @param Admin $admin
     * @return void
     */
    public function create(Admin $admin): void
    {
        if (!($admin instanceof Admin) && !isset($admin)) {
            throw new \Exception('Impossible d\'ajouter cet utilisateur');
        }

        $this->manager->addAdmin($admin);
    }
}

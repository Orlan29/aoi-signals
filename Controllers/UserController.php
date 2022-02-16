<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\DatabaseConexion as DatabaseConexion;
use App\Config\Autoloader as Autoloader;
use App\Models\User\User as User;
use App\Models\Manager\UserManager as UserManager;
use App\Models\Manager\PremiumUserManager as PremiumUserManager;

// Initialize autoloader
require_once '../Config/Autoloader.php';
Autoloader::register();

// Try to connect database
$db = new DatabaseConexion();

// Initialize managers
$user_manager = new UserManager($db->connect());
$pum = new PremiumUserManager($db->connect());

class UserController
{
    /**
     * User manager
     * @var UserManager $user_manager
     */
    protected UserManager $user_manager;

    public function __construct(UserManager $user_manager)
    {
        if (isset($user_manager) && isset($pum)) {
            $this->user_manager = $user_manager;
        }
    }

    /**
     * Find user in database with id
     * @param int $id
     * @return array|User
     */
    public function getOne(int $id)
    {
        if (!isset($id) || $id <= 0) {
            throw new \Exception('Cet utilisateur n\'existe pas');
        }

        if (!$this->user_manager->isPremiumUser($id))
            return $this->user_manager->getUserById($id);
        else
            return $this->user_manager->getPremiumUser($id);
    }

    /**
     * Find all users in database
     * @return array
     */
    public function getAllUsers(): array
    {
        return array(
            'users' => $this->user_manager->getAllUsers(),
            'premium_users' => '',
            'number' => $this->user_manager->countUsers()
        );
    }

    /**
     * Remove user in database with id
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        if (!isset($id) || $id <= 0) {
            throw new \Exception('Cet utilisateur n\'existe pas');
        }

        $this->user_manager->deleteUser($id);
    }

    /**
     * Update information about user in database
     * @param User $user
     * @return void
     */
    public function update(User $user): void
    {
        if (!($user instanceof User) && !isset($user)) {
            throw new \Exception('Impossible d\'éffectuer la mise à jour');
        }

        $this->user_manager->updateUser($user);
    }

    /**
     * Add information about user in database
     * @param User $user
     * @return void
     */
    public function create(User $user): void
    {
        if (!($user instanceof User) && !isset($user)) {
            throw new \Exception('Impossible d\'ajouter cet utilisateur');
        }

        $this->user_manager->addUser($user);
    }
}

<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\Admin\Admin as Admin;
use App\Models\Manager\Manager as Manager;

class AdminManager extends Manager
{
    protected object $db;
    protected object $admin;

    public function __construct(Admin $admin, \PDO $db)
    {
        $this->user = $admin;
        $this->db = $db;
        $this->table = 'Admin';
    }

    public function getAdminById(int $id): Admin
    {
        $data = parent::getUserById($id);
        return new Admin($data);
    }

    public function getAllAdmins(): array
    {
        $query = parent::getAllUsers();
        $admins = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $admins[] = new Admin($row);
        }

        return $admins;
    }

    public function addAdmin(Admin $admin): void
    {
        if (!is_a($admin, 'Admin')) {
            return;
        }

        $sql = 'INSERT INTO Admins(
            last_name,
            first_name,
            email,
            user_password)
            VALUES(
                :last_name,
                :first_name,
                :email,
                :user_password);
        ';

        $query = $this->db->prepare($sql);

        $query->bind_param(':last_name', $admin->last_name);
        $query->bindValue(':first_name', $admin->first_name);
        $query->bindValue(':email', $admin->email);
        $query->bindValue(':user_password', $admin->user_password);

        $query->execute();
        $query->closeCursor();
    }

    public function updateAdmin(Admin $admin): void
    {
        if (!is_a($admin, 'Admin')) {
            return;
        }

        $sql = 'UPDATE Admins
            SET
                last_name = :last_name,
                first_user = :first_name,
                email = :email,
                user_password = :user_password);
        ';

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $admin->last_name);
        $query->bindValue(':first_name', $admin->first_name);
        $query->bindValue(':email', $admin->email);
        $query->bindValue(':user_password', $admin->user_password);

        $query->execute();
        $query->closeCursor();
    }
}

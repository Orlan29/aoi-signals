<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\Admin\Admin as Admin;
use App\Models\Manager\Manager as Manager;

class AdminManager extends Manager
{
    protected \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
        $this->table = 'Admins';
    }

    /**
     * @param int $id
     * @return Admin
     */
    public function getAdminById(int $id): Admin
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->table}.id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return new Admin($data);
    }

    /**
     * @param string $path
     * @param string $email
     * @return void
     */
    public function upload_image(string $path, string $email): void
    {
        $sql = "UPDATE {$this->table} SET profile_image = :image_path WHERE email = :email";

        $query = $this->db->prepare($sql);
        $query->bindValue(':email', $email);
        $query->bindValue(':image_path', $path);
        $query->execute();
    }

    /**
     * @return array
     */
    public function getAllAdmins(): array
    {
        $sql = "SELECT * FROM {$this->table}";

        $query = $this->db->query($sql);

        $admins = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $admins[] = new Admin($row);
        }

        return $admins;
    }

    /**
     * @param Admin $admin
     * @return void
     */
    public function addAdmin(Admin $admin): void
    {
        $sql = "INSERT INTO {$this->table}(
            last_name,
            first_name,
            profile_image,
            email,
            user_password)
            VALUES(
                :last_name,
                :first_name,
                :path_name,
                :email,
                :user_password)";

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $admin->getLast_name());
        $query->bindValue(':first_name', $admin->getFirst_name());
        $query->bindValue(':path_name', $admin->getProfile_image());
        $query->bindValue(':email', $admin->getEmail());
        $query->bindValue(':user_password', $admin->getUser_password());

        $query->execute();
        $query->closeCursor();
    }

    /**
     * @param Admin $admin
     * @return void
     */
    public function updateAdmin(Admin $admin): void
    {
        $sql = 'UPDATE Admins
            SET
                last_name = :last_name,
                first_user = :first_name,
                email = :email,
                profile_image = :path_name,
                user_password = :user_password);
        ';

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $admin->getLast_name());
        $query->bindValue(':first_name', $admin->getFirst_name());
        $query->bindValue(':email', $admin->getEmail());
        $query->bindValue(':path_name', $admin->getProfile_image());
        $query->bindValue(':user_password', $admin->getUser_password());

        $query->execute();
        $query->closeCursor();
    }
}

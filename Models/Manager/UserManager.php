<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\User\User as User;
use App\Models\Manager\PremiumUserManager as PremiumUserManager;

class UserManager extends PremiumUserManager
{
    /**
     * Database connexion
     * @var \PDO $db
     */
    protected \PDO $db;

    /**
     * @var string $user_table
     */
    protected string $user_table;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
        $this->user_table = 'Users';
        parent::__construct($db);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        $sql = "SELECT * FROM $this->user_table WHERE $this->user_table.id = :id";

        $query = $this->db_connect->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return new User($data);
    }

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM $this->user_table";

        $query = $this->db->query($sql);
        $query->execute();

        $users = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = new User($row);
        }

        return $users;
    }

    /**
     * @param User $user
     * @return void
     */
    public function addUser(User $user): void
    {
        $sql = 'INSERT INTO Users(
            last_name,
            first_name,
            email,
            registered_date,
            godfather_id,
            godson_id,
            user_password)
            VALUES(
                :last_name,
                :first_name,
                :email,
                NOW(),
                :godfather_id,
                :godson_id,
                :user_password);';

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $user->last_name);
        $query->bindValue(':first_name', $user->first_name);
        $query->bindValue(':email', $user->email);
        $query->bindValue(':godfather_id', $user->godfather_id);
        $query->bindValue(':godson_id', $user->godson_id);
        $query->bindValue(':user_password', $user->user_password);

        $query->execute();
    }

    /**
     * @param User $user
     * @return void
     */
    public function updateUser(User $user): void
    {

        $sql = 'UPDATE Users
            SET
                last_name = :last_name,
                first_user = :first_name,
                email = :email,
                godfather = :godfather_id,
                godson = :godson_id,
                user_password = :user_password);';

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $user->last_name);
        $query->bindValue(':first_name', $user->first_name);
        $query->bindValue(':email', $user->email);
        $query->bindValue(':godfather_id', $user->godfather_id);
        $query->bindValue(':godson_id', $user->godson_id);
        $query->bindValue(':user_password', $user->user_password);

        $query->execute();
    }
}

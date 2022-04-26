<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\User\User as User;
use App\Models\Manager\PremiumUserManager as PremiumUserManager;

class UserManager extends PremiumUserManager
{
    /**
     * @var string $table
     */
    protected string $table;

    public function __construct(\PDO $db)
    {
        parent::__construct($db);
        $this->table = 'Users';
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->table}.id = :id";

        $query = $this->db->prepare($sql);
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
        $sql = "SELECT * FROM {$this->table}";

        $query = $this->db->query($sql);

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
        $sql = "INSERT INTO {$this->table}(
            last_name,
            first_name,
            email,
            registered_date,
            user_password,
            phone,
            city,
            country,
            birthday,
            user_ref)
            VALUES(
                :last_name,
                :first_name,
                :email,
                NOW(),
                :user_password,
                :phone,
                :city,
                :country,
                :birthday,
                :user_ref)";

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $user->getLast_name());
        $query->bindValue(':first_name', $user->getFirst_name());
        $query->bindValue(':email', $user->getEmail());
        //$query->bindValue(':godfather_id', $user->getGodfather_id());
        //$query->bindValue(':godson_id', $user->getGodson_id());
        $query->bindValue(':user_password', $user->getUser_password());
        $query->bindValue(':phone', $user->getPhone());
        $query->bindValue(':city', $user->getCity());
        $query->bindValue(':country', $user->getCountry());
        $query->bindValue(':user_ref', $user->getUser_ref());
        $query->bindValue(':birthday', $user->getBirthday());

        $query->execute();
    }

    /**
     * @param User $user
     * @return void
     */
    public function updateUser(User $user): void
    {
        $sql = "UPDATE {$this->table}
            SET
                last_name = :last_name,
                first_name = :first_name,
                email = :email,
                user_password = :user_password";

        $query = $this->db->prepare($sql);

        $query->bindValue(':last_name', $user->getLast_name());
        $query->bindValue(':first_name', $user->getFirst_name());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':user_password', $user->getUser_password());

        $query->execute();
    }
}

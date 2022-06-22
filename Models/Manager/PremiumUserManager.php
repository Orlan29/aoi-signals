<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\Manager\Manager as Manager;
use App\Models\User\PremiumUser as PremiumUser;

class PremiumUserManager extends Manager
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db);
        $this->table = 'PremiumUser';
    }

    /**
     * @param int $id
     * @return PremiumUser
     */
    public function getPremiumUser(int $id): PremiumUser
    {
        $sql = "SELECT * FROM {$this->table} WHERE $this->table.id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);
        return new PremiumUser($data);
    }

    /**
     * @return array
     */
    public function getAllPremiumUsers(): array
    {
        $sql = "SELECT * FROM $this->table";

        $query = $this->db->query($sql);
        $query->execute();

        $premium_user = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $premium_user[] = new PremiumUser($row);
        }

        return $premium_user;
    }

    /**
     * @param PremiumUser $user
     * @return void
     */
    public function addPremiumUser(PremiumUser $user): void
    {
        if ($user instanceof PremiumUser) {
            return;
        }

        $sql = 'INSERT INTO PremiumUsers(
            user_id,
            subscription_start,
            subscription_end)
            VALUES(
                :user_id,
                NOW(),
                :subscription_end
            );';

        $query = $this->db->prepare($sql);

        $query->bindValue(':user_id', $user->getUser_id());
        $query->bindValue(':subscription_end', $user->getSubscriptionEnd());

        $query->execute();
    }

    /**
     * Return true if user is a premium user
     * or false if not.
     * 
     * @param int $id
     * @return bool
     */
    public function isPremiumUser(int $id): bool
    {
        $sql = "SELECT * FROM PremiumUser
        WHERE PremiumUser.user_id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $n = (int)$query->fetchColumn();

        if (!isset($n) && $n == 0) {
            return false;
        }

        return true;
    }

    /**
     * @param User $user
     * @return void
     */
    public function updatePremiumUser(PremiumUser $user): void
    {
        if (!is_a($user, 'User')) {
            return;
        }

        $sql = 'UPDATE PremiumUsers
            SET
                user_id = :user_id,
                subscription_start = NOW(),
                subscription_end = :sub_end;
        ';

        $query = $this->db->prepare($sql);

        $query->bindValue(':sub_end', $user->getSubscriptionEnd());
        $query->bindValue(':user_id', $user->getUser_id());
        $query->execute();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteUser(int $id): void
    {
        $sql = "DELETE FROM $this->table WHERE $this->table.id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        $query->closeCursor();
    }
}

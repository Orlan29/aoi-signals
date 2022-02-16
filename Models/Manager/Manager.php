<?php

declare(strict_types=1);

namespace App\Models\Manager;

abstract class Manager
{
    protected \PDO $db;
    protected string $table;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
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

    /**
     * Count all users in database and return it
     * @return int
     */
    public function countUsers(): int
    {
        $sql = "SELECT COUNT(*) FROM $this->table";
        $query = $this->db->query($sql);

        $n = (int)$query->fetchColumn();
        $query->closeCursor();

        return $n;
    }
}

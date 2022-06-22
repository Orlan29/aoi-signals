<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\Manager\Manager as Manager;
use App\Models\receipt as Receipt;

class ReceiptManager extends Manager
{

    /**
     * @var string $table
     */
    protected string $table;

    public function __construct(\PDO $db)
    {
        parent::__construct($db);
        $this->table = 'Payment';
    }

    /**
     * @param int $event_id
     * @return EvReceiptent
     */
    public function getOneReceipt(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->table}.id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return new Receipt($data);
    }

    /**
     * @return array
     */
    public function getAllEvents(): array
    {
        $sql = "SELECT * FROM {$this->table}";

        $query = $this->db->query($sql);

        $receipts = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $receipts[] = new Receipt($row);
        }

        return $receipts;
    }

    /**
     * @param Receipt $receipt
     * @return void
     */
    public function addEvent(Receipt $r): void
    {
        $sql = "INSERT INTO {$this->table}(
            user_id,
            amount,
            payment_date)
            VALUES(
                :id,
                :amount,
                NOW())";

        $query = $this->db->prepare($sql);

        $query->bindValue(':id', $r->getUser_id());
        $query->bindValue(':amount', $r->getAmount());

        $query->execute();
    }

    /**
     * @param Receipt $receipt
     * @return void
     */
    public function updateEvent(Receipt $r): void
    {
        $sql = "UPDATE {$this->table}
            SET
                user_id = :id,
                amount = :amount,
                payment_date = NOW(),
            WHERE id = :id";

        $query = $this->db->prepare($sql);

        $query->bindValue(':publisher', $r->getUser_id());
        $query->bindValue(':content', $r->getAmount());
        $query->bindValue(':id', $r->getId());

        $query->execute();
    }
}

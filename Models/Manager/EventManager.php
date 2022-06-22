<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\Manager\Manager as Manager;
use App\Models\Event as Event;
use App\Models\Admin\Admin as Admin;

class EventManager extends Manager
{

    /**
     * @var string $table
     */
    protected string $table;

    public function __construct(\PDO $db)
    {
        parent::__construct($db);
        $this->table = 'Events';
    }

    /**
     * @param int $event_id
     * @return Event
     */
    public function getOneEvent(int $event_id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->table}.id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $event_id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return new Event($data);
    }

    /**
     * @return array
     */
    public function getAllEvents()
    {
        $sql = "SELECT Events.id AS event_id, title, content, CONCAT(Admins.last_name, ' ', Admins.first_name) AS publisher, published_at, start_date, end_date, Admins.last_name, Admins.first_name, profile_image, email
        FROM {$this->table}
        LEFT JOIN Admins
        ON Admins.id = Events.publisher ORDER BY published_at DESC";

        $query = $this->db->query($sql);

        $events = [];
        $admins = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $events[] = new Event($row);
            $admins[] = new Admin($row);
        }

        return array(
            'events' => $events,
            'publishers' => $admins
        );
    }

    /**
     * @param Event $event
     * @return void
     */
    public function addEvent(Event $event): void
    {
        $sql = 'INSERT INTO Events(
            publisher,
            title,
            content,
            published_at,
            start_date,
            end_date)
            VALUES(
                (SELECT id FROM Admins
                WHERE CONCAT(Admins.first_name," ", Admins.last_name) = :publisher),
                :title,
                :content,
                NOW(),
                :start_date,
                :end_date)';

        $query = $this->db->prepare($sql);

        $query->bindValue(':publisher', $event->getPublisher());
        $query->bindValue(':title', $event->getTitle());
        $query->bindValue(':content', $event->getContent());
        $query->bindValue(':start_date', $event->getStart_date());
        $query->bindValue(':end_date', $event->getEnd_date());

        $query->execute();
    }

    /**
     * @param Event $event
     * @return void
     */
    public function updateEvent(Event $event): void
    {
        $sql = "UPDATE {$this->table}
            SET
                publisher = :publisher,
                content = :content,
                published_at = NOW(),
            WHERE id = :id";

        $query = $this->db->prepare($sql);

        $query->bindValue(':publisher', $event->getPublisher());
        $query->bindValue(':content', $event->getContent());
        $query->bindValue(':id', $event->getEvent_id());

        $query->execute();
    }
}

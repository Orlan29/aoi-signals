<?php

declare(strict_types=1);

namespace App\Models\Manager;

use App\Models\Manager\Manager as Manager;
use App\Models\EventImage as EventImage;

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
     * @return EventImage
     */
    public function getOneEventImage(int $id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->table}.id = :id";

        $query = $this->db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return new EventImage($data);
    }

    /**
     * @return array
     */
    public function getAllEventsImages(): array
    {
        $sql = "SELECT * FROM {$this->table}";

        $query = $this->db->query($sql);

        $images = [];

        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $images[] = new EventImage($row);
        }

        return $images;
    }

    /**
     * @param EventImage $event
     * @return void
     */
    public function addEventImage(EventImage $event_image): void
    {
        $sql = "INSERT INTO {$this->table}(
            event_id,
            path)
            VALUES(
                :event_id,
                :path)";

        $query = $this->db->prepare($sql);

        $query->bindValue(':event_id', $event_image->getEvent_id());
        $query->bindValue(':path', $event_image->getPath());

        $query->execute();
    }

    /**
     * @param Event $event
     * @return void
     */
    public function updateEventImage(EventImage $event_image): void
    {
        $sql = "UPDATE {$this->table}
            SET
                event_id = :id,
                path = :path,
            WHERE id = :id";

        $query = $this->db->prepare($sql);

        $query->bindValue(':publisher', $event_image->getEvent_id());
        $query->bindValue(':content', $event_image->getPath());
        $query->bindValue(':id', $event_image->getId());

        $query->execute();
    }
}

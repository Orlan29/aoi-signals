<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Event as Event;
use App\Models\Manager\EventManager as EventManager;

class EventController
{
    /**
     * @var EventManager $event_manager
     */
    protected EventManager $event_manager;

    public function __construct(EventManager $event_manager)
    {
        if (isset($event_manager)) {
            $this->event_manager = $event_manager;
        }
    }

    /**
     * Find event in database with id
     * @param int $id
     * @return array|Event
     */
    public function getOne(int $id)
    {
        return $this->event_manager->getOneEvent($id);
    }

    /**
     * Find all events in database
     * @return array
     */
    public function getAllevents(): array
    {
        return array(
            'events' => $this->event_manager->getAllEvents()['events'],
            'publishers' => $this->event_manager->getAllEvents()['publishers'],
            'number' => $this->event_manager->countUsers()
        );
    }

    /**
     * Remove event in database with id
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        if (!isset($id) || $id <= 0) {
            throw new \Exception('Cet utilisateur n\'existe pas');
        }

        $this->event_manager->deleteUser($id);
    }

    /**
     * Update information about event in database
     * @param event $event
     * @return void
     */
    public function update(Event $event): void
    {
        if (!($event instanceof Event) && !isset($event)) {
            throw new \Exception('Impossible d\'éffectuer la mise à jour');
        }

        $this->event_manager->updateEvent($event);
    }

    /**
     * Add information about event in database
     * @param Event $event
     * @return void
     */
    public function create(Event $event): void
    {
        if (!($event instanceof Event) && !isset($event)) {
            throw new \Exception('Impossible d\'ajouter cet utilisateur');
        }

        $this->event_manager->addEvent($event);
    }
}

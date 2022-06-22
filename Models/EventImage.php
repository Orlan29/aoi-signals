<?php

declare(strict_types=1);

namespace App\Models;

class EventImage
{
    /**
     * @var int $id
     */
    protected int $id;

    /**
     * @var int $publisher
     */
    protected int $event_id;

    /**
     * @var string $path
     */
    protected string $path;


    public function __construct(array $receipt)
    {
        $this->hydrate($receipt);
    }

    /**
     * This method is called when the class is instantiated
     * and assign value for each setter methods
     * 
     * @param array $img
     * @return void
     */
    private function hydrate(array $img): void
    {
        foreach ($img as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method) && !empty($value)) {
                $this->$method($value);
            }
        }
    }

    // GETTERS

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getEvent_id(): int
    {
        return $this->event_id;
    }

    /**
     * @return int
     */
    public function getPath(): string
    {
        return $this->path;
    }

    // SETTERS

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        if (is_int($id) && $id > 0) {
            $this->id = $id;
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function setEvent_id(int $id): void
    {
        if (is_int($id) && $id > 0) {
            $this->event_id = $id;
        }
    }

    /**
     * @param string $path
     * @return void
     */
    public function setPath(string $path): void
    {
        if (is_string($path) && isset($path)) {
            $this->path = $path;
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Models;

class Event
{
    /**
     * @var int $event_id
     */
    protected int $event_id;

    /**
     * Contain the publisher name or id
     * @var string $publisher
     */
    protected string $publisher;

    /**
     * @var string $start_time
     */
    protected  string $start_time;

    /**
     * @var string $end_time
     */
    protected string $end_time;

    /**
     * @var string $start_date
     */
    protected string $start_date;

    /**
     * @var string $end_date
     */
    protected string $end_date;

    /**
     * Contain event title
     * @var string $title
     */
    protected string $title;

    /**
     * Contain event text
     * @var string $content
     */
    protected string $content;

    /**
     * @var string $published_at
     */
    protected string $published_at;


    public function __construct(array $event)
    {
        $this->hydrate($event);
    }

    /**
     * This method is called when the class is instantiated
     * and assign value for each setter methods
     * @param array $e
     * @return void
     */
    private function hydrate(array $e): void
    {
        foreach ($e as $key => $value) {
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
    public function getEvent_id(): int
    {
        return $this->event_id;
    }

    /**
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @return string $start_time
     */
    public function getStart_time(): string
    {
        return $this->start_time;
    }

    /**
     * @return string $end_time
     */
    public function getEnd_time(): string
    {
        return $this->end_time;
    }

    /**
     * @return string $title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getStart_date(): string
    {
        return $this->start_date;
    }

    /**
     * @return string
     */
    public function getEnd_date(): string
    {
        return $this->end_date;
    }

    /**
     * @return string
     */
    public function getPublished_at(): string
    {
        return $this->published_at;
    }

    // SETTERS

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
     * @param string $text
     * @return void
     */
    public function setContent(string $text): void
    {
        if (is_string($text) && isset($text)) {
            $this->content = $text;
        }
    }

    /**
     * @param string $text
     * @return void
     */
    public function setTitle(string $text): void
    {
        if (is_string($text) && isset($text)) {
            $this->title = $text;
        }
    }

    /**
     * @param string $time
     * @return void
     */
    private function setStart_time(string $time): void
    {
        if (is_string($time) && isset($time)) {
            $this->start_time = $time;
        }
    }

    /**
     * @param string $time
     * @return void
     */
    private function setEnd_time(string $time): void
    {
        if (is_string($time) && isset($time)) {
            $this->end_time = $time;
        }
    }

    /**
     * @param string $date
     * @return void
     */
    public function setPublished_at(string $date): void
    {
        if (is_string($date) && isset($date)) {
            $this->published_at = $date;
        }
    }

    /**
     * @param string $id
     * @return void
     */
    public function setPublisher($name): void
    {
        if (isset($name)) {
            $this->publisher = $name;
        }
    }

    /**
     * @param string $date
     * @return void
     */
    private function setStart_date(string $date): void
    {
        if (isset($date) && isset($this->start_time)) {
            $date = new \DateTime("{$date} {$this->getStart_time()}");
            $this->start_date = $date->format('Y-m-d H:i:s');
        } else
            $this->start_date = $date;
    }

    /**
     * @param string $date
     * @return void
     */
    private function setEnd_date(string $date): void
    {
        if (isset($date) && isset($this->end_time)) {
            $date = new \DateTime("{$date} {$this->getEnd_time()}");
            $this->end_date = $date->format('Y-m-d H:i:s');
        } else
            $this->end_date = $date;
    }
}

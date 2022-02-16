<?php

declare(strict_types=1);

namespace App\Models\User;

use App\Models\Person;



class User extends Person
{
    protected string $registered_date;
    protected  int $godfather_id;
    protected int $godson_id;

    public function __construct(array $user)
    {
        $this->hydrate($user);
    }

    // GETTERS

    /**
     * @return string
     */

    public function getRegistered_date(): string
    {
        $date = new \DateTime($this->registered_date);
        return $date->format('d-m-Y H:i:s');
    }

    /**
     * @return int
     */

    public function getGodfather_id(): int
    {
        return $this->godfather_id;
    }

    /**
     * @return int
     */

    public function getGodson_id(): int
    {
        return $this->godson_id;
    }

    // SETTERS

    /**
     * @param int $id
     * @return void
     */

    public function setGodson_id(int $id): void
    {
        if (!isset($id) and $id < 0) {
            return;
        }

        $this->godson_id = $id;
    }

    /**
     * @param int $id
     * @return void
     */

    public function setGodfather_id(int $id): void
    {
        if (!isset($id) and $id < 0) {
            return;
        }

        $this->godfather_id = $id;
    }

    /**
     * @param string $date
     * @return void
     */

    public function setRegistered_date(string $date): void
    {
        if (!isset($date)) {
            return;
        }

        $this->registered_date = $date;
    }
}

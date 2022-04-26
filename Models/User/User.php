<?php

declare(strict_types=1);

namespace App\Models\User;

use App\Models\Person;


class User extends Person
{
    /**
     * @var string $registered_date
     */
    protected string $registered_date;

    /**
     * @var string $user_ref
     */
    protected string $user_ref;

    /**
     * @var int $godfather_id
     */
    protected  int $godfather_id;

    /**
     * @var int $godson_id
     */
    protected int $godson_id;

    /**
     * @var string $phone
     */
    protected string $phone;

    /**
     * @var string $city
     */
    protected string $city;

    /**
     * @var string $birthday
     */
    protected string $birthday;

    /**
     * @var string $country
     */
    protected string $country;

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
     * @return string
     */
    public function getUser_ref(): string
    {
        return $this->user_ref;
    }

    /**
     * @return int
     */
    public function getGodfather_id(): int
    {
        return $this->godfather_id;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
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
     * @param string $city
     * @return void
     */
    public function setBirthday(string $date): void
    {
        if (!isset($date)) {
            return;
        }

        $this->birthday = $date;
    }

    /**
     * @var int $phone
     * @return void
     */
    public function setPhone(string $phone): void
    {
        if (!isset($phone)) {
            return;
        }

        $this->phone = $phone;
    }

    /**
     * @param string $city
     * @return void
     */
    public function setCity(string $city): void
    {
        if (!isset($city)) {
            return;
        }

        $this->city = $city;
    }

    /**
     * @param string $country
     * @return void
     */
    public function setCountry(string $country): void
    {
        if (!isset($country)) {
            return;
        }

        $this->country = $country;
    }

    /**
     * @param string $ref
     * @return void
     */
    public function setUser_ref(string $ref): void
    {
        if (!isset($ref)) {
            return;
        }

        $this->user_ref = $ref;
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

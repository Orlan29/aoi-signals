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
     * @var string $is_premium
     */
    protected string $is_premium;

    /**
     * Date premium subscription
     * @var string subscription_start
     */
    private string $subscription_start;

    /**
     * Date of premium subscription
     * @var string subscription_end
     */
    private string $subscription_end;

    /**
     * @var string $user_ref
     */
    protected ?string $user_ref = null;

    /**
     * @var int|null $godfather_id
     */
    protected  ?int $godfather_id = null;

    /**
     * @var int|null $godson_id
     */
    protected ?int $godson_id = null;

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

    public function __sleep(): array
    {
        return array(
            'user_ref',
            'birthday',
            'country',
            'phone',
            'last_name',
            'email',
            'first_name',
            'city',
            'profile_image',
            'id',
            'user_password',
            'registered_date',
            'is_premium'
        );
    }

    public function jsonSerialize(): mixed
    {
        return array(
            'ref' => $this->user_ref,
            'name' => "{$this->first_name} {$this->last_name}",
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'country' => $this->country,
            'birthday' => $this->birthday,
            'registered_date' => $this->registered_date,
            'profile_image' => $this->profile_image,
            'id' => $this->id
        );
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
     * @return string|null
     */
    public function getUser_ref()
    {
        return $this->user_ref;
    }

    /**
     * @return string|null
     */
    public function getIs_premium()
    {
        return $this->is_premium;
    }

    /**
     * @return int|null
     */
    public function getGodfather_id()
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
     * @return int|null
     */
    public function getGodson_id()
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
     * @param string $date
     * @return void
     */
    private function setSubscription_start(string $date)
    {
        return $this->subscription_start;
    }

    /**
     * @param string $date
     * @return void
     */
    private function setSubscription_end(string $date)
    {
        return $this->subscription_end;
    }

    public function setIs_premium()
    {
        if (
            isset($this->subscription_start)
            && isset($this->subscription_end)
        ) {
            $start_date = new \DateTime('now');
            $end_date = new \DateTime($this->subscription_end);

            if ($end_date > $start_date) {
                return true;
            }
        }

        return false;
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

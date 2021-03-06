<?php

declare(strict_types=1);

namespace App\Models;

abstract class Person
{
    protected string $last_name;
    protected string $first_name;
    protected string $user_password;
    protected string $email;
    protected int $id;
    protected bool $is_user = true;

    /**
     * This method is called when the class is instantiated
     * and assign value for each setter methods
     * 
     * @return void
     */

    protected function hydrate(array $user): void
    {
        foreach ($user as $key => $value) {
            if (is_string($key)) {
                $method = 'set' . ucfirst($key);

                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
            }
        }
    }

    // GETTERS

    /**
     * @return bool
     */

    public function getRole(): bool
    {
        return $this->is_user;
    }

    /**
     * @return string
     */

    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return string
     */

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */

    public function getUser_password(): string
    {
        return $this->user_password;
    }

    // SETERS

    /**
     * @param string $password
     * @return void
     */
    public function setUser_password(string $password): void
    {
        if (!isset($password)) {
            trigger_error('Mot de passe non définit', E_USER_ERROR);
        }

        $this->user_password = $password;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        if (!isset($email)) {
            trigger_error('E-mail non définit', E_USER_ERROR);
        }

        $this->email = $email;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setFirstName(string $name): void
    {
        if (!isset($name)) {
            trigger_error('Le nom n\'est pas définit', E_USER_ERROR);
        }

        $this->first_name = $name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setLastName(string $name): void
    {
        if (!isset($name)) {
            trigger_error('Le prénoms n\'est pas définit', E_USER_ERROR);
        }

        $this->last_name = $name;
    }

    /**
     * @param int $id
     * @return void
     */
    protected function setId(int $id): void
    {
        if (!is_int($id) || $id <= 0) {
            return;
        }

        $this->id = $id;
    }
}

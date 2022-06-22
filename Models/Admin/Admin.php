<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Models\Person;

class Admin extends Person
{
    protected bool $is_user = false;

    public function __construct(array $user)
    {
        $this->hydrate($user);
    }

    public function jsonSerialize(): mixed
    {
        return array(
            'name' => "{$this->first_name} {$this->last_name}",
            'email' => $this->email,
            'profile_image' => $this->profile_image,
            'id' => $this->id
        );
    }
}

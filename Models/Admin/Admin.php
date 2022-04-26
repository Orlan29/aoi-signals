<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Models\Person;

class Admin extends Person
{
    protected int $admin_grant;
    protected bool $is_user = false;

    public function __construct(array $user)
    {
        $this->hydrate($user);
    }

    // GETTER

    /**
     * @return int
     */

    public function getAdmin_grant(): int
    {
        return $this->admin_grant;
    }

    // SETTER

    /**
     * @param int $grant
     * @return void
     */

    public function setAdmin_grant(int $grant): void
    {
        if (!isset($grant) && $grant <= 0) {
            return;
        }

        $this->admin_grant = $grant;
    }
}

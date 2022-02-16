<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Models\Person;
use App\Config\Autoloader as Autoloader;

/**
 * Contain root path
 *@var string $ROOT
 */
$ROOT = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR;

require_once $ROOT . 'Config/Autoloader.php';

Autoloader::register();

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

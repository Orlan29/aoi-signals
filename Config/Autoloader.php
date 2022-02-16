<?php

declare(strict_types=1);

namespace App\Config;

class Autoloader
{
    /**
     * Load class automatically after initialization
     * @return void
     */
    public static function register(): void
    {
        spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);
    }

    /**
     * Transform class path and load it
     * @param string $class
     * @return void
     */
    private static function autoload(string $class): void
    {   // Delete App\ in the namespace
        $class = str_replace('App\\', '', $class);

        // Replace antislash by slash
        $file = str_replace('\\', '/', $class);
        $file = dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . $file . '.php';

        // If file exist we load it
        if (file_exists($file)) {
            require_once $file;
        }
    }
}

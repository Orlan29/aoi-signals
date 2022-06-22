<?php

declare(strict_types=1);

namespace App\Config;

class View
{
    /**
     * @param string $templatePath
     * @param ?string $title
     * @param ?mixed $parameters
     */
    public static function render(string $templatePath, string $title = 'Aoi-Signals', mixed $parameters = null)
    {
        $templatePath = $templatePath . '.php';

        $sess = $parameters;
        $user = null;

        if (file_exists($templatePath)) {
            if (!strstr($templatePath, 'login') && !strstr($templatePath, 'register') && !strstr($templatePath, 'error')) {
                self::send_http_response(null, $code = 200);

                // les paramètres seront utilisés lors de l'appel de la fonction
                $title;

                if (
                    is_array($parameters)
                    && array_key_exists('session', $parameters)
                    && array_key_exists('user', $parameters)
                ) {
                    $sess = $parameters['session'];
                    $user = $parameters['user'];
                }

                ob_start();
                require $templatePath;
                $content =  ob_get_clean();

                require './Views/templates/template.php';
            } else {
                self::send_http_response(null, $code = 200);
                $parameters;
                require $templatePath;
            }
        } else {
            self::send_http_response('Ce contenu est introuvable', $code = 404);
        }
    }

    /**
     * @param ?string $content
     * @param ?int $code
     * @return void
     */
    public static function send_http_response(string $content = null, int $code = 200)
    {
        http_response_code($code);
        header('Content-Type: text/html');

        if ($code >= 400 && $code < 500) {
            self::render(
                'Views/User/error',
                $title = 'Error - ' . $code,
                ['code' => $code, 'content' => $content]
            );
        }
    }
}

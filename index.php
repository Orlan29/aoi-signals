<?php

declare(strict_types=1);

require_once './vendor/autoload.php';

$router = new AltoRouter();

$router->map('GET', '/', function () {
    require_once __DIR__ . '/Views/Admin/login.php';
    echo 'Une';
});

$router->map('GET', '/admin', function () {
    require_once __DIR__ . '/Views/Admin/login.php';
});

$router->map('GET', '/admin/dashboard', function () {
    require_once __DIR__ . '/Views/Admin/dashboard.php';
});

$router->map('POST', '/admin/verify', function () {
    $email = htmlspecialchars($_POST['email']);
    $admin_password = htmlspecialchars($_POST['password']);

    if (empty($email) && empty($admin_password)) {
        header('Location: /admin/dashboard');
        return false;
    }

    $admin_password = hash('sha256', $admin_password);

    echo var_dump(array($email, $admin_password));
});

$match = $router->match();

if ($match != null) {
    $match['target']();
}

<?php

declare(strict_types=1);

session_start();

use App\Config\Log as Log;
use App\Models\User\User as User;
use App\Config\Autoloader as Autoloader;
use App\Models\Manager\UserManager as UserManager;
use App\Config\DatabaseConexion as DatabaseConexion;
use App\Controllers\UserController as UserController;
use App\Models\Manager\PremiumUserManager as PremiumUserManager;

require_once './vendor/autoload.php';
require_once './Config/Autoloader.php';

Autoloader::register();

// Initialize AltoRouter
$router = new AltoRouter();


// Routers

$router->setBasePath('/signals');

$router->map('GET', '/', function () {
    $_SESSION['user_status'] = 'disconected';

    require_once __DIR__ . '/Views/User/home.php';
});

// Login router
$router->map('GET', '/login', function () {
    $_SESSION['user_login'] = true;
    unset($_SESSION['user_register']);

    require_once __DIR__ . '/Views/User/login.php';

    // Delete message error
    unset($_SESSION['login_error']);
});

// Register router
$router->map('GET', '/register', function () {
    $_SESSION['user_register'] = true;
    unset($_SESSION['user_login']);

    require_once __DIR__ . '/Views/User/register.php';

    // Delete messages errors
    unset($_SESSION['register_error']);
    unset($_SESSION['ref_error']);
});

// Reset password router
$router->map('GET', '/reset-password', function () {
    /*$_SESSION['user_register'] = true;
    unset($_SESSION['user_login']);*/

    require_once __DIR__ . '/Views/User/reset-password.php';

    // Delete messages errors
    /*unset($_SESSION['register_error']);
    unset($_SESSION['ref_error']);*/
});

// Dashboard router
$router->map('GET', '/dashboard', function () {

    if (!isset($_SESSION['user_status'])) {

        header('Location: /signals/login');
        return;
    }

    if (isset($_SESSION['login_time_stamp'])) {
        if (time() - $_SESSION['login_time_stamp'] > 600) {
            $_SESSION['login_error'] = 'Temps de connexion expiré';

            header('Location: /signals/login');
            return;
        }
    }

    $db = new DatabaseConexion;

    $um = new UserManager($db->connect());

    $uc = new UserController($um);

    $uc = $uc->getOne(1);

    require_once './Views/User/dashboard.php';
});

$router->map('GET', '/settings', function () {
    if (!isset($_SESSION['user_status'])) {

        header('Location: /signals/login');
        return;
    }

    $db = new DatabaseConexion;

    $um = new UserManager($db->connect());

    $uc = new UserController($um);

    $uc = $uc->getOne(1);

    require_once __DIR__ . '/Views/User/settings.php';
    unset($_SESSION['login_error']);
    unset($_SESSION['login_validate']);
});

// Delete acount router
$router->map('GET', '/u/delete/[i:id]/', function ($id) {
    if (!isset($_SESSION['user_status'])) {

        header('Location: /signals/login');
        return;
    }

    $db = new DatabaseConexion;
    $um = new UserManager($db->connect());
    $uc = new UserController($um);

    $uc->remove((int) $id);

    require_once __DIR__ . '/Views/User/register.php';
});

// Change password router
$router->map('POST', '/u/new-password/[i:id]/', function ($id) {
    if (!isset($_SESSION['user_status'])) {

        header('Location: /signals/login');
        return;
    }

    $db = new DatabaseConexion;
    $um = new UserManager($db->connect());
    $uc = new UserController($um);

    $user = $uc->getOne((int) $id);
    $old_password = hash('sha256', htmlspecialchars($_POST['old-password']));
    $new_password = hash('sha256', htmlspecialchars($_POST['new-password']));
    $confirm_password = hash('sha256', htmlspecialchars($_POST['confirm-password']));

    if ($user->getUser_password() === $old_password) {

        if ($new_password === $confirm_password) {

            $user->setUser_password($new_password);

            $uc->update($user);

            header('Location: /signals/settings#params');
            return;
        } else {
            $_SESSION['login_error'] = 'Mot de passe de confirmation différent du nouveau';
            header('Location: /signals/settings#params');
        }
    } else {

        $_SESSION['login_error'] = 'Ancien mot de passe incorrect';
        header('Location: /signals/settings#params');
    }
});

// Change email router
$router->map('POST|GET', '/u/new-email/[i:id]/', function ($id) {
    if (!isset($_SESSION['user_status'])) {

        header('Location: /signals/login');
        return;
    }

    $db = new DatabaseConexion;
    $um = new UserManager($db->connect());
    $uc = new UserController($um);

    $user = $uc->getOne((int) $id);
    $new_email = htmlspecialchars($_POST['new-email']);

    if ($user->getEmail() !== $new_email) {
        $user->setEmail($new_email);

        $uc->update($user);

        $_SESSION['login_validate'] = 'E-mail modifié';
        header('Location: /signals/settings#params');
        return;
    }

    echo '<pre>';
    var_dump([$user->getEmail(), $_POST]);
    echo '</pre>';
});

// Logout router
$router->map('GET', '/logout', function () {
    session_destroy();

    if (!isset($SESSION)) :
        header('Location: /signals/login');
        return;
    endif;
});


$router->map('GET', '/conf/index', function () {
    require_once __DIR__ . '/Views/User/meet.php';
});

// Admin login router
$router->map('GET', '/a/login', function () {
    require_once __DIR__ . '/Views/Admin/login.php';
});

// Admin dashboard router
$router->map('GET', '/a/dashboard', function () {
    require_once __DIR__ . '/Views/Admin/dashboard.php';
    if (isset($_SESSION['user_status']) && $_SESSION['user_status'] === 'registered') {
        return;
    }
    echo "Vous n'avez pas accès à cet espace";
});

// User conexion verify router
$router->map('POST', '/u/verify', function () {

    $db = new DatabaseConexion;

    $user_login = new Log($db->connect(), $is_user = true);


    if (isset($_SESSION['user_login']) && $_SESSION['user_login'] === true) {
        $email = htmlspecialchars($_POST['email']);
        $password = hash('sha256', htmlspecialchars($_POST['password']));

        if ($user_login->isRegistered($email, $password)) {
            $_SESSION['user_status'] = 'conected';
            $_SESSION['login_time_stamp'] = time();

            header('Location: /signals/dashboard');

            // Delete message error
            unset($_SESSION['login_error']);
            return;
        }

        $_SESSION['login_error'] = "Votre identifiant ou votre mot de passe est incorrect.";

        header('Location: /signals/login');
        return;
    }

    if (isset($_SESSION['user_register']) && $_SESSION['user_register'] === true) {

        $um = new UserManager($db->connect());
        $uc = new UserController($um);

        $email = htmlspecialchars($_POST['email']);
        $phone = (int) htmlspecialchars($_POST['phone']);

        if (!$user_login->isAvailable($email, $phone)) {
            $_SESSION['user_status'] = 'registered';
            $_SESSION['login_time_stamp'] = time();

            $user_data = array(
                'firstName' => htmlspecialchars($_POST['firstName']),
                'lastName' => htmlspecialchars($_POST['lastName']),
                'email' => htmlspecialchars($_POST['email']),
                'phone' => htmlspecialchars($_POST['phone']),
                'country' => htmlspecialchars($_POST['country']),
                'city' => htmlspecialchars($_POST['city']),
                'user_password' => hash('sha256', htmlspecialchars($_POST['user_password'])),
                'user_ref' => htmlspecialchars($_POST['user_ref']),
                'birthday' => htmlspecialchars($_POST['birthday'])
            );


            $godfather_id = $user_login->isValidRef($user_data['user_ref']);

            if (isset($godfather_id)) {
                $user_data['godfather_id'] = $godfather_id;
            }

            $user = new User($user_data);

            try {
                $uc->create($user);
            } catch (\Exception $e) {
                die($e->getMessage());
            }

            header('Location: /signals/dashboard');

            // Delete message error
            unset($_SESSION['register_error']);

            return;
        }

        if ($user_login->emailVerify($email))
            $_SESSION['register_error'] = "Cette adresse e-mail est déjà utilisée";
        else
            $_SESSION['register_error'] = "Ce contact est déjà utilisé";

        header('Location: /signals/register');
        return;
    }

    if (empty($_SESSION)) header('Location: /signals/');
});

// Admin conexion verify router
$router->map('POST', '/a/verify', function () {

    $db = new DatabaseConexion;

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Crypt password
    $password = hash('sha256', $password);

    $user_login = new Log($db->connect(), $is_user = false);

    // Verify if one user with same data is registered in database
    if ($user_login->isRegistered($email, $password)) {
        $_SESSION['user_status'] = 'registered';

        header('Location: /signals/a/dashboard');

        // Delete message error
        unset($_SESSION['login_error']);
        return;
    }

    $_SESSION['login_error'] = "Email ou le mot de passe est incorrect";
    header('Location: /signals/a/log');
});

// Verify if one router match
$match = $router->match();

// Call all matches router or show 404 error
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require_once __DIR__ . '/Views/User/404.php';
}

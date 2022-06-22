<?php

declare(strict_types=1);

session_start();

use App\Config\Log as Log;
use App\Config\View as View;
use App\Models\Event as Event;
use App\Models\User\User as User;
use App\Models\Admin\Admin as Admin;
use App\Config\Autoloader as Autoloader;
use App\Models\Manager\AdminManager as AdminManager;
use App\Models\Manager\EventManager as EventManager;
use App\Models\Manager\UserManager as UserManager;
use App\Config\DatabaseConexion as DatabaseConexion;
use App\Controllers\UserController as UserController;
use App\Controllers\AdminController as AdminController;
use App\Controllers\EventController as EventController;

require_once './vendor/autoload.php';
require_once './Config/Autoloader.php';

// Call autoloader
Autoloader::register();

// Initialize AltoRouter
$router = new AltoRouter();


// ROUTERS

// Set main folder
$router->setBasePath('/signals');


// Home router
$router->map('GET', '/', function () {
    $_SESSION['user_status'] = 'disconected';

    View::render(
        'Views/User/home',
        $title = 'Accueil',
        $parameters = $_SESSION
    );
});

// Login router
$router->map('GET', '/login', function () {
    $_SESSION['user_login'] = true;

    unset($_SESSION['user_register']);

    View::render(
        'Views/User/login',
        $title = 'Connexion',
        $parameters = $_SESSION
    );

    // Delete message error
    unset($_SESSION['login_error']);
});

// Register router
$router->map('GET', '/register', function () {
    $_SESSION['user_register'] = true;
    unset($_SESSION['user_login']);

    View::render(
        'Views/User/register',
        $title = 'Inscription',
        $parameters = $_SESSION
    );

    // Delete messages errors
    unset($_SESSION['register_error']);
    unset($_SESSION['ref_error']);
});

// Reset password router
$router->map('GET', '/reset-password', function () {
    /*$_SESSION['user_register'] = true;
    unset($_SESSION['user_login']);*/

    $_SESSION['user_status'] = 'disconected';

    View::render(
        'Views/User/reset-password',
        $title = 'Mot de passe oublié',
        $parameters = $_SESSION
    );

    // Delete messages errors
    /*unset($_SESSION['register_error']);
    unset($_SESSION['ref_error']);*/
});


$router->map('POST', '/image-upload/[:action]', function ($action) {

    /*echo '<pre>';
    var_dump($action);
    echo '</pre>';*/

    $user_image = $_FILES['user-image'];

    if (file_exists('Images/' . $user_image['name'])) {
        echo 'Ce ficher exist déjà';
        return;
    }

    $db = new DatabaseConexion;

    // Rename file name
    $temp = explode(".", $user_image["name"]);
    $new_filename = 'aoi_' . round(microtime(true)) . '.' . end($temp);

    if ($action === 'user') {
        // Move file in directory
        $target_path = 'Images/Users/' . $new_filename;

        $um = new UserManager($db->connect());
        $uc = new UserController($um);

        $user = unserialize($_SESSION['current_user']);

        // Update current user informations
        $user->setProfile_image($new_filename);

        // Save image in the database
        $uc->upload_profile_image($user->getProfile_image(), $user->getEmail());

        $_SESSION['current_user'] = serialize($user);
    } else if ($action === 'admin') {
        // Move file in directory
        $target_path = 'Images/Admin/' . $new_filename;

        $am = new AdminManager($db->connect());
        $ac = new AdminController($am);

        $admin = unserialize($_SESSION['current_admin']);

        // Update current user informations
        $admin->setProfile_image($new_filename);

        // Save image in the database
        $ac->upload_profile_image($admin->getProfile_image(), $admin->getEmail());

        $_SESSION['current_admin'] = serialize($admin);
    }

    move_uploaded_file($user_image['tmp_name'], $target_path);
});

// Dashboard router
$router->map('GET', '/dashboard', function () {

    if (!isset($_SESSION['user_status'])) {

        header('Location: /signals/login');
        return;
    }

    if (isset($_SESSION['login_timestamp'])) {
        if (time() - $_SESSION['login_timestamp'] > 600) {
            $_SESSION['user_status'] = 'disconected';
            $_SESSION['login_error'] = 'Temps de connexion expiré';

            unset($_SESSION['login_timestamp']);
            unset($_SESSION['current_user']);

            header('Location: /signals/login');
            return;
        }
    }

    View::render(
        'Views/User/dashboard',
        $title = 'Dashboard',
        $parameters = [
            'session' => $_SESSION,
            'user' => unserialize($_SESSION['current_user'])
        ]
    );
});

$router->map('GET', '/settings', function () {
    if ($_SESSION['user_status'] !== 'conected') {

        header('Location: /signals/login');
        return;
    }

    View::render(
        'Views/User/settings',
        $title = 'Settings',
        $parameters = [
            'user' => unserialize($_SESSION['current_user']),
            'session' => $_SESSION
        ]
    );

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

    header('Location: /signals/register');
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

$router->map('GET', '/a/get-user/[i:id]', function ($id) {
    $db = new DatabaseConexion;
    $um = new UserManager($db->connect());
    $uc = new UserController($um);

    echo json_encode($uc->getOne((int)$id));
});

$router->map('GET', '/a/all-users', function () {
    $db = new DatabaseConexion;
    $um = new UserManager($db->connect());
    $uc = new UserController($um);

    echo json_encode($uc->getAllUsers()['users']);
});

$router->map('POST', '/u/forgot-password', function () {
    $db = new DatabaseConexion;
    $um = new UserManager($db->connect());
    $uc = new UserController($um);
    $user_login = new Log($db->connect(), $is_user = true);
    $user = Null;
    $email = Null;

    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);

        if (!empty($user_login->emailVerify($email))) {
            echo json_encode(array('email_exist' => true));

            $_SESSION['current-user'] = serialize($user_login->emailVerify($email));
            return;
        } else {
            echo json_encode(array(
                'email_exist' => false,
                'error_msg' => 'Aucun coumpte n\'existe avec cette adresse'
            ));

            return;
        }
    }

    $new_password = hash('sha256', htmlspecialchars($_POST['new_password']));
    $confirm_password = hash('sha256', htmlspecialchars($_POST['confirm_password']));
    $user = unserialize($_SESSION['current-user']);

    if ($new_password === $confirm_password) {
        $user->setUser_password($new_password);

        $uc->update($user);

        unset($_SESSION['current_user']);
        echo json_encode(array('msg' => 'Mot de passe modifié'));
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

    if (!empty($new_email)) {
        if ($user->getEmail() !== $new_email) {
            $user->setEmail($new_email);

            $uc->update($user);

            $_SESSION['login_validate'] = 'E-mail modifié';
            header('Location: /signals/settings#params');
            return;
        }
    } else header('Location: /signals/settings#params');
});

// Logout router
$router->map('GET', '/logout', function () {
    if (!isset($_SESSION)) {
        header('Location: /signals/login');
        return;
    }

    session_destroy();
    header('Location: /signals/login');
});


$router->map('GET', '/conf/index', function () {

    View::render('Views/User/meet');
});

// Admin login router
$router->map('GET', '/a/login', function () {
    $_SESSION['admin_login'] = true;
    $_SESSION['admin_register'] = false;

    View::render('Views/Admin/login');

    unset($_SESSION['login_error']);
});

// Admin register router
$router->map('GET', '/a/register', function () {
    $_SESSION['admin_register'] = true;
    $_SESSION['admin_login'] = false;

    View::render(
        'Views/Admin/register',
        $title = 'Admin Connexion',
        $parameters = $_SESSION
    );

    // Delete message error
    unset($_SESSION['login_error']);
});

// Admin logout router
$router->map('GET', '/a/logout', function () {
    session_destroy();

    header('Location: /signals/');
});

// Admin dashboard router
$router->map('GET', '/a/dashboard', function () {
    if (!isset($_SESSION['admin_status']) && $_SESSION['admin_status'] !== 'conected') {
        header('Location: /signals/');
        return;
    }

    // Database connection
    $db = new DatabaseConexion;

    // User informations
    $um = new UserManager($db->connect());
    $uc = new UserController($um);

    // Admin informations
    $am = new AdminManager($db->connect());
    $ac = new AdminController($am);
    $admin = unserialize($_SESSION['current_admin']);

    // Event informations
    $em = new EventManager($db->connect());
    $ec = new EventController($em);
    $events = $ec->getAllEvents();

    require_once __DIR__ . '/Views/Admin/dashboard.php';
});

$router->map('POST', '/a/add-event', function () {
    $start_date = new \DateTime(
        htmlspecialchars($_POST['year'] . '-'
            . htmlspecialchars($_POST['month']) . '-'
            . htmlspecialchars($_POST['day']))
    );

    $start_time = new \DateTime(
        htmlspecialchars($_POST['hour']) . ':'
            . htmlspecialchars($_POST['minute'])
    );

    $end_date = new \DateTime(
        htmlspecialchars($_POST['end-year'] . '-'
            . htmlspecialchars($_POST['end-month']) . '-'
            . htmlspecialchars($_POST['end-day']))
    );

    $end_time = new \DateTime(
        htmlspecialchars($_POST['end-hour']) . ':'
            . htmlspecialchars($_POST['end-minute'])
    );

    $event = array(
        'publisher' => htmlspecialchars($_POST['author']),
        'title' => htmlspecialchars($_POST['title']),
        'content' => htmlspecialchars($_POST['content']),
        'start_time' => $start_time->format('H:i:s'),
        'end_time' => $end_time->format('H:i:s'),
        'start_date' => $start_date->format('Y-m-d'),
        'end_date' => $end_date->format('Y-m-d'),
    );

    $db = new DatabaseConexion;
    $em = new EventManager($db->connect());
    $ec = new EventController($em);
    $e = new Event($event);

    $ec->create($e);

    header('Location: /signals/a/dashboard');
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
            $_SESSION['login_timestamp'] = time();

            $_SESSION['current_user'] = serialize($user_login->emailVerify($email));

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
            $_SESSION['login_timestamp'] = time();

            $dateOfBorn = "{$_POST['years']}-{$_POST['month']}-{$_POST['day']}";

            $user_data = array(
                'first_name' => htmlspecialchars($_POST['firstName']),
                'last_name' => htmlspecialchars($_POST['lastName']),
                'email' => htmlspecialchars($_POST['email']),
                'phone' => htmlspecialchars($_POST['phone']),
                'country' => htmlspecialchars($_POST['country']),
                'city' => htmlspecialchars($_POST['town']),
                'user_password' => hash('sha256', htmlspecialchars($_POST['password'])),
                'user_ref' => htmlspecialchars($_POST['userRef']),
                'birthday' => htmlspecialchars($dateOfBorn)
            );

            $godfather = $user_login->isValidRef($user_data['user_ref']);

            if ($godfather->getId() !== Null) {
                $user_data['godfather_id'] = $godfather->getId();
            }

            $user_ref = $user_login->ref_generator($user_data['last_name'], $user_data['birthday']);
            $user_data['user_ref'] = $user_ref;

            $user = new User($user_data);

            // Create new user
            $uc->create($user);

            // Set current date of today and add in to the registered date method 
            $today = new \DateTime('now');
            $user->setRegistered_date($today->format('Y-m-d H:i:s'));

            $_SESSION['current_user'] = serialize($user);

            header('Location: /signals/dashboard');

            unset($_SESSION['register_error']);
            // Delete message error

            return;
        } else if (!empty($user_login->emailVerify($email))) {
            $_SESSION['register_error'] = "Cette adresse e-mail est déjà utilisée";
        } else {
            $_SESSION['register_error'] = "Ce contact est déjà utilisé";
        }

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

    if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true) {

        // Verify if one user with same data is registered in database
        if ($user_login->isRegistered($email, $password)) {
            $_SESSION['current_admin'] = serialize($user_login->emailVerify($email));
            $_SESSION['admin_status'] = 'conected';

            header('Location: /signals/a/dashboard');

            // Delete message error
            unset($_SESSION['login_error']);
        } else {
            $_SESSION['login_error'] = 'Email ou mot de passe incorrect';
            header('Location: /signals/a/login');
        }
    } else if (isset($_SESSION['admin_register']) && $_SESSION['admin_register'] == true) {

        if (!$user_login->isRegistered($email, $password)) {
            $last_name = htmlspecialchars($_POST['email']);
            $first_name = htmlspecialchars($_POST['password']);

            $admin = array(
                'email' => $email,
                'user_password' => $password,
                'first_name' => $first_name,
                'last_name' => $last_name
            );

            $am = new AdminManager($db->connect());
            $ac = new AdminController($am);
            $ac->create(new Admin($admin));

            $_SESSION['admin_status'] = 'conected';
            $_SESSION['current_admin'] = serialize(new Admin($admin));

            header('Location: /signals/a/dashboard');
        }
    } else if (!empty($user_login->emailVerify($email))) {
        $_SESSION['register_error'] = "Cette adresse e-mail est déjà utilisée";
        header('Location: /signals/a/register');
    }
});

// Verify if one router match
$match = $router->match();

// Call all matches router or show 404 error
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    //header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');

    View::send_http_response('Cette page n\'existe pas !', $code = 404);
}

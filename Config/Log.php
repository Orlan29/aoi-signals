<?php

declare(strict_types=1);

namespace App\Config;

use App\models\User\User as User;
use App\models\Admin\Admin as Admin;

require_once './Models/User/User.php';
require_once './Models/Admin/Admin.php';

class Log
{
    public \PDO $db;
    protected string $table;

    public function __construct(\PDO $db, bool $is_user)
    {
        if ($db instanceof \PDO) {
            // Connect to the database
            $this->db = $db;

            // change SQL table according to user 
            $this->table = $is_user ? 'Users' : 'Admins';
        }
    }

    /**
     * Verify if user is registered in database
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function isRegistered(string $email, string $password): bool
    {
        $user = $this->emailVerify($email);
        $password_exist = $this->passwordVerify($password);

        // Return true if user is finded in database and false if not
        return (isset($user) && $password_exist) ? true : false;
    }

    /**
     * @param string $email
     * @param int $phone
     * @return bool
     */
    public function isAvailable(string $email, int $phone): bool
    {
        $user = $this->emailVerify($email);
        $phone_exist = $this->phoneVerify($phone);

        // Return true if email or phone number is finded in database and false if not
        return (isset($user) || $phone_exist) ? true : false;
    }

    /**
     * @param string $email
     * @return User|Admins|Null
     */

    public function emailVerify(string $email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";

        $query = $this->db->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);


        if ($this->table === 'Users') {
            return gettype($data) === 'array' ? new User($data) : Null;
        } else {
            return gettype($data) === 'array' ? new Admin($data) : Null;
        }
    }

    /**
     * @var string $str
     * @return array
     */
    private function extractDate(string $str)
    {
        if (empty($str)) return;

        $str = str_replace('aoi_', '', $str);

        $regex = '#^([a-z]+)([0-9]+)$#';
        $date_regex = '#(\d{4})(\d{1,2})(\d{1,2})#';

        preg_match($regex, $str, $matches, PREG_OFFSET_CAPTURE);

        // Delete false match
        array_shift($matches);

        // Get first match
        $last_name = $matches[0][0];

        // Get last match
        $birthday = $matches[1][0];

        preg_match($date_regex, $birthday, $date, PREG_OFFSET_CAPTURE);

        // Delete first match
        array_shift($date);

        $year = $date[0][0];
        $month = $date[1][0];
        $day = $date[2][0];

        return array(
            "birthday" => "{$year}-{$month}-{$day}",
            "last_name" => $last_name
        );
    }

    /**
     * @var string $name
     * @var string $date
     * @return string|void
     */
    public function ref_generator(string $name, string $date)
    {
        if (empty($name) || empty($date)) return;

        $date = str_replace('-', '', $date);

        return 'aoi_' . lcfirst($name) . $date;
    }


    /**
     * @var string $ref
     * @return User|void
     */
    public function isValidRef(string $ref)
    {
        $name_birth = $this->extractDate($ref);

        $sql = "SELECT id FROM {$this->table} WHERE last_name = :lastName AND birthday = :birthday";

        $query = $this->db->prepare($sql);
        $query->bindValue(':lastName', ucfirst($name_birth['last_name']));
        $query->bindValue(':birthday', $name_birth['birthday']);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if ((int) count($data) === 1) {
            return new User($data);
        } else {

            $_SESSION['ref_error'] = 'Numéro de référence invalide';
            header('Location: /signals/register');
        }
    }

    /**
     * @param int $phone
     * @return bool
     */
    public function phoneVerify(int $phone): bool
    {
        $sql = "SELECT * FROM {$this->table} WHERE phone = :phone";

        $query = $this->db->prepare($sql);
        $query->bindValue(':phone', $phone);
        $query->execute();

        $data = (int)$query->fetchColumn();

        return (!empty($data) && $data === 1) ? true : false;
    }

    /**
     * @param string $password
     * @return bool
     */
    private function passwordVerify(string $password): bool
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_password = :pswd";

        $query = $this->db->prepare($sql);
        $query->bindValue(':pswd', $password);
        $query->execute();

        $data = (int)$query->fetchColumn();

        return !empty($data) ? true : false;
    }
}

<?php

declare(strict_types=1);

namespace App\Config;

class Log
{
    public object $db;
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
        $email_exist = $this->emailVerify($email);
        $password_exist = $this->passwordVerify($password);

        // Return true if user is finded in database and false if not
        return ($email_exist && $password_exist) ? true : false;
    }

    /**
     * @param string $email
     * @param int $phone
     * @return bool
     */
    public function isAvailable(string $email, int $phone): bool
    {
        $email_exist = $this->emailVerify($email);
        $phone_exist = $this->phoneVerify($phone);

        // Return true if email or phone number is finded in database and false if not
        return ($email_exist || $phone_exist) ? true : false;
    }

    /**
     * @param string $email
     * @return bool
     */

    public function emailVerify(string $email): bool
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";

        $query = $this->db->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();

        $data = (int)$query->fetchColumn();

        return (!empty($data) && $data === 1) ? true : false;
    }


    /**
     * @var string $ref
     * @return int|void
     */
    public function isValidRef(string $ref)
    {
        if (empty($ref)) return;

        $regex = '#^([a-z]+)([0-9]+)$#';
        $date_regex = '#(\d{4})(\d{2})(\d{2})#';

        preg_match($regex, $ref, $matches, PREG_OFFSET_CAPTURE);

        // Delete first match
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

        $birthday = "{$year}-{$month}-{$day}";

        $sql = "SELECT * FROM {$this->table} WHERE last_name = :lastName AND birthday = :birthday";

        $query = $this->db->prepare($sql);
        $query->bindValue(':lastName', $last_name);
        $query->bindValue(':birthday', $birthday);
        $query->execute();

        $data = (int)$query->fetchColumn();

        if ($data === 1) :
            return (int) $query->fetch()['id'];
        else :
            $_SESSION['ref_error'] = 'Numéro de référence invalide';
            header('Location: /signals/register');
        endif;
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

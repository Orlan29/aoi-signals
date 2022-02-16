<?php

declare(strict_types=1);

namespace App\Config;

use App\Config\DatabaseConexion as DatabaseConexion;

class Log
{
    public object $db;
    protected string $table;

    public function __construct(DatabaseConexion $db, bool $is_user)
    {
        if ($db instanceof DatabaseConexion) {
            // Connect to the database
            $this->db = $db->connect();

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
        $email = $this->emailVerify($email);
        $password = $this->passwordVerify($password);

        // Return true if user is finded in database and false if not
        return ($email && $password) ? true : false;
    }

    /**
     * @param string $email
     * @return bool
     */

    public function emailVerify(string $email): bool
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";

        $query = $this->db->prepare($sql);
        $query->bindValue(':email', $email);
        $query->execute();

        $data = (int)$query->fetchColumn();

        return ($data && $data == 1) ? true : false;
    }

    /**
     * @param string $password
     * @return bool
     */
    private function passwordVerify(string $password): bool
    {
        $sql = "SELECT * FROM $this->table WHERE user_password = :pswd";

        $query = $this->db->prepare($sql);
        $query->bindValue(':pswd', $password);
        $query->execute();

        $data = (int)$query->fetchColumn();

        return $data ? true : false;
    }
}

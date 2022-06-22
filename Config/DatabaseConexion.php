<?php

namespace App\Config;

class DatabaseConexion
{
    /**
     * @var string HOST
     */
    private const HOST = 'localhost';

    /**
     * @var string USERNAME
     */
    private const  USERNAME = 'root';

    /**
     * @var string PASSWORD
     */
    private const PASSWORD = '';

    /**
     * @var string DB_NAME
     */
    private const DB_NAME = 'aoi_signals';

    /**
     * @var object $db
     */
    private object $db;

    public function __toString()
    {
        return $this->connect();
    }

    /**
     * Try to connect to the database and return
     * new database connexion
     * @return \PDO PDO connexion
     */
    public function connect(): \PDO
    {

        try {
            $this->db = new \PDO(
                'mysql:host=' . self::HOST . ';'
                    . 'dbname=' . self::DB_NAME
                    . ';charset=utf8',
                self::USERNAME,
                self::PASSWORD
            );

            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die("Echec de connexion à la base de donnée");
        }

        return $this->db;
    }
}

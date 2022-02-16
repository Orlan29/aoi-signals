<?php

namespace App\Config;

class DatabaseConexion
{
    private const HOST = 'localhost';
    public const  USERNAME = 'root';
    private const PASSWORD = 'brice';
    private const DB_NAME = '';
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
        if (isset($this->db) && $this->db instanceof \PDO) {
            $this->db->closeCursor();
        }

        try {
            $this->db = new \PDO(
                'mysql:host=' . self::HOST . ';'
                    . 'dbname=' . self::DB_NAME . ';'
                    . 'charset=utf8',
                self::USERNAME . ',' . self::PASSWORD
            );

            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            die('Une erreur est survenue lors de la connexion à la base de donnée ' . $e->getMessage());
        }

        return $this->db;
    }
}

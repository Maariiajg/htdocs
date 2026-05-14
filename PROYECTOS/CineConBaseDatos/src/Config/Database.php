<?php

namespace Config;

use PDO;
use PDOException;
use Helpers\Debug;

/**
 * Clase para gestionar la conexión a la base de datos (Singleton).
 */
class Database
{
    private static $instance = null;
    private $connection;

    private $host = 'localhost';
    private $db   = 'cine_db';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    private function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->connection = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            Debug::log($e->getMessage(), 'DB_CONNECTION_ERROR');
            throw new \Exception("Error al conectar con la base de datos.");
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

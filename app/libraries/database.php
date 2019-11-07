<?php

class database
{
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USERNAME;
    private $db_pass = DB_PASSWORD;
    private $pdo_options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    private static $pdo = null;
    private $error;

    private function __construct()
    {
        //echo "database instance";
        try {
            self::$pdo = new PDO($this->createDSN(), $this->db_user, $this->db_pass, $this->pdo_options);
            echo "Successful Connection...";

        } catch (PDOException $exception) {
            $this->error = $exception->getMessage();
            die($this->error);
        }
    }

    public static function getPDOInstance()
    {
        if (self::$pdo == null) {
            self::$pdo = new static();
        }

        return self::$pdo;
    }

    /*
     * set Data Source Name for pdo Connection
     */
    private function createDSN()
    {
        $dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8";
        return $dsn;
    }
}
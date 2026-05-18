<?php

class Database {
    private $host = "localhost";
    private $dbname = "formular";
    private $port = 3306;
    private $username = "root";
    private $password = "";
    protected $conn;

    public function __construct() {
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";port=" . $this->port . ";charset=utf8",
                $this->username,
                $this->password,
                $options
            );
        } catch (PDOException $e) {
            die("Chyba OOP pripojenia k databáze: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
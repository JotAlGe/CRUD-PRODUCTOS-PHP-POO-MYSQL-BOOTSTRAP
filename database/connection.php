<?php

class Connection
{
    protected $host;
    protected $user;
    protected $pass;
    protected $db;

    function __construct()
    {
        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '1234';
        $this->db = 'db_kiosc';
    }

    protected function connect()
    {
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8mb4", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            $e->getMessage();
        } finally {
            $conn = null;
        }
    }
}

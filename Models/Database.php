<?php
require_once 'config.php';

class Database
{
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $db_port;
    private $connection;

    public function __construct($db_host, $db_user, $db_pass, $db_name, $db_port)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
        $this->db_port = $db_port;
    }

    public function connect()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->db_host;port=$this->db_port;dbname=$this->db_name", $this->db_user, $this->db_pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            echo "Không thể kết nối: " . $e->getMessage() . "ở dòng" . $e->getLine() . "ở file" . $e->getFile();
            return null;
        }
    }

    public function disconnect()
    {
        $this->connection = null;
    }
}
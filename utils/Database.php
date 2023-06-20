<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'db_projects';
    private $username = 'ziaq';
    private $password = 'nolepngoding';
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die('Connection Error: ' . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

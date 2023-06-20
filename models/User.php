<?php

class User {
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllUsers() {
        $query = 'SELECT * FROM ' . $this->table;
        $result = $this->conn->query($query);

        return $result;
    }

    public function getUserById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ' . $id;
        $result = $this->conn->query($query);

        return $result;
    }

    public function createUser($name, $email) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);

        $query = "INSERT INTO " . $this->table . " (name, email) VALUES ('$name', '$email')";
        $result = $this->conn->query($query);

        if ($result) {
            return true;
        }

        return false;
    }

    public function updateUser($name, $email, $id) {
        $name = $this->conn->real_escape_string($name);
        $email = $this->conn->real_escape_string($email);
        $id = $this->conn->real_escape_string($id);
    
        $query = "UPDATE " . $this->table . " SET name='$name', email='$email' WHERE id='$id'";
        $result = $this->conn->query($query);
    
        if ($result) {
            return true;
        }
    
        return false;
    }    
}

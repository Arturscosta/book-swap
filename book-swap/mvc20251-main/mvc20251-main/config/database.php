<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $host = 'localhost';
        $dbname = 'troca_livros';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new mysqli($host, $username, $password, $dbname);
            
            if ($this->conn->connect_error) {
                throw new Exception("Falha na conexão: " . $this->conn->connect_error);
            }
            
            $this->conn->set_charset("utf8");
        } catch (Exception $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
} 
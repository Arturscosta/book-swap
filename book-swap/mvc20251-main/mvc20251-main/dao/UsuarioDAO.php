<?php
require_once 'model/Usuario.php';

class UsuarioDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create(Usuario $usuario) {
        $stmt = $this->conn->prepare("INSERT INTO usuarios (nome, email, senha, endereco, telefone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", 
            $usuario->getNome(),
            $usuario->getEmail(),
            $usuario->getSenha(),
            $usuario->getEndereco(),
            $usuario->getTelefone()
        );
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return new Usuario(
                $row['id'],
                $row['nome'],
                $row['email'],
                $row['senha'],
                $row['endereco'],
                $row['telefone']
            );
        }
        return null;
    }

    public function update(Usuario $usuario) {
        $stmt = $this->conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, endereco = ?, telefone = ? WHERE id = ?");
        $stmt->bind_param("sssssi", 
            $usuario->getNome(),
            $usuario->getEmail(),
            $usuario->getSenha(),
            $usuario->getEndereco(),
            $usuario->getTelefone(),
            $usuario->getId()
        );
        
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return new Usuario(
                $row['id'],
                $row['nome'],
                $row['email'],
                $row['senha'],
                $row['endereco'],
                $row['telefone']
            );
        }
        return null;
    }
} 
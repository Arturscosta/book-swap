<?php
require_once 'model/Troca.php';

class TrocaDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create(Troca $troca) {
        $stmt = $this->conn->prepare("INSERT INTO trocas (livro_id, usuario_proponente_id, usuario_receptor_id, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", 
            $troca->getLivroId(),
            $troca->getUsuarioProponenteId(),
            $troca->getUsuarioReceptorId(),
            $troca->getStatus()
        );
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM trocas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return new Troca(
                $row['id'],
                $row['livro_id'],
                $row['usuario_proponente_id'],
                $row['usuario_receptor_id'],
                $row['status'],
                $row['data_proposta'],
                $row['data_conclusao']
            );
        }
        return null;
    }

    public function update(Troca $troca) {
        $stmt = $this->conn->prepare("UPDATE trocas SET status = ?, data_conclusao = ? WHERE id = ?");
        $stmt->bind_param("ssi", 
            $troca->getStatus(),
            $troca->getDataConclusao(),
            $troca->getId()
        );
        
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM trocas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function listarTrocasPorUsuario($usuarioId) {
        $stmt = $this->conn->prepare("SELECT * FROM trocas WHERE usuario_proponente_id = ? OR usuario_receptor_id = ?");
        $stmt->bind_param("ii", $usuarioId, $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $trocas = array();
        while ($row = $result->fetch_assoc()) {
            $trocas[] = new Troca(
                $row['id'],
                $row['livro_id'],
                $row['usuario_proponente_id'],
                $row['usuario_receptor_id'],
                $row['status'],
                $row['data_proposta'],
                $row['data_conclusao']
            );
        }
        return $trocas;
    }

    public function listarTrocasPendentes($usuarioId) {
        $stmt = $this->conn->prepare("SELECT * FROM trocas WHERE (usuario_proponente_id = ? OR usuario_receptor_id = ?) AND status = 'pendente'");
        $stmt->bind_param("ii", $usuarioId, $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $trocas = array();
        while ($row = $result->fetch_assoc()) {
            $trocas[] = new Troca(
                $row['id'],
                $row['livro_id'],
                $row['usuario_proponente_id'],
                $row['usuario_receptor_id'],
                $row['status'],
                $row['data_proposta'],
                $row['data_conclusao']
            );
        }
        return $trocas;
    }
} 
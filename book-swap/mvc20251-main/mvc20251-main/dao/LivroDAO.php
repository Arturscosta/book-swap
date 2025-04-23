<?php
require_once 'model/Livro.php';

class LivroDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create(Livro $livro) {
        $stmt = $this->conn->prepare("INSERT INTO livros (titulo, autor, editora, ano, condicao, descricao, usuario_id, disponivel) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisisi", 
            $livro->getTitulo(),
            $livro->getAutor(),
            $livro->getEditora(),
            $livro->getAno(),
            $livro->getCondicao(),
            $livro->getDescricao(),
            $livro->getUsuarioId(),
            $livro->isDisponivel()
        );
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            return new Livro(
                $row['id'],
                $row['titulo'],
                $row['autor'],
                $row['editora'],
                $row['ano'],
                $row['condicao'],
                $row['descricao'],
                $row['usuario_id'],
                $row['disponivel']
            );
        }
        return null;
    }

    public function update(Livro $livro) {
        $stmt = $this->conn->prepare("UPDATE livros SET titulo = ?, autor = ?, editora = ?, ano = ?, condicao = ?, descricao = ?, usuario_id = ?, disponivel = ? WHERE id = ?");
        $stmt->bind_param("sssisisii", 
            $livro->getTitulo(),
            $livro->getAutor(),
            $livro->getEditora(),
            $livro->getAno(),
            $livro->getCondicao(),
            $livro->getDescricao(),
            $livro->getUsuarioId(),
            $livro->isDisponivel(),
            $livro->getId()
        );
        
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM livros WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function listarLivrosDisponiveis() {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE disponivel = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        
        $livros = array();
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro(
                $row['id'],
                $row['titulo'],
                $row['autor'],
                $row['editora'],
                $row['ano'],
                $row['condicao'],
                $row['descricao'],
                $row['usuario_id'],
                $row['disponivel']
            );
        }
        return $livros;
    }

    public function listarLivrosPorUsuario($usuarioId) {
        $stmt = $this->conn->prepare("SELECT * FROM livros WHERE usuario_id = ?");
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $livros = array();
        while ($row = $result->fetch_assoc()) {
            $livros[] = new Livro(
                $row['id'],
                $row['titulo'],
                $row['autor'],
                $row['editora'],
                $row['ano'],
                $row['condicao'],
                $row['descricao'],
                $row['usuario_id'],
                $row['disponivel']
            );
        }
        return $livros;
    }
} 
<?php
class Livro {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function salvarLivro($titulo, $autor) {
        $sql = "INSERT INTO livros (titulo, autor) VALUES (:titulo, :autor)";
        $stmt = $this->conn->prepare($sql); 
        $stmt->bindParam(':titulo', $titulo); 
        $stmt->bindParam(':autor', $autor);   
    
        $stmt->execute(); 
    }
    

    public function buscarTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM livros");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
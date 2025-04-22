<?php
class LivrosController {
    private $livroModel;

    public function __construct($livroModel) {
        $this->livroModel = $livroModel;
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'];
    
            $this->livroModel->salvarLivro($titulo, $autor);
        }
    }

    public function listar() {
        $livros = $this->livroModel->buscarTodos();
        include '../app/views/listar.php'; // Chama a view com os dados
    }
}
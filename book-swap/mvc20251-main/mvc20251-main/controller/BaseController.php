<?php

class BaseController {
    protected $db;
    protected $usuarioDAO;
    protected $livroDAO;
    protected $trocaDAO;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->usuarioDAO = new UsuarioDAO($this->db);
        $this->livroDAO = new LivroDAO($this->db);
        $this->trocaDAO = new TrocaDAO($this->db);
    }

    protected function render($view, $data = array()) {
        // Extrai as variáveis do array $data para o escopo local
        extract($data);
        
        // Inclui o template base
        require_once 'template/header.php';
        
        // Inclui a view específica
        require_once 'template/' . $view . '.php';
        
        // Inclui o rodapé
        require_once 'template/footer.php';
    }

    protected function redirect($url) {
        header("Location: " . $url);
        exit();
    }

    protected function isLoggedIn() {
        return isset($_SESSION['usuario_id']);
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/usuario/login');
        }
    }

    protected function getCurrentUserId() {
        return $_SESSION['usuario_id'] ?? null;
    }
} 
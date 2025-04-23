<?php

class UsuarioController extends BaseController {
    public function cadastro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $endereco = $_POST['endereco'] ?? '';
            $telefone = $_POST['telefone'] ?? '';

            // Validação básica
            if (empty($nome) || empty($email) || empty($senha)) {
                $this->render('usuario/cadastro', ['erro' => 'Preencha todos os campos obrigatórios']);
                return;
            }

            // Verifica se o email já está cadastrado
            if ($this->usuarioDAO->findByEmail($email)) {
                $this->render('usuario/cadastro', ['erro' => 'Este email já está cadastrado']);
                return;
            }

            // Cria o usuário
            $usuario = new Usuario(null, $nome, $email, password_hash($senha, PASSWORD_DEFAULT), $endereco, $telefone);
            $id = $this->usuarioDAO->create($usuario);

            if ($id) {
                $_SESSION['usuario_id'] = $id;
                $this->redirect('/');
            } else {
                $this->render('usuario/cadastro', ['erro' => 'Erro ao criar usuário']);
            }
        } else {
            $this->render('usuario/cadastro');
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $usuario = $this->usuarioDAO->findByEmail($email);

            if ($usuario && password_verify($senha, $usuario->getSenha())) {
                $_SESSION['usuario_id'] = $usuario->getId();
                $this->redirect('/');
            } else {
                $this->render('usuario/login', ['erro' => 'Email ou senha inválidos']);
            }
        } else {
            $this->render('usuario/login');
        }
    }

    public function logout() {
        session_destroy();
        $this->redirect('/');
    }

    public function perfil() {
        $this->requireLogin();
        
        $usuario = $this->usuarioDAO->read($this->getCurrentUserId());
        $livros = $this->livroDAO->listarLivrosPorUsuario($this->getCurrentUserId());
        $trocas = $this->trocaDAO->listarTrocasPorUsuario($this->getCurrentUserId());

        $this->render('usuario/perfil', [
            'usuario' => $usuario,
            'livros' => $livros,
            'trocas' => $trocas
        ]);
    }
} 
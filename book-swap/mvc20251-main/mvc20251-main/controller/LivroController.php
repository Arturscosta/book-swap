<?php

class LivroController extends BaseController {
    public function index() {
        $livros = $this->livroDAO->listarLivrosDisponiveis();
        $this->render('livro/index', ['livros' => $livros]);
    }

    public function cadastrar() {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $autor = $_POST['autor'] ?? '';
            $editora = $_POST['editora'] ?? '';
            $ano = $_POST['ano'] ?? '';
            $condicao = $_POST['condicao'] ?? '';
            $descricao = $_POST['descricao'] ?? '';

            // Validação básica
            if (empty($titulo) || empty($autor)) {
                $this->render('livro/cadastrar', ['erro' => 'Preencha os campos obrigatórios']);
                return;
            }

            // Cria o livro
            $livro = new Livro(
                null,
                $titulo,
                $autor,
                $editora,
                $ano,
                $condicao,
                $descricao,
                $this->getCurrentUserId(),
                true
            );

            if ($this->livroDAO->create($livro)) {
                $this->redirect('/livro/meus-livros');
            } else {
                $this->render('livro/cadastrar', ['erro' => 'Erro ao cadastrar livro']);
            }
        } else {
            $this->render('livro/cadastrar');
        }
    }

    public function meusLivros() {
        $this->requireLogin();
        
        $livros = $this->livroDAO->listarLivrosPorUsuario($this->getCurrentUserId());
        $this->render('livro/meus-livros', ['livros' => $livros]);
    }

    public function editar($id) {
        $this->requireLogin();

        $livro = $this->livroDAO->read($id);

        // Verifica se o livro existe e pertence ao usuário
        if (!$livro || $livro->getUsuarioId() != $this->getCurrentUserId()) {
            $this->redirect('/livro/meus-livros');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $autor = $_POST['autor'] ?? '';
            $editora = $_POST['editora'] ?? '';
            $ano = $_POST['ano'] ?? '';
            $condicao = $_POST['condicao'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $disponivel = isset($_POST['disponivel']) ? true : false;

            // Atualiza o livro
            $livro->setTitulo($titulo);
            $livro->setAutor($autor);
            $livro->setEditora($editora);
            $livro->setAno($ano);
            $livro->setCondicao($condicao);
            $livro->setDescricao($descricao);
            $livro->setDisponivel($disponivel);

            if ($this->livroDAO->update($livro)) {
                $this->redirect('/livro/meus-livros');
            } else {
                $this->render('livro/editar', [
                    'livro' => $livro,
                    'erro' => 'Erro ao atualizar livro'
                ]);
            }
        } else {
            $this->render('livro/editar', ['livro' => $livro]);
        }
    }

    public function excluir($id) {
        $this->requireLogin();

        $livro = $this->livroDAO->read($id);

        // Verifica se o livro existe e pertence ao usuário
        if ($livro && $livro->getUsuarioId() == $this->getCurrentUserId()) {
            $this->livroDAO->delete($id);
        }

        $this->redirect('/livro/meus-livros');
    }
} 
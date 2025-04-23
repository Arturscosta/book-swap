<?php

class TrocaController extends BaseController {
    public function index() {
        $this->requireLogin();
        
        $trocas = $this->trocaDAO->listarTrocasPorUsuario($this->getCurrentUserId());
        $this->render('troca/index', ['trocas' => $trocas]);
    }

    public function propor($livroId) {
        $this->requireLogin();

        $livro = $this->livroDAO->read($livroId);

        // Verifica se o livro existe e está disponível
        if (!$livro || !$livro->isDisponivel() || $livro->getUsuarioId() == $this->getCurrentUserId()) {
            $this->redirect('/');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Cria a proposta de troca
            $troca = new Troca(
                null,
                $livroId,
                $this->getCurrentUserId(),
                $livro->getUsuarioId(),
                'pendente'
            );

            if ($this->trocaDAO->create($troca)) {
                // Marca o livro como indisponível
                $livro->setDisponivel(false);
                $this->livroDAO->update($livro);

                $this->redirect('/troca');
            } else {
                $this->render('troca/propor', [
                    'livro' => $livro,
                    'erro' => 'Erro ao propor troca'
                ]);
            }
        } else {
            $this->render('troca/propor', ['livro' => $livro]);
        }
    }

    public function aceitar($id) {
        $this->requireLogin();

        $troca = $this->trocaDAO->read($id);

        // Verifica se a troca existe e o usuário é o receptor
        if (!$troca || $troca->getUsuarioReceptorId() != $this->getCurrentUserId()) {
            $this->redirect('/troca');
            return;
        }

        $troca->setStatus('aceita');
        if ($this->trocaDAO->update($troca)) {
            $this->redirect('/troca');
        } else {
            $this->render('troca/index', [
                'trocas' => $this->trocaDAO->listarTrocasPorUsuario($this->getCurrentUserId()),
                'erro' => 'Erro ao aceitar troca'
            ]);
        }
    }

    public function recusar($id) {
        $this->requireLogin();

        $troca = $this->trocaDAO->read($id);

        // Verifica se a troca existe e o usuário é o receptor
        if (!$troca || $troca->getUsuarioReceptorId() != $this->getCurrentUserId()) {
            $this->redirect('/troca');
            return;
        }

        $troca->setStatus('recusada');
        if ($this->trocaDAO->update($troca)) {
            // Marca o livro como disponível novamente
            $livro = $this->livroDAO->read($troca->getLivroId());
            $livro->setDisponivel(true);
            $this->livroDAO->update($livro);

            $this->redirect('/troca');
        } else {
            $this->render('troca/index', [
                'trocas' => $this->trocaDAO->listarTrocasPorUsuario($this->getCurrentUserId()),
                'erro' => 'Erro ao recusar troca'
            ]);
        }
    }

    public function concluir($id) {
        $this->requireLogin();

        $troca = $this->trocaDAO->read($id);

        // Verifica se a troca existe e o usuário está envolvido
        if (!$troca || 
            ($troca->getUsuarioProponenteId() != $this->getCurrentUserId() && 
             $troca->getUsuarioReceptorId() != $this->getCurrentUserId())) {
            $this->redirect('/troca');
            return;
        }

        $troca->setStatus('concluida');
        $troca->setDataConclusao(date('Y-m-d H:i:s'));
        
        if ($this->trocaDAO->update($troca)) {
            $this->redirect('/troca');
        } else {
            $this->render('troca/index', [
                'trocas' => $this->trocaDAO->listarTrocasPorUsuario($this->getCurrentUserId()),
                'erro' => 'Erro ao concluir troca'
            ]);
        }
    }
} 
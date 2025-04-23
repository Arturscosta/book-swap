<?php

class HomeController extends BaseController {
    public function index() {
        $livros = $this->livroDAO->listarLivrosDisponiveis();
        $this->render('home/index', ['livros' => $livros]);
    }
} 
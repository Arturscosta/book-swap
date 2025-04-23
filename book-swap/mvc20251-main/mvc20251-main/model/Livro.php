<?php

class Livro {
    private $id;
    private $titulo;
    private $autor;
    private $editora;
    private $ano;
    private $condicao;
    private $descricao;
    private $usuarioId;
    private $disponivel;

    public function __construct($id = null, $titulo = null, $autor = null, $editora = null, 
                              $ano = null, $condicao = null, $descricao = null, $usuarioId = null, 
                              $disponivel = true) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editora = $editora;
        $this->ano = $ano;
        $this->condicao = $condicao;
        $this->descricao = $descricao;
        $this->usuarioId = $usuarioId;
        $this->disponivel = $disponivel;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getEditora() {
        return $this->editora;
    }

    public function setEditora($editora) {
        $this->editora = $editora;
    }

    public function getAno() {
        return $this->ano;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function getCondicao() {
        return $this->condicao;
    }

    public function setCondicao($condicao) {
        $this->condicao = $condicao;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getUsuarioId() {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId) {
        $this->usuarioId = $usuarioId;
    }

    public function isDisponivel() {
        return $this->disponivel;
    }

    public function setDisponivel($disponivel) {
        $this->disponivel = $disponivel;
    }
} 
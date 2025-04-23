<?php

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $endereco;
    private $telefone;

    public function __construct($id = null, $nome = null, $email = null, $senha = null, $endereco = null, $telefone = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
} 
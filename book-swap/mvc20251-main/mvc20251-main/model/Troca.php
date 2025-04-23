<?php

class Troca {
    private $id;
    private $livroId;
    private $usuarioProponenteId;
    private $usuarioReceptorId;
    private $status;
    private $dataProposta;
    private $dataConclusao;

    public function __construct($id = null, $livroId = null, $usuarioProponenteId = null, 
                              $usuarioReceptorId = null, $status = 'pendente', $dataProposta = null, 
                              $dataConclusao = null) {
        $this->id = $id;
        $this->livroId = $livroId;
        $this->usuarioProponenteId = $usuarioProponenteId;
        $this->usuarioReceptorId = $usuarioReceptorId;
        $this->status = $status;
        $this->dataProposta = $dataProposta;
        $this->dataConclusao = $dataConclusao;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function getLivroId() {
        return $this->livroId;
    }

    public function setLivroId($livroId) {
        $this->livroId = $livroId;
    }

    public function getUsuarioProponenteId() {
        return $this->usuarioProponenteId;
    }

    public function setUsuarioProponenteId($usuarioProponenteId) {
        $this->usuarioProponenteId = $usuarioProponenteId;
    }

    public function getUsuarioReceptorId() {
        return $this->usuarioReceptorId;
    }

    public function setUsuarioReceptorId($usuarioReceptorId) {
        $this->usuarioReceptorId = $usuarioReceptorId;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getDataProposta() {
        return $this->dataProposta;
    }

    public function setDataProposta($dataProposta) {
        $this->dataProposta = $dataProposta;
    }

    public function getDataConclusao() {
        return $this->dataConclusao;
    }

    public function setDataConclusao($dataConclusao) {
        $this->dataConclusao = $dataConclusao;
    }
} 
<?php
require_once '../config/database.php';
require_once '../app/models/Livro.php';
require_once '../app/controllers/LivrosController.php';

$conn = Database::conectar();
$model = new Livro($conn);
$controller = new LivrosController($model);

$controller->listar();


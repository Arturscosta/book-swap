<?php
require_once 'autoload.php';

// Inicia a sessão
session_start();

// Obtém a URL da requisição
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);

// Define o controlador e a ação padrão
$controller = isset($url[0]) ? $url[0] : 'home';
$action = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Nome do arquivo do controlador
$controllerFile = 'controller/' . ucfirst($controller) . 'Controller.php';

// Verifica se o arquivo do controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Nome da classe do controlador
    $controllerClass = ucfirst($controller) . 'Controller';
    
    // Instancia o controlador
    $controllerInstance = new $controllerClass();
    
    // Verifica se o método existe
    if (method_exists($controllerInstance, $action)) {
        // Chama o método com os parâmetros
        call_user_func_array(array($controllerInstance, $action), $params);
    } else {
        // Método não encontrado
        header("HTTP/1.0 404 Not Found");
        echo "Página não encontrada";
    }
} else {
    // Controlador não encontrado
    header("HTTP/1.0 404 Not Found");
    echo "Página não encontrada";
}

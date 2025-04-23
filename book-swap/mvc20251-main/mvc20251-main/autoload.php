<?php

spl_autoload_register(function ($class) {
    $directories = array(
        'model/',
        'dao/',
        'controller/',
        'config/'
    );

    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}); 
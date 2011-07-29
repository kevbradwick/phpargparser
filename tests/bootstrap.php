<?php

define('SRC_DIR', realpath(dirname(__FILE__) . '/../src/'), true);
define('TEST_DIR', __DIR__, true);

spl_autoload_register(function($className){
    
    $parts = explode('\\', $className);
    
    if ($parts[0] === 'Wildkat') {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        $file = sprintf('%s/%s', SRC_DIR, $path);
        if (file_exists($file) === true) {
            require_once $file;
        }
    }
    
});
<?php

/**
 * ArgumentParser demo
 */


// basic autoloader to get the library working
spl_autoload_register(function($className){
    
    $parts = explode('\\', $className);
    
    if ($parts[0] === 'Wildkat') {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
        $file = sprintf('%s/%s', realpath(__DIR__ . '/../src'), $path);
        if (file_exists($file) === true) {
            require_once $file;
        }
    }
    
});

use Wildkat\ArgumentParser;

// create a new parser
$parser = new ArgumentParser(
    'PHP ArgumentParser Demo',
    'A simple demonstration on how the library can help build console apps',
    '1.0'
);

$parser->addArgument(array(
    'argument' => '--message',
    'alias'    => '-m',
    'variable' => 'message',
    'default'  => 'hello!',
    'type'     => 'string',
    'required' => true,
    'helpText' => 'A simple message argument that stores as a php string'
));

$parser->addArgument(array(
    'argument' => '--boolean-value',
    'alias'    => '-b',
    'variable' => 'boolVal',
    'default'  => false,
    'type'     => 'boolean',
    'required' => true,
    'helpText' => 'A boolean argument stored in the useDb variable'
));

// get the arguments
$arguments = $parser->parseArguments();

/**
 * The $arguments variable now contains the processed variables and can be access
 * as an array or via class properties
 */
var_dump($arguments->boolVal);
var_dump($arguments->message);
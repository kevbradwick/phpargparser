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
    'argument' => '--integer-value',
    'alias'    => '-i',
    'variable' => 'intVal',
    'default'  => 345,
    'type'     => 'integer',
    'required' => false,
    'helpText' => 'An integer argument'
));

$parser->addArgument(array(
    'argument' => '--array',
    'alias'    => '-a',
    'variable' => 'arrayVal',
    'default'  => 'foo,bar,baz',
    'type'     => 'array',
    'required' => false,
    'helpText' => 'An array argument'
));

// get the arguments
$arguments = $parser->parseArguments();

/**
 * The $arguments variable now contains the processed variables and can be access
 * as an array or via class properties;
 * 
 * $arguments->boolVal
 * $arguments['message']
 */

echo sprintf('%s => %s%s', 'message', $arguments->message, PHP_EOL);
echo sprintf('%s => %s%s', 'intVal', $arguments->intVal, PHP_EOL);
echo sprintf('%s => %s%s', 'arrayVal', gettype($arguments->arrayVal), PHP_EOL);

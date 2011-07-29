<?php

define('SRC_DIR', realpath(dirname(__FILE__) . '/../src/'), true);
define('TEST_DIR', __DIR__, true);

spl_autoload_register(function($className){
    
});
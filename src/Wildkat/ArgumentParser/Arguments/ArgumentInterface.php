<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * ArgumentInterface
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
interface ArgumentInterface
{
    /**
     * Show help text for this argument
     * 
     * @return string
     */
    public function showHelp();
    
    /**
     * Get the value of the argument in the correct data type
     * 
     * @return mixed
     */
    public function getValue();
    
    /**
     * Set the argument value
     * 
     * @param string $value the argument value
     * 
     * @return null
     */
    public function setValue($value);
    
}//end class

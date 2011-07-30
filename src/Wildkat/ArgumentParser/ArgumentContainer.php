<?php

namespace Wildkat\ArgumentParser;

use Wildkat\ArgumentParser\Arguments\AbstractArgument;

/**
 * ArgumentContainer.
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class ArgumentContainer implements \ArrayAccess
{
    /**
     * @var array
     */
    private $_arguments = array();
    
    /**
     * Class construct
     * 
     * @param array $arguments the arguments as an instance of AbstractArgument
     * 
     * @return ArgumentContainer
     */
    public function __construct($arguments=array())
    {
        foreach ($arguments as $name => $argument) {
            $this->offsetSet($name, $argument);
        }
        
    }//end __construct()
    
    /**
     * Check an argument exists
     * 
     * @param string $offset the argument name
     * 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->_arguments[$offset]);
        
    }//end offsetExists()
    
    /**
     * Get the argument
     * 
     * @param string $offset the argument name
     * 
     * @return mixed the value
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset) === true) {
            return $this->_arguments[$offset]->getValue();
        }
        
    }//end offsetGet()
    
    /**
     * Unset an argument
     * 
     * @param string $offset the argument name
     * 
     * @return null
     */
    public function offsetUnset($offset)
    {
        unset($this->_arguments[$offset]);
        
    }//end offsetUnset()
    
    /**
     * Set an argument
     * 
     * @param string           $offset the argument name
     * @param AbstractArgument $value  the argument
     * 
     * @return null
     */
    public function offsetSet($offset, $value)
    {
        if ($value instanceof AbstractArgument) {
            $this->_arguments[$offset] = $value;
        }
        
    }//end offsetSet()
    
    /**
     * Property access to argument values
     * 
     * @param string $name the argument variable name
     * 
     * @return mixed
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
        
    }//end __get()
    
}//end class
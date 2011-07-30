<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * FloatArgument
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class FloatArgument extends AbstractArgument
{
    /**
     * Get the value
     * 
     * @return array
     */
    public function getValue()
    {
        return floatval($this->value);
        
    }//end setValue()
    
}//end class

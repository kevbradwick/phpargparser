<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * IntegerArgument
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class IntegerArgument extends AbstractArgument
{
    /**
     * Get the value
     * 
     * @return array
     */
    public function getValue()
    {
        return intval($this->value);
        
    }//end setValue()
    
}//end class

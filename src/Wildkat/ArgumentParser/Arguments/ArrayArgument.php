<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * ArrayArgument
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class ArrayArgument extends AbstractArgument
{
    /**
     * Get the value
     * 
     * @return array
     */
    public function getValue()
    {
        return explode(',', $this->value);
        
    }//end setValue()
    
}//end class

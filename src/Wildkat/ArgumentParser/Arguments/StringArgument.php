<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * String Argument.
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
final class StringArgument extends AbstractArgument
{
    /**
     * Get the value of this argument
     * 
     * @return string
     */
    public function getValue()
    {
        return (string) $this->value;
        
    }//end getValue()
    
}//endClass
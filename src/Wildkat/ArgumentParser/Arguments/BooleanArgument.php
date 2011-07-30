<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * BooleanArgument
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
class BooleanArgument extends AbstractArgument
{
    /**
     * Get the value
     * 
     * @return array
     */
    public function getValue()
    {
        $falseValues = array('false', 'no', '0', 'n');
        
        return !in_array(strtolower((string) $this->value), $falseValues);
        
    }//end setValue()
    
}//end class

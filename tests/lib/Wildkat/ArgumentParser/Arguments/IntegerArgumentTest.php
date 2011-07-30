<?php

namespace Tests\Wildkat\ArgumentParser\Arguments;

use Wildkat\ArgumentParser\Arguments\IntegerArgument;

class ArrayIntegerArgumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the argument returns as an integer
     * 
     * @return null
     */
    public function testValueIsConvertedToInteger()
    {
        $arg = new IntegerArgument();
        $arg->setValue('1234');
        $this->assertEquals(1234, $arg->getValue());
    }
    
}
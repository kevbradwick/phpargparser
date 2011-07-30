<?php

namespace Tests\Wildkat\ArgumentParser\Arguments;

use Wildkat\ArgumentParser\Arguments\FloatArgument;

class FloatIntegerArgumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the argument returns as a float
     * 
     * @return null
     */
    public function testValueIsConvertedToFloat()
    {
        $arg = new FloatArgument();
        $arg->setValue('1234');
        $this->assertEquals(1234, $arg->getValue());
        $arg->setValue('12.34');
        $this->assertEquals(12.34, $arg->getValue());
    }
    
}
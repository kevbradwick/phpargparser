<?php

namespace Tests\Wildkat\ArgumentParser\Arguments;

use Wildkat\ArgumentParser\Arguments\BooleanArgument;

class BooleanIntegerArgumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the argument returns as boolean value
     * 
     * @return null
     */
    public function testValueIsConvertedToBoolean()
    {
        $arg = new BooleanArgument();
        
        // check false
        $arg->setValue('n');
        $this->assertFalse($arg->getValue());
        $arg->setValue('0');
        $this->assertFalse($arg->getValue());
        $arg->setValue('no');
        $this->assertFalse($arg->getValue());
        $arg->setValue('No');
        $this->assertFalse($arg->getValue());
        $arg->setValue('false');
        $this->assertFalse($arg->getValue());
        $arg->setValue('FalSE');
        $this->assertFalse($arg->getValue());
        
        // true values
        $arg->setValue('1');
        $this->assertTrue($arg->getValue());
        $arg->setValue('yes');
        $this->assertTrue($arg->getValue());
        $arg->setValue('true');
        $this->assertTrue($arg->getValue());
        $arg->setValue('Y');
        $this->assertTrue($arg->getValue());
    }
    
}
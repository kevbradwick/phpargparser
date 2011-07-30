<?php

namespace Tests\Wildkat\ArgumentParser\Arguments;

use Wildkat\ArgumentParser\Arguments\ArrayArgument;

class ArrayArgumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the argument returns as an array
     * 
     * @return null
     */
    public function testValueIsConvertedToArray()
    {
        $arg = new ArrayArgument();
        
        $arg->setValue('123');
        $this->assertInternalType('array', $arg->getValue());
        $this->assertEquals(array('123'), $arg->getValue());
        
        $arg->setValue('foo,bar');
        $this->assertInternalType('array', $arg->getValue());
        $this->assertEquals(array('foo','bar'), $arg->getValue());
    } 
}
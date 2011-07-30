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
    
    /**
     * @expectedException Wildkat\ArgumentParser\Arguments\ArgumentException
     */
    public function testExceptionThrownOnInvalidArgumentSpec()
    {
        $arg = new ArrayArgument('foo');
    }
    
    /**
     * Test we can set arguments using the class construct
     * 
     * @return null
     */
    public function testSettingArgumentViaConstruct()
    {
        $arg = new ArrayArgument('-f', array(
            'helpText' => 'foobar',
            'defaultValue' => 123,
        ));
        
        $this->assertEquals(array(123), $arg->getValue());
        $this->assertEquals('-f          foobar' . PHP_EOL, $arg->showHelp());
    }
}
<?php

namespace Tests\Wildkat\ArgumentParser\Arguments;

use Wildkat\ArgumentParser\Arguments\StringArgument,
    Wildkat\ArgumentParser\Arguments\ArgumentException;

/**
 * StringArgumentTest.
 * 
 * @package Tests
 * @author  Kevin Bradwick <kbradiwck@gmail.com>
 */
class StringArgumentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the argument returns as a string
     * 
     * @return null
     */
    public function testValueIsString()
    {
        $arg = new StringArgument();
        
        $arg->setValue('123');
        $this->assertInternalType('string', $arg->getValue());
        $this->assertEquals('123', $arg->getValue());
        
        $arg->setValue('123abc');
        $this->assertInternalType('string', $arg->getValue());
        $this->assertEquals('123abc', $arg->getValue());
    }
    
    /**
     * Test default value is returned
     * 
     * @return null
     */
    public function testGetDefaultValue()
    {
        $arg = new StringArgument();
        $arg->setDefaultValue('foo');
        $this->assertEquals('foo', $arg->getValue());
        
        // override value
        $arg->setValue('bar');
        $this->assertEquals('bar', $arg->getValue());
    }
    
    /**
     * Test show help text
     * 
     * @return null
     */
    public function testShowHelp()
    {
        $arg = new StringArgument();
        $arg->setArgument('-f');
        $arg->setArgument('--foo');
        $arg->setHelpText('foo bar');
        $this->assertEquals('  -f, --foo               foo bar' . PHP_EOL, $arg->showHelp());
        
        $arg = new StringArgument();
        $arg->setArgument('-f');
        $arg->setHelpText('foo bar');
        $this->assertEquals('  -f                      foo bar' . PHP_EOL, $arg->showHelp());
        
        $arg = new StringArgument();
        $arg->setArgument('--foo');
        $arg->setHelpText('foo bar');
        $this->assertEquals('  --foo                   foo bar' . PHP_EOL, $arg->showHelp());
    }
    
        
}
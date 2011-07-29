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
     * Test invalid argument types
     * 
     * @return null
     */
    public function testExceptionThrownForInvalidArgumentTypes()
    {
        // no hyphen
        try {
            $arg = new StringArgument('f');
            $this->fail('f passed as a valid argument');
        } catch (ArgumentException $e) {
            $this->assertTrue(true, 'Invalid argument caught "f"');
        }
        
        // three hyphens not allowed
        try {
            $arg = new StringArgument('---f');
            $this->fail('---f passed as a valid argument');
        } catch (ArgumentException $e) {
            $this->assertTrue(true, 'Invalid argument caught "---f"');
        }
    }
    
    /**
     * Test we can set a valid argument
     * 
     * @return null
     */
    public function testCanSetValidArgument()
    {
        $arg = new StringArgument('--foo');
        $this->assertInstanceOf('Wildkat\ArgumentParser\Arguments\AbstractArgument', $arg);
        
        $arg = new StringArgument('-f');
        $this->assertInstanceOf('Wildkat\ArgumentParser\Arguments\AbstractArgument', $arg);
    }
    
}
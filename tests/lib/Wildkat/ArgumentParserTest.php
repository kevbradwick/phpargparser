<?php

namespace Tests\Wildkat;

use Wildkat\ArgumentParser;

ArgumentParser::$unitTestEnabled = true;

/**
 * Test ArgumentParser
 * 
 * @author Kevin Bradwick <kbradwick@gmail.com>
 */
class ArgumentParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the help text is provided when any one of the required arguments
     * are not provided
     * 
     * @return null
     */
    public function testParserFailsWhenRequiredArgumentsNotSpecified()
    {
        $parser = new ArgumentParser();
    }
    
    /**
     * Test show help text
     * 
     * @return null
     */
    public function testShowHelp()
    {
        $parser = $this->mockParser();
        $help = $parser->showHelp(true);
        
        $this->assertContains('-s, --string', $help);
        $this->assertContains('A string value', $help);
        $this->assertContains('-i, --integer', $help);
    }
    
    /**
     * By default, -h and --help are available to show all the help text
     * 
     * @return null
     */
    public function testHelpIsDisplayedWhenHelpArgumentSupplied()
    {
        $parser = $this->mockParser();
        ob_start();
        $parser->parseArguments('--help');
        $help = ob_get_clean();
        $this->assertInternalType('string', $help);
        $this->assertContains('test 1.0', $help);
        $this->assertContains('-h, --help', $help);
    }
    
    /**
     * Some default arguments to test with
     * 
     * @return array
     */
    protected function mockParser()
    {
        $parser = new ArgumentParser('test', 'test app', '1.0');
        
        // string
        $parser->addArgument(
           array(
               'argument' => '--string',
               'alias'    => '-s',
               'variable' => 'stringVar',
               'default'  => '',
               'type'     => 'string',
               'required' => true,
               'helpText' => 'A string value'
           ) 
        );
        
        // integer
        $parser->addArgument(
           array(
               'argument' => '--integer',
               'alias'    => '-i',
               'variable' => 'intVar',
               'default'  => '',
               'type'     => 'integer',
               'required' => false,
               'helpText' => 'An integer value'
           ) 
        );
        
        // float
        $parser->addArgument(
           array(
               'argument' => '--float',
               'alias'    => '-f',
               'variable' => 'floatVar',
               'default'  => '',
               'type'     => 'float',
               'required' => false,
               'helpText' => 'A float value'
           ) 
        );
        
        // array
        $parser->addArgument(
           array(
               'argument' => '--array',
               'alias'    => '-a',
               'variable' => 'arrayVar',
               'default'  => '',
               'type'     => 'array',
               'required' => false,
               'helpText' => 'An array value'
           ) 
        );
        
        // boolean
        $parser->addArgument(
           array(
               'argument' => '--boolean',
               'alias'    => '-b',
               'variable' => 'boolVar',
               'default'  => '',
               'type'     => 'boolean',
               'required' => false,
               'helpText' => 'A boolean value'
           ) 
        );
        
        return $parser;
    }
}

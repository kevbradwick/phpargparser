<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * AbstractArgument.
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
abstract class AbstractArgument implements ArgumentInterface
{
    /**
     * The short argument representation
     * @var array
     */
    protected $argumentShort = '';
    
    /**
     * The long argument representation
     * @var array
     */
    protected $argumentLong = '';

    /**
     * @var string
     */
    protected $helpText = '';
    
    /**
     * The processed value
     * @var mixed
     */
    protected $value = '';
    
    /**
     * The default value
     * @var mixed
     */
    protected $default = '';
    
    /**
     * Class construct
     * 
     * @param string $argument the argument name
     * @param array  $options  the argument options
     * 
     * @return AbstractArgument
     */
    public function __construct()
    {
        
        
    }//end __construct()
    
    /**
     * Set the value
     * 
     * @param string $value the value
     * 
     * @return null
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
        
    }//end setValue()
    
    /**
     * Set the default value of this argument
     * 
     * @param mixed $value the default value of this argument
     * 
     * @return null
     */
    public function setDefaultValue($value)
    {
        $this->setValue($value);
        
    }//end setDefaultValue()

    /**
     * Set the argument flag
     * 
     * @param string $argument the argument flag
     * 
     * @return null
     * @throws ArgumentException
     */
    public function setArgument($argument)
    {
        $pattern = '/^(\-{1}[a-z]{1})$/';
        $argType = 'argumentShort';
        
        if (substr($argument, 0, 2) === '--') {
            $pattern = '/^(\-{2}[a-z]{2,}\-*[a-z]*)$/';
            $argType = 'argumentLong';
        }
        
        if (preg_match($pattern, $argument) === 0) {
            $message = sprintf('"%s" is an invalid argument type', $argument);
            throw new ArgumentException($message);
        }
        
        $this->$argType = $argument;
        
    }//end setArgument()
    
    /**
     * Set the help text
     * 
     * @param string $help the help text for this argument
     * 
     * @return string
     */
    public function setHelpText($help)
    {
        $this->helpText = $help;
        
    }//end setHelpText()

    /**
     * Show the help message for this argument
     * 
     * @return string
     */
    public function showHelp()
    {
        $help = '';
        
        if (strlen($this->argumentShort) > 0) {
            $help .= $this->argumentShort;
        }
        
        if (strlen($this->argumentLong) > 0) {
            $help .= $help === '' ? '' : ', ';
            $help .= $this->argumentLong;
        }
        
        $help .= '          ';
        $help .= $this->helpText;
        $help .= PHP_EOL;
        
        return $help;
        
    }//end showHelp()
}
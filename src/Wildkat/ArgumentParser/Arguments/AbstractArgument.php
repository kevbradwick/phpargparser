<?php

namespace Wildkat\ArgumentParser\Arguments;

/**
 * AbstractArgument.
 * 
 * @author Kevn Bradwick <kbradwick@gmail.com>
 */
abstract class AbstractArgument implements ArgumentInterface
{
    /**
     * The argument representation
     * @var array
     */
    protected $argument = array();

    /**
     * @var string
     */
    protected $helpText;
    
    /**
     * The processed value
     * @var mixed
     */
    protected $value;
    
    /**
     * The default value
     * @var mixed
     */
    protected $default;
        
    /**
     * An optional callback that handles the value
     * @var array|string|Closure
     */
    private $_callback;
    
    /**
     * Class construct
     * 
     * @param string $argument the argument name
     * @param array  $options  the argument options
     * 
     * @return AbstractArgument
     */
    public function __construct($argument, array $options=array())
    {
        $this->setArgument($argument);
        
    }//end __construct()
    
    /**
     * Set the argument flag
     * 
     * @param type $argument the argument flag
     * 
     * @return null
     * @throws ArgumentException
     */
    public function setArgument($argument)
    {
        $message = sprintf('"%s" is an invalid argument type', $argument);
        $pattern = '/^(\-{1}[a-z]{1})|(\-{2}[a-z]{2,}\-*[a-z]*)$/';
        
        if (preg_match($pattern, $argument) === 0) {
            throw new ArgumentException($message);
        }
        
        $this->argument[$argument] = array();
        
    }//end setArgument()


    /**
     * Show the help message for this argument
     * 
     * @return string
     */
    public function showHelp()
    {
        
    }//end showHelp()
}
<?php

namespace Wildkat\ArgumentParser\Arguments;

abstract class AbstractArgument implements ArgumentInterface
{
    /**
     * The argument representation
     * @var string
     */
    protected $argument;

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
     * Class construct
     * 
     * @param string $argument the argument name
     * @param array  $options  the argument options
     * 
     * @return AbstractArgument
     */
    public function __construct($argument, array $options=array())
    {
        if (substr($argument, 0, 1) === '-' || substr($argument, 0, 2) === '--') {
            
        } else {
            throw new ArgumentException('Invalid argument specified');
        }
        
    }//end __construct()
    
    /**
     * Show the help message for this argument
     * 
     * @return string
     */
    public function showHelp()
    {
        
    }//end showHelp()
}
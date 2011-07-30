<?php

namespace Wildkat;

use Wildkat\ArgumentParser\ArgumentParserException;

/**
 * ArgumentParser.
 * 
 * @author  Kevin Bradwick <kbradwick@gmail.com>
 * @link    https://github.com/kevbradwick/phpargparser
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
final class ArgumentParser
{
    /**
     * @var string
     */
    protected $title;
    
    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $version;
    
    /**
     * @var array
     */
    protected $arguments = array();


    /**
     * Set the application parameters here
     * 
     * @param string $title       the title of this command line application
     * @param string $description a description that get's displayed when calling with help
     * @param string $version     the version number of this application
     * 
     * @return ArgumentParser
     */
    public function __construct($title='', $description='', $version='')
    {
        $this->title       = $title;
        $this->description = $description;
        $this->version     = $version;
        
    }//end __construct()
    
    /**
     * Add an argument
     * 
     * @param string  $argument the argument
     * @param array   $options  an array of options passed to argument construct
     * 
     * @return null
     */
    public function addArgument($argument, $alias='', $type='string', $store=null, $default=null)
    {
        $arg = $this->getArgumentClass($type);
        $arg->setArgument($argument);
        
        if (strlen($alias) > 0) {
            $arg->setArgument($alias);
        }
        
        if ($store === null) {
            $store = str_replace('-', '', $argument);
        }
        
        if ($default !== null) {
            $arg->setDefaultValue($default);
        }
        
        $this->arguments[$store] = $arg;
        
    }//end addArgument()
    
    /**
     * Get the argument class
     * 
     * @param string $type the argument type
     * 
     * @return Wildkat\ArgumentParser\Arguments\AbstractArgument
     */
    protected function getArgumentClass($type)
    {
        $valid = array('string', 'integer', 'boolean', 'array', 'float');
        
        if (in_array($type, $valid) === false) {
            $message = sprintf('"%s" in not a valid argument type', $type);
            throw new ArgumentParserException($message);
        }
        
        $arg = 'Wildkat\\ArgumentParser\\Arguments\\%sArgument';
        $arg = sprintf($arg, ucfirst($type));
        $arg = new $arg();
        
        return  $arg;
        
    }//end getArgumentClass()
    
    /**
     * Parse all arguments and return the argument container
     * 
     * @return ArgumentContainer
     */
    public function parseArguments($arguments=null)
    {
        
    }//end parseArguments()
    
}//endclass
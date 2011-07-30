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
    public function addArgument(array $options)
    {
        $opt = array_merge(array(
            'argument' => '',
            'alias'    => '',
            'variable' => null,
            'default'  => '',
            'type'     => 'string',
            'required' => true,
            'help'     => ''
        ), $options);
                
        $arg = $this->getArgumentClass($opt['type']);
        $arg->setArgument($opt['argument']);
        
        if (strlen($opt['alias']) > 0) {
            $arg->setArgument($opt['alias']);
        }
        
        if ($opt['variable'] === null) {
            $opt['variable'] = str_replace('-', '', $opt['argument']);
        }
        
        if ($opt['default'] !== null) {
            $arg->setDefaultValue($opt['default']);
        }
        
        $this->arguments[$opt['variable']] 
            = array(
                'argumentLong'  => $arg->getArgumentName('long'),
                'argumentshort' => $arg->getArgumentName('short'),
                'argument'      => $arg,
            );
        
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
        unset($_SERVER['argv'][0]);
        
        $args = $_SERVER['argv'];
        
        return $args;
    }//end parseArguments()
    
}//endclass
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
     * Flag to help make testing easier with exit statuses
     * @var boolean
     */
    public static $unitTestEnabled = false;
    
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
     * Maps arguments to the value in $arguments
     * @var array
     */
    protected $argumentMap = array();

    /**
     * The script calling the application
     * @var string
     */
    protected $script;


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
        $this->script      = $_SERVER['argv'][0];
        
        $this->addArgument(array(
            'argument' => '-h',
            'alias'    => '--help',
            'helpText' => 'Show this help screen',
        ));
        
        $this->addArgument(array(
            'argument' => '-v',
            'alias'    => '--version',
            'helpText' => 'Show the application version',
        ));
        
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
            'required' => false,
            'helpText' => ''
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
        
        $arg->setHelpText($opt['helpText']);
        
        $this->arguments[$opt['variable']] 
            = array(
                'argumentLong'  => $arg->getArgumentName('long'),
                'argumentshort' => $arg->getArgumentName('short'),
                'argument'      => $arg,
            );
        
        // map the argument
        $this->argumentMap[$opt['argument']] = $opt['variable'];
        if (strlen($opt['alias']) > 0) {
            $this->argumentMap[$opt['alias']] = $opt['variable'];
        }
        
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
     * Show the help text
     * 
     * @param boolean $return return the text otherwise, echo it out
     * 
     * @return string
     */
    public function showHelp($return=false)
    {
        // new line and new paragraph endings
        $nl = PHP_EOL;
        $np = PHP_EOL . PHP_EOL;
        
        $help  = sprintf('%s %s', $this->title, $this->version) . $np;
        $help .= sprintf('Usage: %s [options]', $this->script) . $np;
        
        // print argument block
        foreach ($this->arguments as $var => $value) {
            $help .= $value['argument']->showHelp(true);
        }
        
        if ($return === true) {
            return $help;
        }
        
        echo $help;
        
    }//end showHelp()
    
    /**
     * Parse all arguments and return the argument container
     * 
     * @return ArgumentContainer
     */
    public function parseArguments($arguments=null)
    {
        $args = $_SERVER['argv'];
        
        if ($arguments !== null) {
            $args = array($this->script);
            foreach (explode(' ', $arguments) as $argument) {
                $args[] = $argument;
            }
        }
        
        // show help
        if (isset($args[1]) === true 
            && in_array($args[1], array('-h', '--help')) === true
        ) {
            $this->showHelp();
            if (self::$unitTestEnabled === true) {
                return true;
            }
            
            exit(1);
        }
        
        // show verion info
        if (isset($args[1]) === true 
            && in_array($args[1], array('-v', '--version')) === true
        ) {
            echo sprintf('%s %s', $this->title, $this->version) . PHP_EOL;
            if (self::$unitTestEnabled === true) {
                return true;
            }
            
            exit(1);
        }
        
        $this->populateArgumentValues($args);
        $args = array();
        foreach ($this->arguments as $name => $array) {
            $args[$name] = $array['argument'];
        }
        
        return new ArgumentParser\ArgumentContainer($args);
        
    }//end parseArguments()
    
    /**
     * Populate the argument values
     * 
     * @param array $args the arguments
     * 
     * @return null
     */
    protected function populateArgumentValues(array $args)
    {
        foreach ($args as $index => $value) {
            // process word arguments
            if (preg_match('/^\-{2}[a-z\-]*\=[a-zA-Z0-9\,]*$/', $value) === 1) {
                list($arg, $value) = explode('=', $value);
                if (isset($this->argumentMap[$arg]) === true) {
                    $key = $this->argumentMap[$arg];
                    $this->arguments[$key]['argument']->setValue($value);
                }
            }
            
            // process single arguments
            if (preg_match('/^\-{1}[a-z]{1}$/', $value) === 1) {
                $n = ($index + 1);
                $param = isset($args[$n]) === true ? $args[$n] : '';
                if (isset($this->argumentMap[$value]) === true) {
                    $key = $this->argumentMap[$value];
                    $this->arguments[$key]['argument']->setValue($param);
                }
            }
        }
        
    }//end populateArgumentValues()
    
}//endclass
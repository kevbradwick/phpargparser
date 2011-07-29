<?php

namespace Wildkat;

/**
 * ArgumentParser
 * 
 * @author Kevin Bradwick <kbradwick@gmail.com>
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
    public function addArgument($argument, array $options=array())
    {
        
    }//end addArgument()
    
}//endclass
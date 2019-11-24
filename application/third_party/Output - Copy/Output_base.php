<?php

require_once('Output_template.php');

class Output_base{

    private $CI = null;

    public static $output = null;

    function __construct(){
        $this->CI =& get_instance();
    }


    static function load($page_action,...$args){

        $class_filename  = ucfirst($page_action).'_output';

        require_once(__DIR__.DIRECTORY_SEPARATOR.ucfirst($page_action).DIRECTORY_SEPARATOR.$class_filename.'.php');
        
        return self::$output;
    }



}
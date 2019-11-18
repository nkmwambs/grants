<?php

//require_once('../Output/Output_template.php');

class Widget_base extends Output_base{
    
    public static $output = null;

    function __construct(){
        parent::__construct();
    }

    function index(){

    }

    static function load($widget,...$args){
        //Widget example: Comment

        require_once(__DIR__.DIRECTORY_SEPARATOR.ucfirst($widget).DIRECTORY_SEPARATOR.ucfirst($widget).'_output.php');

        return self::$output;
    }
}
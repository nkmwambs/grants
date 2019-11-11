<?php 

$path_parts = pathinfo(__FILE__);

class View_output{

    function __construct(){
        
    }

    static function output(){
        return "Its working";
    }

}

require_once(__DIR__.DIRECTORY_SEPARATOR.'create_instance.php');
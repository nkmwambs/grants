<?php

spl_autoload_register(function($classname){

    // Autoloading API classes

    if(strpos($classname,'base') == true){
        require($classname.'.php');
    }

});
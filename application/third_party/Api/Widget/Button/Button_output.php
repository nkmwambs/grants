<?php

class Button_output{
    
    function __construct(){

    }

    function index(){

    }

    function output(...$args){
        $label = $args[0];
        $action = $args[1];

        return '
            <a href="'.base_url().ucfirst($action).'" class="btn btn-default" id="btn">'
            .ucfirst($label).
            '</a>
        ';
    }
}

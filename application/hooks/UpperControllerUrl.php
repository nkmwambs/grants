<?php 

class UpperControllerUrl{
    public function run(){
        $_SERVER['REQUEST_URI'] = ucfirst($_SERVER['REQUEST_URI']);
    }
}
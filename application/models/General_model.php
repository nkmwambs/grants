<?php

class General_model extends CI_Model{
    function __construct(){
        parent::__construct();

        $this->load->database();
    }

    function test(){
        return "Hello";
    }
}
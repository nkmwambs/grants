<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class User_switch extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->library('user_switch_library');
  }

  function index(){}


  public function result($id = "")
  {
    $users = [
      [
        "user_id"=>23,
        "user_name"=>"SLetema",
        "user_firstname"=>"Samuel",
        "user_lastname"=>"Letema"
      ],
      [
        "user_id"=>18,
        "user_name"=>"SOmbeni",
        "user_firstname"=>"Sifaeli",
        "user_lastname"=>"Ombeni"
      ]
    ];   

    return $users;
  }

  static function get_menu_list(){}

}
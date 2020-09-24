<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_tag_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){}

  function change_field_type(){
    $field_type['budget_tag_level']['field_type'] = 'select';
    $field_type['budget_tag_level']['options'] = [
                                                  '1'=>'Initial Budget',
                                                  '2'=>'First Budget Review',
                                                  '3'=>'Second Budget Review', 
                                                  '4'=>'Third Budget Review'];

    return $field_type;
  }

} 
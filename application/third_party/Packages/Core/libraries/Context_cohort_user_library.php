<?php


if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Context_cohort_user_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }


  function change_field_type(){
    $change_field_type['user_name']['field_type'] = 'select';
    $change_field_type['user_name']['options'] = $this->CI->grants->get_users_with_center_group_hierarchy_name('cohort');

    return $change_field_type;
  }

  function index(){}


} 
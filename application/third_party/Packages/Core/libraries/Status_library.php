<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Status_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){}

  

  function change_field_type(){

    $change_field_type = array();
   
    $change_field_type['status_approval_direction']['field_type'] = 'select';
    $change_field_type['status_approval_direction']['options'] = array(
    '-1'=>get_phrase('return_to_sender'),
    '0'=>get_phrase('reinstated_to_last_approver'),
    '1'=>get_phrase('send_to_next_approver'));


    $change_field_type['status_is_requiring_approver_action']['field_type'] = 'select';
    $change_field_type['status_is_requiring_approver_action']['options'] = array(
      get_phrase('no'),
      get_phrase('yes')
    );

    $change_field_type['status_approval_sequence']['field_type'] = 'select';

    $default_sequencies = array(
      '1'=>get_phrase('first_level'),
      '2'=>get_phrase('second_level'),
      '3'=>get_phrase('third_level'),
      '4'=>get_phrase('fourth_level'),
      '5'=>get_phrase('fifth_level'),
      '6'=>get_phrase('sixth_level'),
      '7'=>get_phrase('seventh_level'),
      '8'=>get_phrase('eight_level'),
      '9'=>get_phrase('nineth_level'),
      '10'=>get_phrase('tenth_level'),
    );

    if($this->CI->action == 'single_form_add'){
      // Get an array from the $default_sequencies of approval sequencies that have not been used in reference to the status table
      $unused_approval_sequencies = $this->CI->status_model->status_approval_sequencies($default_sequencies);
      $immediate_unused_approval_sequency_label = current($unused_approval_sequencies);
      $immediate_unused_approval_sequency_key = array_search($immediate_unused_approval_sequency_label,$unused_approval_sequencies);

      // Create an array of the immediate unused approval sequency
      $immediate_unused_approval_sequency_array = [$immediate_unused_approval_sequency_key => $immediate_unused_approval_sequency_label];

      $default_sequencies = $immediate_unused_approval_sequency_array;
    
    }

    $change_field_type['status_approval_sequence']['options'] = $default_sequencies;

    $change_field_type['status_backflow_sequence']['field_type'] = 'select';
    $change_field_type['status_backflow_sequence']['options'] = array(
      '0'=>get_phrase('none'),
      '1'=>get_phrase('first_level'),
      '2'=>get_phrase('second_level'),
      '3'=>get_phrase('third_level'),
      '4'=>get_phrase('fourth_level'),
      '5'=>get_phrase('fifth_level'),
      '6'=>get_phrase('sixth_level'),
      '7'=>get_phrase('seventh_level'),
      '8'=>get_phrase('eight_level'),
      '9'=>get_phrase('nineth_level'),
      '10'=>get_phrase('tenth_level'),
    );
    
    
    return $change_field_type;
  }  


}

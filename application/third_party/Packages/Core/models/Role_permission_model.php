<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Role_permission_model extends MY_Model
{
  public $table = 'role_permission'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function delete($id = null){

  }
  
  function index(){

  }

  function single_form_add_visible_columns(){
    return array('role_name','permission_name');
  }

  function edit_visible_columns(){
    return array('role_name','permission_name','role_permission_is_active');
  }



  function list(){

  }

  // function list_table_visible_columns(){
  //   return array('role_permission_track_number','role_permission_is_active',
  //   'permission_field','role_name','permission_name','permission_description');
  // }

  function master_table_visible_columns(){
    return array('role_permission_track_number','permission_name','role_permission_is_active',
    'permission_field','role_name','permission_description');
  }

  function lookup_tables(){
    return array('role','permission');
  }

  function detail_multi_form_add_visible_columns(){
    
  }

  function detail_tables(){
    
  }

  function view(){

  }

  function transaction_validate_duplicates_columns(){
    return ['fk_role_id','fk_permission_id'];
  }

  function multi_select_field(){
    return 'permission';
  }

  // function lookup_values()
  // {
  //   $lookup_values = parent::lookup_values();

  //   $lookup_values = array_merge($lookup_values,[['pemission_id'=>1,'pemission_name'=>'Create Status'],['permission_id'=>2,'permission_name'=>'Update Status']]);
    
  //   return $lookup_values;
  // }
  
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Role_model extends MY_Model
{
  public $table = 'role'; // you MUST mention the table name
  //public $dependant_table = "role_permission";


  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function delete($id = null){

  }

  function index(){

  }


  function list(){

  }

  function lookup_tables(){
    return array('status','approval');
  }

  function detail_tables(){
    return ['role_permission','user','page_view_role'];
  }

  function view(){

  }

  function action_before_insert($post_array){
    return $this->grants->sanitize_post_value_before_insert($post_array,'role_shortname');
  }

  // function master_table_visible_columns(){
  //   return array('role_name');
  // }

  function lookup_values(){
    $lookup_values = $this->db->get('role')->result_array();

    if(!$this->session->system_admin){
        $lookup_values = $this->db->get_where('role',array('role_id <>'=>1))->result_array();
    }
    
    return $lookup_values;
}

  function intialize_table(Array $foreign_keys_values = []){  

    $role_data['role_track_number'] = $this->grants_model->generate_item_track_number_and_name('role')['role_track_number'];
    $role_data['role_name'] = 'Super System Administrator';
    $role_data['role_shortname'] = 'superadmin';
    $role_data['role_description'] = 'Super System Administrator';
    $role_data['role_is_active'] = 1;
    $role_data['role_is_new_status_default'] = 1;
    $role_data['role_is_department_strict'] = 0;

        
    $role_data_to_insert = $this->grants_model->merge_with_history_fields('role',$role_data,false);
    $this->write_db->insert('role',$role_data_to_insert);

    return $this->write_db->insert_id();
}

}

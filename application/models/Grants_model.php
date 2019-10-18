<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Grants_model extends CI_Model
{

  function __construct(){
    parent::__construct();
  }

  function index(){

  }

  function edit(){

  }

  function add(){
    //$post_array = $this->input->post();
    //echo json_encode($post_array);
    echo get_phrase('global_add_method_is_not_functional');
  }


  function get_all_table_fields($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->table_exists($table)?$this->db->list_fields($table):array();
  }

  function table_fields_metadata($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;
    return $this->db->field_data($table);
  }

  function lookup_values($table){
    $result = $this->db->get($table)->result_array();

    $ids_array = array_column($result,$table.'_id');
    $value_array = array_column($result,$table.'_name');

    return array_combine($ids_array,$value_array);
  }

  /** Refined methods **/

  function list_select_columns(){

    // Check if the table has list_table_visible_columns not empty
    $list_table_visible_columns = $this->grants->list_table_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
          strpos($get_all_table_field,'_created_by') == true ||
           strpos($get_all_table_field,'_last_modified_by') == true ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($list_table_visible_columns) && count($list_table_visible_columns) > 0 ){
      $visible_columns = $list_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }



    return $visible_columns;

  }

  function list($lookup_tables){
    $table = $this->controller;
    // Run column selector
    $this->db->select($this->list_select_columns());

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    return $this->grants_get($table);

  }

  function master_view_select_columns(){

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_table_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns

      if( substr($get_all_table_field,0,3) == 'fk_'){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true || strpos($lookup_table_column,'_id') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }



    return $visible_columns;

  }

  function detail_list_select_columns($table){

    // Check if the table has list_table_visible_columns not empty
    $detail_list_table_visible_columns = $this->grants->detail_list_table_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);

    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
          strpos($get_all_table_field,'_created_by') == true ||
           strpos($get_all_table_field,'_last_modified_by') == true ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($detail_list_table_visible_columns) && count($detail_list_table_visible_columns) > 0 ){
      $visible_columns = $detail_list_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $visible_columns;

  }


  function master_select_columns(){

    $table = $this->controller;

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_table_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }


    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }



    return $visible_columns;

  }


  function detail_list($table){

    $lookup_tables = $this->grants->lookup_tables($table);
    //print_r($lookup_tables);
    // Run column selector
    $this->db->select($this->detail_list_select_columns($table));

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }
    $this->db->where(array('fk_'.$this->controller.'_id'=> hash_id($this->uri->segment(3,0),'decode') ));
    return $this->grants_get($table);
  }


  function master_view(){

      $table = strtolower($this->controller);

      $model = $this->current_model;

      $this->db->select($this->master_view_select_columns());

      $lookup_tables = $this->grants->lookup_tables($table);

      if( is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {
            //Create table joins
            $lookup_table_id = $lookup_table.'_id';
            $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
        }
      }


      $data = array();

      $library = $table.'_library';

      $this->load->library($library);

      if(method_exists($this->$library,'list_table_where')){
        $this->db->where($this->$library->list_table_where());
      }

      $data = (array)$this->db->get_where($table,array($table.'_id'=> hash_id($this->uri->segment(3,0),'decode') ) )->row();

      // Get the name of the record creator
      $created_by = $data[$table.'_created_by'] >= 1? $this->db->select('CONCAT(`first_name`," ",`last_name`) as user_name')->get_where('user',
      array('user_id'=>$data[$table.'_created_by']))->row()->user_name:get_phrase('creator_user_not_set');

      $data['created_by'] = $created_by;

      //Get the name of the last record modifier
      $last_modified_by = $data[$table.'_last_modified_by'] >= 1? $this->db->select('CONCAT(`first_name`," ",`last_name`) as user_name')->get_where('user',
      array('user_id'=>$data[$table.'_last_modified_by']))->row()->user_name:get_phrase('modifier_user_not_set');

      $data['last_modified_by'] = $last_modified_by;

      return $data;
  }

  function grants_get($table){

    $library = $table.'_library';

    $this->load->library($library);

    if(method_exists($this->$library,'list_table_where')){
      $this->db->where($this->$library->list_table_where());
    }

    return $this->db->get($table)->result_array();
  }

  function master_multi_form_add_visible_columns(){

    // Check if the table has list_table_visible_columns not empty
    $master_table_visible_columns = $this->grants->master_multi_form_add_visible_columns();
    $lookup_tables = $this->grants->lookup_tables();

    $get_all_table_fields = $this->get_all_table_fields();

    foreach ($get_all_table_fields as $get_all_table_field) {
      //Unset foreign keys columns, created_by and last_modified_by columns
      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }
    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($master_table_visible_columns) && count($master_table_visible_columns) > 0 ){
      $visible_columns = $master_table_visible_columns;
    }else{

      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }

    }



    return $visible_columns;

  }


  function detail_multi_form_add_visible_columns($table){

    // Check if the table has list_table_visible_columns not empty
    $detail_table_visible_columns = $this->grants->detail_multi_form_add_visible_columns($table);
    $lookup_tables = $this->grants->lookup_tables($table);

    $get_all_table_fields = $this->get_all_table_fields($table);

    foreach ($get_all_table_fields as $get_all_table_field) {
      //Unset foreign keys columns, created_by and last_modified_by columns
      if( substr($get_all_table_field,0,3) == 'fk_' ||
           strpos($get_all_table_field,'_deleted_at') == true
        ){
        unset($get_all_table_fields[array_search($get_all_table_field,$get_all_table_fields)]);
      }
    }


    $visible_columns = $get_all_table_fields;
    $lookup_columns = array();

    if(is_array($detail_table_visible_columns) && count($detail_table_visible_columns) > 0 ){
      $visible_columns = $detail_table_visible_columns;
    }else{
      if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
        foreach ($lookup_tables as $lookup_table) {

          $lookup_table_columns = $this->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if(strpos($lookup_table_column,'_name') == true){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $visible_columns;

  }

  function approveable_item($approveable_item_name = ""){

    $approveable_item_name = $approveable_item_name == ""?$this->controller:$approveable_item_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$approveable_item_name,'approve_item_is_active'=>1))->num_rows();

    $approveable_item_flag = false;

    if($approveable_item > 0){
      $approveable_item_flag = true;
    }

    return $approveable_item_flag;
  }

  // This give the initial approval status when inserting a record

  function initial_item_status($table_name = ""){

    $table = $table_name == "" ? $this->controller : $table_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$table,'approve_item_is_active'=>1));

    $status_id = 0;

    if($approveable_item->num_rows() > 0 ){
      $approveable_item_id = $approveable_item->row()->approve_item_id;
      $initial_status = $this->db->get_where('status',array('fk_approve_item_id'=>$approveable_item_id,
      'status_approval_sequence'=>1));

      if($initial_status->num_rows() > 0 ){
          $status_id = $initial_status->row()->status_id;
      }

    }

    return $status_id;

  }

  function get_status_id($table,$primary_key){
    $fk_status_id = 0;

    $record_object = $this->db->get_where($table,array($table.'_id'=>$primary_key));

    if($record_object->num_rows()>0 && array_key_exists('fk_status_id',(array)$record_object->row() ) ){
     $fk_status_id = $this->db->get_where($table,array($table.'_id'=>$primary_key))->row()->fk_status_id;
    }

    return $fk_status_id;
  }

/**
* The method produces an array of the valid approval status ids for the listed items
*
**/

  function display_approver_status_action($item_status, $table_name = ""){

    $user_role_id = $this->session->role_id;;

    $table = $table_name == "" ? $this->controller : $table_name;

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>$table,'approve_item_is_active'=>1));

    //$label = array();
    $raw_labels = array();

    if($approveable_item->num_rows() > 0 ){
      $approveable_item_id = $approveable_item->row()->approve_item_id;

      $current_status_object = $this->db->get_where('status',array('status_id'=>$item_status));

      if($current_status_object->num_rows()>0){
          $current_status_approval_direction = $current_status_object->row()->status_approval_direction;
          $current_status_approval_sequence = $current_status_object->row()->status_approval_sequence;

          if($current_status_approval_direction == 1 || $current_status_approval_direction == 0){
            //Point to the next status_action_label of status_approval_direction 1 or -1
            $next_status_approval_sequence_object = $this->db->get_where('status',
            array('fk_approve_item_id'=>$approveable_item_id,
            'status_approval_sequence > '=>$current_status_approval_sequence));

            if($next_status_approval_sequence_object->num_rows()>0){

              $next_status_approval_sequence = $next_status_approval_sequence_object->row()->status_approval_sequence;

              $this->db->where_in('status_approval_direction',array(1,-1));
              $this->db->select(array('status_id','status_action_label'));
              $this->db->join('status_role','status_role.fk_status_id=status.status_id');
              $raw_labels = $this->db->get_where('status',
              array('fk_approve_item_id'=>$approveable_item_id,
              'status_approval_sequence'=>$next_status_approval_sequence,'status_role.fk_role_id'=>$user_role_id));

            }

          }elseif ($current_status_approval_direction == -1) {
            //Remain at the same status but point to the status_action_label of status_approval_direction 0
             $status_approval_sequence = $current_status_object->row()->status_approval_sequence;

             $this->db->where(array('status_approval_direction'=>0));
             $this->db->select(array('status_id','status_action_label'));
             $this->db->join('status_role','status_role.fk_status_id=status.status_id');
             $raw_labels = $this->db->get_where('status',
             array('fk_approve_item_id'=>$approveable_item_id,
             'status_approval_sequence'=>$current_status_approval_sequence,'status_role.fk_role_id'=>$user_role_id));
          }

      }

      $columned_labels = array();
      // Finally filter the resultant array to only retain the correct status_action_label based on the user role id
      if(is_array($raw_labels->result_array()) && count($raw_labels->result_array()) > 0){
        $status_ids_array = array_column($raw_labels->result_array(),'status_id');
        $labels_array = array_column($raw_labels->result_array(),'status_action_label');

        $columned_labels = array_combine($status_ids_array,$labels_array);
      }

      return $columned_labels;


    }

  }




}

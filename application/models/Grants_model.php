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
    $post_array = $this->input->post();
    echo json_encode($post_array);
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
    // Run column selector
    $this->db->select($this->detail_list_select_columns($table));

    if(is_array($lookup_tables) && count($lookup_tables) > 0 ){
      foreach ($lookup_tables as $lookup_table) {
          $lookup_table_id = $lookup_table.'_id';
          $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
      }
    }

    return $this->grants_get($table);
  }

  // function view(){
  //   // This $this->controller is a public parameter of the MY_Controller
  //   $table = strtolower($this->controller);
  //
  //   $detail_tables = $this->grants->detail_tables($table);
  //
  //   $model = $this->current_model;
  //
  //   $this->db->select($this->master_view_select_columns());
  //
  //   $lookup_tables = $this->grants->lookup_tables($table);
  //
  //   $lookup_table_ids = array();
  //
  //   if( is_array($lookup_tables) && count($lookup_tables) > 0 ){
  //     foreach ($lookup_tables as $lookup_table) {
  //         //Create table joins
  //         $lookup_table_id = $lookup_table.'_id';
  //         $this->db->join($lookup_table,$lookup_table.'.'.$lookup_table_id.'='.$table.'.fk_'.$lookup_table_id);
  //     }
  //   }
  //
  //   $data = array();
  //
  //   $data['master'] = (array)$this->db->get_where($table,array($table.'_id'=> hash_id($this->uri->segment(3,0),'decode') ) )->row();
  //
  //   $data['master_table_name'] = $table;
  //   // Get the name of the record creator
  //   $data['created_by'] = $data['master'][$table.'_created_by'] >= 1? $this->db->select('CONCAT(`first_name`," ",`last_name`) as user_name')->get_where('user',
  //   array('user_id'=>$data['master'][$table.'_created_by']))->row()->user_name:get_phrase('creator_user_not_set');
  //
  //   //Get the name of the last record modifier
  //   $data['last_modified_by'] = $data['master'][$table.'_last_modified_by'] >= 1? $this->db->select('CONCAT(`first_name`," ",`last_name`) as user_name')->get_where('user',
  //   array('user_id'=>$data['master'][$table.'_last_modified_by']))->row()->user_name:get_phrase('modifier_user_not_set');
  //
  //   if(is_array($detail_tables) && count($detail_tables) > 0 ){
  //     foreach ($detail_tables as $detail_table) {
  //         $data['detail'][$detail_table]['keys'] = $this->detail_list_select_columns($detail_table);
  //         $data['detail'][$detail_table]['has_details'] = $this->grants->check_if_table_has_detail_table($detail_table);
  //         $this->db->select($this->detail_list_select_columns($detail_table));
  //         $data['detail'][$detail_table]['table_body']= $this->detail_list($detail_table);//return second arg as list and resolve the error
  //     }
  //   }
  //
  //   return $data;
  // }

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

}

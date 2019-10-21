<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grants{

// This is a variable carrying the instance for Codeigniter singleton class
private $CI;

// This is the library for the current running master controller
private $current_library;

// This is the model for the current running master controller
private $current_model;

// This the current/ master detail table name which is equivalent to the running master controller
private $controller;

// This is the action that has been called by the running controllers. It can either be list, view, edit, add or delete
private $action;

private $table;

function __construct(){

  // Instantiate Codeigniter Singleton class
  $this->CI =& get_instance();

  // Instantiate the name of the current running object/ main controller
  $this->controller = $this->CI->uri->segment(1, 'approval');

  // Instantiate the name of the current running object library/ main controller library
  $current_library = $this->controller.'_library';

  // Instantiate the name of the current running model/ main controller model
  $this->current_model = $this->controller.'_model';

  // Get the default running actions
  $this->action = $this->CI->uri->segment(2,'list');

  // Load the main/ feature controller model
  $this->CI->load->model($this->current_model);

  //Loading system model (Grants_model). The autoloaded grants model does work in library context and has to loaded here
  $this->CI->load->model('grants_model');
}

// This method switches loading between the main controller model and a specified detail model. It switches to a detail model if
// the detail table is passed as an argument

function load_detail_model($table_name = ""){
  $model =  $this->current_model;

  if($table_name !== "" && !is_array($table_name)){
    $model = $table_name.'_model';
    $this->CI->load->model($model);
  }

  return $model;
}

// This method is a wrapper to the lookup_tables method of the specific feature model
// The lookup_tables method holds the lookup referencing tables as array elements
// Passing an argument to this method wrapper switches between the lookup tables of the main feature model to a certain details model

function lookup_tables($table_name = ""){
  $model = $this->load_detail_model($table_name);

  return $this->CI->$model->lookup_tables();
}

// This is wrapper method to the detail_tables of the specific feature model
// The detail_tables method holds the details referencing tables as array elements
// Passing an argument to this wrapper switches between the main feature model detail_tables to a certain details models

function detail_tables($table_name = ""){
  $model = $this->load_detail_model($table_name);

  return $this->CI->$model->detail_tables();
}

//This function allows unsetting default hidden columns. It's callable from specific model
//Example:
//$columns_to_show =  array('funder_created_date','funder_last_modified_date');
//Unset default hidden columns
//return $this->grants->unset_default_hidden_columns($default_hidden_columns,$columns_to_show);

function unset_default_hidden_columns($default_hidden_columns,$columns_to_unset){
  foreach ($columns_to_unset as $column_to_unset) {
    $unset_default_hidden_column = in_array($column_to_unset,$default_hidden_columns);
    unset($default_hidden_columns[$unset_default_hidden_column]);
  }

  return $default_hidden_columns;
}

//This function allows to add more hidden columns. Callable from a specific model
//Example:
//$columns_to_hide = array('funder_description');
//return $this->grants->add_default_hidden_columns($default_hidden_columns,$columns_to_hide)
function add_default_hidden_columns($default_hidden_columns,$columns_to_hide){
  foreach ($columns_to_hide as $column_to_hide) {
    array_push($default_hidden_columns,$column_to_hide);
  }

  return $default_hidden_columns;
}


function get_all_table_fields($table_name = ""){
  return $this->CI->grants_model->get_all_table_fields($table_name);
}


function edit_result(){}


function check_if_table_has_detail_table($table_name = ""){

    $table = $table_name == ""?$this->controller:$table_name;

    $all_detail_tables = $this->detail_tables($table);

    $has_detail_table = false;

    if(is_array($all_detail_tables) && count($all_detail_tables) > 0){
      $has_detail_table = true;
    }

    return $has_detail_table;
  }

  function check_if_table_has_detail_listing($table_name = ""){

      $table = $table_name == ""?$this->controller:$table_name;

      $all_detail_tables = $this->detail_tables($table);

      $has_detail_table = false;

      if( is_array($all_detail_tables) && in_array($table.'_detail',$all_detail_tables) ){
        $has_detail_table = true;
      }

      return $has_detail_table;
    }

    function detail_row_fields($fields_array){

      $fields = array();

      foreach ($fields_array as $key) {
        $f = new Fields_base($key,$this->controller.'_detail');

        $field_type = $f->field_type();

        $field = $field_type."_field";

        if($field_type == 'select'){
          $lookup_table = strtolower(substr($key,0,-5));
          $fields[$key] = $f->$field($this->CI->grants_model->lookup_values($lookup_table));
        }else{
          $fields[$key] = $f->$field();
        }

      }

      return $fields;
    }


  function header_row_field($column){

      $f = new Fields_base($column,$this->controller,true);

      $field_type = $f->field_type();

      $field = $field_type."_field";

      if($field_type == 'select'){
        $lookup_table = strtolower(substr($column,0,-5));
        return $f->$field($this->CI->grants_model->lookup_values($lookup_table));
      }else{
        return $f->$field();
      }

  }


  function detail_multi_form_add_visible_columns($table){
    $model = $this->load_detail_model($table);
    return $this->CI->$model->detail_multi_form_add_visible_columns();
  }


  function master_multi_form_add_visible_columns(){
    $model = $this->current_model;
    return $this->CI->$model->master_multi_form_add_visible_columns();
  }

  function multi_form_add_result($table_name = ""){

    $table = $table_name == ""?$this->controller:$table_name;

    if($this->CI->input->post()){
      $model = $this->current_model;

      if(method_exists($this->CI->$model,'add')){
        $this->CI->$model->add();
      }else{
        $this->CI->grants_model->add();
      }
    }else{
      $keys = $this->CI->grants_model->master_multi_form_add_visible_columns();
      $detail_table_keys = $this->CI->grants_model->detail_multi_form_add_visible_columns($table.'_detail');

      return array(
        'keys'=>$keys,
        'detail_table'=>$detail_table_keys
      );
    }

  }

  function single_form_add_result($table_name = ""){

      $table = $table_name == ""?$this->controller:$table_name;

      if($this->CI->input->post()){
        $this->CI->grants_model->add($this->CI->input->post());
      }else{
          $keys = $this->CI->grants_model->master_multi_form_add_visible_columns();

        return array(
          'keys'=>$keys
        );
      }

    }
// Listing views specific methods

function list_table_visible_columns(){
  $model = $this->current_model;
  $columns = $this->CI->$model->list_table_visible_columns();

  //Add the table id columns if does not exist in $columns
  if(is_array($columns) && !in_array($this->controller.'_id',$columns)){
    array_unshift($columns,$this->controller.'_id');
  }

  return $columns;

}

function detail_list_table_visible_columns($table){
  $model = $this->load_detail_model($table);

  $columns = $this->CI->$model->detail_list_table_visible_columns();

  //Add the table id columns if does not exist in $columns
  if(is_array($columns) && !in_array($this->controller.'_id',$columns)){
    array_unshift($columns,$this->controller.'_id');
  }

  return $columns;
}

function master_table_visible_columns(){
  $model = $this->current_model;

  $columns = $this->CI->$model->master_table_visible_columns();

  //Add the table id columns if does not exist in $columns
  if(is_array($columns) && !in_array($this->controller.'_id',$columns)){
    array_unshift($columns,$this->controller.'_id');
  }

  return $columns;
}

function list(){
  $model = $this->current_model;

  // Get the tables foreign key relationship
  $lookup_tables = $this->lookup_tables();

  // Get result from grants model if feature model list returns empty
  $feature_model_list_result = $this->CI->$model->list(); // A full user defined query result
  $grant_model_list_result = $this->CI->grants_model->list($lookup_tables); // System generated query result

  $query_result = $grant_model_list_result;

  if(is_array($feature_model_list_result) && count($feature_model_list_result) > 0){
    $query_result = $feature_model_list_result;
  }

  return $query_result;
}

function show_add_button($table = ""){

  $model = $this->current_model;

  if($table !==""){
    $model = $this->load_detail_model($table);
  }

  $show_add_button = true;

  if(method_exists($this->CI->$model,'show_add_button') ){
    $show_add_button = $this->CI->$model->show_add_button();
  }

  return $show_add_button;
}

function list_result(){
  $table = $this->controller;

  $result = $this->list();
  $keys = $this->CI->grants_model->list_select_columns();
  $has_details = $this->check_if_table_has_detail_table();
  $show_add_button = $this->show_add_button();

  return array(
    'keys'=> $keys,
    'table_body'=>$result,
    'table_name'=> $table,
    'has_details_table' => $this->check_if_table_has_detail_table($table),
    'has_details_listing' => $this->check_if_table_has_detail_listing($table),
    'show_add_button'=>$show_add_button
  );
}

// Master detail view specific methods

function detail_list($table){
  $model = $this->load_detail_model($table);

  // Get the tables foreign key relationship
  $lookup_tables = $this->lookup_tables($table);

  // Get result from grants model if feature model list returns empty
  $feature_model_list_result = $this->CI->$model->detail_list(); // A full user defined query result
  $grant_model_list_result = $this->CI->grants_model->detail_list($table); // System generated query result

  $query_result = $grant_model_list_result;

  if(is_array($feature_model_list_result) && count($feature_model_list_result) > 0){
    $query_result = $feature_model_list_result;
  }

  return $query_result;
}

function detail_list_view($table){

  $result = $this->detail_list($table);
  $keys = $this->CI->grants_model->detail_list_select_columns($table);
  $has_details = $this->check_if_table_has_detail_table($table);
  $is_approveable_item = $this->approveable_item($table);
  $show_add_button = $this->show_add_button($table);

  return array(
    'keys'=> $keys,
    'table_body'=>$result,
    'table_name'=> $table,
    'has_details_table' => $has_details,
    'has_details_listing' => $this->check_if_table_has_detail_listing($table),
    'is_approveable_item' => $is_approveable_item,
    'show_add_button'=>$show_add_button
  );
}

function master_view(){
  $model = $this->current_model;

  // Get result from grants model if feature model list returns empty
  $feature_model_master_view_result = $this->CI->$model->master_view(); // A full user defined query result
  $grant_model_master_view_result = $this->CI->grants_model->master_view(); // System generated query result

  $query_result = $grant_model_master_view_result;

  if(is_array($feature_model_master_view_result) && count($feature_model_master_view_result) > 0){
    $query_result = $feature_model_master_view_result;
  }

  return $query_result;
}

function approveable_item($detail_table = ""){
  return $this->CI->grants_model->approveable_item($detail_table);
}

function display_approver_status_action($status_id, $table = ""){
  return $this->CI->grants_model->display_approver_status_action($status_id, $table);
}

function view_result(){
  $table = $this->controller;

  $query_output = $this->master_view();
  $keys = $this->CI->grants_model->master_select_columns();
  $has_details = $this->check_if_table_has_detail_table($table);
  $is_approveable_item = $this->approveable_item();

  $result['master'] = array(
      'keys'=> $keys,
      'table_body'=>$query_output,
      'table_name'=> $table,
      'has_details_table' => $has_details,
      'is_approveable_item' => $is_approveable_item,
      'action_labels'=>$this->action_labels($table,hash_id($this->CI->uri->segment(3,0),'decode'))
    );

    $detail_tables = $this->detail_tables($table);

    $result['detail'] = array();

    if($has_details){
      $detail = array();
      foreach ($detail_tables as $detail_table) {
        $detail[$detail_table] = $this->detail_list_view($detail_table);
      }

      $result['detail'] = $detail;
    }

  return $result;

}

function action_labels($table,$primary_key){

  $label = array();

  $status_id = $this->CI->grants_model->get_status_id($table,$primary_key);

  if($status_id > 0){
    $label =  $this->display_approver_status_action($status_id,$table);
  }
  return $label;
}

function action_list($table,$primary_key,$is_approveable_item){
  $data['table'] = $table;
  $data['primary_key'] = $primary_key;
  $data['is_approveable_item'] = $is_approveable_item;
  $data['action_labels'] = $this->action_labels($table,$primary_key);

  return $this->CI->load->view('general/action_list',$data,true);
}

function initial_item_status(){
  return $this->CI->grants_model->initial_item_status();
}

}

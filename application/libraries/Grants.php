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
      //else
      // if(is_array($all_detail_tables) && count($all_detail_tables) > 0){
      //   $has_detail_table = true;
      // }

      return $has_detail_table;
    }

  function get_fields_of_detail_table($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;

    $detail_table_columns = array();

    if($this->check_if_table_has_detail_table($table)){
        $detail_table_columns = $this->table_columns($table.'_detail',$this->table_hidden_columns($table.'_detail'));
    }

    return $detail_table_columns;

  }


  function field_type($table,$field){

    $all_fields = $this->CI->grants_model->table_fields_metadata($table);

    $array_of_columns = array_column($all_fields,'name');
    $array_of_types = array_column($all_fields,'type');

    $name_types = array_combine($array_of_columns,$array_of_types);

    $column_type = 'int';

    $field_type = 'number';

    if(strpos($field,'_name') == true  && $field !== $table.'_name'){
      //$field_type = "select";
      $field = 'fk_'.substr($field,0,-5).'_id';
    }

    if(array_key_exists($field,$name_types)){
      $column_type  = $name_types[$field];

      if($column_type == 'int' || $column_type == 'decimal'){

        $field_type = "number";

        if(strpos($field,'_id') == true){
          $field_type = "select";
        }

      } elseif($column_type == 'varchar'){
        $field_type = "text";
      }elseif ($column_type == 'date') {
        $field_type = "date";
      }

    }

    return $field_type;

  }


  function populate_values_from_lookup_table($table){
    return $this->CI->grants_model->lookup_values($table);
  }

  function number_field($column,$table,$is_header = false){
    $id = "";
    $name = 'detail['.$column.'][]';

    if($is_header){
      $id = $column;
      $name = 'header['.$column.']';
    }

    $value = 0;

    $library = $this->CI->controller.'_library';

    $method = $column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }

    return '<input id="'.$id.'" required="required" type="number" value="'.$value.'" class="form-control input_'.$table.' '.$column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$column))).'" />';
  }

  function text_field($column,$table,$is_header = false){

    $id = "";
    $name = 'detail['.$column.'][]';

    if($is_header){
      $id = $column;
      $name = 'header['.$column.']';
    }

    //$name = $field;

    $value = "";

    $library = $this->CI->controller.'_library';

    $method = $column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }


    return '<input id="'.$id.'" value="'.$value.'" required="required" type="text" class="form-control input_'.$table.' '.$column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$column))).'" />';
  }


  function date_field($column,$table,$is_header = false){

        $id = "";
        $name = 'detail['.$column.'][]';

        if($is_header){
          $id = $column;
          $name = 'header['.$column.']';
        }

        $value = "";

        $library = $this->CI->controller.'_library';

        $method = $column.'_field_value';

        if(method_exists($this->CI->$library,$method)){
          $value = $this->CI->$library->$method();
        }

      return '<input id="'.$id.'" value="'.$value.'" data-format="yyyy-mm-dd" required="required" readonly="readonly" type="text" class="form-control datepicker input_'.$table.' '.$column.'" name="'.$name.'" placeholder="'.get_phrase('enter_'.ucwords(str_replace('_',' ',$column))).'" />';
  }

  function select_field($column,$table,$is_header = false){

    $lookup_table = strtolower(substr($column,0,-5));
    $options = $this->populate_values_from_lookup_table($lookup_table);

    $id = "";
    $column_placeholder = $column;

    if(strpos($column,'_name') == true && $column !== $table.'_name'){
        $column = 'fk_'.substr($column,0,-5).'_id';
    }

    $name = 'detail['.$column.'][]';

    if($is_header){
      $id = $column;
      $name = 'header['.$column.']';
    }

    $value = 0;

    $library = $this->CI->controller.'_library';

    $method = $column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }

    $select =  "<select id='".$id."' name='".$name."' class='form-control input_".$table." ".$column." ' required='required'>
            <option value='0'>".get_phrase('select_'.ucwords(str_replace('_',' ',$column_placeholder)))."</option>";

            foreach ($options as $option_value=>$option_html) {
              $selected = "";
              if($option_value == $value){
                  $selected = "selected='selected'";
              }
              $select .= "<option value='".$option_value."' ".$selected.">".$option_html."</option>";
            }

    $select .= "</select>";

    return $select;
  }


  function header_row_field($column){

      $field_type = $this->field_type($this->controller,$column);

      $field = $field_type."_field";

      return $this->$field($column,$this->controller,true);

  }

  /**Testing these**/

  function detail_row_fields($fields_arrayy){

    $fields = array();

    foreach ($fields_arrayy as $key) {
      $field_type = $this->field_type($this->controller.'_detail',$key);

      $field = $field_type."_field";

      $fields[$key] = $this->$field($key,$this->controller.'_detail');

    }


    return $fields;
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
  return $this->CI->$model->list_table_visible_columns();
}

function detail_list_table_visible_columns($table){
  $model = $this->load_detail_model($table);
  return $this->CI->$model->detail_list_table_visible_columns();
}

function master_table_visible_columns(){
  $model = $this->current_model;
  return $this->CI->$model->master_table_visible_columns();
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

  if($detail_table !== ""){
    //$model = $this->load_detail_model($detail_table);
    return $this->CI->grants_model->approveable_item($detail_table);
  }else{
    return $this->CI->grants_model->approveable_item();
  }

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
      'is_approveable_item' => $is_approveable_item
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

}

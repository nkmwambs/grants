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

  if($table_name !== ""){
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

// This method is a wrapper to 2 methods in the feature model i.e. table_hidden_columns and master_table_hidden_columns
// When the $table_as_master argument is passed as true this method becomes a wrapper to master_table_hidden_columns whereas by
// default it's a wrapper to table_hidden_columns
// Supplying the $table_name argument switches between master feature model to detail model

function table_hidden_columns($table_name = "", $table_as_master = false){
  $model = $this->load_detail_model($table_name);

  if($table_as_master){
    return $this->CI->$model->master_table_hidden_columns();
  }else{
    return $this->CI->$model->table_hidden_columns();
  }

}

function table_visible_columns($table_name = "", $table_as_master = false){
  $model = $this->load_detail_model($table_name);
  $visible_columns = $this->CI->$model->table_visible_columns();

  if($table_as_master){
    $master = $this->CI->$model->master_table_visible_columns();

    if(is_array($master) && count($master)>0){
        $visible_columns = $this->CI->$model->master_table_visible_columns();
    }else{
        $visible_columns = $this->get_all_table_fields($table_name);
    }

  }

  //These are columns that must exists for listing tables to work i.e.
  // All list table MUST have a track_number and id columns
  // Add these to the array if not present in the $visible_columns array
  $mandatory_columns = array($table_name.'_track_number',$table_name.'_id');

  if(is_array($visible_columns)){
    foreach ($mandatory_columns as $mandatory_column) {
      if(!in_array($mandatory_column,$visible_columns)){
        //Add the mandatory columns at the beginning of an array
        array_unshift($visible_columns,$mandatory_column);
      }
    }
  }

  return $visible_columns;
}

function get_all_table_fields($table_name = ""){
  return $this->CI->grants_model->get_all_table_fields($table_name);
}

function table_columns($table,$hidden_columns = array()){

  $all_columns = $this->CI->grants_model->get_all_table_fields($table);

  if( is_array($this->table_visible_columns($table)) && count($this->table_visible_columns($table)) > 0){
      $all_columns = $this->table_visible_columns($table);
  }

  $columns_to_display = array();


  foreach ($all_columns as $column) {
    //$columns_to_display[] = $column;

    if(is_array($hidden_columns) && count($hidden_columns)>0){
        if(!in_array($column,$hidden_columns)){
          if(substr($column,0,3) == 'fk_'){
              $columns_to_display[] = fk_to_name_field($column);
          }else{
              $columns_to_display[] = $column;
          }
        }

    }else{
      if(substr($column,0,3) == 'fk_'){
          $columns_to_display[] = fk_to_name_field($column);
      }else{
          $columns_to_display[] = $column;
      }
    }
  }

  // Unset the created by, last_modified_by and deleted_at columns when listing

  if( in_array($table.'_created_by', $columns_to_display) && $this->CI->config->item('hide_created_by_column') == true){
    $created_by_id = array_search($table.'_created_by',$columns_to_display);
    unset($columns_to_display[$created_by_id]);
  }

  if( in_array($table.'_last_modified_by', $columns_to_display)  && $this->CI->config->item('hide_last_modified_by_column') == true ){

    $last_modified_by_id = array_search($table.'_last_modified_by',$columns_to_display);
    unset($columns_to_display[$last_modified_by_id]);

  }

  if( in_array($table.'_deleted_at', $columns_to_display )  && $this->CI->config->item('hide_deleted_at_column') == true ){
    $deleted_at = array_search($table.'_deleted_at',$columns_to_display);
    unset($columns_to_display[$deleted_at]);
  }

  return $columns_to_display;
}


function switch_query_result_source($table_name = "",$force_action_to = ""){
  //$model = $table_name == ""?$this->current_model:$table_name.'_model';
  $model = $this->load_detail_model($table_name);

  $action = $force_action_to == ""?$this->action:$force_action_to;

  $relationship_tables = $action == 'list'?"lookup_tables":"detail_tables";

  $result = array();


  if($force_action_to == 'list'){
    //Use the user defined results in the specific model
    $result = $this->CI->grants_model->$action($this->CI->$model->$relationship_tables(),$table_name,$this->CI->uri->segment(3,0) );
  }else{
    //Use the array results produced from the grants model
    $result = $this->CI->grants_model->$action($this->CI->$model->$relationship_tables(),$table_name);
  }

  return $result;
}



  function edit_result(){

  }


  function check_if_table_has_detail_table($table_name = ""){

    $table = $table_name == ""?$this->controller:$table_name;

    $all_detail_tables = $this->detail_tables($table);

    $has_detail_table = false;

    if( is_array($all_detail_tables) && in_array($table.'_detail',$all_detail_tables) ){
      $has_detail_table = true;
    }

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

  function detail_table_keys($table_name = ""){
    $table = $table_name == ""?$this->controller:$table_name;

    $detail_tables = $this->get_fields_of_detail_table($table);

    $detail_table_keys = array();

    unset($detail_tables[array_search($this->controller.'_name',$detail_tables)]);

    foreach ($detail_tables as $detail_table_key) {

      if( strpos($detail_table_key,'_id') == true ||
          strpos($detail_table_key,'_track_number') == true
      ){
        continue;
      }

      $detail_table_keys[] = $detail_table_key;
    }

    return $detail_table_keys;
  }

  function single_form_add_result($table_name = ""){

      $table = $table_name == ""?$this->controller:$table_name;

      if($this->CI->input->post()){
        $this->CI->grants_model->add($this->CI->input->post());
      }else{
        $keys = $this->table_columns($table,$this->table_hidden_columns($table));

        return array(
          'keys'=>$keys
        );
      }

    }



  function multi_form_add_result($table_name = ""){

    $table = $table_name == ""?$this->controller:$table_name;

    if($this->CI->input->post()){
      $this->CI->grants_model->add($this->CI->input->post());
    }else{
      $keys = $this->table_columns($table,$this->table_hidden_columns($table));
      $detail_table_keys = $this->detail_table_keys($table);

      return array(
        'keys'=>$keys,
        'detail_table'=>$detail_table_keys
      );
    }

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
    $name = $column.'[]';

    if($is_header){
      $id = $column;
      $name = $column;
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
    $name = $column.'[]';

    if($is_header){
      $id = $column;
      $name = $column;
    }

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
        $name = $column.'[]';

        if($is_header){
          $id = $column;
          $name = $column;
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
    $name = $column.'[]';

    if($is_header){
      $id = $column;
      $name = $column;
    }

    $value = 0;

    $library = $this->CI->controller.'_library';

    $method = $column.'_field_value';

    if(method_exists($this->CI->$library,$method)){
      $value = $this->CI->$library->$method();
    }

    $select =  "<select id='".$id."' name='".$name."' class='form-control input_".$table." ".$column." ' required='required'>
            <option value='0'>".get_phrase('select_'.ucwords(str_replace('_',' ',$column)))."</option>";

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

  function detail_row_fields(){

    $detail_keys = $this->detail_table_keys($this->controller);

    $fields = array();

    foreach ($detail_keys as $key) {
      $field_type = $this->field_type($this->controller.'_detail',$key);

      $field = $field_type."_field";

      $fields[$key] = $this->$field($key,$this->controller.'_detail');

    }


    return $fields;
  }

  function header_row_field($column){

      $field_type = $this->field_type($this->controller,$column);

      $field = $field_type."_field";

      return $this->$field($column,$this->controller,true);

  }

  // function list_result($table_name = "",$force_action_to = ""){
  //       $table = $table_name == ""?$this->controller:$table_name;
  //
  //       $result = $this->switch_query_result_source($table,$force_action_to);
  //
  //
  //       $keys = $this->table_columns($table,$this->table_hidden_columns($table));
  //
  //       $has_detail = (is_array( $this->detail_tables($table) ) && count( $this->detail_tables($table) ) > 0 )?1:0;
  //
  //       $table_array = array(
  //           'keys'=> $keys,
  //           //'table_header'=>$table_header,
  //           'table_body'=>$result,
  //           'table_name'=>$table,
  //           'has_details'=> $has_detail,
  //           'has_details_table' => $this->check_if_table_has_detail_table($table)
  //         );
  //
  //         return $table_array;
  //   }


  // function view_result(){
  //     return $this->switch_query_result_source();
  //   }

  /**Testing these**/

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

function list_result(){
  $table = $this->controller;

  $result = $this->list();
  $keys = $this->CI->grants_model->list_select_columns();
  $has_details = $this->check_if_table_has_detail_table();

  return array(
    'keys'=> $keys,
    'table_body'=>$result,
    'table_name'=> $table,
    'has_details_table' => $this->check_if_table_has_detail_table($table)
  );
}

// Master detail view specific methods

function detail_list($table){
  $model = $this->load_detail_model($table);

  // Get the tables foreign key relationship
  $lookup_tables = $this->lookup_tables($table);

  // Get result from grants model if feature model list returns empty
  $feature_model_list_result = $this->CI->$model->detail_list(); // A full user defined query result
  $grant_model_list_result = $this->CI->grants_model->detail_list($lookup_tables); // System generated query result

  $query_result = $grant_model_list_result;

  if(is_array($feature_model_list_result) && count($feature_model_list_result) > 0){
    $query_result = $feature_model_list_result;
  }

  return $query_result;
}

function detail_list_result($table){

  $result = $this->detail_list($table);
  $keys = $this->CI->grants_model->detail_list_select_columns();
  $has_details = $this->check_if_table_has_detail_table();

  return array(
    'keys'=> $keys,
    'table_body'=>$result,
    'table_name'=> $table,
    'has_details_table' => $has_details
  );
}

function view(){
  $model = $this->current_model;

  // Get the tables foreign key relationship
  $lookup_tables = $this->lookup_tables();

  // Get result from grants model if feature model list returns empty
  $feature_model_master_result = $this->CI->$model->view(); // A full user defined query result
  $grant_model_master_result = $this->CI->grants_model->view($lookup_tables); // System generated query result

  $query_result = $grant_model_master_result;

  if(is_array($feature_model_master_result) && count($feature_model_master_result) > 0){
    $query_result = $feature_model_master_result;
  }

  return $query_result;
}

function view_result(){

  return $this->view();
}

}

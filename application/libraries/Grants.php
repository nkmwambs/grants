<?php
/**
* The grants management system is a framework developed by Compassion Africa Regional Development team
* to help FCPs manage their finances. It an open framework that be easily be adopted by any grant managing
* organization.
*
* @author Nicodemus Karisa
* @package Grants Management System
* @copyright Compassion International Kenya
* @license https://compassion-africa.org/lisences.html
*
*/

defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Main system library
*
* @author Nicodemus Karisa
* @package Grants Management System
* @copyright Compassion International Kenya
* @license https://compassion-africa.org/lisences.html
*/

class Grants{

/**
* This is a variable carrying the instance for Codeigniter singleton class
* @var object
*/
private $CI;

/**
* This is the library for the current running master controller
* @var String
*/
private $current_library;

// This is the model for the current running master controller
private $current_model;

// This the current/ master detail table name which is equivalent to the running master controller
private $controller;

// This is the action that has been called by the running controllers. It can either be list, view, edit, add or delete
private $action;

// Active table
private $table;

// Feature model methods

private $false_keys_model_method = 'false_keys';

// master_table_visible_columns

private $master_table_visible_columns = [];

// list_table_visible_columns
private $list_table_visible_columns = [];

// detail_list_table_visible_columns
private $detail_list_table_visible_columns = [];

// detail_multi_form_add_visible_columns
private $detail_multi_form_add_visible_columns = [];

// master_multi_form_add_visible_columns
private $master_multi_form_add_visible_columns = [];

// single_form_add_visible_columns
private $single_form_add_visible_columns = [];

// detail_list
private $detail_list = [];

// Look up tables 
private $lookup_tables = [];

// Details tables
private $detail_tables = [];

private $master_view = [];


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

  $this->CI->load->library($this->current_library);
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

  if(method_exists($this->CI->$model,'lookup_tables')){
    $this->lookup_tables = $this->CI->$model->lookup_tables();
  }
  return $this->lookup_tables;
}


// This is wrapper method to the detail_tables of the specific feature model
// The detail_tables method holds the details referencing tables as array elements
// Passing an argument to this wrapper switches between the main feature model detail_tables to a certain details models

function detail_tables($table_name = ""){
  $model = $this->load_detail_model($table_name);

  if(method_exists($this->CI->$model,'detail_tables')){
    $this->detail_tables  = $this->CI->$model->detail_tables();
  }
  return $this->detail_tables;
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


/**
 *  check_if_table_has_detail_table
 * 
 * This method check if the selected table has any foreign table related to it. For example the center table
 * has foreign tables budget, request, reconciliation related to it.
 * 
 * @return Boolean
 */
function check_if_table_has_detail_table($table_name = ""){

    $table = $table_name == ""?$this->controller:$table_name;

    $all_detail_tables = $this->detail_tables($table);

    $has_detail_table = false;

    if(is_array($all_detail_tables) && count($all_detail_tables) > 0){
      $has_detail_table = true;
    }

    return $has_detail_table;
  }

  /**
   * check_if_table_has_detail_listing
   * 
   * This method checks if the selected table has xxxx_detail table related to it. For example the table
   * voucher has voucher_detail table as one of its foreign tables.
   * 
   * @return Boolean
   */

   function check_if_table_has_detail_listing($table_name = ""){

      $table = $table_name == ""?$this->controller:$table_name;

      $all_detail_tables = $this->detail_tables($table);

      $has_detail_table = false;

      if( is_array($all_detail_tables) && in_array($table.'_detail',$all_detail_tables) ){
        $has_detail_table = true;
      }

      return $has_detail_table;
    }

  /**
   * detail_row_fields
   * 
   * This method populates the cell values of the detail of the multi_form_add page.
   * It checks if there are any set changes in field type and implements them.
   * 
   * @return String
   */  
  function detail_row_fields($fields_array){

      $this->set_change_field_type($this->controller.'_detail');

      $fields = array();

      foreach ($fields_array as $key) {
        $f = new Fields_base($key,$this->controller.'_detail');

        $field_type = $f->field_type();

        $field = $field_type."_field";

        if(array_key_exists($key,$this->set_field_type)){

          $field_type = $this->set_field_type[$key]['field_type'];
          $field = $field_type."_field";
  
          if($field_type == 'select' && count($this->set_field_type[$key]['options']) > 0){
            $fields[$key] =  $f->select_field($this->set_field_type[$key]['options']);
          }else{
            $fields[$key] =  $f->$field();
          }

        }elseif($field_type == 'select'){
          $lookup_table = strtolower(substr($key,0,-5));
          $fields[$key] = $f->$field($this->CI->grants_model->lookup_values($lookup_table));
        }else{
          $fields[$key] = $f->$field();
        }

      }

      return $fields;
    }

    private $set_field_type = [];  

  /**
   * header_row_field
   * 
   * This method populates the single_form_add or master part of the multi_form_add pages.
   * It also checks if their is set_change_field_type of the current column from the feature library
   * 
   * @return String
   */
    
  function header_row_field($column){
      
      $f = new Fields_base($column,$this->controller,true);

      $this->set_change_field_type();
      
      $field_type = $f->field_type();

      $field = $field_type."_field";

      $lib = $this->current_library;

      if(array_key_exists($column,$this->set_field_type)){

        $field_type = $this->set_field_type[$column]['field_type'];
        $field = $field_type."_field";

        if($field_type == 'select' && count($this->set_field_type[$column]['options']) > 0){
          return $f->select_field($this->set_field_type[$column]['options']);
        }else{
          return $f->$field();
        }


      }elseif($field_type == 'select'){
        // $column has a _name suffix if is a foreign key in the table
        // This is converted from fk_xxxx_id where xxxx is the primary table name
        $lookup_table = strtolower(substr($column,0,-5));
        return $f->$field($this->CI->grants_model->lookup_values($lookup_table));
      }elseif(strrpos($column,'_is_active') == true ){
        return $f->select_field(array(get_phrase('yes'),get_phrase('no')));
      }else{
        return $f->$field();
      }

  }

  /**
   * set_change_field_type
   * 
   * This method checks if the feature library has the method change_field_type and if present get the 
   * array return values. The array is in the format of : 
   * array('column_name'=>array('field_type'=>$new_field_type,'options'=>$options)) where options is only set for select field type
   * 
   * @return Array 
   */
  function set_change_field_type($detail_table = ""){

    // Aray format for the change_field_type method in feature library: 
    //array('field_type'=>$new_type,'options'=>$options);

    $library = $this->controller.'_library';

    if($detail_table !== ""){
      $this->CI->load->library($detail_table.'_library');
      $library = $detail_table.'_library';
    }

    if( method_exists($this->CI->$library,'change_field_type') && 
        is_array($this->CI->$library->change_field_type())
      ){
      
        $this->set_field_type = $this->CI->$library->change_field_type();

    }

    return $this->set_field_type;

  }


  function false_keys($detail_table){
  $model = $this->load_detail_model($detail_table);

  $false_keys = array();

  if(method_exists($this->CI->$model,$this->false_keys_model_method)){
      $false_keys = $this->CI->$model->false_keys();
  }

  return $false_keys;
}


  
// Visible Columns methods

function detail_list_table_visible_columns($table){
  $model = $this->load_detail_model($table);

  if(method_exists($this->CI->$model,'detail_list_table_visible_columns')){
    $this->detail_list_table_visible_columns = $this->CI->$model->detail_list_table_visible_columns();

    //Add the table id columns if does not exist in $columns
    if(is_array($this->detail_list_table_visible_columns) && !in_array($table.'_id',$this->detail_list_table_visible_columns)){
      array_unshift($this->detail_list_table_visible_columns,$table.'_id');
    }

  }

  return $this->detail_list_table_visible_columns;
}

function list_table_visible_columns(){
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'list_table_visible_columns')){
    $this->list_table_visible_columns = $this->CI->$model->list_table_visible_columns();

     //Add the table id columns if does not exist in $columns
    if(is_array($this->list_table_visible_columns) && !in_array($this->controller.'_id',$this->list_table_visible_columns)){
      array_unshift($this->list_table_visible_columns,$this->controller.'_id');
    }
  }

  return $this->list_table_visible_columns;

}

function master_table_visible_columns(){
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'master_table_visible_columns')){
    $this->master_table_visible_columns = $this->CI->$model->master_table_visible_columns();

    //Add the table id columns if does not exist in $columns
    if(is_array($this->master_table_visible_columns) && !in_array($this->controller.'_id',$this->master_table_visible_columns)){
      array_unshift($this->master_table_visible_columns,$this->controller.'_id');
    }

  }

  return $this->master_table_visible_columns;
}

function detail_multi_form_add_visible_columns($table){
  $model = $this->load_detail_model($table);

  if(method_exists($this->CI->$model,'detail_multi_form_add_visible_columns')){
    $this->detail_multi_form_add_visible_columns = $this->CI->$model->detail_multi_form_add_visible_columns();
  }

  return $this->CI->$model->detail_multi_form_add_visible_columns();
}


function master_multi_form_add_visible_columns(){
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'master_multi_form_add_visible_columns')){
    $this->master_multi_form_add_visible_columns =  $this->CI->$model->master_multi_form_add_visible_columns();
  }
  return $this->master_multi_form_add_visible_columns;
}

function single_form_add_visible_columns(){
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'single_form_add_visible_columns')){
    $this->single_form_add_visible_columns = $this->CI->$model->single_form_add_visible_columns();
  }
  return $this->single_form_add_visible_columns;
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

/**
 * show_add_button
 * 
 * This method controls the toggle of the add button in the view and list action pages
 * It tries to check if the method show_add_button exists in the feature model and has a return of
 * true or false. If true the add button will be shown else hidden
 * 
 * @return Boolean
 * 
 */

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

/**
 * mandatory_fields
 * 
 * This method adds mandatory fields in a table. All tables should contain the following fields:
 * xxxx_created_date, xxxx_created_by, xxxx_last_modified_date, xxxx_last_modified_by, fk_approval_id and
 * fk_status_id
 * 
 * Again the approve_item table should contain the name of the table as approvable item and create a default 
 * new status of this table in the status table. Give this new status an status_approval_sequence of 1
 * 
 * @return void
 */

function mandatory_fields($table){

  if($table!=='approval'){
      //Mandatory Fields: created_by, created_date,last_modified_by,last_modified_date,fk_approval_id,fk_status_id
      $mandatory_fields = array($table.'_created_date',$table.'_created_by',$table.'_last_modified_by',
      $table.'_last_modified_date','fk_approval_id','fk_status_id');

      // Check if the table is in the approveable items table if not create it
      $approve_items = $this->CI->db->get_where('approve_item',array('approve_item_name'=>$table));

      $approve_item_id = 0;

      if($approve_items->num_rows() == 0){
        $data['approve_item_name'] = $table;
        $data['approve_item_is_active'] = 0;
        $data['approve_item_created_date'] = date('Y-m-d');
        $data['approve_item_created_by'] = $this->CI->session->user_id;
        $data['approve_item_last_modified_by'] = $this->CI->session->user_id;

        $this->CI->db->insert('approve_item',$data);

        $approve_item_id = $this->CI->db->insert_id();

      }else{
        $approve_item_id = $approve_items->row()->approve_item_id;
      }

      // Check is the the table has a status with status_approval_sequence 1 if not create it with status name

      $status = $this->CI->db->get_where('status',array('fk_approve_item_id'=>$approve_item_id,'status_approval_sequence'=>1));

      $status_id = 0;

      if($status->num_rows() == 0){
        $status_data['status_name'] = get_phrase('new');
        $status_data['status_action_label'] = "";
        $status_data['fk_approve_item_id'] = $approve_item_id;
        $status_data['status_approval_sequence'] = 1;
        $status_data['status_approval_direction'] = 1;
        $status_data['status_is_requiring_approver_action'] = 0;
        $status_data['fk_role_id'] = $this->CI->session->role_id;
        $status_data['status_created_date'] =  date('Y-m-d');
        $status_data['status_created_by'] = $this->CI->session->user_id;
        $status_data['status_last_modified_by']  = $this->CI->session->user_id;

        $this->CI->db->insert('status',$status_data);

        $status_id = $this->CI->db->insert_id();

      }

      // Check if the mandatory fields exists in the listed table and if not alter the table by 
      // adding a column with default value as the newly inserted status_id

      $fields_to_add = array();

      $table_fields = $this->CI->grants_model->get_all_table_fields($table);

      foreach ($mandatory_fields as $mandatory_field) {
        if(!in_array($mandatory_field,$table_fields)) {

          if(substr($mandatory_field,0,3) == 'fk_' || substr($mandatory_field,-3,3) == '_by'){
            $fields_to_add[$mandatory_field]['type'] = 'INT';
            $fields_to_add[$mandatory_field]['constraint'] = '100';
          }elseif(strpos($mandatory_field,'_date') == true){
            $fields_to_add[$mandatory_field]['type'] = 'date';
            //$fields_to_add[$mandatory_field]['constraint'] = '100';
          }else{
            $fields_to_add[$mandatory_field]['type'] = 'varchar';
            $fields_to_add[$mandatory_field]['constraint'] = '100';
          }

        }
      }

      if(count($fields_to_add) > 0){
        $this->CI->load->dbforge();
        $this->CI->dbforge->add_column($table, $fields_to_add);
      }
  }
}




// Query result for list tables

/**
 * detail_list_query
 * 
 * This is query result of the detail table. The result of this method will be used in the view_output
 * to create the detail list
 * 
 * @return array
 * 
 */
function detail_list_query($table){
  $model = $this->load_detail_model($table);

  if(method_exists($this->CI->$model,'detail_list_query_result') && 
      is_array($this->CI->$model->detail_list_query()) &&
      count($this->CI->$model->detail_list_query()) > 0
    ){
      $this->detail_list = $this->CI->$model->detail_list_query(); // A full user defined query result
  } else{
      $this->detail_list = $this->CI->grants_model->detail_list_query($table); // System generated query result
  }

  return $this->detail_list;
}


/**
 * approveable_item
 * 
 * This method returns the true if the table id passed is in the approve_item with 
 * the value of approve_item_is_active as 1 otherwise false. A true item is approveable
 * 
 * @return boolean
 * 
 */

function approveable_item($detail_table = ""){
  return $this->CI->grants_model->approveable_item($detail_table);
}


/**
 * center_start_date
 * 
 * This is a wrapper method of the grants_model that returns the center start date
 * 
 * @return date
 */

function center_start_date($center_id){
  return $this->CI->grants_model->center_start_date($center_id);
}


// The output methods below are the entry points for all loading pages in this framework
// We have the following _output methods: list_output, view_output, single_form_add_output 
// and multi_form_add_output

/**
 * list oputput
 * 
 * This method returns the output of the list action views
 * 
 * @return array 
 */
function list_output(){

  $table = $this->controller;

  $this->mandatory_fields($table);

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

/**
 * detail_list_view
 * 
 * This method creates an array to be used in the view_output. It used to construct the table array_result
 * of each detail table
 * 
 * @return array
 * 
 */
function detail_list_view($table){

  // Query result of the detail table
  $result = $this->detail_list_query($table);

  // Selected column of the detail table
  $keys = $this->CI->grants_model->detail_list_select_columns($table);

  // Check if the detail table has also other detail tables. 
  // It makes its track number a link in the view if true
  $has_details = $this->check_if_table_has_detail_table($table);

  // It check if the detail table is approveable so as to show the approval links in the status action
  $is_approveable_item = $this->approveable_item($table);

  // Check if the add button is allowed to be shown
  $show_add_button = $this->show_add_button($table);

  // Checks if the detail table has a detail table to it
  $has_details_listing = $this->check_if_table_has_detail_listing($table);

  return array(
    'keys'=> $keys,
    'table_body'=>$result,
    'table_name'=> $table,
    'has_details_table' => $has_details,
    'has_details_listing' => $has_details_listing,
    'is_approveable_item' => $is_approveable_item,
    'show_add_button'=>$show_add_button
  );
}

/**
 * master_view
 * 
 * This method provide the value of the table_body key of the master outer key of the view_output method
 * 
 * @return array
 *  
 */

function master_view(){
  $model = $this->current_model;

  // Get result from grants model if feature model list returns empty

  if(method_exists($this->CI->$model,'master_view') &&
      is_array($this->CI->$model->master_view()) && 
      count($this->CI->$model->master_view()) > 0 
  ){
    
    $this->master_view = $this->CI->$model->master_view();
  
  }else{
    $this->master_view = $this->CI->grants_model->master_view();
  }


  return $this->master_view;
}

/**
 * view_output
 * 
 * This method returns the output of all view action views
 * 
 * @return array
 * 
 */

function view_output(){
  $table = $this->controller;

  $this->mandatory_fields($table);

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

/**
 * 
 * single_form_add_output
 * 
 * This method returns the output of all single add forms and also receives the post of the same forms
 * 
 * @return array
 * 
 */

function single_form_add_output($table_name = ""){

  $table = $table_name == ""?$this->controller:$table_name;


  if($this->CI->input->post()){
    //$this->CI->grants_model->add($this->CI->input->post());
    $model = $this->current_model;

    if(method_exists($this->CI->$model,'add')){
      $this->CI->$model->add();
    }else{
      $this->CI->grants_model->add();
    }
  }else{
    $this->mandatory_fields($table);

    $keys = $this->CI->grants_model->single_form_add_visible_columns();

    return array(
      'keys'=>$keys
    );
  }

}

/**
 * 
 * multi_form_add_output
 * 
 * This method returns the output of the multi add form and receives the post of the same form
 * 
 * @return array
 * 
 */

function multi_form_add_output($table_name = ""){

  $table = $table_name == ""?$this->controller:$table_name;

  //$this->mandatory_fields($table);

  if($this->CI->input->post()){
    $model = $this->current_model;

    if(method_exists($this->CI->$model,'add')){
      $this->CI->$model->add();
    }else{
      $this->CI->grants_model->add();
    }
  }else{
    $this->mandatory_fields($table);

    $keys = $this->CI->grants_model->master_multi_form_add_visible_columns();
    $detail_table_keys = $this->CI->grants_model->detail_multi_form_add_visible_columns($table.'_detail');
    $false_keys = $this->false_keys($table.'_detail');

    return array(
      'keys'=>$keys,
      'detail_table'=>$detail_table_keys,
      'detail_false_keys'=>$false_keys
    );
  }

}

/**
 * edit_output
 * 
 * This method provides the output of the edit form and receieves its post
 * 
 * @return array
 */

function edit_output(){
  
}


// These are methods that require review


function display_approver_status_action($status_id, $table = ""){
  return $this->CI->grants_model->display_approver_status_action($status_id, $table);
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
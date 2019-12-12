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

/**
 * This is the model for the current running master controller
 * @var String
 */
private $current_model;

/**
 * This the current/ master detail table name which is equivalent to the running master controller
 * @var String
 */
private $controller;

/**
 * This is the action that has been called by the running controllers. It can either be list, view, edit, add or delete
 * @var String
 */
private $action;

/**
 * Active table
 * @var String
 */
private $table;

/**
 * Hold an array that is used to switch fields in the details of the multi_form_add action pages
 * @var String
 */
private $false_keys_model_method = 'false_keys';

/**
 * detail_multi_form_add_visible_columns holds the selected fields of the detail part of the 
 * multi_form_add action pages
 * @var String
 */
private $detail_multi_form_add_visible_columns = [];

/**
 * master_multi_form_add_visible_columns holds selected fields for the master part of the 
 * multi_form_add action pages
 * @var Array
 */
private $master_multi_form_add_visible_columns = [];

/**
 * Details tables array of the active table
 * @var Array
 */
private $detail_tables = [];


/**
 * Holds the change field type array from the feature library
 * @var Array
 */
private $set_field_type = [];  
/**
 * __construct
 * 
 * This is the construct to this class. It sets the following:
 * 
 * - The CI Instance
 * - Laod the main library and model
 * - Sets the active table ($this->controller)
 * - Set the active action ($this->action)
 * 
 * @return Void
 */

//public static $context_table = 'center_group_hierarchy';
//public static $office_table = 'center';


function __construct(){

  // Instantiate Codeigniter Singleton class
  $this->CI =& get_instance();

  $this->CI->load->add_package_path(APPPATH.'third_party/Packages/Core');
  $this->CI->load->add_package_path(APPPATH.'third_party/Packages/Grants');

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
  $this->CI->load->model('autoloaded/grants_model');

  // Loading the main feature library
  $this->CI->load->library($this->current_library);
}

function create_table_join_statement($table, $lookup_tables){
  return $this->CI->grants_model->create_table_join_statement($table, $lookup_tables);
}

function where_condition($condition_type,...$args){
  // Currently works with centers and page_view args
  $condition_method = $condition_type.'_where_condition';

  return $this->CI->grants_model->$condition_method(...$args);
}

function get_centers_in_center_group_hierarchy($user_id){
  return $this->user_model->get_centers_in_center_group_hierarchy($user_id);

}

// function centers_where_condition(){
//   return $this->CI->grants_model->centers_where_condition();
// }

// function page_view_condition(){
//   return $this->CI->grants_model->page_view_condition();
// }

/**
 * load_detail_model
 * 
 * This method helps to reload the detail table/ foreign table model. It can be used to toggle models
 * It returns the toggled model name
 * It creates missing libs, models and controllers
 * 
 * @param $table_name String : The table to toggle a model to
 *  
 * @return String
 */
function load_detail_model(String $table_name = ""): String{
  $model =  $this->current_model;

  if($table_name !== "" && !is_array($table_name)){
    
    if(!file_exists(APPPATH.'controllers'.DIRECTORY_SEPARATOR.$table_name.'.php') && 
      $this->CI->grants_model->table_exists($table_name)){
      // Creates missing models, libraries or controllers based on a missing controller 
      // but only when the database table exists
      $assets_temp_path = FCPATH.'assets'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
      
      $this->create_missing_model(ucfirst($table_name),$assets_temp_path,array('status','approval'));
      $this->create_missing_library(ucfirst($table_name),$assets_temp_path);
      $this->create_missing_controller(ucfirst($table_name),$assets_temp_path);   
    }
    
    $model = $table_name.'_model';
    
    try{
      $this->CI->load->model($model);
    }catch(Exception $e){
      $message = "Unabled to load the specified model ".$model." in Grants Library as indicated in the detail_tables function of the ".$this->controller."_model </br>";
      $message .= "Verify if the table ".$table_name." exists and if the file ".$model." is present in the third_party Packages Core or Grants models";
      show_error($message,500,'An Error Was Encountered');
    }
    
    
  }

  return $model;
}

/**
 * lookup_tables
 * 
 * This method is a wrapper to the lookup_tables method of the specific feature model
 * The lookup_tables method holds the lookup referencing tables as array elements
 * Passing an argument to this method wrapper switches between the lookup tables of the main 
 * feature model to a certain details model
 * 
 * @param $table_name String : The table to check it's lookup tables for
 * 
 * @return Array
 */
function lookup_tables(String $table_name = ""): Array{
  $model = $this->load_detail_model($table_name);

  $lookup_tables =  array();

  if(method_exists($this->CI->$model,'lookup_tables') && 
      is_array($this->CI->$model->lookup_tables())
    ){
    $lookup_tables = $this->CI->$model->lookup_tables();
  }

  return $lookup_tables;
}

/**
 * dependant_table
 * 
 * This method checks if a dependant_table is set in the feature model. A dependant table is a special
 * detail table that can only be filled depending on the master table (Both are filled at the same time by the user)
 * 
 * It implements the backward compatlibilty checking wether the legacy way of naming dependant tables has been 
 * adhered to i.e. a suffix of _detail to the table name
 * 
 * @param String $table_name : Selected table acting as the master
 * @return String : Dependant table 
 */
public function dependant_table($table_name = ""){

  $model = $this->load_detail_model($table_name);

  $dependant_table = "";

  if(property_exists($this->CI->$model,'dependant_table')){
      $dependant_table = $this->CI->$model->dependant_table;
  }elseif($this->CI->grants_model->table_exists($table_name."_detail")){
    //Legacy way of implementing dependancy table was to create a table suffixed with _detail.
    // This part checks if this has been implemented if the dependant_table property is not defined
      $dependant_table = $table_name."_detail";
  }

  return $dependant_table; 
}
/**
 * primary_key_field
 * 
 * This method retrieves the primary key field of the selected table
 * 
 * @param String $table_name - Selected table
 * @return String - Primary key field
 */
public function primary_key_field(String $table_name):String {
  
  $metadata = $this->CI->grants_model->table_fields_metadata($table_name);

  $primary_key_field = "";

  foreach($metadata as $data){
    if($data->primary_key == 1){
      $primary_key_field = $data->name;
    }
  }

  return $primary_key_field;
}

function default_unset_columns(&$visible_columns, $fields_to_unset){
  
  foreach($fields_to_unset as $field){
    if(in_array($field, $visible_columns)){
      unset($visible_columns[array_search($field,$visible_columns)]);
    }
  }

  return $visible_columns;
}

/**
 * is_primary_key_field
 * 
 * Check if a supplied field for a table is a primary key field
 * @param String $table_name - The name of a table to check
 * @param String $field - Field to check from the table
 * 
 * @return Bool - True if Primary Key field else false
 */
function is_primary_key_field(String $table_name, String $field):Bool{
  
  $is_primary_key_field = false;

  $metadata = $this->CI->grants_model->table_fields_metadata($table_name);

  foreach($metadata as $data){
    if($data->primary_key == 1 && $data->name == $field){
      $is_primary_key_field = true;
    }
  }

   return $is_primary_key_field; 
}

/**
 * name_field
 * 
 * Gets the name field of a selected table. It does this by checking it the feature model property name_field
 * exists, if not it will check on the legacy naming convention of siffixing name fields with _name
 * 
 * @param String $table_name : Selected table name
 * @return String - Table name field
 */
public function name_field(String $table_name = ""):String {
  
  $model = $this->load_detail_model($table_name);
   
  $name_field = "";

  if(property_exists($this->CI->$model,'name_field')){
    $name_field = $this->CI->$model->name_field;
  }else{
    $fields = $this->CI->grants_model->get_all_table_fields($table_name);

    if(in_array($table_name.'_name',$fields)){
      $name_field = $table_name.'_name';
    }
    
  }

  return $name_field;

}

/**
 * history_tracking_field
 * 
 * Checks for the field name of the history fields from the feature model property if it exists
 * 
 * History tracking fields are: track_number, deleted_at, created_date, last_modified_date, created_by and 
 * last_modified_by
 * 
 * It returns the legacy naming if the feature property doesn't exists, otherwise empty string
 * 
 * @param String $table_name - Table to select
 * @param String $history_type - Can either be deleted_at, created_date, last_modified_date, 
 * created_by or last_modified_by
 * 
 * @return String - History field name
 */
public function history_tracking_field(String $table_name,String $history_type): String {

  $model = $this->load_detail_model($table_name);

  $history_type_field = "";

  if(property_exists($this->CI->$model,$history_type.'_field') ){
    $property = $history_type.'_field';
    $history_type_field = $this->CI->$model->$property;
  }else{
    $fields = $this->CI->grants_model->get_all_table_fields($table_name);

    if(in_array($table_name.'_'.$history_type,$fields)){
      $history_type_field = $table_name.'_'.$history_type;
    }
  }

  return $history_type_field;

}

/**
 * 
 */
public function is_history_tracking_field(String $table_name, String $column, String $history_type = ""){

  $is_history_tracking_field = false;

  //Helps to prevent the use of invalid history tracking fields
  $template_history_types = array('track_number','created_date','created_by','last_modified_date','last_modified_by','deleted_at');

  //foreach($history_types as $history_type){

    if($history_type != "" && in_array($history_type,$template_history_types)){
      $history_tracking_field = $this->history_tracking_field($table_name,$history_type);

      if($column == $history_tracking_field){
        $is_history_tracking_field = true;
      }
    }else{
      // Used when type is not passed. Uses strict column naming
        foreach($template_history_types as $template_history_type){
          if($column == $table_name.'_'.$template_history_type){
            $is_history_tracking_field = true;
          }
        }
    }

  //}

  return $is_history_tracking_field;

}

function unset_lookup_tables_ids(&$keys,$table_name = ""){
  
  $model = $this->load_detail_model($table_name);
  $lookup_tables = $this->CI->$model->lookup_tables();

    // Unset the lookup id keys
    $unset_fields = [];
    if(is_array($lookup_tables) && count($lookup_tables) > 0){
      foreach($lookup_tables as $table){
        if($field = $this->primary_key_field($table)){
          array_push($unset_fields, $field);
        }
      }
    }

    $this->default_unset_columns($keys,$unset_fields);
}

/**
 * tables_name_fields
 * 
 * Get name fields of the supplied tables
 * @param Array $tables - Tables to get name fields for
 * @return Array - Name fields array
 */
function tables_name_fields(Array $tables):Array{
  $table_name_fields = [];
  if(is_array($tables) && count($tables) > 0){
    foreach($tables as $table){
      array_push($table_name_fields,$this->CI->grants->name_field($table));
    }
  }

  return $table_name_fields;
}


/**
 * is_name_field
 * 
 * Checks if a field passed is a name field of the passed table
 * 
 * @param String $table - Table to check a column from
 * @param String $column - Column to check if name field
 * @return Boolean - True if name field else false
 */
public function is_name_field($table,$column){
  
  $table_name_field = $this->name_field($table);
  
  $is_name_field = false;

  if(strtolower($table_name_field) == strtolower($column)){
    $is_name_field = true;
  }

  return $is_name_field;
}

/**
 * is_lookup_tables_name_field
 * 
 * This method checks a passed column if its a name field of any of the passed table lookup_tables
 * If it finds it in any of the lookup tables, it can return a true bool if the 3rd argument $return_lookup_table
 * is set to false (Default) or return the name of the lookup table with that posseses the passed column
 * as its name field.
 * 
 * @param String $master_table - Table to iterate its lookup tables
 * @param String $column - The column/field to check for
 * @param Boolean $return_lookup_table - Toogle what to be returned, if true returns bool else the name of 
 * the lookup table with the passed column as its name field
 * 
 * @return Mixed - Can either be Bool or the name of a lookup table
 */
public function is_lookup_tables_name_field($master_table,$column, $return_lookup_table = false ){
  
  $lookup_tables = $this->lookup_tables($master_table);
  
  $is_name_field = false;
  
  $table_to_return = null;

  if( is_array($lookup_tables) && count($lookup_tables) > 0 ){
    foreach($lookup_tables as $lookup_table){
      if($this->is_name_field($lookup_table,$column)){
        $is_name_field = true;
        $table_to_return = $lookup_table;
      }
    }
  }

  if($return_lookup_table){
    return $table_to_return;
  }else{
    return $is_name_field;
  }
  
}

/**
 * detail_tables
 * 
 * This is wrapper method to the detail_tables of the specific feature model
 * The detail_tables method holds the details referencing tables as array elements
 * Passing an argument to this wrapper switches between the main feature model 
 * detail_tables to a certain details models
 * 
 * It helps to nullify the use of the detail_tables feature method if the parameter dependant_table in the 
 * feature model is set
 * 
 * This method also specifies how the approval list should list its detail tables. The detail tables should
 * be listed one by one depending on the one selected on the list action page of the approval listing
 * 
 * @param $table_name String : The table to check detail tables for
 * 
 * @return Array
 */
function detail_tables(String $table_name = ""): Array {
  $model = $this->load_detail_model($table_name);

  
  if($this->controller == 'approval' && $this->action == 'view'){
    // This is specific to approval view, only to list the detail listing of the select approveable 
    // items
    $id = $this->CI->uri->segment(3,0);

    // This line needs to be moved to a model
    $this->CI->db->join('approve_item','approve_item.approve_item_id=approval.fk_approve_item_id');
    $detail_table = $this->CI->db->get_where('approval',
    array('approval_id'=>hash_id($id,'decode')))->row()->approve_item_name;
    
    $this->detail_tables = array($detail_table);

  }elseif($this->dependant_table($table_name) !== "" ){
    // If dependant_table exists, you can't have more than one detail table. This piece nullifies the use
    // of the detail_tables feature model if is set
    $this->detail_tables[] = $this->dependant_table($table_name);

  }elseif(method_exists($this->CI->$model,'detail_tables') && 
      is_array($this->CI->$model->detail_tables()) 
    ){
    
      $this->detail_tables  = $this->CI->$model->detail_tables();
  
    }

  return $this->detail_tables;
}

/**
 * unset_default_hidden_coulumns  
 * 
 * This function allows unsetting default hidden columns. It's callable from specific model
 * Example:$columns_to_show =  array('funder_created_date','funder_last_modified_date');
 * Unset default hidden columns
 * return $this->grants->unset_default_hidden_columns($default_hidden_columns,$columns_to_show)
 * 
 * @param $default_hidden_columns Array : Array of the hidden columns
 * @param $columns_to_unset Array : Array of columns to Unset
 * 
 * @return Array
 */
function unset_default_hidden_columns(Array $default_hidden_columns,Array $columns_to_unset): Array {
  foreach ($columns_to_unset as $column_to_unset) {
    $unset_default_hidden_column = in_array($column_to_unset,$default_hidden_columns);
    unset($default_hidden_columns[$unset_default_hidden_column]);
  }

  return $default_hidden_columns;
}

/**
 * add_default_hidden_columns
 * 
 * This function allows to add more hidden columns. Callable from a specific model
 * Example:$columns_to_hide = array('funder_description');
 * return $this->grants->add_default_hidden_columns($default_hidden_columns,$columns_to_hide) 
 * 
 * @param $default_hidden_columns Array : Original hidden columns array
 * @param $columns_to_hide Array : Array of Additional columns to be hidden 
 * 
 * @return Array
 */
function add_default_hidden_columns(Array $default_hidden_columns,Array $columns_to_hide): Array{
  foreach ($columns_to_hide as $column_to_hide) {
    array_push($default_hidden_columns,$column_to_hide);
  }

  return $default_hidden_columns;
}

/**
 * get_all_table_fields
 * 
 * The method returns all fields names of the selected table. It's a wrapper method from grants model
 *  
 * @param $table_name String : The selected table
 * 
 * @return Array
 */
function get_all_table_fields(String $table_name = ""): Array {
  return $this->CI->grants_model->get_all_table_fields($table_name);
}


/**
 *  check_if_table_has_detail_table
 * 
 * This method check if the selected table has any foreign table related to it. For example the center table
 * has foreign tables budget, request, reconciliation related to it.
 * 
 * @param $table_name String : The selected table
 * 
 * @return boolean 
 */
function check_if_table_has_detail_table(String $table_name = ""): Bool {

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
   * @param $table_name String : The selected table
   * 
   * @return Boolean
   */

   function check_if_table_has_detail_listing(String $table_name = ""): Bool{

      $table = $table_name == ""?$this->controller:$table_name;

      $all_detail_tables = $this->detail_tables($table);

      $has_detail_table = false;

      if( is_array($all_detail_tables) && in_array($this->dependant_table($table),$all_detail_tables) ){
        $has_detail_table = true;
      }

      return $has_detail_table;
    }

/**
 * THE BELOW METHODS ARE TO MOVE TO THE OUTPUT API CLASSES
 */


  /**
   * detail_row_fields
   * 
   * This method populates the cell values of the detail of the multi_form_add page.
   * It checks if there are any set changes in field type and implements them.
   * 
   * @param $fields_array String : Array of table fields
   * 
   * @return String
   */  
  function detail_row_fields(Array $fields_array): Array {

      // Field type changes for the dependant table
      $this->set_change_field_type($this->dependant_table($this->controller));

      $fields = array();

      foreach ($fields_array as $key) {
        
        $f = new Fields_base($key,$this->dependant_table($this->controller));

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
          $fields[$key] = $f->$field($this->lookup_values($lookup_table));
        }else{
          $fields[$key] = $f->$field();
        }

      }

      return $fields;
    }

  /**
   * header_row_field
   * 
   * This method populates the single_form_add or master part of the multi_form_add pages.
   * It also checks if their is set_change_field_type of the current column from the feature library
   * 
   * @param $column String : A column from a table
   * @param $field_value Mixed : Value of the field mainly from edit form
   * @param bool $show_only_selected_value
   * @return String
   */
    
  function header_row_field(String $column, String $field_value = "", bool $show_only_selected_value = false): String {

      $f = new Fields_base($column,$this->controller,true);

      $this->set_change_field_type();
      
      $field_type = $f->field_type();

      $field = $field_type."_field";

      $lib = $this->current_library;

      if(array_key_exists($column,$this->set_field_type)){

        $field_type = $this->set_field_type[$column]['field_type'];
        $field = $field_type."_field";

        if($field_type == 'select' && count($this->set_field_type[$column]['options']) > 0){
          return $f->select_field($this->set_field_type[$column]['options'], $field_value);
        }else{
          return $f->$field($field_value);
        }


      }elseif($field_type == 'select'){
        // $column has a _name suffix if is a foreign key in the table
        // This is converted from fk_xxxx_id where xxxx is the primary table name
        $lookup_table = strtolower(substr($column,0,-5));
        return $f->$field($this->lookup_values($lookup_table), $field_value,$show_only_selected_value);
      }elseif(strrpos($column,'_is_') == true ){
        return $f->select_field(array(get_phrase('no'),get_phrase('yes')), $field_value);
      }else{
        return $f->$field($field_value);
      }

  }

/**
 * add_form_fields
 * 
 * This method builds the add form (single form add or multi form add - master part) fields. 
 * It builds the columns names as keys anf the field html as the value in an associative array
 * 
 * @param $visible_columns_array Array : Columns to be selected
 * 
 * @return Array
 */
function add_form_fields(Array $visible_columns_array): Array {

  $fields = array();

  foreach ($visible_columns_array as $column) {
    
    // Used to set the default select value in a single_form_add name fields if the form has been opened from a 
    // parent record
    $field_value = '';
    $show_only_selected_value = false;

    if($this->CI->id != null  && hash_id($this->CI->id,'decode')>0 && $column == $this->CI->sub_action.'_name'){
      $field_value = hash_id($this->CI->id,'decode');
      $show_only_selected_value = true;
    }
    
    $fields[$column] = $this->header_row_field($column,$field_value,$show_only_selected_value);
  }

  return $fields;  
}


function edit_form_fields(Array $visible_columns_array): Array {

  $fields = array();
  
  foreach ($visible_columns_array as $column => $value) {
    // Preventing pass null values to avoid conflict with the header_row_field arg 2 which is string type
    if($value != null){
      $fields[$column] = $this->header_row_field($column, $value);
    }
    
  }

  return $fields;  
}

  /**
   * set_change_field_type
   * 
   * This method checks if the feature library has the method change_field_type and if present get the 
   * array return values. The array is in the format of : 
   * array('column_name'=>array('field_type'=>$new_field_type,'options'=>$options)) where options is only set for select field type
   * 
   * @param $detail_table String : Selected table  
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


  
/**
 * detail_multi_form_add_visible_columns
 * 
 * Gives an array of the fields to be selected in detail part of a multi_form_add action pages
 * 
 * @param $table String : The selected table
 * 
 * @return Array
 */
function detail_multi_form_add_visible_columns($table){
  $model = $this->load_detail_model($table);

  if(method_exists($this->CI->$model,'detail_multi_form_add_visible_columns') &&
    is_array($this->CI->$model->detail_multi_form_add_visible_columns())
  ){
    $this->detail_multi_form_add_visible_columns = $this->CI->$model->detail_multi_form_add_visible_columns();
  }

  return $this->CI->$model->detail_multi_form_add_visible_columns();
}

/**
 * master_multi_form_add_visible_columns
 * 
 * Returns an array of the selected fields/ columns of the master part of the multi_form_add action pages
 * 
 * @return Array
 * 
 */
function master_multi_form_add_visible_columns() {
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'master_multi_form_add_visible_columns') &&
      is_array($this->CI->$model->master_multi_form_add_visible_columns())
  ){
    $this->master_multi_form_add_visible_columns =  $this->CI->$model->master_multi_form_add_visible_columns();
  }
  return $this->master_multi_form_add_visible_columns;
}

/**
 * single_form_add_visible_columns
 * 
 * Return an array of the selected fields/ columns of the single_form_add action pages
 * It is a model wrapper method that is used in the grants_model single_form_add_visible_columns
 * and not directly in this class
 * @return Array
 */
function single_form_add_visible_columns(){
  $model = $this->current_model;
  
  $single_form_add_visible_columns = array();

  if(method_exists($this->CI->$model,'single_form_add_visible_columns') && 
      is_array($this->CI->$model->single_form_add_visible_columns())
  ){
    $single_form_add_visible_columns = $this->CI->$model->single_form_add_visible_columns();
  }
  return $single_form_add_visible_columns;
}

function edit_visible_columns(){
  $model = $this->current_model;

  $edit_visible_columns = array();

  if(method_exists($this->CI->$model,'edit_visible_columns') && 
      is_array($this->CI->$model->edit_visible_columns())
  ){
    $edit_visible_columns = $this->CI->$model->edit_visible_columns();
  }
  return $edit_visible_columns;
}

function get_users_with_center_group_hierarchy_name($center_group_hierarchy_name){
  $options = array();
    $result = $this->CI->user_model->get_users_with_center_group_hierarchy_name($center_group_hierarchy_name);

    if(count($result)>0){
      $user_ids = array_column($result,'user_id');
      $user_names = array_column($result,'user_name');

      $options =  array_combine($user_ids,$user_names);
    }
    
    return $options;
}

/**
 * update_query_result_for_fields_changed_to_select_type
 * 
 * This method checks if there is any changed field type to select type in the feature library and updates
 * the results from the database with the correct option value as set by the change_field_type options
 * parameter in the lib
 * 
 * @param $table String : The selected table
 * @param $query_result  Array : Original query result from the database table
 * 
 * @return Array
 */

function update_query_result_for_fields_changed_to_select_type(String $table, Array $query_result): Array {
  // Check if there is a change of field type set and update the results
  $changed_field_type = $this->set_change_field_type($table);
  
  if(count($this->set_field_type) > 0){

    //Get changed columns 
    $changed_fields = array_keys($this->set_field_type);

    if(!array_key_exists(0,$query_result)){
      // Used for single record pages e.g Master section 
      foreach($changed_fields as $changed_field){
        if(array_key_exists($changed_field,$query_result) && in_array('select',$this->set_field_type[$changed_field]) ){
          $query_result[$changed_field] = isset($this->set_field_type[$changed_field]['options'][$query_result[$changed_field]])?$this->set_field_type[$changed_field]['options'][$query_result[$changed_field]]:$query_result[$changed_field];
        }
      }
    }else{
      // Used for multi row data e.g. list and details sections
      foreach($query_result as $index => $row){

        foreach($changed_fields as $changed_field){
          if(array_key_exists($changed_field,$row) && in_array('select',$this->set_field_type[$changed_field]) ){
            // The isset check has been used to solve a problem where a field type of select is changed to the same select in order to alter the number of select options. 
            // This workaround is crucial on the detail list of view action pages, Most notably when using the group_country_user lib change_field_type
            $query_result[$index][$changed_field] = isset($this->set_field_type[$changed_field]['options'][$row[$changed_field]]) ? $this->set_field_type[$changed_field]['options'][$row[$changed_field]]:$row[$changed_field];
          }
        }
      }
    }
    

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
 * @param $table String : Selected table
 * 
 * @return Boolean
 * 
 */

function show_add_button(String $table = ""): Bool {

  $model = $this->current_model;

  if($table !==""){
    $model = $this->load_detail_model($table);
  }
  
  $show_add_button = true;

  $library = $this->controller.'_library';

  if(method_exists($this->CI->$model,'show_add_button')){
    $show_add_button = $this->CI->$model->show_add_button();
  }


  return $show_add_button;
}


// Query result for list tables



/**
 * approveable_item
 * 
 * This method returns the true if the table id passed is in the approve_item with 
 * the value of approve_item_is_active as 1 otherwise false. A true item is approveable
 * 
 * @param $detail_table String : The selected table
 * 
 * @return boolean
 * 
 */

function approveable_item($detail_table = ""): Bool {
  return $this->CI->grants_model->approveable_item($detail_table);
}


/**
 * center_start_date
 * 
 * This is a wrapper method of the grants_model that returns the center start date
 * 
 * @param $center_id  int : Selected Center 
 * 
 * @return String
 */

function center_start_date(int $center_id): String {
  return $this->CI->grants_model->center_start_date($center_id);
}


// The output methods below are the entry points for all loading pages in this framework
// We have the following _output methods: list_output, view_output, single_form_add_output 
// and multi_form_add_output


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
      echo $this->CI->$model->add();
    }else{
      echo $this->CI->grants_model->add();
    }
  }else{
    // Adds mandatory fields if not present in the current table
    $this->CI->grants_model->mandatory_fields($table);

    $visible_columns = $this->CI->grants_model->single_form_add_visible_columns();
    $fields = $this->add_form_fields($visible_columns);//$this->single_form_add_query();

    return array(
      'fields'=> $fields
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
      echo $this->CI->$model->add();
    }else{
      echo $this->CI->grants_model->add();
    }
  }else{
    $this->CI->grants_model->mandatory_fields($table);

    // Adds mandatory fields if not present in the current table
    $visible_columns = $this->CI->grants_model->master_multi_form_add_visible_columns();
    $fields = $this->add_form_fields($visible_columns);//$this->master_multi_form_add_visible_columns_query();

    // $keys = $this->CI->grants_model->master_multi_form_add_visible_columns();
    $detail_table_keys = $this->CI->grants_model->detail_multi_form_add_visible_columns($this->dependant_table($table));
    //print_r($detail_table_keys);
    //exit();
    $false_keys = $this->false_keys($this->dependant_table($table));

    return array(
      'fields'=>$fields,
      'detail_table'=>$detail_table_keys,
      'detail_false_keys'=>$false_keys,
      'dependant_table'=>$this->dependant_table($this->controller)
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
function edit_output($id = ""){

  $table = $this->controller;

  if($this->CI->input->post()){
    
    $model = $this->current_model;

    if(method_exists($this->CI->$model,'edit')){
      echo $this->CI->$model->edit($id);
    }else{
      echo $this->CI->grants_model->edit($id);
    }
  }else{
    $this->CI->grants_model->mandatory_fields($table);

    $edit_query = $this->edit_query($table);
    $fields = $this->edit_form_fields($edit_query);// Go this place

    return array(
      'fields'=>$fields
    );
  }

}

function edit_query($table){
  
  $keys = $this->CI->grants_model->edit_visible_columns();

  $edit_query = array();

  foreach($keys as $column => $value){
    if(strpos($column,'_id') == true && $column !== $table.'_id' ){
      $edit_query[substr($column,0,-3).'_name'] = $value;
    }else{
      $edit_query[$column] = $value;
    }

  }

  //print_r($edit_query);
  //exit();
  return $edit_query;
}

/**
 * check_role_has_field_permission
 * 
 * This method is a wrapper of the user_model check_role_has_field_permission method.
 * It helps to check if the logged user has permission to acccess a controlled field
 * Any field that has been flagged in the permission table is referred to as a controlled field
 * 
 * @todo - has been moved to access_base/ Delete it from here after all Output code moves to Output API
 * 
 * @param String $table - Selected table
 * @param String $permission_label - Can be 1 or 2
 * @param String $column - Selected column
 * @return Boolean
 */
function check_role_has_field_permission($table, $permission_label,$column){
  return $this->CI->user_model->check_role_has_field_permission(
    $table, $permission_label, $column
  );
}

/**
 * action_before_insert
 * 
 * A wrapper method to feature model serving the grants model add method
 * 
 * @param $post_array Array : Form post array
 * 
 * @return Array
 * 
 */
function action_before_insert($post_array): Array {
  
  $model = $this->current_model;

  $updated_post_array = array();

  if(method_exists($this->CI->$model,'action_before_insert')){
    $updated_post_array = $this->CI->$model->action_before_insert($post_array);
  }else{
    $updated_post_array = $post_array;
  }

  return $updated_post_array;
}

function action_before_edit($post_array): Array {
  
  $model = $this->current_model;

  $updated_post_array = array();

  if(method_exists($this->CI->$model,'action_before_edit')){
    $updated_post_array = $this->CI->$model->action_before_edit($post_array);
  }else{
    $updated_post_array = $post_array;
  }

  return $updated_post_array;
}

/**
 * action_after_insert
 * 
 * This is used to hold the action to be triggered after a record insert in the grants model add method
 * For Example sending an email to a record approver
 * 
 * @param $post_array Array : A post form array
 * @param $approve_id int: The primary key of the Approval ticket raised
 * @param $header_id int: The priamry key of the inserted record
 * 
 * @return Boolean : If false return an error message 
 */
function action_after_insert($post_array,$approval_id,$header_id): bool {
  $model = $this->current_model;

  $status = true;

  if(method_exists($this->CI->$model,'action_after_insert')){
    $status = $this->CI->$model->action_after_insert($post_array,$approval_id,$header_id);

    // if(!is_bool($status)){
    //   $status = true;
    // }
  }

   return $status;
}

function action_after_edit($post_array,$approval_id,$header_id): bool {
  $model = $this->current_model;

  $status = true;

  if(method_exists($this->CI->$model,'action_after_edit')){
    $status = $this->CI->$model->action_after_edit($post_array,$approval_id,$header_id);

    // if(!is_bool($status)){
    //   $status = true;
    // }
  }

   return $status;
}

function config_list($config_name, $config_file = "config", $config_array_name = 'config'){
  $data = [
            'config_name'=>$config_name,
            'config_file'=>$config_file,
            'config_array_name'=>$config_array_name
          ];

  return $this->CI->load->view('templates/config_list',$data,true);
}


// Auto create Model and Library fields if missing

function create_missing_system_files(){
  
  $raw_specs = file_get_contents(APPPATH.'version'.DIRECTORY_SEPARATOR.'spec.yaml');

  $specs_array = yaml_parse($raw_specs,0);
  
  $assets_temp_path = FCPATH.'assets'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
  $controllers_path = APPPATH.'controllers'.DIRECTORY_SEPARATOR;

  foreach($specs_array['tables'] as $table_name => $setup){
    if(!file_exists($controllers_path.$table_name.'.php')){
      $this->create_missing_controller($table_name,$assets_temp_path);
      $this->create_missing_model($table_name,$assets_temp_path,$setup);
      $this->create_missing_library($table_name,$assets_temp_path);
    }
  }

}

function create_missing_controller($table, $assets_temp_path){

  $controllers_path = APPPATH.'controllers'.DIRECTORY_SEPARATOR;

  // Copy contents of assets/temp_library to the created file after the tag above
  $replaceables = array("%controller%"=>ucfirst($table),'%library%'=>$table.'_library');

  $this->write_file_contents($table, $controllers_path ,$assets_temp_path, $replaceables, 'controller');

}

function create_missing_library($table, $assets_temp_path){
 
  $libararies_path = APPPATH.'libraries'.DIRECTORY_SEPARATOR; 

  // Copy contents of assets/temp_library to the created file after the tag above
  $replaceables = array("%library%"=>ucfirst($table).'_library');

  $this->write_file_contents($table, $libararies_path ,$assets_temp_path, $replaceables, 'library');
}

function create_missing_model($table, $assets_temp_path, $table_specs){

  $models_path = APPPATH.'models'.DIRECTORY_SEPARATOR;
 
      // Copy contents of assets/temp_model to the created file after the tag above
      $lookup_tables = "";
      if(array_key_exists('lookup_tables',$table_specs)){
        $specs = $table_specs['lookup_tables'];

        $lookup_tables = implode(',', array_map(array($this,'quote_array_elements'),$specs) );
      
      }
       $replaceables = array(
         "%model%"=>ucfirst($table).'_model',
         "%table%"=>$table,
         '%dependant_table%'=> '',
         '%name%'=>$table.'_name',
         '%created_date%'=>$table.'_created_date',
         '%created_by%'=>$table.'_created_by',
         '%last_modified_date%'=>$table.'_last_modified_date',
         '%last_modified_by%'=>$table.'_last_modified_by',
         '%deleted_at%'=>$table.'_deleted_at',
         '%lookup_tables%'=>$lookup_tables
       );
 
   $this->write_file_contents($table, $models_path ,$assets_temp_path, $replaceables, 'model');
 
}

function write_file_contents($table, $sys_file_path ,$assets_temp_path, $replaceables, $temp_type = 'controller'){

  // Check if model is available and if not create the file
  if(!file_exists($sys_file_path.$table.'_'.$temp_type.'.php')){

      // Create the file  
      $handle = null;

      if($temp_type == 'model' || $temp_type == 'library'){
        $handle = fopen($sys_file_path.ucfirst($table).'_'.$temp_type.'.php', "w") or die("Unable to open file!");  
      }else{
        $handle = fopen($sys_file_path.ucfirst($table).'.php', "w") or die("Unable to open file!");
      }
        
      // Add the PHP opening tag to the file 
      $php_tag = '<?php';
      fwrite($handle, $php_tag);

      $replacefrom = array_keys($replaceables);
      
      $replacedto = array_values($replaceables);
    
      $file_raw_contents = file_get_contents($assets_temp_path.'temp_'.$temp_type.'.php');
    
      $file_contents = str_replace($replacefrom,$replacedto,$file_raw_contents);
    
      $file_code = "\n".$file_contents;
          
      fwrite($handle, $file_code);
  }
  
}

function quote_array_elements($elem){
  return ("'$elem'");
}

function get_record_office_id($table,$primary_key){
  return $this->CI->grants_model->get_record_office_id($table,$primary_key);
}


function action_labels($table,$primary_key){

  $this->load_detail_model('approval');

  return $this->CI->approval_model->display_approver_status_action($this->CI->session->role_id, $table, $primary_key);

}

/** To be reviewed */
function action_list($table,$primary_key,$is_approveable_item){
  $data['table'] = $table;
  $data['primary_key'] = $primary_key;
  $data['is_approveable_item'] = $is_approveable_item;
  $data['action_labels'] = $this->action_labels($table,$primary_key);

  return $this->CI->load->view('general/action_list',$data,true);
}

function update_status(){
  // Get status of current id
  $this->CI->grants_model->update_status();
}

function initial_item_status(){
  return $this->CI->grants_model->initial_item_status();
}




/******************************************************************************************************
 * 
 * START OF LIST OUTPUT CODE - ONLY COLUMN SELECT METHODS HAVE BEEN MOVED HERE
 * 
 * These work has been moved from List_output to test server side loading databases
 * 
 * 
 * ****************************************************************************************************
 */

  /**
 * feature_model_list_table_visible_columns
 * 
 * Returns an array of selected fields for the list page tables as set from the feature model if
 * existing. The feature model will use the list_table_visible_columns to set this array
 * 
 * @return Array 
 * 
 */
function feature_model_list_table_visible_columns() {
  $model = $this->current_model;

  $list_table_visible_columns = [];
  
  if(method_exists($this->CI->$model,'list_table_visible_columns') &&
    is_array($this->CI->$model->list_table_visible_columns())
  ){
    $list_table_visible_columns = $this->CI->$model->list_table_visible_columns();

     //Add the table id columns if does not exist in $columns
    if(   is_array($list_table_visible_columns) && 
          !in_array($this->primary_key_field($this->controller),
              $list_table_visible_columns)
      ){

      array_unshift($list_table_visible_columns,
      $this->primary_key_field($this->controller));

      // Throw error when a column doesn't exists to avoid Datatable server side loading error
      foreach($list_table_visible_columns as $_column){
        $all_fields = $this->CI->grants_model->get_all_table_fields($this->controller);

        if(!in_array($_column,$all_fields)){
          $message = "The column ".$_column." does not exist in the table ".$this->controller."</br>";
          $message .= "Check the list_table_visible_columns function of the ".$this->controller."_model for the source";
          show_error($message,500,'An Error As Encountered');
          //unset($list_table_visible_columns[array_search($_column,$list_table_visible_columns)]);
        }

      }
    }
  }

  return $list_table_visible_columns;

}

/**
 * toggle_list_select_columns
 * 
 * A method that returns an array of columns to be used as keys list_output method in the grants library.
 * It checks if the feature model has defined the list_table_visble_columns (Wrapped via grants library) 
 * or gets an array of all fields of the active table and
 * if finds any, adds to the fields array the name columns of the lookup tables as defined in the feature model
 * (Wrapped via grants library)
 *  Finally implements checking field access permissions 
 * 
 * @return Array : An array of columns to be used in the list method
 */

 public function toggle_list_select_columns(){

  // Check if the table has list_table_visible_columns not empty
  $list_table_visible_columns = $this->feature_model_list_table_visible_columns();
  $lookup_tables = $this->lookup_tables();

  $get_all_table_fields = $this->CI->grants_model->get_all_table_fields();


  foreach ($get_all_table_fields as $get_all_table_field) {

    //Unset foreign keys columns, created_by and last_modified_by columns

    if( substr($get_all_table_field,0,3) == 'fk_' ||
        $this->is_history_tracking_field($this->controller,$get_all_table_field,'created_by') ||
         $this->is_history_tracking_field($this->controller,$get_all_table_field,'last_modified_by') ||
         $this->is_history_tracking_field($this->controller,$get_all_table_field,'deleted_at')
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

        $lookup_table_columns = $this->CI->grants_model->get_all_table_fields($lookup_table);

        foreach ($lookup_table_columns as $lookup_table_column) {
          // Only include the name field of the look up table in the select columns
          if($this->is_name_field($lookup_table,$lookup_table_column)){
            array_push($visible_columns,$lookup_table_column);
          }

        }
      }
    }
  }

  return $visible_columns;//$this->CI->access->control_column_visibility($this->controller,$visible_columns,'read');
}

  /**
   * _output
   * 
   * This method returns the output of the list action views
   * 
   * @return array - Array to be render to the page via MY_Controller
   */

  function list_ajax_output(){
      $list = $this->CI->dt_model->get_datatables();
      $data = array();
      $no = $_POST['start'];
      foreach ($list as $item) {

        $this->CI->load->model('ajax_model','dt_model');

        $row = array();

        $id = $this->CI->controller.'_id';
        $track_number = $this->CI->controller.'_track_number';
        // $name = $this->CI->controller.'_name';
        // $created_date = $this->CI->controller.'_created_date';
        // $last_modified_date = $this->CI->controller.'_last_modified_date';

 
        $row[] = $this->CI->load->view('templates/list_action_button',array('primary_key'=>$item->$id),true);

        $columns = $this->toggle_list_select_columns();

        foreach($columns as $column){

          if($this->is_primary_key_field($this->controller,$column)){
            continue;
          }

          // Check if field is set for type change
          $lib = $this->controller.'_library';

          if(method_exists($this->CI->$lib,'change_field_type')){
            
            $changed_field_types =$this->CI->$lib->change_field_type();
            
            if(is_array($changed_field_types) && 
              count($changed_field_types) > 0 && 
              array_key_exists($column,$changed_field_types) && 
              $changed_field_types[$column]['field_type'] == 'select' &&
              array_key_exists($item->$column, $changed_field_types[$column]['options'])

              ){
                
                $item->$column = $changed_field_types[$column]['options'][$item->$column];
            }
          }


          if($this->is_history_tracking_field($this->controller,$column,'track_number')){
            $row[] = "<a href='".base_url().$this->CI->controller."/view/".hash_id($item->$id,'encode')."' >".$item->$track_number."</a>";
          }elseif(strpos($column,'_is_')){
            $row[] = $item->$column == 1? get_phrase('yes'): get_phrase('no');
          }else{
            $row[] = ucfirst(str_replace("_"," ",$item->$column));
          }
          
          
        }

        $data[] = $row;
      }

      $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->CI->dt_model->count_all(),
              "recordsTotal" => $this->CI->dt_model->count_filtered(),
              "recordsFiltered" => $this->CI->dt_model->count_filtered(),
              "data" => $data,
          );
      //output to json format
      return $output;
      
    }


    /****************************************************************************************************
     * 
     * 
     * END OF LIST OUTPUT CODE
     * 
     * 
     * **************************************************************************************************
     */
     //public $testing = array(); 
     //public $tested = array('begin_test');

     function lookup_values_where($table){
      
      //array_push($this->testing,$table);
      
      $model = $table.'_model';//$this->load_detail_model($table);
      $this->CI->load->model($model);

      
      if(  
            method_exists($this->CI->$model,'lookup_values_where') 
            && is_array($this->CI->$model->lookup_values_where($table)) 
            && count($this->CI->$model->lookup_values_where($table)) > 0  
        )
      {
          //array_push($this->tested,$this->CI->$model->lookup_values_where($table));
          return $this->CI->$model->lookup_values_where($table);
      }

    }

    function lookup_values($table){
      
      $lookup_values = array();

      $model = $table.'_model';

      $this->CI->load->model($model);

      $current_model = $this->current_model;
      
      if(
        (
          method_exists($this->CI->$current_model,'lookup_values') && 
          is_array($this->CI->$current_model->lookup_values($table)) &&
          array_key_exists($table,$this->CI->$current_model->lookup_values($table))
        ) 
      ){  
          $result = $this->CI->$current_model->lookup_values($table)[$table];

          $ids_array = array_column($result,$this->primary_key_field($table));
          $value_array = array_column($result,$this->name_field($table));

          $lookup_values =  array_combine($ids_array,$value_array);
      }
      elseif(         
        (
          method_exists($this->CI->$model,'lookup_values') && 
          is_array($this->CI->$model->lookup_values())
        )
      ){

        $result = $this->CI->$model->lookup_values();

        $ids_array = array_column($result,$this->primary_key_field($table));
        $value_array = array_column($result,$this->name_field($table));

        $lookup_values =  array_combine($ids_array,$value_array);
        
      }else{
        $lookup_values = $this->CI->grants_model->lookup_values($table);
      }

      return $lookup_values;
    }

    function check_if_center_has_any_hierarchy_association($center_id){
      $this->CI->load->model('center_model');
      return $this->CI->center_model->check_if_center_has_any_hierarchy_association($center_id);
    }

    function get_center_hierarchy_association_group($center_id){
      $this->CI->load->model('center_model');
      return $this->CI->center_model->get_center_hierarchy_association_group($center_id);
    }

}
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
 * master_table_visible_columns holds the selected fields of the master part of the master-detail view action pages
 * @var Array 
 */
private $master_table_visible_columns = [];

/**
 * list_table_visible_columns holds the selected fields of the list action pages
 * @var Array
 */
private $list_table_visible_columns = [];

/**
 * detail_list_table_visible_columns holds the selected fields of the detail part of the master-detail view action pages
 * @var Array
 */
private $detail_list_table_visible_columns = [];

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
 * detail_list_query holds the query result of the detail part of the master-detail view action pages
 * @var Array
 */
private $detail_list_query = [];

/**
 * Look up tables of the active table
 * @var Array
 */
private $lookup_tables = [];

/**
 * Details tables array of the active table
 * @var Array
 */
private $detail_tables = [];

/**
 * Query result for the master part of the master-detail of view action page
 * @var Array
 */
private $master_view = [];

/**
 * Selected columns of the edit action page with database results
 * @var Array
 */
private $edit_visible_columns = [];

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

  // Loading the main feature library
  $this->CI->load->library($this->current_library);
}


/**
 * load_detail_model
 * 
 * This method helps to reload the detail table/ foreign table model. It can be used to toggle models
 * It returns the toggled model name
 * 
 * @param $table_name String : The table to toggle a model to
 *  
 * @return String
 */
function load_detail_model(String $table_name = ""): String{
  $model =  $this->current_model;

  if($table_name !== "" && !is_array($table_name)){
    $model = $table_name.'_model';
    $this->CI->load->model($model);
  }

  return $model;
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
 * History tracking fields are: deleted_at, created_date, last_modified_date, created_by and 
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
public function is_history_tracking_field(String $table_name, String $column, String $history_type){

  $is_history_tracking_field = false;

  //Helps to prevent the use of invalid history tracking fields
  $template_history_types = array('created_date','created_by','last_modified_date','last_modified_by','deleted_at');

  //foreach($history_types as $history_type){

    if(in_array($history_type,$template_history_types)){
      $history_tracking_field = $this->history_tracking_field($table_name,$history_type);

      if($column == $history_tracking_field){
        $is_history_tracking_field = true;
      }
    }

  //}

  return $is_history_tracking_field;

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

  if(method_exists($this->CI->$model,'lookup_tables') && 
      is_array($this->CI->$model->lookup_tables())
    ){
    $this->lookup_tables = $this->CI->$model->lookup_tables();
  }
  return $this->lookup_tables;
}


/**
 * detail_tables
 * 
 * This is wrapper method to the detail_tables of the specific feature model
 * The detail_tables method holds the details referencing tables as array elements
 * Passing an argument to this wrapper switches between the main feature model 
 * detail_tables to a certain details models
 * 
 * @param $table_name String : The table to check detail tables for
 * 
 * @return Array
 */
function detail_tables(String $table_name = ""): Array {
  $model = $this->load_detail_model($table_name);

  
  if($this->controller == 'approval' && $this->action == 'view'){
    // This is specific to approval view, only to list the detail listing of the select approveable 
    // item
    $id = $this->CI->uri->segment(3,0);

    $this->CI->db->join('approve_item','approve_item.approve_item_id=approval.fk_approve_item_id');
    $detail_table = $this->CI->db->get_where('approval',
    array('approval_id'=>hash_id($id,'decode')))->row()->approve_item_name;
    
    $this->detail_tables = array($detail_table);
  
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
   * @param $fields_array String : Array of table fields
   * 
   * @return String
   */  
  function detail_row_fields(Array $fields_array): Array {

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

  /**
   * header_row_field
   * 
   * This method populates the single_form_add or master part of the multi_form_add pages.
   * It also checks if their is set_change_field_type of the current column from the feature library
   * 
   * @param $column String : A column from a table
   * @param $field_value Mixed : Value of the field mainly from edit form
   * 
   * @return String
   */
    
  function header_row_field(String $column, $field_value = ""): String {
    //create, read, update
    //  $field_permission = array('bank'=>array('bank_swift_code'=>array('read','write'))); 
     
    //  if(  array_key_exists($this->controller,$field_permission) && 
    //       in_array($column,$field_permission[$this->controller]) 
    //     ){

    //  }

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
        return $f->$field($this->CI->grants_model->lookup_values($lookup_table), $field_value);
      }elseif(strrpos($column,'_is_active') == true ){
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
    $fields[$column] = $this->header_row_field($column);
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


  
// Visible Columns methods

/**
 * detail_list_table_visible_columns
 * 
 * Returns an array of columns to be selected in a listing table in a master-detail view action page
 * 
 * @param $table String : Selected detail table
 * 
 * @return Array
 */
function detail_list_table_visible_columns(String $table) {

  $model = $this->load_detail_model($table);

  if(method_exists($this->CI->$model,'detail_list_table_visible_columns') && 
      is_array($this->CI->$model->detail_list_table_visible_columns())
  ){
    $this->detail_list_table_visible_columns = $this->CI->$model->detail_list_table_visible_columns();

    //Add the table id columns if does not exist in $columns
    if(is_array($this->detail_list_table_visible_columns) && !in_array($table.'_id',$this->detail_list_table_visible_columns)){
      array_unshift($this->detail_list_table_visible_columns,$table.'_id');
    }

  }

  return $this->detail_list_table_visible_columns;
}

/**
 * list_table_visible_columns
 * 
 * Returns an array of selected fields for the list page tables
 * 
 * @return Array 
 * 
 */
function list_table_visible_columns() {
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'list_table_visible_columns') &&
    is_array($this->CI->$model->list_table_visible_columns())
  ){
    $this->list_table_visible_columns = $this->CI->$model->list_table_visible_columns();

     //Add the table id columns if does not exist in $columns
    if(is_array($this->list_table_visible_columns) && !in_array($this->controller.'_id',$this->list_table_visible_columns)){
      array_unshift($this->list_table_visible_columns,$this->controller.'_id');
    }
  }

  return $this->list_table_visible_columns;

}

/**
 * master_table_visible_columns
 * 
 * Returns an array of selected fields in the master part of the master-detail view action pages
 * 
 * @return Array
 */
function master_table_visible_columns(){
  $model = $this->current_model;

  if(method_exists($this->CI->$model,'master_table_visible_columns') &&
  is_array($this->CI->$model->master_table_visible_columns())
  ){
    $this->master_table_visible_columns = $this->CI->$model->master_table_visible_columns();

    //Add the table id columns if does not exist in $columns
    if(is_array($this->master_table_visible_columns) && !in_array($this->controller.'_id',$this->master_table_visible_columns)){
      array_unshift($this->master_table_visible_columns,$this->controller.'_id');
    }

  }

  return $this->master_table_visible_columns;
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

  if(method_exists($this->CI->$model,'edit_visible_columns') && 
      is_array($this->CI->$model->edit_visible_columns())
  ){
    $this->single_form_add_visible_columns = $this->CI->$model->edit_visible_columns();
  }
  return $this->edit_visible_columns;
}

/**
 * list
 * 
 * This method returns the query results for the list pages
 * 
 * @return Array
 */
function list_query(){
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
 
  $query_result = $this->update_query_result_for_fields_changed_to_select_type($this->controller,$query_result);

  return $query_result;
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
  $this->set_change_field_type($table);
  
  if(count($this->set_field_type) > 0){

    //Get changed columns 
    $changed_fields = array_keys($this->set_field_type);

    foreach($query_result as $index => $row){

      foreach($changed_fields as $changed_field){
        if(array_key_exists($changed_field,$row) && in_array('select',$this->set_field_type[$changed_field]) ){
          $query_result[$index][$changed_field] = $this->set_field_type[$changed_field]['options'][$row[$changed_field]];
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
 * @param $table String : The selected table
 * 
 * @return void
 */

function mandatory_fields(String $table): Void{

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
 * @param $table String : The selected table
 * 
 * @return array
 * 
 */
function detail_list_query(String $table): Array {
  $model = $this->load_detail_model($table);

  if(method_exists($this->CI->$model,'detail_list_query') && 
      is_array($this->CI->$model->detail_list_query()) &&
      count($this->CI->$model->detail_list_query()) > 0
    ){
      $this->detail_list_query = $this->CI->$model->detail_list_query(); // A full user defined query result
  } else{
      $this->detail_list_query = $this->CI->grants_model->detail_list_query($table); // System generated query result
  }

  return $this->detail_list_query;
}


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
 * list oputput
 * 
 * This method returns the output of the list action views
 * 
 * @return array 
 */
function list_output(){

  $table = $this->controller;

  $this->mandatory_fields($table);

  $result = $this->list_query();
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
 * @param $table String : Selected table
 * 
 * @return array
 * 
 */
function detail_list_view(String $table): Array {

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

function master_view(): Array {
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
    // Adds mandatory fields if not present in the current table
    $this->mandatory_fields($table);

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
      $this->CI->$model->add();
    }else{
      $this->CI->grants_model->add();
    }
  }else{
    $this->mandatory_fields($table);

    // Adds mandatory fields if not present in the current table
    $visible_columns = $this->CI->grants_model->master_multi_form_add_visible_columns();
    $fields = $this->add_form_fields($visible_columns);//$this->master_multi_form_add_visible_columns_query();

    // $keys = $this->CI->grants_model->master_multi_form_add_visible_columns();
    $detail_table_keys = $this->CI->grants_model->detail_multi_form_add_visible_columns($table.'_detail');
    $false_keys = $this->false_keys($table.'_detail');

    return array(
      'fields'=>$fields,
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
function edit_output($id = ""){

  $table = $this->controller;

  if($this->CI->input->post()){
    //$this->CI->grants_model->add($this->CI->input->post());
    $model = $this->current_model;

    if(method_exists($this->CI->$model,'edit')){
      $this->CI->$model->edit($id);
    }else{
      $this->CI->grants_model->edit($id);
    }
  }else{
    $this->mandatory_fields($table);

    $edit_query = $this->edit_query($table);

    return array(
      'keys'=>$edit_query
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

  return $edit_query;
}

/**
 * check_role_has_field_permission
 * 
 * This method is a wrapper of the user_model check_role_has_field_permission method.
 * It helps to check if the logged user has permission to acccess a controlled field
 * Any field that has been flagged in the permission table is referred to as a controlled field
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
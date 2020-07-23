<?php

/**
  *This class computes the output of the list action pages. It tries to check if the feature library has
  * any list of columns set to be used by the SQL select portion. If it misses this, the class makes a step
  * of using all the fields of the selectd tables but escapes/ unsets the created_by, last_modified_by and 
  * deleted_at columns.
  * 
  * The class checks if the feature model has defined a result query if not it used the internal run_query 
  * grants model method to get the results.
  * 
  * Finally the query results are used to populate the list_output return which is packs an array to be 
  * dispatched to the load method (See in Output_template class) to MY_Controller
  *
  * @author Nicodemus Karisa
  * @package Grants Management System
  * @copyright Compassion International Kenya
  * @license https://compassion-africa.org/lisences.html
  *
  */

defined('BASEPATH') OR exit('No direct script access allowed');

  /**
   * Getting the path of the current file
   */
  $path_parts = pathinfo(__FILE__);

/**
  * This class computes the output of the list action pages. It tries to check if the feature library has
  * any list of columns set to be used by the SQL select portion. If it misses this, the class makes a step
  * of using all the fields of the selectd tables but escapes/ unsets the created_by, last_modified_by and 
  * deleted_at columns.
  * 
  * The class checks if the feature model has defined a result query if not it used the internal run_query 
  * grants model method to get the results.
  * 
  * Finally the query results are used to populate the list_output return which is packs an array to be 
  * dispatched to the load method (See in Output_template class) to MY_Controller
  *
  * @author Nicodemus Karisa
  * @package Grants Management System
  * @copyright Compassion International Kenya
  * @license https://compassion-africa.org/licences.html
  *
  */

class List_output extends Output_template{
 
  /**
   * __construct
   * 
   * Class constructor
   * 
   * @return void
   */
  function __construct(){
      parent::__construct();
  }

 /**
 * feature_model_list_table_visible_columns
 * 
 * Returns an array of selected fields for the list page tables as set from the feature model if
 * existing. The feature model will use the list_table_visible_columns to set this array
 * 
 * @return Array 
 * 
 */
function feature_model_list_table_visible_columns(): Array {
    $model = $this->current_model;

    $list_table_visible_columns = [];
    
    if(method_exists($this->CI->$model,'list_table_visible_columns') &&
      is_array($this->CI->$model->list_table_visible_columns())
    ){
      $list_table_visible_columns = $this->CI->$model->list_table_visible_columns();

      // This part couldn't work as the function $this->CI->grants->unset_status_if_item_not_approveable()
      if(!$this->CI->grants_model->approveable_item(strtolower($this->controller))){
        $columns = ['status_name','approval_name'];

        foreach($columns as $column){
          if(in_array($column,$list_table_visible_columns)){
            $column_name_key = array_search($column,$list_table_visible_columns);
            unset($list_table_visible_columns[$column_name_key]);
          }
        }
      }
  
       //Add the table id columns if does not exist in $columns
      if(   is_array($list_table_visible_columns) && 
            !in_array($this->CI->grants->primary_key_field($this->controller),
                $list_table_visible_columns)
        ){

        array_unshift($list_table_visible_columns,
        $this->CI->grants->primary_key_field($this->controller));
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
    $lookup_tables = $this->CI->grants->lookup_tables();

    $get_all_table_fields = $this->CI->grants_model->get_all_table_fields();


    foreach ($get_all_table_fields as $get_all_table_field) {

      //Unset foreign keys columns, created_by and last_modified_by columns

      if( substr($get_all_table_field,0,3) == 'fk_' ||
          $this->CI->grants->is_history_tracking_field($this->controller,$get_all_table_field,'created_by') ||
           $this->CI->grants->is_history_tracking_field($this->controller,$get_all_table_field,'last_modified_by') ||
           $this->CI->grants->is_history_tracking_field($this->controller,$get_all_table_field,'deleted_at')
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

          // Hide status and approval columns if the active controller/table is not approveable
          if($this->CI->grants_model->approveable_item($lookup_table) &&
             ($lookup_table == 'status' || $lookup_table == 'approval')) continue;

          $lookup_table_columns = $this->CI->grants_model->get_all_table_fields($lookup_table);

          foreach ($lookup_table_columns as $lookup_table_column) {
            // Only include the name field of the look up table in the select columns
            if($this->CI->grants->is_name_field($lookup_table,$lookup_table_column)){
              array_push($visible_columns,$lookup_table_column);
            }

          }
        }
      }
    }

    return $this->access->control_column_visibility($this->controller,$visible_columns,'read');
  }
  
    /**
     * list_internal_query_results 
     * 
     * This method brings out the database query results from the grants model
     * 
     * @param $lookup_tables - tables with a foreign relationship to this selected table
     * 
     * @return Array - Database results
     */

    function list_internal_query_results(Array $lookup_tables):Array {
        $table = $this->controller;

        return $this->CI->grants_model->run_list_query($table,$this->toggle_list_select_columns(),$lookup_tables);

    }


    /**
     * toggle_list_query_results
     * 
     * This method returns the query results for the list pages.
     * It checks first if there is any list method defined from the feature model or if missing
     * get the default one from the grants model.
     * Finally the method sanitises the final array by checking if there is a change in field type to a select
     * type and point the correct options values
     * 
     * @todo the "list" method in the feature specific models to be renamed to "list_feature_model_query_result"
     * 
     * @return Array
     */
    function toggle_list_query_results(): Array {
    $model = $this->current_model;
  
    // Get the tables foreign key relationship
    $lookup_tables = $this->CI->grants->lookup_tables();
  
    // Get result from grants model if feature model list returns empty
    $query_result = $this->list_internal_query_results($lookup_tables); // System generated query result
    
    if(method_exists($this->CI->$model,'list')){
      $feature_model_list_result = $this->CI->$model->list();
      if(is_array($feature_model_list_result)){
        // Allows empty result set
        $query_result = $feature_model_list_result; // A full user defined query result
      }
    }
  
    // Implemeting resetting of options if a field is changed from to a select type
    $query_result = $this->CI->grants->update_query_result_for_fields_changed_to_select_type($this->controller,$query_result);
  
    return $query_result;
  }


    /**
     * _output
     * 
     * This method returns the output of the list action views
     * 
     * @return array - Array to be render to the page via MY_Controller
     */

    function _output(){

        // Used when applying page view to a list: See View Widget
        if($this->CI->input->post()){
            //Controller dependant session, give it a value. This session has been initialized in MY_Controller
            $this->CI->session->set_userdata($this->CI->controller.'_active_page_view',
            $this->CI->input->post('page_view'));
        }

        $table = $this->controller;
      
        //$this->CI->grants_model->mandatory_fields($table);

        // Mandatory fields for details tables
        
      
        $result = $this->toggle_list_query_results();
        $keys = $this->toggle_list_select_columns();
        $show_add_button = $this->CI->grants->show_add_button();
      
        return array(
          'keys'=> $keys,
          'table_body'=>$result,
          'table_name'=> $table,
          'has_details_table' => $this->CI->grants->check_if_table_has_detail_table($table),
          'has_details_listing' => $this->CI->grants->check_if_table_has_detail_listing($table),
          'show_add_button'=>$show_add_button
        );
      }

}

require_once(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'create_instance.php');
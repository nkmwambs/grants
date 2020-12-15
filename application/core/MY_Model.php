<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function multi_select_field(){
      return '';
    }

    function lookup_tables(){
      //$table_name = $this->controller;
      //return $this->_derived_lookup_tables($table_name);
      return list_lookup_tables();
    }

    function list_table_where(){
      // $get_max_approval_status_id = $this->general_model->get_max_approval_status_id(strtolower($this->controller)); 
      // $filter_where_array = hash_id($this->id,'decode') > 0 && !in_array($this->controller,$this->config->item('table_that_dont_require_history_fields')) ? [$this->controller.'.fk_status_id'=>$get_max_approval_status_id] : [];
      
      // if(count($filter_where_array) > 0){
      //   $this->db->where($filter_where_array);
      // }

      $this->_list_table_where_by_account_system();
      
    }

    function _list_table_where_by_account_system(){
      $tables_with_account_system_relationship = tables_with_account_system_relationship();

      $lookup_tables = $this->lookup_tables();

      $account_system_table = '';

      foreach($lookup_tables as $lookup_table){
        if(in_array($lookup_table, $tables_with_account_system_relationship)){
          $account_system_table = $lookup_table;
          break;
        }
      }

      if(!$this->session->system_admin && $account_system_table !== ''){
        $this->db->where(array($account_system_table.'.fk_account_system_id'=>$this->session->user_account_system_id));
      }
    }

    public function detail_tables(){
      return list_detail_tables();
    }

    public function edit_visible_columns(){}

    public function master_table_visible_columns(){}
  
    public function list_table_visible_columns(){}
  
    public function list_table_hidden_columns(){}
  
    public function detail_list_table_visible_columns(){}
  
    public function detail_list_table_hidden_columns(){}
  
    public function single_form_add_visible_columns(){}

    public function order_list_page():String{return '';}

    // Lists/ Array of detail tables of the current controller that you would like to use their 
    // single_form_add_visible_columns in the current controller's single form add forms

    public function detail_tables_single_form_add_visible_columns(){}
  
    public function single_form_add_hidden_columns(){}
  
    public function master_multi_form_add_visible_columns(){}
  
    public function detail_multi_form_add_visible_columns(){}
  
    public function master_multi_form_add_hidden_columns(){}
  
    public function detail_multi_form_add_hidden_columns(){}

    //public function add(){} //Had a problem of creating duplicates with the status_role add form on post

    public function edit(){}

    public function delete(){}

    public function master_table_additional_fields($record_id){
      return [];
    }

    public function transaction_validate_duplicates_columns(){
      return [];// Must pass an empty array to prevent add method failure in grants_model
    }

    public function transaction_validate_by_computation_flag($array_to_check){
      return VALIDATION_SUCCESS;
    }

    public function currency_fields(){
      return [];
    }

    function lookup_values(){

      $current_table =  strtolower($this->controller);

      $lookup_tables = $this->grants->lookup_tables($current_table);

      $lookup_values = [];

      foreach($lookup_tables as $lookup_table){

        $this->read_db->select(array($lookup_table.'_id',$lookup_table.'_name'));

        //This ensure only lowest level offices e.g. center
        //$this->config->item('drop_only_center') && in_array($lookup_table,$this->config->item('tables_allowing_drop_only_centers')) && 
        if($this->config->item('drop_only_center')  && $lookup_table=='office' && in_array($current_table,$this->config->item('tables_allowing_drop_only_centers'))){

          $this->read_db->where(array('fk_context_definition_id'=>$this->user_model->get_lowest_office_context()->context_definition_id));
        }

        //$check_if_table_has_account_system = $this->grants->check_if_table_has_account_system($lookup_table);

        if(!$this->session->system_admin){

        //  $array_intersect = array_intersect($this->grants->lookup_tables($lookup_table),$this->config->item('tables_with_account_system_relationship'));

        //   if(count($array_intersect)>0){
        //     $this->read_db->join($array_intersect[0],$array_intersect[0].'.'.$array_intersect[0].'_id='.$lookup_table.'.fk_'.$array_intersect[0].'_id');
        //     $this->read_db->join('account_system', 'account_system.account_system_id='.$array_intersect[0].'.fk_account_system_id');
        //     $this->read_db->where(array('account_system_code'=>$this->session->user_account_system));
        //   }

        //   if($lookup_table !== 'account_system' && $check_if_table_has_account_system){
        //     $this->read_db->join('account_system', 'account_system.account_system_id='.$lookup_table.'.fk_account_system_id');
        //   }

        //   if($check_if_table_has_account_system){
        //     $this->read_db->where(array('account_system_code'=>$this->session->user_account_system));
        //   }

        if(strtolower($this->controller) !== 'account_system'){
          $this->grants->join_tables_with_account_system($lookup_table);
        }
         
        if ($this->db->field_exists($lookup_table.'_is_active', $lookup_table))
        {
            $this->read_db->where(array($lookup_table.'_is_active'=>1));
        }
          $lookup_values[$lookup_table] = $this->read_db->get($lookup_table)->result_array();

        }else{
          
          $lookup_values[$lookup_table] = $this->read_db->get($lookup_table)->result_array();
          
        }
      }

      return $lookup_values;
    }

    /**
     * Use is a master table to filter the values of the lookup columns
     * Lookup tables are keys of the condition arrays
     */
    function lookup_values_where(){

    }

    function _derived_lookup_tables($table_name){
      $fields = $this->grants_model->get_all_table_fields($table_name);
    
      $foreign_tables_array_padded_with_false = array_map(function($elem){
        return substr($elem,0,3) =='fk_'?substr($elem,3,-3):false;
      },$fields);

      // Prevent listing false values and status or approval tables for lookup. 
      // Add status_name and approval_name to the correct visible_columns method in models to see these fields in a page
      $foreign_tables_array = array_filter($foreign_tables_array_padded_with_false,function($elem){
        return $elem?$elem:false;
      });

      return $foreign_tables_array;
    }

    // Can be overriden in the specific model or extended
    function table_hidden_columns(){
      $hidden_columns = array($this->table.'_last_modified_date',$this->table.'_created_date',
      $this->table.'_last_modified_by',$this->table.'_created_by',$this->table.'_deleted_at');

      return $hidden_columns;
    }

    function master_table_hidden_columns(){
      $hidden_columns = array($this->table.'_last_modified_date',$this->table.'_created_date',
      $this->table.'_last_modified_by',$this->table.'_created_by',$this->table.'_deleted_at');

      return $hidden_columns;
    }

    function show_add_button(){
      return true;
    }

    function action_after_insert($post_array, $approval_id, $header_id){
      return true;
    }

    
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'request'; // you MUST mention the table name
  public $dependant_table = "request_detail";

  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('department','request_type','office','status','approval');
  }

  public function detail_tables(){
    return array('request_detail');
  }

  function master_multi_form_add_visible_columns(){
    return array('request_name','request_date','request_type_name','request_description','office_name','department_name');
  }

  function detail_list(){}

  function master_view(){}

  function list_table_visible_columns(){
    return ['request_track_number','request_type_name',
    'request_description','request_date','request_created_date','office_name',
    'department_name','status_name','approval_name'];
  }


  public function list(){
      
    // $this->grants->where_condition('centers');
    
    // $this->grants->where_condition('page_view','request');

    // $this->grants->create_table_join_statement($this->controller, $this->lookup_tables());

    // return $this->db->get('request')->result_array();
  }

  public function view(){}

  function lookup_values($table){
    
    $lookup_values = [];

    if($table == 'office'){

      if(count($this->session->hierarchy_offices) == 0){
        $message = "You do not have offices in your hierarchy. 
        Kindly ask the administrator to add an office or <a href='".$_SERVER['HTTP_REFERER']."'/>go back</a>";         
        show_error($message,500,'An Error As Encountered'); 
      }else{
        $this->db->where_in('office_id',array_column($this->session->hierarchy_offices,'office_id'));
        $office_obj = $this->db->get('office');

        if($office_obj->num_rows() > 0){
          $lookup_values['office'] = $office_obj->result_array();  
        }
      }
     
    }

    if($table = 'project_allocation'){

      if(count($this->session->hierarchy_offices) == 0){
          $message = "You do not have offices in your hierarchy. 
          Kindly ask the administrator to add an office or <a href='".$_SERVER['HTTP_REFERER']."'/>go back</a>";         
          show_error($message,500,'An Error As Encountered'); 
      }else{
        $this->db->where_in('fk_office_id',array_keys($this->session->hierarchy_offices));
        $allocation_obj = $this->db->get('project_allocation');

        if($allocation_obj->num_rows() > 0){
          $lookup_values['project_allocation'] = $allocation_obj->result_array(); 
        }
      }
      
    }

    if($table = 'department'){
      $lookup_values['department'] = [];
       
      if(count($this->session->departments) == 0){
          $message = "The system does not have departments. 
          Kindly ask the administrator to add departments or <a href='".$_SERVER['HTTP_REFERER']."'/>go back</a>";         
          show_error($message,500,'An Error As Encountered'); 
        }else{
          $this->db->where_in('department_id',$this->session->departments);
          $lookup_values['department']  = $this->db->get('department')->result_array();
        } 

    }

    return $lookup_values;
  }

  // function list_table_where(){

  //   //If the request is set to be department strcit, then only list requests from the user departments
  //   $is_role_department_strict = $this->session->role_is_department_strict;
    
  //   if($is_role_department_strict == 1  && count($this->session->departments) > 0){
  //     $this->db->where_in($this->controller.'.fk_department_id', $this->session->departments);
  //   }    
    
  //   // Only list requests from the users' hierachy offices
  //   //$this->db->where_in($this->controller.'.fk_office_id',array_column($this->session->hierarchy_offices,'office_id'));
  // }


  function get_request_types($account_system_id){
    $this->db->select(array('request_type_id','request_type_name'));
    return $this->db->get_where('request_type',
    array('request_type_is_active'=>1,'fk_account_system_id'=>$account_system_id))->result_object();
  }

  function get_user_departments(){
      // User can raise a request to any department irrespective of which he/she belongs
      $this->db->select(array('department_id','department_name'));
      $result = $this->db->get_where('department',array('department_is_active'=>1))->result_array();

      return $result;
    
  }

  function get_request_detail_accounts($office_id){ 

    $account_system_id = $this->db->get_where('office',array('office_id'=>$office_id))->row()->fk_account_system_id;

    $this->db->select(array('expense_account_id','expense_account_name'));
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $result = $this->db->get_where('expense_account',array('expense_account_is_active'=>1,'fk_account_system_id'=>$account_system_id));
    
    return $result->result_array();
  }

  function get_request_detail_project_allocation($office_id,$request_date){
    $query_condition = "fk_office_id = ".$office_id." AND (project_end_date >= '".$request_date."' OR  project_allocation_extended_end_date >= '".$request_date."')";
    $this->db->select(array('project_allocation_id','project_allocation_name'));
    $this->db->join('project','project.project_id=project_allocation.fk_project_id');
    $this->db->where($query_condition);
    $project_allocation = $this->db->get('project_allocation')->result_object();

    return $project_allocation;
  }

  function master_table_additional_fields($record_id){
    $request_detail_total_cost = $this->db->select_sum('request_detail_total_cost')->get_where('request_detail',
    array('fk_request_id'=>$record_id))->row()->request_detail_total_cost;

    return ['request_total_cost'=>$request_detail_total_cost];
  }

  function currency_fields(){
    return ['request_total_cost'];
  }

}

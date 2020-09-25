<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Budget_item extends MY_Controller
{

  function __construct(){
    parent::__construct();

  }

  function index(){}

  function page_name():String{
    //return the page name if the user has permissions otherwise error page of user not allowed access display
    parent::page_name();

    if((hash_id($this->id,'decode') == null && $this->action == 'multi_form_add') || !$this->has_permission){
      return 'error';
    }else{
      return $this->action;
    }
  }

  function result($id = ''){
    if($this->action == 'multi_form_add' || $this->action == 'edit'){
  
    $result = [];
    
    $this->db->select(array('month_id','month_name'));
    $this->db->order_by('month_order ASC');
    $months = $this->db->get('month')->result_object();
    
    $this->db->select(array('office_id','office_name','office_code','budget_year','fk_account_system_id'));
    $this->db->join('budget','budget.fk_office_id=office.office_id');
    
    if($this->action == 'multi_form_add'){
      $this->db->where(array('budget_id'=>hash_id($this->id,'decode')));
    }else{
      $this->db->join('budget_item','budget_item.fk_budget_id=budget.budget_id');
      $this->db->where(array('budget_item_id'=>hash_id($this->id,'decode')));
    }

    $office = $this->db->get('office')->row();

    
    $this->db->select(array('expense_account_id','expense_account_name','expense_account_code'));
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $this->db->join('account_system','account_system.account_system_id=income_account.fk_account_system_id');
    $expense_accounts = $this->db->get_where('expense_account',
    array('fk_account_system_id'=>$office->fk_account_system_id,'expense_account_is_active'=>1))->result_object();
    
    $budgeting_date = date('Y-m-d');
    $query_condition = "fk_office_id = ".$office->office_id." AND (project_end_date >= '".$budgeting_date."' OR  project_allocation_extended_end_date >= '".$budgeting_date."')";
    $this->db->where($query_condition);
    $this->db->select(array('project_allocation_id','project_allocation_name','project_name'));
    $this->db->join('project','project.project_id=project_allocation.fk_project_id');
    $project_allocations = $this->db->get('project_allocation')->result_object();


    $result['project_allocations'] = $project_allocations; 
    $result['expense_accounts'] = $expense_accounts;
    $result['months'] = $months;
    $result['office'] = $office;

    if($this->action == 'edit'){
      $this->db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
      $this->db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
      $this->db->where(array('budget_item_id'=>hash_id($this->id,'decode')));
      $result['budget_item_details'] = $this->db->get('budget_item_detail')->result_array();
    }

    return $result;
    }else{
      return parent::result($id = '');
    }
  }

  function insert_budget_item(){
    
    $post = $this->input->post();

    $this->write_db->trans_start();

    $header['budget_item_track_number'] = $this->grants_model->generate_item_track_number_and_name('budget_item')['budget_item_track_number'];
    $header['budget_item_name'] = $this->grants_model->generate_item_track_number_and_name('budget_item')['budget_item_name'];
    $header['fk_budget_id'] = $post['fk_budget_id'];
    $header['budget_item_total_cost'] = $post['budget_item_total_cost'];
    $header['fk_expense_account_id'] = $post['fk_expense_account_id'];
    $header['budget_item_description'] = $post['budget_item_description'];
    $header['fk_project_allocation_id'] = $post['fk_project_allocation_id'];

    $header['budget_item_created_by'] = $this->session->user_id;
    $header['budget_item_last_modified_by'] = $this->session->user_id;
    $header['budget_item_created_date'] = date('Y-m-d');

    $header['fk_approval_id'] = $this->grants_model->insert_approval_record('budget_item');
    $header['fk_status_id'] = $this->grants_model->initial_item_status('budget_item');

    $this->write_db->insert('budget_item',$header);
    $header_id = $this->write_db->insert_id();
    
    $row = [];
    
    foreach($post['fk_month_id'] as $month_id => $month_amount){
      $body['budget_item_detail_track_number'] = $this->grants_model->generate_item_track_number_and_name('budget_item_detail')['budget_item_detail_track_number'];
      $body['budget_item_detail_name'] = $this->grants_model->generate_item_track_number_and_name('budget_item_detail')['budget_item_detail_name'];
      $body['fk_budget_item_id'] = $header_id;

      $body['budget_item_detail_amount'] = $month_amount[0];
      $body['fk_month_id'] = $month_id;

      $body['budget_item_detail_created_by'] = $this->session->user_id;
      $body['budget_item_detail_last_modified_by'] = $this->session->user_id;
      $body['budget_item_detail_created_date'] = date('Y-m-d');

      $body['fk_approval_id'] = 0;
      $body['fk_status_id'] = $this->grants_model->initial_item_status('budget_item');
      
      $row[] = $body;
    }

    $this->write_db->insert_batch('budget_item_detail',$row);
    
    
    $this->write_db->trans_complete();

    if ($this->write_db->trans_status() === FALSE)
    {
      //echo json_encode($row);
      echo "Budget Item posting failed";
    }else{
      //echo json_encode($row);
      echo "Budget Item posted successfully";
    }

  }

  function project_budgetable_expense_accounts($project_allocation_id){
    
    $this->read_db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $this->read_db->join('project_income_account','project_income_account.fk_income_account_id=income_account.income_account_id');
    $this->read_db->join('project','project.project_id=project_income_account.fk_project_id');
    $this->read_db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
    $this->read_db->where(array('project_allocation_id'=>$project_allocation_id,'expense_account_is_budgeted'=>1));
    $this->read_db->select(array('expense_account_id','expense_account_name'));
    $accounts = $this->read_db->get('expense_account')->result_array();

    echo json_encode($accounts);
  }

  static function get_menu_list(){}
}

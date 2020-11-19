<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Budget extends MY_Controller
{

  function __construct(){
    parent::__construct();
    $this->load->helper('budget_helper');
  }
  function index(){}

  function budget_summary_result($budget_year = ""){

    $data = [];
    
    $budget_office = $this->budget_office();

    $this->db->select(array('income_account_name','income_account_code','income_account_id',
    'expense_account_id','expense_account_name','expense_account_code','month_id','month_name'));
    $this->db->select_sum('budget_item_detail_amount');
    
    $this->db->join('budget_item','budget_item.fk_budget_id=budget.budget_id');
    $this->db->join('budget_item_detail','budget_item_detail.fk_budget_item_id=budget_item.budget_item_id');
    $this->db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $this->db->join('month','month.month_id=budget_item_detail.fk_month_id');
    $this->db->where(array('fk_office_id'=>$budget_office->office_id,
    'budget_year'=>$budget_office->budget_year,'budget_id'=>hash_id($this->id,'decode')));
    $this->db->group_by(array('fk_month_id','expense_account_id','income_account_id'));
    $this->db->order_by('month_order ASC');
    $result_raw  = $this->db->get('budget')->result_object();

    $result = [];
    
    foreach($result_raw as $detail){
      
      $result[$detail->income_account_id]['income_account'] = ['income_account_id'=>$detail->income_account_id,'income_account_name'=>$detail->income_account_name,'income_account_code'=>$detail->income_account_code];
      $result[$detail->income_account_id]['spread_expense_account'][$detail->expense_account_id]['expense_account'] = ['account_name'=>$detail->expense_account_name,'account_code'=>$detail->expense_account_code];        
      $result[$detail->income_account_id]['spread_expense_account'][$detail->expense_account_id]['spread'][$detail->month_name] = $detail->budget_item_detail_amount;
      
    }
    
  $data['summary'] =  $result;
  $data['test'] = $result_raw;    

    return $data;
  }

  function budget_office(){
    $this->db->select(array('office_id','office_name','office_code','budget_year',
    'budget_tag_id','budget_tag_name','budget.fk_status_id as status_id'));
    $this->db->join('office','office.office_id=budget.fk_office_id'); 
    $this->db->join('budget_tag','budget_tag.budget_tag_id=budget.fk_budget_tag_id');
    $budget_office = $this->db->get_where('budget',
    array('budget_id'=>hash_id($this->id,'decode')))->row();

    return $budget_office;
  }

  function budget_header_information($budget_year = ''){

    $budget_office = $this->budget_office();
    
    $budget_year = 0;
    $office_id = 0;
    $office_name = "";
    $budget_tag_name = "";
    $budget_status_id = 0;
    
    if(isset($budget_office->office_id)){
      $office_id = $budget_office->office_id;
      $budget_year = $budget_office->budget_year;
      $office_name = $budget_office->office_name;
      $budget_tag_name = $budget_office->budget_tag_name;
      $budget_status_id = $budget_office->status_id;
    }

    $this->db->select(array('funder_id','funder_name','project_allocation_id','project_allocation_name'));
    $this->db->join('project_allocation','project_allocation.fk_project_id=project.project_id');
    $this->db->join('funder','funder.funder_id=project.fk_funder_id');
    $this->db->where(array('fk_office_id'=>$office_id));
    $projects = $this->db->get('project')->result_object();

    $data = [];

    $funder_projects = [];

    foreach($projects as $project){
      $data['funder_projects'][$project->funder_id]['funder'] = ['funder_id'=>$project->funder_id,'funder_name'=>$project->funder_name];
      $data['funder_projects'][$project->funder_id]['projects'][] = ['project_allocation_id'=>$project->project_allocation_id,'project_allocation_name'=>$project->project_allocation_name];
    }

    $data['current_year'] = $budget_year;
    $data['office'] = $office_name;
    $data['budget_tag'] = $budget_tag_name;
    $data['status_id'] = $budget_status_id;
    

    return $data;
  }

  //function budget_schedule_result($office_id,$year,$income_account,$funder_id){
  function budget_schedule_result($income_account_id){  
    $result = [];

    $budget_office = $this->budget_office();

    $this->db->select(array('budget_item_id','budget_item_total_cost',
    'budget_item_description','status_id','status_name','fk_project_allocation_id',
    'budget_item_detail_id','budget_item_detail_amount',
    'month_id','month_name','month_number','fk_office_id','budget_year','income_account_name',
    'income_account_id','income_account_code','expense_account_id','expense_account_name',
    'expense_account_code'));

    $this->db->where(array('income_account_id'=>$income_account_id));

    $this->db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
    $this->db->join('budget','budget.budget_id=budget_item.fk_budget_id');
    $this->db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $this->db->join('month','month.month_id=budget_item_detail.fk_month_id');
    $this->db->join('status','status.status_id=budget_item.fk_status_id');
    $this->db->order_by('month_order ASC');
    $this->db->where(array('fk_office_id'=>$budget_office->office_id,'budget_year'=>$budget_office->budget_year,'fk_budget_id'=>hash_id($this->id,'decode')));
    $budget_item_details = $this->db->get('budget_item_detail')->result_object();

    $result_grid = [];
    $month_spread = [];

    foreach($budget_item_details as $row){
      $month_spread[$row->budget_item_id][$row->month_number] =  
      [
        'month_id'=>$row->month_id,
        'month_number'=>$row->month_number,
        'month_name'=>$row->month_name,
        'amount'=>$row->budget_item_detail_amount
      ];
    }

    foreach($budget_item_details as $row){
      
      $result_grid[$row->income_account_id]['income_account'] = ['income_account_id'=>$row->income_account_id,'income_account_name'=>$row->income_account_name,'income_account_code'=>$row->income_account_code];
      $result_grid[$row->income_account_id]['budget_items'][$row->expense_account_id]['expense_account'] = ['expense_account_id'=>$row->expense_account_id,'expense_account_name'=>$row->expense_account_name,'expense_account_code'=>$row->expense_account_code];
      $result_grid[$row->income_account_id]['budget_items'][$row->expense_account_id]['expense_items'][$row->budget_item_id] = 
        [
          'budget_item_id'=>$row->budget_item_id,
          //'budget_item_track_number'=>$row->budget_item_track_number,
          'description'=>$row->budget_item_description,
          'total_cost'=>$row->budget_item_total_cost,
          'status'=>['status_id'=>$row->status_id,'status_name'=>$row->status_name],
          'month_spread'=>$month_spread[$row->budget_item_id]
        ];
         
      }

    //$result_grid['spreading_of_month'] = $month_spread;
    return $result_grid;
  }

  function result($id = ''){
    
    $segment_budget_view_type = $this->uri->segment(4,'summary');
    
    $result = [];
  
    $budget_header = $this->budget_header_information();

    if($this->action == 'view'){
      if($segment_budget_view_type == 'summary'){
        $budget_summary = $this->budget_summary_result();
        $result = array_merge($budget_header,$budget_summary);
      }else{

        $income_account_id = hash_id($this->uri->segment(5),'decode');

        $this->read_db->select(array('month_number','month_name'));
        $this->read_db->order_by('month_order ASC');
        $month_array = $this->read_db->get('month')->result_array();
    
        $month_numbers = array_column($month_array,'month_number');
        $month_names = array_column($month_array,'month_name');
    
        $budget_schedule['month_names_with_number_keys'] = array_combine($month_numbers,$month_names);
        $budget_schedule['budget_schedule'] = $this->budget_schedule_result($income_account_id);
        $is_current_review['is_current_review'] = $this->check_if_current_review();
        $result = array_merge($budget_header,$budget_schedule,$is_current_review);
      }
    }else{
      $result = parent::result($id = '');
    }

    return $result;
  }

  function check_if_current_review(){
    $budget_id = hash_id($this->id,'decode');

    // Get office object for the budget
    $this->read_db->select(array('budget_year','fk_office_id','budget_tag_level'));
    $this->read_db->join('budget_tag','budget_tag.budget_tag_id=budget.fk_budget_tag_id');
    $budget_obj = $this->read_db->get_where('budget',array('budget_id'=>$budget_id))->row();

    $fy = $budget_obj->budget_year;
    $office_id = $budget_obj->fk_office_id;
    $current_budget_tag_level = $budget_obj->budget_tag_level;

    // Get all used budget tag levels for office and fy
    $this->read_db->select(array('budget_tag_level'));
    $this->read_db->join('budget_tag','budget_tag.budget_tag_id=budget.fk_budget_tag_id');
    $this->read_db->order_by('budget_tag_level ASC');
    $budget_tag_levels = $this->read_db->get_where('budget',array('fk_office_id'=>$office_id,'budget_year'=>$fy))->result_array();

    $budget_tag_levels_array = array_column($budget_tag_levels,'budget_tag_level');

    $max_used_level = array_pop($budget_tag_levels_array);

    if($current_budget_tag_level == $max_used_level){
      return true;
    }else{
      return false;
    }
  }

  
  function page_name():String{

    $segment_budget_view_type = parent::page_name();

    if($this->action == 'view'){

      $segment_budget_view_type = $this->uri->segment(4,'summary');

      if($this->uri->segment(4) && $this->uri->segment(4) == 'schedule'){
        $segment_budget_view_type = 'budget_schedule_view';
      }else{
        $segment_budget_view_type = 'budget_summary_view';
      }


    }

    return $segment_budget_view_type;
  }

  function view(){
    parent::view();
  }

  static function get_menu_list(){

  }

}

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
    'budget_year'=>$budget_office->budget_year));
    $this->db->group_by(array('fk_month_id','expense_account_id','income_account_id'));
    $this->db->order_by('month_order ASC');
    $result_raw  = $this->db->get('budget')->result_object();

    $result = [];
    
    foreach($result_raw as $detail){
      
      $result[$detail->income_account_id]['income_account'] = ['income_account_name'=>$detail->income_account_name,'income_account_code'=>$detail->income_account_code];
      $result[$detail->income_account_id]['spread_expense_account'][$detail->expense_account_id]['expense_account'] = ['account_name'=>$detail->expense_account_name,'account_code'=>$detail->expense_account_code];        
      $result[$detail->income_account_id]['spread_expense_account'][$detail->expense_account_id]['spread'][$detail->month_name] = $detail->budget_item_detail_amount;
      
    }
    
  $data['summary'] =  $result;
  $data['test'] = $result_raw;    

    return $data;
  }

  function budget_office(){
    $this->db->select(array('office_id','office_name','office_code','budget_year'));
    $this->db->join('office','office.office_id=budget.fk_office_id'); 
    $budget_office = $this->db->get_where('budget',
    array('budget_id'=>hash_id($this->id,'decode')))->row();

    return $budget_office;
  }

  function budget_header_information($budget_year = ''){

    $budget_office = $this->budget_office();
    
    $budget_year = 0;
    $office_id = 0;
    $office_name = "";
    
    if(isset($budget_office->office_id)){
      $office_id = $budget_office->office_id;
      $budget_year = $budget_office->budget_year;
      $office_name = $budget_office->office_name;
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

    return $data;
  }

  function budget_schedule_result($office_id = 9,$year = 2020,$income_account = 1,$funder_id = 1){
    $result = [];

    $budget_office = $this->budget_office();

    $this->db->select(array('budget_item_id','budget_item_track_number','budget_item_total_cost',
    'budget_item_description','status_id','status_name','fk_project_allocation_id','budget_item_detail_amount',
    'month_id','month_name','month_number','fk_office_id','budget_year','income_account_name',
    'income_account_id','income_account_code','expense_account_id','expense_account_name',
    'expense_account_code','budget_item_detail_id'));

    $this->db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
    $this->db->join('budget','budget.budget_id=budget_item.fk_budget_id');
    $this->db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $this->db->join('month','month.month_id=budget_item_detail.fk_month_id');
    $this->db->join('status','status.status_id=budget_item.fk_status_id');
    $this->db->where(array('fk_office_id'=>$budget_office->office_id,'budget_year'=>$budget_office->budget_year));
    $result_raw = $this->db->get('budget_item_detail')->result_object();

    $result_grid = [];
    $month_spread = [];

    foreach($result_raw as $row){
      
      $result_grid[$row->income_account_id]['income_account'] = ['income_account_id'=>$row->income_account_id,'income_account_name'=>$row->income_account_name,'income_account_code'=>$row->income_account_code];
      $result_grid[$row->income_account_id]['budget_items'][$row->expense_account_id]['expense_account'] = ['expense_account_id'=>$row->expense_account_id,'expense_account_name'=>$row->expense_account_name,'expense_account_code'=>$row->expense_account_code];
      $result_grid[$row->income_account_id]['budget_items'][$row->expense_account_id]['expense_items'][$row->budget_item_id] = 
        [
          'budget_item_id'=>$row->budget_item_id,
          'budget_item_track_number'=>$row->budget_item_track_number,
          'description'=>$row->budget_item_description,
          'total_cost'=>$row->budget_item_total_cost,
          'status'=>['status_id'=>$row->status_id,'status_name'=>$row->status_name],
          //'month_spread'=>['month_id'=>$row->month_id,'month_name'=>$row->month_name,'amount'=>$row->budget_item_detail_amount],
        ];
        
        //$result_grid[$row->income_account_id]['budget_items'][$row->expense_account_id]['expense_items'][$row->budget_item_id]['month_spread'][$row->budget_item_detail_id] = ['month_id'=>$row->month_id,'month_name'=>$row->month_name,'amount'=>$row->budget_item_detail_amount];
        
      }
    
    $result = [
      'budget_schedule'=>$result_grid,
      'raw'=> $result_raw,
      'test'=>[
          [
            'income_account'=> ['income_account_id'=>1,'income_account_name'=>'Income Account 1'] ,
            'budget_items'=>[
              1=>[
                  'expense_account'=>['expense_account_id'=>1,'expense_account_code'=>'E001','expense_account_name'=>'Expense Account 1'],
                  'expense_items'=> [
                    [
                      'budget_item_track_number'=>'BUEM-87902',
                      'description'=>'Training Cost',
                      'quantity'=>3,
                      'unit_cost'=>30000.00,
                      'total_cost'=>90000.00,
                      'status'=>['status_id'=>2,'status_name'=>'New'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>20000.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>20000.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>20000.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>30000.00],
                      ]
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-65765',
                      'description'=>'Office Supplies',
                      'quantity'=>10,
                      'unit_cost'=>5000.00,
                      'total_cost'=>50000.00,
                      'status'=>['status_id'=>1,'status_name'=>'Approved'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>10000.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>10000.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>10000.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>10000.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>10000.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-35445',
                      'description'=>'Training Cost',
                      'quantity'=>2,
                      'unit_cost'=>10000.00,
                      'total_cost'=>20000.00,
                      'status'=>['status_id'=>3,'status_name'=>'Declined'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>20000.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]    
                    ],
                  ]  
                ],
  
                2 =>[
                  'expense_account'=>['expense_account_id'=>2,'expense_account_code'=>'E002','expense_account_name'=>'Expense Account 2'],
                  'expense_items'=> [
                    [
                      'budget_item_track_number'=>'BUEM-34323',
                      'description'=>'Transport',
                      'quantity'=>3,
                      'unit_cost'=>15000.00,
                      'total_cost'=>45000.00,
                      'status'=>['status_id'=>4,'status_name'=>'Returned For Rework'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>20000.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>25000.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-23434',
                      'description'=>'Awareness forums',
                      'quantity'=>5,
                      'unit_cost'=>8000.00,
                      'total_cost'=>40000.00,
                      'status'=>['status_id'=>5,'status_name'=>'Submitted'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>10000.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>10000.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>10000.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>10000.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-35445',
                      'description'=>'Rent for 2 offices',
                      'quantity'=>2,
                      'unit_cost'=>25000.00,
                      'total_cost'=>50000.00,
                      'status'=>['status_id'=>6,'status_name'=>'Approved'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>25000.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>25000.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                  ]  
                ],
  
                
            ],
          ],
          [
            'income_account'=> ['income_account_id'=>2,'income_account_name'=>'Income Account 2'] ,
            'budget_items'=>[
              1=>[
                  'expense_account'=>['expense_account_id'=>3,'expense_account_code'=>'E003','expense_account_name'=>'Expense Account 3'],
                  'expense_items'=> [
                    [
                      'budget_item_track_number'=>'BUEM-87902',
                      'description'=>'Training Cost',
                      'quantity'=>3,
                      'unit_cost'=>30000.00,
                      'total_cost'=>90000.00,
                      'status'=>['status_id'=>2,'status_name'=>'New'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>20000.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>20000.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>20000.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>30000.00],
                      ]
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-65765',
                      'description'=>'Office Supplies',
                      'quantity'=>10,
                      'unit_cost'=>5000.00,
                      'total_cost'=>50000.00,
                      'status'=>['status_id'=>1,'status_name'=>'Approved'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>10000.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>10000.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>10000.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>10000.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>10000.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-35445',
                      'description'=>'Training Cost',
                      'quantity'=>2,
                      'unit_cost'=>10000.00,
                      'total_cost'=>20000.00,
                      'status'=>['status_id'=>3,'status_name'=>'Declined'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>20000.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]    
                    ],
                  ]  
                ],
  
                2 =>[
                  'expense_account'=>['expense_account_id'=>4,'expense_account_code'=>'E004','expense_account_name'=>'Expense Account 4'],
                  'expense_items'=> [
                    [
                      'budget_item_track_number'=>'BUEM-34323',
                      'description'=>'Transport',
                      'quantity'=>3,
                      'unit_cost'=>15000.00,
                      'total_cost'=>45000.00,
                      'status'=>['status_id'=>4,'status_name'=>'Returned For Rework'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>20000.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>25000.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-23434',
                      'description'=>'Awareness forums',
                      'quantity'=>5,
                      'unit_cost'=>8000.00,
                      'total_cost'=>40000.00,
                      'status'=>['status_id'=>5,'status_name'=>'Submitted'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>0.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>10000.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>10000.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>0.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>10000.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>10000.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                    [
                      'budget_item_track_number'=>'BUEM-35445',
                      'description'=>'Rent for 2 offices',
                      'quantity'=>2,
                      'unit_cost'=>25000.00,
                      'total_cost'=>50000.00,
                      'status'=>['status_id'=>6,'status_name'=>'Approved'],
                      'month_spread'=>[
                        ['month_id'=>1,'month_name'=>'Jan','amount'=>25000.00],
                        ['month_id'=>2,'month_name'=>'Feb','amount'=>0.00],
                        ['month_id'=>3,'month_name'=>'Mar','amount'=>0.00],
                        ['month_id'=>4,'month_name'=>'Apr','amount'=>0.00],
                        ['month_id'=>5,'month_name'=>'May','amount'=>0.00],
                        ['month_id'=>6,'month_name'=>'Jun','amount'=>0.00],
                        ['month_id'=>7,'month_name'=>'Jul','amount'=>25000.00],
                        ['month_id'=>8,'month_name'=>'Aug','amount'=>0.00],
                        ['month_id'=>9,'month_name'=>'Sep','amount'=>0.00],
                        ['month_id'=>10,'month_name'=>'Oct','amount'=>0.00],
                        ['month_id'=>11,'month_name'=>'Nov','amount'=>0.00],
                        ['month_id'=>12,'month_name'=>'Dec','amount'=>0.00],
                      ]  
                    ],
                  ]  
                ],
  
                
            ],
          ]
      ]
     
    ];

    return $result;
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
        $budget_schedule = $this->budget_schedule_result();
        $result = array_merge($budget_header,$budget_schedule);
      }
    }else{
      $result = parent::result($id = '');
    }

    return $result;
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

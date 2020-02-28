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

  function budget_summary_result(){
    return [];
  }

  function budget_header_information($office_id = 9, $year = 2020){
    $data = [
        'funder_projects'=>[
          [
            'funder'=>['funder_id'=>1,'funder_name'=>'Funder 1'],
            'projects'=>[
                ['project_allocation_id'=>1,'project_allocation_name'=>'Project 1'],
                ['project_allocation_id'=>2,'project_allocation_name'=>'Project 2'],
                ['project_allocation_id'=>3,'project_allocation_name'=>'Project 3'],
              ]
          ],
          [
            'funder'=>['funder_id'=>1,'funder_name'=>'Funder 2'],
            'projects'=>[
                ['project_allocation_id'=>4,'project_allocation_name'=>'Project 4'],
                ['project_allocation_id'=>5,'project_allocation_name'=>'Project 5'],
                ['project_allocation_id'=>6,'project_allocation_name'=>'Project 6'],
              ]
          ],
        ],
        
        'current_year'=>2020,
        'office'=>'GRC Shingila',
        
      ];

      return $data;
  }

  function budget_schedule_result($office_id = 9,$year = 2020,$income_account = 1,$funder_id = 1){
    $result = [
      'budget_schedule'=>[
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

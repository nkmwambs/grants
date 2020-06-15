<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Journal_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'journal'; // you MUST mention the table name
  public $primary_key = 'journal_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
  public $hidden_columns = array();

  function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->model('general_model');
  }

  function delete($id = null){

  }

  function index(){

  }

  public function lookup_tables(){
    return ['office'];
  }

  public function detail_tables(){}

  public function table_visible_columns(){}

  public function table_hidden_columns(){}

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list(){
    
  }

  public function show_add_button(){
    return false;
  }

  public function view(){}

  function get_office_banks($office_id){
    $this->db->select(array('fk_office_id'));
    $office_banks = $this->db->get_where('office_bank',
    array('fk_office_id'=>$office_id))->result_array();

    return $office_banks;
  }

  // private function system_opening_cash_balance($office_id,$office_bank_id = 0){

  //   $balance = 0;

  //   //Only get balance if args project_allocation_ids and office_bank_id as supplied or none of them

  //   if($office_bank_id > 0 ){
  //       $this->db->where(array('fk_office_bank_id'=>$office_bank_id));
  //   }

  //   $this->db->select_sum('opening_cash_balance_amount');
  //   $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_cash_balance.fk_system_opening_balance_id');

  //   $opening_cash_balance_obj = $this->db->get_where('opening_cash_balance',array('fk_office_id'=>$office_id));
    
  //   if($opening_cash_balance_obj->num_rows()>0){
  //      $balance = $opening_cash_balance_obj->row()->opening_cash_balance_amount; 
  //   }
   

  //   return $balance;
  // }


  private function system_opening_bank_balance($office_id, $office_bank_id = 0){
    $balances = [];

    $this->db->select(array('opening_bank_balance_amount','office_bank_id','office_bank_name'));
    $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_bank_balance.fk_system_opening_balance_id');
    $this->db->join('office_bank','office_bank.office_bank_id=opening_bank_balance.fk_office_bank_id');
    
    if($office_bank_id > 0){
      $this->db->where(array('office_bank_id'=>$office_bank_id));
    }
    
    $opening_bank_balance_obj = $this->db->get_where('opening_bank_balance',array('office_bank.fk_office_id'=>$office_id,'system_opening_balance.fk_office_id'=>$office_id));
    
    if($opening_bank_balance_obj->num_rows()>0){
      $opening_bank_balances = $opening_bank_balance_obj->result_array();

      foreach($opening_bank_balances as $opening_bank_balance){
        $balances[$opening_bank_balance['office_bank_id']] = ['account_name'=>$opening_bank_balance['office_bank_name'],'amount'=>$opening_bank_balance['opening_bank_balance_amount']];
      }
    }

    return $balances;
  }

  private function system_opening_cash_balance($office_id,$office_bank_id = 0){

    $account_system_id = $this->grants_model->get_type_name_by_id('office',$office_id,'fk_account_system_id');
    
    if($office_bank_id > 0){
      $this->db->where(array('opening_cash_balance.fk_office_bank_id'=>$office_bank_id));
    }
    
    $this->db->select_sum('opening_cash_balance_amount');
    $this->db->group_by('office_cash_id');
    $this->db->select(array('office_cash_name','fk_office_cash_id'));
    $this->db->join('office_cash','office_cash.office_cash_id=opening_cash_balance.fk_office_cash_id');
    $this->db->join('system_opening_balance','system_opening_balance.system_opening_balance_id=opening_cash_balance.fk_system_opening_balance_id');
    $petty_cash_accounts = $this->db->get_where('opening_cash_balance',
    array('system_opening_balance.fk_office_id'=>$office_id,'office_cash.fk_account_system_id'=>$account_system_id))->result_array();

    $result = [];

    foreach($petty_cash_accounts as $petty_cash_account){
      $result[$petty_cash_account['fk_office_cash_id']]['account_name'] = $petty_cash_account['office_cash_name'];
      $result[$petty_cash_account['fk_office_cash_id']]['amount'] = $petty_cash_account['opening_cash_balance_amount'];
    }

    return $result;
  }

  
  function month_opening_bank_cash_balance($office_id,$transacting_month,$office_bank_id = 0){

    $system_opening_bank = $this->system_opening_bank_balance($office_id, $office_bank_id); 
    //$system_opening_cash = $this->system_opening_cash_balance($office_id,$office_bank_id); 
    //$system_opening_cash = $this->system_opening_cash_balance($office_id,$office_bank_id);
    $system_opening_cash = $this->system_opening_cash_balance($office_id,$office_bank_id);

    $bank_to_date_income = [];
    $bank_to_date_expense = [];
    $month_bank_opening = [];

    $cash_to_date_income = [];
    $cash_to_date_expense = [];
    $month_cash_opening = [];
    

    foreach($system_opening_bank as $office_bank_id => $balance_amount){
      $bank_to_date_income[$office_bank_id] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'bank','income',$office_bank_id);
      $bank_to_date_expense[$office_bank_id] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'bank','expense',$office_bank_id);
      $month_bank_opening[$office_bank_id]['account_name'] = $system_opening_bank[$office_bank_id]['account_name'];
      $month_bank_opening[$office_bank_id]['amount'] = $system_opening_bank[$office_bank_id]['amount'] + ($bank_to_date_income[$office_bank_id] - $bank_to_date_expense[$office_bank_id]);
    }

    foreach($system_opening_cash as $office_cash_id => $office_cash_balance_amount){
        $cash_to_date_income[$office_cash_id] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'cash','income',$office_bank_id,$office_cash_id);
        $cash_to_date_expense[$office_cash_id] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'cash','expense',$office_bank_id,$office_cash_id);
        $month_cash_opening[$office_cash_id]['account_name'] = $system_opening_cash[$office_cash_id]['account_name'];
        $month_cash_opening[$office_cash_id]['amount'] = $system_opening_cash[$office_cash_id]['amount'] + ($cash_to_date_income[$office_cash_id] - $cash_to_date_expense[$office_cash_id]);
    }

    //print_r($system_opening_cash);exit;
    
    return ['bank'=>$month_bank_opening,'cash'=>$month_cash_opening];
  }


  private function get_cash_income_or_expense_to_date($office_id,$transacting_month,$cash_account,$transaction_effect,$office_bank_id = 0, $office_cash_id = 0){

    $this->db->select_sum('voucher_detail_total_cost');
    
    if($office_bank_id){
      $this->db->where(array('fk_office_bank_id'=>$office_bank_id));
    }

    if($office_cash_id){
      $this->db->where(array('fk_office_cash_id'=>$office_cash_id));
    }

    $this->db->where('voucher_date < ',date('Y-m-01',strtotime($transacting_month)));
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');

    return $this->db->get_where('voucher_detail',
    array('fk_office_id'=>$office_id,
    'voucher_type_account_code'=>$cash_account,'voucher_type_effect_code'=>$transaction_effect))->row()->voucher_detail_total_cost;
    
  }


  function get_office_data_from_journal($journal_id){

    $this->db->select(array('office_id','office_name','journal_id','journal_month'));
    $this->db->join('journal','journal.fk_office_id=office.office_id');
    $this->db->where(array('journal_id'=>$journal_id));
    $row  = $this->db->get('office')->row();

    return $row;
  } 

  private function navigate_month_journal($office_id, $transacting_month,$direction = 'next'){

      $journal = null;

      $direction_phrase = 'first day of next month';

      if($direction == 'previous'){
        $direction_phrase = 'first day of last month';
      }

      $month = date('Y-m-01',strtotime($direction_phrase,strtotime($transacting_month)));
      $journal_obj = $this->db->get_where('journal',
      array('journal_month'=>$month,'fk_office_id'=>$office_id));

      if($journal_obj->num_rows()>0){
        $journal = $journal_obj->row();
      }

      return $journal;
  }


  function journal_navigation($office_id, $transacting_month){

      $prev = $this->navigate_month_journal($office_id, $transacting_month,'previous');
      $next = $this->navigate_month_journal($office_id, $transacting_month,'next');

      $prev = $prev != null?$prev->journal_id:null;
      $next = $next != null?$next->journal_id:null;

      return ['previous'=>$prev,'next'=>$next];
  }

  /**
   * @todo - to be taken to income_accounts model. Only get used accounts in the month (Not yet done)
   */
  private function income_accounts(){
    $this->db->select(array('income_account_id','income_account_code'));
    $accounts = $this->db->get('income_account')->result_array();

    $ids = array_column($accounts,'income_account_id');
    $code = array_column($accounts,'income_account_code');

    return array_combine($ids,$code);
  }

  /**
   * @todo - to be taken to expense_accounts model. Only get used accounts in the month (Not yet done)
   */
  private function expense_accounts(){
    $this->db->select(array('expense_account_id','expense_account_code'));
    $accounts =  $this->db->get('expense_account')->result_array();

    $ids = array_column($accounts,'expense_account_id');
    $code = array_column($accounts,'expense_account_code');

    return array_combine($ids,$code);
  }

  function financial_accounts(){
    return [
      'income'=>$this->income_accounts(),
      'expense'=>$this->expense_accounts(),
    ];
  }
  
  function get_all_office_month_vouchers($office_id,$transacting_month,$project_allocation_ids = [], $office_bank_id = 0){
    
    $result = [];

    if(
        (count($project_allocation_ids) > 0 && $office_bank_id > 0) || 
        (count($project_allocation_ids) == 0 && $office_bank_id == 0) || 
        (count($project_allocation_ids) == 0 && $office_bank_id > 0)
      ){

      $month_start_date = date('Y-m-01',strtotime($transacting_month));
      $month_end_date = date('Y-m-t',strtotime($transacting_month));
      
      $this->db->where($this->general_model->max_status_id_where_condition_by_created_date('voucher',$month_start_date));
      $this->db->select(array('voucher_id','voucher_number','voucher_date','voucher_vendor',
      'voucher_cleared','voucher_cleared_month','voucher_cheque_number','voucher_description',
      'voucher_cleared_month','voucher.fk_status_id as fk_status_id','voucher_created_date'));
      $this->db->select(array('voucher_type_abbrev','voucher_type_name'));
      $this->db->select(array('voucher_type_account_code'));
      $this->db->select(array('voucher_type_effect_code'));
      $this->db->select(array('voucher_detail_total_cost','fk_expense_account_id','fk_income_account_id','fk_contra_account_id','fk_office_bank_id','fk_office_cash_id'));
      
      //$this->db->select_sum('voucher_detail_total_cost');
      
      $this->db->where('voucher_date >=', $month_start_date);
      $this->db->where('voucher_date <=', $month_end_date);
      $this->db->where('fk_office_id',$office_id);
      //$this->db->where(array('voucher.fk_status_id'=>$this->approval_model->get_max_approval_status_id('voucher')));
      
      $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
      $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
      $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');  
      $this->db->join('voucher_detail','voucher_detail.fk_voucher_id=voucher.voucher_id');
      
      if(count($project_allocation_ids)>0){
        $this->db->where_in('fk_project_allocation_id',$project_allocation_ids);
      }

      if($office_bank_id > 0){
        $this->db->or_where('fk_office_bank_id',$office_bank_id);
      }
  
      //$this->db->group_by('voucher_id');
  
      $result = $this->db->order_by('voucher_id','ASC')->get('voucher')->result_array();
    }

    return $result;

  }

  function reorder_office_month_vouchers($office_id,$transacting_month,$project_allocation_ids = [], $office_bank_id = 0){

    $approveable_item = $this->db->get_where('approve_item',
    array('approve_item_name'=>'voucher'))->row();
    
    $raw_array_of_vouchers = $this->get_all_office_month_vouchers($office_id,$transacting_month,$project_allocation_ids, $office_bank_id);

    $voucher_record = [];

    foreach($raw_array_of_vouchers as $voucher_detail){
        
        extract($voucher_detail);

        //if(!$this->general_model->check_if_item_has_max_status_by_created_date($approveable_item,$voucher_created_date, $fk_status_id)) continue;

        $voucher_record[$voucher_id] = [
          'date'=>$voucher_date,
          'payee'=>$voucher_vendor,
          'voucher_type_abbrev'=>$voucher_type_abbrev,
          'voucher_type_name'=>$voucher_type_name,
          'voucher_type_cash_account'=>$voucher_type_account_code,
          'voucher_type_transaction_effect'=>$voucher_type_effect_code,
          'voucher_number'=>$voucher_number,
          'description'=>$voucher_description,
          'cleared'=>$this->check_if_voucher_is_cleared_in_month($voucher_cleared,$voucher_cleared_month,$transacting_month,$voucher_type_account_code,$voucher_type_effect_code),
          'cleared_month'=>$voucher_cleared_month,
          'cheque_number'=>$voucher_cheque_number,
          'office_bank_id'=>$fk_office_bank_id,
          'office_cash_id'=>$fk_office_cash_id,
          'spread'=>$this->get_voucher_spread($raw_array_of_vouchers,$voucher_id)

        ];
        
      }
    
    return $voucher_record;

  }

  private function check_if_voucher_is_cleared_in_month($voucher_cleared,$voucher_cleared_month,$transacting_month,$voucher_type_account_code,$voucher_type_effect_code){
    $is_cleared = false;

    if(
        ( $voucher_cleared && 
          (strtotime(date('Y-m-01',strtotime($voucher_cleared_month))) <= strtotime(date('Y-m-01',strtotime($transacting_month))))
        ) 
        ||
        (
          (!strpos($voucher_type_effect_code,'contra') && $voucher_type_account_code !== 'bank')
      
        )
      )
      {
        $is_cleared = true;
    }

    return $is_cleared;

  }

  function get_voucher_spread($all_voucher_details,$current_voucher_id){
    
    $spread = [];
    
    $count = 0;

    foreach($all_voucher_details as $voucher_details){
      
      extract($voucher_details);

      if($current_voucher_id == $voucher_id){

        if($voucher_type_effect_code == 'income'){
          $spread[$count]['account_id'] = $fk_income_account_id;
        }elseif($voucher_type_effect_code == 'bank_contra'){
          $spread[$count]['account_id'] = $fk_bank_contra_account_id;
        }elseif($voucher_type_effect_code == 'cash_contra'){  
          $spread[$count]['account_id'] = $fk_cash_contra_account_id;
        }else{
          $spread[$count]['account_id'] = $fk_expense_account_id;
        }

        
        $spread[$count]['transacted_amount'] = $voucher_detail_total_cost;
        $count++;
      }
     
    }

    return $spread;
  }

  function journal_records($office_id,$transacting_month,$project_allocation_ids = [], $office_bank_id = 0){
    return $this->reorder_office_month_vouchers($office_id,$transacting_month, $project_allocation_ids, $office_bank_id);
  }

  function list_table_where(){
    
    // Only list requests from the users' hierachy offices
    if(count($this->session->hierarchy_offices) == 0){
      $message = "You do not have offices in your hierarchy. 
      Kindly ask the administrator to add an office or <a href='".$_SERVER['HTTP_REFERER']."'/>go back</a>";         
      show_error($message,500,'An Error As Encountered'); 
    }else{
      $this->db->where_in($this->controller.'.fk_office_id',array_column($this->session->hierarchy_offices,'office_id'));
    }  
  }

}

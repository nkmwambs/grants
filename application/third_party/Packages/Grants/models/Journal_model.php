<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Journal_model extends MY_Model 
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

  public function lookup_tables(){
    return ['office'];
  }
 

  public function show_add_button(){
    return false;
  }

  function get_office_banks($office_id){
    $this->db->select(array('fk_office_id'));
    $office_banks = $this->db->get_where('office_bank',
    array('fk_office_id'=>$office_id))->result_array();

    return $office_banks;
  }


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

    // Get all office banks - Fill up banks without opening system balance
    $this->read_db->select(array('office_bank_id','office_bank_name'));
    $office_banks_obj = $this->read_db->get_where('office_bank',array('fk_office_id'=>$office_id));

    if($office_banks_obj->num_rows() > 0){
      $office_banks = $office_banks_obj->result_array();

      foreach($office_banks as $office_bank){
        if(!array_key_exists($office_bank['office_bank_id'],$balances)){
          $balances[$office_bank['office_bank_id']] = ['account_name'=>$office_bank['office_bank_name'],'amount'=>0];
        }
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

    // Get all office cash boxes
    $this->read_db->select(array('office_cash_id','office_cash_name'));
    $this->read_db->join('account_system','account_system.account_system_id=office_cash.fk_account_system_id');
    $this->read_db->join('office','office.fk_account_system_id=account_system.account_system_id');
    $office_cash_obj = $this->read_db->get_where('office_cash',array('office_id'=>$office_id));

    if($office_cash_obj->num_rows() > 0){
      $office_cash = $office_cash_obj->result_array();

      foreach($office_cash as $box){
        if(!array_key_exists($box['office_cash_id'],$result)){
          $result[$box['office_cash_id']]['account_name'] = $box['office_cash_name'];
          $result[$box['office_cash_id']]['amount'] = 0;
        }
      }
    }

    return $result;
  }

  
  function month_opening_bank_cash_balance($office_id,$transacting_month,$office_bank_id = 0){

    $system_opening_bank = $this->system_opening_bank_balance($office_id, $office_bank_id); 
    $system_opening_cash = $this->system_opening_cash_balance($office_id,$office_bank_id);

    //echo json_encode($system_opening_bank);exit;
    
    $bank_to_date_income = [];
    $bank_to_date_expense = [];
    $month_bank_opening = [];

    $cash_to_date_income = [];
    $cash_to_date_expense = [];
    $month_cash_opening = [];
    
    
    foreach($system_opening_bank as $office_bank_id_in_loop => $balance_amount){
      $bank_to_date_income[$office_bank_id_in_loop] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'bank','income',$office_bank_id_in_loop);
      $bank_to_date_expense[$office_bank_id_in_loop] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'bank','expense',$office_bank_id_in_loop);
      $month_bank_opening[$office_bank_id_in_loop]['account_name'] = $system_opening_bank[$office_bank_id_in_loop]['account_name'];
      $month_bank_opening[$office_bank_id_in_loop]['amount'] = $system_opening_bank[$office_bank_id_in_loop]['amount'] + ($bank_to_date_income[$office_bank_id_in_loop] - $bank_to_date_expense[$office_bank_id_in_loop]);
    }

    
    foreach($system_opening_cash as $office_cash_id => $office_cash_balance){
        $cash_to_date_income[$office_cash_id] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'cash','income',$office_bank_id,$office_cash_id);
        $cash_to_date_expense[$office_cash_id] = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'cash','expense',$office_bank_id,$office_cash_id);
        $month_cash_opening[$office_cash_id]['account_name'] = $office_cash_balance['account_name'];
        $month_cash_opening[$office_cash_id]['amount'] = $office_cash_balance['amount'] + ($cash_to_date_income[$office_cash_id] - $cash_to_date_expense[$office_cash_id]);
    }

    //echo json_encode( ['bank'=>$month_bank_opening,'cash'=>$month_cash_opening]);exit;
    return ['bank'=>$month_bank_opening,'cash'=>$month_cash_opening];
  }

  function get_office_bank_project_allocation($office_bank_id){
    //$this->db->select(array('fk_project_allocation_id','fk_office_bank_id'));
    $office_bank_project_allocations = $this->db->
    where(array('fk_office_bank_id'=>$office_bank_id))->
    get('office_bank_project_allocation')->result_array();

    return $office_bank_project_allocations;
  }

  public function get_cash_income_or_expense_to_date($office_id,$transacting_month,$cash_account,$transaction_effect,$office_bank_id = 0, $office_cash_id = 0){
    
    $office_bank_project_allocations = $this->get_office_bank_project_allocation($office_bank_id);

    //return json_encode($office_bank_project_allocations);

    $office_bank_ids = array_unique(array_column($office_bank_project_allocations,'fk_office_bank_id'));
    
    //print_r($office_bank_ids);exit;

    //return $office_bank_id;

    $this->db->select_sum('voucher_detail_total_cost');

    $this->db->where('voucher_date < ',date('Y-m-01',strtotime($transacting_month)));
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');

    if($office_bank_id){
      $this->db->group_start();
        $this->db->where(array('fk_office_bank_id'=>$office_bank_id));
        
        $allocation_ids = array_column($office_bank_project_allocations,'fk_project_allocation_id');
        
        if(in_array($office_bank_id,$office_bank_ids)){  
          $this->db->or_where_in('fk_project_allocation_id',$allocation_ids);
          $this->db->where(array('fk_office_bank_id'=>$office_bank_id));
        }

        $this->db->group_end();
    }

    if($office_cash_id){
      $this->db->where(array('fk_office_cash_id'=>$office_cash_id,'fk_office_id'=>$office_id));
    }

     /*1: Cash income has [voucher_type_account_code of cash and a voucher_type_effect_code of income] 
      OR [voucher_type_account_code of  bank and a voucher_type_effect_code of contra] 

      2: Cash expense has [voucher_type_account_code of cash and a voucher_type_effect_code of expense] 
      OR [voucher_type_account_code of  cash and a voucher_type_effect_code of contra] 

      3: Bank income has [voucher_type_account_code of bank and a voucher_type_effect_code of income] 
      OR [voucher_type_account_code of  cash and a voucher_type_effect_code of contra] 

      4: Bank expense has [voucher_type_account_code of bank and a voucher_type_effect_code of expense] 
      OR [voucher_type_account_code of  bank and a voucher_type_effect_code of contra] 
    
    */
    
    if(($cash_account=='cash' && $transaction_effect=='income') || ($cash_account=='bank' && $transaction_effect=='bank_contra') ){
      $this->db->group_start();
         $this->db->where(array('voucher_type_account_code'=>'cash','voucher_type_effect_code'=>'income'));

          $this->db->or_group_start();
            $this->db->where(array('voucher_type_account_code'=>'bank','voucher_type_effect_code'=>'bank_contra'));
          $this->db->group_end();

      $this->db->group_end();

    }

    elseif(($cash_account=='cash' && $transaction_effect=='expense') || ($cash_account=='cash' && $transaction_effect=='cash_contra') ){

      $this->db->group_start();
        $this->db->where(array('voucher_type_account_code'=>'cash','voucher_type_effect_code'=>'expense'));

        $this->db->or_group_start();
          $this->db->where(array('voucher_type_account_code'=>'cash','voucher_type_effect_code'=>'cash_contra'));
        $this->db->group_end();

      $this->db->group_end();

    }

    elseif(($cash_account=='bank' && $transaction_effect=='income') || ($cash_account=='cash' && $transaction_effect=='cash_contra') ){

      $this->db->group_start();
        $this->db->where(array('voucher_type_account_code'=>'bank','voucher_type_effect_code'=>'income'));

        $this->db->or_group_start();
          $this->db->where(array('voucher_type_account_code'=>'cash','voucher_type_effect_code'=>'cash_contra'));
        $this->db->group_end();

      $this->db->group_end();       
      

    }

    elseif(($cash_account=='bank' && $transaction_effect=='expense') || ($cash_account=='bank' && $transaction_effect=='bank_contra') ){

      $this->db->group_start();
        $this->db->where(array('voucher_type_account_code'=>'bank','voucher_type_effect_code'=>'expense'));

        $this->db->or_group_start();
          $this->db->where(array('voucher_type_account_code'=>'bank','voucher_type_effect_code'=>'bank_contra'));
        $this->db->group_end();

      $this->db->group_end();
    }
   
    $this->db->group_by(array('voucher_type_account_code'));// Bank or Cash

   $total_cost=0;
   $total_cost_obj=$this->db->get('voucher_detail');

   if($total_cost_obj->num_rows()>0){
    $total_cost=$total_cost_obj->row()->voucher_detail_total_cost;
   }
    return $total_cost;
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
  private function income_accounts($office_id){

    $this->db->select(array('income_account_id','income_account_code'));
    $this->db->join('account_system','account_system.account_system_id=income_account.fk_account_system_id');
    $this->db->join('office','office.fk_account_system_id=account_system.account_system_id');
    $this->db->where(array('office_id'=>$office_id));
    $accounts = $this->db->get('income_account')->result_array();

    $ids = array_column($accounts,'income_account_id');
    $code = array_column($accounts,'income_account_code');

    return array_combine($ids,$code);
  }

  // function journal_account_system(){
  //   $this->db->where(array('journal_id'=>hash_id($this->id,'decode')));
  //   $this->db->join('journal','journal.fk_office_id=office.office_id');
  //   $account_system_id = $this->db->get('office')->row()->fk_account_system_id;

  //   return $account_system_id;
  // }

  /**
   * @todo - to be taken to expense_accounts model. Only get used accounts in the month (Not yet done)
   */
  private function expense_accounts($office_id){

    $this->db->select(array('expense_account_id','expense_account_code'));
    $this->db->join('income_account','income_account.income_account_id=expense_account.fk_income_account_id');
    $this->db->join('account_system','account_system.account_system_id=income_account.fk_account_system_id');
    $this->db->join('office','office.fk_account_system_id=account_system.account_system_id');
    $this->db->where(array('office_id'=>$office_id));
    $accounts =  $this->db->get('expense_account')->result_array();

    $ids = array_column($accounts,'expense_account_id');
    $code = array_column($accounts,'expense_account_code');

    return array_combine($ids,$code);
  }

  function financial_accounts($office_id){
    return [
      'income'=>$this->income_accounts($office_id),
      'expense'=>$this->expense_accounts($office_id),
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
      
      //$this->db->where($this->general_model->max_status_id_where_condition_by_created_date('voucher',$month_start_date));
      $max_approval_status_ids = $this->general_model->get_max_approval_status_id('voucher');
      //$this->db->where(array('voucher.fk_status_id'=>$max_approval_status_id));
      $this->db->where_in('voucher.fk_status_id',$max_approval_status_ids);
      
      $this->db->select(array('voucher_id','voucher_number','voucher_date','voucher_vendor',
      'voucher_cleared','voucher_cleared_month','voucher_cheque_number','voucher_description',
      'voucher_cleared_month','voucher.fk_status_id as fk_status_id','voucher_created_date',
      'voucher_is_reversed','voucher_cleared','voucher_cleared_month','voucher_reversal_from','voucher_reversal_to'));
      $this->db->select(array('voucher_type_abbrev','voucher_type_name'));
      $this->db->select(array('voucher_type_account_code'));
      $this->db->select(array('voucher_type_effect_code'));
      $this->db->select(array('voucher_detail_total_cost','fk_expense_account_id','fk_income_account_id',
      'fk_contra_account_id','voucher.fk_office_bank_id as fk_office_bank_id',
      'voucher.fk_office_cash_id as fk_office_cash_id',
      'cash_recipient_account.fk_office_bank_id as receiving_office_bank_id',
      'cash_recipient_account.fk_office_cash_id as receiving_office_cash_id'
      ));
      
      $this->db->where(array('voucher_date >='=> $month_start_date,'voucher_date <='=> $month_end_date,'fk_office_id'=>$office_id));
      
      $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
      $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
      $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');  
      $this->db->join('voucher_detail','voucher_detail.fk_voucher_id=voucher.voucher_id');
      
      $this->db->join('cash_recipient_account','cash_recipient_account.fk_voucher_id=voucher.voucher_id','LEFT');

      if(count($project_allocation_ids)>0 && $office_bank_id > 0){
        $this->db->group_start();
          $this->db->where_in('fk_project_allocation_id',$project_allocation_ids);
          $this->db->or_where('voucher.fk_office_bank_id',$office_bank_id);
        $this->db->group_end();
        
      }elseif(count($project_allocation_ids) == 0 && $office_bank_id > 0){
        $this->db->where('voucher.fk_office_bank_id',$office_bank_id);
      }
  
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
          'receiving_office_bank_id'=> $receiving_office_bank_id,
          'receiving_office_cash_id' => $receiving_office_cash_id,
          'voucher_is_reversed'=>$voucher_is_reversed,
          'voucher_reversal_from'=>$voucher_reversal_from,
          'voucher_reversal_to'=>$voucher_reversal_to,
          'voucher_is_cleared'=>$voucher_cleared,
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
        }elseif($voucher_type_effect_code == 'bank_contra' || $voucher_type_effect_code == 'cash_contra'){
          $spread[$count]['account_id'] = $fk_contra_account_id;
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

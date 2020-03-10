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

  private function system_opening_cash_balance($office_id){
    $balances = (object)['bank'=>0,'cash'=>0];

    $this->db->select(array('opening_cash_balance_bank as bank','opening_cash_balance_cash as cash'));
    $opening_cash_balance_obj = $this->db->get_where('opening_cash_balance',array('fk_office_id'=>$office_id));
    
    if($opening_cash_balance_obj->num_rows()>0){
       $balances = $opening_cash_balance_obj->row_array(); 
    }

    return $balances;
  }

  
  function month_opening_cash_balance($office_id,$transacting_month){
    $system_opening_bank = $this->system_opening_cash_balance($office_id)['bank']; 
    $system_opening_cash = $this->system_opening_cash_balance($office_id)['cash']; 

    $bank_to_date_income = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'bank','income');
    $cash_to_date_income = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'cash','income');

    $bank_to_date_expense = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'bank','expense');
    $cash_to_date_expense = $this->get_cash_income_or_expense_to_date($office_id,$transacting_month,'cash','expense');
    
    $month_bank_opening = $system_opening_bank + ($bank_to_date_income - $bank_to_date_expense);
    $month_cash_opening = $system_opening_cash + ($cash_to_date_income - $cash_to_date_expense);

    return ['bank'=>$month_bank_opening,'cash'=>$month_cash_opening];
  }


  private function get_cash_income_or_expense_to_date($office_id,$transacting_month,$cash_account,$transaction_effect){

    $this->db->select_sum('voucher_detail_total_cost');
    
    $this->db->where('voucher_date < ',date('Y-m-01',strtotime($transacting_month)));
    $this->db->join('voucher','voucher.voucher_id=voucher_detail.fk_voucher_id');
    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');

    return $this->db->get_where('voucher_detail',
    array('fk_office_id'=>$office_id,
    'voucher_type_account_code'=>$cash_account,'voucher_type_effect_code'=>$transaction_effect))->row()->voucher_detail_total_cost;

  }


  function get_office_data_from_journal(){
    $journal_id = hash_id($this->id,'decode');

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
  
  function get_all_office_month_vouchers($office_id,$transacting_month){

    $month_start_date = date('Y-m-01',strtotime($transacting_month));
    $month_end_date = date('Y-m-t',strtotime($transacting_month));

    $this->db->select(array('voucher_id','voucher_number','voucher_date','voucher_vendor',
    'voucher_cleared','voucher_cleared_month','voucher_cheque_number','voucher_description',
    'voucher_cleared_month'));
    $this->db->select(array('voucher_type_abbrev','voucher_type_name'));
    $this->db->select(array('voucher_type_account_code'));
    $this->db->select(array('voucher_type_effect_code'));
    $this->db->select(array('voucher_detail_total_cost','fk_expense_account_id','fk_income_account_id','fk_bank_contra_account_id','fk_cash_contra_account_id'));
    
    //$this->db->select_sum('voucher_detail_total_cost');
    
    $this->db->where('voucher_date >=', $month_start_date);
    $this->db->where('voucher_date <=', $month_end_date);
    $this->db->where('fk_office_id',$office_id);
    //$this->db->where(array('voucher.fk_status_id'=>$this->approval_model->get_max_approval_status_id('voucher')));
    $this->db->where(array('voucher.fk_status_id'=>11));

    $this->db->join('voucher_type','voucher_type.voucher_type_id=voucher.fk_voucher_type_id');
    $this->db->join('voucher_type_account','voucher_type_account.voucher_type_account_id=voucher_type.fk_voucher_type_account_id');
    $this->db->join('voucher_type_effect','voucher_type_effect.voucher_type_effect_id=voucher_type.fk_voucher_type_effect_id');  
    $this->db->join('voucher_detail','voucher_detail.fk_voucher_id=voucher.voucher_id');

    //$this->db->group_by('voucher_id');

    return $this->db->order_by('voucher_id','ASC')->get('voucher')->result_array();
  }

  function reorder_office_month_vouchers($office_id,$transacting_month){
    
    $raw_array_of_vouchers = $this->get_all_office_month_vouchers($office_id,$transacting_month);

    $voucher_record = [];

    foreach($raw_array_of_vouchers as $voucher_detail){
        
        extract($voucher_detail);

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

  function journal_records($office_id,$transacting_month){
    return $this->reorder_office_month_vouchers($office_id,$transacting_month);
  }

  function list_table_where(){
    
    // Only list requests from the users' hierachy offices
    $this->db->where_in($this->controller.'.fk_office_id',array_column($this->session->hierarchy_offices,'office_id'));
  }

}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Journal_library extends Grants
{

  private $CI;

  function __construct(){
    parent::__construct();
    $this->CI =& get_instance();
  }

  function index(){

  }

  function journal_records($office_id,$transacting_month){
    return $this->CI->journal_model->journal_records($office_id,$transacting_month);
  }

  function month_opening_cash_balance($office_id,$transacting_month){
    return $this->CI->journal_model->month_opening_cash_balance($office_id,$transacting_month);
  }

  // function month_opening_cash_balance($office_id){
  //   return $this->CI->journal_model->month_opening_cash_balance($office_id);
  // }

  function get_office_data_from_journal(){
    return $this->CI->journal_model->get_office_data_from_journal();
  }  

  function journal_navigation($office_id, $transacting_month){
    return $this->CI->journal_model->journal_navigation($office_id, $transacting_month);
  }

  function financial_accounts(){
    return $this->CI->journal_model->financial_accounts();
  }

  private function empty_journal_cells($account_type = 'income'){
    
    $spread_cells = '';

    $financial_accounts = $this->CI->journal_model->financial_accounts();
    
    for($i=0;$i<count($financial_accounts[$account_type]);$i++){
      $spread_cells .= "<td class='align-right'>0.00</td>";
    }
      
    return $spread_cells; 
  }

  function journal_spread($spread,$account_type = 'bank',$transaction_effect = 'income'){

    $financial_accounts = $this->CI->journal_model->financial_accounts();
    
    $spread_cells = "";

    $accounts = $transaction_effect == 'income'?$financial_accounts['income']:$financial_accounts['expense'];

    // Fill up empty cells in spread when the account type is an expense type
    if($transaction_effect == 'expense' || strpos($transaction_effect,'contra')) echo $this->empty_journal_cells('income');
      
      foreach($accounts as $account_id => $account_code){
        $transacted_amount = 0;
        foreach($spread as $spread_transaction){
            if(in_array($account_id,$spread_transaction)){
                $transacted_amount += $spread_transaction['transacted_amount'];
            }
        }
        if( !strpos($transaction_effect,'contra')){
          $spread_cells .=  "<td class='align-right'>".number_format($transacted_amount,2)."</td>";
        }
        
    }

    // Fill up empty cells in spread when the account type is an income type
    if($transaction_effect == 'income' || strpos($transaction_effect,'contra')) echo $this->empty_journal_cells('expense');
    

    return $spread_cells;
  }

  // function get_voucher_max_approval_status_id(){
  //   $this->CI->load->model('approval_model');
  //   return $this->CI->approval_model->get_max_approval_status_id('voucher');
  // }

}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Api extends CI_Controller{
  function __construct(){
    parent::__construct();

    $this->load->model('general_model');
    $this->load->library('language_library');
  }
    
  function index(){
   
  }

  function approveable_item($approveable_item){
    echo json_encode($this->grants_model->approveable_item($approveable_item));
  }
  
  function get_status_id($approveable_item,$record_id){
    echo $this->general_model->get_status_id($approveable_item,$record_id);
  }

  function intialize_table(){
    $foreign_keys_values = [];
    $this->load->model('context_global_model');
    echo json_encode($this->context_global_model->intialize_table($foreign_keys_values));
    
  }    

  function merge_with_history_fields(){
    echo json_encode($this->grants_model->merge_with_history_fields('context_global',[],false));
  }

  function insert_approval_record($approve_item){
    echo json_encode($this->grants_model->insert_approval_record($approve_item));
  }

  function create_context_tables(){
    echo json_encode($this->grants_model->create_context_tables());
  }

  function yaml_tables_versions(){
    $raw_specs = file_get_contents(APPPATH.'version'.DIRECTORY_SEPARATOR.'spec.yaml');

    $specs_array = yaml_parse($raw_specs,0);

    echo json_encode($specs_array['grants']);
  }

  function get_all_table_fields(){
    $fields = $this->grants_model->get_all_table_fields('voucher');
    
    $foreign_tables_array_padded_with_false = array_map(function($elem){
      return substr($elem,0,3) =='fk_'?substr($elem,3,-3):false;
    },$fields);

    $foreign_tables_array = array_filter($foreign_tables_array_padded_with_false,function($elem){
      return $elem && $elem != 'status' && $elem != 'approval'?$elem:false;
    });

    echo json_encode($foreign_tables_array);
  }

  function directory_iterator(){
    $app_name = 'Core';
    
    $files_array = directory_iterator(APPPATH.'third_party'.DIRECTORY_SEPARATOR.'Packages'.DIRECTORY_SEPARATOR.ucfirst($app_name).DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR);

    $files = array_keys($files_array);

    $context_tables = array_filter($files,function($file){
      return substr($file,0,8) == 'Context_' && !strpos($file,'definition',8) &&  !strpos($file,'global',8) ?$file:false;
    });

    echo json_encode($context_tables);
  }

  function create_context_files($table_name = '',$app_name = ''){
    $contexts = ['level_one','level_two','level_three'];
    $app_name = 'Core';

    foreach($contexts as $context){
      $this->grants_model->create_context_files('context_'.$context,$app_name);
    }
    
    echo json_encode($this->directory_iterator());
  }

  function context_definitions(){
    $def =  $this->grants->context_definitions();

    echo json_encode($def);
  }

  function user_hierarchy_offices(){

      $user_context = 'global';
      $user_context_id = 1;
      $looping_context = 'region';

      $user_context_table = 'context_'.$user_context;
      $user_context_level = $this->grants->context_definitions()[$user_context]['context_definition_level'];
      $contexts = array_keys($this->grants->context_definitions());

      $level_one_context_table = isset($contexts[0])?'context_'.$contexts[0]:null; //center
      $level_two_context_table = isset($contexts[1])?'context_'.$contexts[1]:null; //cluster
      $level_three_context_table = isset($contexts[2])?'context_'.$contexts[2]:null; //cohort
      $level_four_context_table  = isset($contexts[3])?'context_'.$contexts[3]:null; // country
      $level_five_context_table = isset($contexts[4])?'context_'.$contexts[4]:null;//region
      $level_six_context_table = isset($contexts[5])?'context_'.$contexts[5]:null;//global

      $this->db->select(array('office_id','office_name'));


      if($contexts[0] != null && $looping_context == $contexts[0]){ // center

        if($user_context_level > 5) $this->db->join($level_five_context_table,$level_five_context_table.'.fk_'.$level_six_context_table.'_id='.$level_six_context_table.'.'.$level_six_context_table.'_id');
        if($user_context_level > 4) $this->db->join($level_four_context_table,$level_four_context_table.'.fk_'.$level_five_context_table.'_id='.$level_five_context_table.'.'.$level_five_context_table.'_id');
        if($user_context_level > 3) $this->db->join($level_three_context_table,$level_three_context_table.'.fk_'.$level_four_context_table.'_id='.$level_four_context_table.'.'.$level_four_context_table.'_id');
        if($user_context_level > 2) $this->db->join($level_two_context_table,$level_two_context_table.'.fk_'.$level_three_context_table.'_id='.$level_three_context_table.'.'.$level_three_context_table.'_id');
        if($user_context_level > 1) $this->db->join($level_one_context_table,$level_one_context_table.'.fk_'.$level_two_context_table.'_id='.$level_two_context_table.'.'.$level_two_context_table.'_id');  
        
      }
      
      if($contexts[1] != null && $looping_context == $contexts[1]){//cluster

        if($user_context_level > 5) $this->db->join($level_five_context_table,$level_five_context_table.'.fk_'.$level_six_context_table.'_id='.$level_six_context_table.'.'.$level_six_context_table.'_id');
        if($user_context_level > 4) $this->db->join($level_four_context_table,$level_four_context_table.'.fk_'.$level_five_context_table.'_id='.$level_five_context_table.'.'.$level_five_context_table.'_id');
        if($user_context_level > 3) $this->db->join($level_three_context_table,$level_three_context_table.'.fk_'.$level_four_context_table.'_id='.$level_four_context_table.'.'.$level_four_context_table.'_id');
        if($user_context_level > 2) $this->db->join($level_two_context_table,$level_two_context_table.'.fk_'.$level_three_context_table.'_id='.$level_three_context_table.'.'.$level_three_context_table.'_id');
        
      }
      
      if($contexts[2] != null && $looping_context == $contexts[2]){//cohort

        if($user_context_level > 5) $this->db->join($level_five_context_table,$level_five_context_table.'.fk_'.$level_six_context_table.'_id='.$level_six_context_table.'.'.$level_six_context_table.'_id');
        if($user_context_level > 4) $this->db->join($level_four_context_table,$level_four_context_table.'.fk_'.$level_five_context_table.'_id='.$level_five_context_table.'.'.$level_five_context_table.'_id');
        if($user_context_level > 3) $this->db->join($level_three_context_table,$level_three_context_table.'.fk_'.$level_four_context_table.'_id='.$level_four_context_table.'.'.$level_four_context_table.'_id');
 
      }
      
      if($contexts[3] != null && $looping_context == $contexts[3]){//country
        
        if($user_context_level > 5) $this->db->join($level_five_context_table,$level_five_context_table.'.fk_'.$level_six_context_table.'_id='.$level_six_context_table.'.'.$level_six_context_table.'_id');
        if($user_context_level > 4) $this->db->join($level_four_context_table,$level_four_context_table.'.fk_'.$level_five_context_table.'_id='.$level_five_context_table.'.'.$level_five_context_table.'_id');
        
      }
      
      if($contexts[4] != null && $looping_context == $contexts[4]){// region

        if($user_context_level > 5) $this->db->join($level_five_context_table,$level_five_context_table.'.fk_'.$level_six_context_table.'_id='.$level_six_context_table.'.'.$level_six_context_table.'_id');
      }

      $this->db->join('office','office.office_id=context_'.$looping_context.'.fk_office_id');
      $hierarchy_offices = $this->db->get_where($user_context_table,array($user_context_table.'_id'=>$user_context_id))->result_array();

      echo json_encode($hierarchy_offices);
  }

  function test_user_hierarchy_offices(){

    $user_context = "global";
    $user_context_id = 1;
    $looping_context = "center";

    $result = $this->user_model->_user_hierarchy_offices($user_context, $user_context_id, $looping_context);

    echo json_encode($result);
  }

  function user_applicable_contexts(){

    $user_context = 'region';

    $contexts = array_keys($this->grants->context_definitions());
  
    $user_context_id = array_search($user_context,$contexts);

    $id_range = range($user_context_id + 1,count($contexts) - 1);

    foreach($id_range as $context_id){
      if(isset($contexts[$context_id])){
        unset($contexts[$context_id]);
      }
    }

    //echo json_encode($contexts);
    return $contexts;
  }

  function chunk_contexts(){
    $user_context = 'country';
    
    $contexts = array_keys($this->grants->context_definitions());
    
    $user_context_id = array_search($user_context,$contexts);

    $id_range = range($user_context_id + 1,count($contexts) - 1);

    foreach($id_range as $context_id){
      if(isset($contexts[$context_id])){
        unset($contexts[$context_id]);
      }
    }

    echo json_encode($contexts);
  }

  function test_create_table_join_statement_with_depth(){
    $str = $this->grants_model->test_create_table_join_statement_with_depth('context_center',['context_cluster']);

    echo json_encode($str);
  }

  function initial_item_status(){
    $result = $this->grants_model->initial_item_status('context_global');

    echo json_encode($result);
  }

  function get_voucher_type_effect(){
    $this->load->library('voucher_library');
    $this->load->model('voucher_model');
    $voucher_type_id =2;
    $result = $this->voucher_library->get_voucher_type_effect($voucher_type_id)->voucher_type_effect_code;
    echo json_encode($result);
  }

  function repopulate_office_banks(){
    $this->load->library('voucher_library');
    $this->load->model('voucher_model');
    $office_id = 29;
    echo $this->voucher_library->get_json_populate_office_banks($office_id);
  }

  function validate_cheque_number(){
    $this->load->library('voucher_library');
    $this->load->model('voucher_model');

    $office_bank_id = 1;
    $cheque_number = 151;

    echo $this->voucher_library->validate_cheque_number($office_bank_id,$cheque_number);
  }

  function create_resource_upload_directory_structure(){
    $this->grants->create_resource_upload_directory_structure();
  }

  function move_temp_files_to_attachments(){
    echo $this->grants->move_temp_files_to_attachments();
  }


  function fund_balance_report(){
    $this->load->model('financial_report_model');
    $office_ids = [1];
    $start_date_of_month = '2020-04-01';
    $project_ids = [2,4];
    
    $income_accounts =  $this->financial_report_model->income_accounts($office_ids,$project_ids);
    
    $all_accounts_month_opening_balance = $this->financial_report_model->month_income_opening_balance($office_ids, $start_date_of_month,$project_ids);
    $all_accounts_month_income = $this->financial_report_model->month_income_account_receipts($office_ids, $start_date_of_month,$project_ids);
    $all_accounts_month_expense = $this->financial_report_model->month_income_account_expenses($office_ids, $start_date_of_month,$project_ids);

    $report = array();

    foreach($income_accounts as $account){
      
      $month_opening_balance = isset($all_accounts_month_opening_balance[$account['income_account_id']])?$all_accounts_month_opening_balance[$account['income_account_id']]:0;
      $month_income = isset($all_accounts_month_income[$account['income_account_id']])?$all_accounts_month_income[$account['income_account_id']]:0;
      $month_expense = isset($all_accounts_month_expense[$account['income_account_id']])?$all_accounts_month_expense[$account['income_account_id']]:0;

      if($month_opening_balance == 0 && $month_income == 0 && $month_expense == 0){
        continue;
      }
       $report[] = [
        'account_name'=>$account['income_account_name'],
        'month_opening_balance'=>$month_opening_balance,
        'month_income'=>$month_income,
        'month_expense'=>$month_expense,
       ]; 
    }  
    
    echo json_encode($report);
  }

  function get_account_last_month_income_to_date(){
    $this->load->model('financial_report_model');

    $income_account_id = 1;
    $office_ids = [1];
    $start_date_of_month = '2020-04-01';
    $project_ids = [2,4];

    $result = $this->financial_report_model->_get_account_last_month_income_to_date($office_ids,$income_account_id,$start_date_of_month, $project_ids);

    echo json_encode($result);
  }

  function get_account_last_month_expense_to_date(){
    $this->load->model('financial_report_model');

    $income_account_id = 1;
    $office_ids = [1];
    $start_date_of_month = '2020-04-01';
    $project_ids = [2,4];

    $result = $this->financial_report_model->_get_account_last_month_expense_to_date($office_ids,$income_account_id,$start_date_of_month, $project_ids);

    echo json_encode($result);
  }

  function bugdet_to_date_by_expense_account(){

    $this->load->model('financial_report_model');

    $office_ids = [1];
    $reporting_month = '2020-04-01';
    $project_ids = [2,4];

    $result = $this->financial_report_model->bugdet_to_date_by_expense_account($office_ids,$reporting_month,$project_ids);
    
    echo json_encode($result);
  }
  
}
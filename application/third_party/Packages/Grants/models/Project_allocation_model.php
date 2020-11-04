<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Project_allocation_model extends MY_Model 
{
  public $table = 'project_allocation'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  function action_after_insert($post_array,$approval_id,$header_id){

    // Get the insert allocation account system id
    $this->write_db->join('project','project.fk_funder_id=funder.funder_id');
    $this->write_db->where(array('project_id'=>$post_array['fk_project_id']));
    $account_system_id = $this->write_db->get('funder')->row()->fk_account_system_id;

    // Get all active default bank accounts for an account system
    $this->write_db->join('bank','bank.bank_id=office_bank.fk_bank_id');
    $this->write_db->where(array('fk_account_system_id'=>$account_system_id,
    'fk_office_id'=>$post_array['fk_office_id']));
    
    if($this->config->item('link_new_project_allocations_only_to_default_bank_accounts')){
      $this->write_db->where(array('office_bank_is_default'=>1));
    }

    $account_system_office_banks = $this->write_db->get('office_bank')->result_array();

    //echo json_encode($account_system_id);exit;

    $this->write_db->trans_start();

    // Insert office_bank_project_allocation table
    foreach($account_system_office_banks as $account_system_office_bank){
      $office_bank_project_allocation_data['office_bank_project_allocation_name'] = $this->grants_model->generate_item_track_number_and_name('office_bank_project_allocation')['office_bank_project_allocation_name'];
      $office_bank_project_allocation_data['office_bank_project_allocation_track_number'] = $this->grants_model->generate_item_track_number_and_name('office_bank_project_allocation')['office_bank_project_allocation_track_number'];
      $office_bank_project_allocation_data['fk_office_bank_id'] = $account_system_office_bank['office_bank_id'];
      $office_bank_project_allocation_data['fk_project_allocation_id'] = $header_id;
      
      $office_bank_project_allocation_data_to_insert = $this->grants_model->merge_with_history_fields('office_bank_project_allocation',$office_bank_project_allocation_data,false);
      $this->write_db->insert('office_bank_project_allocation',$office_bank_project_allocation_data_to_insert);

    }

    $this->write_db->trans_complete();

    if ($this->write_db->trans_status() === FALSE)
      {
        return false;
      }else{
        return true;
      }
    
  }

  public function lookup_tables(){
    return array('office','project');
  }

  public function detach_detail_table(){
    return true;
  }

  public function detail_tables(){
    return ['office_bank_project_allocation'];
  }
    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){
      return [
        'project_allocation_track_number',
        'project_name',
        'office_name',
        'project_allocation_is_active',
        'project_allocation_amount',
        'project_allocation_extended_end_date',
        'project_allocation_created_date'
    ];
    }

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){
      return array('project_name','office_name','project_allocation_is_active');
    }


    public function edit_visible_columns(){
      return [
        'project_name',
        'office_name',
        'project_allocation_is_active',
        'project_allocation_amount',
        'project_allocation_extended_end_date'
      ];
    }

    public function single_form_add_hidden_columns(){}

    public function master_multi_form_add_visible_columns(){
     
    }

    public function detail_multi_form_add_visible_columns(){}

    public function master_multi_form_add_hidden_columns(){}

    public function detail_multi_form_add_hidden_columns(){}

    function detail_list(){}

    function master_view(){}

    public function list(){}

    public function view(){}

    // function voucher_project_allocation(){
    //   return $this->db->get('project_allocation')->result_object();
    // }
    
   public function transaction_validate_by_computation_flag($insert_array){
      
      $project_id = $insert_array['fk_project_id'];

      $project_cost = $this->db->select_sum('project_cost')->get_where('project',
      array('project_id'=>$project_id))->row()->project_cost;

      $sum_allocation = $this->db->select_sum('project_allocation_amount')->get_where('project_allocation',
      array('fk_project_id'=>$project_id))->row()->project_allocation_amount;

      if($project_cost < $sum_allocation){
        return VALIDATION_ERROR;
      }else{
        return VALIDATION_SUCCESS;
      }
   }

   public function transaction_validate_duplicates_columns(){
     return ['fk_office_id','fk_project_id'];
   }

   function multi_select_field(){
     return "office";
   }

   function lookup_values(){
    $lookup_values = parent::lookup_values();

    if(!$this->session->system_admin){
      $this->read_db->where(array('fk_account_system_id'=>$this->session->user_account_system_id));
      $this->read_db->join('funder','funder.funder_id=project.fk_funder_id');
      $lookup_values['project'] = $this->read_db->get_where('project')->result_array();
    }else{
      $lookup_values['project'] = $this->read_db->get_where('project')->result_array();
    }

    if($this->sub_action != null){

      $project_id=hash_id($this->id,'decode');
      //$this->read_db->select(array('office.office_id as office_id','office.office_name as office_name'));

      // Drop only centers
      if($this->config->item('drop_only_lowest_context_offices')){
        $this->read_db->join('context_definition','context_definition.context_definition_id=office.fk_context_definition_id');
        $this->read_db->where(array('context_definition_level'=>1));
      }

      $this->read_db->order_by('office_name');
      $this->read_db->where('NOT EXISTS (SELECT * FROM project_allocation WHERE project_allocation.fk_office_id=office.office_id AND fk_project_id='.$project_id.')', '', FALSE);
      $this->read_db->where(array('office_bank_is_active'=>1));
      $this->read_db->join('office_bank','office_bank.fk_office_id=office.office_id'); 

      if(!$this->session->system_admin){
        $this->read_db->where(array('fk_account_system_id'=>$this->session->user_account_system_id));       
        $lookup_values['office'] = $this->read_db->get('office')->result_array();
      }else{
        $lookup_values['office'] = $this->read_db->get('office')->result_array();
      }
      
    }

    return $lookup_values;
   }
   
}

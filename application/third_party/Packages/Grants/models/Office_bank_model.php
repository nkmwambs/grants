<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Office_bank_model extends MY_Model 
{
  public $table = 'office_bank'; // you MUST mention the table name
  //public $dependant_table = '';
  public $name_field = 'office_bank_name';
  public $create_date_field = "office_bank_created_date";
  public $created_by_field = "office_bank_created_by";
  public $last_modified_date_field = "office_bank_last_modified_date";
  public $last_modified_by_field = "office_bank_last_modified_by";
  public $deleted_at_field = "office_bank_deleted_at";


  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('office','bank');
  }

  public function detail_tables(){
    $detail_tables = ['cheque_book'];

    if($this->session->system_admin || $this->config->item('link_new_project_allocations_only_to_default_bank_accounts')){
      $detail_tables[] = 'office_bank_project_allocation';
    }

    return $detail_tables;
  }

    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){
      return ['office_bank_track_number','office_bank_name','office_bank_is_active',
      'office_bank_account_number','office_name','bank_name','office_bank_is_default','status_name','approval_name'];
    }

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){}

    public function single_form_add_hidden_columns(){}

    public function multi_form_add_visible_columns(){}

    public function multi_form_add_hidden_columns(){}

    function detail_list(){}

    function action_before_insert($post_array){
      $office_bank_is_default = $post_array['header']['office_bank_is_default'];
      $office_id = $post_array['header']['fk_office_id'];
      
      $count_of_existing_default_bank_account = $this->read_db->get_where('office_bank',
      array('fk_office_id'=>$office_id,'office_bank_is_default'=>1,'office_bank_is_active'=>1))->num_rows();

      if($office_bank_is_default == 1 && $count_of_existing_default_bank_account > 0){
        $post_array['header']['office_bank_is_default'] = 0;
      }

      return $post_array;
    }

    function action_after_insert($post_array, $approval_id, $header_id){
      // Create contra accounts for the newly added bank account
      // $this->read_db->select(array('voucher_type_account_id','voucher_type_account_name','voucher_type_account_code'));
      // $voucher_type_accounts = $this->read_db->get('voucher_type_account')->result_array();

      //$this->read_db->where(array('voucher_type_effect_code'=>'bank_to_bank_contra'));
      $bank_to_bank_contra_effects = $this->read_db->get('voucher_type_effect')->result_array();

      $this->write_db->select(array('office_name','fk_account_system_id'));
      $this->write_db->join('office_bank','office_bank.fk_office_id=office.office_id');
      $this->write_db->where(array('office_bank_id'=>$header_id));
      $office_info = $this->write_db->get('office')->row();

      $this->write_db->trans_start();

      foreach($bank_to_bank_contra_effects as $bank_to_bank_contra_effect){

        if(
            $bank_to_bank_contra_effect['voucher_type_effect_code'] == 'bank_contra' ||
            $bank_to_bank_contra_effect['voucher_type_effect_code'] == 'cash_contra' ||
            $bank_to_bank_contra_effect['voucher_type_effect_code'] == 'bank_to_bank_contra' || 
            $bank_to_bank_contra_effect['voucher_type_effect_code'] == 'cash_to_cash_contra' 
          ){  

              $contra_account_name = '';
              $contra_account_code = '';
              $voucher_type_account_id = 0;
              //$voucher_type_effect_id = 0;

              if($bank_to_bank_contra_effect['voucher_type_effect_code'] == 'bank_contra'){
                $contra_account_name = $office_info->office_name." Bank to Cash";
                $contra_account_code = "B2C"; 
                $voucher_type_account_id = $this->read_db->get_where('voucher_type_account',
                array('voucher_type_account_code'=>'bank'))->row()->voucher_type_account_id;

              }elseif($bank_to_bank_contra_effect['voucher_type_effect_code'] == 'cash_contra'){
                $contra_account_name = $office_info->office_name." Cash to Bank";
                $contra_account_code = "C2B";
                $voucher_type_account_id = $this->read_db->get_where('voucher_type_account',
                array('voucher_type_account_code'=>'cash'))->row()->voucher_type_account_id;

              }elseif($bank_to_bank_contra_effect['voucher_type_effect_code'] == 'bank_to_bank_contra'){
                $contra_account_name = $office_info->office_name." Bank to Bank";
                $contra_account_code = "B2B";
                $voucher_type_account_id = $this->read_db->get_where('voucher_type_account',
                array('voucher_type_account_code'=>'bank'))->row()->voucher_type_account_id;

              }elseif($bank_to_bank_contra_effect['voucher_type_effect_code'] == 'cash_to_cash_contra'){
                $contra_account_name = $office_info->office_name." Cash to Cash";
                $contra_account_code = "C2C";
                $voucher_type_account_id = $this->read_db->get_where('voucher_type_account',
                array('voucher_type_account_code'=>'cash'))->row()->voucher_type_account_id;

              }


              $contra_account_record['contra_account_track_number'] = $this->grants_model->generate_item_track_number_and_name('contra_account')['contra_account_track_number'];
              $contra_account_record['contra_account_name'] = $contra_account_name;
              $contra_account_record['contra_account_code'] = $contra_account_code;
              $contra_account_record['contra_account_description'] = $contra_account_name;;
              $contra_account_record['fk_voucher_type_account_id'] = $voucher_type_account_id;//$voucher_type_account['voucher_type_account_id'];
              $contra_account_record['fk_voucher_type_effect_id'] = $bank_to_bank_contra_effect['voucher_type_effect_id'];
              $contra_account_record['fk_office_bank_id'] = $header_id;
              $contra_account_record['fk_account_system_id'] = $office_info->fk_account_system_id;

              $contra_account_data_to_insert = $this->grants_model->merge_with_history_fields('contra_account',$contra_account_record,false);
              $this->write_db->insert('contra_account',$contra_account_data_to_insert);
            
        }

      }


      $this->create_default_project_allocation_and_link_to_account($post_array, $approval_id, $header_id);

      $this->write_db->trans_complete();

      if ($this->write_db->trans_status() === FALSE)
        {
          return false;
        }else{
          return true;
        }
    }

    function create_default_project_allocation_and_link_to_account($post_array, $approval_id, $header_id){
      //echo json_encode($post_array);exit;
      // Check if the bank account is default
      $office_bank_is_default = $post_array['office_bank_is_default'];
      $office_id = $post_array['fk_office_id'];

      if($office_bank_is_default){

        // Get all default project allocation - There can only be 1 default project per funder
        $this->read_db->join('project','project.project_id=project_allocation.fk_project_id');
        $this->read_db->where(array('project_is_default'=>1,'fk_office_id'=>$office_id));
        $default_project_allocation_object = $this->read_db->get_where('project_allocation');

        if($default_project_allocation_object->num_rows() > 0){
          // Link all the allocations for the default project to the bank account
          foreach($default_project_allocation_object->result_array() as $project_allocation){
            $office_bank_project_allocation['office_bank_project_allocation_name'] = $this->grants_model->generate_item_track_number_and_name('office_bank_project_allocation')['office_bank_project_allocation_name'];
            $office_bank_project_allocation['office_bank_project_allocation_track_number'] = $this->grants_model->generate_item_track_number_and_name('office_bank_project_allocation')['office_bank_project_allocation_track_number'];
            $office_bank_project_allocation['fk_office_bank_id'] = $header_id;
            $office_bank_project_allocation['fk_project_allocation_id'] = $project_allocation['project_allocation_id'];
            
            $office_bank_project_allocation_data_to_insert = $this->grants_model->merge_with_history_fields('office_bank_project_allocation',$office_bank_project_allocation,false);
            $this->write_db->insert('office_bank_project_allocation',$office_bank_project_allocation_data_to_insert);

          }
        }else{
          // If allocation are missing, create them and link

          $account_system_id = $this->read_db->get_where('office',
          array('office_id'=>$office_id))->row()->fk_account_system_id;

          $this->read_db->join('funder','funder.funder_id=project.fk_funder_id');
          $this->read_db->where(array('fk_account_system_id'=>$account_system_id,'project_is_default'=>1));
          $default_project_obj = $this->read_db->get('project');

          //echo json_encode($default_project_obj->result_array());exit;

          if($default_project_obj->num_rows() > 0){
            foreach($default_project_obj->result_array() as $project){
              $project_allocation['project_allocation_track_number'] = $this->grants_model->generate_item_track_number_and_name('project_allocation')['project_allocation_track_number'];
              $project_allocation['project_allocation_name'] = $this->grants_model->generate_item_track_number_and_name('project_allocation')['project_allocation_name'];
              $project_allocation['fk_project_id'] = $project['project_id'];
              $project_allocation['project_allocation_amount'] = 0;
              $project_allocation['project_allocation_is_active'] = 1;
              $project_allocation['fk_office_id'] = $office_id;

              $project_allocation_data_to_insert = $this->grants_model->merge_with_history_fields('project_allocation',$project_allocation,false);
              $this->write_db->insert('project_allocation',$project_allocation_data_to_insert);

              $project_allocation_id = $this->write_db->insert_id();

              $office_bank_project_allocation_inner['office_bank_project_allocation_name'] = $this->grants_model->generate_item_track_number_and_name('office_bank_project_allocation')['office_bank_project_allocation_name'];
              $office_bank_project_allocation_inner['office_bank_project_allocation_track_number'] = $this->grants_model->generate_item_track_number_and_name('office_bank_project_allocation')['office_bank_project_allocation_track_number'];
              $office_bank_project_allocation_inner['fk_office_bank_id'] = $header_id;
              $office_bank_project_allocation_inner['fk_project_allocation_id'] = $project_allocation_id;
              
              $office_bank_project_allocation_inner_data_to_insert = $this->grants_model->merge_with_history_fields('office_bank_project_allocation',$office_bank_project_allocation_inner,false);
              $this->write_db->insert('office_bank_project_allocation',$office_bank_project_allocation_inner_data_to_insert);

            }
          }

        }

        

        
      
      }
    }

    // function lookup_values(){
    //   $lookup_values=parent::lookup_values();// get all implementation from mother 'MY_model then overide the key 'office''

    //   if($this->config->item('drop_only_center')){

    //     if(!$this->session->system_admin){

    //       $this->read_db->join('account_system','account_system.account_system_id=office.fk_account_system_id');

    //       $this->read_db->where(array('account_system_code'=>$this->session->user_account_system));

    //     }
      
    //     $this->read_db->where(array('fk_context_definition_id'=>$this->user_model->get_lowest_office_context()->context_definition_id));
    //     $lookup_values['office']=$this->read_db->get('office')->result_array();

    //   }
      

    //   return $lookup_values;
      
      
    // }

    function get_office_banks($office_id){

      $this->read_db->select(array('office_bank_id','office_bank_name'));
      $this->read_db->where(array('fk_office_id'=>$office_id));
      $office_banks = $this->read_db->get('office_bank')->result_array();

      return $office_banks;
    }

    function master_view(){}

    public function list(){}

    public function view(){}
    
}

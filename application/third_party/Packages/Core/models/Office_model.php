<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Office_model extends MY_Model
{

  public $table = 'office'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  function index(){}

  function delete($id = null){

  }

  public function lookup_tables(){
    return array('context_definition','account_system','country_currency');
  }

  private function context_definition_name_by_office_id($office_id){
    //Get office context
    $this->db->join('context_definition','context_definition.context_definition_id=office.fk_context_definition_id');
    return $context_definition_name = $this->db->get_where('office',array('office_id'=>$office_id))->row()->context_definition_name;
    
  }
  public function detail_tables(){
    $context_definition_name = $this->context_definition_name_by_office_id(hash_id($this->id,'decode'));
   
    return array('context_'.strtolower($context_definition_name),'budget','financial_report','office_bank','project_allocation','system_opening_balance','office_bank');
  }

  public function master_table_visible_columns(){
    // return array(
    //   'center_track_number','center_name','center_code','center_start_date',
    //   'center_end_date','center_is_active','group_cluster_name','approval_name','status_name'
    // );
  }

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){
      return ['office_track_number','office_code','office_name','account_system_name','context_definition_name','office_start_date','status_name'];
  }
  public function list_table_where(){

    if(!$this->session->system_admin){
      
      $this->db->where(array('account_system_code'=>$this->session->user_account_system));
    }

  }

  public function list_table_hidden_columns(){}

  public function detail_list_table_visible_columns(){}

  public function detail_list_table_hidden_columns(){}

  //public function single_form_add_visible_columns(){}

  //public function single_form_add_hidden_columns(){}

  public function master_multi_form_add_visible_columns(){}

  public function detail_multi_form_add_visible_columns(){}

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  function single_form_add_visible_columns(){
    return array('office_name','office_code','office_start_date','office_is_active',
    'context_definition_name');
  }

  function edit_visible_columns()
  {
    return [
      'office_name',
      'office_code',
      'office_description',
      'office_start_date',
      'office_end_date',
      'office_is_active'
    ];
  }

  //function detail_list_query(){}

  function master_view(){}

  public function list(){}

  public function view(){}
  
  /**
   * check_if_office_has_any_context_association
   * 
   * This method checks if an office has a context association. An office can only be associated to 
   * only 1 context once.
   * 
   * @param Int $office_id - Primary ID of the office
   * @return Bool - True if has association, False if not
   */

  function check_if_office_has_any_context_association(int $office_id):Bool{
    // Just check if this office has any hierarchy association 

    $this->db->select(array('context_definition_name'));
    $context_definition_names = $this->db->get('context_definition')->result_array();

    $has_association = false;
    

    foreach(array_column($context_definition_names,'context_definition_name') as $context_definition_name){
        $context_table = 'context_'.$context_definition_name;

        $office_count = $this->db->get_where($context_table,
        array('fk_office_id'=>$office_id))->num_rows();

        if($office_count > 0){
          $has_association = true;
          break;
        }
    }

    return $has_association;

  }

  /**
   * 
   * get_office_context_association
   * 
   * Get the context record for the office. The return array has a key of the context definition name
   * of the office
   * 
   * @param int $center
   * @return Array 
   *  */  

  function get_office_context_association(int $office_id):Array{

    $this->db->join('office','office.fk_context_definition_id=context_definition.context_definition_id');
    $this->db->select(array('context_definition_name'));
    $association_table_obj = $this->db->get_where('context_definition',array('office_id'=>$office_id));

    $association_return = array();
    $association_table = '';

    if($association_table_obj->num_rows() > 0){
        $context_definition_name = $association_table_obj->row()->context_definition_name;
        $association_table = 'context_'.$context_definition_name;
        
        $association_obj = $this->db->get_where($association_table,
             array('fk_office_id'=>$office_id));

             if($association_obj->num_rows()>0){
              $association_return[$context_definition_name] = $association_obj->row();
             }

      
    }

    return $association_return;

  }

  function lookup_values(){
    
    $lookup_values = [];

    // Use this when filling in context tables
    if(substr($this->controller,0,8) == 'context_'){
      $context_definition_name = str_replace('context_','',$this->controller);
      $this->db->join('context_definition','context_definition.context_definition_id=office.fk_context_definition_id');
      $lookup_values = $this->db->get_where('office',array('context_definition_name'=>$context_definition_name))->result_array();
    }
    else{
       $office_ids=array_column($this->session->hierarchy_offices,'office_id');

       $this->db->where_in('office_id',$office_ids);

        $lookup_values = $this->db->get('office')->result_array();
    }

    return $lookup_values;
  }


  function intialize_table(Array $foreign_keys_values = []){
  
    $context_definitions = $this->config->item('context_definitions');
    $global_context_key = count($context_definitions) + 1;

    $office_data['office_track_number'] = $this->grants_model->generate_item_track_number_and_name('office')['office_track_number'];
    $office_data['office_name'] = 'Head Office';
    $office_data['office_description'] = 'Head Office';
    $office_data['office_code'] = 'G001'; 
    $office_data['fk_context_definition_id'] = $global_context_key;
    $office_data['fk_country_currency_id'] = 1;
    $office_data['office_start_date'] = date('Y-m-01');
    $office_data['office_end_date'] = "0000-00-00";
    $office_data['office_is_active'] = 1;
    $office_data['fk_account_system_id'] = 1;//$foreign_keys_values['account_system_id'];
        
    $office_data_to_insert = $this->grants_model->merge_with_history_fields('office',$office_data,false);
    $this->write_db->insert('office',$office_data_to_insert);

    return $this->write_db->insert_id();
}
  
}

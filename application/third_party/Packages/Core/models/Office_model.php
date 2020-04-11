<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Office_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
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
    return array('approval','status','context_definition','account_system');
  }

  private function context_definition_name_by_office_id($office_id){
    //Get office context
    $this->db->join('context_definition','context_definition.context_definition_id=office.fk_context_definition_id');
    return $context_definition_name = $this->db->get_where('office',array('office_id'=>$office_id))->row()->context_definition_name;
    
  }
  public function detail_tables(){
    $context_definition_name = $this->context_definition_name_by_office_id(hash_id($this->id,'decode'));
    //return array('context_'.strtolower($context_definition_name),'budget','financial_report','office_bank','project_allocation','request','system_opening_balance','office_bank');
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
      return ['office_track_number','office_code','office_name','context_definition_name','office_start_date','status_name'];
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

  // function find_offices_reporting_to($senior_office_id){
  //   $context_definition = [
  //       'context_center',
  //       'context_cluster',
  //       'context_cohort',
  //       'context_country',
  //       'context_region',
  //       'context_global',
  //       ];
    
  //   $this->db->select(array('context_definition_name'));    
  //   $this->db->join('context_definition','context_definition.context_definition_id=office.fk_context_definition_id');    
  //   $office_context_definition_name = $this->db->get_where('office',
  //     array('office'=>$senior_office_id))->row()->context_definition_name; 
    
  //   $reporting_office_ids = []; 
      
  //   foreach($context_definition as $context){
  //     if($context == 'context_'.$office_context_definition_name) break;

  //     $this->db->get_where();  
  //   }  
      
  // }


  function intialize_table(Array $foreign_keys_values = []){
  
    // $context_definitions = $this->config->item('context_definitions');
    // $global_context_key = count($context_definitions);

    $office_data['office_track_number'] = $this->grants_model->generate_item_track_number_and_name('office')['office_track_number'];
    $office_data['office_name'] = 'Head Office';
    $office_data['office_description'] = 'Head Office';
    $office_data['office_code'] = 'G001'; 
    $office_data['fk_context_definition_id'] = 6;//$global_context_key;
    $office_data['office_start_date'] = date('Y-m-01');
    $office_data['office_end_date'] = "0000-00-00";
    $office_data['office_is_active'] = 1;
    $office_data['fk_account_system_id'] = 1;//$foreign_keys_values['account_system_id'];
        
    $office_data_to_insert = $this->grants_model->merge_with_history_fields('office',$office_data,false);
    $this->db->insert('office',$office_data_to_insert);

    return $this->db->insert_id();
}
  
}

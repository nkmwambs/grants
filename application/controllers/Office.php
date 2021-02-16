<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Office extends MY_Controller
{

  function __construct(){
    parent::__construct();
    //$this->load->library('office_library');
  }

  function index(){}

  function get_reporting_office_context($context_definition){
    // $context_definition = $this->db->get_where('context_definition',
    // array('context_definition_id'=>$context_definition_id))->row();

    $reporting_context_definition_level = $context_definition->context_definition_level + 1;

    $reporting_context_definition = $this->db->get_where('context_definition',
    array('context_definition_level'=>$reporting_context_definition_level))->row();

    return $reporting_context_definition;
  }
  
  function create_new_office(){
    
    $this->write_db->trans_start();

    $post = $this->input->post()['header'];

    $office['office_name'] = $post['office_name'];
    $office['office_description'] = $post['office_description'];
    $office['office_code'] = $post['office_code'];
    $office['fk_context_definition_id'] = $post['fk_context_definition_id'];
    $office['office_start_date'] = $post['office_start_date'];
    $office['office_start_date'] = $post['office_start_date'];
    $office['fk_country_currency_id'] = $post['fk_country_currency_id'];
    $office['office_is_active'] = $post['office_is_active'];
    $office['fk_account_system_id'] = $post['fk_account_system_id'];
    //$office['fk_country_currency_id'] = $post['fk_country_currency_id'];

    $office_to_insert = $this->grants_model->merge_with_history_fields($this->controller,$office,false);
    
    $this->write_db->insert('office',$office_to_insert);

    $office_id = $this->write_db->insert_id();

    // Create an office context 
    $context_definition = $this->db->get_where('context_definition',
    array('context_definition_id'=>$post['fk_context_definition_id']))->row();

    $context_definition_name = $context_definition->context_definition_name;

    $reporting_context_definition_name = $this->get_reporting_office_context($context_definition)->context_definition_name;

    $reporting_context_definition_table = 'context_'.$reporting_context_definition_name;
    
    $office_context['context_'.$context_definition_name.'_name'] = "Context for office ".$post['office_name'];
    $office_context['context_'.$context_definition_name.'_description'] = "Context for office ".$post['office_name'];
    $office_context['fk_'.$reporting_context_definition_table.'_id'] = $post['office_context'];
    $office_context['fk_context_definition_id'] = $post['fk_context_definition_id'];
    $office_context['fk_office_id'] = $office_id;

    //echo json_encode($office_context);
    $office_context_to_insert = $this->grants_model->merge_with_history_fields('context_'.$context_definition_name,$office_context,false);

    $this->write_db->insert('context_'.$context_definition_name,$office_context_to_insert);

    // Create office System Opening Balance Record
    $system_opening_balance['system_opening_balance_name'] = 'Financial Opening Balance for '.$post['office_name'];
    $system_opening_balance['fk_office_id'] = $office_id;
    $system_opening_balance['month'] = $post['office_start_date'];

    $system_opening_balance_to_insert = $this->grants_model->merge_with_history_fields('system_opening_balance',$system_opening_balance,false);

    $this->write_db->insert('system_opening_balance',$system_opening_balance_to_insert);



    $this->write_db->trans_complete();

    if($this->write_db->trans_status() == false){
      echo "Office insert failed";  
    }else{
      echo "Office inserted successfully";
    }
  }

  function get_ajax_responses_for_context_definition(){

    $post = $this->input->post();

    /** Remove this */
    $context_definition = $this->db->get_where('context_definition',
    array('context_definition_id'=>$post['context_definition_id']))->row();

    $context_definition_name = $context_definition->context_definition_name;
    $reporting_context_definition_level = $context_definition->context_definition_level + 1;

    $reporting_context_definition = $this->db->get_where('context_definition',
    array('context_definition_level'=>$reporting_context_definition_level))->row();

    /**Remove the above and replace with below. Unknown error occurs */

    //$reporting_context_definition = $this->get_reporting_office_context($post['context_definition_id']);

    $reporting_context_definition_table = 'context_'.$reporting_context_definition->context_definition_name;

    $this->db->select(array($reporting_context_definition_table.'_id',$reporting_context_definition_table.'_name'));
    $this->db->join('office','office.office_id='.$reporting_context_definition_table.'.fk_office_id');

    if(!$this->session->system_admin){
      $this->db->join('account_system','account_system.account_system_id=office.fk_account_system_id');
      $this->db->where(array('account_system_code'=>$this->session->user_account_system));
    }

    $result = $this->db->get_where($reporting_context_definition_table,array('office_is_active'=>1))->result_array();

    $office_contexts_combine = combine_name_with_ids($result,$reporting_context_definition_table.'_id',$reporting_context_definition_table.'_name');

    $office_context = $this->grants->select_field('office_context',$office_contexts_combine);

    echo json_encode(array('office_context'=>$office_context));
    //echo json_encode($result);
  }

  function result($id = ''){
      $result = parent::result($id);

      $context_definition_id = $this->session->context_definition['context_definition_id'];

      // $current_context_name = $this->read_db->get_where('context_definition',
      // array('context_definition_id'=>$context_definition_id))->row()->context_definition_name;//country

      $context_name = $this->read_db->get_where('context_definition',
      array('context_definition_id'=>$context_definition_id))->row()->context_definition_name;

      $hierarchy_offices = array_column($this->session->hierarchy_offices,'office_id');

      $this->read_db->where_in('fk_office_id',$hierarchy_offices);
      $current_context_id_array = $this->read_db->get('context_'.$context_name)->result_array();
      
      $current_context_ids = array_column($current_context_id_array,'context_'.$context_name.'_id');

    
      extract($this->office_list_loading_args($context_definition_id,$current_context_ids));

      $result['user_context_definition_id'] = $this->session->context_definition['context_definition_id'];
      $result['office_order'] = $this->office_order($current_context_name,$current_context_ids,
      $context_definition_id,$next_context_name);

      return $result;
  }

  function office_order($current_context_name,$current_context_ids,$context_definition_id,$next_context_name = ""){
    // Start from cohorts assumming the logged in user is a country office user
    //print_r($current_context_name);exit;
    $office_order = [];

    $this->read_db->select(array('context_definition_id','context_definition_name',
    'office_id','office_name','office_code','office_start_date','context_'.$current_context_name.'_id as reporting_context_id',
    'context_'.$current_context_name.'_name as reporting_context_name','context_'.$next_context_name.'_id as context_id',
    'context_'.$next_context_name.'_name as context_name'));
    $this->read_db->where_in('fk_context_'.$current_context_name.'_id',$current_context_ids);
    $this->read_db->where(array('office.fk_context_definition_id'=>$context_definition_id));
    $this->read_db->join('context_'.$next_context_name,'context_'.$next_context_name.'.fk_office_id=office.office_id');
    $this->read_db->join('context_'.$current_context_name,'context_'.$current_context_name.'.context_'.$current_context_name.'_id=context_'.$next_context_name.'.fk_context_'.$current_context_name.'_id');
    $this->read_db->join('context_definition','context_definition.context_definition_id=office.fk_context_definition_id');
    $context_cohort_obj = $this->read_db->get('office');

    if($context_cohort_obj->num_rows() > 0){
      $office_order = $context_cohort_obj->result_array();
    }

    return $office_order;
  }

  function office_list_loading_args($context_definition_id,$current_context_ids){

    $next_context_definition_id = ($context_definition_id - 1)?$context_definition_id - 1:$context_definition_id;
    
    $current_context_name = $this->read_db->get_where('context_definition',
    array('context_definition_id'=>$context_definition_id))->row()->context_definition_name;

    $next_context_name = $this->read_db->get_where('context_definition',
    array('context_definition_id'=>$next_context_definition_id))->row()->context_definition_name;

    return [
        'context_definition_id'=>$next_context_definition_id,
        'current_context_name'=>$current_context_name,
        'current_context_ids'=>$current_context_ids,
        'next_context_name'=>$next_context_name
      ];
  }

  function get_lower_offices(){
     $post = $this->input->post();

    extract($this->office_list_loading_args($post['context_definition_id'],$post['context_id']));

    $result['user_context_definition_id'] = $this->session->context_definition['context_definition_id'];
    $result['office_order'] = $this->office_order($current_context_name,$current_context_ids,$context_definition_id,$next_context_name);
    
    echo $this->load->view('office/ajax_list',$result,true);
    
  }

  static function get_menu_list(){}

}
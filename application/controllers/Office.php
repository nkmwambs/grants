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
    
    $this->db->trans_start();

    $post = $this->input->post()['header'];

    $office['office_name'] = $post['office_name'];
    $office['office_description'] = $post['office_description'];
    $office['office_code'] = $post['office_code'];
    $office['fk_context_definition_id'] = $post['fk_context_definition_id'];
    $office['office_start_date'] = $post['office_start_date'];
    $office['office_end_date'] = '0000-00-00';
    $office['office_is_active'] = $post['office_is_active'];
    $office['fk_account_system_id'] = $post['fk_account_system_id'];
    //$office['fk_country_currency_id'] = $post['fk_country_currency_id'];

    $office_to_insert = $this->grants_model->merge_with_history_fields($this->controller,$office,false);
    
    $this->db->insert('office',$office_to_insert);

    $office_id = $this->db->insert_id();

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

    $this->db->insert('context_'.$context_definition_name,$office_context_to_insert);

    // Create office System Opening Balance Record
    $system_opening_balance['system_opening_balance_name'] = 'Financial Opening Balance for '.$post['office_name'];
    $system_opening_balance['fk_office_id'] = $office_id;
    $system_opening_balance['month'] = $post['office_start_date'];

    $system_opening_balance_to_insert = $this->grants_model->merge_with_history_fields('system_opening_balance',$system_opening_balance,false);

    $this->db->insert('system_opening_balance',$system_opening_balance_to_insert);



    $this->db->trans_complete();

    if($this->db->trans_status() == false){
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
    $result = $this->db->get_where($reporting_context_definition_table,array('office_is_active'=>1))->result_array();

    $office_contexts_combine = combine_name_with_ids($result,$reporting_context_definition_table.'_id',$reporting_context_definition_table.'_name');

    $office_context = $this->grants->select_field('office_context',$office_contexts_combine);

    echo json_encode(array('office_context'=>$office_context));
    //echo json_encode($result);
  }

  static function get_menu_list(){}

}
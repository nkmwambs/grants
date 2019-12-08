<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Center_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{

  public $table = 'center'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  function index(){}

  public function lookup_tables(){
    return array('approval','status','center_group_hierarchy');
  }

  public function detail_tables(){
    return array('budget','reconciliation','center_bank','project_allocation','request');
  }

  public function master_table_visible_columns(){
    // return array(
    //   'center_track_number','center_name','center_code','center_start_date',
    //   'center_end_date','center_is_active','group_cluster_name','approval_name','status_name'
    // );
  }

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){}

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
    return array('center_name','center_code','center_start_date','center_is_active','center_group_hierarchy_name');
  }

  //function detail_list_query(){}

  function master_view(){}

  public function list(){}

  public function view(){}
  

  function check_if_center_has_center_association(){

  }

  function check_if_center_has_cluster_association(){
    
  }

  function check_if_center_has_cohort_association(){
    
  }

  function check_if_center_has_country_association(){
    
  }

  function check_if_center_has_region_association(){
    
  }

  function check_if_center_has_global_association(){
    
  }

  function check_if_center_has_any_hierarchy_association($center_id){
    // Just check if this center has any hierarchy association 

    $this->db->select(array('center_group_hierarchy_unit_table_name as unit_table_name'));
    $association_tables = $this->db->get('center_group_hierarchy')->result_array();
    //print_r($association_tables);exit();
    $has_association = false;

    foreach($association_tables as $association_table){
        $assoc_count = $this->db->get_where($association_table['unit_table_name'],
        array('fk_center_id'=>$center_id))->num_rows();

        if($assoc_count > 0){
          $has_association = true;
          break;
        }
    }

    return $has_association;

  }


  function get_center_hierarchy_association_group($center_id){
    //Get the center group hierarchy association table as key to an array then the assoc
    // record as element value

    $this->db->join('center','center.fk_center_group_hierarchy_id=center_group_hierarchy.center_group_hierarchy_id');
    $this->db->select(array('center_group_hierarchy_table_name'));
    $association_table_obj = $this->db->get_where('center_group_hierarchy',array('center_id'=>$center_id));

    $association_return = array();
    $association_table = '';

    if($association_table_obj->num_rows() > 0){
        $association_table = $association_table_obj->row()->center_group_hierarchy_table_name;

        $association_obj = $this->db->get_where($association_table,
             array('fk_center_id'=>$center_id));

             if($association_obj->num_rows()>0){
              $association_return[$association_table] = $association_obj->row();
             }

      
    }

    return $association_return;

  }

  /**
   * Lookup Values
   * 
   * This methods only returns Centers/ units that have not been associated to any context
   * 
   * @return Array Array of unassociated centers/units
   */
  function lookup_values(){

    $condition_array = [];

    // Used when associating a center to a hierarchy. Only gets centers of the 
    // specified hierarchy group and if not yet associated
    if($this->action == 'single_form_add'){
        $this->db->join('center_group_hierarchy','center_group_hierarchy.center_group_hierarchy_id=center.fk_center_group_hierarchy_id');
        $condition_array_raw = $this->db->get_where('center',
        array('center_group_hierarchy_unit_table_name'=>$this->controller))->result_array();

        foreach($condition_array_raw as $center){
          // Remove centers with association from the select options
          if(!$this->check_if_center_has_any_hierarchy_association($center['center_id'])){
            $condition_array[] = $center;
          }
        }
    }

    return $condition_array;
    
  }

  
}

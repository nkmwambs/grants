<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Request_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'request'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  public function lookup_tables(){
    return array('center','approval','status','department');
  }

  public function detail_tables(){
    return array('request_detail');
  }

  function master_multi_form_add_visible_columns(){
    return array('request_name','request_date','request_description','center_name','department_name');
  }

  function detail_list(){}

  function master_view(){}

  function list_table_visible_columns(){
    return array('request_id','request_track_number','request_name','request_description',
    'request_date','request_created_date','center_name','department_name',
    'approval_name','status_name');
  }

  public function list(){
      
    $this->grants->centers_where_condition();
    
    if($this->session->request_active_page_view > 0){

      //Page view conditions
      $this->db->select(array('page_view_detail_field','page_view_detail_operator','page_view_detail_value'));
      $this->db->join('page_view','page_view.page_view_id=page_view_detail.fk_page_view_id');
      $page_view_raw_conditions = $this->db->get_where('page_view_detail',
      array('page_view_id'=>$this->session->request_active_page_view));

      if($page_view_raw_conditions->num_rows()>0){
        $page_view_raw_conditions = $page_view_raw_conditions->result_object();

        foreach($page_view_raw_conditions as $raw_condition){
          $this->db->where(array('request.'.$raw_condition->page_view_detail_field=>$raw_condition->page_view_detail_value));
        }
      }

    }  

    $this->grants->create_table_join_statement($this->controller, $this->lookup_tables());

    return $this->db->get('request')->result_array();
  }

  public function view(){}


}

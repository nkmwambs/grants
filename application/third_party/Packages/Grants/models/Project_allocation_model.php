<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Project_allocation_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'project_allocation'; // you MUST mention the table name


  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

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

    public function detail_list_table_visible_columns(){}

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){
      return array('project_allocation_name','project_allocation_is_active','project_allocation_amount','office_name','project_name');
    }

    public function edit_visible_columns(){
     return array('project_allocation_name','project_allocation_is_active','project_allocation_amount','project_allocation_extended_end_date');
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

}

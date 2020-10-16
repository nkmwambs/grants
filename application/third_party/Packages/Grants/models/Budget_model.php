<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Budget_model extends MY_Model
{
  public $table = 'budget'; // you MUST mention the table name
  public $dependant_table = '';

  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('office','budget_tag');
  }

  public function detail_tables(){
    return array('budget_item');
  }

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list_table_visible_columns(){
    return ['budget_track_number','office_name','budget_tag_name','budget_year'];
  }

  public function list_table_hidden_columns(){}

  public function detail_list_table_visible_columns(){}

  public function detail_list_table_hidden_columns(){}

  //public function single_form_add_visible_columns(){}

  //public function single_form_add_hidden_columns(){}

  public function master_multi_form_add_visible_columns(){
    return array('budget_name','budget_year','office_name');
  }

  public function detail_multi_form_add_visible_columns(){

  }

  public function master_multi_form_add_hidden_columns(){}

  public function detail_multi_form_add_hidden_columns(){}

  public function single_form_add_visible_columns(){
    return array('budget_tag_name','budget_year','office_name');
  }

  public function single_form_add_hidden_columns(){}

  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

  public function lookup_values()
  {
    
    $lookup_values = [];

    if(!$this->session->system_admin){
      $this->read_db->where_in('office_id',array_column($this->session->hierarchy_offices,'office_id'));
      $lookup_values['office'] = $this->read_db->get('office')->result_array();

      $current_month = date('n');

      $current_quarter_months = financial_year_quarter_months(budget_review_buffer_month($current_month));
      
      $this->read_db->select(array('budget_tag_id','budget_tag_name'));
        $this->read_db->group_start();
        if(in_array(budget_review_buffer_month($current_month),$current_quarter_months['months_in_quarter'])){  
          $this->read_db->where_in('fk_month_id', $current_quarter_months['months_in_quarter']);
        }
        $this->read_db->or_where(array('budget_tag_level'=> $current_quarter_months['quarter_number'] - 1));
        $this->read_db->group_end();

      $this->read_db->where(array('fk_account_system_id'=>$this->session->user_account_system_id,'budget_tag_is_active'=>1));
      $lookup_values['budget_tag'] = $this->read_db->get('budget_tag')->result_array();

    }

    return $lookup_values;
  }

  function edit_visible_columns(){
    return ['budget_tag_name','budget_year','office_name'];
  }

  function list_table_where(){
    //print_r($this->session->hierarchy_offices); exit();
    // Only list requests from the users' hierachy offices
    $this->db->where_in($this->controller.'.fk_office_id',array_column($this->session->hierarchy_offices,'office_id'));
  }

  function transaction_validate_duplicates_columns(){
    return ['fk_office_id','fk_budget_tag_id','budget_year'];
  }

  // function action_before_insert($post_array){

  // }

  function get_immediate_previous_budget($office_id,$current_budget_fy,$header_id){
    // Get the budget tag level of the just previous budget

    $budget_tag_level_of_previous_budget = 0;
    $budget_id_of_previous_budget = 0;

    $this->read_db->select(array('budget_tag_level','budget_id'));
    $this->read_db->where(array('fk_office_id'=>$office_id,
    'budget_year'=>$current_budget_fy,'budget_id<'=>$header_id));
    $this->read_db->order_by('budget_tag_level ASC');
    $this->read_db->join('budget_tag','budget_tag.budget_tag_id=budget.fk_budget_tag_id');
    $previous_budgets_obj = $this->read_db->get('budget');

    if($previous_budgets_obj->num_rows() > 0){
      $previous_budget_tag_levels = array_column($previous_budgets_obj->result_array(),'budget_tag_level');
      $budget_tag_level_of_previous_budget = array_pop($previous_budget_tag_levels);

      $previous_budget_ids = array_column($previous_budgets_obj->result_array(),'budget_id');
      $budget_id_of_previous_budget = array_pop($previous_budget_ids);
    }

    return ['budget_tag_level'=>$budget_tag_level_of_previous_budget,'budget_id' => $budget_id_of_previous_budget];
  }

  function action_after_insert($post_array,$approval_id,$header_id){
    
    $this->write_db->trans_start();

    // Checking the bugdet tag level of the posted budget and retrive the budget record that has n-1 budget tag level
    $budget_tag_id_of_new_budget = $post_array['fk_budget_tag_id'];
    $office_id = $post_array['fk_office_id'];
    $current_budget_fy = $post_array['budget_year'];

    $budget_tag_level_of_previous_budget = $this->get_immediate_previous_budget($office_id,$current_budget_fy,$header_id)['budget_tag_level'];

    if($budget_tag_level_of_previous_budget > 0 ){

      $previous_budget_id = $this->get_immediate_previous_budget($office_id,$current_budget_fy,$header_id)['budget_id'];

        // Get the budget items and budget item details for the previous budget
        $this->read_db->select(array(
          'budget_item_detail_id',
          'budget_item_id',
          'budget_item_total_cost',
          'fk_expense_account_id',
          'budget_item_description',
          'fk_project_allocation_id',
          'fk_month_id',
          'budget_item_detail_amount')
        );

        $this->read_db->where(array('fk_budget_id'=>$previous_budget_id));
        $this->read_db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
        $budget_item_detail_obj = $this->read_db->get('budget_item_detail');

        if($budget_item_detail_obj->num_rows() > 0){
          $budget_item_details = $budget_item_detail_obj->result_array();

          $budget_item_details_grouped = [];

          foreach($budget_item_details as $budget_item_detail){
            $budget_item_details_grouped[$budget_item_detail['budget_item_id']]['budget_item'] = [
              'budget_item_total_cost'=>$budget_item_detail['budget_item_total_cost'],
              'fk_expense_account_id'=>$budget_item_detail['fk_expense_account_id'],
              'budget_item_description'=>$budget_item_detail['budget_item_description'],
              'fk_project_allocation_id'=>$budget_item_detail['fk_project_allocation_id']
            ];

            $budget_item_details_grouped[$budget_item_detail['budget_item_id']]['budget_item_detail'][$budget_item_detail['fk_month_id']] = $budget_item_detail['budget_item_detail_amount'];
          }

         foreach($budget_item_details_grouped as $loop_budget_item_id=>$loop_budget_item_and_details){
            // Insert budget item
          //$budget_item_insert_array = $budget_item_details_grouped[$budget_item_detail['budget_item_id']]['budget_item'];
          $budget_item_array['budget_item_name'] = $this->grants_model->generate_item_track_number_and_name('budget_item')['budget_item_name'];
          $budget_item_array['budget_item_track_number'] = $this->grants_model->generate_item_track_number_and_name('budget_item')['budget_item_track_number'];
          $budget_item_array['fk_budget_id'] = $header_id;
          $budget_item_array['budget_item_total_cost'] = $loop_budget_item_and_details['budget_item']['budget_item_total_cost'];
          $budget_item_array['fk_expense_account_id'] = $loop_budget_item_and_details['budget_item']['fk_expense_account_id'];
          $budget_item_array['budget_item_description'] = $loop_budget_item_and_details['budget_item']['budget_item_description'];
          $budget_item_array['fk_project_allocation_id'] = $loop_budget_item_and_details['budget_item']['fk_project_allocation_id'];


          $budget_item_array_to_insert = $this->grants_model->merge_with_history_fields('budget_item',$budget_item_array,false);
          $this->write_db->insert('budget_item',$budget_item_array_to_insert);

          $budget_item_id = $this->write_db->insert_id();

          $budget_item_details_to_loop =  $loop_budget_item_and_details['budget_item_detail'];

          $budget_item_detail_to_use = $budget_item_details_grouped[$budget_item_detail['budget_item_id']]['budget_item_detail'];

          foreach($budget_item_details_to_loop as $month_id => $amount){
          
            $budget_item_detail_array['budget_item_detail_name'] = $this->grants_model->generate_item_track_number_and_name('budget_item_detail')['budget_item_detail_name'];
            $budget_item_detail_array['budget_item_detail_track_number'] = $this->grants_model->generate_item_track_number_and_name('budget_item_detail')['budget_item_detail_track_number'];
            $budget_item_detail_array['fk_month_id'] = $month_id;
            $budget_item_detail_array['budget_item_detail_amount'] = $amount;
            $budget_item_detail_array['fk_budget_item_id'] = $budget_item_id;

            $budget_item_detail_array_to_insert = $this->grants_model->merge_with_history_fields('budget_item_detail',$budget_item_detail_array,false);
            $this->write_db->insert('budget_item_detail',$budget_item_detail_array_to_insert);

          }
         }

        }
    }

    $this->write_db->trans_complete();

    return $this->write_db->trans_status();
  }

}

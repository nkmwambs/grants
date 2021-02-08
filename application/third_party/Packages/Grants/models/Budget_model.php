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
  public $is_multi_row = false;

  function __construct(){
    parent::__construct();

    $this->load->model('budget_tag_model');
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

      $next_current_quarter_months = financial_year_quarter_months(month_after_adding_size_of_budget_review_period($current_month));
      
      $this->read_db->select(array('budget_tag_id','budget_tag_name'));
        $this->read_db->group_start();

        $months_in_quarter_index_offset = $this->config->item('size_in_months_of_a_budget_review_period') - $this->config->item('number_of_month_to_start_budget_review_before_close_of_review_period');

        if($months_in_quarter_index_offset < 0){
          $months_in_quarter_index_offset = $this->config->item('size_in_months_of_a_budget_review_period') - 1;
        }

        if(month_after_adding_size_of_budget_review_period($current_month) >= $next_current_quarter_months['months_in_quarter'][$months_in_quarter_index_offset]){
          $this->read_db->where_in('fk_month_id', $next_current_quarter_months['months_in_quarter']);
        }

        $this->read_db->or_where(array('budget_tag_level'=> $next_current_quarter_months['quarter_number'] - 1 == 0?$this->config->item('maximum_review_count'):$next_current_quarter_months['quarter_number'] - 1));

        $this->read_db->group_end();

      $this->read_db->where(array('fk_account_system_id'=>$this->session->user_account_system_id,'budget_tag_is_active'=>1));
      $lookup_values['budget_tag'] = $this->read_db->get('budget_tag')->result_array();

    }

    return $lookup_values;
  }

  public function budget_to_date_amount_by_income_account($budget_id,$income_account_id){

    $budget_item_detail_amount = 0;

    $this->read_db->select_sum('budget_item_detail_amount');
    $this->read_db->where(array('fk_budget_id'=>$budget_id,'fk_income_account_id'=>$income_account_id));
    $this->read_db->join('budget_item','budget_item.budget_item_id=budget_item_detail.fk_budget_item_id');
    $this->read_db->join('expense_account','expense_account.expense_account_id=budget_item.fk_expense_account_id');
    $budget_item_detail_amount_obj = $this->read_db->get('budget_item_detail');

    if($budget_item_detail_amount_obj->num_rows() > 0){
      $budget_item_detail_amount = $budget_item_detail_amount_obj->row()->budget_item_detail_amount;
    }

    return $budget_item_detail_amount;
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

  function create_budget_projection($post_array,$approval_id,$header_id){
    // Check if a budget projection is present and if not create one

    $this->read_db->where(array('fk_budget_id'=>$header_id));
    $budget_projection_obj = $this->read_db->get('budget_projection');

    if($budget_projection_obj->num_rows() == 0){

      $budget_projection_data['budget_projection_name'] = $this->grants_model->generate_item_track_number_and_name('budget_projection')['budget_projection_name'];
      $budget_projection_data['budget_projection_track_number'] = $this->grants_model->generate_item_track_number_and_name('budget_projection')['budget_projection_track_number'];
      $budget_projection_data['fk_budget_id'] = $header_id;
      $budget_projection_data['budget_projection_created_by'] = $this->session->user_id;
      $budget_projection_data['budget_projection_created_date'] = date('Y-m-d');
      $budget_projection_data['budget_projection_last_modified_by'] = $this->session->user_id;
      $budget_projection_data['fk_approval_id'] = '';
      $budget_projection_data['fk_status_id'] = '';

      $budget_projection_to_insert = $this->grants_model->merge_with_history_fields('budget_projection',$budget_projection_data,false);
      $this->write_db->insert('budget_projection',$budget_projection_to_insert);

    }
  }

  function replicate_budget($post_array,$approval_id,$header_id){
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
  }

  function action_after_insert($post_array,$approval_id,$header_id){
    
    $this->write_db->trans_start();

    $this->create_budget_projection($post_array,$approval_id,$header_id);

    $this->replicate_budget($post_array,$approval_id,$header_id);

    $this->write_db->trans_complete();

    return $this->write_db->trans_status();
  }

  public function has_initial_status_budget_items($budget_id){
    $has_initial_status_budget_items = false;

    $this->read_db->where(array('fk_budget_id'=>$budget_id,'status_approval_sequence'=>1));
    $this->read_db->join('status','status.status_id=budget_item.fk_status_id');
    $budget_item_count = $this->read_db->get('budget_item')->num_rows();

    if($budget_item_count > 0){
      $has_initial_status_budget_items = true;
    }

    return $has_initial_status_budget_items;
  }

  function get_budget_id_based_on_month($office_id,$reporting_month){
    $budget_tag_id = $this->budget_tag_model->get_budget_tag_id_based_on_reporting_month($office_id,$reporting_month);
    
    $budget_id = 0;

    $budget_year = get_fy($reporting_month);
    
    $this->read_db->where(array('fk_budget_tag_id'=>$budget_tag_id,
    'fk_office_id'=>$office_id,'budget_year'=>$budget_year));
    
    $budget_id_obj = $this->read_db->get('budget');

    if($budget_id_obj->num_rows() > 0){
     $budget_id =  $budget_id_obj->row()->budget_id;
    }

    return $budget_id;
  }

}

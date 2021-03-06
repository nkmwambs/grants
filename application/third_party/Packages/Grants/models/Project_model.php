<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Project_model extends MY_Model 
{
  public $table = 'project';

  function __construct(){
    parent::__construct();

  }

  function delete($id = null){

  }

    function index(){}

    function lookup_tables(){
      return array('funding_status','funder');
    }

    function detail_tables(){
      return array('project_allocation','project_income_account','project_request_type');
    }
    

    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){
      //return ['project_track_number','project_name','project_code','project_start_date','project_end_date','funder_name','project_cost','funding_status_name'];
    }

    function action_before_insert($post_array){

      $funder_id = $post_array['header']['fk_funder_id'];
        
      return $this->grants_model->overwrite_field_value_on_post(
          $post_array,
          'project',
          'project_is_default',
          1,
          0,
          [
              'fk_funder_id'=>$funder_id,
              'project_is_default'=>1
          ]
      );
    }

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){}

    public function single_form_add_hidden_columns(){}

    public function master_multi_form_add_visible_columns(){
      // return array('project_name','project_code','project_description','project_start_date','project_end_date',
      // 'project_cost','funding_status_name','funder_name');
    }

    public function detail_multi_form_add_visible_columns(){}

    public function master_multi_form_add_hidden_columns(){}

    public function detail_multi_form_add_hidden_columns(){}

    function detail_list(){}

    function master_view(){}

    public function list(){}

    public function view(){}

    function lookup_values_where($table = ''){
     return [
              'income_account'=>['income_account_is_donor_funded'=>1,'income_account_is_active'=>1]
            ];
   }

}

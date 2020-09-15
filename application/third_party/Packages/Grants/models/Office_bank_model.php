<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Office_bank_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'office_bank'; // you MUST mention the table name
  //public $dependant_table = '';
  public $name_field = 'office_bank_name';
  public $create_date_field = "office_bank_created_date";
  public $created_by_field = "office_bank_created_by";
  public $last_modified_date_field = "office_bank_last_modified_date";
  public $last_modified_by_field = "office_bank_last_modified_by";
  public $deleted_at_field = "office_bank_deleted_at";


  function __construct(){
    parent::__construct();
  }

  function delete($id = null){

  }

  function index(){}

  public function lookup_tables(){
    return array('office','bank');
  }

  public function detail_tables(){
    return ['cheque_book','office_bank_project_allocation'];
  }

    public function master_table_visible_columns(){}

    public function master_table_hidden_columns(){}

    public function list_table_visible_columns(){}

    public function list_table_hidden_columns(){}

    public function detail_list_table_visible_columns(){
      return ['office_bank_track_number','office_bank_name',
      'office_bank_account_number','office_name','bank_name','status_name','approval_name'];
    }

    public function detail_list_table_hidden_columns(){}

    public function single_form_add_visible_columns(){}

    public function single_form_add_hidden_columns(){}

    public function multi_form_add_visible_columns(){}

    public function multi_form_add_hidden_columns(){}

    function detail_list(){}

    function action_before_insert($post_array){
      $office_bank_is_default = $post_array['header']['office_bank_is_default'];
      $office_id = $post_array['header']['fk_office_id'];
      
      $count_of_existing_default_bank_account = $this->read_db->get_where('office_bank',
      array('fk_office_id'=>$office_id,'office_bank_is_default'=>1,'office_bank_is_active'=>1))->num_rows();

      if($office_bank_is_default == 1 && $count_of_existing_default_bank_account > 0){
        $post_array['header']['office_bank_is_default'] = 0;
      }

      return $post_array;
    }

    // function lookup_values(){
    //   $lookup_values=parent::lookup_values();// get all implementation from mother 'MY_model then overide the key 'office''

    //   if($this->config->item('drop_only_center')){

    //     if(!$this->session->system_admin){

    //       $this->read_db->join('account_system','account_system.account_system_id=office.fk_account_system_id');

    //       $this->read_db->where(array('account_system_code'=>$this->session->user_account_system));

    //     }
      
    //     $this->read_db->where(array('fk_context_definition_id'=>$this->user_model->get_lowest_office_context()->context_definition_id));
    //     $lookup_values['office']=$this->read_db->get('office')->result_array();

    //   }
      

    //   return $lookup_values;
      
      
    // }

    function master_view(){}

    public function list(){}

    public function view(){}

}

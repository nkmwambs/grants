<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Status_role_model extends MY_Model{

    public $table = 'status_role'; 
    public $dependant_table = '';
    public $name_field = 'status_role_name';
    public $create_date_field = "status_role_created_date";
    public $created_by_field = "status_role_created_by";
    public $last_modified_date_field = "status_role_last_modified_date";
    public $last_modified_by_field = "status_role_last_modified_by";
    public $deleted_at_field = "status_role_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('status','role');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function single_form_add_visible_columns(){
        return ['role_name'];
    }

    function edit_visible_columns(){
        return ['role_name'];
    }
    

    /**
     * @override
     */
    function transaction_validate_duplicates_columns(){
        return ['status_role_status_id','fk_role_id'];
    }

    function transaction_validate_by_computation_flag($status_role_data){
      if($status_role_data['fk_role_id'] == 1){
        return VALIDATION_ERROR;
      }else{
        return VALIDATION_SUCCESS;
      }

     }


    function add(){

        $this->write_db->trans_begin();

        $header = $this->input->post('header');

        $status_role_data['status_role_track_number'] = $this->grants_model->generate_item_track_number_and_name('status_role')['status_role_track_number'];
        $status_role_data['status_role_name'] = $this->grants_model->generate_item_track_number_and_name('status_role')['status_role_name'];
        $status_role_data['fk_role_id'] = $header['fk_role_id'];
        $status_role_data['fk_status_id'] = $this->grants_model->initial_item_status('status_role');//hash_id($this->id,'decode');// Status id is a parent id and not a approval status 
        $status_role_data['status_role_status_id'] = hash_id($this->id,'decode');// Status id is a parent id and not a approval status 
        $status_role_data['status_role_created_by'] = $this->session->user_id;
        $status_role_data['status_role_created_date'] = date('Y-m-d');
        $status_role_data['status_role_last_modified_by'] = $this->session->user_id;
        $status_role_data['status_role_last_modified_date'] = date('Y-m-d h:i:s');
        $status_role_data['fk_approval_id'] = $this->grants_model->insert_approval_record('status_role');

        $this->write_db->insert('status_role',$status_role_data);
        
    
        $model = $this->controller.'_model';
          
        $transaction_validate_duplicates = $this->grants_model->transaction_validate_duplicates($this->controller,$status_role_data,$this->transaction_validate_duplicates_columns());
        $transaction_validate_by_computation = $this->grants_model->transaction_validate_by_computation($this->controller, $status_role_data);

        return $this->grants_model->transaction_validate([$transaction_validate_duplicates,$transaction_validate_by_computation]);
    }

    
    function detail_list_query(){
        $this->db->join('role','role.role_id=status_role.fk_role_id');
        $this->db->join('approval','approval.approval_id=status_role.fk_approval_id');
        $this->db->join('status','status.status_id=status_role.status_role_status_id');
        $this->db->where(array('status_role_status_id'=>hash_id($this->id,'decode')));
        $result = $this->db->get('status_role')->result_array();

        return $result;
    }

    function detail_list_table_visible_columns(){
        return ['status_role_track_number','role_name'];
    }

    function multi_select_field(){
        return 'role';
    }
    

}
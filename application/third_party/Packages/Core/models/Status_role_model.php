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

    public $table = 'Status_role'; 
    public $dependant_table = '';
    public $name_field = 'Status_role_name';
    public $create_date_field = "Status_role_created_date";
    public $created_by_field = "Status_role_created_by";
    public $last_modified_date_field = "Status_role_last_modified_date";
    public $last_modified_by_field = "Status_role_last_modified_by";
    public $deleted_at_field = "Status_role_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    function index(){}

    public function lookup_tables(){
        return array('status');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function single_form_add_visible_columns(){
        return ['role_name'];
    }

    function add(){

        $this->db->trans_start();

        $header = $this->input->post('header');

        $status_role_data['status_role_track_number'] = $this->grants_model->generate_item_track_number_and_name('status_role')['status_role_track_number'];
        $status_role_data['status_role_name'] = $this->grants_model->generate_item_track_number_and_name('status_role')['status_role_name'];
        $status_role_data['fk_role_id'] = $header['fk_role_id'];
        $status_role_data['fk_status_id'] = hash_id($this->id,'decode');// Status id is a parent id and not a approval status 
        $status_role_data['status_role_created_by'] = $this->session->user_id;
        $status_role_data['status_role_created_date'] = date('Y-m-d');
        $status_role_data['status_role_last_modified_by'] = $this->session->user_id;
        $status_role_data['status_role_last_modified_date'] = date('Y-m-d h:i:s');
        $status_role_data['fk_approval_id'] = $this->grants_model->insert_approval_record('status_role');

        $this->db->insert('status_role',$status_role_data);

        $this->db->trans_complete();

        if($this->db->trans_status() == false){
            return get_phrase('insert_failed');
        }else{
            return get_phrase('insert_successful');;
        }

    }

    function detail_list_query(){
        $this->db->join('approval','approval.approval_id=status_role.fk_approval_id');
        $this->db->join('status','status.status_id=status_role.fk_status_id');
        $this->db->where(array('status_role.fk_status_id'=>hash_id($this->id,'decode')));
        $result = $this->db->get('status_role')->result_array();

        return $result;
    }
}
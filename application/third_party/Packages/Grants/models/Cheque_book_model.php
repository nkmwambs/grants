<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Cheque_book_model extends MY_Model{

    public $table = 'Cheque_book'; 
    public $dependant_table = '';
    public $name_field = 'Cheque_book_name';
    public $create_date_field = "Cheque_book_created_date";
    public $created_by_field = "Cheque_book_created_by";
    public $last_modified_date_field = "Cheque_book_last_modified_date";
    public $last_modified_by_field = "Cheque_book_last_modified_by";
    public $deleted_at_field = "Cheque_book_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('cheque_injection_model');
    }

    function index(){}

    public function lookup_tables(){
        return array('office_bank');
    }

    function action_before_insert($post_array){
        
        $office_bank_id = $post_array['header']['fk_office_bank_id'];
        $cheque_book_start_serial_number = $post_array['header']['cheque_book_start_serial_number'];


        if(count($this->get_remaining_unused_cheque_leaves($office_bank_id)) == 0 ){
            
            $active_cheque_book_obj = $this->write_db->get_where('cheque_book',array(
                'fk_office_bank_id'=>$office_bank_id,'cheque_book_is_active'=>1
            ));

            if($active_cheque_book_obj->num_rows() > 0){
                $this->write_db->where(['cheque_book_id'=>$active_cheque_book_obj->row()->cheque_book_id]);
                $cheque_book_data['cheque_book_is_active'] = 0;
                $this->write_db->update('cheque_book',$cheque_book_data);
            }            
        }

        return $post_array;
    }

    function office_bank_last_cheque_serial_number($office_bank_id){

        $last_cheque_book_max_leaf = 0;

        $this->read_db->order_by('cheque_book_start_serial_number DESC');
        $this->read_db->where(array('fk_office_bank_id'=>$office_bank_id));
        $cheque_book_obj = $this->read_db->get('cheque_book');

        if($cheque_book_obj->num_rows() > 0){
            $last_cheque_book = $cheque_book_obj->row(0);
            $count_of_leaves = $last_cheque_book->cheque_book_count_of_leaves;
            $last_cheque_book_first_leaf = $last_cheque_book->cheque_book_start_serial_number;
            $last_cheque_book_max_leaf = $last_cheque_book_first_leaf + ($count_of_leaves - 1);
        }

        return $last_cheque_book_max_leaf;
    }


    function office_bank_start_cheque_serial_number($office_bank_id){

        $min_serial_number = 0;

        $this->read_db->select_min("cheque_book_start_serial_number");
        $this->read_db->where(array('fk_office_bank_id'=>$office_bank_id));
        $min_serial_number_obj = $this->read_db->get('cheque_book');

        if($min_serial_number_obj->num_rows() > 0){
            $min_serial_number = $min_serial_number_obj->row()->cheque_book_start_serial_number;
        }

        return $min_serial_number;
    }

    function single_form_add_visible_columns(){
        return ['office_bank_name','cheque_book_start_serial_number','cheque_book_count_of_leaves',
        'cheque_book_use_start_date'];
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function transaction_validate_duplicates_columns(){
        return ['fk_office_bank_id','cheque_book_is_active'];
    }

    function cancelled_cheque_numbers($office_bank_id){
      
        // Only one cheque number is -ve

        $cancelled_cheque_numbers = [];

        $sql = "SELECT voucher_cheque_number, COUNT(*) FROM voucher ";
        $sql .= "WHERE fk_office_bank_id = ".$office_bank_id." AND voucher_cheque_number < 0 ";
        $sql .= "GROUP BY voucher_cheque_number HAVING COUNT(*) = 1"; 
        
        // $this->read_db->select(array('voucher_cheque_number','COUNT(*)'));
        // $this->read_db->where(array('fk_office_bank_id'=>$office_bank_id,'voucher_cheque_number < ' => 0));
        // $this->read_db->having('COUNT(*) = 2');
        // $cancelled_cheque_numbers_obj = $this->read_db->get('voucher');

        $cancelled_cheque_numbers_obj = $this->read_db->query($sql);

        if($cancelled_cheque_numbers_obj->num_rows() > 0){
            $cancelled_cheque_numbers = array_column($cancelled_cheque_numbers_obj->result_array(),'voucher_cheque_number');
            $cancelled_cheque_numbers = array_map([$this,'make_unsigned_values'],$cancelled_cheque_numbers);
        }

        return $cancelled_cheque_numbers;
    }

    function get_reused_cheques($office_bank_id){
        // All the cheque numbers are -ve
        $this->read_db->select(array('voucher_cheque_number'));
        $this->read_db->where(array('fk_office_bank_id'=>$office_bank_id,
        'voucher_cheque_number < '=>0));
        $reusable_cheque_leaves_obj = $this->read_db->get('voucher');

        $reusable_cheque_leaves = [];

        if($reusable_cheque_leaves_obj->num_rows() > 0){
            $reusable_cheque_leaves = array_unique(array_column($reusable_cheque_leaves_obj->result_array(),'voucher_cheque_number'));
            
            $reusable_cheque_leaves = array_map([$this,'make_unsigned_values'],$reusable_cheque_leaves);
        }

        return $reusable_cheque_leaves;
    }

    function make_unsigned_values($signed_cheque_number){
        return abs($signed_cheque_number);
    }   


    function get_remaining_unused_cheque_leaves($office_bank_id){

        $max_status = $this->general_model->get_max_approval_status_id('cheque_book');
    
        $this->read_db->select(array('voucher_cheque_number'));
        $this->read_db->where(array('fk_office_bank_id'=>$office_bank_id));
        $used_cheque_leaves_obj = $this->read_db->get('voucher');
        
    
        $this->read_db->select(array('cheque_book_start_serial_number','cheque_book_count_of_leaves'));
        $this->read_db->where(array('fk_office_bank_id'=>$office_bank_id,
        'cheque_book.fk_status_id'=>$max_status));
        $cheque_book = $this->read_db->get('cheque_book');

    
        $opening_outstanding_cheques_used_cheque_leaves = $this->opening_outstanding_cheques_used_cheque_leaves($office_bank_id);
        
        $injected_cheque_leaves = $this->get_injected_cheque_leaves($office_bank_id);

        $leaves = [];
    
        if($cheque_book->num_rows() > 0){
           
          // Sum of all pages
          $sum_leaves_count_for_all_books = array_sum(array_column($cheque_book->result_array(),'cheque_book_count_of_leaves'));
            
          $cheque_book_start_serial_number = $cheque_book->row(0)->cheque_book_start_serial_number;
          //$cheque_book_count_of_leaves = $cheque_book->row()->cheque_book_count_of_leaves;
      
          $last_leaf = $cheque_book_start_serial_number + ($sum_leaves_count_for_all_books - 1);
          $all_cheque_leaves = range($cheque_book_start_serial_number, $last_leaf);
          
          $used_cheque_leaves = [];
    
          if($used_cheque_leaves_obj->num_rows() > 0){
            $used_cheque_leaves = array_column($used_cheque_leaves_obj->result_array(),'voucher_cheque_number');
            //$all_cheque_leaves = array_diff($used_cheque_leaves,$all_cheque_leaves);
          }
    
          if(!empty($opening_outstanding_cheques_used_cheque_leaves)){
            $used_cheque_leaves = array_merge($used_cheque_leaves,$opening_outstanding_cheques_used_cheque_leaves);
          }

          if(!empty($injected_cheque_leaves)){
            $all_cheque_leaves = array_merge($all_cheque_leaves,$injected_cheque_leaves);
          }

          $cancelled_cheque_numbers = $this->cancelled_cheque_numbers($office_bank_id);
          
          
          foreach($all_cheque_leaves as $cheque_number){

            $is_injected_cheque_number = $this->cheque_injection_model->is_injected_cheque_number($office_bank_id,$cheque_number);

            if(in_array($cheque_number,$cancelled_cheque_numbers) && in_array($cheque_number,$used_cheque_leaves) && $is_injected_cheque_number){
                unset($used_cheque_leaves[array_search($cheque_number,$used_cheque_leaves)]);
            }

           if(in_array($cheque_number,$used_cheque_leaves)){
              unset($all_cheque_leaves[array_search($cheque_number,$all_cheque_leaves)]);
           } 
          }
      
          $keyed_cheque_leaves = [];
      
          foreach($all_cheque_leaves as $cheque_leaf){
            //if(in_array($cheque_leaf,$opening_outstanding_cheques_used_cheque_leaves)) continue;
            $keyed_cheque_leaves[]['cheque_number'] = $cheque_leaf;
            
            if(!$this->allow_skipping_of_cheque_leaves()) {
                break;
            }
          }
      
          $leaves = $keyed_cheque_leaves;
        }
    
        return  $leaves;
      }

      function allow_skipping_of_cheque_leaves(){

        $is_skipping_of_cheque_leaves_allowed = true;

        if($this->config->item("allow_skipping_of_cheque_leaves") == false || $this->get_cheque_book_account_system_setting('allow_skipping_of_cheque_leaves') == 0){
            $is_skipping_of_cheque_leaves_allowed = false;
        }

        return $is_skipping_of_cheque_leaves_allowed;
      }

      function get_cheque_book_account_system_setting($setting_key){
        $account_system_setting = $this->cheque_book_account_system_setting();
 
        return isset($account_system_setting[$setting_key])?$account_system_setting[$setting_key]:[];
      }

      function cheque_book_account_system_setting(){

        $account_system_setting = [];

        $this->read_db->select(["account_system_setting_name","account_system_setting_value"]);
        $this->read_db->where(["approve_item_name"=>"cheque_book",'fk_account_system_id'=>$this->session->user_account_system_id]);
        $this->read_db->join("approve_item","approve_item.approve_item_id=account_system_setting.fk_approve_item_id");
        $account_system_setting_obj = $this->read_db->get('account_system_setting');

        if($account_system_setting_obj->num_rows() > 0){
            $account_system_setting_array = $account_system_setting_obj->result_array();

            $account_system_setting_name = array_column($account_system_setting_array,"account_system_setting_name");
            $account_system_setting_value = array_column($account_system_setting_array,"account_system_setting_value");
        
            $account_system_setting = array_combine($account_system_setting_name,$account_system_setting_value);
        }
        
        return $account_system_setting;
      }

      private function get_injected_cheque_leaves($office_bank_id){

        $cheque_injection = [];

        $this->read_db->select(['cheque_injection_number']);
        $this->read_db->where(['fk_office_bank_id'=>$office_bank_id]);
        $cheque_injection_obj =  $this->read_db->get('cheque_injection');

        if($cheque_injection_obj->num_rows() > 0){
            $cheque_injection = array_column($cheque_injection_obj->result_array(),"cheque_injection_number");
        }

        return $cheque_injection;
      }

      function opening_outstanding_cheques_used_cheque_leaves($office_bank_id){
        $post = $this->input->post();
    
        //$office_bank_id = $post['bank_id'];
    
        $opening_outstanding_cheques_array = [];
    
        $this->read_db->select(array('opening_outstanding_cheque_number'));
        $this->read_db->where(array('opening_outstanding_cheque.fk_office_bank_id'=>$office_bank_id));
        $opening_outstanding_cheques_obj = $this->read_db->get('opening_outstanding_cheque');
    
        if($opening_outstanding_cheques_obj->num_rows() > 0){
          $opening_outstanding_cheques = $opening_outstanding_cheques_obj->result_array();
    
          $opening_outstanding_cheques_array = array_column($opening_outstanding_cheques,'opening_outstanding_cheque_number');
        }
    
        return $opening_outstanding_cheques_array;
      }


    // function transaction_validate_by_computation_flag($insert_array){
    //     // Get last cheque book record
    //     $last_cheque_book_obj = $this->db->order_by('cheque_book_id',"desc")->
    //     get_where('cheque_book',array('fk_office_bank_id'=>$insert_array['fk_office_bank_id']));

    //     if($last_cheque_book_obj->num_rows() > 0){
    //         $last_cheque_book_start_serial_number = $last_cheque_book_obj->row()->cheque_book_start_serial_number;
    //         $last_cheque_book_count_of_leaves = $last_cheque_book_obj->row()->cheque_book_count_of_leaves;
            
    //         $next_cheque_book_start_serial = $last_cheque_book_start_serial_number + $last_cheque_book_count_of_leaves;

    //         if($insert_array['cheque_book_start_serial_number'] < $next_cheque_book_start_serial){
    //             return 'VALIDATION_ERROR';
    //         }
    //     }
    // }


    public function list_table_where(){
        // Use the Office hierarchy for the logged user if not system admin
        if(!$this->session->system_admin){
            $office_ids = array_column($this->session->hierarchy_offices,'office_id');
            $this->db->where_in('fk_office_id',$office_ids);
        }
    }

    public function list_table_visible_columns(){
        return [
            'cheque_book_track_number',
            'office_bank_name',
            'cheque_book_use_start_date',
            'cheque_book_is_active',
            'cheque_book_start_serial_number',
            'cheque_book_count_of_leaves'
        ];
    }

    public function edit_visible_columns(){
        return [
            'cheque_book_use_start_date',
            'cheque_book_start_serial_number',
            'cheque_book_count_of_leaves'
        ];
    }

    public function post_approve_action(){
        $cheque_book_id = hash_id($this->id,'decode');

        // Update the cheque_book_is_active to 1
        $data['cheque_book_is_active'] = 1;
        $this->write_db->where(array('cheque_book_id'=>$cheque_book_id));
        $this->write_db->update('cheque_book',$data);

        return true;
    }

    public function deactivate_fully_used_cheque_book($office_bank_id){

        $query_condition = [
            'cheque_book_is_active'=>1,
            'fk_office_bank_id'=>$office_bank_id
        ];

        $this->read_db->where($query_condition);
        $active_cheque_book_obj = $this->read_db->get('cheque_book');

        if($active_cheque_book_obj->num_rows() > 0){
            $this->write_db->where($query_condition);
            $data['cheque_book_is_active'] = 0;

            $this->write_db->update('cheque_book',$data);
        }

        echo $office_bank_id;exit;
    }

    public function lookup_values(){
        $lookup_values = parent::lookup_values();

        if(!$this->session->system_admin){
            $hierarchy_offices = array_column($this->session->hierarchy_offices,'office_id');

            $this->read_db->select(array('office_bank_id','office_bank_name'));
            $this->read_db->where_in('fk_office_id',$hierarchy_offices);
            $lookup_values['office_bank'] = $this->read_db->get('office_bank')->result_array();
        }

        return $lookup_values;
    }


}
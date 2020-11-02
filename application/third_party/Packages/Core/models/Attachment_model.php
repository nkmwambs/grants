<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Attachment_model extends MY_Model{

    public $table = 'attachment'; 
    public $dependant_table = '';
    public $name_field = 'attachment_name';
    public $create_date_field = "attachment_created_date";
    public $created_by_field = "attachment_created_by";
    public $last_modified_date_field = "attachment_last_modified_date";
    public $last_modified_by_field = "attachment_last_modified_by";
    public $deleted_at_field = "attachment_deleted_at";
    
    function __construct(){
        parent::__construct();
        $this->load->database();

    }

    function index(){}

    public function lookup_tables(){
        return array('approve_item');
    }

    public function detail_tables(){}

    public function detail_multi_form_add_visible_columns(){}

    function upload_files($storeFolder){
      
        $path_array = explode("/",$storeFolder);
        
        $path = [];

        $approve_item_id = $this->read_db->get_where('approve_item',
        array('approve_item_name'=>$path_array[2]))->row()->approve_item_id;
        
        $item_id = $path_array[3];

        $targetPath = $storeFolder."/";

        if($this->config->item('upload_files_to_s3')){

          if(!file_exists('uploads/temps')){
            mkdir('uploads/temps');
          }
          
          $targetPath = 'uploads/temps/';
        }else{
          for ($i=0; $i < count($path_array) ; $i++) { 
        
            array_push($path,$path_array[$i]);
          
            $modified_path = implode(DS,$path);
          
            if(!file_exists($modified_path)){
              mkdir($modified_path);
            }
          
          }
        }
        
        
        if (!empty($_FILES)) {
  
          for($i=0;$i<count($_FILES['file']['name']);$i++){
            $tempFile = $_FILES['file']['tmp_name'][$i];   
            
            $targetFile =  $targetPath. $_FILES['file']['name'][$i]; 
            
            move_uploaded_file($tempFile,$targetFile);

            // S3 comes in here

            if($this->config->item('upload_files_to_s3')){
              $this->grants_s3_lib->upload_s3_object($targetFile,$storeFolder);
            }

            // Insert in Attachment table in DB

            // Check if files exists for the same approve item and record id. Prevent record creation if exists

            $file_exists = $this->db->get_where('attachment',
            array('attachment_name'=>$_FILES['file']['name'][$i],
            'fk_approve_item_id'=>$approve_item_id,'attachment_primary_id'=>$item_id))->num_rows();

            if(!$file_exists){
                $attachment_data['attachment_track_number'] = $this->grants_model->generate_item_track_number_and_name('attachment')['attachment_track_number'];
                $attachment_data['attachment_name'] = $_FILES['file']['name'][$i];
                $attachment_data['attachment_size'] = $_FILES['file']['size'][$i];
                $attachment_data['attachment_file_type'] = $_FILES['file']['type'][$i];
                $attachment_data['attachment_url'] = $storeFolder;
                $attachment_data['fk_approve_item_id'] = $approve_item_id;
                $attachment_data['attachment_primary_id'] = $item_id;
                $attachment_data['attachment_created_date'] = date('Y-m-t');
                $attachment_data['attachment_created_by'] = $this->session->user_id;
                $attachment_data['attachment_last_modified_by'] = $this->session->user_id;
                $attachment_data['fk_approval_id'] = $this->grants_model->insert_approval_record('attachment');
                $attachment_data['fk_status_id'] = $this->grants_model->initial_item_status('attachment');

                $attachment_data_to_insert = $this->grants_model->merge_with_history_fields('attachment',$attachment_data,false);

                $this->write_db->insert('attachment',$attachment_data_to_insert);
            }
          }
  
          return $_FILES;
        }
      }

      /**
       * retrieve_file_uploads_info
       * 
       * Retrieves the files information from the attachment table
       * 
       * @param String $approve_item_name
       * @param Array $item_primary_ids
       * 
       * @return Array - Attachment Information
       */

      function retrieve_file_uploads_info(String $approve_item_name,Array $item_primary_ids = []):Array{

        $files_array = [];

        if(!empty($item_primary_ids)){
          $approve_item_id = $this->read_db->get_where('approve_item',
          array('approve_item_name'=>$approve_item_name))->row()->approve_item_id;

          $this->read_db->select(array('attachment_name','attachment_size',
          'attachment_url','attachment_file_type','attachment_last_modified_date'));

          $this->read_db->where(array('fk_approve_item_id'=>$approve_item_id));
          $this->read_db->where_in('attachment_primary_id',$item_primary_ids);
          
          $files_array = $this->read_db->get('attachment')->result_array();
        }
        return $files_array;
      }

      
}
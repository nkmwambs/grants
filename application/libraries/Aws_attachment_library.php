<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

require 'vendor/autoload.php';

class Aws_attachment_library{

    private $CI = null;
    private $s3Client = null;
    private $attachment_table_name = '';
    private $write_db = '';
    private $read_db = '';

function __construct(){
    
    $this->CI =& get_instance();

    $this->CI->load->config('aws_attachment');

    $this->s3_setup();

    $this->attachment_table_name = $this->CI->config->item('attachment_table_name');

    $this->write_db = $this->CI->config->item('write_db_array_connection_key');
    $this->read_db = $this->CI->config->item('read_db_array_connection_key');
}
    
function s3_setup(){
    // Array for server credentials
    $s3ClientCredentials = [
        'region' => $this->CI->config->item('s3_region'),
        'version' => '2006-03-01'
       ];
    
    // Array for localhost
    if($_SERVER['HTTP_HOST'] == 'localhost'){
        $s3ClientCredentials['profile'] = 'default';
    }

    $this->s3Client = new S3Client($s3ClientCredentials);
    
}


function upload_s3_object($SourceFile,$s3_path, $file_name){

    $key = $s3_path.'/'.$file_name;
        
    try {
        
		$this->s3Client->putObject([
			'Key' => $key,// Where the file will be placed in S3
			'Bucket' => $this->CI->config->item('s3_bucket_name'),
            'SourceFile'=> $SourceFile // Where the file originate in the local machine
        ]);
        
		//Remove the temp files after gabbage collection for the S3 guzzlehttp to release resources 
		
        gc_collect_cycles();
		
		
	} catch (S3Exception $s3Ex) {

		die("An exception occured. {$s3Ex}");
    }
    
    return [$SourceFile];
    

}

function s3_preassigned_url($object_key){
        $cmd = $this->s3Client->getCommand('GetObject', [
            'Bucket' => $this->CI->config->item('s3_bucket_name'),
            'Key' => $object_key
        ]);
        $request = $this->s3Client->createPresignedRequest($cmd, '+20 minutes');
        
        $presignedUrl = (string)$request->getUri();

        return $presignedUrl;
    }


    /**
     * From Attachment Library in Version 2.0 Toolkit
     */

    function attachment_record_with_s3_preassigned_url($attachment_where_condition_array = []){

        /**
         * Ex. array('approve_item_name'=>$approve_item_name,
         * 'attachment_primary_id'=>$record_primary_key,'attachment_name'=>$file_name)
         */

        // $this->CI->read_db->where(array('approve_item_name'=>$approve_item_name,
        // 'attachment_primary_id'=>$record_primary_key,'attachment_name'=>$file_name));
        
        // $this->CI->read_db->join('approve_item','approve_item.approve_item_id=attachment.fk_approve_item_id');
        // $attachment_obj = $this->CI->read_db->get('attachment')->row();

        //$attachment_table_name = $this->CI->config->item('attachment_table_name');
    
        $this->CI->{$this->read_db}->where($attachment_where_condition_array);
        $attachment_obj = $this->CI->{$this->read_db}->get($this->attachment_table_name)->row();
    
        $attachment_size = $attachment_obj->attachment_size;
        $attachment_url = $attachment_obj->attachment_url;
        $attachment_name = $attachment_obj->attachment_name;
        $objectKey = $attachment_url.'/'.$attachment_name;
        $attachment_last_modified_date = $attachment_obj->attachment_last_modified_date;
        $attachment_file_type = $attachment_obj->attachment_file_type;
    
        //$s3_preassigned_url = $this->CI->config->item('upload_files_to_s3')?$this->s3_preassigned_url($objectKey):$this->get_local_filesystem_attachment_url($objectKey);
        $s3_preassigned_url = $this->s3_preassigned_url($objectKey);
        
        return [
          'attachment_name'=>$attachment_name,
          'attachment_size'=>formatBytes($attachment_size),
          'attachment_last_modified_date'=>$attachment_last_modified_date,
          'attachment_file_type'=>$attachment_file_type,
          's3_preassigned_url'=> $s3_preassigned_url
        ];
      }
    
    //   function get_local_filesystem_attachment_url($objectKey){
    //     return base_url().$objectKey;
    //   }


    /**
     * From Attachment Model
     */

    function upload_files($storeFolder,$additional_attachment_table_insert_data = [], $attachment_where_condition_array = []){
      
        //$path_array = explode("/",$storeFolder);
        
        //$path = [];

        // $approve_item_id = $this->read_db->get_where('approve_item',
        // array('approve_item_name'=>$path_array[2]))->row()->approve_item_id;
        
        //$item_id = $path_array[3];

        // Create require local folders
        // if(!$this->config->item('upload_files_to_s3')){
        //   for ($i=0; $i < count($path_array) ; $i++) { 
        
        //     array_push($path,$path_array[$i]);
          
        //     $modified_path = implode(DS,$path);
          
        //     if(!file_exists($modified_path)){
        //       mkdir($modified_path);
        //     }
          
        //   }
        // }
        
        // Uploading of files
        if (!empty($_FILES)) {

          $preassigned_urls = [];
  
          for($i=0;$i<count($_FILES['file']['name']);$i++){
            $tempFile = $_FILES['file']['tmp_name'][$i];   
            
            // S3 comes in here

            //if($this->config->item('upload_files_to_s3')){
             return $this->upload_s3_object($tempFile,$storeFolder, $_FILES['file']['name'][$i]);
            //}else{
             // move_uploaded_file($tempFile,str_replace('/',DS,$storeFolder).DS.$_FILES['file']['name'][$i]);
            //}

            // Insert in Attachment table in DB

            // Check if files exists for the same approve item and record id. Prevent record creation if exists

            // $file_exists = $this->db->get_where('attachment',
            // array('attachment_name'=>$_FILES['file']['name'][$i],
            // 'fk_approve_item_id'=>$approve_item_id,'attachment_primary_id'=>$item_id))->num_rows();

            $this->CI->{$this->read_db}->where(array('attachment_name'=>$_FILES['file']['name'][$i]));
            $this->CI->{$this->read_db}->where($attachment_where_condition_array);
            
            $file_exists = $this->CI->{$this->read_db}->get($this->attachment_table_name)->num_rows();

            if(!$file_exists){
                //$attachment_data['attachment_track_number'] = $this->grants_model->generate_item_track_number_and_name('attachment')['attachment_track_number'];
                $attachment_data['attachment_name'] = $_FILES['file']['name'][$i];
                $attachment_data['attachment_size'] = $_FILES['file']['size'][$i];
                $attachment_data['attachment_file_type'] = $_FILES['file']['type'][$i];
                $attachment_data['attachment_url'] = $storeFolder;
                //$attachment_data['fk_approve_item_id'] = $approve_item_id;
                //$attachment_data['attachment_primary_id'] = $item_id;
                //$attachment_data['attachment_is_s3_upload'] = $this->config->item('upload_files_to_s3')?1:0;
                $attachment_data['attachment_created_date'] = date('Y-m-t');
                $attachment_data['attachment_created_by'] = $this->session->user_id;
                $attachment_data['attachment_last_modified_by'] = $this->session->user_id;
                //$attachment_data['fk_approval_id'] = $this->grants_model->insert_approval_record('attachment');
                //$attachment_data['fk_status_id'] = $this->grants_model->initial_item_status('attachment');

                if(!empty($additional_attachment_table_insert_data)){
                    $attachment_data = array_merge($attachment_data,$additional_attachment_table_insert_data);
                }

                //$attachment_data_to_insert = $this->grants_model->merge_with_history_fields('attachment',$attachment_data,false);

                $this->CI->{$this->write_db}->insert('attachment',$attachment_data);
            }

            //foreach($preassigned_urls as $attachment_record){
              //if(!in_array($_FILES['file']['name'][$i],$attachment_record)){
                $preassigned_urls[$_FILES['file']['name'][$i]] = $this->attachment_record_with_s3_preassigned_url($attachment_where_condition_array);
              //}
            //}
           
          }
  
          return $preassigned_urls;
        }
      }

      /**
       * retrieve_file_uploads_info
       * 
       * Retrieves the files information from the attachment table
       * 
       * 
       * @return Array - Attachment Information
       */

      function retrieve_file_uploads_info($attachment_where_condition_array):Array{

        $files_array = [];

        //if(!empty($item_primary_ids)){
        //   $approve_item_id = $this->read_db->get_where('approve_item',
        //   array('approve_item_name'=>$approve_item_name))->row()->approve_item_id;

        //   $this->read_db->select(array('attachment_name','attachment_size',
        //   'attachment_url','attachment_file_type','attachment_last_modified_date'));

          //$this->read_db->where(array('fk_approve_item_id'=>$approve_item_id));
          //$this->read_db->where_in('attachment_primary_id',$item_primary_ids);
            //print_r($attachment_where_condition_array);exit;
         
            foreach($attachment_where_condition_array as $condition_key => $condition_value){

            if(is_array($condition_value)){
                $this->CI->{$this->read_db}->where_in($condition_key,$condition_value);
            }else{
                $this->CI->{$this->read_db}->where([$condition_key=>$condition_value]);
            }

          }

        //   if($this->config->item('upload_files_to_s3')){
        //     $this->read_db->where(array('attachment_is_s3_upload'=>1));
        //   }else{
        //     $this->read_db->where(array('attachment_is_s3_upload'=>0));
        //   }
          
          $files_array = $this->CI->{$this->read_db}->get($this->attachment_table_name)->result_array();
        //}
        return $files_array;
      }

}

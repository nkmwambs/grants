<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

require 'vendor/autoload.php';

class Grants_S3_lib{

    private $CI = null;
    private $s3Client = null;

function __construct(){
    
    $this->CI =& get_instance();

    $this->s3_setup();
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
    
    //return [$SourceFile];
    

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

}

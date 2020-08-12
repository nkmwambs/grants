<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Language_model extends MY_Model
{
  public $table = 'language'; // you MUST mention the table name
  public $primary_key = 'language_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }

  function intialize_table(Array $foreign_keys_values = []){  

    $language_data['language_track_number'] = $this->grants_model->generate_item_track_number_and_name('language')['language_track_number'];
    $language_data['language_name'] = 'English';
    $language_data['language_code'] = 'en';
        
    $language_data_to_insert = $this->grants_model->merge_with_history_fields('language',$language_data,false);
    $this->write_db->insert('language',$language_data_to_insert);

    return $this->write_db->insert_id();
}

}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Center_model extends MY_Model
{

  public $table = 'center'; // you MUST mention the table name
  public $primary_key = 'center_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update

  function __construct(){
    parent::__construct();
    $this->load->database();
  }

  function index(){

  }

  function list(){
    return $this->grants_model->list_query();
  }

  function view(){
    
  }
}

<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Copyright (C) 2014 @avenirer [avenir.ro@gmail.com]
* Everyone is permitted to copy and distribute verbatim or modified copies of this license document,
* and changing it is allowed as long as the name is changed.
* DON'T BE A DICK PUBLIC LICENSE TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
*
***** Do whatever you like with the original work, just don't be a dick.
***** Being a dick includes - but is not limited to - the following instances:
********* 1a. Outright copyright infringement - Don't just copy this and change the name.
********* 1b. Selling the unmodified original with no work done what-so-ever, that's REALLY being a dick.
********* 1c. Modifying the original work to contain hidden harmful content. That would make you a PROPER dick.
***** If you become rich through modifications, related works/services, or supporting the original work, share the love. Only a dick would make loads off this work and not buy the original works creator(s) a pint.
***** Code is provided with no warranty.
*********** Using somebody else's code and bitching when it goes wrong makes you a DONKEY dick.
*********** Fix the problem yourself. A non-dick would submit the fix back.
 *
 */

/** how to extend MY_Model:
 *	class User_model extends MY_Model
 *	{
 *      public $table = 'users'; // Set the name of the table for this model.
 *      public $primary_key = 'id'; // Set the primary key
 *      public $fillable = array(); // You can set an array with the fields that can be filled by insert/update
 *      public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
 * 		public function __construct()
 * 		{
 *          $this->_database_connection  = group_name or array() | OPTIONAL
 *              Sets the connection preferences (group name) set up in the database.php. If not trset, it will use the
 *              'default' (the $active_group) database connection.
 *          $this->timestamps = TRUE | array('made_at','modified_at','removed_at')
 *              If set to TRUE tells MY_Model that the table has 'created_at','updated_at' (and 'deleted_at' if $this->soft_delete is set to TRUE)
 *              If given an array as parameter, it tells MY_Model, that the first element is a created_at field type, the second element is a updated_at field type (and the third element is a deleted_at field type)
 *          $this->soft_deletes = FALSE;
 *              Enables (TRUE) or disables (FALSE) the "soft delete" on records. Default is FALSE
 *          $this->timestamps_format = 'Y-m-d H:i:s'
 *              You can at any time change the way the timestamp is created (the default is the MySQL standard datetime format) by modifying this variable. You can choose between whatever format is acceptable by the php function date() (default is 'Y-m-d H:i:s'), or 'timestamp' (UNIX timestamp)
 *          $this->return_as = 'object' | 'array'
 *              Allows the model to return the results as object or as array
 *          $this->has_one['phone'] = 'Phone_model' or $this->has_one['phone'] = array('Phone_model','foreign_key','local_key');
 *          $this->has_one['address'] = 'Address_model' or $this->has_one['address'] = array('Address_model','foreign_key','another_local_key');
 *              Allows establishing ONE TO ONE or more ONE TO ONE relationship(s) between models/tables
 *          $this->has_many['posts'] = 'Post_model' or $this->has_many['posts'] = array('Posts_model','foreign_key','another_local_key');
 *              Allows establishing ONE TO MANY or more ONE TO MANY relationship(s) between models/tables
 *          $this->has_many_pivot['posts'] = 'Post_model' or $this->has_many_pivot['posts'] = array('Posts_model','foreign_primary_key','local_primary_key');
 *              Allows establishing MANY TO MANY or more MANY TO MANY relationship(s) between models/tables with the use of a PIVOT TABLE
 *              !ATTENTION: The pivot table name must be composed of the two table names separated by "_" the table names having to to be alphabetically ordered (NOT users_posts, but posts_users).
 *                  Also the pivot table must contain as identifying columns the columns named by convention as follows: table_name_singular + _ + foreign_table_primary_key.
 *                  For example: considering that a post can have multiple authors, a pivot table that connects two tables (users and posts) must be named posts_users and must have post_id and user_id as identifying columns for the posts.id and users.id tables.
 *          $this->cache_driver = 'file'
 *          $this->cache_prefix = 'mm'
 *              If you know you will do some caching of results without the native caching solution, you can at any time use the MY_Model's caching.
 *              By default, MY_Model uses the files to cache result.
 *              If you want to change the way it stores the cache, you can change the $cache_driver property to whatever CodeIgniter cache driver you want to use.
 *              Also, with $cache_prefix, you can prefix the name of the caches. by default any cache made by MY_Model starts with 'mm' + _ + "name chosen for cache"
 *          $this->delete_cache_on_save = FALSE
 *              If you use caching often and you don't want to be forced to delete cache manually, you can enable $this->delete_cache_on_save by setting it to TRUE. If set to TRUE the model will auto-delete all cache related to the model's table whenever you write/update/delete data from that table.
 *          $this->pagination_delimiters = array('<span>','</span>');
 *              If you know you will use the paginate() method, you can change the delimiters between the pages links
 *          $this->pagination_arrows = array('&lt;','&gt;');
 *              You can also change the way the previous and next arrows look like.
 *
 *
 * 			parent::__construct();
 * 		}
 * 	}
 *
 **/

class MY_Model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function lookup_tables(){
      $table_name = $this->controller;
      return $this->_derived_lookup_tables($table_name);
    }

    function list_table_where(){
      $get_max_approval_status_id = $this->general_model->get_max_approval_status_id(strtolower($this->controller)); 
      $filter_where_array = hash_id($this->CI->id,'decode') > 0 && !in_array($table,$this->config->item('table_that_dont_require_history_fields')) ? [$this->controller.'.fk_status_id'=>$get_max_approval_status_id] : [];
      
      print_r($filter_where_array);exit;

      if(count($filter_where_array) > 0){
        $this->db->where($filter_where_array);
      }
      
    }

    public function detail_tables(){}

    public function master_table_visible_columns(){}
  
    public function list_table_visible_columns(){}
  
    public function list_table_hidden_columns(){}
  
    public function detail_list_table_visible_columns(){}
  
    public function detail_list_table_hidden_columns(){}
  
    public function single_form_add_visible_columns(){}
  
    public function single_form_add_hidden_columns(){}
  
    public function master_multi_form_add_visible_columns(){}
  
    public function detail_multi_form_add_visible_columns(){}
  
    public function master_multi_form_add_hidden_columns(){}
  
    public function detail_multi_form_add_hidden_columns(){}

    //public function add(){} //Had a problem of creating duplicates with the status_role add form on post

    public function edit(){}

    public function delete(){}

    public function master_table_additional_fields($record_id){
      return [];
    }

    public function transaction_validate_duplicates_columns(){
      return [];// Must pass an empty array to prevent add method failure in grants_model
    }

    public function transaction_validate_by_computation_flag($array_to_check){
      return VALIDATION_SUCCESS;
    }

    public function currency_fields(){
      return [];
    }

    /**
     * Use is a master table to filter the values of the lookup columns
     * Lookup tables are keys of the condition arrays
     */
    function lookup_values_where(){

    }

    function _derived_lookup_tables($table_name){
      $fields = $this->grants_model->get_all_table_fields($table_name);
    
      $foreign_tables_array_padded_with_false = array_map(function($elem){
        return substr($elem,0,3) =='fk_'?substr($elem,3,-3):false;
      },$fields);

      // Prevent listing false values and status or approval tables for lookup. 
      // Add status_name and approval_name to the correct visible_columns method in models to see these fields in a page
      $foreign_tables_array = array_filter($foreign_tables_array_padded_with_false,function($elem){
        return $elem?$elem:false;
      });

      return $foreign_tables_array;
    }

    // Can be overriden in the specific model or extended
    function table_hidden_columns(){
      $hidden_columns = array($this->table.'_last_modified_date',$this->table.'_created_date',
      $this->table.'_last_modified_by',$this->table.'_created_by',$this->table.'_deleted_at');

      return $hidden_columns;
    }

    function master_table_hidden_columns(){
      $hidden_columns = array($this->table.'_last_modified_date',$this->table.'_created_date',
      $this->table.'_last_modified_by',$this->table.'_created_by',$this->table.'_deleted_at');

      return $hidden_columns;
    }

    function show_add_button(){
      return true;
    }

    function action_after_insert($post_array, $approval_id, $header_id){
      return true;
    }

    
}

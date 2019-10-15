<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Project_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'project';

  function __construct(){
    parent::__construct();

  }

    function index(){}


    //This method overrides the My_Model table_hidden_columns. Calling it with empty body entirely does away with the
    //set default hidden columns i.e. all columns will be vieable as it is from the table.
    //This method overrides the My_Model table_hidden_columns
    function table_hidden_columns(){
      // $hidden_columns = array($this->table.'_last_modified_date',$this->table.'_created_date',
      // $this->table.'_last_modified_by',$this->table.'_created_by',$this->table.'_deleted_at');
      //
      // return $hidden_columns;
    }

    // This method when implemented overwites the any implementation of table_hidden_columns and allows the
    // setting of columns to be shown on tables
    function table_visible_columns(){

    }

    function master_table_visible_columns(){

    }

  //Not working yet. Should allow hidding columns by default from the My Model method or overide it here
    function master_table_hidden_columns(){
      //return array('funder_deleted_at');
    }

    function lookup_tables(){
      return array('funding_status','funder');
    }

    function detail_tables(){
      return array('project_allocation');
    }

    function list(){
      //return $this->grants_model->list_query($this->details_lookup_tables());
      //return $this->db->get('project',array('fk_funder_id'=>1))->result_array();
    }

    function view(){
      //return $this->grants_model->view_query($this->details_lookup_tables());
    }
}

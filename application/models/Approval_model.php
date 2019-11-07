<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Approval_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'approval'; // you MUST mention the table name

  function __construct(){
    parent::__construct();
  }

  function index(){}

  function lookup_tables(){
    return array('approve_item');
  }

  function detail_tables(){
    //return array('request','budget','voucher','center','bank','permission','role_permission','role');
    return array('request','budget','voucher','center','bank','permission','role_permission','project_allocation');
  }


  function detail_list(){}

  function master_view(){}

  public function list(){}

  public function view(){}

    // Access methods
  public function show_add_button(){
      return false;
    }

}

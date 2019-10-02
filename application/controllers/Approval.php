<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */


class Approval extends MY_Controller implements CrudModelInterface
{

  function __construct(){
    parent::__construct();
    $this->load->library('approval_library');

  }

  function index(){}

  function create(){}

  function view(){}

  function update(){}

  function delete(){}

  function list(){
    $result = $this->approval_library->list();

    $page_data['page_name'] = "list";
    $page_data['page_title'] = 'list';
    $page_data['views_dir'] = "approval";
    $page_data['result'] = $result;

    $this->load->view('general/index',$page_data);
  }

  static function get_menu_list(){

  }

}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

interface CrudModelInterface {

  //public function index();

  //public function create();

  //public function update();

  public function delete($id);

  public function list();

  public function view();

}

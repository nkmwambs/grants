<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

interface TableRelationshipInterface {

  public function lookup_tables();

  public function detail_tables();

  // public function table_visible_columns();
  //
  // public function table_hidden_columns();

  public function master_table_visible_columns();

  public function master_table_hidden_columns();

}

<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	// General Configurations
	$config['master_table_columns'] = '3';
	$config['extra_menu_item_columns'] = '4';
	$config['hide_created_by_column'] = true;
	$config['hide_last_modified_by_column'] = true;
	$config['hide_deleted_at_column'] = true;
	$config['max_priority_menu_items'] = 10;
	$config['default_launch_page'] = "Dashboard";
	$config['use_context_office'] = false;

	//Voucher configurations
	//If true cheque numbers can be skipped as long as are in the active cheque book
	$config['allow_skipping_of_cheque_leaves'] = false; 
	$config['use_voucher_type_abbreviation'] = true; 
	$config['only_allow_voucher_details_from_request'] = false;
	$config['append_office_code_to_voucher_number'] = true;
	$config['use_default_logo'] = false;


 

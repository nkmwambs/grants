<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

	// General Configurations
	$config['master_table_columns'] = 2;
	$config['extra_menu_item_columns'] = 4;
	$config['hide_created_by_column'] = true;
	$config['hide_last_modified_by_column'] = true;
	$config['hide_deleted_at_column'] = true;
	$config['max_priority_menu_items'] = 8;
	$config['default_launch_page'] = "Dashboard";
	$config['use_context_office'] = false;
	$config['use_select2_plugin'] = false;

	//Set up configs - Change the sequence of this array if you know what yo are doing
	$config['table_that_dont_require_history_fields'] = ['status','approve_item','account_system','approval_flow','ci_sessions'];
	// Order of relationship MUST be maintained
	$config['setup_initialized_tables'] = [	'account_system',
											'context_definition',
											'office',
											'context_global',
											'language',
											'permission_label',
											'role',
											'user',
											'designation',
											'context_global_user',
											'voucher_type_account',
											'voucher_type_effect',
											'month',
										];
	// Can be changed on initialization but must be in the order from the lowest to the highest
	$config['context_definitions'] = ['center','cluster','cohort','country','region'];// global is the highest context and should not be added in this array

	//Voucher configurations
	//If true cheque numbers can be skipped as long as are in the active cheque book
	$config['allow_skipping_of_cheque_leaves'] = true; 
	$config['use_voucher_type_abbreviation'] = true; 
	$config['only_allow_voucher_details_from_request'] = false;
	$config['append_office_code_to_voucher_number'] = true;
	$config['use_default_logo'] = false;
	$config['toggle_accounts_by_allocation'] = true; // When true, the voucher allocation codes will be used to filter accounts

	//Financial Report Configs
	$config['only_combined_center_financial_reports'] = false; // If true only drop lowest context office report in the MFR office filter
	$config['funding_balance_report_aggregate_method'] = "receipt"; // receipt or allocation
	$config['show_empty_rows_in_expense_report'] = false;
	$config['skip_empty_expense_reports'] = true;




 

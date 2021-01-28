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
	$config['use_select2_plugin'] = true;
	$config['drop_only_center'] = true; // Should be decaprecated in favor of drop_transacting_offices
	$config['drop_transacting_offices'] = true;
	$config['method_to_attach_permission_to_role'] = 'both'; // direct, role_group, both
	$config['prevent_using_global_permissions_by_non_admins'] = false;
	$config['link_new_project_allocations_only_to_default_bank_accounts'] = true;

	$config['tables_allowing_drop_only_centers'] = ['office_bank','project_allocation','office_cash'];
	$config['tables_with_account_system_relationship'] = ['office','user','bank','income_account','voucher_type'];

	//Set up configs - Change the sequence of this array if you know what yo are doing. These tables do not require approvals
	$config['table_that_dont_require_history_fields'] = ['status','approve_item','approval_flow','ci_sessions'];
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
											'country_currency',
											'department'
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
	$config['drop_only_lowest_context_offices'] = true;

	//Financial Report Configs
	$config['only_combined_center_financial_reports'] = false; // If true only drop lowest context office report in the MFR office filter
	$config['funding_balance_report_aggregate_method'] = "receipt"; // receipt or allocation
	$config['show_empty_rows_in_expense_report'] = false;
	$config['skip_empty_expense_reports'] = true;

	//Submit MFR without controls
	$config['submit_mfr_without_controls']=false;

	//Budget configs
	$config['size_in_months_of_a_budget_review_period'] = 3;
	$config['number_of_month_to_start_budget_review_before_close_of_review_period'] = 1; // Should not exceed $config['size_in_months_of_a_budget_review_period']
	$config['maximum_review_count'] = 4;

	// Journal/ MFR Config
	$config['allow_a_bank_to_be_linked_to_many_projects'] = true;

	// FY computation
	//$config['start_of_fy_month'] = 7;
	$config['fy_year_reference'] = 'next'; // Ex. prev or next
	$config['fy_year_digits'] = 2; // Ex. 2 or 4

	// S3 Configuration
	$config['upload_files_to_s3'] = true;
	$config['s3_region'] = 'eu-west-1';
	$config['s3_bucket_name'] = 'compassion-fcp-fms-version2';
	$config['temp_files_deletion_limit_hours'] = 0.5; // In hours. Use fractional of while or whole number e.g. 1, 2, 2.5




 

-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `approval`;
CREATE TABLE `approval` (
  `approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval_track_number` varchar(100) NOT NULL,
  `approval_name` varchar(100) NOT NULL,
  `fk_approve_item_id` int(11) NOT NULL,
  `approval_created_by` int(100) NOT NULL,
  `approval_created_date` date NOT NULL,
  `approval_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approval_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`approval_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `approval_ibfk_2` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approval` (`approval_id`, `approval_track_number`, `approval_name`, `fk_approve_item_id`, `approval_created_by`, `approval_created_date`, `approval_last_modified_date`, `approval_last_modified_by`) VALUES
(96,	'APR-5537',	'Approval Ticket # APR-5537',	20,	1,	'2019-11-03',	'2019-11-03 19:53:00',	1),
(97,	'APR-5538',	'Approval Ticket # APR-5538',	20,	1,	'2019-11-03',	'2019-11-03 19:53:00',	1),
(102,	'APR-32167',	'Approval Ticket # APR-32167',	2,	1,	'2019-11-03',	'2019-11-03 20:28:54',	1),
(103,	'APR-8944',	'Approval Ticket # APR-8944',	3,	1,	'2019-11-03',	'2019-11-03 20:30:16',	1);

DROP TABLE IF EXISTS `approval_process_map`;
CREATE TABLE `approval_process_map` (
  `approval_process_map_id` int(100) NOT NULL,
  `approveable_item_id` int(100) DEFAULT NULL,
  `role_id` int(100) DEFAULT NULL,
  `approval_step_depth` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`approval_process_map_id`),
  KEY `fk_approval_process_map_role1_idx` (`role_id`),
  CONSTRAINT `fk_approval_process_map_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `approve_item`;
CREATE TABLE `approve_item` (
  `approve_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `approve_item_name` varchar(100) NOT NULL,
  `approve_item_is_active` int(5) NOT NULL,
  `approve_item_created_date` date NOT NULL,
  `approve_item_created_by` int(100) NOT NULL,
  `approve_item_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approve_item_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approve_item` (`approve_item_id`, `approve_item_name`, `approve_item_is_active`, `approve_item_created_date`, `approve_item_created_by`, `approve_item_last_modified_date`, `approve_item_last_modified_by`) VALUES
(1,	'request_detail',	0,	'0000-00-00',	0,	'2019-10-22 12:34:13',	0),
(2,	'voucher',	1,	'0000-00-00',	0,	'2019-10-24 21:23:30',	0),
(3,	'request',	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(4,	'budget',	1,	'2019-10-22',	1,	'2019-10-21 21:00:00',	1),
(5,	'budget_item',	0,	'2019-10-22',	1,	'2019-10-21 21:00:00',	1),
(8,	'funder',	0,	'2019-10-22',	1,	'2019-10-22 10:54:56',	1),
(9,	'workplan',	0,	'2019-10-22',	1,	'2019-10-22 12:07:47',	1),
(13,	'budget_item_detail',	0,	'2019-10-22',	1,	'2019-10-22 12:41:39',	1),
(14,	'voucher_detail',	0,	'2019-10-22',	1,	'2019-10-22 12:41:52',	1),
(18,	'project',	0,	'2019-10-25',	1,	'2019-10-24 22:22:18',	1),
(19,	'project_allocation',	0,	'2019-11-03',	1,	'2019-11-03 10:36:29',	1),
(20,	'center',	0,	'2019-11-03',	1,	'2019-11-03 11:14:26',	1);

DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `bank_track_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_swift_code` varchar(45) DEFAULT NULL,
  `bank_is_active` int(5) DEFAULT NULL,
  `bank_created_date` date DEFAULT NULL,
  `bank_created_by` int(100) DEFAULT NULL,
  `bank_last_modified_date` date DEFAULT NULL,
  `bank_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the banks for centers';

INSERT INTO `bank` (`bank_id`, `bank_track_number`, `bank_name`, `bank_swift_code`, `bank_is_active`, `bank_created_date`, `bank_created_by`, `bank_last_modified_date`, `bank_last_modified_by`) VALUES
(1,	'BAK-87365',	'Commercial Bank of Kenya',	'2365',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `bank_branch`;
CREATE TABLE `bank_branch` (
  `bank_branch_id` int(100) NOT NULL AUTO_INCREMENT,
  `bank_branch_track_number` varchar(100) DEFAULT NULL,
  `fk_bank_id` int(100) DEFAULT NULL,
  `bank_branch_name` varchar(45) DEFAULT NULL,
  `bank_branch_is_active` int(5) DEFAULT NULL,
  `bank_branch_created_by` int(100) DEFAULT NULL,
  `bank_branch_created_date` date DEFAULT NULL,
  `bank_branch_last_modified_date` date DEFAULT NULL,
  `bank_branch_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`bank_branch_id`),
  KEY `fk_bank_branch_bank1_idx` (`fk_bank_id`),
  CONSTRAINT `fk_bank_branch_bank1` FOREIGN KEY (`fk_bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table holds branches for banks';

INSERT INTO `bank_branch` (`bank_branch_id`, `bank_branch_track_number`, `fk_bank_id`, `bank_branch_name`, `bank_branch_is_active`, `bank_branch_created_by`, `bank_branch_created_date`, `bank_branch_last_modified_date`, `bank_branch_last_modified_by`) VALUES
(1,	'BBC-83984',	1,	'Kilifi',	1,	1,	'2019-10-09',	'2019-10-09',	1);

DROP TABLE IF EXISTS `budget`;
CREATE TABLE `budget` (
  `budget_id` int(100) NOT NULL AUTO_INCREMENT,
  `budget_track_number` varchar(45) DEFAULT NULL,
  `budget_name` varchar(100) DEFAULT NULL,
  `fk_center_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT '0',
  `fk_status_id` int(11) DEFAULT '0',
  `budget_year` int(5) DEFAULT NULL,
  `budget_created_by` int(100) DEFAULT NULL,
  `budget_created_date` date DEFAULT NULL,
  `budget_last_modified_by` int(100) DEFAULT NULL,
  `budget_last_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`budget_id`),
  KEY `fk_budget_center1_idx` (`fk_center_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`),
  CONSTRAINT `budget_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `budget_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_budget_center1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table holds the budget items by activity';


DROP TABLE IF EXISTS `budget_item`;
CREATE TABLE `budget_item` (
  `budget_item_id` int(100) NOT NULL AUTO_INCREMENT,
  `budget_item_track_number` varchar(100) DEFAULT NULL,
  `budget_item_name` varchar(100) DEFAULT NULL,
  `fk_budget_id` int(100) DEFAULT NULL,
  `fk_expense_account_id` int(100) DEFAULT NULL,
  `budget_item_description` varchar(45) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT '0',
  `fk_approval_id` int(11) DEFAULT '0',
  `fk_project_allocation_id` int(100) DEFAULT NULL,
  `budget_item_note` longtext,
  `budget_item_created_by` int(100) DEFAULT NULL,
  `budget_item_last_modified_by` int(100) DEFAULT NULL,
  `budget_item_created_date` date DEFAULT NULL,
  `budget_item_last_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`budget_item_id`),
  KEY `fk_budget_detail_id_expense_account_id_idx` (`fk_expense_account_id`),
  KEY `fk_budget_detail_budget_id_idx` (`fk_budget_id`),
  KEY `fk_project_allocation_id` (`fk_project_allocation_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `budget_item_ibfk_1` FOREIGN KEY (`fk_project_allocation_id`) REFERENCES `project_allocation` (`project_allocation_id`),
  CONSTRAINT `budget_item_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `budget_item_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `fk_budget_detail_budget_id` FOREIGN KEY (`fk_budget_id`) REFERENCES `budget` (`budget_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_budget_detail_id_expense_account_id` FOREIGN KEY (`fk_expense_account_id`) REFERENCES `expense_account` (`expense_account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This hold activties and their budgeted cost';


DROP TABLE IF EXISTS `budget_item_detail`;
CREATE TABLE `budget_item_detail` (
  `budget_item_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `budget_item_detail_track_number` varchar(100) DEFAULT NULL,
  `budget_item_detail_name` varchar(100) DEFAULT NULL,
  `fk_budget_item_id` int(100) DEFAULT NULL,
  `fk_month_id` int(5) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT '0',
  `fk_approval_id` int(11) DEFAULT '0',
  `budget_item_detail_amount` decimal(10,2) DEFAULT NULL,
  `budget_item_detail_created_date` date DEFAULT NULL,
  `budget_item_detail_created_by` int(100) DEFAULT NULL,
  `budget_item_detail_last_modified_by` int(100) DEFAULT NULL,
  `budget_item_detail_last_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`budget_item_detail_id`),
  KEY `fk_budget_month_spread_budget_detail1_idx` (`fk_budget_item_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `budget_item_detail_ibfk_1` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `budget_item_detail_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `fk_budget_month_spread_budget_detail1` FOREIGN KEY (`fk_budget_item_id`) REFERENCES `budget_item` (`budget_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table distributes budget allocations by month';


DROP TABLE IF EXISTS `center`;
CREATE TABLE `center` (
  `center_id` int(100) NOT NULL AUTO_INCREMENT,
  `center_track_number` varchar(100) DEFAULT NULL,
  `center_name` varchar(45) NOT NULL,
  `center_code` varchar(10) NOT NULL,
  `center_start_date` date NOT NULL,
  `center_end_date` date NOT NULL,
  `center_is_active` int(5) NOT NULL DEFAULT '0',
  `center_created_by` int(100) NOT NULL,
  `center_created_date` date NOT NULL,
  `center_last_modified_date` date NOT NULL,
  `center_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`center_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the remote sites for the organization\n';

INSERT INTO `center` (`center_id`, `center_track_number`, `center_name`, `center_code`, `center_start_date`, `center_end_date`, `center_is_active`, `center_created_by`, `center_created_date`, `center_last_modified_date`, `center_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'CNT-97356',	'Kiserian CDC',	'KE0240',	'2019-09-27',	'2019-09-27',	1,	1,	'2019-09-27',	'2019-09-27',	1,	96,	45),
(8,	'CNT-42426',	'Kamangu CDC',	'KE0452',	'1990-11-13',	'0000-00-00',	1,	1,	'2019-11-03',	'0000-00-00',	1,	97,	45);

DROP TABLE IF EXISTS `center_bank`;
CREATE TABLE `center_bank` (
  `center_bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `center_bank_track_number` varchar(100) DEFAULT NULL,
  `fk_center_id` int(100) DEFAULT NULL,
  `center_bank_bank_account_number` varchar(50) DEFAULT NULL,
  `fk_bank_branch_id` int(100) DEFAULT NULL,
  `center_bank_created_date` date DEFAULT NULL,
  `center_bank_created_by` int(100) DEFAULT NULL,
  `center_bank_last_modified_date` timestamp NULL DEFAULT NULL,
  `center_bank_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`center_bank_id`),
  KEY `fk_center_bank_center1_idx` (`fk_center_id`),
  KEY `fk_center_bank_bank_branch1_idx` (`fk_bank_branch_id`),
  CONSTRAINT `fk_center_bank_bank_branch1` FOREIGN KEY (`fk_bank_branch_id`) REFERENCES `bank_branch` (`bank_branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_center_bank_center1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `center_group`;
CREATE TABLE `center_group` (
  `center_group_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `group_level` int(5) DEFAULT NULL,
  `role_id` int(100) DEFAULT NULL COMMENT 'Manager role id\n',
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  PRIMARY KEY (`center_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `center_group` (`center_group_id`, `name`, `group_level`, `role_id`, `created_date`, `last_modified_date`, `created_by`, `last_modified_by`, `deleted_date`) VALUES
(1,	'Cluster',	1,	1,	'2019-09-27',	'2019-09-27',	1,	1,	NULL),
(2,	'Region',	2,	2,	'2019-09-27',	'2019-09-27',	1,	1,	NULL),
(3,	'Area',	3,	3,	'2019-09-27',	'2019-09-27',	1,	1,	NULL),
(4,	'Global',	4,	4,	'2019-09-27',	'2019-09-27',	1,	1,	NULL);

DROP TABLE IF EXISTS `center_group_link`;
CREATE TABLE `center_group_link` (
  `center_group_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `center_id` int(100) DEFAULT NULL,
  `center_group_id` int(100) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL COMMENT 'User id of the manager',
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  `center_group_link_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`center_group_link_id`),
  KEY `fk_center_group_link_center1_idx` (`center_id`),
  KEY `fk_center_group_link_center_group1_idx` (`center_group_id`),
  CONSTRAINT `fk_center_group_link_center1` FOREIGN KEY (`center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_center_group_link_center_group1` FOREIGN KEY (`center_group_id`) REFERENCES `center_group` (`center_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `center_group_link` (`center_group_link_id`, `center_id`, `center_group_id`, `user_id`, `created_date`, `last_modified_date`, `deleted_date`, `created_by`, `last_modified_by`, `center_group_link_name`) VALUES
(1,	1,	1,	1,	'2019-09-27',	'2019-09-27',	NULL,	1,	1,	'Central Cluster');

DROP TABLE IF EXISTS `chatable_table`;
CREATE TABLE `chatable_table` (
  `chatable_table_id` int(11) NOT NULL,
  `chatable_table_name` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`chatable_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `cheque_book`;
CREATE TABLE `cheque_book` (
  `cheque_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `center_bank_id` int(100) DEFAULT NULL,
  `start_serial_number` varchar(45) DEFAULT NULL,
  `count_of_leaves` varchar(45) DEFAULT NULL,
  `use_start_date` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cheque_book_id`),
  KEY `fk_cheque_book_center_bank1_idx` (`center_bank_id`),
  CONSTRAINT `fk_cheque_book_center_bank1` FOREIGN KEY (`center_bank_id`) REFERENCES `center_bank` (`center_bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `customizable_table`;
CREATE TABLE `customizable_table` (
  `customizable_table_id` int(11) NOT NULL,
  `customizable_table_name` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`customizable_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `custom_field`;
CREATE TABLE `custom_field` (
  `custom_field_id` int(100) NOT NULL,
  `customizable_table_id` int(100) DEFAULT NULL,
  `column_name` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  `custom_field_type_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`custom_field_id`),
  KEY `fk_custom_field_customizable_table1_idx` (`customizable_table_id`),
  KEY `fk_custom_field_custom_field_type1_idx` (`custom_field_type_id`),
  CONSTRAINT `fk_custom_field_custom_field_type1` FOREIGN KEY (`custom_field_type_id`) REFERENCES `custom_field_type` (`custom_field_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_custom_field_customizable_table1` FOREIGN KEY (`customizable_table_id`) REFERENCES `customizable_table` (`customizable_table_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `custom_field_detail`;
CREATE TABLE `custom_field_detail` (
  `custom_field_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `custom_field_id` int(100) DEFAULT NULL,
  `custom_field_value` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`custom_field_detail_id`),
  KEY `fk_custom_field_detail_custom_field1_idx` (`custom_field_id`),
  CONSTRAINT `fk_custom_field_detail_custom_field1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_field` (`custom_field_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `custom_field_type`;
CREATE TABLE `custom_field_type` (
  `custom_field_type_id` int(100) NOT NULL AUTO_INCREMENT,
  `custom_field_type_name` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`custom_field_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `custom_field_type_option`;
CREATE TABLE `custom_field_type_option` (
  `custom_field_type_option_id` int(100) NOT NULL AUTO_INCREMENT,
  `custom_field_id` int(100) DEFAULT NULL,
  `custom_field_type_option_name` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`custom_field_type_option_id`),
  KEY `fk_custom_field_type_option_custom_field1_idx` (`custom_field_id`),
  CONSTRAINT `fk_custom_field_type_option_custom_field1` FOREIGN KEY (`custom_field_id`) REFERENCES `custom_field` (`custom_field_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `dashboard`;
CREATE TABLE `dashboard` (
  `dashboard_id` int(100) NOT NULL AUTO_INCREMENT,
  `dashboard_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`dashboard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `expense_account`;
CREATE TABLE `expense_account` (
  `expense_account_id` int(100) NOT NULL AUTO_INCREMENT,
  `expense_account_track_number` varchar(100) DEFAULT NULL,
  `expense_account_name` varchar(100) DEFAULT NULL,
  `expense_account_description` varchar(100) DEFAULT NULL,
  `expense_account_code` varchar(10) DEFAULT NULL,
  `expense_account_is_admin` int(5) DEFAULT NULL,
  `expense_account_is_active` int(5) DEFAULT NULL,
  `expense_account_is_budgeted` int(5) DEFAULT NULL,
  `fk_income_account_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `expense_account_created_date` date DEFAULT NULL,
  `expense_account_last_modified_date` date DEFAULT NULL,
  `expense_account_created_by` int(100) DEFAULT NULL,
  `expense_account_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`expense_account_id`),
  KEY `fk_expense_account_income_account_idx` (`fk_income_account_id`),
  CONSTRAINT `fk_expense_account_income_account` FOREIGN KEY (`fk_income_account_id`) REFERENCES `income_account` (`income_account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table holds the expense accounts';

INSERT INTO `expense_account` (`expense_account_id`, `expense_account_track_number`, `expense_account_name`, `expense_account_description`, `expense_account_code`, `expense_account_is_admin`, `expense_account_is_active`, `expense_account_is_budgeted`, `fk_income_account_id`, `fk_approval_id`, `fk_status_id`, `expense_account_created_date`, `expense_account_last_modified_date`, `expense_account_created_by`, `expense_account_last_modified_by`) VALUES
(1,	'EAC-78285',	'Expense Account 1',	'Expense 1',	'E001',	0,	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'EAC-87922',	'Expense Account 2',	'Expense 2',	'E002',	0,	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'EAC-87020',	'Expense Account 3',	'Expense 3',	'E003',	0,	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `funder`;
CREATE TABLE `funder` (
  `funder_id` int(100) NOT NULL AUTO_INCREMENT,
  `funder_track_number` varchar(100) DEFAULT NULL,
  `funder_name` varchar(45) DEFAULT NULL,
  `funder_description` varchar(45) DEFAULT NULL,
  `funder_created_date` date DEFAULT NULL,
  `funder_last_modified_date` date DEFAULT NULL,
  `funder_created_by` int(100) DEFAULT NULL,
  `funder_last_modified_by` int(100) DEFAULT NULL,
  `funder_deleted_at` datetime DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`funder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table holds donor (funders) bio-information';

INSERT INTO `funder` (`funder_id`, `funder_track_number`, `funder_name`, `funder_description`, `funder_created_date`, `funder_last_modified_date`, `funder_created_by`, `funder_last_modified_by`, `funder_deleted_at`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'FDR-74473',	'ECRAF',	'East Africa Consortium of Relief Financiers',	'2019-10-07',	'2019-10-07',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'FDR-68477',	'SSDF',	'Social Security Granters',	'2019-10-07',	'2019-10-07',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `funding_status`;
CREATE TABLE `funding_status` (
  `funding_status_id` int(100) NOT NULL AUTO_INCREMENT,
  `funding_status_name` varchar(45) DEFAULT NULL,
  `funding_status_is_active` int(5) DEFAULT NULL,
  `funding_status_created_date` date DEFAULT NULL,
  `funding_status_created_by` int(100) DEFAULT NULL,
  `funding_status_last_modified_by` int(100) DEFAULT NULL,
  `funding_status_last_modified_date` date DEFAULT NULL,
  `funding_status_is_available` int(5) DEFAULT NULL,
  PRIMARY KEY (`funding_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `funding_status` (`funding_status_id`, `funding_status_name`, `funding_status_is_active`, `funding_status_created_date`, `funding_status_created_by`, `funding_status_last_modified_by`, `funding_status_last_modified_date`, `funding_status_is_available`) VALUES
(1,	'Fully Funded',	1,	NULL,	NULL,	NULL,	NULL,	1);

DROP TABLE IF EXISTS `handover`;
CREATE TABLE `handover` (
  `handover_id` int(100) NOT NULL AUTO_INCREMENT,
  `handover_assignor` int(100) NOT NULL,
  `handover_assignee` int(100) NOT NULL,
  `handover_start_date` date NOT NULL,
  `handover_end_date` date NOT NULL,
  `handover_created_by` int(100) NOT NULL,
  `handover_created_date` date NOT NULL,
  `handover_last_modified_by` int(100) NOT NULL,
  `handover_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`handover_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `history_id` int(100) NOT NULL AUTO_INCREMENT,
  `reference_table` varchar(45) DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `table_action` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `income_account`;
CREATE TABLE `income_account` (
  `income_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `income_account_track_number` varchar(100) NOT NULL,
  `income_account_name` varchar(100) NOT NULL,
  `income_account_description` varchar(100) DEFAULT NULL,
  `income_account_code` varchar(10) DEFAULT NULL,
  `income_account_is_active` int(5) DEFAULT NULL,
  `income_account_is_budgeted` int(5) DEFAULT NULL,
  `income_account_is_donor_funded` int(5) DEFAULT NULL,
  `income_account_created_date` date DEFAULT NULL,
  `income_account_last_modified_date` date DEFAULT NULL,
  `income_account_created_by` int(100) DEFAULT NULL,
  `income_account_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`income_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains the income accounts. ';

INSERT INTO `income_account` (`income_account_id`, `income_account_track_number`, `income_account_name`, `income_account_description`, `income_account_code`, `income_account_is_active`, `income_account_is_budgeted`, `income_account_is_donor_funded`, `income_account_created_date`, `income_account_last_modified_date`, `income_account_created_by`, `income_account_last_modified_by`) VALUES
(1,	'INC-65627',	'Income Account 1',	'Project Cost',	'PC',	1,	1,	1,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `journal`;
CREATE TABLE `journal` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_name` varchar(100) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `language_id` int(100) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(100) DEFAULT NULL,
  `language_short_name` varchar(10) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `language_phrase`;
CREATE TABLE `language_phrase` (
  `language_phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`language_phrase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(100) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_derivative_controller` varchar(100) DEFAULT NULL,
  `menu_created_date` date DEFAULT NULL,
  `menu_last_modified_date` date DEFAULT NULL,
  `menu_created_by` int(100) DEFAULT NULL,
  `menu_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_derivative_controller`, `menu_created_date`, `menu_last_modified_date`, `menu_created_by`, `menu_last_modified_by`) VALUES
(48,	'Center',	'Center',	NULL,	NULL,	NULL,	NULL),
(49,	'Approval',	'Approval',	NULL,	NULL,	NULL,	NULL),
(50,	'Bank',	'Bank',	NULL,	NULL,	NULL,	NULL),
(51,	'Budget',	'Budget',	NULL,	NULL,	NULL,	NULL),
(52,	'Workplan',	'Workplan',	NULL,	NULL,	NULL,	NULL),
(55,	'Voucher',	'Voucher',	NULL,	NULL,	NULL,	NULL),
(56,	'Dashboard',	'Dashboard',	NULL,	NULL,	NULL,	NULL),
(58,	'Funder',	'Funder',	NULL,	NULL,	NULL,	NULL),
(59,	'Journal',	'Journal',	NULL,	NULL,	NULL,	NULL),
(60,	'Language',	'Language',	NULL,	NULL,	NULL,	NULL),
(62,	'Project_allocation',	'Project_allocation',	NULL,	NULL,	NULL,	NULL),
(63,	'Request',	'Request',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `menu_user_order`;
CREATE TABLE `menu_user_order` (
  `menu_user_order_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(100) DEFAULT NULL,
  `fk_menu_id` int(100) DEFAULT NULL,
  `menu_user_order_is_active` int(5) NOT NULL DEFAULT '1',
  `menu_user_order_level` int(100) DEFAULT NULL,
  `menu_user_order_priority_item` int(5) NOT NULL DEFAULT '1',
  `menu_user_order_created_date` date DEFAULT NULL,
  `menu_user_order_last_modified_date` date DEFAULT NULL,
  `menu_user_order_created_by` int(100) DEFAULT NULL,
  `menu_user_order_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`menu_user_order_id`),
  KEY `fk_menu_id` (`fk_menu_id`),
  CONSTRAINT `menu_user_order_ibfk_1` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `menu_user_order` (`menu_user_order_id`, `fk_user_id`, `fk_menu_id`, `menu_user_order_is_active`, `menu_user_order_level`, `menu_user_order_priority_item`, `menu_user_order_created_date`, `menu_user_order_last_modified_date`, `menu_user_order_created_by`, `menu_user_order_last_modified_by`) VALUES
(49,	1,	48,	1,	7,	1,	NULL,	NULL,	NULL,	NULL),
(50,	1,	49,	1,	8,	1,	NULL,	NULL,	NULL,	NULL),
(51,	1,	50,	1,	9,	1,	NULL,	NULL,	NULL,	NULL),
(52,	1,	51,	1,	10,	1,	NULL,	NULL,	NULL,	NULL),
(53,	1,	52,	1,	11,	1,	NULL,	NULL,	NULL,	NULL),
(56,	1,	55,	1,	12,	1,	NULL,	NULL,	NULL,	NULL),
(57,	1,	56,	1,	13,	1,	NULL,	NULL,	NULL,	NULL),
(59,	1,	58,	1,	15,	1,	NULL,	NULL,	NULL,	NULL),
(60,	1,	59,	1,	16,	1,	NULL,	NULL,	NULL,	NULL),
(61,	1,	60,	1,	17,	0,	NULL,	NULL,	NULL,	NULL),
(63,	1,	62,	1,	19,	1,	NULL,	NULL,	NULL,	NULL),
(64,	1,	63,	1,	20,	1,	NULL,	NULL,	NULL,	NULL),
(68,	NULL,	48,	1,	1,	1,	NULL,	NULL,	NULL,	NULL),
(69,	NULL,	49,	1,	2,	1,	NULL,	NULL,	NULL,	NULL),
(70,	NULL,	50,	1,	3,	1,	NULL,	NULL,	NULL,	NULL),
(71,	NULL,	51,	1,	4,	1,	NULL,	NULL,	NULL,	NULL),
(72,	NULL,	52,	1,	5,	1,	NULL,	NULL,	NULL,	NULL),
(73,	NULL,	55,	1,	6,	1,	NULL,	NULL,	NULL,	NULL),
(74,	NULL,	56,	1,	7,	1,	NULL,	NULL,	NULL,	NULL),
(75,	NULL,	58,	1,	8,	1,	NULL,	NULL,	NULL,	NULL),
(76,	NULL,	59,	1,	9,	1,	NULL,	NULL,	NULL,	NULL),
(77,	NULL,	60,	1,	10,	1,	NULL,	NULL,	NULL,	NULL),
(78,	NULL,	62,	1,	11,	1,	NULL,	NULL,	NULL,	NULL),
(79,	NULL,	63,	1,	12,	0,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `chatable_table_id` int(100) DEFAULT NULL,
  `customizable_table_item_primary_key` int(100) DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `is_thread_open` int(5) DEFAULT '1',
  PRIMARY KEY (`message_id`),
  KEY `fk_message_chatable_table1_idx` (`chatable_table_id`),
  CONSTRAINT `fk_message_chatable_table1` FOREIGN KEY (`chatable_table_id`) REFERENCES `chatable_table` (`chatable_table_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `message_detail`;
CREATE TABLE `message_detail` (
  `message_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_from_user_id` int(100) DEFAULT NULL,
  `message_content` longtext,
  `message_id` int(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  `is_reply` int(5) DEFAULT '0',
  `replied_message_detail_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`message_detail_id`),
  KEY `fk_message_detail_message1_idx` (`message_id`),
  CONSTRAINT `fk_message_detail_message1` FOREIGN KEY (`message_id`) REFERENCES `message` (`message_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `month`;
CREATE TABLE `month` (
  `month_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_track_number` varchar(100) NOT NULL,
  `month_number` int(5) NOT NULL,
  `month_name` varchar(50) NOT NULL,
  `fk_approval` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `month_created_by` int(100) NOT NULL,
  `month_last_modified_by` int(100) NOT NULL,
  `month_created_date` date NOT NULL,
  `month_last_modified_date` date NOT NULL,
  PRIMARY KEY (`month_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `month` (`month_id`, `month_track_number`, `month_number`, `month_name`, `fk_approval`, `fk_status_id`, `month_created_by`, `month_last_modified_by`, `month_created_date`, `month_last_modified_date`) VALUES
(1,	'',	1,	'January',	0,	0,	0,	0,	'0000-00-00',	'0000-00-00'),
(2,	'',	2,	'February',	0,	0,	0,	0,	'0000-00-00',	'0000-00-00');

DROP TABLE IF EXISTS `phprbac_permissions`;
CREATE TABLE `phprbac_permissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` char(64) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `phprbac_permissions` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
(23,	0,	11,	'add_request',	'Add a new request'),
(24,	0,	9,	'edit_request',	'Edit a request'),
(25,	0,	7,	'delete_request',	'Delete a request'),
(26,	0,	5,	'view_request',	'View a new request'),
(27,	0,	3,	'approve_request',	'Approve a request'),
(28,	0,	1,	'escalate_request',	'Escalate a request to a voucher');

DROP TABLE IF EXISTS `phprbac_rolepermissions`;
CREATE TABLE `phprbac_rolepermissions` (
  `RoleID` int(11) NOT NULL,
  `PermissionID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`RoleID`,`PermissionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `phprbac_roles`;
CREATE TABLE `phprbac_roles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lft` int(11) NOT NULL,
  `Rght` int(11) NOT NULL,
  `Title` varchar(128) COLLATE utf8_bin NOT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Title` (`Title`),
  KEY `Lft` (`Lft`),
  KEY `Rght` (`Rght`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `phprbac_roles` (`ID`, `Lft`, `Rght`, `Title`, `Description`) VALUES
(1,	0,	9,	'authenticated_user',	'Authenticated User'),
(2,	1,	2,	'accountant',	'Accountant'),
(3,	3,	4,	'finance_director',	'Finance Director'),
(4,	5,	6,	'super_admin',	'Supper Administrator'),
(5,	7,	8,	'system_admin',	'System Administrator');

DROP TABLE IF EXISTS `phprbac_userroles`;
CREATE TABLE `phprbac_userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `AssignmentDate` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `project_id` int(100) NOT NULL AUTO_INCREMENT,
  `project_track_number` varchar(100) DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `project_code` varchar(10) NOT NULL,
  `project_description` varchar(100) DEFAULT NULL,
  `project_start_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `fk_funder_id` int(100) NOT NULL,
  `project_cost` double(10,2) NOT NULL,
  `fk_funding_status_id` int(100) DEFAULT NULL,
  `project_created_by` int(100) NOT NULL,
  `project_last_modified_by` int(100) NOT NULL,
  `project_created_date` date NOT NULL,
  `project_last_modified_date` date NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_id`),
  KEY `fk_project_id_funder_id_idx` (`fk_funder_id`),
  KEY `fk_project_funding_status1_idx` (`fk_funding_status_id`),
  CONSTRAINT `fk_project_funding_status1` FOREIGN KEY (`fk_funding_status_id`) REFERENCES `funding_status` (`funding_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_id_funder_id` FOREIGN KEY (`fk_funder_id`) REFERENCES `funder` (`funder_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A project is a single funded proposal that need to be implemented and reported as a unit. It''s related to single funder\n ';

INSERT INTO `project` (`project_id`, `project_track_number`, `project_name`, `project_code`, `project_description`, `project_start_date`, `project_end_date`, `fk_funder_id`, `project_cost`, `fk_funding_status_id`, `project_created_by`, `project_last_modified_by`, `project_created_date`, `project_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(4,	'PRJ-376374',	'Project 1',	'WASH-01',	'WASH in Urban Homes',	'2019-10-07',	'2019-10-07',	1,	1563800.00,	1,	0,	0,	'0000-00-00',	'0000-00-00',	NULL,	NULL),
(5,	'PRJ-376374',	'Project 2',	'LEGAL-56',	'Human Rights Cases Funding',	'2019-10-07',	'2019-10-07',	1,	3200340.00,	1,	0,	0,	'0000-00-00',	'0000-00-00',	NULL,	NULL),
(6,	'PRJ-767755',	'Project 3',	'EDU-56',	'High School Scholarships',	'2019-10-07',	'2019-10-07',	2,	5600320.00,	1,	0,	0,	'0000-00-00',	'0000-00-00',	NULL,	NULL);

DROP TABLE IF EXISTS `project_allocation`;
CREATE TABLE `project_allocation` (
  `project_allocation_id` int(100) NOT NULL AUTO_INCREMENT,
  `project_allocation_track_number` varchar(100) DEFAULT NULL,
  `fk_project_id` int(100) DEFAULT NULL,
  `project_allocation_name` varchar(100) DEFAULT NULL,
  `project_allocation_amount` decimal(10,2) DEFAULT NULL,
  `project_allocation_is_active` int(5) DEFAULT NULL,
  `fk_center_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `project_allocation_extended_end_date` date DEFAULT NULL,
  `project_allocation_created_date` date DEFAULT NULL,
  `project_allocation_last_modified_date` varchar(45) DEFAULT NULL,
  `project_allocation_created_by` int(100) DEFAULT NULL,
  `project_allocation_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_allocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `project_allocation` (`project_allocation_id`, `project_allocation_track_number`, `fk_project_id`, `project_allocation_name`, `project_allocation_amount`, `project_allocation_is_active`, `fk_center_id`, `fk_status_id`, `fk_approval_id`, `project_allocation_extended_end_date`, `project_allocation_created_date`, `project_allocation_last_modified_date`, `project_allocation_created_by`, `project_allocation_last_modified_by`) VALUES
(1,	'CPA-76278',	4,	'Center Allocation 1',	560000.00,	1,	1,	NULL,	NULL,	'2019-10-11',	NULL,	NULL,	1,	1);

DROP TABLE IF EXISTS `project_cost_proportion`;
CREATE TABLE `project_cost_proportion` (
  `project_cost_proportion_id` int(11) NOT NULL,
  `voucher_detail_id` int(100) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `last_modified_date` varchar(45) DEFAULT NULL,
  `center_project_allocation_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_cost_proportion_id`),
  KEY `voucher_detail_id` (`voucher_detail_id`),
  CONSTRAINT `project_cost_proportion_ibfk_1` FOREIGN KEY (`voucher_detail_id`) REFERENCES `voucher_detail` (`voucher_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `reconciliation`;
CREATE TABLE `reconciliation` (
  `reconciliation_id` int(100) NOT NULL AUTO_INCREMENT,
  `reconciliation_track_number` varchar(100) DEFAULT NULL,
  `fk_center_id` int(100) DEFAULT NULL,
  `reconciliation_reporting_month` date DEFAULT NULL,
  `fk_status_id` int(5) DEFAULT NULL,
  `reconciliation_statement_amount` decimal(10,2) DEFAULT NULL,
  `reconciliation_suspense_amount` decimal(10,2) DEFAULT NULL,
  `reconciliation_created_by` int(100) DEFAULT NULL,
  `reconciliation_created_date` date DEFAULT NULL,
  `reconciliation_last_modified_by` int(100) DEFAULT NULL,
  `reconciliation_last_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`reconciliation_id`),
  KEY `fk_reconciliation_center1_idx` (`fk_center_id`),
  CONSTRAINT `fk_reconciliation_center1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `reconciliation` (`reconciliation_id`, `reconciliation_track_number`, `fk_center_id`, `reconciliation_reporting_month`, `fk_status_id`, `reconciliation_statement_amount`, `reconciliation_suspense_amount`, `reconciliation_created_by`, `reconciliation_created_date`, `reconciliation_last_modified_by`, `reconciliation_last_modified_date`) VALUES
(1,	'REC-74374',	1,	'2019-10-07',	1,	34500.00,	0.00,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `request_id` int(100) NOT NULL AUTO_INCREMENT,
  `request_track_number` varchar(100) DEFAULT NULL,
  `request_name` varchar(100) DEFAULT NULL,
  `fk_status_id` int(5) DEFAULT '0',
  `fk_center_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `request_created_date` date DEFAULT NULL,
  `request_created_by` varchar(45) DEFAULT NULL,
  `request_last_modified_by` varchar(45) DEFAULT NULL,
  `request_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `fk_request_center2_idx` (`fk_center_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `fk_request_center2` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `request` (`request_id`, `request_track_number`, `request_name`, `fk_status_id`, `fk_center_id`, `fk_approval_id`, `request_date`, `request_description`, `request_created_date`, `request_created_by`, `request_last_modified_by`, `request_last_modified_date`, `request_deleted_at`) VALUES
(81,	'REQ-31629',	'Testing req',	14,	1,	103,	'2019-11-13',	'Test',	'2019-11-03',	'1',	'1',	'2019-11-03 20:30:16',	NULL);

DROP TABLE IF EXISTS `request_detail`;
CREATE TABLE `request_detail` (
  `request_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `request_detail_track_number` varchar(100) DEFAULT NULL,
  `fk_request_id` int(100) DEFAULT NULL,
  `request_detail_description` varchar(45) DEFAULT NULL,
  `request_detail_quantity` int(10) DEFAULT NULL,
  `request_detail_unit_cost` decimal(10,2) DEFAULT NULL,
  `request_detail_total_cost` decimal(10,2) DEFAULT NULL,
  `fk_expense_account_id` int(100) DEFAULT NULL,
  `fk_project_allocation_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `request_detail_created_date` date DEFAULT NULL,
  `request_detail_created_by` int(100) DEFAULT NULL,
  `request_detail_last_modified_by` int(100) DEFAULT NULL,
  `request_detail_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`request_detail_id`),
  KEY `fk_request_detail_request1_idx` (`fk_request_id`),
  KEY `fk_request_detail_expense_account1_idx` (`fk_expense_account_id`),
  CONSTRAINT `fk_request_detail_expense_account1` FOREIGN KEY (`fk_expense_account_id`) REFERENCES `expense_account` (`expense_account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_detail_request1` FOREIGN KEY (`fk_request_id`) REFERENCES `request` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `request_detail` (`request_detail_id`, `request_detail_track_number`, `fk_request_id`, `request_detail_description`, `request_detail_quantity`, `request_detail_unit_cost`, `request_detail_total_cost`, `fk_expense_account_id`, `fk_project_allocation_id`, `fk_status_id`, `fk_approval_id`, `request_detail_created_date`, `request_detail_created_by`, `request_detail_last_modified_by`, `request_detail_last_modified_date`) VALUES
(102,	'RQD-33499',	81,	'Test',	17,	1800.00,	3060.00,	1,	1,	1,	NULL,	'2019-11-03',	1,	1,	'2019-11-03 20:30:16');

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(100) NOT NULL AUTO_INCREMENT,
  `role_track_number` varchar(100) DEFAULT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `role_created_by` int(100) DEFAULT NULL,
  `role_created_date` date DEFAULT NULL,
  `role_last_modified_date` date DEFAULT NULL,
  `role_last_modified_by` varchar(45) DEFAULT NULL,
  `role_deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`role_id`, `role_track_number`, `role_name`, `role_created_by`, `role_created_date`, `role_last_modified_date`, `role_last_modified_by`, `role_deleted_at`) VALUES
(1,	'ROL-65362',	'Department Manager',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'ROL-76388',	'M&E Specialist',	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'ROL-76899',	'Training Faciliator',	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'ROL-57628',	'Finance Director',	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	'ROL-68638',	'Junior Accountant',	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	'ROL-57827',	'Senior Accountant',	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'ROL-65572',	'Assistant Finance Director',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `setting` (`setting_id`, `type`, `description`, `created_date`, `last_modified_date`, `deleted_date`, `created_by`, `last_modified_by`) VALUES
(1,	'system_name',	'Grants Management System',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'system_title',	'Grants Management System',	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'address',	'1945 Nairobi',	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'phone',	'254711808071',	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'system_email',	'support@compassionkenya.com',	NULL,	NULL,	NULL,	NULL,	NULL),
(9,	'language',	'english',	NULL,	NULL,	NULL,	NULL,	NULL),
(10,	'text_align',	'left-to-right',	NULL,	NULL,	NULL,	NULL,	NULL),
(14,	'skin_colour',	'blue',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `status_action_label` varchar(50) NOT NULL,
  `fk_approve_item_id` int(11) NOT NULL,
  `status_approval_sequence` varchar(50) NOT NULL,
  `status_approval_direction` int(5) NOT NULL,
  `status_is_requiring_approver_action` int(5) NOT NULL DEFAULT '1',
  `fk_role_id` int(100) NOT NULL,
  `status_created_date` date NOT NULL,
  `status_created_by` int(100) NOT NULL,
  `status_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`status_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  CONSTRAINT `status_ibfk_2` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`status_id`, `status_name`, `status_action_label`, `fk_approve_item_id`, `status_approval_sequence`, `status_approval_direction`, `status_is_requiring_approver_action`, `fk_role_id`, `status_created_date`, `status_created_by`, `status_last_modified_date`, `status_last_modified_by`) VALUES
(1,	'New',	'',	1,	'1',	1,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(2,	'Submitted',	'Submit',	1,	'2',	1,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(3,	'Approved By Head of Department',	'Approve',	1,	'3',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(4,	'Declined Approved By Head of Department',	'Decline',	1,	'3',	-1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(5,	'Approved By Finance Director',	'Approve',	1,	'4',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(6,	'Declined By Finance Director',	'Decline',	1,	'4',	-1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(7,	'Paid By Accountant',	'Pay',	1,	'5',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(8,	'Reinstate to Head of Department',	'Reinstate',	1,	'3',	0,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(9,	'Reinstate to Finance Director',	'Reinstate',	1,	'4',	0,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(10,	'Submitted',	'',	2,	'1',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(11,	'Approved By Finance Director',	'Approve',	2,	'2',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(12,	'Declined By Finance Director',	'Decline',	2,	'2',	-1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(13,	'Reinstated to Finance Director',	'Reinstate',	2,	'2',	0,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(14,	'New',	'',	3,	'1',	1,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(15,	'Submitted',	'Submit',	3,	'2',	1,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(16,	'Approved By Head of Department',	'Approve',	3,	'3',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(17,	'Declined Approved By Head of Department',	'Decline',	3,	'3',	-1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(18,	'Approved By Finance Director',	'Approve',	3,	'4',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(19,	'Declined By Finance Director',	'Decline',	3,	'4',	-1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(20,	'Paid By Accountant',	'Pay',	3,	'5',	1,	1,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(21,	'Reinstate to Head of Department',	'Reinstate',	3,	'3',	0,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(22,	'Reinstate to Finance Director',	'Reinstate',	3,	'4',	0,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(23,	'New',	'',	4,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-10-24 17:48:29',	0),
(30,	'New',	'',	5,	'1',	1,	0,	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0),
(33,	'New',	'',	8,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-10-22 10:54:56',	1),
(34,	'New',	'',	9,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-10-22 12:07:47',	1),
(38,	'New',	'',	13,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-10-22 12:32:49',	1),
(39,	'New',	'',	14,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-10-22 12:40:39',	1),
(43,	'New',	'',	18,	'1',	1,	0,	1,	'2019-10-25',	1,	'2019-10-24 22:22:18',	1),
(44,	'New',	'',	19,	'1',	1,	0,	1,	'2019-11-03',	1,	'2019-11-03 10:36:29',	1),
(45,	'New',	'',	20,	'1',	1,	0,	1,	'2019-11-03',	1,	'2019-11-03 11:14:26',	1);

DROP TABLE IF EXISTS `status_role`;
CREATE TABLE `status_role` (
  `status_role_id` int(100) NOT NULL AUTO_INCREMENT,
  `status_role_track_number` varchar(100) NOT NULL,
  `status_role_name` varchar(50) NOT NULL,
  `fk_role_id` int(100) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  `status_role_created_by` int(100) NOT NULL,
  `status_role_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_role_last_modified_by` int(100) NOT NULL,
  `status_role_last_modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`status_role_id`),
  KEY `fk_role_id` (`fk_role_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `status_role_ibfk_1` FOREIGN KEY (`fk_role_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `status_role_ibfk_2` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`),
  CONSTRAINT `status_role_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status_role` (`status_role_id`, `status_role_track_number`, `status_role_name`, `fk_role_id`, `fk_status_id`, `status_role_created_by`, `status_role_created_date`, `status_role_last_modified_by`, `status_role_last_modified_date`) VALUES
(1,	'STR-80238',	'',	2,	1,	0,	'2019-10-16 22:39:16',	0,	'2019-10-16 22:39:16'),
(2,	'STR-80238',	'',	3,	1,	0,	'2019-10-16 22:39:16',	0,	'2019-10-16 22:39:16'),
(3,	'STR-67383',	'',	2,	2,	0,	'2019-10-16 22:40:43',	0,	'2019-10-16 22:39:16'),
(4,	'STR-46839',	'',	3,	2,	0,	'2019-10-16 22:40:46',	0,	'2019-10-16 22:39:16'),
(6,	'STR-55865',	'',	1,	3,	0,	'2019-10-16 22:44:55',	0,	'2019-10-16 22:39:16'),
(7,	'STR-55865',	'',	1,	4,	0,	'2019-10-16 22:45:28',	0,	'2019-10-16 22:39:16'),
(8,	'STR-55865',	'',	4,	5,	0,	'2019-10-16 22:43:27',	0,	'2019-10-16 22:39:16'),
(9,	'STR-55865',	'',	4,	6,	0,	'2019-10-16 22:43:27',	0,	'2019-10-16 22:39:16'),
(10,	'STR-55865',	'',	7,	5,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(11,	'STR-55865',	'',	7,	6,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(13,	'STR-55865',	'',	5,	7,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(14,	'STR-55865',	'',	6,	7,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(15,	'STR-55865',	'',	2,	8,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(16,	'STR-55865',	'',	2,	9,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(17,	'STR-55865',	'',	3,	8,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16'),
(18,	'STR-55865',	'',	3,	9,	0,	'2019-10-16 22:47:41',	0,	'2019-10-16 22:39:16');

DROP TABLE IF EXISTS `transaction_effect`;
CREATE TABLE `transaction_effect` (
  `transaction_effect_id` int(100) NOT NULL AUTO_INCREMENT,
  `transaction_effect_name` varchar(100) DEFAULT NULL,
  `transaction_effect_created_date` date DEFAULT NULL,
  `transaction_effect_last_modified_date` date DEFAULT NULL,
  `transaction_effect_deleted_date` date DEFAULT NULL,
  `transaction_effect_created_by` int(100) DEFAULT NULL,
  `transaction_effect_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`transaction_effect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transaction_effect` (`transaction_effect_id`, `transaction_effect_name`, `transaction_effect_created_date`, `transaction_effect_last_modified_date`, `transaction_effect_deleted_date`, `transaction_effect_created_by`, `transaction_effect_last_modified_by`) VALUES
(1,	'payment',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'revenue',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `translation`;
CREATE TABLE `translation` (
  `translation_id` int(100) NOT NULL AUTO_INCREMENT,
  `language_phrase_id` int(100) DEFAULT NULL,
  `language_id` int(100) DEFAULT NULL,
  `translate` longtext,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`translation_id`),
  KEY `fk_translation_language1_idx` (`language_id`),
  KEY `fk_translation_language_phrase1_idx` (`language_phrase_id`),
  CONSTRAINT `fk_translation_language1` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_translation_language_phrase1` FOREIGN KEY (`language_phrase_id`) REFERENCES `language_phrase` (`language_phrase_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `center_group_link_id` int(100) DEFAULT NULL,
  `is_center_group_manager` int(5) DEFAULT NULL,
  `language_id` int(100) DEFAULT NULL COMMENT 'User''s default language',
  `is_active` int(5) DEFAULT '1',
  `role_id` int(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_center_group_link1_idx` (`center_group_link_id`),
  KEY `fk_user_language1_idx` (`language_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `fk_user_center_group_link1` FOREIGN KEY (`center_group_link_id`) REFERENCES `center_group_link` (`center_group_link_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_language1` FOREIGN KEY (`language_id`) REFERENCES `language` (`language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `center_group_link_id`, `is_center_group_manager`, `language_id`, `is_active`, `role_id`, `password`) VALUES
(1,	'Nicodemus',	'Karisa',	'nkmwambs@gmail.com',	NULL,	NULL,	NULL,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e'),
(2,	'Nicodemus 2',	'Karisa 2',	'nkmwambs2@gmail.com',	NULL,	NULL,	NULL,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e'),
(3,	'Nicodemus 3',	'Karisa 3',	'nkmwambs3@gmail.com',	NULL,	NULL,	NULL,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e'),
(4,	'Nicodemus 4',	'Karisa 4',	'nkmwambs4@gmail.com',	NULL,	NULL,	NULL,	1,	4,	'fbdf9989ea636d6b339fd6b85f63e06e'),
(5,	'Nicodemus 5',	'Karisa 5',	'nkmwambs5@gmail.com',	NULL,	NULL,	NULL,	1,	5,	'fbdf9989ea636d6b339fd6b85f63e06e'),
(6,	'Nicodemus 5',	'Karisa 5',	'nkmwambs5@gmail.com',	NULL,	NULL,	NULL,	1,	6,	'fbdf9989ea636d6b339fd6b85f63e06e'),
(7,	'Nicodemus 7',	'Karisa 7',	'nkmwambs7@gmail.com',	NULL,	NULL,	NULL,	1,	7,	'fbdf9989ea636d6b339fd6b85f63e06e');

DROP TABLE IF EXISTS `user_access_level`;
CREATE TABLE `user_access_level` (
  `user_access_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `controller_method` varchar(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_access_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_access_level` (`user_access_level_id`, `controller_method`, `created_date`, `created_by`, `deleted_at`, `last_modified_date`, `last_modified_by`) VALUES
(1,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(133,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(134,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(135,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(136,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(137,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(138,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(139,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(140,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(141,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(142,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(143,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(144,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(145,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(146,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(147,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(148,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(149,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(150,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(151,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(152,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(153,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(154,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(155,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(156,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(157,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(158,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(159,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(160,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(161,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(162,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(163,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(164,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(165,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(166,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(167,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(168,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(169,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(170,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(171,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(172,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(173,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(174,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(175,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(176,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(177,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(178,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(179,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(180,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(181,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(182,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(183,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(184,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(185,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(186,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(187,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(188,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(189,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(190,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(191,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(192,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(193,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(194,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(195,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(196,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(197,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(198,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(199,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(200,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(201,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(202,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(203,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(204,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(205,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(206,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(207,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(208,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(209,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(210,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(211,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(212,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(213,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(214,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(215,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(216,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(217,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(218,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(219,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(220,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(221,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(222,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(223,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(224,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(225,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(226,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(227,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(228,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(229,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(230,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(231,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(232,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(233,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(234,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(235,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(236,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(237,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(238,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(239,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(240,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(241,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(242,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(243,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(244,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(245,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(246,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(247,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(248,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(249,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(250,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(251,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(252,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(253,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(254,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(255,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(256,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(257,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(258,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(259,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(260,	'my_controller::list',	NULL,	NULL,	NULL,	NULL,	NULL),
(261,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL),
(262,	'dashboard::index',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `user_priviledge`;
CREATE TABLE `user_priviledge` (
  `user_priviledge_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_access_level_id` int(100) DEFAULT NULL,
  `user_id` int(100) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_priviledge_id`),
  KEY `fk_user_priviledge_user_access_level1_idx` (`user_access_level_id`),
  CONSTRAINT `fk_user_priviledge_user_access_level1` FOREIGN KEY (`user_access_level_id`) REFERENCES `user_access_level` (`user_access_level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_priviledge` (`user_priviledge_id`, `user_access_level_id`, `user_id`, `created_date`, `created_by`, `deleted_at`, `last_modified_date`, `last_modified_by`) VALUES
(1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `variance_note`;
CREATE TABLE `variance_note` (
  `variance_note_id` int(100) NOT NULL AUTO_INCREMENT,
  `reconciliation_id` int(100) DEFAULT NULL,
  `expense_account_id` int(100) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `created_date` varchar(45) DEFAULT NULL,
  `last_modified_date` varchar(45) DEFAULT NULL,
  `last_modified_by` varchar(45) DEFAULT NULL,
  `variance_note_detail` longtext,
  PRIMARY KEY (`variance_note_id`),
  KEY `fk_variance_comment_reconciliation1_idx` (`reconciliation_id`),
  KEY `fk_variance_comment_expense_account1_idx` (`expense_account_id`),
  CONSTRAINT `fk_variance_comment_expense_account1` FOREIGN KEY (`expense_account_id`) REFERENCES `expense_account` (`expense_account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_variance_comment_reconciliation1` FOREIGN KEY (`reconciliation_id`) REFERENCES `reconciliation` (`reconciliation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `voucher`;
CREATE TABLE `voucher` (
  `voucher_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_track_number` varchar(50) DEFAULT NULL,
  `voucher_name` varchar(100) DEFAULT NULL,
  `voucher_number` int(10) DEFAULT NULL,
  `fk_center_id` int(100) DEFAULT NULL,
  `voucher_date` date DEFAULT NULL,
  `fk_voucher_type_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `voucher_cheque_number` int(100) DEFAULT NULL,
  `voucher_transaction_cleared_date` date DEFAULT '0000-00-00',
  `voucher_transaction_cleared_month` date DEFAULT '0000-00-00',
  `voucher_vendor` varchar(100) DEFAULT NULL,
  `voucher_description` varchar(200) DEFAULT NULL,
  `voucher_allow_edit` int(5) DEFAULT '0',
  `voucher_created_by` int(100) DEFAULT NULL,
  `voucher_created_date` date DEFAULT NULL,
  `voucher_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_id`),
  KEY `fk_voucher_center1_idx` (`fk_center_id`),
  KEY `fk_voucher_voucher_type1_idx` (`fk_voucher_type_id`),
  CONSTRAINT `fk_voucher_center1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_voucher_voucher_type1` FOREIGN KEY (`fk_voucher_type_id`) REFERENCES `voucher_type` (`voucher_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This holds transactions ';

INSERT INTO `voucher` (`voucher_id`, `voucher_track_number`, `voucher_name`, `voucher_number`, `fk_center_id`, `voucher_date`, `fk_voucher_type_id`, `fk_approval_id`, `fk_status_id`, `voucher_cheque_number`, `voucher_transaction_cleared_date`, `voucher_transaction_cleared_month`, `voucher_vendor`, `voucher_description`, `voucher_allow_edit`, `voucher_created_by`, `voucher_created_date`, `voucher_last_modified_date`, `voucher_last_modified_by`) VALUES
(10,	'VCH-34315',	'Voucher # VCH-34315',	190901,	1,	'2019-11-03',	2,	0,	10,	0,	'0000-00-00',	'0000-00-00',	'Test',	'test',	0,	1,	'2019-11-03',	'2019-11-03 20:19:38',	1),
(11,	'VCH-4745',	'Voucher # VCH-4745',	190902,	1,	'2019-11-03',	2,	102,	10,	0,	'0000-00-00',	'0000-00-00',	'Test2',	'Test2',	0,	1,	'2019-11-03',	'2019-11-03 20:28:54',	1);

DROP TABLE IF EXISTS `voucher_detail`;
CREATE TABLE `voucher_detail` (
  `voucher_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_detail_track_number` varchar(100) DEFAULT NULL,
  `fk_voucher_id` int(100) DEFAULT NULL,
  `voucher_detail_description` varchar(45) DEFAULT NULL,
  `voucher_detail_quantity` int(10) DEFAULT NULL,
  `voucher_detail_unit_cost` decimal(10,2) DEFAULT NULL,
  `voucher_detail_total_cost` decimal(10,2) DEFAULT NULL,
  `fk_expense_account_id` int(100) DEFAULT NULL COMMENT 'Can be income_account_id or expense_account_id depending on the selected voucher type',
  `fk_income_account_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_project_allocation_id` int(100) DEFAULT NULL,
  `voucher_detail_last_modified_date` date DEFAULT NULL,
  `voucher_detail_last_modified_by` varchar(45) DEFAULT NULL,
  `voucher_detail_created_by` int(100) DEFAULT NULL,
  `voucher_detail_created_date` date DEFAULT NULL,
  PRIMARY KEY (`voucher_detail_id`),
  KEY `fk_voucher_detail_voucher1_idx` (`fk_voucher_id`),
  KEY `fk_voucher_detail_request_detail1_idx` (`fk_approval_id`),
  CONSTRAINT `voucher_detail_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `request_detail` (`request_detail_id`),
  CONSTRAINT `voucher_detail_ibfk_3` FOREIGN KEY (`fk_voucher_id`) REFERENCES `voucher` (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher_detail` (`voucher_detail_id`, `voucher_detail_track_number`, `fk_voucher_id`, `voucher_detail_description`, `voucher_detail_quantity`, `voucher_detail_unit_cost`, `voucher_detail_total_cost`, `fk_expense_account_id`, `fk_income_account_id`, `fk_approval_id`, `fk_status_id`, `fk_project_allocation_id`, `voucher_detail_last_modified_date`, `voucher_detail_last_modified_by`, `voucher_detail_created_by`, `voucher_detail_created_date`) VALUES
(8,	'VCD-65221',	10,	'test',	100,	150.00,	15000.00,	1,	NULL,	NULL,	39,	1,	NULL,	'1',	1,	'2019-11-03'),
(9,	'VCD-61861',	11,	'Test',	45,	560.00,	25200.00,	1,	NULL,	NULL,	39,	1,	NULL,	'1',	1,	'2019-11-03');

DROP TABLE IF EXISTS `voucher_type`;
CREATE TABLE `voucher_type` (
  `voucher_type_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_type_name` varchar(45) DEFAULT NULL,
  `voucher_type_is_active` int(5) DEFAULT NULL,
  `voucher_type_cash_account` varchar(20) DEFAULT NULL COMMENT 'Can either be bank or cash',
  `voucher_type_transaction_effect` varchar(20) DEFAULT NULL COMMENT 'Can be payment or revenue',
  `voucher_type_created_by` int(100) DEFAULT NULL,
  `voucher_type_created_date` date DEFAULT NULL,
  `voucher_type_last_modified_by` int(100) DEFAULT NULL,
  `voucher_type_last_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`voucher_type_id`),
  KEY `fk_voucher_type_voucher_type_transaction_effect1_idx` (`voucher_type_transaction_effect`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher_type` (`voucher_type_id`, `voucher_type_name`, `voucher_type_is_active`, `voucher_type_cash_account`, `voucher_type_transaction_effect`, `voucher_type_created_by`, `voucher_type_created_date`, `voucher_type_last_modified_by`, `voucher_type_last_modified_date`) VALUES
(2,	'Payment by Cash',	1,	'cash',	'expense',	NULL,	NULL,	NULL,	NULL),
(3,	'Bank payment',	1,	'bank',	'expense',	NULL,	NULL,	NULL,	NULL),
(4,	'Petty Cash Top Up',	1,	'to_cash',	'contra',	NULL,	NULL,	NULL,	NULL),
(5,	'Bank Cash Received',	1,	'bank',	'income',	NULL,	NULL,	NULL,	NULL),
(6,	'Bank Charges',	1,	'bank',	'expense',	NULL,	NULL,	NULL,	NULL),
(7,	'Bank Interest Receiveable',	1,	'bank',	'income',	NULL,	NULL,	NULL,	NULL),
(8,	'Petty Cash Income',	1,	'income',	'contra',	NULL,	NULL,	NULL,	NULL),
(9,	'Petty Cash Rebanking',	1,	'to_bank',	'contra',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `workplan`;
CREATE TABLE `workplan` (
  `workplan_id` int(11) NOT NULL,
  `workplan_track_number` varchar(100) DEFAULT NULL,
  `fk_budget_id` int(100) DEFAULT NULL,
  `workplan_created_date` date DEFAULT NULL,
  `workplan_created_by` int(100) DEFAULT NULL,
  `workplan_last_modified_date` date DEFAULT NULL,
  `workplan_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`workplan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-11-04 12:17:54
1
Downloading1
-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `account_system`;
CREATE TABLE `account_system` (
  `account_system_id` int(100) NOT NULL AUTO_INCREMENT,
  `account_system_track_number` varchar(100) NOT NULL,
  `account_system_name` varchar(100) NOT NULL,
  `account_system_created_date` date DEFAULT NULL,
  `account_system_created_by` int(100) DEFAULT NULL,
  `account_system_last_modified_by` int(100) DEFAULT NULL,
  `account_system_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `account_system` (`account_system_id`, `account_system_track_number`, `account_system_name`, `account_system_created_date`, `account_system_created_by`, `account_system_last_modified_by`, `account_system_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'ACEM-84359',	'Global',	'2020-02-29',	1,	1,	NULL,	564,	0);

DROP TABLE IF EXISTS `approval`;
CREATE TABLE `approval` (
  `approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval_track_number` varchar(100) NOT NULL,
  `approval_name` varchar(100) NOT NULL,
  `fk_approve_item_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL DEFAULT '87',
  `approval_created_by` int(100) NOT NULL,
  `approval_created_date` date NOT NULL,
  `approval_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approval_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`approval_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `approval_ibfk_2` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `approval_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approval` (`approval_id`, `approval_track_number`, `approval_name`, `fk_approve_item_id`, `fk_status_id`, `approval_created_by`, `approval_created_date`, `approval_last_modified_date`, `approval_last_modified_by`) VALUES
(433,	'APAL-30761',	'Approval Ticket # APAL-30761',	20,	87,	1,	'2019-12-03',	'2019-12-03 13:41:48',	1),
(442,	'APAL-45850',	'Approval Ticket # APAL-45850',	20,	87,	1,	'2019-12-08',	'2019-12-08 12:46:56',	1),
(446,	'APAL-82249',	'Approval Ticket # APAL-82249',	42,	87,	1,	'2019-12-13',	'2019-12-13 04:05:02',	1),
(448,	'APAL-67896',	'Approval Ticket # APAL-67896',	20,	87,	1,	'2019-12-13',	'2019-12-13 04:09:20',	1),
(449,	'APAL-3390',	'Approval Ticket # APAL-3390',	43,	87,	1,	'2019-12-13',	'2019-12-13 04:10:04',	1),
(450,	'APAL-78692',	'Approval Ticket # APAL-78692',	44,	87,	1,	'2019-12-13',	'2019-12-13 04:11:04',	1),
(455,	'APAL-73086',	'Approval Ticket # APAL-73086',	51,	87,	1,	'2019-12-13',	'2019-12-13 16:14:20',	1),
(456,	'APAL-46322',	'Approval Ticket # APAL-46322',	52,	87,	1,	'2019-12-13',	'2019-12-13 16:15:08',	1);

DROP TABLE IF EXISTS `approve_item`;
CREATE TABLE `approve_item` (
  `approve_item_id` int(100) NOT NULL AUTO_INCREMENT,
  `approve_item_track_number` varchar(100) NOT NULL,
  `approve_item_name` varchar(100) NOT NULL,
  `approve_item_is_active` int(5) NOT NULL,
  `approve_item_created_date` date NOT NULL,
  `approve_item_created_by` int(100) NOT NULL,
  `approve_item_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approve_item_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approve_item` (`approve_item_id`, `approve_item_track_number`, `approve_item_name`, `approve_item_is_active`, `approve_item_created_date`, `approve_item_created_by`, `approve_item_last_modified_date`, `approve_item_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(20,	'APEM-45333',	'office',	1,	'2019-11-03',	1,	'2019-12-08 07:57:15',	1,	NULL,	NULL),
(41,	'',	'context_cluster',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(42,	'',	'context_global',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(43,	'',	'context_region',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(44,	'',	'context_country',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(45,	'',	'context_cohort',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(50,	'',	'context_cluster_user',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(51,	'',	'designation',	0,	'2019-11-21',	1,	'2019-11-21 16:37:42',	1,	NULL,	NULL),
(52,	'',	'context_country_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(53,	'',	'context_cohort_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(54,	'',	'context_global_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(55,	'',	'context_region_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(62,	'APEM-78654',	'approval',	0,	'2019-11-23',	1,	'2020-03-07 04:19:43',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `bank_track_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_swift_code` varchar(45) DEFAULT NULL,
  `bank_is_active` int(5) NOT NULL DEFAULT '1',
  `bank_created_date` date DEFAULT NULL,
  `bank_created_by` int(100) DEFAULT NULL,
  `bank_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bank_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `bank_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `bank_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the banks for centers';


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
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`bank_branch_id`),
  KEY `fk_bank_branch_bank1_idx` (`fk_bank_id`),
  CONSTRAINT `fk_bank_branch_bank1` FOREIGN KEY (`fk_bank_id`) REFERENCES `bank` (`bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table holds branches for banks';


DROP TABLE IF EXISTS `bank_contra_account`;
CREATE TABLE `bank_contra_account` (
  `bank_contra_account_id` int(100) NOT NULL AUTO_INCREMENT,
  `bank_contra_account_track_number` varchar(100) NOT NULL,
  `bank_contra_account_name` varchar(100) NOT NULL,
  `bank_contra_account_code` varchar(50) NOT NULL,
  `bank_contra_account_created_date` date DEFAULT NULL,
  `bank_contra_account_created_by` int(100) DEFAULT NULL,
  `bank_contra_account_last_modified_by` int(100) DEFAULT NULL,
  `bank_contra_account_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`bank_contra_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `bank_contra_account` (`bank_contra_account_id`, `bank_contra_account_track_number`, `bank_contra_account_name`, `bank_contra_account_code`, `bank_contra_account_created_date`, `bank_contra_account_created_by`, `bank_contra_account_last_modified_by`, `bank_contra_account_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'CONT-20988',	'Petty Cash Imprest',	'C001',	'2020-01-16',	1,	1,	NULL,	533,	0);

DROP TABLE IF EXISTS `budget`;
CREATE TABLE `budget` (
  `budget_id` int(100) NOT NULL AUTO_INCREMENT,
  `budget_track_number` varchar(45) DEFAULT NULL,
  `budget_name` varchar(100) DEFAULT NULL,
  `fk_office_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT '0',
  `fk_status_id` int(11) DEFAULT '0',
  `budget_year` int(5) DEFAULT NULL,
  `budget_created_by` int(100) DEFAULT NULL,
  `budget_created_date` date DEFAULT NULL,
  `budget_last_modified_by` int(100) DEFAULT NULL,
  `budget_last_modified_date` date DEFAULT NULL,
  PRIMARY KEY (`budget_id`),
  KEY `fk_budget_center1_idx` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `budget_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `budget_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_budget_center1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table holds the budget items by activity';


DROP TABLE IF EXISTS `budget_item`;
CREATE TABLE `budget_item` (
  `budget_item_id` int(100) NOT NULL AUTO_INCREMENT,
  `budget_item_track_number` varchar(100) DEFAULT NULL,
  `budget_item_name` varchar(100) DEFAULT NULL,
  `fk_budget_id` int(100) DEFAULT NULL,
  `budget_item_total_cost` int(50) DEFAULT NULL,
  `fk_expense_account_id` int(100) DEFAULT NULL,
  `budget_item_description` longtext,
  `fk_status_id` int(11) DEFAULT '0',
  `fk_approval_id` int(11) DEFAULT '0',
  `fk_project_allocation_id` int(100) DEFAULT NULL,
  `budget_item_created_by` int(100) DEFAULT NULL,
  `budget_item_last_modified_by` int(11) DEFAULT NULL,
  `budget_item_created_date` date DEFAULT NULL,
  `budget_item_last_modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `budget_item_detail_last_modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`budget_item_detail_id`),
  KEY `fk_budget_month_spread_budget_detail1_idx` (`fk_budget_item_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `budget_item_detail_ibfk_1` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_budget_month_spread_budget_detail1` FOREIGN KEY (`fk_budget_item_id`) REFERENCES `budget_item` (`budget_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table distributes budget allocations by month';


DROP TABLE IF EXISTS `cash_contra_account`;
CREATE TABLE `cash_contra_account` (
  `cash_contra_account_id` int(100) NOT NULL AUTO_INCREMENT,
  `cash_contra_account_track_number` varchar(100) NOT NULL,
  `cash_contra_account_name` varchar(100) NOT NULL,
  `cash_contra_account_code` varchar(50) NOT NULL,
  `cash_contra_account_created_date` date DEFAULT NULL,
  `cash_contra_account_created_by` int(100) DEFAULT NULL,
  `cash_contra_account_last_modified_by` int(100) DEFAULT NULL,
  `cash_contra_account_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`cash_contra_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cash_contra_account` (`cash_contra_account_id`, `cash_contra_account_track_number`, `cash_contra_account_name`, `cash_contra_account_code`, `cash_contra_account_created_date`, `cash_contra_account_created_by`, `cash_contra_account_last_modified_by`, `cash_contra_account_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'CANT-70987',	'Petty Cash Rebanking',	'C002',	'2020-01-16',	1,	1,	NULL,	547,	0);

DROP TABLE IF EXISTS `cheque_book`;
CREATE TABLE `cheque_book` (
  `cheque_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `cheque_book_track_number` varchar(100) NOT NULL,
  `cheque_book_name` varchar(100) NOT NULL,
  `fk_office_bank_id` int(100) DEFAULT NULL,
  `cheque_book_is_active` int(5) DEFAULT '1',
  `cheque_book_start_serial_number` varchar(45) DEFAULT NULL,
  `cheque_book_count_of_leaves` varchar(45) DEFAULT NULL,
  `cheque_book_use_start_date` date DEFAULT NULL,
  `cheque_book_created_date` date DEFAULT NULL,
  `cheque_book_created_by` int(100) DEFAULT NULL,
  `cheque_book_last_modified_by` int(100) DEFAULT NULL,
  `cheque_book_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`cheque_book_id`),
  KEY `fk_office_bank_id` (`fk_office_bank_id`),
  CONSTRAINT `cheque_book_ibfk_1` FOREIGN KEY (`fk_office_bank_id`) REFERENCES `office_bank` (`office_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `context_center`;
CREATE TABLE `context_center` (
  `context_center_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_center_track_number` varchar(100) NOT NULL,
  `context_center_name` varchar(100) NOT NULL,
  `context_center_description` varchar(100) NOT NULL,
  `fk_context_cluster_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `context_center_created_date` date DEFAULT NULL,
  `context_center_created_by` int(100) DEFAULT NULL,
  `context_center_last_modified_by` int(100) DEFAULT NULL,
  `context_center_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_center_id`),
  UNIQUE KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_context_cluster_id` (`fk_context_cluster_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_center_ibfk_1` FOREIGN KEY (`fk_context_cluster_id`) REFERENCES `context_cluster` (`context_cluster_id`),
  CONSTRAINT `context_center_ibfk_2` FOREIGN KEY (`fk_context_cluster_id`) REFERENCES `context_cluster` (`context_cluster_id`),
  CONSTRAINT `context_center_ibfk_3` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_center_ibfk_4` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_center_user`;
CREATE TABLE `context_center_user` (
  `context_center_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_center_user_track_number` varchar(100) NOT NULL,
  `context_center_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_context_center_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_center_user_is_active` int(5) NOT NULL DEFAULT '1',
  `context_center_user_created_date` date NOT NULL,
  `context_center_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_center_user_created_by` int(100) NOT NULL,
  `context_center_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_center_user_id`),
  KEY `fk_context_center_id` (`fk_context_center_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `context_center_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_center_user_ibfk_2` FOREIGN KEY (`fk_context_center_id`) REFERENCES `context_center` (`context_center_id`),
  CONSTRAINT `context_center_user_ibfk_3` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_cluster`;
CREATE TABLE `context_cluster` (
  `context_cluster_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cluster_track_number` varchar(100) NOT NULL,
  `context_cluster_name` varchar(100) NOT NULL,
  `context_cluster_description` longtext NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `fk_context_cohort_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `context_cluster_created_date` date NOT NULL,
  `context_cluster_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_cluster_created_by` int(100) NOT NULL,
  `context_cluster_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_cluster_id`),
  UNIQUE KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_context_cohort_id` (`fk_context_cohort_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_cluster_ibfk_1` FOREIGN KEY (`fk_context_cohort_id`) REFERENCES `context_cohort` (`context_cohort_id`),
  CONSTRAINT `context_cluster_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_cluster_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_cluster_ibfk_6` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_cluster_ibfk_7` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`),
  CONSTRAINT `context_cluster_ibfk_8` FOREIGN KEY (`fk_context_cohort_id`) REFERENCES `context_cohort` (`context_cohort_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_cluster_user`;
CREATE TABLE `context_cluster_user` (
  `context_cluster_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cluster_user_track_number` varchar(100) NOT NULL,
  `context_cluster_user_name` varchar(100) NOT NULL,
  `fk_context_cluster_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_cluster_user_is_active` int(5) NOT NULL DEFAULT '1',
  `context_cluster_user_created_date` date NOT NULL,
  `context_cluster_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_cluster_user_created_by` int(100) NOT NULL,
  `context_cluster_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_cluster_user_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_context_cluster_id` (`fk_context_cluster_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_cohort`;
CREATE TABLE `context_cohort` (
  `context_cohort_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cohort_track_number` varchar(100) NOT NULL,
  `context_cohort_name` varchar(100) NOT NULL,
  `context_cohort_description` longtext NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `fk_context_country_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `context_cohort_created_date` date NOT NULL,
  `context_cohort_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_cohort_created_by` int(100) NOT NULL,
  `context_cohort_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_cohort_id`),
  UNIQUE KEY `fk_coffice_id` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_context_country_id` (`fk_context_country_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_cohort_ibfk_1` FOREIGN KEY (`fk_context_country_id`) REFERENCES `context_country` (`context_country_id`),
  CONSTRAINT `context_cohort_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_cohort_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_cohort_ibfk_4` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_cohort_ibfk_5` FOREIGN KEY (`fk_context_country_id`) REFERENCES `context_country` (`context_country_id`),
  CONSTRAINT `context_cohort_ibfk_6` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_cohort_user`;
CREATE TABLE `context_cohort_user` (
  `context_cohort_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cohort_user_track_number` varchar(100) NOT NULL,
  `context_cohort_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_context_cohort_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_cohort_user_is_active` int(5) NOT NULL DEFAULT '1',
  `context_cohort_user_created_date` date NOT NULL,
  `context_cohort_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_cohort_user_created_by` int(100) NOT NULL,
  `context_cohort_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_cohort_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_cohort_id` (`fk_context_cohort_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `context_cohort_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_cohort_user_ibfk_2` FOREIGN KEY (`fk_context_cohort_id`) REFERENCES `context_cohort` (`context_cohort_id`),
  CONSTRAINT `context_cohort_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_cohort_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_cohort_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_country`;
CREATE TABLE `context_country` (
  `context_country_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_country_track_number` varchar(100) NOT NULL,
  `context_country_name` varchar(100) NOT NULL,
  `context_country_description` longtext NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `fk_context_region_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `context_country_created_date` date NOT NULL,
  `context_country_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_country_created_by` int(100) NOT NULL,
  `context_country_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_country_id`),
  UNIQUE KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_context_region_id` (`fk_context_region_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_country_ibfk_1` FOREIGN KEY (`fk_context_region_id`) REFERENCES `context_region` (`context_region_id`),
  CONSTRAINT `context_country_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_country_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_country_ibfk_4` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_country_ibfk_5` FOREIGN KEY (`fk_context_region_id`) REFERENCES `context_region` (`context_region_id`),
  CONSTRAINT `context_country_ibfk_6` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_country` (`context_country_id`, `context_country_track_number`, `context_country_name`, `context_country_description`, `fk_office_id`, `fk_context_region_id`, `fk_context_definition_id`, `context_country_created_date`, `context_country_last_modified_date`, `context_country_created_by`, `context_country_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'CORY-56399',	'Kenya Country Office',	'This is Kenya Country Office',	18,	2,	10,	'2019-12-13',	'2019-12-13 04:11:04',	1,	1,	450,	69);

DROP TABLE IF EXISTS `context_country_user`;
CREATE TABLE `context_country_user` (
  `context_country_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_country_user_track_number` varchar(100) NOT NULL,
  `context_country_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_context_country_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_country_user_is_active` int(5) NOT NULL DEFAULT '1',
  `context_country_user_created_date` date NOT NULL,
  `context_country_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_country_user_created_by` int(100) NOT NULL,
  `context_country_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_country_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_country_id` (`fk_context_country_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `context_country_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_country_user_ibfk_2` FOREIGN KEY (`fk_context_country_id`) REFERENCES `context_country` (`context_country_id`),
  CONSTRAINT `context_country_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_country_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_country_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `context_definition`;
CREATE TABLE `context_definition` (
  `context_definition_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_definition_track_number` varchar(100) DEFAULT NULL,
  `context_definition_name` varchar(100) DEFAULT NULL,
  `context_definition_level` int(5) DEFAULT NULL,
  `context_definition_is_active` int(5) NOT NULL DEFAULT '1',
  `context_definition_created_date` date DEFAULT NULL,
  `context_definition_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `context_definition_created_by` int(100) DEFAULT NULL,
  `context_definition_last_modified_by` int(100) DEFAULT NULL,
  `context_definition_deleted_at` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_definition_id`),
  UNIQUE KEY `center_group_hierarchy_level` (`context_definition_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_definition` (`context_definition_id`, `context_definition_track_number`, `context_definition_name`, `context_definition_level`, `context_definition_is_active`, `context_definition_created_date`, `context_definition_last_modified_date`, `context_definition_created_by`, `context_definition_last_modified_by`, `context_definition_deleted_at`, `fk_approval_id`, `fk_status_id`) VALUES
(8,	'CEHY-27364',	'cluster',	2,	1,	'2019-11-21',	'2019-11-21 06:49:58',	1,	1,	NULL,	256,	59),
(9,	'CEHY-40087',	'cohort',	3,	1,	'2019-11-21',	'2019-11-21 06:50:26',	1,	1,	NULL,	257,	59),
(10,	'CEHY-76588',	'country',	4,	1,	'2019-11-21',	'2019-11-21 06:50:34',	1,	1,	NULL,	258,	59),
(11,	'CEHY-37430',	'region',	5,	1,	'2019-11-21',	'2019-11-21 06:50:43',	1,	1,	NULL,	259,	59),
(12,	'CEHY-72349',	'global',	6,	1,	'2019-11-21',	'2019-11-21 06:50:52',	1,	1,	NULL,	260,	59),
(13,	'CEHY-56809',	'center',	1,	1,	'2019-11-21',	'2019-11-21 16:39:07',	1,	1,	NULL,	265,	59);

DROP TABLE IF EXISTS `context_global`;
CREATE TABLE `context_global` (
  `context_global_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_global_track_number` varchar(100) NOT NULL,
  `context_global_name` varchar(100) NOT NULL,
  `context_global_description` longtext NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `context_global_created_date` date NOT NULL,
  `context_global_created_by` int(100) NOT NULL,
  `context_global_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_global_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_global_id`),
  UNIQUE KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_global_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_global_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_global_ibfk_3` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_global_ibfk_4` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_global` (`context_global_id`, `context_global_track_number`, `context_global_name`, `context_global_description`, `fk_office_id`, `fk_context_definition_id`, `context_global_created_date`, `context_global_created_by`, `context_global_last_modified_date`, `context_global_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(3,	'COAL-61677',	'International Office',	'This is the international office',	21,	12,	'2019-12-13',	1,	'2019-12-13 04:05:02',	1,	446,	67);

DROP TABLE IF EXISTS `context_global_user`;
CREATE TABLE `context_global_user` (
  `context_global_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_global_user_track_number` varchar(100) NOT NULL,
  `context_global_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_context_global_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_global_user_is_active` int(5) NOT NULL DEFAULT '1',
  `context_global_user_created_date` date NOT NULL,
  `context_global_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_global_user_created_by` int(100) NOT NULL,
  `context_global_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_global_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_global_id` (`fk_context_global_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `context_global_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_global_user_ibfk_2` FOREIGN KEY (`fk_context_global_id`) REFERENCES `context_global` (`context_global_id`),
  CONSTRAINT `context_global_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_global_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_global_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_global_user` (`context_global_user_id`, `context_global_user_track_number`, `context_global_user_name`, `fk_user_id`, `fk_context_global_id`, `fk_designation_id`, `context_global_user_is_active`, `context_global_user_created_date`, `context_global_user_last_modified_date`, `context_global_user_created_by`, `context_global_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(4,	'COER-3908',	'Nicodemus Karisa - System Admin	',	1,	3,	7,	1,	'2020-03-20',	'2020-03-20 17:23:53',	1,	1,	456,	142);

DROP TABLE IF EXISTS `context_region`;
CREATE TABLE `context_region` (
  `context_region_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_region_track_number` varchar(100) NOT NULL,
  `context_region_name` varchar(100) NOT NULL,
  `context_region_description` longtext NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `fk_context_global_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `context_region_created_date` date NOT NULL,
  `context_region_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_region_created_by` int(100) NOT NULL,
  `context_region_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`context_region_id`),
  UNIQUE KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_context_global_id` (`fk_context_global_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_region_ibfk_1` FOREIGN KEY (`fk_context_global_id`) REFERENCES `context_global` (`context_global_id`),
  CONSTRAINT `context_region_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_region_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_region_ibfk_4` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_region_ibfk_5` FOREIGN KEY (`fk_context_global_id`) REFERENCES `context_global` (`context_global_id`),
  CONSTRAINT `context_region_ibfk_6` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_region` (`context_region_id`, `context_region_track_number`, `context_region_name`, `context_region_description`, `fk_office_id`, `fk_context_global_id`, `fk_context_definition_id`, `context_region_created_date`, `context_region_last_modified_date`, `context_region_created_by`, `context_region_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(2,	'COON-65080',	'Africa Region Office',	'This is Africa Region',	22,	3,	11,	'2019-12-13',	'2019-12-13 04:10:04',	1,	1,	449,	68);

DROP TABLE IF EXISTS `context_region_user`;
CREATE TABLE `context_region_user` (
  `context_region_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_region_user_track_number` varchar(100) NOT NULL,
  `context_region_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_context_region_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_region_user_is_active` int(5) NOT NULL DEFAULT '1',
  `context_region_user_created_date` date NOT NULL,
  `context_region_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_region_user_created_by` int(100) NOT NULL,
  `context_region_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_region_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_region_id` (`fk_context_region_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `context_region_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_region_user_ibfk_2` FOREIGN KEY (`fk_context_region_id`) REFERENCES `context_region` (`context_region_id`),
  CONSTRAINT `context_region_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_region_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `dashboard`;
CREATE TABLE `dashboard` (
  `dashboard_id` int(100) NOT NULL AUTO_INCREMENT,
  `dashboard_name` varchar(100) DEFAULT NULL,
  `dashboard_created_date` date DEFAULT NULL,
  `dashboard_created_by` int(100) DEFAULT NULL,
  `dashboard_last_modified_by` int(100) DEFAULT NULL,
  `dashboard_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`dashboard_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `department_id` int(100) NOT NULL AUTO_INCREMENT,
  `department_track_number` varchar(100) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `department_description` longtext NOT NULL,
  `department_is_active` int(5) NOT NULL,
  `department_created_date` date NOT NULL,
  `department_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `department_created_by` int(100) NOT NULL,
  `department_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`department_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `department_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `department_user`;
CREATE TABLE `department_user` (
  `department_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `department_user_track_number` varchar(100) NOT NULL,
  `department_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_department_id` int(100) NOT NULL,
  `department_user_created_date` date NOT NULL,
  `department_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `department_user_created_by` int(100) NOT NULL,
  `department_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`department_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_department_id` (`fk_department_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `department_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `department_user_ibfk_2` FOREIGN KEY (`fk_department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `department_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `department_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `designation`;
CREATE TABLE `designation` (
  `designation_id` int(100) NOT NULL AUTO_INCREMENT,
  `designation_track_number` varchar(100) NOT NULL,
  `designation_name` varchar(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `designation_created_date` date NOT NULL,
  `designation_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `designation_created_by` int(100) NOT NULL,
  `designation_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`designation_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_center_group_hierarchy_id` (`fk_context_definition_id`),
  CONSTRAINT `designation_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `designation_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `designation_ibfk_3` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `designation` (`designation_id`, `designation_track_number`, `designation_name`, `fk_context_definition_id`, `designation_created_date`, `designation_last_modified_date`, `designation_created_by`, `designation_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(7,	'DEON-68629',	'System Admin',	10,	'2019-12-13',	'2019-12-13 16:14:20',	1,	1,	455,	76);

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


DROP TABLE IF EXISTS `financial_report`;
CREATE TABLE `financial_report` (
  `financial_report_id` int(100) NOT NULL AUTO_INCREMENT,
  `financial_report_track_number` varchar(100) NOT NULL,
  `financial_report_name` varchar(100) NOT NULL,
  `financial_report_month` date NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `financial_report_created_date` date DEFAULT NULL,
  `financial_report_created_by` int(100) DEFAULT NULL,
  `financial_report_last_modified_by` int(100) DEFAULT NULL,
  `financial_report_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`financial_report_id`),
  KEY `fk_office_id` (`fk_office_id`),
  CONSTRAINT `financial_report_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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


DROP TABLE IF EXISTS `funding_status`;
CREATE TABLE `funding_status` (
  `funding_status_id` int(100) NOT NULL AUTO_INCREMENT,
  `funding_status_name` varchar(45) DEFAULT NULL,
  `funding_status_is_active` int(5) DEFAULT NULL,
  `funding_status_created_date` date DEFAULT NULL,
  `funding_status_created_by` int(100) DEFAULT NULL,
  `funding_status_last_modified_by` int(100) DEFAULT NULL,
  `funding_status_last_modified_date` date DEFAULT NULL,
  `funding_status_is_available` int(5) NOT NULL DEFAULT '0',
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`funding_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `funding_status` (`funding_status_id`, `funding_status_name`, `funding_status_is_active`, `funding_status_created_date`, `funding_status_created_by`, `funding_status_last_modified_by`, `funding_status_last_modified_date`, `funding_status_is_available`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'Fully Funded',	1,	NULL,	NULL,	NULL,	NULL,	1,	NULL,	NULL);

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
  `fk_account_system_id` int(100) DEFAULT NULL,
  `income_account_created_date` date DEFAULT NULL,
  `income_account_last_modified_date` date DEFAULT NULL,
  `income_account_created_by` int(100) DEFAULT NULL,
  `income_account_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`income_account_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  CONSTRAINT `income_account_ibfk_1` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains the income accounts. ';


DROP TABLE IF EXISTS `journal`;
CREATE TABLE `journal` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_track_number` varchar(100) NOT NULL,
  `journal_name` varchar(100) NOT NULL,
  `journal_month` date NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `journal_created_date` date DEFAULT NULL,
  `journal_created_by` int(100) DEFAULT NULL,
  `journal_last_modified_by` int(100) DEFAULT NULL,
  `journal_last_modified_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`journal_id`),
  KEY `fk_office_id` (`fk_office_id`),
  CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `language_id` int(100) NOT NULL AUTO_INCREMENT,
  `language_track_number` varchar(100) NOT NULL,
  `language_name` varchar(100) DEFAULT NULL,
  `language_code` varchar(10) DEFAULT NULL,
  `language_created_date` date DEFAULT NULL,
  `language_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `language_deleted_at` date DEFAULT NULL,
  `language_created_by` int(100) DEFAULT NULL,
  `language_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `language` (`language_id`, `language_track_number`, `language_name`, `language_code`, `language_created_date`, `language_last_modified_date`, `language_deleted_at`, `language_created_by`, `language_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'LAGE-97389',	'English',	'en',	NULL,	'2019-11-07 10:39:11',	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'LAGE-26371',	'Swahili',	'sw',	'2019-11-22',	'2019-11-22 21:18:48',	NULL,	1,	1,	307,	65);

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
  `menu_is_active` int(5) NOT NULL DEFAULT '1',
  `menu_created_date` date DEFAULT NULL,
  `menu_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_created_by` int(100) DEFAULT NULL,
  `menu_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_derivative_controller`, `menu_is_active`, `menu_created_date`, `menu_last_modified_date`, `menu_created_by`, `menu_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(380,	'Approval',	'Approval',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(381,	'Bank',	'Bank',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(382,	'Budget',	'Budget',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(384,	'Dashboard',	'Dashboard',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(385,	'Funder',	'Funder',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(386,	'Journal',	'Journal',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(390,	'Permission_label',	'Permission_label',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(391,	'Project_allocation',	'Project_allocation',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(392,	'Request',	'Request',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(393,	'Role',	'Role',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(397,	'Voucher',	'Voucher',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(398,	'Workplan',	'Workplan',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(400,	'User',	'User',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(470,	'Menu_user_order',	'Menu_user_order',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(478,	'Bank_branch',	'Bank_branch',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(480,	'Department',	'Department',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(481,	'Designation',	'Designation',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(482,	'Expense_account',	'Expense_account',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(483,	'Funding_status',	'Funding_status',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(490,	'Project',	'Project',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(492,	'Page_view',	'Page_view',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(496,	'Request_type',	'Request_type',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(497,	'Language',	'Language',	1,	NULL,	'2019-11-26 20:45:56',	NULL,	NULL,	NULL,	NULL),
(498,	'Setting',	'Setting',	1,	NULL,	'2019-11-26 22:05:45',	NULL,	NULL,	NULL,	NULL),
(500,	'Income_account',	'Income_account',	1,	NULL,	'2019-11-27 13:24:36',	NULL,	NULL,	NULL,	NULL),
(521,	'Office',	'Office',	1,	NULL,	'2019-12-08 12:10:43',	NULL,	NULL,	NULL,	NULL),
(522,	'Office_bank',	'Office_bank',	1,	NULL,	'2019-12-08 12:10:43',	NULL,	NULL,	NULL,	NULL),
(523,	'Context_definition',	'Context_definition',	1,	NULL,	'2019-12-08 12:20:29',	NULL,	NULL,	NULL,	NULL),
(525,	'Cheque_book',	'Cheque_book',	1,	NULL,	'2020-01-06 10:11:55',	NULL,	NULL,	NULL,	NULL),
(526,	'Financial_report',	'Financial_report',	1,	NULL,	'2020-01-08 09:43:05',	NULL,	NULL,	NULL,	NULL),
(527,	'Voucher_type_account',	'Voucher_type_account',	1,	NULL,	'2020-01-15 15:13:14',	NULL,	NULL,	NULL,	NULL),
(528,	'Voucher_type_effect',	'Voucher_type_effect',	1,	NULL,	'2020-01-15 15:13:14',	NULL,	NULL,	NULL,	NULL),
(529,	'Voucher_type',	'Voucher_type',	1,	NULL,	'2020-01-15 15:17:27',	NULL,	NULL,	NULL,	NULL),
(531,	'Bank_contra_account',	'Bank_contra_account',	1,	NULL,	'2020-01-16 20:31:19',	NULL,	NULL,	NULL,	NULL),
(532,	'Cash_contra_account',	'Cash_contra_account',	1,	NULL,	'2020-01-16 20:31:19',	NULL,	NULL,	NULL,	NULL),
(535,	'Month',	'Month',	1,	NULL,	'2020-01-18 13:08:11',	NULL,	NULL,	NULL,	NULL),
(542,	'Account_system',	'Account_system',	1,	NULL,	'2020-02-29 19:03:06',	NULL,	NULL,	NULL,	NULL),
(545,	'Request_conversion',	'Request_conversion',	1,	NULL,	'2020-03-02 06:43:20',	NULL,	NULL,	NULL,	NULL),
(547,	'Budget_item',	'Budget_item',	1,	NULL,	'2020-03-07 10:35:07',	NULL,	NULL,	NULL,	NULL),
(550,	'Approve_item',	'Approve_item',	1,	NULL,	'2020-03-08 18:11:59',	NULL,	NULL,	NULL,	NULL),
(554,	'System_opening_balance',	'System_opening_balance',	1,	NULL,	'2020-03-19 14:10:25',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `menu_user_order`;
CREATE TABLE `menu_user_order` (
  `menu_user_order_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(100) NOT NULL,
  `menu_user_order_track_number` varchar(100) NOT NULL,
  `menu_user_order_name` varchar(100) NOT NULL,
  `fk_menu_id` int(100) DEFAULT NULL,
  `menu_user_order_is_active` int(5) NOT NULL DEFAULT '1',
  `menu_user_order_level` int(100) NOT NULL DEFAULT '1',
  `menu_user_order_priority_item` int(5) NOT NULL DEFAULT '1',
  `menu_user_order_created_date` date DEFAULT NULL,
  `menu_user_order_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_user_order_created_by` int(100) DEFAULT NULL,
  `menu_user_order_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`menu_user_order_id`),
  KEY `fk_menu_id` (`fk_menu_id`),
  CONSTRAINT `menu_user_order_ibfk_1` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `message_id` int(100) NOT NULL AUTO_INCREMENT,
  `message_track_number` varchar(100) DEFAULT NULL,
  `message_name` varchar(100) DEFAULT NULL,
  `fk_approve_item_id` int(100) DEFAULT NULL,
  `message_record_key` int(100) DEFAULT NULL,
  `message_created_by` int(100) DEFAULT NULL,
  `message_last_modified_by` int(100) DEFAULT NULL,
  `message_created_date` date DEFAULT NULL,
  `message_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `message_deleted_date` date DEFAULT NULL,
  `message_is_thread_open` int(5) DEFAULT '1',
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`message_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `message_detail`;
CREATE TABLE `message_detail` (
  `message_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `message_detail_track_number` varchar(100) NOT NULL,
  `message_detail_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) DEFAULT NULL,
  `message_detail_content` longtext,
  `fk_message_id` int(100) DEFAULT NULL,
  `message_detail_created_date` datetime DEFAULT NULL,
  `message_detail_last_modified_date` date DEFAULT NULL,
  `message_detail_deleted_date` date DEFAULT NULL,
  `message_detail_created_by` int(100) DEFAULT NULL,
  `message_detail_last_modified_by` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `message_detail_is_reply` int(5) DEFAULT '0',
  `message_detail_replied_message_key` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`message_detail_id`),
  KEY `fk_message_detail_message1_idx` (`fk_message_id`),
  CONSTRAINT `fk_message_detail_message1` FOREIGN KEY (`fk_message_id`) REFERENCES `message` (`message_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `month`;
CREATE TABLE `month` (
  `month_id` int(11) NOT NULL AUTO_INCREMENT,
  `month_track_number` varchar(100) NOT NULL,
  `month_number` int(5) NOT NULL,
  `month_name` varchar(50) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `month_created_by` int(100) NOT NULL,
  `month_last_modified_by` int(100) NOT NULL,
  `month_created_date` date NOT NULL,
  `month_last_modified_date` date NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`month_id`),
  UNIQUE KEY `month_number` (`month_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `month` (`month_id`, `month_track_number`, `month_number`, `month_name`, `fk_status_id`, `month_created_by`, `month_last_modified_by`, `month_created_date`, `month_last_modified_date`, `fk_approval_id`) VALUES
(5,	'MOTH-7084',	1,	'January',	61,	1,	1,	'2020-01-18',	'0000-00-00',	551),
(6,	'MOTH-37428',	2,	'February',	61,	1,	1,	'2020-01-18',	'0000-00-00',	552),
(7,	'MOTH-39917',	3,	'March',	61,	1,	1,	'2020-01-18',	'0000-00-00',	553),
(8,	'MOTH-13132',	4,	'April',	61,	1,	1,	'2020-01-18',	'0000-00-00',	554),
(10,	'MOTH-69289',	5,	'May',	61,	1,	1,	'2020-01-18',	'0000-00-00',	556),
(11,	'MOTH-32857',	6,	'June',	61,	1,	1,	'2020-01-18',	'0000-00-00',	557),
(12,	'MOTH-74947',	7,	'July',	61,	1,	1,	'2020-01-18',	'0000-00-00',	558),
(13,	'MOTH-16217',	8,	'August',	61,	1,	1,	'2020-01-18',	'0000-00-00',	559),
(14,	'MOTH-69410',	9,	'September',	61,	1,	1,	'2020-01-18',	'0000-00-00',	560),
(15,	'MOTH-3346',	10,	'October',	61,	1,	1,	'2020-01-18',	'0000-00-00',	561),
(16,	'MOTH-5851',	11,	'November',	61,	1,	1,	'2020-01-18',	'0000-00-00',	562),
(17,	'MOTH-27020',	12,	'December',	61,	1,	1,	'2020-01-18',	'0000-00-00',	563);

DROP TABLE IF EXISTS `office`;
CREATE TABLE `office` (
  `office_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_track_number` varchar(100) DEFAULT NULL,
  `office_name` varchar(45) NOT NULL,
  `office_description` longtext NOT NULL,
  `office_code` varchar(45) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `office_start_date` date NOT NULL,
  `office_end_date` date NOT NULL,
  `office_is_active` int(5) NOT NULL DEFAULT '0',
  `fk_account_system_id` int(100) NOT NULL DEFAULT '1',
  `office_created_by` int(100) NOT NULL,
  `office_created_date` date NOT NULL,
  `office_last_modified_date` date NOT NULL,
  `office_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_center_group_hierarchy_id` (`fk_context_definition_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  CONSTRAINT `office_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `office_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `office_ibfk_3` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`),
  CONSTRAINT `office_ibfk_4` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the remote sites for the organization';

INSERT INTO `office` (`office_id`, `office_track_number`, `office_name`, `office_description`, `office_code`, `fk_context_definition_id`, `office_start_date`, `office_end_date`, `office_is_active`, `fk_account_system_id`, `office_created_by`, `office_created_date`, `office_last_modified_date`, `office_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(18,	'CEER-5952',	'Kenya Head Office',	'',	'KE',	10,	'2019-10-17',	'0000-00-00',	1,	1,	1,	'2019-12-03',	'0000-00-00',	1,	433,	45),
(21,	'OFCE-10254',	'Global Office ',	'',	'G001',	12,	'1990-10-11',	'0000-00-00',	1,	1,	1,	'2019-12-08',	'0000-00-00',	1,	442,	45),
(22,	'OFCE-18309',	'Africa Region Office',	'',	'AFR',	11,	'1979-06-06',	'0000-00-00',	1,	1,	1,	'2019-12-13',	'0000-00-00',	1,	448,	45);

DROP TABLE IF EXISTS `office_bank`;
CREATE TABLE `office_bank` (
  `office_bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_bank_track_number` varchar(100) DEFAULT NULL,
  `office_bank_name` varchar(100) DEFAULT NULL,
  `office_bank_account_number` varchar(100) DEFAULT NULL,
  `fk_office_id` int(100) DEFAULT NULL,
  `fk_bank_id` int(100) DEFAULT NULL,
  `fk_bank_branch_id` int(100) DEFAULT NULL,
  `is_office_bank_active` int(5) DEFAULT '1',
  `office_bank_created_date` date DEFAULT NULL,
  `office_bank_created_by` int(100) DEFAULT NULL,
  `office_bank_last_modified_date` timestamp NULL DEFAULT NULL,
  `office_bank_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`office_bank_id`),
  KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_bank_id` (`fk_bank_id`),
  CONSTRAINT `office_bank_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `office_bank_ibfk_2` FOREIGN KEY (`fk_bank_id`) REFERENCES `bank` (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_allocation_balance`;
CREATE TABLE `opening_allocation_balance` (
  `opening_allocation_balance_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `opening_allocation_balance_track_number` varchar(100) NOT NULL,
  `opening_allocation_balance_name` varchar(100) NOT NULL,
  `fk_project_allocation_id` int(100) NOT NULL,
  `opening_allocation_balance_amount` decimal(10,2) NOT NULL,
  `opening_allocation_balance_created_date` date DEFAULT NULL,
  `opening_allocation_balance_created_by` int(100) DEFAULT NULL,
  `opening_allocation_balance_last_modified_by` int(100) DEFAULT NULL,
  `opening_allocation_balance_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`opening_allocation_balance_id`),
  KEY `system_opening_balance_id` (`fk_system_opening_balance_id`),
  KEY `fk_project_allocation_id` (`fk_project_allocation_id`),
  CONSTRAINT `opening_allocation_balance_ibfk_1` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`),
  CONSTRAINT `opening_allocation_balance_ibfk_2` FOREIGN KEY (`fk_project_allocation_id`) REFERENCES `project_allocation` (`project_allocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_cash_balance`;
CREATE TABLE `opening_cash_balance` (
  `opening_cash_balance_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `opening_cash_balance_track_number` varchar(100) NOT NULL,
  `opening_cash_balance_name` varchar(100) NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `opening_cash_balance_bank` decimal(10,2) NOT NULL DEFAULT '0.00',
  `opening_cash_balance_cash` decimal(10,2) NOT NULL DEFAULT '0.00',
  `opening_cash_balance_created_date` date DEFAULT NULL,
  `opening_cash_balance_created_by` int(100) DEFAULT NULL,
  `opening_cash_balance_last_modified_by` int(100) DEFAULT NULL,
  `opening_cash_balance_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`opening_cash_balance_id`),
  KEY `fk_system_opening_balance_id` (`fk_system_opening_balance_id`),
  CONSTRAINT `opening_cash_balance_ibfk_1` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_deposit_transit`;
CREATE TABLE `opening_deposit_transit` (
  `opening_deposit_transit_id` int(100) NOT NULL AUTO_INCREMENT,
  `opening_deposit_transit_track_number` varchar(100) NOT NULL,
  `opening_deposit_transit_name` varchar(100) NOT NULL,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `opening_deposit_transit_date` date NOT NULL,
  `opening_deposit_transit_description` longtext NOT NULL,
  `opening_deposit_transit_amount` decimal(10,2) NOT NULL,
  `opening_deposit_transit_is_cleared` int(5) NOT NULL DEFAULT '0',
  `opening_deposit_transit_cleared_date` date NOT NULL,
  PRIMARY KEY (`opening_deposit_transit_id`),
  KEY `fk_system_opening_balance_id` (`fk_system_opening_balance_id`),
  CONSTRAINT `opening_deposit_transit_ibfk_1` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_fund_balance`;
CREATE TABLE `opening_fund_balance` (
  `opening_fund_balance_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `opening_fund_balance_track_number` varchar(100) NOT NULL,
  `opening_fund_balance_name` varchar(100) NOT NULL,
  `fk_income_account_id` int(11) NOT NULL,
  `opening_fund_balance_amount` decimal(10,2) NOT NULL,
  `opening_fund_balance_created_date` date DEFAULT NULL,
  `opening_fund_balance_created_by` int(100) DEFAULT NULL,
  `opening_fund_balance_last_modified_by` int(100) DEFAULT NULL,
  `opening_fund_balance_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`opening_fund_balance_id`),
  KEY `fk_system_opening_balance_id` (`fk_system_opening_balance_id`),
  KEY `fk_income_account_id` (`fk_income_account_id`),
  CONSTRAINT `opening_fund_balance_ibfk_1` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`),
  CONSTRAINT `opening_fund_balance_ibfk_2` FOREIGN KEY (`fk_income_account_id`) REFERENCES `income_account` (`income_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_outstanding_cheque`;
CREATE TABLE `opening_outstanding_cheque` (
  `opening_outstanding_cheque_id` int(100) NOT NULL AUTO_INCREMENT,
  `opening_outstanding_cheque_name` varchar(100) NOT NULL,
  `opening_outstanding_cheque_track_number` varchar(100) NOT NULL,
  `opening_outstanding_cheque_description` longtext NOT NULL,
  `opening_outstanding_cheque_date` date NOT NULL,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `opening_outstanding_cheque_number` int(50) NOT NULL,
  `opening_outstanding_cheque_amount` decimal(10,2) NOT NULL,
  `opening_outstanding_cheque_is_cleared` int(5) NOT NULL DEFAULT '0',
  `opening_outstanding_cheque_cleared_date` date NOT NULL,
  PRIMARY KEY (`opening_outstanding_cheque_id`),
  KEY `fk_system_opening_balance_id` (`fk_system_opening_balance_id`),
  CONSTRAINT `opening_outstanding_cheque_ibfk_1` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`),
  CONSTRAINT `opening_outstanding_cheque_ibfk_2` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `page_view`;
CREATE TABLE `page_view` (
  `page_view_id` int(100) NOT NULL AUTO_INCREMENT,
  `page_view_track_number` varchar(100) NOT NULL,
  `page_view_name` varchar(100) NOT NULL,
  `page_view_description` longtext NOT NULL,
  `fk_menu_id` int(100) NOT NULL,
  `page_view_is_default` int(5) NOT NULL DEFAULT '0' COMMENT 'System Admin default ',
  `page_view_created_date` date NOT NULL,
  `page_view_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_view_created_by` int(100) NOT NULL,
  `page_view_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`page_view_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_menu_id` (`fk_menu_id`),
  CONSTRAINT `page_view_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `page_view_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `page_view_ibfk_3` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `page_view_condition`;
CREATE TABLE `page_view_condition` (
  `page_view_condition_id` int(100) NOT NULL AUTO_INCREMENT,
  `page_view_condition_track_number` varchar(100) NOT NULL,
  `page_view_condition_name` varchar(100) DEFAULT NULL,
  `page_view_condition_field` varchar(100) NOT NULL,
  `page_view_condition_operator` varchar(50) NOT NULL,
  `page_view_condition_value` varchar(100) NOT NULL,
  `fk_page_view_id` int(100) NOT NULL,
  `page_view_condition_created_date` date NOT NULL,
  `page_view_condition_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_view_condition_created_by` int(100) NOT NULL,
  `page_view_condition_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`page_view_condition_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_page_view_id` (`fk_page_view_id`),
  CONSTRAINT `page_view_condition_ibfk_3` FOREIGN KEY (`fk_page_view_id`) REFERENCES `page_view` (`page_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `page_view_role`;
CREATE TABLE `page_view_role` (
  `page_view_role_id` int(100) NOT NULL AUTO_INCREMENT,
  `page_view_role_track_number` varchar(100) NOT NULL,
  `page_view_role_name` varchar(100) DEFAULT NULL,
  `page_view_role_is_default` int(5) DEFAULT '0',
  `fk_page_view_id` int(100) DEFAULT NULL,
  `fk_role_id` int(100) DEFAULT NULL,
  `page_view_role_created_date` date NOT NULL,
  `page_view_role_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_view_role_created_by` int(100) NOT NULL,
  `page_view_role_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`page_view_role_id`),
  KEY `fk_page_view_id` (`fk_page_view_id`),
  KEY `fk_role_id` (`fk_role_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `page_view_role_ibfk_1` FOREIGN KEY (`fk_page_view_id`) REFERENCES `page_view` (`page_view_id`),
  CONSTRAINT `page_view_role_ibfk_2` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`),
  CONSTRAINT `page_view_role_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `page_view_role_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_track_number` varchar(100) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `permission_description` longtext NOT NULL,
  `permission_is_active` int(5) NOT NULL,
  `fk_permission_label_id` int(100) NOT NULL,
  `permission_type` int(5) NOT NULL DEFAULT '1' COMMENT 'Type 1 = Page Access, 2 = Field Access',
  `permission_field` varchar(100) NOT NULL,
  `fk_menu_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  `permission_created_date` date DEFAULT NULL,
  `permission_created_by` int(100) DEFAULT NULL,
  `permission_deleted_at` date DEFAULT NULL,
  `permission_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `permission_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `fk_menu_id` (`fk_menu_id`),
  KEY `fk_permission_label_id` (`fk_permission_label_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `permission_ibfk_4` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE,
  CONSTRAINT `permission_ibfk_5` FOREIGN KEY (`fk_permission_label_id`) REFERENCES `permission_label` (`permission_label_id`) ON DELETE CASCADE,
  CONSTRAINT `permission_ibfk_6` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `permission_ibfk_7` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `permission_label`;
CREATE TABLE `permission_label` (
  `permission_label_id` int(100) NOT NULL AUTO_INCREMENT,
  `permission_label_track_number` varchar(100) NOT NULL,
  `permission_label_name` varchar(100) NOT NULL,
  `permission_label_description` varchar(100) NOT NULL,
  `permission_label_depth` int(10) NOT NULL,
  `fk_approval_id` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `permission_label_created_date` date NOT NULL,
  `permission_label_created_by` int(100) NOT NULL,
  `permission_label_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission_label_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`permission_label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `permission_label` (`permission_label_id`, `permission_label_track_number`, `permission_label_name`, `permission_label_description`, `permission_label_depth`, `fk_approval_id`, `fk_status_id`, `permission_label_created_date`, `permission_label_created_by`, `permission_label_last_modified_date`, `permission_label_last_modified_by`) VALUES
(1,	'PBL-56069',	'create',	'Mark all permissions used to create a new record',	2,	120,	105,	'2019-11-06',	1,	'2019-11-06 12:48:54',	1),
(2,	'PBL-32200',	'read',	'Mark all permissions used to read a record',	1,	121,	105,	'2019-11-06',	1,	'2019-11-06 12:51:56',	1),
(3,	'PBL-37242',	'update',	'Mark all permissions for updating a record',	3,	122,	105,	'2019-11-06',	1,	'2019-11-06 12:52:25',	1),
(4,	'PBL-14166',	'delete',	'Mark all permissions used to delete a record',	4,	123,	105,	'2019-11-06',	1,	'2019-11-06 12:52:43',	1);

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


DROP TABLE IF EXISTS `project_allocation`;
CREATE TABLE `project_allocation` (
  `project_allocation_id` int(100) NOT NULL AUTO_INCREMENT,
  `project_allocation_track_number` varchar(100) DEFAULT NULL,
  `fk_project_id` int(100) DEFAULT NULL,
  `project_allocation_name` varchar(100) DEFAULT NULL,
  `project_allocation_amount` decimal(10,2) DEFAULT NULL,
  `project_allocation_is_active` int(5) DEFAULT NULL,
  `fk_office_id` int(100) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `project_allocation_extended_end_date` date DEFAULT NULL,
  `project_allocation_created_date` date DEFAULT NULL,
  `project_allocation_last_modified_date` varchar(45) DEFAULT NULL,
  `project_allocation_created_by` int(100) DEFAULT NULL,
  `project_allocation_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_allocation_id`),
  KEY `fk_project_id` (`fk_project_id`),
  KEY `fk_center_id` (`fk_office_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `project_allocation_ibfk_1` FOREIGN KEY (`fk_project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `project_allocation_ibfk_2` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `project_allocation_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `project_allocation_ibfk_4` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `project_allocation_detail`;
CREATE TABLE `project_allocation_detail` (
  `project_allocation_detail_id` int(11) NOT NULL,
  `project_allocation_detail_track_number` varchar(100) NOT NULL,
  `project_allocation_detail_name` varchar(100) NOT NULL,
  `fk_project_allocation_id` int(100) NOT NULL,
  `project_allocation_detail_month` date NOT NULL,
  `project_allocation_detail_amount` decimal(10,2) NOT NULL,
  `project_allocation_detail_created_date` date DEFAULT NULL,
  `project_allocation_detail_created_by` int(100) DEFAULT NULL,
  `project_allocation_detail_last_modified_by` int(100) DEFAULT NULL,
  `project_allocation_detail_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  KEY `fk_project_allocation_id` (`fk_project_allocation_id`),
  CONSTRAINT `project_allocation_detail_ibfk_1` FOREIGN KEY (`fk_project_allocation_id`) REFERENCES `project_allocation` (`project_allocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
  `reconciliation_name` varchar(100) DEFAULT NULL,
  `fk_office_id` int(100) DEFAULT NULL,
  `reconciliation_reporting_month` date DEFAULT NULL,
  `financial_report_is_submitted` int(5) DEFAULT '0',
  `fk_status_id` int(5) DEFAULT NULL,
  `reconciliation_statement_amount` decimal(10,2) DEFAULT NULL,
  `reconciliation_suspense_amount` decimal(10,2) DEFAULT NULL,
  `reconciliation_created_by` int(100) DEFAULT NULL,
  `reconciliation_created_date` date DEFAULT NULL,
  `reconciliation_last_modified_by` int(100) DEFAULT NULL,
  `reconciliation_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`reconciliation_id`),
  KEY `fk_reconciliation_center1_idx` (`fk_office_id`),
  KEY `financial_report_is_submitted` (`financial_report_is_submitted`),
  CONSTRAINT `fk_reconciliation_center1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reconciliation_ibfk_1` FOREIGN KEY (`financial_report_is_submitted`) REFERENCES `financial_report` (`financial_report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `request_id` int(100) NOT NULL AUTO_INCREMENT,
  `request_track_number` varchar(100) DEFAULT NULL,
  `request_name` varchar(100) DEFAULT NULL,
  `fk_request_type_id` int(11) DEFAULT '1',
  `fk_status_id` int(11) DEFAULT '0',
  `fk_office_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `request_description` varchar(100) DEFAULT NULL,
  `fk_department_id` int(100) NOT NULL,
  `request_created_date` date DEFAULT NULL,
  `request_created_by` varchar(45) DEFAULT NULL,
  `request_last_modified_by` varchar(45) DEFAULT NULL,
  `request_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request_deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`request_id`),
  KEY `fk_request_center2_idx` (`fk_office_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_department_id` (`fk_department_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_requuest_type_id` (`fk_request_type_id`),
  CONSTRAINT `fk_request_center2` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `request_ibfk_3` FOREIGN KEY (`fk_department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `request_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `request_ibfk_5` FOREIGN KEY (`fk_request_type_id`) REFERENCES `request_type` (`request_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `request_conversion`;
CREATE TABLE `request_conversion` (
  `request_conversion_id` int(100) NOT NULL AUTO_INCREMENT,
  `request_conversion_name` varchar(100) NOT NULL,
  `request_conversion_track_number` varchar(100) NOT NULL,
  `fk_account_system_id` int(100) NOT NULL,
  `conversion_status_id` int(100) NOT NULL,
  `request_conversion_created_date` date DEFAULT NULL,
  `request_conversion_created_by` int(100) DEFAULT NULL,
  `request_conversion_last_modified_by` int(100) DEFAULT NULL,
  `request_conversion_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`request_conversion_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  KEY `conversion_status_id` (`conversion_status_id`),
  CONSTRAINT `request_conversion_ibfk_1` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`),
  CONSTRAINT `request_conversion_ibfk_2` FOREIGN KEY (`conversion_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `request_detail`;
CREATE TABLE `request_detail` (
  `request_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `request_detail_track_number` varchar(100) DEFAULT NULL,
  `request_detail_name` varchar(100) DEFAULT NULL,
  `fk_request_id` int(100) DEFAULT NULL,
  `request_detail_description` varchar(45) DEFAULT NULL,
  `request_detail_quantity` int(10) DEFAULT NULL,
  `request_detail_unit_cost` decimal(10,2) DEFAULT NULL,
  `request_detail_total_cost` decimal(10,2) DEFAULT NULL,
  `fk_expense_account_id` int(100) DEFAULT NULL,
  `fk_project_allocation_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `request_detail_conversion_set` int(5) DEFAULT '0',
  `request_detail_voucher_number` int(100) DEFAULT NULL,
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


DROP TABLE IF EXISTS `request_type`;
CREATE TABLE `request_type` (
  `request_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type_track_number` varchar(100) NOT NULL,
  `request_type_name` varchar(100) NOT NULL,
  `request_type_is_active` int(5) NOT NULL DEFAULT '1',
  `fk_account_system_id` int(100) NOT NULL DEFAULT '1',
  `request_type_created_date` date DEFAULT NULL,
  `request_type_created_by` int(100) DEFAULT NULL,
  `request_type_last_modified_by` int(100) DEFAULT NULL,
  `request_type_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`request_type_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  CONSTRAINT `request_type_ibfk_1` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(100) NOT NULL AUTO_INCREMENT,
  `role_track_number` varchar(100) DEFAULT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `role_shortname` varchar(50) NOT NULL,
  `role_description` longtext,
  `role_is_active` int(5) DEFAULT NULL,
  `role_is_new_status_default` int(5) DEFAULT '0',
  `role_is_department_strict` int(5) DEFAULT '0',
  `role_created_by` int(100) DEFAULT NULL,
  `role_created_date` date DEFAULT NULL,
  `role_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_last_modified_by` varchar(45) DEFAULT NULL,
  `role_deleted_at` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`role_id`, `role_track_number`, `role_name`, `role_shortname`, `role_description`, `role_is_active`, `role_is_new_status_default`, `role_is_department_strict`, `role_created_by`, `role_created_date`, `role_last_modified_date`, `role_last_modified_by`, `role_deleted_at`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'ROL-65362',	'System Administrator',	'systemadmin',	'System Administrator',	1,	0,	1,	1,	'2019-11-04',	'2019-11-06 06:08:14',	'1',	NULL,	150,	103),
(10,	'ROLE-53004',	'System',	'system',	'This is system role',	1,	1,	0,	1,	'2020-03-07',	'2020-03-07 04:21:56',	'1',	NULL,	691,	103);

DROP TABLE IF EXISTS `role_permission`;
CREATE TABLE `role_permission` (
  `role_permission_id` int(100) NOT NULL AUTO_INCREMENT,
  `role_permission_track_number` varchar(100) NOT NULL,
  `role_permission_name` varchar(100) NOT NULL,
  `role_permission_is_active` int(5) NOT NULL,
  `fk_role_id` int(100) NOT NULL,
  `fk_permission_id` int(11) NOT NULL,
  `fk_approval_id` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `role_permission_created_date` date NOT NULL,
  `role_permission_created_by` int(100) NOT NULL,
  `role_permission_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_permission_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`role_permission_id`),
  KEY `fk_role_id` (`fk_role_id`),
  KEY `fk_permission_id` (`fk_permission_id`),
  CONSTRAINT `role_permission_ibfk_4` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `role_permission_ibfk_5` FOREIGN KEY (`fk_permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
  `status_track_number` varchar(100) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `fk_workflow_id` int(11) NOT NULL,
  `fk_approve_item_id` int(11) NOT NULL,
  `status_approval_sequence` int(10) NOT NULL,
  `status_backflow_sequence` int(10) NOT NULL,
  `status_approval_direction` int(5) NOT NULL COMMENT '1-straight jumps, 0 - return jumps, -1 - reverse jump',
  `status_is_requiring_approver_action` int(5) NOT NULL DEFAULT '1',
  `fk_role_id` int(100) NOT NULL,
  `fk_account_system_id` int(100) NOT NULL DEFAULT '1',
  `status_created_date` date NOT NULL,
  `status_created_by` int(100) NOT NULL,
  `status_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`status_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  KEY `fk_role_id` (`fk_role_id`),
  CONSTRAINT `status_ibfk_2` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `status_ibfk_3` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`status_id`, `status_track_number`, `status_name`, `fk_workflow_id`, `fk_approve_item_id`, `status_approval_sequence`, `status_backflow_sequence`, `status_approval_direction`, `status_is_requiring_approver_action`, `fk_role_id`, `fk_account_system_id`, `status_created_date`, `status_created_by`, `status_last_modified_date`, `status_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(45,	'',	'New',	2,	20,	1,	0,	1,	0,	10,	1,	'2019-11-03',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL),
(67,	'',	'New',	0,	42,	1,	0,	1,	0,	10,	1,	'2019-11-21',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL),
(68,	'',	'New',	0,	43,	1,	0,	1,	0,	10,	1,	'2019-11-21',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL),
(69,	'',	'New',	0,	44,	1,	0,	1,	0,	10,	1,	'2019-11-21',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL),
(76,	'',	'New',	0,	51,	1,	0,	1,	0,	10,	1,	'2019-11-21',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL),
(77,	'',	'New',	0,	52,	1,	0,	1,	0,	10,	1,	'2019-11-22',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL),
(87,	'STUS-43859',	'New',	0,	62,	1,	0,	1,	0,	10,	1,	'2019-11-23',	1,	'2020-03-07 04:24:52',	1,	NULL,	NULL),
(142,	'',	'New',	0,	54,	1,	0,	1,	0,	10,	1,	'2019-11-22',	1,	'2020-03-20 17:14:15',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `status_role`;
CREATE TABLE `status_role` (
  `status_role_id` int(100) NOT NULL AUTO_INCREMENT,
  `status_role_track_number` varchar(100) NOT NULL,
  `status_role_name` varchar(50) NOT NULL,
  `fk_role_id` int(100) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  `status_role_created_by` int(100) NOT NULL,
  `status_role_created_date` date NOT NULL DEFAULT '0000-00-00',
  `status_role_last_modified_by` int(100) NOT NULL,
  `status_role_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_approval_id` int(11) NOT NULL,
  PRIMARY KEY (`status_role_id`),
  KEY `fk_role_id` (`fk_role_id`),
  CONSTRAINT `status_role_ibfk_4` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `system_opening_balance`;
CREATE TABLE `system_opening_balance` (
  `system_opening_balance_id` int(100) NOT NULL AUTO_INCREMENT,
  `system_opening_balance_track_number` varchar(100) NOT NULL,
  `system_opening_balance_name` varchar(100) NOT NULL,
  `fk_office_id` int(100) NOT NULL,
  `month` date NOT NULL,
  `system_opening_balance_created_date` date DEFAULT NULL,
  `system_opening_balance_created_by` int(100) DEFAULT NULL,
  `system_opening_balance_last_modified_by` int(100) DEFAULT NULL,
  `system_opening_balance_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`system_opening_balance_id`),
  KEY `fk_office_id` (`fk_office_id`),
  CONSTRAINT `system_opening_balance_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
  `user_track_number` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `user_is_context_manager` int(5) NOT NULL,
  `user_is_system_admin` int(5) NOT NULL DEFAULT '0',
  `fk_language_id` int(100) DEFAULT NULL COMMENT 'User''s default language',
  `user_is_active` int(5) NOT NULL DEFAULT '1',
  `fk_role_id` int(100) DEFAULT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_created_date` date NOT NULL,
  `user_created_by` int(100) NOT NULL,
  `user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_modifed_by` int(100) DEFAULT NULL,
  `user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `fk_language_id` (`fk_language_id`),
  KEY `fk_role_id` (`fk_role_id`),
  KEY `fk_center_group_hierarchy_id` (`fk_context_definition_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`fk_language_id`) REFERENCES `language` (`language_id`),
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`user_id`, `user_track_number`, `user_name`, `user_firstname`, `user_lastname`, `user_email`, `fk_context_definition_id`, `user_is_context_manager`, `user_is_system_admin`, `fk_language_id`, `user_is_active`, `fk_role_id`, `user_password`, `user_created_date`, `user_created_by`, `user_last_modified_date`, `user_last_modifed_by`, `user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'USR-84763',	'nkmwambs',	'Nicodemus',	'Karisa',	'nkmwambs@gmail.com',	12,	0,	1,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'0000-00-00',	0,	'2019-11-07 07:54:59',	NULL,	0,	NULL,	NULL);

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
  `fk_office_id` int(100) DEFAULT NULL,
  `voucher_date` date DEFAULT NULL,
  `fk_voucher_type_id` int(100) DEFAULT NULL,
  `voucher_cleared` int(5) DEFAULT '0',
  `voucher_cleared_month` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `fk_office_bank_id` int(100) DEFAULT NULL,
  `voucher_cheque_number` int(100) DEFAULT NULL,
  `voucher_transaction_cleared_date` date DEFAULT '0000-00-00',
  `voucher_transaction_cleared_month` date DEFAULT '0000-00-00',
  `voucher_vendor` varchar(100) DEFAULT NULL,
  `voucher_vendor_address` varchar(100) DEFAULT NULL,
  `voucher_description` varchar(200) DEFAULT NULL,
  `voucher_allow_edit` int(5) DEFAULT '0',
  `voucher_created_by` int(100) DEFAULT NULL,
  `voucher_created_date` date DEFAULT NULL,
  `voucher_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_id`),
  KEY `fk_voucher_center1_idx` (`fk_office_id`),
  KEY `fk_voucher_voucher_type1_idx` (`fk_voucher_type_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `fk_voucher_voucher_type1` FOREIGN KEY (`fk_voucher_type_id`) REFERENCES `voucher_type` (`voucher_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `voucher_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `voucher_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION,
  CONSTRAINT `voucher_ibfk_3` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This holds transactions ';


DROP TABLE IF EXISTS `voucher_detail`;
CREATE TABLE `voucher_detail` (
  `voucher_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_detail_track_number` varchar(100) DEFAULT NULL,
  `voucher_detail_name` varchar(100) DEFAULT NULL,
  `fk_voucher_id` int(100) DEFAULT NULL,
  `voucher_detail_description` varchar(45) DEFAULT NULL,
  `voucher_detail_quantity` int(10) DEFAULT NULL,
  `voucher_detail_unit_cost` decimal(10,2) DEFAULT NULL,
  `voucher_detail_total_cost` decimal(10,2) DEFAULT NULL,
  `fk_expense_account_id` int(100) NOT NULL DEFAULT '0' COMMENT 'Can be income_account_id or expense_account_id depending on the selected voucher type',
  `fk_income_account_id` int(100) NOT NULL DEFAULT '0',
  `fk_bank_contra_account_id` int(100) NOT NULL DEFAULT '0',
  `fk_cash_contra_account_id` int(100) NOT NULL DEFAULT '0',
  `fk_approval_id` int(100) NOT NULL DEFAULT '0',
  `fk_status_id` int(100) NOT NULL DEFAULT '0',
  `fk_request_detail_id` int(100) NOT NULL DEFAULT '0',
  `fk_project_allocation_id` int(100) NOT NULL DEFAULT '0',
  `voucher_detail_last_modified_date` date DEFAULT NULL,
  `voucher_detail_last_modified_by` varchar(45) DEFAULT NULL,
  `voucher_detail_created_by` int(100) DEFAULT NULL,
  `voucher_detail_created_date` date DEFAULT NULL,
  PRIMARY KEY (`voucher_detail_id`),
  KEY `fk_voucher_detail_voucher1_idx` (`fk_voucher_id`),
  KEY `fk_voucher_detail_request_detail1_idx` (`fk_approval_id`),
  CONSTRAINT `voucher_detail_ibfk_3` FOREIGN KEY (`fk_voucher_id`) REFERENCES `voucher` (`voucher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `voucher_type`;
CREATE TABLE `voucher_type` (
  `voucher_type_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_type_track_number` varchar(100) NOT NULL,
  `voucher_type_name` varchar(45) DEFAULT NULL,
  `voucher_type_is_active` int(5) DEFAULT NULL,
  `voucher_type_abbrev` varchar(5) DEFAULT NULL,
  `fk_voucher_type_account_id` int(100) DEFAULT NULL COMMENT 'Can be bank, cash or contra',
  `fk_voucher_type_effect_id` int(100) DEFAULT NULL COMMENT 'Can be income or expense',
  `voucher_type_created_by` int(100) DEFAULT NULL,
  `voucher_type_created_date` date DEFAULT NULL,
  `voucher_type_last_modified_by` int(100) DEFAULT NULL,
  `voucher_type_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_type_id`),
  KEY `fk_voucher_type_voucher_type_transaction_effect1_idx` (`fk_voucher_type_effect_id`),
  KEY `voucher_type_account_id` (`fk_voucher_type_account_id`),
  CONSTRAINT `voucher_type_ibfk_1` FOREIGN KEY (`fk_voucher_type_account_id`) REFERENCES `voucher_type_account` (`voucher_type_account_id`),
  CONSTRAINT `voucher_type_ibfk_2` FOREIGN KEY (`fk_voucher_type_effect_id`) REFERENCES `voucher_type_effect` (`voucher_type_effect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher_type` (`voucher_type_id`, `voucher_type_track_number`, `voucher_type_name`, `voucher_type_is_active`, `voucher_type_abbrev`, `fk_voucher_type_account_id`, `fk_voucher_type_effect_id`, `voucher_type_created_by`, `voucher_type_created_date`, `voucher_type_last_modified_by`, `voucher_type_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(2,	'VOPE-73018',	'Payment by Cash',	1,	'PCE',	2,	2,	1,	'2020-01-15',	1,	NULL,	523,	62),
(3,	'VOPE-52694',	'Bank payment',	1,	'CHQ',	1,	2,	1,	'2020-01-15',	1,	NULL,	524,	62),
(4,	'VOPE-3307',	'Petty Cash Top Up',	1,	'CTP',	2,	3,	1,	'2020-01-15',	1,	NULL,	525,	62),
(5,	'VOPE-56398',	'Bank Cash Received',	1,	'BCR',	1,	1,	1,	'2020-01-15',	1,	NULL,	526,	62),
(6,	'VOPE-19114',	'Bank Charges',	1,	'BCHG',	1,	2,	1,	'2020-01-15',	1,	NULL,	527,	62),
(7,	'VOPE-29303',	'Bank Interest Receiveable',	1,	'BIT',	1,	1,	1,	'2020-01-15',	1,	NULL,	528,	62),
(8,	'VOPE-75339',	'Petty Cash Income',	1,	'PCR',	2,	1,	1,	'2020-01-15',	1,	NULL,	529,	62),
(9,	'VOPE-3307',	'Petty Cash Rebanking',	1,	'CTP',	1,	4,	1,	'2020-01-15',	1,	NULL,	525,	62);

DROP TABLE IF EXISTS `voucher_type_account`;
CREATE TABLE `voucher_type_account` (
  `voucher_type_account_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_type_account_track_number` varchar(100) NOT NULL,
  `voucher_type_account_name` varchar(100) NOT NULL,
  `voucher_type_account_code` varchar(10) NOT NULL COMMENT 'cash or bank',
  `voucher_type_account_created_date` date DEFAULT NULL,
  `voucher_type_account_created_by` int(100) DEFAULT NULL,
  `voucher_type_account_last_modified_by` int(100) DEFAULT NULL,
  `voucher_type_account_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_type_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher_type_account` (`voucher_type_account_id`, `voucher_type_account_track_number`, `voucher_type_account_name`, `voucher_type_account_code`, `voucher_type_account_created_date`, `voucher_type_account_created_by`, `voucher_type_account_last_modified_by`, `voucher_type_account_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'VONT-69699',	'Bank',	'bank',	'2020-01-15',	1,	1,	NULL,	518,	0),
(2,	'VONT-11776',	'Cash',	'cash',	'2020-01-15',	1,	1,	NULL,	519,	0);

DROP TABLE IF EXISTS `voucher_type_effect`;
CREATE TABLE `voucher_type_effect` (
  `voucher_type_effect_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_type_effect_track_number` varchar(100) NOT NULL,
  `voucher_type_effect_name` varchar(100) NOT NULL,
  `voucher_type_effect_code` varchar(50) NOT NULL,
  `voucher_type_effect_created_date` date DEFAULT NULL,
  `voucher_type_effect_created_by` int(100) DEFAULT NULL,
  `voucher_type_effect_last_modified_by` int(100) DEFAULT NULL,
  `voucher_type_effect_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_type_effect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher_type_effect` (`voucher_type_effect_id`, `voucher_type_effect_track_number`, `voucher_type_effect_name`, `voucher_type_effect_code`, `voucher_type_effect_created_date`, `voucher_type_effect_created_by`, `voucher_type_effect_last_modified_by`, `voucher_type_effect_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'VOCT-80726',	'Income',	'income',	'2020-01-15',	1,	1,	NULL,	520,	0),
(2,	'VOCT-37953',	'Expense',	'expense',	'2020-01-15',	1,	1,	NULL,	521,	0),
(3,	'VOCT-51241',	'Bank Contra',	'bank_contra',	'2020-01-15',	1,	1,	NULL,	522,	0),
(4,	'VOCT-12589',	'Cash Contra',	'cash_contra',	'2020-01-16',	1,	1,	NULL,	546,	0);

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE `workflow` (
  `workflow_id` int(100) NOT NULL AUTO_INCREMENT,
  `workflow_name` varchar(100) NOT NULL,
  `workflow_track_number` varchar(100) NOT NULL,
  `fk_approve_item_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `workflow_is_active` int(5) NOT NULL DEFAULT '1',
  `workflow_created_date` date DEFAULT NULL,
  `workflow_created_by` int(100) DEFAULT NULL,
  `workflow_last_modified_by` int(100) DEFAULT NULL,
  `workflow_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`workflow_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `workflow_ibfk_1` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `workflow_ibfk_2` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `workplan`;
CREATE TABLE `workplan` (
  `workplan_id` int(100) NOT NULL,
  `workplan_track_number` varchar(100) DEFAULT NULL,
  `workplan_name` varchar(100) DEFAULT NULL,
  `fk_budget_id` int(100) DEFAULT NULL,
  `workplan_description` longtext,
  `workplan_start_date` date DEFAULT NULL,
  `workplan_end_date` date DEFAULT NULL,
  `workplan_created_date` date DEFAULT NULL,
  `workplan_created_by` int(100) DEFAULT NULL,
  `workplan_last_modified_date` date DEFAULT NULL,
  `workplan_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`workplan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `workplan_task`;
CREATE TABLE `workplan_task` (
  `workplan_task_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_workplan_id` int(100) NOT NULL,
  `workplan_task_track_number` varchar(100) NOT NULL,
  `workplan_task_name` varchar(100) NOT NULL,
  `workplan_task_description` longtext NOT NULL,
  `workplan_task_start_date` date NOT NULL,
  `workplan_taskend_date` date NOT NULL,
  `workplan_task_user` int(100) NOT NULL,
  `workplan_task_status` int(5) NOT NULL DEFAULT '1',
  `workplan_task_note` longtext NOT NULL,
  PRIMARY KEY (`workplan_task_id`),
  KEY `fk_workplan_id` (`fk_workplan_id`),
  KEY `workplan_detail_task_user` (`workplan_task_user`),
  CONSTRAINT `workplan_task_ibfk_1` FOREIGN KEY (`fk_workplan_id`) REFERENCES `workplan` (`workplan_id`),
  CONSTRAINT `workplan_task_ibfk_2` FOREIGN KEY (`workplan_task_user`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-03-20 17:47:34

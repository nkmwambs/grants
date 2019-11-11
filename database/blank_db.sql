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
(146,	'APR-45830',	'Approval Ticket # APR-45830',	22,	1,	'2019-11-07',	'2019-11-07 11:34:49',	1),
(147,	'APR-88163',	'Approval Ticket # APR-88163',	23,	1,	'2019-11-07',	'2019-11-07 11:36:09',	1),
(148,	'APR-13132',	'Approval Ticket # APR-13132',	22,	1,	'2019-11-07',	'2019-11-07 12:03:32',	1),
(149,	'APR-15968',	'Approval Ticket # APR-15968',	23,	1,	'2019-11-07',	'2019-11-07 12:04:08',	1),
(150,	'APR-64360',	'Approval Ticket # APR-64360',	21,	1,	'2019-11-07',	'2019-11-07 13:26:58',	8),
(151,	'APR-6172',	'Approval Ticket # APR-6172',	20,	1,	'2019-11-07',	'2019-11-07 12:53:15',	1),
(152,	'APR-64367',	'Approval Ticket # APR-64367',	26,	1,	'2019-11-07',	'2019-11-07 13:26:58',	1),
(154,	'APR-80682',	'Approval Ticket # APR-80682',	19,	1,	'2019-11-07',	'2019-11-07 13:37:13',	1),
(155,	'APR-8086',	'Approval Ticket # APR-8086',	3,	1,	'2019-11-07',	'2019-11-07 13:38:01',	1),
(156,	'APAL-81132',	'Approval Ticket # APAL-81132',	19,	1,	'2019-11-07',	'2019-11-07 14:05:14',	1),
(157,	'APAL-76190',	'Approval Ticket # APAL-76190',	22,	1,	'2019-11-07',	'2019-11-07 14:06:25',	1),
(158,	'APAL-52378',	'Approval Ticket # APAL-52378',	19,	1,	'2019-11-07',	'2019-11-07 14:07:04',	1),
(159,	'APAL-10554',	'Approval Ticket # APAL-10554',	3,	1,	'2019-11-07',	'2019-11-07 17:23:55',	1),
(160,	'APAL-25105',	'Approval Ticket # APAL-25105',	29,	1,	'2019-11-08',	'2019-11-08 07:21:31',	1),
(161,	'APAL-38118',	'Approval Ticket # APAL-38118',	29,	1,	'2019-11-08',	'2019-11-08 07:24:42',	1),
(162,	'APAL-75620',	'Approval Ticket # APAL-75620',	29,	1,	'2019-11-08',	'2019-11-08 07:55:20',	1),
(163,	'APAL-10692',	'Approval Ticket # APAL-10692',	23,	1,	'2019-11-08',	'2019-11-08 09:23:41',	1),
(164,	'APAL-84180',	'Approval Ticket # APAL-84180',	23,	1,	'2019-11-08',	'2019-11-08 09:24:14',	1),
(165,	'APAL-79894',	'Approval Ticket # APAL-79894',	22,	1,	'2019-11-08',	'2019-11-08 09:35:12',	1),
(166,	'APAL-6771',	'Approval Ticket # APAL-6771',	23,	1,	'2019-11-08',	'2019-11-08 09:57:44',	1),
(167,	'APAL-57745',	'Approval Ticket # APAL-57745',	21,	1,	'2019-11-08',	'2019-11-08 10:06:09',	1),
(168,	'APAL-85894',	'Approval Ticket # APAL-85894',	23,	1,	'2019-11-08',	'2019-11-08 10:09:04',	1),
(169,	'APAL-2174',	'Approval Ticket # APAL-2174',	23,	1,	'2019-11-08',	'2019-11-08 10:09:34',	1),
(170,	'APAL-88744',	'Approval Ticket # APAL-88744',	26,	2,	'2019-11-08',	'2019-11-08 11:03:07',	2),
(171,	'APAL-84595',	'Approval Ticket # APAL-84595',	22,	1,	'2019-11-08',	'2019-11-08 11:32:48',	1),
(172,	'APAL-52466',	'Approval Ticket # APAL-52466',	22,	1,	'2019-11-08',	'2019-11-08 11:33:33',	1),
(173,	'APAL-14516',	'Approval Ticket # APAL-14516',	23,	1,	'2019-11-08',	'2019-11-08 11:34:43',	1),
(174,	'APAL-32516',	'Approval Ticket # APAL-32516',	23,	1,	'2019-11-08',	'2019-11-08 11:35:07',	1),
(175,	'APAL-18028',	'Approval Ticket # APAL-18028',	21,	1,	'2019-11-08',	'2019-11-08 11:38:04',	1),
(176,	'APAL-88261',	'Approval Ticket # APAL-88261',	29,	1,	'2019-11-08',	'2019-11-08 11:57:17',	1),
(177,	'APAL-8283',	'Approval Ticket # APAL-8283',	29,	1,	'2019-11-08',	'2019-11-08 12:14:22',	1),
(178,	'APAL-82917',	'Approval Ticket # APAL-82917',	29,	1,	'2019-11-08',	'2019-11-08 12:16:01',	1),
(179,	'APAL-8602',	'Approval Ticket # APAL-8602',	29,	1,	'2019-11-08',	'2019-11-08 12:18:44',	1),
(180,	'APAL-42378',	'Approval Ticket # APAL-42378',	29,	1,	'2019-11-08',	'2019-11-08 12:23:24',	1),
(181,	'APAL-28521',	'Approval Ticket # APAL-28521',	29,	1,	'2019-11-08',	'2019-11-08 12:24:18',	1),
(182,	'APAL-76538',	'Approval Ticket # APAL-76538',	29,	1,	'2019-11-08',	'2019-11-08 12:26:22',	1),
(185,	'APAL-67074',	'Approval Ticket # APAL-67074',	22,	1,	'2019-11-08',	'2019-11-08 12:35:17',	1),
(186,	'APAL-89308',	'Approval Ticket # APAL-89308',	22,	1,	'2019-11-08',	'2019-11-08 12:37:51',	1),
(187,	'APAL-54182',	'Approval Ticket # APAL-54182',	23,	1,	'2019-11-08',	'2019-11-08 12:39:25',	1),
(188,	'APAL-61432',	'Approval Ticket # APAL-61432',	22,	1,	'2019-11-08',	'2019-11-08 12:43:11',	1),
(189,	'APAL-43136',	'Approval Ticket # APAL-43136',	22,	1,	'2019-11-08',	'2019-11-08 12:47:29',	1),
(190,	'APAL-6496',	'Approval Ticket # APAL-6496',	23,	1,	'2019-11-08',	'2019-11-08 12:48:05',	1),
(191,	'APAL-62132',	'Approval Ticket # APAL-62132',	23,	1,	'2019-11-08',	'2019-11-08 12:48:32',	1),
(192,	'APAL-78015',	'Approval Ticket # APAL-78015',	22,	1,	'2019-11-08',	'2019-11-08 13:30:17',	1),
(193,	'APAL-78908',	'Approval Ticket # APAL-78908',	23,	1,	'2019-11-08',	'2019-11-08 13:31:03',	1),
(194,	'APAL-6342',	'Approval Ticket # APAL-6342',	23,	1,	'2019-11-08',	'2019-11-08 14:17:53',	1),
(195,	'APAL-82116',	'Approval Ticket # APAL-82116',	23,	1,	'2019-11-08',	'2019-11-08 14:18:12',	1),
(196,	'APAL-65833',	'Approval Ticket # APAL-65833',	2,	2,	'2019-11-08',	'2019-11-08 15:43:40',	2),
(197,	'APAL-54353',	'Approval Ticket # APAL-54353',	22,	1,	'2019-11-08',	'2019-11-08 17:26:32',	1),
(198,	'APAL-85692',	'Approval Ticket # APAL-85692',	23,	1,	'2019-11-08',	'2019-11-08 17:28:08',	1),
(199,	'APAL-40108',	'Approval Ticket # APAL-40108',	22,	1,	'2019-11-08',	'2019-11-08 17:29:44',	1),
(200,	'APAL-69287',	'Approval Ticket # APAL-69287',	23,	1,	'2019-11-08',	'2019-11-08 17:31:28',	1),
(201,	'APAL-13425',	'Approval Ticket # APAL-13425',	23,	1,	'2019-11-08',	'2019-11-08 17:31:49',	1),
(203,	'APAL-63537',	'Approval Ticket # APAL-63537',	2,	1,	'2019-11-11',	'2019-11-11 07:43:19',	1),
(204,	'APAL-48936',	'Approval Ticket # APAL-48936',	3,	1,	'2019-11-11',	'2019-11-11 07:54:25',	1);

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
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approve_item` (`approve_item_id`, `approve_item_name`, `approve_item_is_active`, `approve_item_created_date`, `approve_item_created_by`, `approve_item_last_modified_date`, `approve_item_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'request_detail',	0,	'0000-00-00',	0,	'2019-10-22 12:34:13',	0,	NULL,	NULL),
(2,	'voucher',	1,	'0000-00-00',	0,	'2019-10-24 21:23:30',	0,	NULL,	NULL),
(3,	'request',	1,	'0000-00-00',	0,	'0000-00-00 00:00:00',	0,	NULL,	NULL),
(4,	'budget',	1,	'2019-10-22',	1,	'2019-10-21 21:00:00',	1,	NULL,	NULL),
(5,	'budget_item',	0,	'2019-10-22',	1,	'2019-10-21 21:00:00',	1,	NULL,	NULL),
(8,	'funder',	0,	'2019-10-22',	1,	'2019-10-22 10:54:56',	1,	NULL,	NULL),
(9,	'workplan',	0,	'2019-10-22',	1,	'2019-10-22 12:07:47',	1,	NULL,	NULL),
(13,	'budget_item_detail',	0,	'2019-10-22',	1,	'2019-10-22 12:41:39',	1,	NULL,	NULL),
(14,	'voucher_detail',	0,	'2019-10-22',	1,	'2019-10-22 12:41:52',	1,	NULL,	NULL),
(18,	'project',	0,	'2019-10-25',	1,	'2019-10-24 22:22:18',	1,	NULL,	NULL),
(19,	'project_allocation',	1,	'2019-11-03',	1,	'2019-11-07 16:27:05',	1,	NULL,	NULL),
(20,	'center',	0,	'2019-11-03',	1,	'2019-11-03 11:14:26',	1,	NULL,	NULL),
(21,	'role',	0,	'2019-11-04',	1,	'2019-11-04 17:06:04',	1,	NULL,	NULL),
(22,	'permission',	0,	'2019-11-04',	1,	'2019-11-04 17:06:51',	1,	NULL,	NULL),
(23,	'role_permission',	0,	'2019-11-04',	1,	'2019-11-04 17:17:01',	1,	NULL,	NULL),
(24,	'dashboard',	0,	'2019-11-05',	1,	'2019-11-05 17:03:44',	1,	NULL,	NULL),
(25,	'permission_label',	0,	'2019-11-06',	1,	'2019-11-06 12:48:45',	1,	NULL,	NULL),
(26,	'bank',	0,	'2019-11-06',	1,	'2019-11-06 15:26:32',	1,	NULL,	NULL),
(27,	'user_detail',	0,	'2019-11-07',	1,	'2019-11-07 08:28:59',	1,	NULL,	NULL),
(28,	'menu_user_order',	0,	'2019-11-07',	1,	'2019-11-07 09:23:52',	1,	NULL,	NULL),
(29,	'user',	0,	'2019-11-07',	1,	'2019-11-07 10:27:38',	1,	NULL,	NULL),
(30,	'user_setting',	0,	'2019-11-07',	1,	'2019-11-07 10:46:03',	1,	NULL,	NULL),
(31,	'approve_item',	0,	'2019-11-07',	1,	'2019-11-07 16:34:18',	1,	NULL,	NULL),
(32,	'status',	0,	'2019-11-07',	1,	'2019-11-07 16:39:32',	1,	NULL,	NULL);

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

INSERT INTO `bank` (`bank_id`, `bank_track_number`, `bank_name`, `bank_swift_code`, `bank_is_active`, `bank_created_date`, `bank_created_by`, `bank_last_modified_date`, `bank_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'BAK-87365',	'Commercial Bank of Kenya',	'23700',	1,	'2019-11-07',	1,	'2019-11-06 15:28:30',	1,	152,	51),
(2,	'BANK-3124',	'Chess Bank',	'65783',	1,	'2019-11-08',	2,	'2019-11-08 11:03:07',	2,	170,	51);

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
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`center_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `center_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `center_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the remote sites for the organization';

INSERT INTO `center` (`center_id`, `center_track_number`, `center_name`, `center_code`, `center_start_date`, `center_end_date`, `center_is_active`, `center_created_by`, `center_created_date`, `center_last_modified_date`, `center_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(9,	'CNT-77415',	'Center 1',	'C-001',	'2019-11-07',	'2019-11-07',	1,	1,	'2019-11-07',	'0000-00-00',	1,	151,	45);

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
  `dashboard_created_date` date DEFAULT NULL,
  `dashboard_created_by` int(100) DEFAULT NULL,
  `dashboard_last_modified_by` int(100) DEFAULT NULL,
  `dashboard_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  `language_track_number` varchar(100) NOT NULL,
  `language_name` varchar(100) DEFAULT NULL,
  `language_shortname` varchar(10) DEFAULT NULL,
  `language_created_date` date DEFAULT NULL,
  `language_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `language_deleted_date` date DEFAULT NULL,
  `language_created_by` int(100) DEFAULT NULL,
  `language_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `language` (`language_id`, `language_track_number`, `language_name`, `language_shortname`, `language_created_date`, `language_last_modified_date`, `language_deleted_date`, `language_created_by`, `language_last_modified_by`) VALUES
(1,	'LNG-97389',	'English',	'En',	NULL,	'2019-11-07 10:39:11',	NULL,	NULL,	NULL);

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
  `menu_last_modified_date` date DEFAULT NULL,
  `menu_created_by` int(100) DEFAULT NULL,
  `menu_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_derivative_controller`, `menu_is_active`, `menu_created_date`, `menu_last_modified_date`, `menu_created_by`, `menu_last_modified_by`) VALUES
(380,	'Approval',	'Approval',	1,	NULL,	NULL,	NULL,	NULL),
(381,	'Bank',	'Bank',	1,	NULL,	NULL,	NULL,	NULL),
(382,	'Budget',	'Budget',	1,	NULL,	NULL,	NULL,	NULL),
(383,	'Center',	'Center',	1,	NULL,	NULL,	NULL,	NULL),
(384,	'Dashboard',	'Dashboard',	1,	NULL,	NULL,	NULL,	NULL),
(385,	'Funder',	'Funder',	1,	NULL,	NULL,	NULL,	NULL),
(386,	'Journal',	'Journal',	1,	NULL,	NULL,	NULL,	NULL),
(387,	'Language',	'Language',	1,	NULL,	NULL,	NULL,	NULL),
(388,	'Menu_user_order',	'Menu_user_order',	1,	NULL,	NULL,	NULL,	NULL),
(389,	'Permission',	'Permission',	1,	NULL,	NULL,	NULL,	NULL),
(390,	'Permission_label',	'Permission_label',	1,	NULL,	NULL,	NULL,	NULL),
(391,	'Project_allocation',	'Project_allocation',	1,	NULL,	NULL,	NULL,	NULL),
(392,	'Request',	'Request',	1,	NULL,	NULL,	NULL,	NULL),
(393,	'Role',	'Role',	1,	NULL,	NULL,	NULL,	NULL),
(394,	'Role_permission',	'Role_permission',	1,	NULL,	NULL,	NULL,	NULL),
(395,	'User_detail',	'User_detail',	1,	NULL,	NULL,	NULL,	NULL),
(396,	'User_setting',	'User_setting',	1,	NULL,	NULL,	NULL,	NULL),
(397,	'Voucher',	'Voucher',	1,	NULL,	NULL,	NULL,	NULL),
(398,	'Workplan',	'Workplan',	1,	NULL,	NULL,	NULL,	NULL),
(399,	'Menu',	'Menu',	1,	NULL,	NULL,	NULL,	NULL),
(400,	'User',	'User',	1,	NULL,	NULL,	NULL,	NULL),
(401,	'Approve_item',	'Approve_item',	1,	NULL,	NULL,	NULL,	NULL),
(402,	'Status',	'Status',	1,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `menu_user_order`;
CREATE TABLE `menu_user_order` (
  `menu_user_order_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(100) DEFAULT NULL,
  `fk_menu_id` int(100) DEFAULT NULL,
  `menu_user_order_is_active` int(5) NOT NULL DEFAULT '1',
  `menu_user_order_level` int(100) DEFAULT NULL,
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

INSERT INTO `menu_user_order` (`menu_user_order_id`, `fk_user_id`, `fk_menu_id`, `menu_user_order_is_active`, `menu_user_order_level`, `menu_user_order_priority_item`, `menu_user_order_created_date`, `menu_user_order_last_modified_date`, `menu_user_order_created_by`, `menu_user_order_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(622,	1,	380,	1,	1,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(623,	1,	381,	1,	2,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(624,	1,	382,	1,	3,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(625,	1,	383,	1,	4,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(626,	1,	384,	1,	5,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(627,	1,	385,	1,	6,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(628,	1,	386,	1,	7,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(629,	1,	387,	1,	8,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(630,	1,	388,	1,	9,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(631,	1,	389,	1,	10,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(632,	1,	390,	1,	11,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(633,	1,	391,	1,	12,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(634,	1,	392,	1,	13,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(635,	1,	393,	1,	14,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(636,	1,	394,	1,	15,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(637,	1,	395,	1,	16,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(638,	1,	396,	1,	17,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(639,	1,	397,	1,	18,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(640,	1,	398,	1,	19,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(641,	1,	399,	1,	20,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(642,	1,	400,	1,	21,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(643,	1,	401,	1,	22,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(644,	1,	402,	1,	23,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(645,	4,	380,	1,	1,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(646,	4,	381,	1,	2,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(647,	4,	382,	1,	3,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(648,	4,	383,	1,	4,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(649,	4,	384,	1,	5,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(650,	4,	385,	1,	6,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(651,	4,	386,	1,	7,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(652,	4,	387,	1,	8,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(653,	4,	388,	1,	9,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(654,	4,	389,	1,	10,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(655,	4,	390,	1,	11,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(656,	4,	391,	1,	12,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(657,	4,	392,	1,	13,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(658,	4,	393,	1,	14,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(659,	4,	394,	1,	15,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(660,	4,	395,	1,	16,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(661,	4,	396,	1,	17,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(662,	4,	397,	1,	18,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(663,	4,	398,	1,	19,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(664,	4,	399,	1,	20,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(665,	4,	400,	1,	21,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(666,	4,	401,	1,	22,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(667,	4,	402,	1,	23,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(668,	2,	380,	1,	1,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(669,	2,	381,	1,	2,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(670,	2,	382,	1,	3,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(671,	2,	383,	1,	4,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(672,	2,	384,	1,	5,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(673,	2,	385,	1,	6,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(674,	2,	386,	1,	7,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(675,	2,	387,	1,	8,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(676,	2,	388,	1,	9,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(677,	2,	389,	1,	10,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(678,	2,	390,	1,	11,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(679,	2,	391,	1,	12,	0,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(680,	2,	392,	1,	13,	0,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(681,	2,	393,	1,	14,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(682,	2,	394,	1,	15,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(683,	2,	395,	1,	16,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(684,	2,	396,	1,	17,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(685,	2,	397,	1,	18,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(686,	2,	398,	1,	19,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(687,	2,	399,	1,	20,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(688,	2,	400,	1,	21,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(689,	2,	401,	1,	22,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(690,	2,	402,	1,	23,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(691,	5,	380,	1,	1,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(692,	5,	381,	1,	2,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(693,	5,	382,	1,	3,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(694,	5,	383,	1,	4,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(695,	5,	384,	1,	5,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(696,	5,	385,	1,	6,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(697,	5,	386,	1,	7,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(698,	5,	387,	1,	8,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(699,	5,	388,	1,	9,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(700,	5,	389,	1,	10,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(701,	5,	390,	1,	11,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(702,	5,	391,	1,	12,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(703,	5,	392,	1,	13,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(704,	5,	393,	1,	14,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(705,	5,	394,	1,	15,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(706,	5,	395,	1,	16,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(707,	5,	396,	1,	17,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(708,	5,	397,	1,	18,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(709,	5,	398,	1,	19,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(710,	5,	399,	1,	20,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(711,	5,	400,	1,	21,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(712,	5,	401,	1,	22,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(713,	5,	402,	1,	23,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL);

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

INSERT INTO `permission` (`permission_id`, `permission_track_number`, `permission_name`, `permission_description`, `permission_is_active`, `fk_permission_label_id`, `permission_type`, `permission_field`, `fk_menu_id`, `fk_approval_id`, `fk_status_id`, `permission_created_date`, `permission_created_by`, `permission_deleted_at`, `permission_last_modified_date`, `permission_last_modified_by`) VALUES
(18,	'PEM-41448',	'show_bank',	'Show a list of bank records',	1,	2,	1,	'',	381,	146,	47,	'2019-11-07',	1,	NULL,	'2019-11-07 11:34:49',	1),
(19,	'PEM-34619',	'add_bank',	'Add a new bank record',	1,	1,	1,	'',	381,	148,	47,	'2019-11-07',	1,	NULL,	'2019-11-07 12:03:32',	1),
(20,	'PEON-46617',	'delete_bank',	'Deleting a bank',	1,	4,	1,	'',	381,	157,	47,	'2019-11-07',	1,	NULL,	'2019-11-07 14:06:25',	1),
(21,	'PEON-47240',	'insert_bank_is_active',	'Show Bank Is Active Field on create',	1,	1,	2,	'bank_is_active',	381,	165,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 09:35:12',	1),
(22,	'PEON-77845',	'show_request',	'Show a list of requests',	1,	2,	1,	'',	392,	171,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 11:32:48',	1),
(23,	'PEON-53472',	'add_request',	'Add a new request',	1,	1,	1,	'',	392,	172,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 11:33:33',	1),
(25,	'PEON-83225',	'show_center_name',	'Show center name field of the voucher form',	1,	1,	2,	'center_name',	397,	186,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 12:37:51',	1),
(26,	'PEON-16620',	'show_voucher',	'Show a list of vouchers',	1,	2,	1,	'',	397,	188,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 12:43:11',	1),
(27,	'PEON-21271',	'add_voucher',	'Add new voucher record',	1,	1,	1,	'',	397,	189,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 12:47:29',	1),
(28,	'PEON-65200',	'show_voucher_detail_description',	'Show the voucher detail description',	1,	1,	2,	'voucher_detail_description',	397,	192,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 13:30:17',	1),
(29,	'PEON-32089',	'update_bank_is_active',	'Show the bank is active field on update',	1,	3,	2,	'bank_is_active',	381,	197,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 17:26:32',	1),
(30,	'PEON-2742',	'edit_bank',	'Editing a bank record',	1,	3,	1,	'',	381,	199,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 17:29:44',	1);

DROP TABLE IF EXISTS `permission_label`;
CREATE TABLE `permission_label` (
  `permission_label_id` int(100) NOT NULL AUTO_INCREMENT,
  `permission_label_track_number` varchar(100) NOT NULL,
  `permission_label_name` varchar(100) NOT NULL,
  `permission_label_description` varchar(100) NOT NULL,
  `fk_approval_id` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `permission_label_created_date` date NOT NULL,
  `permission_label_created_by` int(100) NOT NULL,
  `permission_label_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission_label_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`permission_label_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `permission_label` (`permission_label_id`, `permission_label_track_number`, `permission_label_name`, `permission_label_description`, `fk_approval_id`, `fk_status_id`, `permission_label_created_date`, `permission_label_created_by`, `permission_label_last_modified_date`, `permission_label_last_modified_by`) VALUES
(1,	'PBL-56069',	'create',	'Mark all permissions used to create a new record',	120,	50,	'2019-11-06',	1,	'2019-11-06 12:48:54',	1),
(2,	'PBL-32200',	'read',	'Mark all permissions used to read a record',	121,	50,	'2019-11-06',	1,	'2019-11-06 12:51:56',	1),
(3,	'PBL-37242',	'update',	'Mark all permissions for updating a record',	122,	50,	'2019-11-06',	1,	'2019-11-06 12:52:25',	1),
(4,	'PBL-14166',	'delete',	'Mark all permissions used to delete a record',	123,	50,	'2019-11-06',	1,	'2019-11-06 12:52:43',	1);

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
  `fk_status_id` int(11) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `project_allocation_extended_end_date` date DEFAULT NULL,
  `project_allocation_created_date` date DEFAULT NULL,
  `project_allocation_last_modified_date` varchar(45) DEFAULT NULL,
  `project_allocation_created_by` int(100) DEFAULT NULL,
  `project_allocation_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_allocation_id`),
  KEY `fk_project_id` (`fk_project_id`),
  KEY `fk_center_id` (`fk_center_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `project_allocation_ibfk_1` FOREIGN KEY (`fk_project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `project_allocation_ibfk_2` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`),
  CONSTRAINT `project_allocation_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `project_allocation_ibfk_4` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `project_allocation` (`project_allocation_id`, `project_allocation_track_number`, `fk_project_id`, `project_allocation_name`, `project_allocation_amount`, `project_allocation_is_active`, `fk_center_id`, `fk_status_id`, `fk_approval_id`, `project_allocation_extended_end_date`, `project_allocation_created_date`, `project_allocation_last_modified_date`, `project_allocation_created_by`, `project_allocation_last_modified_by`) VALUES
(2,	'PAL-86874',	4,	'Complementary Intervention 1',	560000.00,	1,	9,	44,	154,	'2019-11-07',	'2019-11-07',	NULL,	1,	1),
(3,	'PRON-21067',	4,	'Complementary Intervention 2',	1700000.00,	1,	9,	44,	156,	'2019-11-07',	'2019-11-07',	NULL,	1,	1),
(4,	'PRON-47096',	4,	'CIV 3',	250000.00,	1,	9,	44,	158,	'2019-11-07',	'2019-11-07',	NULL,	1,	1);

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
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `request` (`request_id`, `request_track_number`, `request_name`, `fk_status_id`, `fk_center_id`, `fk_approval_id`, `request_date`, `request_description`, `request_created_date`, `request_created_by`, `request_last_modified_by`, `request_last_modified_date`, `request_deleted_at`) VALUES
(84,	'REQ-15134',	'Test Request',	14,	9,	155,	'2019-11-07',	'Test Request',	'2019-11-07',	'1',	'1',	'2019-11-07 13:38:01',	NULL),
(85,	'REST-84293',	'Another request',	14,	9,	159,	'2019-11-07',	'Another request',	'2019-11-07',	'1',	'1',	'2019-11-07 17:23:55',	NULL),
(86,	'REST-35895',	'Tested',	14,	9,	204,	'2019-11-11',	'Tested',	'2019-11-11',	'1',	'1',	'2019-11-11 07:54:25',	NULL);

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
  CONSTRAINT `fk_request_detail_request1` FOREIGN KEY (`fk_request_id`) REFERENCES `request` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `request_detail_ibfk_1` FOREIGN KEY (`fk_request_id`) REFERENCES `request` (`request_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `request_detail` (`request_detail_id`, `request_detail_track_number`, `fk_request_id`, `request_detail_description`, `request_detail_quantity`, `request_detail_unit_cost`, `request_detail_total_cost`, `fk_expense_account_id`, `fk_project_allocation_id`, `fk_status_id`, `fk_approval_id`, `request_detail_created_date`, `request_detail_created_by`, `request_detail_last_modified_by`, `request_detail_last_modified_date`) VALUES
(104,	'RQD-67934',	84,	'Test ',	50,	1200.00,	60000.00,	1,	2,	1,	NULL,	'2019-11-07',	1,	1,	'2019-11-07 13:38:01'),
(105,	'REIL-9736',	85,	'Test 2',	100,	600.00,	6000.00,	2,	3,	1,	NULL,	'2019-11-07',	1,	1,	'2019-11-07 17:23:55'),
(106,	'REIL-63352',	85,	'Test 3',	150,	650.00,	97500.00,	1,	2,	1,	NULL,	'2019-11-07',	1,	1,	'2019-11-07 17:23:55'),
(107,	'REIL-61548',	86,	'Tested',	115,	255.00,	29325.00,	1,	2,	1,	NULL,	'2019-11-11',	1,	1,	'2019-11-11 07:54:25');

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(100) NOT NULL AUTO_INCREMENT,
  `role_track_number` varchar(100) DEFAULT NULL,
  `role_name` varchar(100) DEFAULT NULL,
  `role_shortname` varchar(50) NOT NULL,
  `role_description` longtext,
  `role_is_active` int(5) DEFAULT NULL,
  `role_created_by` int(100) DEFAULT NULL,
  `role_created_date` date DEFAULT NULL,
  `role_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_last_modified_by` varchar(45) DEFAULT NULL,
  `role_deleted_at` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `role` (`role_id`, `role_track_number`, `role_name`, `role_shortname`, `role_description`, `role_is_active`, `role_created_by`, `role_created_date`, `role_last_modified_date`, `role_last_modified_by`, `role_deleted_at`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'ROL-65362',	'Department Manager',	'departmentmanager',	'Department Manager',	1,	1,	'2019-11-04',	'2019-11-06 06:08:14',	'1',	NULL,	150,	46),
(2,	'ROLE-86037',	'Finance Director',	'financedirector',	'Finance Director',	1,	1,	'2019-11-08',	'2019-11-08 10:06:09',	'1',	NULL,	167,	46),
(3,	'ROLE-23190',	'Center Accountant',	'centeraccountant',	'A Center Accountant',	1,	1,	'2019-11-08',	'2019-11-08 11:38:04',	'1',	NULL,	175,	46);

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

INSERT INTO `role_permission` (`role_permission_id`, `role_permission_track_number`, `role_permission_name`, `role_permission_is_active`, `fk_role_id`, `fk_permission_id`, `fk_approval_id`, `fk_status_id`, `role_permission_created_date`, `role_permission_created_by`, `role_permission_last_modified_date`, `role_permission_last_modified_by`) VALUES
(1,	'ROON-32271',	'Department manager listing banks',	1,	1,	18,	163,	48,	'2019-11-08',	1,	'2019-11-08 09:23:41',	1),
(2,	'ROON-23380',	'Department manager adding a bank',	1,	1,	19,	164,	48,	'2019-11-08',	1,	'2019-11-08 09:24:14',	1),
(3,	'ROON-53265',	'Department manager can change bank status',	1,	1,	21,	166,	48,	'2019-11-08',	1,	'2019-11-08 09:57:44',	1),
(4,	'ROON-88427',	'Finance Director listing banks',	1,	2,	18,	168,	48,	'2019-11-08',	1,	'2019-11-08 10:09:04',	1),
(5,	'ROON-85843',	'Finance Director Adding banks',	1,	2,	19,	169,	48,	'2019-11-08',	1,	'2019-11-08 10:09:34',	1),
(6,	'ROON-44018',	'List requests for Finance director',	1,	2,	22,	173,	48,	'2019-11-08',	1,	'2019-11-08 11:34:43',	1),
(7,	'ROON-9358',	'Add requests by Finance director',	1,	2,	23,	174,	48,	'2019-11-08',	1,	'2019-11-08 11:35:07',	1),
(8,	'ROON-30396',	'Finance Director can see the center name when adding a voucher on behalf of a center',	1,	2,	25,	187,	48,	'2019-11-08',	1,	'2019-11-08 12:39:25',	1),
(9,	'ROON-41670',	'List vouchers to Center Accountant',	1,	3,	26,	190,	48,	'2019-11-08',	1,	'2019-11-08 12:48:05',	1),
(10,	'ROON-77186',	'Allow center accountant to add a voucher',	1,	3,	27,	191,	48,	'2019-11-08',	1,	'2019-11-08 12:48:32',	1),
(11,	'ROON-72193',	'Show the voucher detail description field',	1,	2,	28,	193,	48,	'2019-11-08',	1,	'2019-11-08 13:31:03',	1),
(12,	'ROON-40527',	'Show voucher list to Finance Director',	1,	2,	26,	194,	48,	'2019-11-08',	1,	'2019-11-08 14:17:53',	1),
(13,	'ROON-58711',	'Add a voucher by Finance Director',	1,	2,	27,	195,	48,	'2019-11-08',	1,	'2019-11-08 14:18:12',	1),
(14,	'ROON-38943',	'Department manager able to update bank status',	1,	1,	29,	198,	48,	'2019-11-08',	1,	'2019-11-08 17:28:08',	1),
(15,	'ROON-76668',	'Department Manager editing a bank',	1,	1,	30,	200,	48,	'2019-11-08',	1,	'2019-11-08 17:31:28',	1),
(16,	'ROON-28987',	'Finance director editing a bank',	1,	2,	30,	201,	48,	'2019-11-08',	1,	'2019-11-08 17:31:49',	1);

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
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`status_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  CONSTRAINT `status_ibfk_2` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`status_id`, `status_name`, `status_action_label`, `fk_approve_item_id`, `status_approval_sequence`, `status_approval_direction`, `status_is_requiring_approver_action`, `fk_role_id`, `status_created_date`, `status_created_by`, `status_last_modified_date`, `status_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'New',	'',	1,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(2,	'Submitted',	'Submit',	1,	'2',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(3,	'Approved By Head of Department',	'Approve',	1,	'3',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(4,	'Declined By Head of Department',	'Decline',	1,	'3',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(5,	'Approved By Finance Director',	'Approve',	1,	'4',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(6,	'Declined By Finance Director',	'Decline',	1,	'4',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(7,	'Paid By Accountant',	'Pay',	1,	'5',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(8,	'Reinstate to Head of Department',	'Reinstate',	1,	'3',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(9,	'Reinstate to Finance Director',	'Reinstate',	1,	'4',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(10,	'Submitted',	'Submit',	2,	'1',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:05:19',	0,	NULL,	NULL),
(11,	'Approved By Finance Director',	'Approve',	2,	'2',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(12,	'Declined By Finance Director',	'Decline',	2,	'2',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(13,	'Reinstated to Finance Director',	'Reinstate',	2,	'2',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(14,	'New',	'',	3,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(15,	'Submitted',	'Submit',	3,	'2',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(16,	'Approved By Head of Department',	'Approve',	3,	'3',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(17,	'Declined Approved By Head of Department',	'Decline',	3,	'3',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(18,	'Approved By Finance Director',	'Approve',	3,	'4',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(19,	'Declined By Finance Director',	'Decline',	3,	'4',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(20,	'Paid By Accountant',	'Pay',	3,	'5',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(21,	'Reinstate to Head of Department',	'Reinstate',	3,	'3',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(22,	'Reinstate to Finance Director',	'Reinstate',	3,	'4',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(23,	'New',	'',	4,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(30,	'New',	'',	5,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(33,	'New',	'',	8,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(34,	'New',	'',	9,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(38,	'New',	'',	13,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(39,	'New',	'',	14,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(43,	'New',	'',	18,	'1',	1,	0,	1,	'2019-10-25',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(44,	'New',	'',	19,	'1',	1,	0,	1,	'2019-11-03',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(45,	'New',	'',	20,	'1',	1,	0,	1,	'2019-11-03',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(46,	'New',	'',	21,	'1',	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(47,	'New',	'',	22,	'1',	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(48,	'New',	'',	23,	'1',	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(49,	'New',	'',	24,	'1',	1,	0,	1,	'2019-11-05',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(50,	'New',	'',	25,	'1',	1,	0,	1,	'2019-11-06',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(51,	'New',	'',	26,	'1',	1,	0,	1,	'2019-11-06',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(52,	'New',	'',	27,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(53,	'New',	'',	28,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(54,	'New',	'',	29,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(55,	'New',	'',	30,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(56,	'New',	'',	31,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(57,	'New',	'',	32,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL);

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
  CONSTRAINT `status_role_ibfk_4` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE,
  CONSTRAINT `status_role_ibfk_5` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status_role` (`status_role_id`, `status_role_track_number`, `status_role_name`, `fk_role_id`, `fk_status_id`, `status_role_created_by`, `status_role_created_date`, `status_role_last_modified_by`, `status_role_last_modified_date`) VALUES
(6,	'STR-55865',	'',	1,	3,	0,	'2019-10-16 22:44:55',	0,	'2019-10-16 22:39:16'),
(7,	'STR-55865',	'',	1,	4,	0,	'2019-10-16 22:45:28',	0,	'2019-10-16 22:39:16');

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
  `user_firstname` varchar(100) DEFAULT NULL,
  `user_lastname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `fk_center_group_link_id` int(100) DEFAULT NULL,
  `user_is_center_group_manager` int(5) DEFAULT NULL,
  `user_system_admin` int(5) DEFAULT '0',
  `fk_language_id` int(100) DEFAULT NULL COMMENT 'User''s default language',
  `user_is_active` int(5) DEFAULT '1',
  `fk_role_id` int(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_created_date` date DEFAULT NULL,
  `user_created_by` int(100) DEFAULT NULL,
  `user_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_modifed_by` int(100) DEFAULT NULL,
  `user_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `fk_role_id` (`fk_role_id`),
  KEY `fk_language_id` (`fk_language_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`fk_language_id`) REFERENCES `language` (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`user_id`, `user_track_number`, `user_name`, `user_firstname`, `user_lastname`, `user_email`, `fk_center_group_link_id`, `user_is_center_group_manager`, `user_system_admin`, `fk_language_id`, `user_is_active`, `fk_role_id`, `user_password`, `user_created_date`, `user_created_by`, `user_last_modified_date`, `user_last_modifed_by`, `user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'USR-84763',	'nkarisa',	'Nicodemus',	'Karisa',	'nkmwambs@gmail.com',	NULL,	NULL,	1,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	NULL,	NULL,	'2019-11-07 07:54:59',	NULL,	NULL,	NULL,	NULL),
(2,	'USER-24279',	'nkmwambs2',	'Nicodemus 2',	'Karisa 2',	'nkmwambs2@gmail.com',	NULL,	NULL,	0,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 07:21:31',	NULL,	1,	160,	54),
(4,	'USER-85054',	'jcherono',	'Joyce',	'Cherono',	'jcherono@gmail.com',	NULL,	NULL,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 07:55:20',	NULL,	1,	162,	54),
(5,	'USER-35106',	'dmbitsi',	'David',	'Mbitsi',	'davidm@gmail.com',	NULL,	NULL,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 11:57:17',	NULL,	1,	176,	54),
(6,	'USER-8011',	'bkanze',	'Betty',	'Kanze',	'byeri@gmail.com',	NULL,	NULL,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:14:22',	NULL,	1,	177,	54),
(7,	'USER-74028',	'onduso',	'Livingstone',	'Onduso',	'onduso@gmail.com',	NULL,	NULL,	1,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:16:01',	NULL,	1,	178,	54),
(8,	'USER-56932',	'jkoi',	'John',	'Koi',	'jkoi@gmail.com',	NULL,	NULL,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:18:44',	NULL,	1,	179,	54),
(9,	'USER-42367',	'mapenzi',	'Mapenzi',	'Amani',	'mapenzi@gmail.com',	NULL,	NULL,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:23:24',	NULL,	1,	180,	54),
(10,	'USER-14904',	'hellen',	'Hellen',	'Bahati',	'hellen@gmail.com',	NULL,	NULL,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:24:18',	NULL,	1,	181,	54),
(11,	'USER-45040',	'trizer',	'Trizer',	'Bethuel',	'trizer@gmail.com',	NULL,	NULL,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:26:22',	NULL,	1,	182,	54);

DROP TABLE IF EXISTS `user_detail`;
CREATE TABLE `user_detail` (
  `user_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_detail_track_number` varchar(100) NOT NULL,
  `user_detail_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_user_setting_id` int(100) NOT NULL,
  `user_detail_value` varchar(100) NOT NULL,
  `user_detail_created_date` date NOT NULL,
  `user_detail_created_by` int(100) NOT NULL,
  `user_detail_last_modified_by` int(100) NOT NULL,
  `user_detail_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_detail_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_user_setting_id` (`fk_user_setting_id`),
  CONSTRAINT `user_detail_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_detail_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `user_detail_ibfk_3` FOREIGN KEY (`fk_user_setting_id`) REFERENCES `user_setting` (`user_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_detail` (`user_detail_id`, `user_detail_track_number`, `user_detail_name`, `fk_user_id`, `fk_user_setting_id`, `user_detail_value`, `user_detail_created_date`, `user_detail_created_by`, `user_detail_last_modified_by`, `user_detail_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(2,	'USD-84979',	'User default Launch Page',	1,	2,	'role',	'2019-11-07',	1,	1,	'2019-11-07 10:55:28',	144,	52);

DROP TABLE IF EXISTS `user_setting`;
CREATE TABLE `user_setting` (
  `user_setting_id` int(100) NOT NULL AUTO_INCREMENT,
  `user_setting_track_number` varchar(100) NOT NULL,
  `user_setting_name` varchar(100) NOT NULL,
  `user_setting_created_date` date NOT NULL,
  `user_setting_created_by` int(100) NOT NULL,
  `user_setting_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_setting_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user_setting` (`user_setting_id`, `user_setting_track_number`, `user_setting_name`, `user_setting_created_date`, `user_setting_created_by`, `user_setting_last_modified_date`, `user_setting_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(2,	'USS-89769',	'default_launch_page',	'2019-11-07',	1,	'2019-11-07 10:51:19',	1,	143,	55);

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
(1,	'VOER-81182',	'Voucher # VOER-81182',	191101,	9,	'2019-11-08',	2,	196,	10,	0,	'0000-00-00',	'0000-00-00',	'Testing',	'Testing',	0,	2,	'2019-11-08',	'2019-11-08 15:43:40',	2),
(3,	'VOER-81997',	'Voucher # VOER-81997',	191102,	9,	'2019-11-11',	2,	203,	10,	0,	'0000-00-00',	'0000-00-00',	'Test',	'Test',	0,	1,	'2019-11-11',	'2019-11-11 07:43:19',	1);

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
  `fk_income_account_id` int(100) NOT NULL DEFAULT '0',
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
(1,	'VOIL-16222',	1,	'Testing',	100,	1500.00,	150000.00,	2,	0,	NULL,	39,	2,	NULL,	'2',	2,	'2019-11-08'),
(2,	'VOIL-62288',	3,	'Trial',	25,	2500.00,	62500.00,	2,	0,	NULL,	39,	3,	NULL,	'1',	1,	'2019-11-11');

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


-- 2019-11-11 08:13:01

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
  `account_system_code` varchar(10) NOT NULL,
  `account_system_is_allocation_linked_to_account` int(5) NOT NULL,
  `account_system_is_active` int(5) NOT NULL DEFAULT '1',
  `account_system_created_date` date DEFAULT NULL,
  `account_system_created_by` int(100) DEFAULT NULL,
  `account_system_last_modified_by` int(100) DEFAULT NULL,
  `account_system_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`account_system_id`),
  UNIQUE KEY `account_system_code` (`account_system_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `account_system` (`account_system_id`, `account_system_track_number`, `account_system_name`, `account_system_code`, `account_system_is_allocation_linked_to_account`, `account_system_is_active`, `account_system_created_date`, `account_system_created_by`, `account_system_last_modified_by`, `account_system_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'ACEM-14749',	'Global Account System',	'global',	0,	1,	'2020-08-20',	1,	1,	NULL,	1,	0);

DROP TABLE IF EXISTS `approval`;
CREATE TABLE `approval` (
  `approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `approval_track_number` varchar(100) NOT NULL,
  `approval_name` varchar(100) NOT NULL,
  `fk_approve_item_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  `approval_created_by` int(100) NOT NULL,
  `approval_created_date` date NOT NULL,
  `approval_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `approval_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`approval_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  KEY `fk_status_id` (`fk_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approval` (`approval_id`, `approval_track_number`, `approval_name`, `fk_approve_item_id`, `fk_status_id`, `approval_created_by`, `approval_created_date`, `approval_last_modified_date`, `approval_last_modified_by`) VALUES
(1,	'APAL-41824',	'Approval Ticket # APAL-41824',	1,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(2,	'APAL-79590',	'Approval Ticket # APAL-79590',	19,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(3,	'APAL-10642',	'Approval Ticket # APAL-10642',	19,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(4,	'APAL-6864',	'Approval Ticket # APAL-6864',	19,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(5,	'APAL-66972',	'Approval Ticket # APAL-66972',	19,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(6,	'APAL-75864',	'Approval Ticket # APAL-75864',	19,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(7,	'APAL-83431',	'Approval Ticket # APAL-83431',	19,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(8,	'APAL-79971',	'Approval Ticket # APAL-79971',	46,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(9,	'APAL-68767',	'Approval Ticket # APAL-68767',	20,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(10,	'APAL-82017',	'Approval Ticket # APAL-82017',	39,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(11,	'APAL-51618',	'Approval Ticket # APAL-51618',	71,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(12,	'APAL-28506',	'Approval Ticket # APAL-28506',	78,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(13,	'APAL-44444',	'Approval Ticket # APAL-44444',	31,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(14,	'APAL-45974',	'Approval Ticket # APAL-45974',	21,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(15,	'APAL-50705',	'Approval Ticket # APAL-50705',	83,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(16,	'APAL-5423',	'Approval Ticket # APAL-5423',	83,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(17,	'APAL-19195',	'Approval Ticket # APAL-19195',	84,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(18,	'APAL-1364',	'Approval Ticket # APAL-1364',	84,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(19,	'APAL-52078',	'Approval Ticket # APAL-52078',	84,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(20,	'APAL-11919',	'Approval Ticket # APAL-11919',	84,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(21,	'APAL-40195',	'Approval Ticket # APAL-40195',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(22,	'APAL-15454',	'Approval Ticket # APAL-15454',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(23,	'APAL-79977',	'Approval Ticket # APAL-79977',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(24,	'APAL-31433',	'Approval Ticket # APAL-31433',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(25,	'APAL-55641',	'Approval Ticket # APAL-55641',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(26,	'APAL-5610',	'Approval Ticket # APAL-5610',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(27,	'APAL-56274',	'Approval Ticket # APAL-56274',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(28,	'APAL-72891',	'Approval Ticket # APAL-72891',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(29,	'APAL-87403',	'Approval Ticket # APAL-87403',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(30,	'APAL-35389',	'Approval Ticket # APAL-35389',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(31,	'APAL-16202',	'Approval Ticket # APAL-16202',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(32,	'APAL-46572',	'Approval Ticket # APAL-46572',	45,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(33,	'APAL-82932',	'Approval Ticket # APAL-82932',	25,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(34,	'APAL-27312',	'Approval Ticket # APAL-27312',	1,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1);

DROP TABLE IF EXISTS `approval_flow`;
CREATE TABLE `approval_flow` (
  `approval_flow_id` int(100) NOT NULL AUTO_INCREMENT,
  `approval_flow_name` varchar(100) NOT NULL,
  `approval_flow_track_number` varchar(100) NOT NULL,
  `fk_approve_item_id` int(100) NOT NULL,
  `fk_account_system_id` int(100) NOT NULL,
  `approval_flow_created_by` int(100) NOT NULL,
  `approval_flow_created_date` date NOT NULL,
  `approval_flow_last_modified_by` int(100) NOT NULL,
  `approval_flow_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`approval_flow_id`),
  KEY `fk_approve_item_id` (`fk_approve_item_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  CONSTRAINT `approval_flow_ibfk_1` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `approval_flow_ibfk_2` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approval_flow` (`approval_flow_id`, `approval_flow_name`, `approval_flow_track_number`, `fk_approve_item_id`, `fk_account_system_id`, `approval_flow_created_by`, `approval_flow_created_date`, `approval_flow_last_modified_by`, `approval_flow_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'Global Account System account system workflow',	'APOW-15812',	1,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(2,	'Global Account System approval workflow',	'APOW-71503',	2,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(3,	'Global Account System bank workflow',	'APOW-27312',	5,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(4,	'Global Account System budget workflow',	'APOW-69058',	6,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(5,	'Global Account System budget item workflow',	'APOW-1194',	7,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(6,	'Global Account System budget item detail workflow',	'APOW-5882',	8,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(7,	'Global Account System cheque book workflow',	'APOW-6840',	9,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(8,	'Global Account System context center workflow',	'APOW-23978',	11,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(9,	'Global Account System context center user workflow',	'APOW-46793',	12,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(10,	'Global Account System context cluster workflow',	'APOW-40074',	13,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(11,	'Global Account System context cluster user workflow',	'APOW-40685',	14,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(12,	'Global Account System context cohort workflow',	'APOW-19794',	15,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(13,	'Global Account System context cohort user workflow',	'APOW-87306',	16,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(14,	'Global Account System context country workflow',	'APOW-45714',	17,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(15,	'Global Account System context country user workflow',	'APOW-18966',	18,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(16,	'Global Account System context definition workflow',	'APOW-29669',	19,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(17,	'Global Account System context global workflow',	'APOW-27229',	20,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(18,	'Global Account System context global user workflow',	'APOW-34029',	21,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(19,	'Global Account System context region workflow',	'APOW-81549',	22,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(20,	'Global Account System context region user workflow',	'APOW-19166',	23,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(21,	'Global Account System contra account workflow',	'APOW-12675',	24,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	NULL),
(22,	'Global Account System country currency workflow',	'APOW-78423',	25,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(23,	'Global Account System currency conversion workflow',	'APOW-29866',	26,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(24,	'Global Account System currency conversion detail workflow',	'APOW-19053',	27,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(25,	'Global Account System dashboard workflow',	'APOW-74268',	28,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(26,	'Global Account System department workflow',	'APOW-38673',	29,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(27,	'Global Account System department user workflow',	'APOW-44779',	30,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(28,	'Global Account System designation workflow',	'APOW-27778',	31,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(29,	'Global Account System expense account workflow',	'APOW-84017',	32,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(30,	'Global Account System financial report workflow',	'APOW-62712',	33,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(31,	'Global Account System funder workflow',	'APOW-82846',	34,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(32,	'Global Account System funding status workflow',	'APOW-86373',	35,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(33,	'Global Account System history workflow',	'APOW-6390',	36,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(34,	'Global Account System income account workflow',	'APOW-57987',	37,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(35,	'Global Account System journal workflow',	'APOW-79757',	38,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(36,	'Global Account System language workflow',	'APOW-25991',	39,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(37,	'Global Account System language phrase workflow',	'APOW-5556',	40,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(38,	'Global Account System menu workflow',	'APOW-28221',	41,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(39,	'Global Account System menu user order workflow',	'APOW-7050',	42,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(40,	'Global Account System message workflow',	'APOW-61867',	43,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(41,	'Global Account System message detail workflow',	'APOW-35316',	44,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(42,	'Global Account System month workflow',	'APOW-61051',	45,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(43,	'Global Account System office workflow',	'APOW-48485',	46,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(44,	'Global Account System office bank workflow',	'APOW-66654',	47,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(45,	'Global Account System office bank project allocation workflow',	'APOW-71292',	48,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(46,	'Global Account System office cash workflow',	'APOW-77593',	49,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(47,	'Global Account System opening allocation balance workflow',	'APOW-71584',	50,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(48,	'Global Account System opening bank balance workflow',	'APOW-52941',	51,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(49,	'Global Account System opening cash balance workflow',	'APOW-47985',	52,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(50,	'Global Account System opening deposit transit workflow',	'APOW-28126',	53,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(51,	'Global Account System opening fund balance workflow',	'APOW-59261',	54,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(52,	'Global Account System opening outstanding cheque workflow',	'APOW-75065',	55,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(53,	'Global Account System page view workflow',	'APOW-6271',	56,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(54,	'Global Account System page view condition workflow',	'APOW-38647',	57,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(55,	'Global Account System page view role workflow',	'APOW-32306',	58,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(56,	'Global Account System permission workflow',	'APOW-6858',	59,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(57,	'Global Account System permission label workflow',	'APOW-58221',	60,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(58,	'Global Account System project workflow',	'APOW-56171',	61,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(59,	'Global Account System project allocation workflow',	'APOW-47312',	62,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(60,	'Global Account System project allocation detail workflow',	'APOW-27851',	63,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(61,	'Global Account System project cost proportion workflow',	'APOW-38263',	64,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(62,	'Global Account System project income account workflow',	'APOW-11770',	65,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(63,	'Global Account System reconciliation workflow',	'APOW-76259',	66,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(64,	'Global Account System request workflow',	'APOW-79559',	67,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(65,	'Global Account System request detail workflow',	'APOW-12180',	69,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(66,	'Global Account System request conversion workflow',	'APOW-87681',	68,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(67,	'Global Account System request type workflow',	'APOW-49993',	70,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(68,	'Global Account System role workflow',	'APOW-18240',	71,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(69,	'Global Account System role permission workflow',	'APOW-33646',	72,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(70,	'Global Account System setting workflow',	'APOW-32038',	73,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(71,	'Global Account System status role workflow',	'APOW-11286',	75,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(72,	'Global Account System system opening balance workflow',	'APOW-85974',	76,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:50',	NULL,	NULL),
(73,	'Global Account System translation workflow',	'APOW-42064',	77,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(74,	'Global Account System user workflow',	'APOW-48566',	78,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(75,	'Global Account System variance note workflow',	'APOW-66627',	79,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(76,	'Global Account System voucher workflow',	'APOW-46601',	80,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(77,	'Global Account System voucher detail workflow',	'APOW-1154',	81,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(78,	'Global Account System voucher type workflow',	'APOW-18457',	82,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(79,	'Global Account System voucher type account workflow',	'APOW-8646',	83,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(80,	'Global Account System voucher type effect workflow',	'APOW-84237',	84,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(81,	'Global Account System workplan workflow',	'APOW-52269',	85,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL),
(82,	'Global Account System workplan task workflow',	'APOW-36156',	86,	1,	1,	'2020-08-20',	1,	'2020-08-20 12:01:51',	NULL,	NULL);

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
  PRIMARY KEY (`approve_item_id`),
  UNIQUE KEY `approve_item_name` (`approve_item_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `approve_item` (`approve_item_id`, `approve_item_track_number`, `approve_item_name`, `approve_item_is_active`, `approve_item_created_date`, `approve_item_created_by`, `approve_item_last_modified_date`, `approve_item_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'APEM-38919',	'account_system',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(2,	'APEM-37055',	'approval',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(3,	'APEM-42407',	'approval_flow',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(4,	'APEM-56636',	'approve_item',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(5,	'APEM-67430',	'bank',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(6,	'APEM-58047',	'budget',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(7,	'APEM-45112',	'budget_item',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(8,	'APEM-33690',	'budget_item_detail',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(9,	'APEM-86476',	'cheque_book',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(10,	'APEM-56923',	'ci_sessions',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(11,	'APEM-43269',	'context_center',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(12,	'APEM-30022',	'context_center_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(13,	'APEM-56388',	'context_cluster',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(14,	'APEM-11860',	'context_cluster_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(15,	'APEM-6531',	'context_cohort',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(16,	'APEM-1432',	'context_cohort_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(17,	'APEM-1767',	'context_country',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(18,	'APEM-75077',	'context_country_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(19,	'APEM-47140',	'context_definition',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(20,	'APEM-31871',	'context_global',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(21,	'APEM-37923',	'context_global_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(22,	'APEM-1197',	'context_region',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(23,	'APEM-18594',	'context_region_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(24,	'APEM-36647',	'contra_account',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(25,	'APEM-83189',	'country_currency',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(26,	'APEM-6304',	'currency_conversion',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(27,	'APEM-26186',	'currency_conversion_detail',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(28,	'APEM-70886',	'dashboard',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(29,	'APEM-35596',	'department',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(30,	'APEM-41023',	'department_user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(31,	'APEM-21947',	'designation',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(32,	'APEM-73482',	'expense_account',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(33,	'APEM-79474',	'financial_report',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(34,	'APEM-19734',	'funder',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(35,	'APEM-82943',	'funding_status',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(36,	'APEM-35272',	'history',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(37,	'APEM-21647',	'income_account',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(38,	'APEM-11753',	'journal',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(39,	'APEM-62562',	'language',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(40,	'APEM-49234',	'language_phrase',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(41,	'APEM-80940',	'menu',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(42,	'APEM-72423',	'menu_user_order',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(43,	'APEM-66517',	'message',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(44,	'APEM-57542',	'message_detail',	0,	'2020-08-20',	1,	'2020-08-20 12:01:48',	1,	NULL,	NULL),
(45,	'APEM-28284',	'month',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(46,	'APEM-80820',	'office',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(47,	'APEM-84293',	'office_bank',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(48,	'APEM-89145',	'office_bank_project_allocation',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(49,	'APEM-68941',	'office_cash',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(50,	'APEM-46570',	'opening_allocation_balance',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(51,	'APEM-79609',	'opening_bank_balance',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(52,	'APEM-2773',	'opening_cash_balance',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(53,	'APEM-62786',	'opening_deposit_transit',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(54,	'APEM-48908',	'opening_fund_balance',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(55,	'APEM-10110',	'opening_outstanding_cheque',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(56,	'APEM-5476',	'page_view',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(57,	'APEM-3052',	'page_view_condition',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(58,	'APEM-85624',	'page_view_role',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(59,	'APEM-32124',	'permission',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(60,	'APEM-70201',	'permission_label',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(61,	'APEM-78158',	'project',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(62,	'APEM-89865',	'project_allocation',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(63,	'APEM-13305',	'project_allocation_detail',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(64,	'APEM-11319',	'project_cost_proportion',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(65,	'APEM-89415',	'project_income_account',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(66,	'APEM-65124',	'reconciliation',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(67,	'APEM-40510',	'request',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(68,	'APEM-14430',	'request_conversion',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(69,	'APEM-17513',	'request_detail',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(70,	'APEM-38176',	'request_type',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(71,	'APEM-22741',	'role',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(72,	'APEM-6478',	'role_permission',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(73,	'APEM-84192',	'setting',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(74,	'APEM-56900',	'status',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(75,	'APEM-85567',	'status_role',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(76,	'APEM-34999',	'system_opening_balance',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(77,	'APEM-48004',	'translation',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(78,	'APEM-5651',	'user',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(79,	'APEM-11745',	'variance_note',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(80,	'APEM-70404',	'voucher',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(81,	'APEM-88506',	'voucher_detail',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(82,	'APEM-10001',	'voucher_type',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(83,	'APEM-44972',	'voucher_type_account',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(84,	'APEM-76426',	'voucher_type_effect',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(85,	'APEM-49563',	'workplan',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(86,	'APEM-18091',	'workplan_task',	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `bank_track_number` varchar(100) DEFAULT NULL,
  `bank_name` varchar(45) DEFAULT NULL,
  `bank_swift_code` varchar(45) DEFAULT NULL,
  `bank_is_active` int(5) NOT NULL DEFAULT '1',
  `fk_account_system_id` int(100) NOT NULL DEFAULT '1',
  `bank_created_date` date DEFAULT NULL,
  `bank_created_by` int(100) DEFAULT NULL,
  `bank_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the banks for centers';


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
  CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`)
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
  `ci_sessions_created_date` date DEFAULT NULL,
  `ci_sessions_created_by` int(100) DEFAULT NULL,
  `ci_sessions_last_modified_by` int(100) DEFAULT NULL,
  `ci_sessions_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `context_center`;
CREATE TABLE `context_center` (
  `context_center_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_center_track_number` varchar(100) DEFAULT NULL,
  `context_center_name` varchar(100) DEFAULT NULL,
  `context_center_description` varchar(100) DEFAULT NULL,
  `fk_office_id` varchar(100) NOT NULL,
  `fk_context_definition_id` varchar(100) DEFAULT NULL,
  `fk_context_cluster_id` int(100) DEFAULT NULL,
  `context_center_created_date` date DEFAULT '0000-00-00',
  `context_center_created_by` int(100) DEFAULT NULL,
  `context_center_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_center_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_center_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_center_user`;
CREATE TABLE `context_center_user` (
  `context_center_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_center_user_track_number` varchar(100) DEFAULT NULL,
  `context_center_user_name` varchar(100) DEFAULT NULL,
  `fk_context_center_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_center_user_is_active` int(100) NOT NULL,
  `context_center_user_created_by` int(100) NOT NULL,
  `context_center_user_created_date` date DEFAULT '0000-00-00',
  `context_center_user_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_center_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_center_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_cluster`;
CREATE TABLE `context_cluster` (
  `context_cluster_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cluster_track_number` varchar(100) DEFAULT NULL,
  `context_cluster_name` varchar(100) DEFAULT NULL,
  `context_cluster_description` varchar(100) DEFAULT NULL,
  `fk_office_id` varchar(100) NOT NULL,
  `fk_context_definition_id` varchar(100) DEFAULT NULL,
  `fk_context_cohort_id` int(100) DEFAULT NULL,
  `context_cluster_created_date` date DEFAULT '0000-00-00',
  `context_cluster_created_by` int(100) DEFAULT NULL,
  `context_cluster_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_cluster_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_cluster_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_cluster_user`;
CREATE TABLE `context_cluster_user` (
  `context_cluster_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cluster_user_track_number` varchar(100) DEFAULT NULL,
  `context_cluster_user_name` varchar(100) DEFAULT NULL,
  `fk_context_cluster_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_cluster_user_is_active` int(100) NOT NULL,
  `context_cluster_user_created_by` int(100) NOT NULL,
  `context_cluster_user_created_date` date DEFAULT '0000-00-00',
  `context_cluster_user_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_cluster_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_cluster_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_cohort`;
CREATE TABLE `context_cohort` (
  `context_cohort_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cohort_track_number` varchar(100) DEFAULT NULL,
  `context_cohort_name` varchar(100) DEFAULT NULL,
  `context_cohort_description` varchar(100) DEFAULT NULL,
  `fk_office_id` varchar(100) NOT NULL,
  `fk_context_definition_id` varchar(100) DEFAULT NULL,
  `fk_context_country_id` int(100) DEFAULT NULL,
  `context_cohort_created_date` date DEFAULT '0000-00-00',
  `context_cohort_created_by` int(100) DEFAULT NULL,
  `context_cohort_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_cohort_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_cohort_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_cohort_user`;
CREATE TABLE `context_cohort_user` (
  `context_cohort_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_cohort_user_track_number` varchar(100) DEFAULT NULL,
  `context_cohort_user_name` varchar(100) DEFAULT NULL,
  `fk_context_cohort_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_cohort_user_is_active` int(100) NOT NULL,
  `context_cohort_user_created_by` int(100) NOT NULL,
  `context_cohort_user_created_date` date DEFAULT '0000-00-00',
  `context_cohort_user_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_cohort_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_cohort_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_country`;
CREATE TABLE `context_country` (
  `context_country_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_country_track_number` varchar(100) DEFAULT NULL,
  `context_country_name` varchar(100) DEFAULT NULL,
  `context_country_description` varchar(100) DEFAULT NULL,
  `fk_office_id` int(11) NOT NULL,
  `fk_context_definition_id` int(11) DEFAULT NULL,
  `fk_context_region_id` int(100) DEFAULT NULL,
  `context_country_created_date` date DEFAULT '0000-00-00',
  `context_country_created_by` int(100) DEFAULT NULL,
  `context_country_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_country_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_country_user`;
CREATE TABLE `context_country_user` (
  `context_country_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_country_user_track_number` varchar(100) DEFAULT NULL,
  `context_country_user_name` varchar(100) DEFAULT NULL,
  `fk_context_country_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_country_user_is_active` int(100) NOT NULL,
  `context_country_user_created_by` int(100) NOT NULL,
  `context_country_user_created_date` date DEFAULT '0000-00-00',
  `context_country_user_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_country_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_country_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_definition`;
CREATE TABLE `context_definition` (
  `context_definition_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_definition_track_number` varchar(100) DEFAULT NULL,
  `context_definition_name` varchar(100) DEFAULT NULL,
  `context_definition_level` int(5) DEFAULT NULL,
  `context_definition_is_implementing` int(5) DEFAULT NULL,
  `context_definition_is_active` int(5) NOT NULL DEFAULT '1',
  `context_definition_created_date` date DEFAULT NULL,
  `context_definition_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `context_definition_created_by` int(100) DEFAULT NULL,
  `context_definition_last_modified_by` int(100) DEFAULT NULL,
  `context_definition_deleted_at` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_definition_id`),
  UNIQUE KEY `center_group_hierarchy_level` (`context_definition_level`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  CONSTRAINT `context_definition_ibfk_1` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_definition_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_definition` (`context_definition_id`, `context_definition_track_number`, `context_definition_name`, `context_definition_level`, `context_definition_is_implementing`, `context_definition_is_active`, `context_definition_created_date`, `context_definition_last_modified_date`, `context_definition_created_by`, `context_definition_last_modified_by`, `context_definition_deleted_at`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COON-85304',	'center',	1,	1,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	NULL,	NULL,	NULL),
(2,	'COON-24098',	'cluster',	2,	1,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	NULL,	NULL,	NULL),
(3,	'COON-36220',	'cohort',	3,	1,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	NULL,	NULL,	NULL),
(4,	'COON-42271',	'country',	4,	1,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	NULL,	NULL,	NULL),
(5,	'COON-11285',	'region',	5,	1,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	NULL,	NULL,	NULL),
(6,	'COON-4637',	'global',	6,	1,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	NULL,	NULL,	NULL);

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
  PRIMARY KEY (`context_global_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_global` (`context_global_id`, `context_global_track_number`, `context_global_name`, `context_global_description`, `fk_office_id`, `fk_context_definition_id`, `context_global_created_date`, `context_global_created_by`, `context_global_last_modified_date`, `context_global_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COAL-63427',	'Head Office Context',	'Head Office Context',	1,	6,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	9,	0);

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
  `fk_approval_id` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  PRIMARY KEY (`context_global_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_global_user` (`context_global_user_id`, `context_global_user_track_number`, `context_global_user_name`, `fk_user_id`, `fk_context_global_id`, `fk_designation_id`, `context_global_user_is_active`, `context_global_user_created_date`, `context_global_user_last_modified_date`, `context_global_user_created_by`, `context_global_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COER-3729',	'System User',	1,	1,	13,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1,	1,	14,	0);

DROP TABLE IF EXISTS `context_region`;
CREATE TABLE `context_region` (
  `context_region_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_region_track_number` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `context_region_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `context_region_description` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `fk_office_id` int(11) NOT NULL,
  `fk_context_definition_id` int(11) NOT NULL,
  `fk_context_global_id` int(100) NOT NULL,
  `context_region_created_date` date DEFAULT '0000-00-00',
  `context_region_created_by` int(100) DEFAULT NULL,
  `context_region_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_region_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `context_region_user`;
CREATE TABLE `context_region_user` (
  `context_region_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_region_user_track_number` varchar(100) DEFAULT NULL,
  `context_region_user_name` varchar(100) DEFAULT NULL,
  `fk_context_region_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `context_region_user_is_active` int(100) NOT NULL,
  `context_region_user_created_by` int(100) NOT NULL,
  `context_region_user_created_date` date DEFAULT '0000-00-00',
  `context_region_user_last_modified_date` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `context_region_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_region_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `contra_account`;
CREATE TABLE `contra_account` (
  `contra_account_id` int(100) NOT NULL AUTO_INCREMENT,
  `contra_account_track_number` varchar(100) NOT NULL,
  `contra_account_name` varchar(100) NOT NULL,
  `contra_account_code` varchar(20) NOT NULL,
  `contra_account_description` varchar(100) NOT NULL,
  `fk_voucher_type_account_id` int(100) NOT NULL,
  `fk_office_bank_id` int(100) NOT NULL,
  `fk_account_system_id` int(100) NOT NULL,
  `contra_account_created_date` date DEFAULT NULL,
  `contra_account_created_by` int(100) DEFAULT NULL,
  `contra_account_last_modified_by` int(100) DEFAULT NULL,
  `contra_account_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`contra_account_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  KEY `fk_voucher_type_account_id` (`fk_voucher_type_account_id`),
  KEY `fk_office_bank_id` (`fk_office_bank_id`),
  CONSTRAINT `contra_account_ibfk_1` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`),
  CONSTRAINT `contra_account_ibfk_2` FOREIGN KEY (`fk_voucher_type_account_id`) REFERENCES `voucher_type_account` (`voucher_type_account_id`),
  CONSTRAINT `contra_account_ibfk_3` FOREIGN KEY (`fk_office_bank_id`) REFERENCES `office_bank` (`office_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `country_currency`;
CREATE TABLE `country_currency` (
  `country_currency_id` int(100) NOT NULL AUTO_INCREMENT,
  `country_currency_name` varchar(100) NOT NULL,
  `country_currency_track_number` varchar(100) NOT NULL,
  `country_currency_code` varchar(10) NOT NULL,
  `country_currency_created_by` int(100) NOT NULL,
  `country_currency_created_date` date NOT NULL,
  `country_currency_last_modified_by` int(100) NOT NULL,
  `country_currency_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`country_currency_id`),
  UNIQUE KEY `country_currency_code` (`country_currency_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `country_currency` (`country_currency_id`, `country_currency_name`, `country_currency_track_number`, `country_currency_code`, `country_currency_created_by`, `country_currency_created_date`, `country_currency_last_modified_by`, `country_currency_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'USD',	'COCY-69810',	'USD',	1,	'2020-08-20',	1,	'2020-08-20 12:01:49',	33,	0);

DROP TABLE IF EXISTS `currency_conversion`;
CREATE TABLE `currency_conversion` (
  `currency_conversion_id` int(100) NOT NULL AUTO_INCREMENT,
  `currency_conversion_name` varchar(100) NOT NULL,
  `currency_conversion_track_number` varchar(100) NOT NULL,
  `currency_conversion_month` date NOT NULL,
  `currency_conversion_created_date` date NOT NULL,
  `currency_conversion_created_by` int(100) NOT NULL,
  `currency_conversion_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `currency_conversion_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`currency_conversion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `currency_conversion_detail`;
CREATE TABLE `currency_conversion_detail` (
  `currency_conversion_detail_id` int(100) NOT NULL AUTO_INCREMENT,
  `currency_conversion_detail_name` varchar(100) NOT NULL,
  `currency_conversion_detail_track_number` varchar(100) NOT NULL,
  `fk_currency_conversion_id` int(100) NOT NULL,
  `fk_country_currency_id` int(100) NOT NULL,
  `currency_conversion_detail_rate` double(10,2) NOT NULL,
  `currency_conversion_detail_created_by` int(100) NOT NULL,
  `currency_conversion_detail_created_date` date NOT NULL,
  `currency_conversion_detail_last_modified_by` int(100) NOT NULL,
  `currency_conversion_detail_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`currency_conversion_detail_id`)
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
  `department_user_created_date` date DEFAULT NULL,
  `department_user_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `department_user_created_by` int(100) DEFAULT NULL,
  `department_user_last_modified_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`department_user_id`)
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
  `financial_report_statement_date` date NOT NULL DEFAULT '0000-00-00',
  `financial_report_is_submitted` int(5) NOT NULL DEFAULT '0',
  `financial_report_created_date` date DEFAULT NULL,
  `financial_report_created_by` int(100) DEFAULT NULL,
  `financial_report_last_modified_by` int(100) DEFAULT NULL,
  `financial_report_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`financial_report_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `funder`;
CREATE TABLE `funder` (
  `funder_id` int(100) NOT NULL AUTO_INCREMENT,
  `funder_track_number` varchar(100) DEFAULT NULL,
  `funder_name` varchar(45) DEFAULT NULL,
  `funder_description` varchar(45) DEFAULT NULL,
  `fk_account_system_id` int(100) DEFAULT NULL,
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
  `funding_status_track_number` varchar(100) DEFAULT NULL,
  `funding_status_name` varchar(100) DEFAULT NULL,
  `funding_status_is_active` int(5) DEFAULT NULL,
  `fk_account_system_id` int(100) DEFAULT NULL,
  `funding_status_created_date` date DEFAULT NULL,
  `funding_status_created_by` int(100) DEFAULT NULL,
  `funding_status_last_modified_by` int(100) DEFAULT NULL,
  `funding_status_last_modified_date` date DEFAULT NULL,
  `funding_status_is_available` int(5) NOT NULL DEFAULT '0',
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`funding_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `history_id` int(100) NOT NULL AUTO_INCREMENT,
  `reference_table` varchar(45) DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `table_action` varchar(45) DEFAULT NULL,
  `history_created_date` date DEFAULT NULL,
  `history_created_by` int(100) DEFAULT NULL,
  `history_last_modified_by` int(100) DEFAULT NULL,
  `history_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  `journal_last_modified_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`journal_id`)
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
(1,	'LAGE-42234',	'English',	'en',	'2020-08-20',	'2020-08-20 12:01:49',	NULL,	1,	1,	10,	0);

DROP TABLE IF EXISTS `language_phrase`;
CREATE TABLE `language_phrase` (
  `language_phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext,
  `created_date` date DEFAULT NULL,
  `last_modified_date` date DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `created_by` int(100) DEFAULT NULL,
  `last_modified_by` int(100) DEFAULT NULL,
  `language_phrase_created_date` date DEFAULT NULL,
  `language_phrase_created_by` int(100) DEFAULT NULL,
  `language_phrase_last_modified_by` int(100) DEFAULT NULL,
  `language_phrase_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_derivative_controller` (`menu_derivative_controller`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `menu_user_order`;
CREATE TABLE `menu_user_order` (
  `menu_user_order_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(100) NOT NULL,
  `menu_user_order_track_number` varchar(100) DEFAULT NULL,
  `menu_user_order_name` varchar(100) DEFAULT NULL,
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
  `month_order` int(5) NOT NULL DEFAULT '0',
  `fk_status_id` int(100) NOT NULL,
  `month_created_by` int(100) NOT NULL,
  `month_last_modified_by` int(100) NOT NULL,
  `month_created_date` date NOT NULL,
  `month_last_modified_date` date NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`month_id`),
  UNIQUE KEY `month_number` (`month_number`),
  UNIQUE KEY `month_order` (`month_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `month` (`month_id`, `month_track_number`, `month_number`, `month_name`, `month_order`, `fk_status_id`, `month_created_by`, `month_last_modified_by`, `month_created_date`, `month_last_modified_date`, `fk_approval_id`) VALUES
(1,	'MOTH-1375',	1,	'January',	1,	0,	1,	1,	'2020-08-20',	'0000-00-00',	21),
(2,	'MOTH-2590',	2,	'February',	2,	0,	1,	1,	'2020-08-20',	'0000-00-00',	22),
(3,	'MOTH-78171',	3,	'March',	3,	0,	1,	1,	'2020-08-20',	'0000-00-00',	23),
(4,	'MOTH-48550',	4,	'April',	4,	0,	1,	1,	'2020-08-20',	'0000-00-00',	24),
(5,	'MOTH-45398',	5,	'May',	5,	0,	1,	1,	'2020-08-20',	'0000-00-00',	25),
(6,	'MOTH-27703',	6,	'June',	6,	0,	1,	1,	'2020-08-20',	'0000-00-00',	26),
(7,	'MOTH-78602',	7,	'July',	7,	0,	1,	1,	'2020-08-20',	'0000-00-00',	27),
(8,	'MOTH-87313',	8,	'August',	8,	0,	1,	1,	'2020-08-20',	'0000-00-00',	28),
(9,	'MOTH-5546',	9,	'September',	9,	0,	1,	1,	'2020-08-20',	'0000-00-00',	29),
(10,	'MOTH-14644',	10,	'October',	10,	0,	1,	1,	'2020-08-20',	'0000-00-00',	30),
(11,	'MOTH-10413',	11,	'November',	11,	0,	1,	1,	'2020-08-20',	'0000-00-00',	31),
(12,	'MOTH-21433',	12,	'December',	12,	0,	1,	1,	'2020-08-20',	'0000-00-00',	32);

DROP TABLE IF EXISTS `office`;
CREATE TABLE `office` (
  `office_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_track_number` varchar(100) DEFAULT NULL,
  `office_name` varchar(45) NOT NULL,
  `office_description` longtext NOT NULL,
  `office_code` varchar(45) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `office_start_date` date NOT NULL,
  `office_end_date` date DEFAULT '0000-00-00',
  `office_is_active` int(5) NOT NULL DEFAULT '0',
  `fk_account_system_id` int(100) NOT NULL DEFAULT '1',
  `fk_country_currency_id` int(100) NOT NULL,
  `office_created_by` int(100) NOT NULL,
  `office_created_date` date NOT NULL,
  `office_last_modified_date` date NOT NULL,
  `office_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`office_id`),
  UNIQUE KEY `office_code` (`office_code`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_center_group_hierarchy_id` (`fk_context_definition_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the remote sites for the organization';

INSERT INTO `office` (`office_id`, `office_track_number`, `office_name`, `office_description`, `office_code`, `fk_context_definition_id`, `office_start_date`, `office_end_date`, `office_is_active`, `fk_account_system_id`, `fk_country_currency_id`, `office_created_by`, `office_created_date`, `office_last_modified_date`, `office_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'OFCE-41617',	'Head Office',	'Head Office',	'G001',	6,	'2020-08-01',	'0000-00-00',	1,	1,	1,	1,	'2020-08-20',	'0000-00-00',	1,	8,	0);

DROP TABLE IF EXISTS `office_bank`;
CREATE TABLE `office_bank` (
  `office_bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_bank_track_number` varchar(100) DEFAULT NULL,
  `office_bank_name` varchar(100) DEFAULT NULL,
  `office_bank_account_number` varchar(100) DEFAULT NULL,
  `fk_office_id` int(100) DEFAULT NULL,
  `fk_bank_id` int(100) DEFAULT NULL,
  `office_bank_is_active` int(5) DEFAULT '1',
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


DROP TABLE IF EXISTS `office_bank_project_allocation`;
CREATE TABLE `office_bank_project_allocation` (
  `office_bank_project_allocation_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_bank_project_allocation_name` varchar(100) NOT NULL,
  `office_bank_project_allocation_track_number` varchar(100) NOT NULL,
  `fk_office_bank_id` int(100) NOT NULL,
  `fk_project_allocation_id` int(100) NOT NULL,
  `office_bank_project_allocation_created_date` date NOT NULL,
  `office_bank_project_allocation_created_by` int(100) NOT NULL,
  `office_bank_project_allocation_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `office_bank_project_allocation_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`office_bank_project_allocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `office_cash`;
CREATE TABLE `office_cash` (
  `office_cash_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_cash_name` varchar(100) NOT NULL,
  `office_cash_track_number` varchar(100) NOT NULL,
  `fk_account_system_id` int(100) NOT NULL,
  `office_cash_is_active` int(5) NOT NULL DEFAULT '1',
  `office_cash_created_by` int(100) NOT NULL,
  `office_cash_created_date` date NOT NULL,
  `office_cash_last_modified_by` int(100) NOT NULL,
  `office_cash_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`office_cash_id`)
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


DROP TABLE IF EXISTS `opening_bank_balance`;
CREATE TABLE `opening_bank_balance` (
  `opening_bank_balance_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `opening_bank_balance_track_number` varchar(100) NOT NULL,
  `opening_bank_balance_name` varchar(100) NOT NULL,
  `opening_bank_balance_amount` int(100) NOT NULL,
  `fk_office_bank_id` int(100) NOT NULL,
  `opening_bank_balance_created_date` date NOT NULL,
  `opening_bank_balance_created_by` int(100) NOT NULL,
  `opening_bank_balance_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opening_bank_balance_last_modified_by` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `fk_approval_id` int(100) NOT NULL,
  PRIMARY KEY (`opening_bank_balance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_cash_balance`;
CREATE TABLE `opening_cash_balance` (
  `opening_cash_balance_id` int(100) NOT NULL AUTO_INCREMENT,
  `opening_cash_balance_track_number` varchar(100) NOT NULL,
  `opening_cash_balance_name` varchar(100) NOT NULL,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `fk_office_bank_id` int(100) NOT NULL,
  `fk_office_cash_id` int(100) NOT NULL,
  `opening_cash_balance_amount` decimal(10,2) NOT NULL,
  `opening_cash_balance_created_date` date DEFAULT NULL,
  `opening_cash_balance_created_by` int(100) DEFAULT NULL,
  `opening_cash_balance_last_modified_by` int(100) DEFAULT NULL,
  `opening_cash_balance_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`opening_cash_balance_id`),
  KEY `fk_system_opening_balance_id` (`fk_system_opening_balance_id`),
  KEY `fk_office_bank_id` (`fk_office_bank_id`),
  KEY `fk_office_cash_id` (`fk_office_cash_id`),
  CONSTRAINT `opening_cash_balance_ibfk_1` FOREIGN KEY (`fk_system_opening_balance_id`) REFERENCES `system_opening_balance` (`system_opening_balance_id`),
  CONSTRAINT `opening_cash_balance_ibfk_2` FOREIGN KEY (`fk_office_bank_id`) REFERENCES `office_bank` (`office_bank_id`),
  CONSTRAINT `opening_cash_balance_ibfk_3` FOREIGN KEY (`fk_office_cash_id`) REFERENCES `office_cash` (`office_cash_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `opening_deposit_transit`;
CREATE TABLE `opening_deposit_transit` (
  `opening_deposit_transit_id` int(100) NOT NULL AUTO_INCREMENT,
  `opening_deposit_transit_track_number` varchar(100) NOT NULL,
  `opening_deposit_transit_name` varchar(100) NOT NULL,
  `fk_system_opening_balance_id` int(100) NOT NULL,
  `fk_office_bank_id` int(100) NOT NULL,
  `opening_deposit_transit_date` date NOT NULL,
  `opening_deposit_transit_description` longtext NOT NULL,
  `opening_deposit_transit_amount` decimal(10,2) NOT NULL,
  `opening_deposit_transit_is_cleared` int(5) NOT NULL DEFAULT '0',
  `opening_deposit_transit_cleared_date` date NOT NULL,
  `opening_deposit_transit_created_date` date DEFAULT NULL,
  `opening_deposit_transit_created_by` int(100) DEFAULT NULL,
  `opening_deposit_transit_last_modified_by` int(100) DEFAULT NULL,
  `opening_deposit_transit_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  `fk_office_bank_id` int(100) NOT NULL,
  `opening_outstanding_cheque_number` int(50) NOT NULL,
  `opening_outstanding_cheque_amount` decimal(10,2) NOT NULL,
  `opening_outstanding_cheque_is_cleared` int(5) NOT NULL DEFAULT '0',
  `opening_outstanding_cheque_cleared_date` date NOT NULL,
  `opening_outstanding_cheque_created_date` date DEFAULT NULL,
  `opening_outstanding_cheque_created_by` int(100) DEFAULT NULL,
  `opening_outstanding_cheque_last_modified_by` int(100) DEFAULT NULL,
  `opening_outstanding_cheque_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  PRIMARY KEY (`permission_id`)
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
(1,	'PEEL-66291',	'create',	'Label for create permissions',	2,	0,	0,	'2020-08-20',	1,	'2020-08-19 23:01:49',	1),
(2,	'PEEL-20970',	'read',	'Label for read permissions',	1,	0,	0,	'2020-08-20',	1,	'2020-08-19 23:01:49',	1),
(3,	'PEEL-53428',	'update',	'Label for update permissions',	3,	0,	0,	'2020-08-20',	1,	'2020-08-19 23:01:49',	1),
(4,	'PEEL-63230',	'delete',	'Label for delete permissions',	4,	0,	0,	'2020-08-20',	1,	'2020-08-19 23:01:49',	1);

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
  KEY `fk_funder_id` (`fk_funder_id`),
  KEY `fk_funding_status_id` (`fk_funding_status_id`),
  CONSTRAINT `project_ibfk_2` FOREIGN KEY (`fk_funder_id`) REFERENCES `funder` (`funder_id`),
  CONSTRAINT `project_ibfk_3` FOREIGN KEY (`fk_funding_status_id`) REFERENCES `funding_status` (`funding_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A project is a single funded proposal that need to be implemented and reported as a unit. It''s related to single funder ';


DROP TABLE IF EXISTS `project_allocation`;
CREATE TABLE `project_allocation` (
  `project_allocation_id` int(100) NOT NULL AUTO_INCREMENT,
  `project_allocation_track_number` varchar(100) DEFAULT NULL,
  `fk_project_id` int(100) DEFAULT NULL,
  `project_allocation_name` varchar(100) DEFAULT NULL,
  `project_allocation_amount` int(100) DEFAULT NULL,
  `project_allocation_is_active` int(5) DEFAULT '0',
  `fk_office_id` int(100) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `project_allocation_extended_end_date` date DEFAULT '0000-00-00',
  `project_allocation_created_date` date DEFAULT NULL,
  `project_allocation_last_modified_date` varchar(45) DEFAULT NULL,
  `project_allocation_created_by` int(100) DEFAULT NULL,
  `project_allocation_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_allocation_id`),
  KEY `fk_project_id` (`fk_project_id`),
  KEY `fk_office_id` (`fk_office_id`),
  CONSTRAINT `project_allocation_ibfk_1` FOREIGN KEY (`fk_project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `project_allocation_ibfk_2` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`)
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
  `project_cost_proportion_created_date` date DEFAULT NULL,
  `project_cost_proportion_created_by` int(100) DEFAULT NULL,
  `project_cost_proportion_last_modified_by` int(100) DEFAULT NULL,
  `project_cost_proportion_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`project_cost_proportion_id`),
  KEY `voucher_detail_id` (`voucher_detail_id`),
  CONSTRAINT `project_cost_proportion_ibfk_1` FOREIGN KEY (`voucher_detail_id`) REFERENCES `voucher_detail` (`voucher_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `project_income_account`;
CREATE TABLE `project_income_account` (
  `project_income_account_id` int(100) NOT NULL AUTO_INCREMENT,
  `project_income_account_name` varchar(100) NOT NULL,
  `project_income_account_track_number` varchar(100) NOT NULL,
  `fk_project_id` int(100) NOT NULL,
  `fk_income_account_id` int(11) NOT NULL,
  `project_income_account_created_date` date NOT NULL,
  `project_income_account_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_income_account_created_by` int(100) NOT NULL,
  `project_income_account_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  PRIMARY KEY (`project_income_account_id`),
  KEY `fk_project_id` (`fk_project_id`),
  KEY `fk_income_account_id` (`fk_income_account_id`),
  CONSTRAINT `project_income_account_ibfk_1` FOREIGN KEY (`fk_project_id`) REFERENCES `project` (`project_id`),
  CONSTRAINT `project_income_account_ibfk_2` FOREIGN KEY (`fk_income_account_id`) REFERENCES `income_account` (`income_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `reconciliation`;
CREATE TABLE `reconciliation` (
  `reconciliation_id` int(100) NOT NULL AUTO_INCREMENT,
  `reconciliation_track_number` varchar(100) DEFAULT NULL,
  `reconciliation_name` varchar(100) DEFAULT NULL,
  `fk_financial_report_id` int(100) DEFAULT NULL,
  `fk_office_bank_id` int(100) DEFAULT NULL,
  `reconciliation_statement_balance` decimal(10,2) DEFAULT NULL,
  `fk_status_id` int(5) DEFAULT NULL,
  `reconciliation_suspense_amount` decimal(10,2) DEFAULT NULL,
  `reconciliation_created_by` int(100) DEFAULT NULL,
  `reconciliation_created_date` date DEFAULT NULL,
  `reconciliation_last_modified_by` int(100) DEFAULT NULL,
  `reconciliation_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`reconciliation_id`),
  KEY `fk_reconciliation_center1_idx` (`fk_financial_report_id`),
  KEY `fk_office_bank_id` (`fk_office_bank_id`),
  CONSTRAINT `reconciliation_ibfk_1` FOREIGN KEY (`fk_financial_report_id`) REFERENCES `financial_report` (`financial_report_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `reconciliation_ibfk_2` FOREIGN KEY (`fk_office_bank_id`) REFERENCES `office_bank` (`office_bank_id`)
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
  PRIMARY KEY (`request_id`)
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
  `request_detail_voucher_number` int(100) DEFAULT '0',
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
(1,	'ROLE-34069',	'Super System Administrator',	'superadmin',	'Super System Administrator',	1,	1,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	'1',	NULL,	11,	0);

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
  `setting_created_date` date DEFAULT NULL,
  `setting_created_by` int(100) DEFAULT NULL,
  `setting_last_modified_by` int(100) DEFAULT NULL,
  `setting_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `setting` (`setting_id`, `type`, `description`, `setting_created_date`, `setting_created_by`, `setting_last_modified_by`, `setting_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'system_name',	'Grants Management System',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(2,	'system_title',	'Grants Management System',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(3,	'address',	'1945 Nairobi',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(4,	'phone',	'+254711808071',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(5,	'system_email',	'nkmwambs@gmail.com',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(6,	'language',	'1',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(7,	'text_align',	'left-to-right',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(8,	'skin_colour',	'blue',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(9,	'system_setup_completed',	'1',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(10,	'setup_password',	'fbdf9989ea636d6b339fd6b85f63e06e',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL),
(11,	'base_currency_code',	'1',	'2020-08-20',	1,	1,	'2020-08-20 12:01:44',	NULL,	NULL);

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_track_number` varchar(100) NOT NULL,
  `status_name` varchar(50) NOT NULL,
  `fk_approval_flow_id` int(100) NOT NULL,
  `status_approval_sequence` int(10) NOT NULL,
  `status_backflow_sequence` int(10) NOT NULL,
  `status_approval_direction` int(5) NOT NULL COMMENT '1-straight jumps, 0 - return jumps, -1 - reverse jump',
  `status_is_requiring_approver_action` int(5) NOT NULL DEFAULT '1',
  `status_created_date` date NOT NULL,
  `status_created_by` int(100) NOT NULL,
  `status_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`status_id`, `status_track_number`, `status_name`, `fk_approval_flow_id`, `status_approval_sequence`, `status_backflow_sequence`, `status_approval_direction`, `status_is_requiring_approver_action`, `status_created_date`, `status_created_by`, `status_last_modified_date`, `status_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'STUS-6521',	'Ready To Submit',	1,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(2,	'STUS-25931',	'Ready To Submit',	2,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(3,	'STUS-54547',	'Ready To Submit',	3,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(4,	'STUS-54571',	'Ready To Submit',	4,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(5,	'STUS-53273',	'Ready To Submit',	5,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(6,	'STUS-49579',	'Ready To Submit',	6,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(7,	'STUS-9017',	'Ready To Submit',	7,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(8,	'STUS-64156',	'Ready To Submit',	8,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(9,	'STUS-47904',	'Ready To Submit',	9,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(10,	'STUS-34552',	'Ready To Submit',	10,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(11,	'STUS-53880',	'Ready To Submit',	11,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(12,	'STUS-56806',	'Ready To Submit',	12,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(13,	'STUS-8258',	'Ready To Submit',	13,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(14,	'STUS-44217',	'Ready To Submit',	14,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(15,	'STUS-30673',	'Ready To Submit',	15,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(16,	'STUS-32130',	'Ready To Submit',	16,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(17,	'STUS-38807',	'Ready To Submit',	17,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(18,	'STUS-68660',	'Ready To Submit',	18,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(19,	'STUS-71102',	'Ready To Submit',	19,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(20,	'STUS-46537',	'Ready To Submit',	20,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(21,	'STUS-25757',	'Ready To Submit',	21,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:49',	1,	NULL,	NULL),
(22,	'STUS-67082',	'Ready To Submit',	22,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(23,	'STUS-39783',	'Ready To Submit',	23,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(24,	'STUS-65110',	'Ready To Submit',	24,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(25,	'STUS-30765',	'Ready To Submit',	25,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(26,	'STUS-70217',	'Ready To Submit',	26,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(27,	'STUS-13894',	'Ready To Submit',	27,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(28,	'STUS-30363',	'Ready To Submit',	28,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(29,	'STUS-35950',	'Ready To Submit',	29,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(30,	'STUS-67356',	'Ready To Submit',	30,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(31,	'STUS-18936',	'Ready To Submit',	31,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(32,	'STUS-62655',	'Ready To Submit',	32,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(33,	'STUS-18428',	'Ready To Submit',	33,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(34,	'STUS-44018',	'Ready To Submit',	34,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(35,	'STUS-36620',	'Ready To Submit',	35,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(36,	'STUS-17333',	'Ready To Submit',	36,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(37,	'STUS-25974',	'Ready To Submit',	37,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(38,	'STUS-14322',	'Ready To Submit',	38,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(39,	'STUS-78841',	'Ready To Submit',	39,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(40,	'STUS-64869',	'Ready To Submit',	40,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(41,	'STUS-37451',	'Ready To Submit',	41,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(42,	'STUS-36599',	'Ready To Submit',	42,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(43,	'STUS-36059',	'Ready To Submit',	43,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(44,	'STUS-45523',	'Ready To Submit',	44,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(45,	'STUS-71777',	'Ready To Submit',	45,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(46,	'STUS-53865',	'Ready To Submit',	46,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(47,	'STUS-34057',	'Ready To Submit',	47,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(48,	'STUS-7850',	'Ready To Submit',	48,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(49,	'STUS-26603',	'Ready To Submit',	49,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(50,	'STUS-46816',	'Ready To Submit',	50,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(51,	'STUS-86204',	'Ready To Submit',	51,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(52,	'STUS-75465',	'Ready To Submit',	52,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(53,	'STUS-34924',	'Ready To Submit',	53,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(54,	'STUS-2021',	'Ready To Submit',	54,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(55,	'STUS-50695',	'Ready To Submit',	55,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(56,	'STUS-27611',	'Ready To Submit',	56,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(57,	'STUS-38047',	'Ready To Submit',	57,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(58,	'STUS-85414',	'Ready To Submit',	58,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(59,	'STUS-52888',	'Ready To Submit',	59,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(60,	'STUS-70612',	'Ready To Submit',	60,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(61,	'STUS-34167',	'Ready To Submit',	61,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(62,	'STUS-82507',	'Ready To Submit',	62,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(63,	'STUS-32734',	'Ready To Submit',	63,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(64,	'STUS-35566',	'Ready To Submit',	64,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(65,	'STUS-37206',	'Ready To Submit',	65,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(66,	'STUS-82231',	'Ready To Submit',	66,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(67,	'STUS-3843',	'Ready To Submit',	67,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(68,	'STUS-60232',	'Ready To Submit',	68,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(69,	'STUS-11026',	'Ready To Submit',	69,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(70,	'STUS-47581',	'Ready To Submit',	70,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(71,	'STUS-71514',	'Ready To Submit',	71,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:50',	1,	NULL,	NULL),
(72,	'STUS-85021',	'Ready To Submit',	72,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(73,	'STUS-4595',	'Ready To Submit',	73,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(74,	'STUS-66306',	'Ready To Submit',	74,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(75,	'STUS-47676',	'Ready To Submit',	75,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(76,	'STUS-12612',	'Ready To Submit',	76,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(77,	'STUS-26121',	'Ready To Submit',	77,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(78,	'STUS-56014',	'Ready To Submit',	78,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(79,	'STUS-40492',	'Ready To Submit',	79,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(80,	'STUS-57974',	'Ready To Submit',	80,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(81,	'STUS-27014',	'Ready To Submit',	81,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL),
(82,	'STUS-89537',	'Ready To Submit',	82,	1,	0,	1,	0,	'2020-08-20',	1,	'2020-08-20 12:01:51',	1,	NULL,	NULL);

DROP TABLE IF EXISTS `status_role`;
CREATE TABLE `status_role` (
  `status_role_id` int(100) NOT NULL AUTO_INCREMENT,
  `status_role_track_number` varchar(100) NOT NULL,
  `status_role_name` varchar(100) NOT NULL,
  `fk_role_id` int(100) NOT NULL,
  `fk_status_id` int(100) NOT NULL,
  `status_role_status_id` int(100) NOT NULL,
  `status_role_created_by` int(100) NOT NULL,
  `status_role_created_date` date NOT NULL DEFAULT '0000-00-00',
  `status_role_last_modified_by` int(100) NOT NULL,
  `status_role_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
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
  `translation_created_date` date DEFAULT NULL,
  `translation_created_by` int(100) DEFAULT NULL,
  `translation_last_modified_by` int(100) DEFAULT NULL,
  `translation_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  `fk_country_currency_id` int(100) DEFAULT NULL,
  `user_is_active` int(5) NOT NULL DEFAULT '1',
  `fk_role_id` int(100) DEFAULT NULL,
  `fk_account_system_id` int(100) DEFAULT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_created_date` date NOT NULL,
  `user_created_by` int(100) NOT NULL,
  `user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_modifed_by` int(100) DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  `user_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`user_id`, `user_track_number`, `user_name`, `user_firstname`, `user_lastname`, `user_email`, `fk_context_definition_id`, `user_is_context_manager`, `user_is_system_admin`, `fk_language_id`, `fk_country_currency_id`, `user_is_active`, `fk_role_id`, `fk_account_system_id`, `user_password`, `user_created_date`, `user_created_by`, `user_last_modified_date`, `user_last_modifed_by`, `fk_approval_id`, `fk_status_id`, `user_last_modified_by`) VALUES
(1,	'USER-80617',	'system',	'System User',	'System User',	'nkmwambs@gmail.com',	6,	0,	1,	1,	1,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2020-08-20',	1,	'2020-08-20 12:01:49',	NULL,	12,	0,	1);

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
  `variance_note_created_date` date DEFAULT NULL,
  `variance_note_created_by` int(100) DEFAULT NULL,
  `variance_note_last_modified_by` int(100) DEFAULT NULL,
  `variance_note_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
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
  `fk_office_cash_id` int(100) DEFAULT NULL,
  `voucher_cheque_number` int(100) DEFAULT NULL,
  `voucher_transaction_cleared_date` date DEFAULT '0000-00-00',
  `voucher_transaction_cleared_month` date DEFAULT '0000-00-00',
  `voucher_vendor` varchar(100) DEFAULT NULL,
  `voucher_vendor_address` varchar(100) DEFAULT NULL,
  `voucher_description` varchar(200) DEFAULT NULL,
  `voucher_allow_edit` int(5) DEFAULT '0',
  `voucher_is_reversed` int(5) DEFAULT '0',
  `voucher_created_by` int(100) DEFAULT NULL,
  `voucher_created_date` date DEFAULT NULL,
  `voucher_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `voucher_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_id`),
  KEY `fk_office_id` (`fk_office_id`),
  KEY `fk_voucher_type_id` (`fk_voucher_type_id`),
  CONSTRAINT `voucher_ibfk_1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `voucher_ibfk_2` FOREIGN KEY (`fk_voucher_type_id`) REFERENCES `voucher_type` (`voucher_type_id`)
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
  `fk_contra_account_id` int(100) NOT NULL DEFAULT '0',
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
  `voucher_type_is_cheque_referenced` int(5) DEFAULT '0',
  `fk_account_system_id` int(100) DEFAULT NULL,
  `voucher_type_created_by` int(100) DEFAULT NULL,
  `voucher_type_created_date` date DEFAULT NULL,
  `voucher_type_last_modified_by` int(100) DEFAULT NULL,
  `voucher_type_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_type_id`),
  KEY `fk_voucher_type_voucher_type_transaction_effect1_idx` (`fk_voucher_type_effect_id`),
  KEY `voucher_type_account_id` (`fk_voucher_type_account_id`),
  KEY `fk_account_system_id` (`fk_account_system_id`),
  CONSTRAINT `voucher_type_ibfk_1` FOREIGN KEY (`fk_voucher_type_account_id`) REFERENCES `voucher_type_account` (`voucher_type_account_id`),
  CONSTRAINT `voucher_type_ibfk_2` FOREIGN KEY (`fk_voucher_type_effect_id`) REFERENCES `voucher_type_effect` (`voucher_type_effect_id`),
  CONSTRAINT `voucher_type_ibfk_3` FOREIGN KEY (`fk_account_system_id`) REFERENCES `account_system` (`account_system_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
(1,	'VONT-21244',	'Bank',	'bank',	'2020-08-20',	1,	1,	NULL,	15,	0),
(2,	'VONT-60342',	'Cash',	'cash',	'2020-08-20',	1,	1,	NULL,	16,	0);

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
(1,	'VOCT-75305',	'Income',	'income',	'2020-08-20',	1,	1,	NULL,	17,	0),
(2,	'VOCT-66371',	'Expense',	'expense',	'2020-08-20',	1,	1,	NULL,	18,	0),
(3,	'VOCT-70428',	'Bank_contra',	'bank_contra',	'2020-08-20',	1,	1,	NULL,	19,	0),
(4,	'VOCT-63159',	'Cash_contra',	'cash_contra',	'2020-08-20',	1,	1,	NULL,	20,	0);

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
  `workplan_task_created_date` date DEFAULT NULL,
  `workplan_task_created_by` int(100) DEFAULT NULL,
  `workplan_task_last_modified_by` int(100) DEFAULT NULL,
  `workplan_task_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`workplan_task_id`),
  KEY `fk_workplan_id` (`fk_workplan_id`),
  KEY `workplan_detail_task_user` (`workplan_task_user`),
  CONSTRAINT `workplan_task_ibfk_1` FOREIGN KEY (`fk_workplan_id`) REFERENCES `workplan` (`workplan_id`),
  CONSTRAINT `workplan_task_ibfk_2` FOREIGN KEY (`workplan_task_user`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-08-20 12:03:11

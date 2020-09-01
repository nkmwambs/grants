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
(34,	'APAL-27312',	'Approval Ticket # APAL-27312',	1,	0,	1,	'2020-08-20',	'2020-08-20 12:01:49',	1),
(35,	'APAL-69827',	'Approval Ticket # APAL-69827',	72,	69,	1,	'2020-08-20',	'2020-08-20 12:07:15',	1),
(36,	'APAL-42333',	'Approval Ticket # APAL-42333',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(37,	'APAL-64125',	'Approval Ticket # APAL-64125',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(38,	'APAL-82598',	'Approval Ticket # APAL-82598',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(39,	'APAL-65214',	'Approval Ticket # APAL-65214',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(40,	'APAL-66759',	'Approval Ticket # APAL-66759',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(41,	'APAL-35770',	'Approval Ticket # APAL-35770',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(42,	'APAL-64338',	'Approval Ticket # APAL-64338',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(43,	'APAL-75175',	'Approval Ticket # APAL-75175',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(44,	'APAL-27865',	'Approval Ticket # APAL-27865',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:18',	1),
(45,	'APAL-40789',	'Approval Ticket # APAL-40789',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(46,	'APAL-8343',	'Approval Ticket # APAL-8343',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(47,	'APAL-23995',	'Approval Ticket # APAL-23995',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(48,	'APAL-59184',	'Approval Ticket # APAL-59184',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(49,	'APAL-33436',	'Approval Ticket # APAL-33436',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(50,	'APAL-18788',	'Approval Ticket # APAL-18788',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(51,	'APAL-89000',	'Approval Ticket # APAL-89000',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(52,	'APAL-37068',	'Approval Ticket # APAL-37068',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(53,	'APAL-16638',	'Approval Ticket # APAL-16638',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(54,	'APAL-78538',	'Approval Ticket # APAL-78538',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(55,	'APAL-62622',	'Approval Ticket # APAL-62622',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(56,	'APAL-72863',	'Approval Ticket # APAL-72863',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(57,	'APAL-18582',	'Approval Ticket # APAL-18582',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(58,	'APAL-9993',	'Approval Ticket # APAL-9993',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(59,	'APAL-76209',	'Approval Ticket # APAL-76209',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(60,	'APAL-85236',	'Approval Ticket # APAL-85236',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(61,	'APAL-82059',	'Approval Ticket # APAL-82059',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(62,	'APAL-19498',	'Approval Ticket # APAL-19498',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(63,	'APAL-30114',	'Approval Ticket # APAL-30114',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(64,	'APAL-16089',	'Approval Ticket # APAL-16089',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(65,	'APAL-75822',	'Approval Ticket # APAL-75822',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(66,	'APAL-62656',	'Approval Ticket # APAL-62656',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(67,	'APAL-39651',	'Approval Ticket # APAL-39651',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(68,	'APAL-77808',	'Approval Ticket # APAL-77808',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(69,	'APAL-28973',	'Approval Ticket # APAL-28973',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(70,	'APAL-64012',	'Approval Ticket # APAL-64012',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(71,	'APAL-53150',	'Approval Ticket # APAL-53150',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(72,	'APAL-82880',	'Approval Ticket # APAL-82880',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(73,	'APAL-57030',	'Approval Ticket # APAL-57030',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(74,	'APAL-55616',	'Approval Ticket # APAL-55616',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(75,	'APAL-18836',	'Approval Ticket # APAL-18836',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(76,	'APAL-87361',	'Approval Ticket # APAL-87361',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(77,	'APAL-82371',	'Approval Ticket # APAL-82371',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(78,	'APAL-43866',	'Approval Ticket # APAL-43866',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(79,	'APAL-21950',	'Approval Ticket # APAL-21950',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(80,	'APAL-35308',	'Approval Ticket # APAL-35308',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(81,	'APAL-21401',	'Approval Ticket # APAL-21401',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(82,	'APAL-45587',	'Approval Ticket # APAL-45587',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(83,	'APAL-47178',	'Approval Ticket # APAL-47178',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(84,	'APAL-50368',	'Approval Ticket # APAL-50368',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(85,	'APAL-25241',	'Approval Ticket # APAL-25241',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(86,	'APAL-13416',	'Approval Ticket # APAL-13416',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(87,	'APAL-78008',	'Approval Ticket # APAL-78008',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(88,	'APAL-45001',	'Approval Ticket # APAL-45001',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(89,	'APAL-22414',	'Approval Ticket # APAL-22414',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(90,	'APAL-37675',	'Approval Ticket # APAL-37675',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(91,	'APAL-64167',	'Approval Ticket # APAL-64167',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(92,	'APAL-36179',	'Approval Ticket # APAL-36179',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(93,	'APAL-73751',	'Approval Ticket # APAL-73751',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(94,	'APAL-40518',	'Approval Ticket # APAL-40518',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(95,	'APAL-41848',	'Approval Ticket # APAL-41848',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(96,	'APAL-34536',	'Approval Ticket # APAL-34536',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(97,	'APAL-33851',	'Approval Ticket # APAL-33851',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(98,	'APAL-64279',	'Approval Ticket # APAL-64279',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(99,	'APAL-73012',	'Approval Ticket # APAL-73012',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(100,	'APAL-50688',	'Approval Ticket # APAL-50688',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(101,	'APAL-25656',	'Approval Ticket # APAL-25656',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(102,	'APAL-59307',	'Approval Ticket # APAL-59307',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(103,	'APAL-16656',	'Approval Ticket # APAL-16656',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(104,	'APAL-52750',	'Approval Ticket # APAL-52750',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(105,	'APAL-24502',	'Approval Ticket # APAL-24502',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(106,	'APAL-65948',	'Approval Ticket # APAL-65948',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(107,	'APAL-78989',	'Approval Ticket # APAL-78989',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(108,	'APAL-73815',	'Approval Ticket # APAL-73815',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(109,	'APAL-45842',	'Approval Ticket # APAL-45842',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(110,	'APAL-34602',	'Approval Ticket # APAL-34602',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(111,	'APAL-70763',	'Approval Ticket # APAL-70763',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(112,	'APAL-16035',	'Approval Ticket # APAL-16035',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(113,	'APAL-46786',	'Approval Ticket # APAL-46786',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(114,	'APAL-56246',	'Approval Ticket # APAL-56246',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(115,	'APAL-87551',	'Approval Ticket # APAL-87551',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(116,	'APAL-69210',	'Approval Ticket # APAL-69210',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(117,	'APAL-72053',	'Approval Ticket # APAL-72053',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(118,	'APAL-13721',	'Approval Ticket # APAL-13721',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(119,	'APAL-19449',	'Approval Ticket # APAL-19449',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(120,	'APAL-84002',	'Approval Ticket # APAL-84002',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(121,	'APAL-45853',	'Approval Ticket # APAL-45853',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(122,	'APAL-86626',	'Approval Ticket # APAL-86626',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(123,	'APAL-69043',	'Approval Ticket # APAL-69043',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(124,	'APAL-59363',	'Approval Ticket # APAL-59363',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(125,	'APAL-16927',	'Approval Ticket # APAL-16927',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(126,	'APAL-31262',	'Approval Ticket # APAL-31262',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(127,	'APAL-59146',	'Approval Ticket # APAL-59146',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(128,	'APAL-67211',	'Approval Ticket # APAL-67211',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(129,	'APAL-63810',	'Approval Ticket # APAL-63810',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(130,	'APAL-4626',	'Approval Ticket # APAL-4626',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(131,	'APAL-49688',	'Approval Ticket # APAL-49688',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:19',	1),
(132,	'APAL-85717',	'Approval Ticket # APAL-85717',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(133,	'APAL-69007',	'Approval Ticket # APAL-69007',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(134,	'APAL-57204',	'Approval Ticket # APAL-57204',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(135,	'APAL-83095',	'Approval Ticket # APAL-83095',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(136,	'APAL-69209',	'Approval Ticket # APAL-69209',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(137,	'APAL-19707',	'Approval Ticket # APAL-19707',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(138,	'APAL-4174',	'Approval Ticket # APAL-4174',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(139,	'APAL-72455',	'Approval Ticket # APAL-72455',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(140,	'APAL-58333',	'Approval Ticket # APAL-58333',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(141,	'APAL-40747',	'Approval Ticket # APAL-40747',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(142,	'APAL-55534',	'Approval Ticket # APAL-55534',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(143,	'APAL-81325',	'Approval Ticket # APAL-81325',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(144,	'APAL-60704',	'Approval Ticket # APAL-60704',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(145,	'APAL-42135',	'Approval Ticket # APAL-42135',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(146,	'APAL-17447',	'Approval Ticket # APAL-17447',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(147,	'APAL-4736',	'Approval Ticket # APAL-4736',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(148,	'APAL-70686',	'Approval Ticket # APAL-70686',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(149,	'APAL-21551',	'Approval Ticket # APAL-21551',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(150,	'APAL-2906',	'Approval Ticket # APAL-2906',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(151,	'APAL-83723',	'Approval Ticket # APAL-83723',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(152,	'APAL-77493',	'Approval Ticket # APAL-77493',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(153,	'APAL-27171',	'Approval Ticket # APAL-27171',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(154,	'APAL-27624',	'Approval Ticket # APAL-27624',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(155,	'APAL-45070',	'Approval Ticket # APAL-45070',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(156,	'APAL-5346',	'Approval Ticket # APAL-5346',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(157,	'APAL-23495',	'Approval Ticket # APAL-23495',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(158,	'APAL-86911',	'Approval Ticket # APAL-86911',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(159,	'APAL-54026',	'Approval Ticket # APAL-54026',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(160,	'APAL-51328',	'Approval Ticket # APAL-51328',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(161,	'APAL-70389',	'Approval Ticket # APAL-70389',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(162,	'APAL-74421',	'Approval Ticket # APAL-74421',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(163,	'APAL-6703',	'Approval Ticket # APAL-6703',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(164,	'APAL-12976',	'Approval Ticket # APAL-12976',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(165,	'APAL-82607',	'Approval Ticket # APAL-82607',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(166,	'APAL-62988',	'Approval Ticket # APAL-62988',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(167,	'APAL-66557',	'Approval Ticket # APAL-66557',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(168,	'APAL-38277',	'Approval Ticket # APAL-38277',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(169,	'APAL-72739',	'Approval Ticket # APAL-72739',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(170,	'APAL-62795',	'Approval Ticket # APAL-62795',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(171,	'APAL-77041',	'Approval Ticket # APAL-77041',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(172,	'APAL-13072',	'Approval Ticket # APAL-13072',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(173,	'APAL-30510',	'Approval Ticket # APAL-30510',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(174,	'APAL-74030',	'Approval Ticket # APAL-74030',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(175,	'APAL-21489',	'Approval Ticket # APAL-21489',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(176,	'APAL-53782',	'Approval Ticket # APAL-53782',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(177,	'APAL-32142',	'Approval Ticket # APAL-32142',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(178,	'APAL-77094',	'Approval Ticket # APAL-77094',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(179,	'APAL-78279',	'Approval Ticket # APAL-78279',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(180,	'APAL-35780',	'Approval Ticket # APAL-35780',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(181,	'APAL-56216',	'Approval Ticket # APAL-56216',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(182,	'APAL-50010',	'Approval Ticket # APAL-50010',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(183,	'APAL-75322',	'Approval Ticket # APAL-75322',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(184,	'APAL-44840',	'Approval Ticket # APAL-44840',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(185,	'APAL-79844',	'Approval Ticket # APAL-79844',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(186,	'APAL-37636',	'Approval Ticket # APAL-37636',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(187,	'APAL-20410',	'Approval Ticket # APAL-20410',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(188,	'APAL-10009',	'Approval Ticket # APAL-10009',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(189,	'APAL-69528',	'Approval Ticket # APAL-69528',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(190,	'APAL-14237',	'Approval Ticket # APAL-14237',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(191,	'APAL-83502',	'Approval Ticket # APAL-83502',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(192,	'APAL-17916',	'Approval Ticket # APAL-17916',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(193,	'APAL-6687',	'Approval Ticket # APAL-6687',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(194,	'APAL-49271',	'Approval Ticket # APAL-49271',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(195,	'APAL-64552',	'Approval Ticket # APAL-64552',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(196,	'APAL-10059',	'Approval Ticket # APAL-10059',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(197,	'APAL-49371',	'Approval Ticket # APAL-49371',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(198,	'APAL-6582',	'Approval Ticket # APAL-6582',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(199,	'APAL-76119',	'Approval Ticket # APAL-76119',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(200,	'APAL-32652',	'Approval Ticket # APAL-32652',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(201,	'APAL-30149',	'Approval Ticket # APAL-30149',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(202,	'APAL-30821',	'Approval Ticket # APAL-30821',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(203,	'APAL-23761',	'Approval Ticket # APAL-23761',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(204,	'APAL-44537',	'Approval Ticket # APAL-44537',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(205,	'APAL-55425',	'Approval Ticket # APAL-55425',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(206,	'APAL-77903',	'Approval Ticket # APAL-77903',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(207,	'APAL-25883',	'Approval Ticket # APAL-25883',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(208,	'APAL-17572',	'Approval Ticket # APAL-17572',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(209,	'APAL-33431',	'Approval Ticket # APAL-33431',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(210,	'APAL-26205',	'Approval Ticket # APAL-26205',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(211,	'APAL-22974',	'Approval Ticket # APAL-22974',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(212,	'APAL-59278',	'Approval Ticket # APAL-59278',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(213,	'APAL-29958',	'Approval Ticket # APAL-29958',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(214,	'APAL-32183',	'Approval Ticket # APAL-32183',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(215,	'APAL-66326',	'Approval Ticket # APAL-66326',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(216,	'APAL-72634',	'Approval Ticket # APAL-72634',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(217,	'APAL-46281',	'Approval Ticket # APAL-46281',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(218,	'APAL-33883',	'Approval Ticket # APAL-33883',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(219,	'APAL-81451',	'Approval Ticket # APAL-81451',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(220,	'APAL-27739',	'Approval Ticket # APAL-27739',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(221,	'APAL-44197',	'Approval Ticket # APAL-44197',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(222,	'APAL-49474',	'Approval Ticket # APAL-49474',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(223,	'APAL-16374',	'Approval Ticket # APAL-16374',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(224,	'APAL-41019',	'Approval Ticket # APAL-41019',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(225,	'APAL-78499',	'Approval Ticket # APAL-78499',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(226,	'APAL-32964',	'Approval Ticket # APAL-32964',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(227,	'APAL-40979',	'Approval Ticket # APAL-40979',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(228,	'APAL-44097',	'Approval Ticket # APAL-44097',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(229,	'APAL-53323',	'Approval Ticket # APAL-53323',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(230,	'APAL-73147',	'Approval Ticket # APAL-73147',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(231,	'APAL-4818',	'Approval Ticket # APAL-4818',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:20',	1),
(232,	'APAL-44015',	'Approval Ticket # APAL-44015',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(233,	'APAL-30983',	'Approval Ticket # APAL-30983',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(234,	'APAL-28998',	'Approval Ticket # APAL-28998',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(235,	'APAL-28056',	'Approval Ticket # APAL-28056',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(236,	'APAL-23918',	'Approval Ticket # APAL-23918',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(237,	'APAL-32239',	'Approval Ticket # APAL-32239',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(238,	'APAL-8245',	'Approval Ticket # APAL-8245',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(239,	'APAL-75636',	'Approval Ticket # APAL-75636',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(240,	'APAL-10978',	'Approval Ticket # APAL-10978',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(241,	'APAL-86409',	'Approval Ticket # APAL-86409',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(242,	'APAL-11600',	'Approval Ticket # APAL-11600',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(243,	'APAL-60103',	'Approval Ticket # APAL-60103',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(244,	'APAL-42534',	'Approval Ticket # APAL-42534',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(245,	'APAL-69610',	'Approval Ticket # APAL-69610',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(246,	'APAL-7263',	'Approval Ticket # APAL-7263',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(247,	'APAL-73005',	'Approval Ticket # APAL-73005',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(248,	'APAL-70607',	'Approval Ticket # APAL-70607',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(249,	'APAL-19357',	'Approval Ticket # APAL-19357',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(250,	'APAL-52061',	'Approval Ticket # APAL-52061',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(251,	'APAL-43745',	'Approval Ticket # APAL-43745',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(252,	'APAL-54326',	'Approval Ticket # APAL-54326',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(253,	'APAL-7643',	'Approval Ticket # APAL-7643',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(254,	'APAL-72239',	'Approval Ticket # APAL-72239',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(255,	'APAL-17306',	'Approval Ticket # APAL-17306',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(256,	'APAL-11824',	'Approval Ticket # APAL-11824',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(257,	'APAL-56319',	'Approval Ticket # APAL-56319',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(258,	'APAL-45752',	'Approval Ticket # APAL-45752',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(259,	'APAL-13640',	'Approval Ticket # APAL-13640',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(260,	'APAL-68557',	'Approval Ticket # APAL-68557',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(261,	'APAL-4329',	'Approval Ticket # APAL-4329',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(262,	'APAL-63268',	'Approval Ticket # APAL-63268',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(263,	'APAL-27567',	'Approval Ticket # APAL-27567',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(264,	'APAL-89118',	'Approval Ticket # APAL-89118',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(265,	'APAL-52050',	'Approval Ticket # APAL-52050',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(266,	'APAL-79272',	'Approval Ticket # APAL-79272',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(267,	'APAL-12096',	'Approval Ticket # APAL-12096',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(268,	'APAL-67807',	'Approval Ticket # APAL-67807',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(269,	'APAL-8314',	'Approval Ticket # APAL-8314',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(270,	'APAL-25171',	'Approval Ticket # APAL-25171',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(271,	'APAL-46206',	'Approval Ticket # APAL-46206',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(272,	'APAL-49882',	'Approval Ticket # APAL-49882',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(273,	'APAL-31866',	'Approval Ticket # APAL-31866',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(274,	'APAL-25488',	'Approval Ticket # APAL-25488',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(275,	'APAL-57818',	'Approval Ticket # APAL-57818',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(276,	'APAL-20173',	'Approval Ticket # APAL-20173',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(277,	'APAL-65019',	'Approval Ticket # APAL-65019',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(278,	'APAL-9904',	'Approval Ticket # APAL-9904',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(279,	'APAL-75836',	'Approval Ticket # APAL-75836',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(280,	'APAL-50382',	'Approval Ticket # APAL-50382',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(281,	'APAL-26516',	'Approval Ticket # APAL-26516',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(282,	'APAL-84301',	'Approval Ticket # APAL-84301',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1),
(283,	'APAL-83555',	'Approval Ticket # APAL-83555',	59,	56,	1,	'2020-08-20',	'2020-08-20 12:07:21',	1);

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
  `fk_office_id` int(100) NOT NULL,
  `fk_context_definition_id` int(100) DEFAULT NULL,
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

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_derivative_controller`, `menu_is_active`, `menu_created_date`, `menu_last_modified_date`, `menu_created_by`, `menu_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'Account_system',	'Account_system',	1,	NULL,	'2020-08-20 12:07:18',	NULL,	NULL,	NULL,	NULL),
(2,	'Approval',	'Approval',	1,	NULL,	'2020-08-20 12:07:18',	NULL,	NULL,	NULL,	NULL),
(3,	'Approval_flow',	'Approval_flow',	1,	NULL,	'2020-08-20 12:07:18',	NULL,	NULL,	NULL,	NULL),
(4,	'Approve_item',	'Approve_item',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(5,	'Bank',	'Bank',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(6,	'Budget',	'Budget',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(7,	'Budget_item',	'Budget_item',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(8,	'Context_center',	'Context_center',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(9,	'Context_center_user',	'Context_center_user',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(10,	'Context_cluster',	'Context_cluster',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(11,	'Context_cluster_user',	'Context_cluster_user',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(12,	'Context_cohort',	'Context_cohort',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(13,	'Context_cohort_user',	'Context_cohort_user',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(14,	'Context_country',	'Context_country',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(15,	'Context_country_user',	'Context_country_user',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(16,	'Context_definition',	'Context_definition',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(17,	'Context_global',	'Context_global',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(18,	'Context_global_user',	'Context_global_user',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(19,	'Context_region',	'Context_region',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(20,	'Context_region_user',	'Context_region_user',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(21,	'Contra_account',	'Contra_account',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(22,	'Country_currency',	'Country_currency',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(23,	'Currency_conversion',	'Currency_conversion',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(24,	'Dashboard',	'Dashboard',	1,	NULL,	'2020-08-20 12:07:19',	NULL,	NULL,	NULL,	NULL),
(25,	'Department',	'Department',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(26,	'Designation',	'Designation',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(27,	'Expense_account',	'Expense_account',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(28,	'Financial_report',	'Financial_report',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(29,	'Funder',	'Funder',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(30,	'Funding_status',	'Funding_status',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(31,	'History',	'History',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(32,	'Income_account',	'Income_account',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(33,	'Journal',	'Journal',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(34,	'Language',	'Language',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(35,	'Language_phrase',	'Language_phrase',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(36,	'Menu_user_order',	'Menu_user_order',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(37,	'Month',	'Month',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(38,	'Office',	'Office',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(39,	'Office_bank',	'Office_bank',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(40,	'Office_bank_project_allocation',	'Office_bank_project_allocation',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(41,	'Office_cash',	'Office_cash',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(42,	'Opening_bank_balance',	'Opening_bank_balance',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(43,	'Page_view',	'Page_view',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(44,	'Permission_label',	'Permission_label',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(45,	'Project',	'Project',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(46,	'Project_allocation',	'Project_allocation',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(47,	'Project_cost_proportion',	'Project_cost_proportion',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(48,	'Project_income_account',	'Project_income_account',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(49,	'Request',	'Request',	1,	NULL,	'2020-08-20 12:07:20',	NULL,	NULL,	NULL,	NULL),
(50,	'Request_conversion',	'Request_conversion',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(51,	'Request_type',	'Request_type',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(52,	'Role',	'Role',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(53,	'Setting',	'Setting',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(54,	'System_opening_balance',	'System_opening_balance',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(55,	'Translation',	'Translation',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(56,	'User',	'User',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(57,	'Variance_note',	'Variance_note',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(58,	'Voucher',	'Voucher',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(59,	'Voucher_type',	'Voucher_type',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(60,	'Voucher_type_account',	'Voucher_type_account',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(61,	'Voucher_type_effect',	'Voucher_type_effect',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(62,	'Workplan',	'Workplan',	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL);

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

INSERT INTO `menu_user_order` (`menu_user_order_id`, `fk_user_id`, `menu_user_order_track_number`, `menu_user_order_name`, `fk_menu_id`, `menu_user_order_is_active`, `menu_user_order_level`, `menu_user_order_priority_item`, `menu_user_order_created_date`, `menu_user_order_last_modified_date`, `menu_user_order_created_by`, `menu_user_order_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	1,	NULL,	NULL,	1,	1,	1,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(2,	1,	NULL,	NULL,	2,	1,	2,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(3,	1,	NULL,	NULL,	3,	1,	3,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(4,	1,	NULL,	NULL,	4,	1,	4,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(5,	1,	NULL,	NULL,	5,	1,	5,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(6,	1,	NULL,	NULL,	6,	1,	6,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(7,	1,	NULL,	NULL,	7,	1,	7,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(8,	1,	NULL,	NULL,	8,	1,	8,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(9,	1,	NULL,	NULL,	9,	1,	9,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(10,	1,	NULL,	NULL,	10,	1,	10,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(11,	1,	NULL,	NULL,	11,	1,	11,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(12,	1,	NULL,	NULL,	12,	1,	12,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(13,	1,	NULL,	NULL,	13,	1,	13,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(14,	1,	NULL,	NULL,	14,	1,	14,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(15,	1,	NULL,	NULL,	15,	1,	15,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(16,	1,	NULL,	NULL,	16,	1,	16,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(17,	1,	NULL,	NULL,	17,	1,	17,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(18,	1,	NULL,	NULL,	18,	1,	18,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(19,	1,	NULL,	NULL,	19,	1,	19,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(20,	1,	NULL,	NULL,	20,	1,	20,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(21,	1,	NULL,	NULL,	21,	1,	21,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(22,	1,	NULL,	NULL,	22,	1,	22,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(23,	1,	NULL,	NULL,	23,	1,	23,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(24,	1,	NULL,	NULL,	24,	1,	24,	1,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(25,	1,	NULL,	NULL,	25,	1,	25,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(26,	1,	NULL,	NULL,	26,	1,	26,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(27,	1,	NULL,	NULL,	27,	1,	27,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(28,	1,	NULL,	NULL,	28,	1,	28,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(29,	1,	NULL,	NULL,	29,	1,	29,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(30,	1,	NULL,	NULL,	30,	1,	30,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(31,	1,	NULL,	NULL,	31,	1,	31,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(32,	1,	NULL,	NULL,	32,	1,	32,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(33,	1,	NULL,	NULL,	33,	1,	33,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(34,	1,	NULL,	NULL,	34,	1,	34,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(35,	1,	NULL,	NULL,	35,	1,	35,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(36,	1,	NULL,	NULL,	36,	1,	36,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(37,	1,	NULL,	NULL,	37,	1,	37,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(38,	1,	NULL,	NULL,	38,	1,	38,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(39,	1,	NULL,	NULL,	39,	1,	39,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(40,	1,	NULL,	NULL,	40,	1,	40,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(41,	1,	NULL,	NULL,	41,	1,	41,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(42,	1,	NULL,	NULL,	42,	1,	42,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(43,	1,	NULL,	NULL,	43,	1,	43,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(44,	1,	NULL,	NULL,	44,	1,	44,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(45,	1,	NULL,	NULL,	45,	1,	45,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(46,	1,	NULL,	NULL,	46,	1,	46,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(47,	1,	NULL,	NULL,	47,	1,	47,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(48,	1,	NULL,	NULL,	48,	1,	48,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(49,	1,	NULL,	NULL,	49,	1,	49,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(50,	1,	NULL,	NULL,	50,	1,	50,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(51,	1,	NULL,	NULL,	51,	1,	51,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(52,	1,	NULL,	NULL,	52,	1,	52,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(53,	1,	NULL,	NULL,	53,	1,	53,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(54,	1,	NULL,	NULL,	54,	1,	54,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(55,	1,	NULL,	NULL,	55,	1,	55,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(56,	1,	NULL,	NULL,	56,	1,	56,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(57,	1,	NULL,	NULL,	57,	1,	57,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(58,	1,	NULL,	NULL,	58,	1,	58,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(59,	1,	NULL,	NULL,	59,	1,	59,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(60,	1,	NULL,	NULL,	60,	1,	60,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(61,	1,	NULL,	NULL,	61,	1,	61,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL),
(62,	1,	NULL,	NULL,	62,	1,	62,	0,	NULL,	'2020-08-20 12:07:21',	NULL,	NULL,	NULL,	NULL);

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

INSERT INTO `permission` (`permission_id`, `permission_track_number`, `permission_name`, `permission_description`, `permission_is_active`, `fk_permission_label_id`, `permission_type`, `permission_field`, `fk_menu_id`, `fk_approval_id`, `fk_status_id`, `permission_created_date`, `permission_created_by`, `permission_deleted_at`, `permission_last_modified_date`, `permission_last_modified_by`) VALUES
(1,	'PEON-76240',	'Create Account system',	'Create Account system',	1,	1,	1,	'',	1,	36,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(2,	'PEON-74578',	'Read Account system',	'Read Account system',	1,	2,	1,	'',	1,	37,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(3,	'PEON-86146',	'Update Account system',	'Update Account system',	1,	3,	1,	'',	1,	38,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(4,	'PEON-5991',	'Delete Account system',	'Delete Account system',	1,	4,	1,	'',	1,	39,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(5,	'PEON-53868',	'Create Approval',	'Create Approval',	1,	1,	1,	'',	2,	40,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(6,	'PEON-63910',	'Read Approval',	'Read Approval',	1,	2,	1,	'',	2,	41,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(7,	'PEON-85335',	'Update Approval',	'Update Approval',	1,	3,	1,	'',	2,	42,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(8,	'PEON-50055',	'Delete Approval',	'Delete Approval',	1,	4,	1,	'',	2,	43,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(9,	'PEON-86182',	'Create Approval flow',	'Create Approval flow',	1,	1,	1,	'',	3,	44,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:18',	1),
(10,	'PEON-33063',	'Read Approval flow',	'Read Approval flow',	1,	2,	1,	'',	3,	45,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(11,	'PEON-27426',	'Update Approval flow',	'Update Approval flow',	1,	3,	1,	'',	3,	46,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(12,	'PEON-5369',	'Delete Approval flow',	'Delete Approval flow',	1,	4,	1,	'',	3,	47,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(13,	'PEON-20655',	'Create Approve item',	'Create Approve item',	1,	1,	1,	'',	4,	48,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(14,	'PEON-46544',	'Read Approve item',	'Read Approve item',	1,	2,	1,	'',	4,	49,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(15,	'PEON-25761',	'Update Approve item',	'Update Approve item',	1,	3,	1,	'',	4,	50,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(16,	'PEON-3343',	'Delete Approve item',	'Delete Approve item',	1,	4,	1,	'',	4,	51,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(17,	'PEON-56165',	'Create Bank',	'Create Bank',	1,	1,	1,	'',	5,	52,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(18,	'PEON-80903',	'Read Bank',	'Read Bank',	1,	2,	1,	'',	5,	53,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(19,	'PEON-43893',	'Update Bank',	'Update Bank',	1,	3,	1,	'',	5,	54,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(20,	'PEON-46842',	'Delete Bank',	'Delete Bank',	1,	4,	1,	'',	5,	55,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(21,	'PEON-20595',	'Create Budget',	'Create Budget',	1,	1,	1,	'',	6,	56,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(22,	'PEON-65753',	'Read Budget',	'Read Budget',	1,	2,	1,	'',	6,	57,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(23,	'PEON-88008',	'Update Budget',	'Update Budget',	1,	3,	1,	'',	6,	58,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(24,	'PEON-16074',	'Delete Budget',	'Delete Budget',	1,	4,	1,	'',	6,	59,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(25,	'PEON-56412',	'Create Budget item',	'Create Budget item',	1,	1,	1,	'',	7,	60,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(26,	'PEON-50860',	'Read Budget item',	'Read Budget item',	1,	2,	1,	'',	7,	61,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(27,	'PEON-26799',	'Update Budget item',	'Update Budget item',	1,	3,	1,	'',	7,	62,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(28,	'PEON-13829',	'Delete Budget item',	'Delete Budget item',	1,	4,	1,	'',	7,	63,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(29,	'PEON-78753',	'Create Context center',	'Create Context center',	1,	1,	1,	'',	8,	64,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(30,	'PEON-7136',	'Read Context center',	'Read Context center',	1,	2,	1,	'',	8,	65,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(31,	'PEON-68599',	'Update Context center',	'Update Context center',	1,	3,	1,	'',	8,	66,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(32,	'PEON-30339',	'Delete Context center',	'Delete Context center',	1,	4,	1,	'',	8,	67,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(33,	'PEON-12248',	'Create Context center user',	'Create Context center user',	1,	1,	1,	'',	9,	68,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(34,	'PEON-88325',	'Read Context center user',	'Read Context center user',	1,	2,	1,	'',	9,	69,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(35,	'PEON-13564',	'Update Context center user',	'Update Context center user',	1,	3,	1,	'',	9,	70,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(36,	'PEON-85551',	'Delete Context center user',	'Delete Context center user',	1,	4,	1,	'',	9,	71,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(37,	'PEON-86805',	'Create Context cluster',	'Create Context cluster',	1,	1,	1,	'',	10,	72,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(38,	'PEON-75275',	'Read Context cluster',	'Read Context cluster',	1,	2,	1,	'',	10,	73,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(39,	'PEON-43948',	'Update Context cluster',	'Update Context cluster',	1,	3,	1,	'',	10,	74,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(40,	'PEON-14378',	'Delete Context cluster',	'Delete Context cluster',	1,	4,	1,	'',	10,	75,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(41,	'PEON-72399',	'Create Context cluster user',	'Create Context cluster user',	1,	1,	1,	'',	11,	76,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(42,	'PEON-82889',	'Read Context cluster user',	'Read Context cluster user',	1,	2,	1,	'',	11,	77,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(43,	'PEON-75397',	'Update Context cluster user',	'Update Context cluster user',	1,	3,	1,	'',	11,	78,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(44,	'PEON-37444',	'Delete Context cluster user',	'Delete Context cluster user',	1,	4,	1,	'',	11,	79,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(45,	'PEON-5723',	'Create Context cohort',	'Create Context cohort',	1,	1,	1,	'',	12,	80,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(46,	'PEON-88152',	'Read Context cohort',	'Read Context cohort',	1,	2,	1,	'',	12,	81,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(47,	'PEON-22650',	'Update Context cohort',	'Update Context cohort',	1,	3,	1,	'',	12,	82,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(48,	'PEON-31630',	'Delete Context cohort',	'Delete Context cohort',	1,	4,	1,	'',	12,	83,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(49,	'PEON-67994',	'Create Context cohort user',	'Create Context cohort user',	1,	1,	1,	'',	13,	84,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(50,	'PEON-23447',	'Read Context cohort user',	'Read Context cohort user',	1,	2,	1,	'',	13,	85,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(51,	'PEON-27506',	'Update Context cohort user',	'Update Context cohort user',	1,	3,	1,	'',	13,	86,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(52,	'PEON-24247',	'Delete Context cohort user',	'Delete Context cohort user',	1,	4,	1,	'',	13,	87,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(53,	'PEON-85514',	'Create Context country',	'Create Context country',	1,	1,	1,	'',	14,	88,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(54,	'PEON-75434',	'Read Context country',	'Read Context country',	1,	2,	1,	'',	14,	89,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(55,	'PEON-86544',	'Update Context country',	'Update Context country',	1,	3,	1,	'',	14,	90,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(56,	'PEON-76484',	'Delete Context country',	'Delete Context country',	1,	4,	1,	'',	14,	91,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(57,	'PEON-86446',	'Create Context country user',	'Create Context country user',	1,	1,	1,	'',	15,	92,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(58,	'PEON-56953',	'Read Context country user',	'Read Context country user',	1,	2,	1,	'',	15,	93,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(59,	'PEON-9077',	'Update Context country user',	'Update Context country user',	1,	3,	1,	'',	15,	94,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(60,	'PEON-71716',	'Delete Context country user',	'Delete Context country user',	1,	4,	1,	'',	15,	95,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(61,	'PEON-60523',	'Create Context definition',	'Create Context definition',	1,	1,	1,	'',	16,	96,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(62,	'PEON-12261',	'Read Context definition',	'Read Context definition',	1,	2,	1,	'',	16,	97,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(63,	'PEON-76555',	'Update Context definition',	'Update Context definition',	1,	3,	1,	'',	16,	98,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(64,	'PEON-30740',	'Delete Context definition',	'Delete Context definition',	1,	4,	1,	'',	16,	99,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(65,	'PEON-13697',	'Create Context global',	'Create Context global',	1,	1,	1,	'',	17,	100,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(66,	'PEON-78861',	'Read Context global',	'Read Context global',	1,	2,	1,	'',	17,	101,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(67,	'PEON-46361',	'Update Context global',	'Update Context global',	1,	3,	1,	'',	17,	102,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(68,	'PEON-76837',	'Delete Context global',	'Delete Context global',	1,	4,	1,	'',	17,	103,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(69,	'PEON-4305',	'Create Context global user',	'Create Context global user',	1,	1,	1,	'',	18,	104,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(70,	'PEON-43749',	'Read Context global user',	'Read Context global user',	1,	2,	1,	'',	18,	105,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(71,	'PEON-33632',	'Update Context global user',	'Update Context global user',	1,	3,	1,	'',	18,	106,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(72,	'PEON-39064',	'Delete Context global user',	'Delete Context global user',	1,	4,	1,	'',	18,	107,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(73,	'PEON-57492',	'Create Context region',	'Create Context region',	1,	1,	1,	'',	19,	108,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(74,	'PEON-42563',	'Read Context region',	'Read Context region',	1,	2,	1,	'',	19,	109,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(75,	'PEON-73496',	'Update Context region',	'Update Context region',	1,	3,	1,	'',	19,	110,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(76,	'PEON-49364',	'Delete Context region',	'Delete Context region',	1,	4,	1,	'',	19,	111,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(77,	'PEON-9079',	'Create Context region user',	'Create Context region user',	1,	1,	1,	'',	20,	112,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(78,	'PEON-33650',	'Read Context region user',	'Read Context region user',	1,	2,	1,	'',	20,	113,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(79,	'PEON-21213',	'Update Context region user',	'Update Context region user',	1,	3,	1,	'',	20,	114,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(80,	'PEON-84180',	'Delete Context region user',	'Delete Context region user',	1,	4,	1,	'',	20,	115,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(81,	'PEON-3185',	'Create Contra account',	'Create Contra account',	1,	1,	1,	'',	21,	116,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(82,	'PEON-66658',	'Read Contra account',	'Read Contra account',	1,	2,	1,	'',	21,	117,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(83,	'PEON-48339',	'Update Contra account',	'Update Contra account',	1,	3,	1,	'',	21,	118,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(84,	'PEON-76970',	'Delete Contra account',	'Delete Contra account',	1,	4,	1,	'',	21,	119,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(85,	'PEON-12906',	'Create Country currency',	'Create Country currency',	1,	1,	1,	'',	22,	120,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(86,	'PEON-23399',	'Read Country currency',	'Read Country currency',	1,	2,	1,	'',	22,	121,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(87,	'PEON-41256',	'Update Country currency',	'Update Country currency',	1,	3,	1,	'',	22,	122,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(88,	'PEON-66211',	'Delete Country currency',	'Delete Country currency',	1,	4,	1,	'',	22,	123,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(89,	'PEON-8230',	'Create Currency conversion',	'Create Currency conversion',	1,	1,	1,	'',	23,	124,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(90,	'PEON-38568',	'Read Currency conversion',	'Read Currency conversion',	1,	2,	1,	'',	23,	125,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(91,	'PEON-9845',	'Update Currency conversion',	'Update Currency conversion',	1,	3,	1,	'',	23,	126,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(92,	'PEON-49825',	'Delete Currency conversion',	'Delete Currency conversion',	1,	4,	1,	'',	23,	127,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(93,	'PEON-5517',	'Create Dashboard',	'Create Dashboard',	1,	1,	1,	'',	24,	128,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(94,	'PEON-43609',	'Read Dashboard',	'Read Dashboard',	1,	2,	1,	'',	24,	129,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(95,	'PEON-8561',	'Update Dashboard',	'Update Dashboard',	1,	3,	1,	'',	24,	130,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(96,	'PEON-58653',	'Delete Dashboard',	'Delete Dashboard',	1,	4,	1,	'',	24,	131,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:19',	1),
(97,	'PEON-59262',	'Create Department',	'Create Department',	1,	1,	1,	'',	25,	132,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(98,	'PEON-35310',	'Read Department',	'Read Department',	1,	2,	1,	'',	25,	133,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(99,	'PEON-62697',	'Update Department',	'Update Department',	1,	3,	1,	'',	25,	134,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(100,	'PEON-16100',	'Delete Department',	'Delete Department',	1,	4,	1,	'',	25,	135,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(101,	'PEON-19580',	'Create Designation',	'Create Designation',	1,	1,	1,	'',	26,	136,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(102,	'PEON-42115',	'Read Designation',	'Read Designation',	1,	2,	1,	'',	26,	137,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(103,	'PEON-34985',	'Update Designation',	'Update Designation',	1,	3,	1,	'',	26,	138,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(104,	'PEON-11490',	'Delete Designation',	'Delete Designation',	1,	4,	1,	'',	26,	139,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(105,	'PEON-74542',	'Create Expense account',	'Create Expense account',	1,	1,	1,	'',	27,	140,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(106,	'PEON-8686',	'Read Expense account',	'Read Expense account',	1,	2,	1,	'',	27,	141,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(107,	'PEON-86077',	'Update Expense account',	'Update Expense account',	1,	3,	1,	'',	27,	142,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(108,	'PEON-58073',	'Delete Expense account',	'Delete Expense account',	1,	4,	1,	'',	27,	143,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(109,	'PEON-1140',	'Create Financial report',	'Create Financial report',	1,	1,	1,	'',	28,	144,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(110,	'PEON-75371',	'Read Financial report',	'Read Financial report',	1,	2,	1,	'',	28,	145,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(111,	'PEON-63823',	'Update Financial report',	'Update Financial report',	1,	3,	1,	'',	28,	146,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(112,	'PEON-63347',	'Delete Financial report',	'Delete Financial report',	1,	4,	1,	'',	28,	147,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(113,	'PEON-3832',	'Create Funder',	'Create Funder',	1,	1,	1,	'',	29,	148,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(114,	'PEON-76069',	'Read Funder',	'Read Funder',	1,	2,	1,	'',	29,	149,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(115,	'PEON-56804',	'Update Funder',	'Update Funder',	1,	3,	1,	'',	29,	150,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(116,	'PEON-11175',	'Delete Funder',	'Delete Funder',	1,	4,	1,	'',	29,	151,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(117,	'PEON-9918',	'Create Funding status',	'Create Funding status',	1,	1,	1,	'',	30,	152,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(118,	'PEON-11998',	'Read Funding status',	'Read Funding status',	1,	2,	1,	'',	30,	153,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(119,	'PEON-60859',	'Update Funding status',	'Update Funding status',	1,	3,	1,	'',	30,	154,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(120,	'PEON-11625',	'Delete Funding status',	'Delete Funding status',	1,	4,	1,	'',	30,	155,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(121,	'PEON-81484',	'Create History',	'Create History',	1,	1,	1,	'',	31,	156,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(122,	'PEON-50550',	'Read History',	'Read History',	1,	2,	1,	'',	31,	157,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(123,	'PEON-12139',	'Update History',	'Update History',	1,	3,	1,	'',	31,	158,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(124,	'PEON-37357',	'Delete History',	'Delete History',	1,	4,	1,	'',	31,	159,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(125,	'PEON-11513',	'Create Income account',	'Create Income account',	1,	1,	1,	'',	32,	160,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(126,	'PEON-67933',	'Read Income account',	'Read Income account',	1,	2,	1,	'',	32,	161,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(127,	'PEON-51757',	'Update Income account',	'Update Income account',	1,	3,	1,	'',	32,	162,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(128,	'PEON-66282',	'Delete Income account',	'Delete Income account',	1,	4,	1,	'',	32,	163,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(129,	'PEON-82227',	'Create Journal',	'Create Journal',	1,	1,	1,	'',	33,	164,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(130,	'PEON-54385',	'Read Journal',	'Read Journal',	1,	2,	1,	'',	33,	165,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(131,	'PEON-66400',	'Update Journal',	'Update Journal',	1,	3,	1,	'',	33,	166,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(132,	'PEON-54206',	'Delete Journal',	'Delete Journal',	1,	4,	1,	'',	33,	167,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(133,	'PEON-40943',	'Create Language',	'Create Language',	1,	1,	1,	'',	34,	168,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(134,	'PEON-10483',	'Read Language',	'Read Language',	1,	2,	1,	'',	34,	169,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(135,	'PEON-34112',	'Update Language',	'Update Language',	1,	3,	1,	'',	34,	170,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(136,	'PEON-38641',	'Delete Language',	'Delete Language',	1,	4,	1,	'',	34,	171,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(137,	'PEON-8313',	'Create Language phrase',	'Create Language phrase',	1,	1,	1,	'',	35,	172,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(138,	'PEON-14068',	'Read Language phrase',	'Read Language phrase',	1,	2,	1,	'',	35,	173,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(139,	'PEON-16574',	'Update Language phrase',	'Update Language phrase',	1,	3,	1,	'',	35,	174,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(140,	'PEON-56866',	'Delete Language phrase',	'Delete Language phrase',	1,	4,	1,	'',	35,	175,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(141,	'PEON-88049',	'Create Menu user order',	'Create Menu user order',	1,	1,	1,	'',	36,	176,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(142,	'PEON-1462',	'Read Menu user order',	'Read Menu user order',	1,	2,	1,	'',	36,	177,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(143,	'PEON-63600',	'Update Menu user order',	'Update Menu user order',	1,	3,	1,	'',	36,	178,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(144,	'PEON-36924',	'Delete Menu user order',	'Delete Menu user order',	1,	4,	1,	'',	36,	179,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(145,	'PEON-7657',	'Create Month',	'Create Month',	1,	1,	1,	'',	37,	180,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(146,	'PEON-28030',	'Read Month',	'Read Month',	1,	2,	1,	'',	37,	181,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(147,	'PEON-36025',	'Update Month',	'Update Month',	1,	3,	1,	'',	37,	182,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(148,	'PEON-84970',	'Delete Month',	'Delete Month',	1,	4,	1,	'',	37,	183,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(149,	'PEON-84547',	'Create Office',	'Create Office',	1,	1,	1,	'',	38,	184,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(150,	'PEON-74582',	'Read Office',	'Read Office',	1,	2,	1,	'',	38,	185,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(151,	'PEON-34348',	'Update Office',	'Update Office',	1,	3,	1,	'',	38,	186,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(152,	'PEON-55438',	'Delete Office',	'Delete Office',	1,	4,	1,	'',	38,	187,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(153,	'PEON-88420',	'Create Office bank',	'Create Office bank',	1,	1,	1,	'',	39,	188,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(154,	'PEON-33066',	'Read Office bank',	'Read Office bank',	1,	2,	1,	'',	39,	189,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(155,	'PEON-51169',	'Update Office bank',	'Update Office bank',	1,	3,	1,	'',	39,	190,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(156,	'PEON-77705',	'Delete Office bank',	'Delete Office bank',	1,	4,	1,	'',	39,	191,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(157,	'PEON-69861',	'Create Office bank project allocation',	'Create Office bank project allocation',	1,	1,	1,	'',	40,	192,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(158,	'PEON-76066',	'Read Office bank project allocation',	'Read Office bank project allocation',	1,	2,	1,	'',	40,	193,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(159,	'PEON-6796',	'Update Office bank project allocation',	'Update Office bank project allocation',	1,	3,	1,	'',	40,	194,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(160,	'PEON-56643',	'Delete Office bank project allocation',	'Delete Office bank project allocation',	1,	4,	1,	'',	40,	195,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(161,	'PEON-1255',	'Create Office cash',	'Create Office cash',	1,	1,	1,	'',	41,	196,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(162,	'PEON-17016',	'Read Office cash',	'Read Office cash',	1,	2,	1,	'',	41,	197,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(163,	'PEON-44060',	'Update Office cash',	'Update Office cash',	1,	3,	1,	'',	41,	198,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(164,	'PEON-19787',	'Delete Office cash',	'Delete Office cash',	1,	4,	1,	'',	41,	199,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(165,	'PEON-28148',	'Create Opening bank balance',	'Create Opening bank balance',	1,	1,	1,	'',	42,	200,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(166,	'PEON-85925',	'Read Opening bank balance',	'Read Opening bank balance',	1,	2,	1,	'',	42,	201,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(167,	'PEON-60464',	'Update Opening bank balance',	'Update Opening bank balance',	1,	3,	1,	'',	42,	202,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(168,	'PEON-29696',	'Delete Opening bank balance',	'Delete Opening bank balance',	1,	4,	1,	'',	42,	203,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(169,	'PEON-51618',	'Create Page view',	'Create Page view',	1,	1,	1,	'',	43,	204,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(170,	'PEON-18922',	'Read Page view',	'Read Page view',	1,	2,	1,	'',	43,	205,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(171,	'PEON-63160',	'Update Page view',	'Update Page view',	1,	3,	1,	'',	43,	206,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(172,	'PEON-67247',	'Delete Page view',	'Delete Page view',	1,	4,	1,	'',	43,	207,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(173,	'PEON-41714',	'Create Permission label',	'Create Permission label',	1,	1,	1,	'',	44,	208,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(174,	'PEON-10290',	'Read Permission label',	'Read Permission label',	1,	2,	1,	'',	44,	209,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(175,	'PEON-38796',	'Update Permission label',	'Update Permission label',	1,	3,	1,	'',	44,	210,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(176,	'PEON-32883',	'Delete Permission label',	'Delete Permission label',	1,	4,	1,	'',	44,	211,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(177,	'PEON-65968',	'Create Project',	'Create Project',	1,	1,	1,	'',	45,	212,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(178,	'PEON-46270',	'Read Project',	'Read Project',	1,	2,	1,	'',	45,	213,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(179,	'PEON-86682',	'Update Project',	'Update Project',	1,	3,	1,	'',	45,	214,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(180,	'PEON-12066',	'Delete Project',	'Delete Project',	1,	4,	1,	'',	45,	215,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(181,	'PEON-63355',	'Create Project allocation',	'Create Project allocation',	1,	1,	1,	'',	46,	216,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(182,	'PEON-42751',	'Read Project allocation',	'Read Project allocation',	1,	2,	1,	'',	46,	217,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(183,	'PEON-4919',	'Update Project allocation',	'Update Project allocation',	1,	3,	1,	'',	46,	218,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(184,	'PEON-38329',	'Delete Project allocation',	'Delete Project allocation',	1,	4,	1,	'',	46,	219,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(185,	'PEON-63323',	'Create Project cost proportion',	'Create Project cost proportion',	1,	1,	1,	'',	47,	220,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(186,	'PEON-11022',	'Read Project cost proportion',	'Read Project cost proportion',	1,	2,	1,	'',	47,	221,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(187,	'PEON-26333',	'Update Project cost proportion',	'Update Project cost proportion',	1,	3,	1,	'',	47,	222,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(188,	'PEON-11041',	'Delete Project cost proportion',	'Delete Project cost proportion',	1,	4,	1,	'',	47,	223,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(189,	'PEON-86654',	'Create Project income account',	'Create Project income account',	1,	1,	1,	'',	48,	224,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(190,	'PEON-21777',	'Read Project income account',	'Read Project income account',	1,	2,	1,	'',	48,	225,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(191,	'PEON-31338',	'Update Project income account',	'Update Project income account',	1,	3,	1,	'',	48,	226,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(192,	'PEON-20031',	'Delete Project income account',	'Delete Project income account',	1,	4,	1,	'',	48,	227,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(193,	'PEON-31958',	'Create Request',	'Create Request',	1,	1,	1,	'',	49,	228,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(194,	'PEON-40351',	'Read Request',	'Read Request',	1,	2,	1,	'',	49,	229,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(195,	'PEON-10865',	'Update Request',	'Update Request',	1,	3,	1,	'',	49,	230,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(196,	'PEON-16577',	'Delete Request',	'Delete Request',	1,	4,	1,	'',	49,	231,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:20',	1),
(197,	'PEON-23928',	'Create Request conversion',	'Create Request conversion',	1,	1,	1,	'',	50,	232,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(198,	'PEON-6052',	'Read Request conversion',	'Read Request conversion',	1,	2,	1,	'',	50,	233,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(199,	'PEON-61154',	'Update Request conversion',	'Update Request conversion',	1,	3,	1,	'',	50,	234,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(200,	'PEON-17472',	'Delete Request conversion',	'Delete Request conversion',	1,	4,	1,	'',	50,	235,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(201,	'PEON-61590',	'Create Request type',	'Create Request type',	1,	1,	1,	'',	51,	236,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(202,	'PEON-60408',	'Read Request type',	'Read Request type',	1,	2,	1,	'',	51,	237,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(203,	'PEON-86422',	'Update Request type',	'Update Request type',	1,	3,	1,	'',	51,	238,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(204,	'PEON-59301',	'Delete Request type',	'Delete Request type',	1,	4,	1,	'',	51,	239,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(205,	'PEON-54098',	'Create Role',	'Create Role',	1,	1,	1,	'',	52,	240,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(206,	'PEON-46615',	'Read Role',	'Read Role',	1,	2,	1,	'',	52,	241,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(207,	'PEON-26675',	'Update Role',	'Update Role',	1,	3,	1,	'',	52,	242,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(208,	'PEON-77609',	'Delete Role',	'Delete Role',	1,	4,	1,	'',	52,	243,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(209,	'PEON-62298',	'Create Setting',	'Create Setting',	1,	1,	1,	'',	53,	244,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(210,	'PEON-8940',	'Read Setting',	'Read Setting',	1,	2,	1,	'',	53,	245,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(211,	'PEON-45242',	'Update Setting',	'Update Setting',	1,	3,	1,	'',	53,	246,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(212,	'PEON-13521',	'Delete Setting',	'Delete Setting',	1,	4,	1,	'',	53,	247,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(213,	'PEON-67281',	'Create System opening balance',	'Create System opening balance',	1,	1,	1,	'',	54,	248,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(214,	'PEON-42603',	'Read System opening balance',	'Read System opening balance',	1,	2,	1,	'',	54,	249,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(215,	'PEON-32490',	'Update System opening balance',	'Update System opening balance',	1,	3,	1,	'',	54,	250,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(216,	'PEON-1666',	'Delete System opening balance',	'Delete System opening balance',	1,	4,	1,	'',	54,	251,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(217,	'PEON-14752',	'Create Translation',	'Create Translation',	1,	1,	1,	'',	55,	252,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(218,	'PEON-37252',	'Read Translation',	'Read Translation',	1,	2,	1,	'',	55,	253,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(219,	'PEON-14364',	'Update Translation',	'Update Translation',	1,	3,	1,	'',	55,	254,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(220,	'PEON-5708',	'Delete Translation',	'Delete Translation',	1,	4,	1,	'',	55,	255,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(221,	'PEON-89150',	'Create User',	'Create User',	1,	1,	1,	'',	56,	256,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(222,	'PEON-20122',	'Read User',	'Read User',	1,	2,	1,	'',	56,	257,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(223,	'PEON-50606',	'Update User',	'Update User',	1,	3,	1,	'',	56,	258,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(224,	'PEON-82444',	'Delete User',	'Delete User',	1,	4,	1,	'',	56,	259,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(225,	'PEON-36220',	'Create Variance note',	'Create Variance note',	1,	1,	1,	'',	57,	260,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(226,	'PEON-47997',	'Read Variance note',	'Read Variance note',	1,	2,	1,	'',	57,	261,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(227,	'PEON-52131',	'Update Variance note',	'Update Variance note',	1,	3,	1,	'',	57,	262,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(228,	'PEON-46148',	'Delete Variance note',	'Delete Variance note',	1,	4,	1,	'',	57,	263,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(229,	'PEON-63756',	'Create Voucher',	'Create Voucher',	1,	1,	1,	'',	58,	264,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(230,	'PEON-37595',	'Read Voucher',	'Read Voucher',	1,	2,	1,	'',	58,	265,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(231,	'PEON-12554',	'Update Voucher',	'Update Voucher',	1,	3,	1,	'',	58,	266,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(232,	'PEON-61940',	'Delete Voucher',	'Delete Voucher',	1,	4,	1,	'',	58,	267,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(233,	'PEON-3111',	'Create Voucher type',	'Create Voucher type',	1,	1,	1,	'',	59,	268,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(234,	'PEON-46857',	'Read Voucher type',	'Read Voucher type',	1,	2,	1,	'',	59,	269,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(235,	'PEON-75018',	'Update Voucher type',	'Update Voucher type',	1,	3,	1,	'',	59,	270,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(236,	'PEON-70725',	'Delete Voucher type',	'Delete Voucher type',	1,	4,	1,	'',	59,	271,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(237,	'PEON-60878',	'Create Voucher type account',	'Create Voucher type account',	1,	1,	1,	'',	60,	272,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(238,	'PEON-20929',	'Read Voucher type account',	'Read Voucher type account',	1,	2,	1,	'',	60,	273,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(239,	'PEON-71826',	'Update Voucher type account',	'Update Voucher type account',	1,	3,	1,	'',	60,	274,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(240,	'PEON-26866',	'Delete Voucher type account',	'Delete Voucher type account',	1,	4,	1,	'',	60,	275,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(241,	'PEON-85928',	'Create Voucher type effect',	'Create Voucher type effect',	1,	1,	1,	'',	61,	276,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(242,	'PEON-54168',	'Read Voucher type effect',	'Read Voucher type effect',	1,	2,	1,	'',	61,	277,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(243,	'PEON-24920',	'Update Voucher type effect',	'Update Voucher type effect',	1,	3,	1,	'',	61,	278,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(244,	'PEON-75936',	'Delete Voucher type effect',	'Delete Voucher type effect',	1,	4,	1,	'',	61,	279,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(245,	'PEON-32374',	'Create Workplan',	'Create Workplan',	1,	1,	1,	'',	62,	280,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(246,	'PEON-11975',	'Read Workplan',	'Read Workplan',	1,	2,	1,	'',	62,	281,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(247,	'PEON-66342',	'Update Workplan',	'Update Workplan',	1,	3,	1,	'',	62,	282,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1),
(248,	'PEON-65332',	'Delete Workplan',	'Delete Workplan',	1,	4,	1,	'',	62,	283,	56,	'2020-08-20',	1,	NULL,	'2020-08-20 12:07:21',	1);

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


-- 2020-08-20 12:07:54

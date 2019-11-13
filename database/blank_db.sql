-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(396,	'User_setting',	'User_setting',	1,	NULL,	NULL,	NULL,	NULL),
(397,	'Voucher',	'Voucher',	1,	NULL,	NULL,	NULL,	NULL),
(398,	'Workplan',	'Workplan',	1,	NULL,	NULL,	NULL,	NULL),
(400,	'User',	'User',	1,	NULL,	NULL,	NULL,	NULL),
(401,	'Approve_item',	'Approve_item',	1,	NULL,	NULL,	NULL,	NULL),
(402,	'Status',	'Status',	1,	NULL,	NULL,	NULL,	NULL),
(424,	'Center_group',	'Center_group',	1,	NULL,	NULL,	NULL,	NULL),
(425,	'Center_group_hierarchy',	'Center_group_hierarchy',	1,	NULL,	NULL,	NULL,	NULL),
(426,	'Center_group_link',	'Center_group_link',	1,	NULL,	NULL,	NULL,	NULL);

-- 2019-11-13 21:13:15

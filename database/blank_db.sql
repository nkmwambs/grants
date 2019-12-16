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
(146,	'APR-45830',	'Approval Ticket # APR-45830',	22,	87,	1,	'2019-11-07',	'2019-11-07 11:34:49',	1),
(147,	'APR-88163',	'Approval Ticket # APR-88163',	23,	87,	1,	'2019-11-07',	'2019-11-07 11:36:09',	1),
(148,	'APR-13132',	'Approval Ticket # APR-13132',	22,	87,	1,	'2019-11-07',	'2019-11-07 12:03:32',	1),
(149,	'APR-15968',	'Approval Ticket # APR-15968',	23,	87,	1,	'2019-11-07',	'2019-11-07 12:04:08',	1),
(150,	'APR-64360',	'Approval Ticket # APR-64360',	21,	87,	1,	'2019-11-07',	'2019-11-07 13:26:58',	8),
(151,	'APR-6172',	'Approval Ticket # APR-6172',	20,	87,	1,	'2019-11-07',	'2019-11-07 12:53:15',	1),
(152,	'APR-64367',	'Approval Ticket # APR-64367',	26,	87,	1,	'2019-11-07',	'2019-11-07 13:26:58',	1),
(154,	'APR-80682',	'Approval Ticket # APR-80682',	19,	87,	1,	'2019-11-07',	'2019-11-11 09:30:15',	1),
(156,	'APAL-81132',	'Approval Ticket # APAL-81132',	19,	87,	1,	'2019-11-07',	'2019-11-07 14:05:14',	1),
(157,	'APAL-76190',	'Approval Ticket # APAL-76190',	22,	87,	1,	'2019-11-07',	'2019-11-07 14:06:25',	1),
(158,	'APAL-52378',	'Approval Ticket # APAL-52378',	19,	87,	1,	'2019-11-07',	'2019-11-07 14:07:04',	1),
(160,	'APAL-25105',	'Approval Ticket # APAL-25105',	29,	87,	1,	'2019-11-08',	'2019-11-08 07:21:31',	1),
(161,	'APAL-38118',	'Approval Ticket # APAL-38118',	29,	87,	1,	'2019-11-08',	'2019-11-08 07:24:42',	1),
(162,	'APAL-75620',	'Approval Ticket # APAL-75620',	29,	87,	1,	'2019-11-08',	'2019-11-08 07:55:20',	1),
(163,	'APAL-10692',	'Approval Ticket # APAL-10692',	23,	87,	1,	'2019-11-08',	'2019-11-08 09:23:41',	1),
(164,	'APAL-84180',	'Approval Ticket # APAL-84180',	23,	87,	1,	'2019-11-08',	'2019-11-08 09:24:14',	1),
(165,	'APAL-79894',	'Approval Ticket # APAL-79894',	22,	87,	1,	'2019-11-08',	'2019-11-08 09:35:12',	1),
(166,	'APAL-6771',	'Approval Ticket # APAL-6771',	23,	87,	1,	'2019-11-08',	'2019-11-08 09:57:44',	1),
(167,	'APAL-57745',	'Approval Ticket # APAL-57745',	21,	87,	1,	'2019-11-08',	'2019-11-08 10:06:09',	1),
(168,	'APAL-85894',	'Approval Ticket # APAL-85894',	23,	87,	1,	'2019-11-08',	'2019-11-08 10:09:04',	1),
(169,	'APAL-2174',	'Approval Ticket # APAL-2174',	23,	87,	1,	'2019-11-08',	'2019-11-08 10:09:34',	1),
(170,	'APAL-88744',	'Approval Ticket # APAL-88744',	26,	87,	2,	'2019-11-08',	'2019-11-08 11:03:07',	2),
(171,	'APAL-84595',	'Approval Ticket # APAL-84595',	22,	87,	1,	'2019-11-08',	'2019-11-08 11:32:48',	1),
(172,	'APAL-52466',	'Approval Ticket # APAL-52466',	22,	87,	1,	'2019-11-08',	'2019-11-08 11:33:33',	1),
(173,	'APAL-14516',	'Approval Ticket # APAL-14516',	23,	87,	1,	'2019-11-08',	'2019-11-08 11:34:43',	1),
(174,	'APAL-32516',	'Approval Ticket # APAL-32516',	23,	87,	1,	'2019-11-08',	'2019-11-08 11:35:07',	1),
(175,	'APAL-18028',	'Approval Ticket # APAL-18028',	21,	87,	1,	'2019-11-08',	'2019-11-08 11:38:04',	1),
(176,	'APAL-88261',	'Approval Ticket # APAL-88261',	29,	87,	1,	'2019-11-08',	'2019-11-08 11:57:17',	1),
(177,	'APAL-8283',	'Approval Ticket # APAL-8283',	29,	87,	1,	'2019-11-08',	'2019-11-08 12:14:22',	1),
(178,	'APAL-82917',	'Approval Ticket # APAL-82917',	29,	87,	1,	'2019-11-08',	'2019-11-08 12:16:01',	1),
(179,	'APAL-8602',	'Approval Ticket # APAL-8602',	29,	87,	1,	'2019-11-08',	'2019-11-08 12:18:44',	1),
(180,	'APAL-42378',	'Approval Ticket # APAL-42378',	29,	87,	1,	'2019-11-08',	'2019-11-08 12:23:24',	1),
(181,	'APAL-28521',	'Approval Ticket # APAL-28521',	29,	87,	1,	'2019-11-08',	'2019-11-08 12:24:18',	1),
(182,	'APAL-76538',	'Approval Ticket # APAL-76538',	29,	87,	1,	'2019-11-08',	'2019-11-08 12:26:22',	1),
(185,	'APAL-67074',	'Approval Ticket # APAL-67074',	22,	87,	1,	'2019-11-08',	'2019-11-08 12:35:17',	1),
(186,	'APAL-89308',	'Approval Ticket # APAL-89308',	22,	87,	1,	'2019-11-08',	'2019-11-08 12:37:51',	1),
(187,	'APAL-54182',	'Approval Ticket # APAL-54182',	23,	87,	1,	'2019-11-08',	'2019-11-08 12:39:25',	1),
(188,	'APAL-61432',	'Approval Ticket # APAL-61432',	22,	87,	1,	'2019-11-08',	'2019-11-08 12:43:11',	1),
(189,	'APAL-43136',	'Approval Ticket # APAL-43136',	22,	87,	1,	'2019-11-08',	'2019-11-08 12:47:29',	1),
(190,	'APAL-6496',	'Approval Ticket # APAL-6496',	23,	87,	1,	'2019-11-08',	'2019-11-08 12:48:05',	1),
(191,	'APAL-62132',	'Approval Ticket # APAL-62132',	23,	87,	1,	'2019-11-08',	'2019-11-08 12:48:32',	1),
(192,	'APAL-78015',	'Approval Ticket # APAL-78015',	22,	87,	1,	'2019-11-08',	'2019-11-08 13:30:17',	1),
(193,	'APAL-78908',	'Approval Ticket # APAL-78908',	23,	87,	1,	'2019-11-08',	'2019-11-08 13:31:03',	1),
(194,	'APAL-6342',	'Approval Ticket # APAL-6342',	23,	87,	1,	'2019-11-08',	'2019-11-08 14:17:53',	1),
(195,	'APAL-82116',	'Approval Ticket # APAL-82116',	23,	87,	1,	'2019-11-08',	'2019-11-08 14:18:12',	1),
(196,	'APAL-65833',	'Approval Ticket # APAL-65833',	2,	87,	2,	'2019-11-08',	'2019-11-08 15:43:40',	2),
(197,	'APAL-54353',	'Approval Ticket # APAL-54353',	22,	87,	1,	'2019-11-08',	'2019-11-08 17:26:32',	1),
(198,	'APAL-85692',	'Approval Ticket # APAL-85692',	23,	87,	1,	'2019-11-08',	'2019-11-08 17:28:08',	1),
(199,	'APAL-40108',	'Approval Ticket # APAL-40108',	22,	87,	1,	'2019-11-08',	'2019-11-08 17:29:44',	1),
(200,	'APAL-69287',	'Approval Ticket # APAL-69287',	23,	87,	1,	'2019-11-08',	'2019-11-08 17:31:28',	1),
(201,	'APAL-13425',	'Approval Ticket # APAL-13425',	23,	87,	1,	'2019-11-08',	'2019-11-08 17:31:49',	1),
(203,	'APAL-63537',	'Approval Ticket # APAL-63537',	2,	87,	1,	'2019-11-11',	'2019-11-11 07:43:19',	1),
(205,	'APAL-59716',	'Approval Ticket # APAL-59716',	22,	87,	1,	'2019-11-11',	'2019-11-11 09:49:39',	1),
(206,	'APAL-75533',	'Approval Ticket # APAL-75533',	23,	87,	1,	'2019-11-11',	'2019-11-11 09:50:29',	1),
(207,	'APAL-59488',	'Approval Ticket # APAL-59488',	4,	87,	1,	'2019-11-12',	'2019-11-12 01:17:55',	1),
(208,	'APAL-30369',	'Approval Ticket # APAL-30369',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:49:51',	1),
(209,	'APAL-13369',	'Approval Ticket # APAL-13369',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:50:25',	1),
(210,	'APAL-65785',	'Approval Ticket # APAL-65785',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:51:40',	1),
(211,	'APAL-57065',	'Approval Ticket # APAL-57065',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:51:49',	1),
(212,	'APAL-67930',	'Approval Ticket # APAL-67930',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:52:11',	1),
(217,	'APAL-36755',	'Approval Ticket # APAL-36755',	33,	87,	1,	'2019-11-13',	'2019-11-13 22:43:42',	1),
(218,	'APAL-31473',	'Approval Ticket # APAL-31473',	29,	87,	1,	'2019-11-20',	'2019-11-20 16:40:43',	1),
(219,	'APAL-89876',	'Approval Ticket # APAL-89876',	21,	87,	1,	'2019-11-20',	'2019-11-20 16:41:17',	1),
(220,	'APAL-66521',	'Approval Ticket # APAL-66521',	22,	87,	1,	'2019-11-20',	'2019-11-20 16:51:26',	1),
(221,	'APAL-32589',	'Approval Ticket # APAL-32589',	23,	87,	1,	'2019-11-20',	'2019-11-20 16:52:41',	1),
(222,	'APAL-8542',	'Approval Ticket # APAL-8542',	22,	87,	1,	'2019-11-20',	'2019-11-20 17:04:36',	1),
(223,	'APAL-7134',	'Approval Ticket # APAL-7134',	23,	87,	1,	'2019-11-20',	'2019-11-20 17:05:06',	1),
(224,	'APAL-65378',	'Approval Ticket # APAL-65378',	23,	87,	1,	'2019-11-20',	'2019-11-20 17:12:14',	1),
(225,	'APAL-9934',	'Approval Ticket # APAL-9934',	36,	87,	1,	'2019-11-21',	'2019-11-20 23:15:14',	1),
(226,	'APAL-85574',	'Approval Ticket # APAL-85574',	8,	87,	1,	'2019-11-21',	'2019-11-20 23:37:31',	1),
(228,	'APAL-24385',	'Approval Ticket # APAL-24385',	42,	87,	1,	'2019-11-21',	'2019-11-21 05:46:23',	1),
(229,	'APAL-85274',	'Approval Ticket # APAL-85274',	43,	87,	1,	'2019-11-21',	'2019-11-21 05:48:53',	1),
(230,	'APAL-86475',	'Approval Ticket # APAL-86475',	43,	87,	1,	'2019-11-21',	'2019-11-21 05:49:11',	1),
(231,	'APAL-27869',	'Approval Ticket # APAL-27869',	43,	87,	1,	'2019-11-21',	'2019-11-21 05:49:28',	1),
(232,	'APAL-35730',	'Approval Ticket # APAL-35730',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:52:10',	1),
(233,	'APAL-61204',	'Approval Ticket # APAL-61204',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:52:27',	1),
(234,	'APAL-40979',	'Approval Ticket # APAL-40979',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:52:42',	1),
(235,	'APAL-77301',	'Approval Ticket # APAL-77301',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:52:56',	1),
(236,	'APAL-62839',	'Approval Ticket # APAL-62839',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:53:09',	1),
(237,	'APAL-34528',	'Approval Ticket # APAL-34528',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:53:23',	1),
(238,	'APAL-7340',	'Approval Ticket # APAL-7340',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:53:39',	1),
(239,	'APAL-38476',	'Approval Ticket # APAL-38476',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:53:53',	1),
(240,	'APAL-87161',	'Approval Ticket # APAL-87161',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:54:09',	1),
(241,	'APAL-83476',	'Approval Ticket # APAL-83476',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:54:22',	1),
(242,	'APAL-27540',	'Approval Ticket # APAL-27540',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:54:38',	1),
(243,	'APAL-76991',	'Approval Ticket # APAL-76991',	44,	87,	1,	'2019-11-21',	'2019-11-21 05:54:49',	1),
(244,	'APAL-39831',	'Approval Ticket # APAL-39831',	45,	87,	1,	'2019-11-21',	'2019-11-21 05:57:27',	1),
(245,	'APAL-51059',	'Approval Ticket # APAL-51059',	45,	87,	1,	'2019-11-21',	'2019-11-21 05:57:47',	1),
(246,	'APAL-83258',	'Approval Ticket # APAL-83258',	45,	87,	1,	'2019-11-21',	'2019-11-21 05:58:04',	1),
(247,	'APAL-69410',	'Approval Ticket # APAL-69410',	45,	87,	1,	'2019-11-21',	'2019-11-21 05:58:37',	1),
(248,	'APAL-85849',	'Approval Ticket # APAL-85849',	41,	87,	1,	'2019-11-21',	'2019-11-21 05:59:33',	1),
(249,	'APAL-63574',	'Approval Ticket # APAL-63574',	41,	87,	1,	'2019-11-21',	'2019-11-21 05:59:53',	1),
(250,	'APAL-7518',	'Approval Ticket # APAL-7518',	41,	87,	1,	'2019-11-21',	'2019-11-21 06:00:07',	1),
(251,	'APAL-5835',	'Approval Ticket # APAL-5835',	41,	87,	1,	'2019-11-21',	'2019-11-21 06:00:20',	1),
(252,	'APAL-31557',	'Approval Ticket # APAL-31557',	41,	87,	1,	'2019-11-21',	'2019-11-21 06:00:46',	1),
(253,	'APAL-76952',	'Approval Ticket # APAL-76952',	41,	87,	1,	'2019-11-21',	'2019-11-21 06:01:02',	1),
(254,	'APAL-42567',	'Approval Ticket # APAL-42567',	20,	87,	1,	'2019-11-21',	'2019-11-21 06:03:27',	1),
(255,	'APAL-71017',	'Approval Ticket # APAL-71017',	20,	87,	1,	'2019-11-21',	'2019-11-21 06:07:41',	1),
(256,	'APAL-1188',	'Approval Ticket # APAL-1188',	34,	87,	1,	'2019-11-21',	'2019-11-21 06:49:58',	1),
(257,	'APAL-25177',	'Approval Ticket # APAL-25177',	34,	87,	1,	'2019-11-21',	'2019-11-21 06:50:26',	1),
(258,	'APAL-48302',	'Approval Ticket # APAL-48302',	34,	87,	1,	'2019-11-21',	'2019-11-21 06:50:34',	1),
(259,	'APAL-78879',	'Approval Ticket # APAL-78879',	34,	87,	1,	'2019-11-21',	'2019-11-21 06:50:43',	1),
(260,	'APAL-53209',	'Approval Ticket # APAL-53209',	34,	87,	1,	'2019-11-21',	'2019-11-21 06:50:52',	1),
(261,	'APAL-54921',	'Approval Ticket # APAL-54921',	46,	87,	1,	'2019-11-21',	'2019-11-21 14:52:09',	1),
(262,	'APAL-49242',	'Approval Ticket # APAL-49242',	48,	87,	1,	'2019-11-21',	'2019-11-21 16:12:57',	1),
(263,	'APAL-43999',	'Approval Ticket # APAL-43999',	48,	87,	1,	'2019-11-21',	'2019-11-21 16:13:17',	1),
(264,	'APAL-76052',	'Approval Ticket # APAL-76052',	50,	87,	1,	'2019-11-21',	'2019-11-21 16:32:08',	1),
(265,	'APAL-69182',	'Approval Ticket # APAL-69182',	34,	87,	1,	'2019-11-21',	'2019-11-21 16:39:07',	1),
(266,	'APAL-42258',	'Approval Ticket # APAL-42258',	51,	87,	1,	'2019-11-21',	'2019-11-21 16:40:33',	1),
(267,	'APAL-36866',	'Approval Ticket # APAL-36866',	51,	87,	1,	'2019-11-21',	'2019-11-21 16:40:44',	1),
(268,	'APAL-18527',	'Approval Ticket # APAL-18527',	51,	87,	1,	'2019-11-21',	'2019-11-21 16:40:59',	1),
(269,	'APAL-22843',	'Approval Ticket # APAL-22843',	51,	87,	1,	'2019-11-21',	'2019-11-21 16:41:23',	1),
(270,	'APAL-55853',	'Approval Ticket # APAL-55853',	51,	87,	1,	'2019-11-21',	'2019-11-21 16:41:40',	1),
(271,	'APAL-55159',	'Approval Ticket # APAL-55159',	51,	87,	1,	'2019-11-21',	'2019-11-21 16:41:58',	1),
(272,	'APAL-6087',	'Approval Ticket # APAL-6087',	49,	87,	1,	'2019-11-21',	'2019-11-21 17:08:57',	1),
(273,	'APAL-18194',	'Approval Ticket # APAL-18194',	49,	87,	1,	'2019-11-21',	'2019-11-21 19:34:45',	1),
(274,	'APAL-32760',	'Approval Ticket # APAL-32760',	23,	87,	1,	'2019-11-21',	'2019-11-21 19:51:30',	1),
(275,	'APAL-46338',	'Approval Ticket # APAL-46338',	20,	87,	1,	'2019-11-21',	'2019-11-21 21:51:46',	1),
(276,	'APAL-15025',	'Approval Ticket # APAL-15025',	23,	87,	1,	'2019-11-21',	'2019-11-21 22:30:27',	1),
(277,	'APAL-78065',	'Approval Ticket # APAL-78065',	52,	87,	1,	'2019-11-22',	'2019-11-22 07:22:45',	1),
(278,	'APAL-48810',	'Approval Ticket # APAL-48810',	53,	87,	1,	'2019-11-22',	'2019-11-22 07:52:38',	1),
(279,	'APAL-11749',	'Approval Ticket # APAL-11749',	53,	87,	1,	'2019-11-22',	'2019-11-22 07:53:50',	1),
(280,	'APAL-2994',	'Approval Ticket # APAL-2994',	52,	87,	1,	'2019-11-22',	'2019-11-22 08:39:57',	1),
(281,	'APAL-51642',	'Approval Ticket # APAL-51642',	52,	87,	1,	'2019-11-22',	'2019-11-22 08:40:52',	1),
(282,	'APAL-80033',	'Approval Ticket # APAL-80033',	54,	87,	1,	'2019-11-22',	'2019-11-22 08:44:08',	1),
(283,	'APAL-77747',	'Approval Ticket # APAL-77747',	53,	87,	1,	'2019-11-22',	'2019-11-22 09:31:50',	1),
(284,	'APAL-61754',	'Approval Ticket # APAL-61754',	23,	87,	1,	'2019-11-22',	'2019-11-22 10:15:49',	1),
(285,	'APAL-36415',	'Approval Ticket # APAL-36415',	23,	87,	1,	'2019-11-22',	'2019-11-22 10:33:01',	1),
(286,	'APAL-5659',	'Approval Ticket # APAL-5659',	45,	87,	1,	'2019-11-22',	'2019-11-22 16:17:13',	1),
(287,	'APAL-3267',	'Approval Ticket # APAL-3267',	45,	87,	1,	'2019-11-22',	'2019-11-22 16:18:01',	1),
(288,	'APAL-26841',	'Approval Ticket # APAL-26841',	45,	87,	1,	'2019-11-22',	'2019-11-22 16:24:58',	1),
(295,	'APAL-38513',	'Approval Ticket # APAL-38513',	45,	87,	1,	'2019-11-22',	'2019-11-22 17:28:20',	1),
(296,	'APAL-47909',	'Approval Ticket # APAL-47909',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:38:55',	1),
(297,	'APAL-42142',	'Approval Ticket # APAL-42142',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:53:20',	1),
(298,	'APAL-53526',	'Approval Ticket # APAL-53526',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:56:32',	1),
(299,	'APAL-19128',	'Approval Ticket # APAL-19128',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:58:41',	1),
(300,	'APAL-50869',	'Approval Ticket # APAL-50869',	8,	87,	1,	'2019-11-22',	'2019-11-22 18:00:10',	1),
(301,	'APAL-14434',	'Approval Ticket # APAL-14434',	8,	87,	1,	'2019-11-22',	'2019-11-22 18:00:32',	1),
(302,	'APAL-69852',	'Approval Ticket # APAL-69852',	8,	87,	1,	'2019-11-22',	'2019-11-22 18:06:42',	1),
(307,	'APAL-50025',	'Approval Ticket # APAL-50025',	40,	87,	1,	'2019-11-22',	'2019-11-22 21:18:48',	1),
(312,	'APAL-27814',	'Approval Ticket # APAL-27814',	57,	87,	1,	'2019-11-23',	'2019-11-23 10:04:46',	1),
(313,	'APAL-23057',	'Approval Ticket # APAL-23057',	8,	87,	1,	'2019-11-23',	'2019-11-23 10:05:58',	1),
(323,	'APAL-84939',	'Approval Ticket # APAL-84939',	57,	87,	1,	'2019-11-23',	'2019-11-23 10:48:12',	1),
(324,	'APAL-66198',	'Approval Ticket # APAL-66198',	57,	87,	1,	'2019-11-23',	'2019-11-23 11:14:54',	1),
(325,	'APAL-30340',	'Approval Ticket # APAL-30340',	59,	87,	1,	'2019-11-23',	'2019-11-23 14:18:13',	1),
(326,	'APAL-37997',	'Approval Ticket # APAL-37997',	60,	87,	1,	'2019-11-23',	'2019-11-23 14:37:14',	1),
(327,	'APAL-26443',	'Approval Ticket # APAL-26443',	60,	87,	1,	'2019-11-23',	'2019-11-23 14:37:52',	1),
(328,	'APAL-17798',	'Approval Ticket # APAL-17798',	60,	87,	1,	'2019-11-23',	'2019-11-23 14:38:04',	1),
(329,	'APAL-35934',	'Approval Ticket # APAL-35934',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:45:57',	1),
(330,	'APAL-38545',	'Approval Ticket # APAL-38545',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:46:36',	1),
(331,	'APAL-61954',	'Approval Ticket # APAL-61954',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:49:09',	1),
(332,	'APAL-63579',	'Approval Ticket # APAL-63579',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:49:42',	1),
(333,	'APAL-19733',	'Approval Ticket # APAL-19733',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:50:36',	1),
(334,	'APAL-44436',	'Approval Ticket # APAL-44436',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:51:40',	1),
(335,	'APAL-19306',	'Approval Ticket # APAL-19306',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:52:20',	1),
(336,	'APAL-48776',	'Approval Ticket # APAL-48776',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:53:05',	1),
(337,	'APAL-26203',	'Approval Ticket # APAL-26203',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:53:54',	1),
(338,	'APAL-46529',	'Approval Ticket # APAL-46529',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:54:20',	1),
(339,	'APAL-51685',	'Approval Ticket # APAL-51685',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:54:58',	1),
(340,	'APAL-12941',	'Approval Ticket # APAL-12941',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:55:24',	1),
(341,	'APAL-33109',	'Approval Ticket # APAL-33109',	57,	87,	1,	'2019-11-23',	'2019-11-23 15:56:00',	1),
(342,	'APAL-85252',	'Approval Ticket # APAL-85252',	61,	87,	1,	'2019-11-23',	'2019-11-23 15:56:48',	1),
(343,	'APAL-55785',	'Approval Ticket # APAL-55785',	59,	87,	1,	'2019-11-23',	'2019-11-23 15:59:55',	1),
(344,	'APAL-4911',	'Approval Ticket # APAL-4911',	59,	87,	1,	'2019-11-23',	'2019-11-23 16:00:34',	1),
(345,	'APAL-63379',	'Approval Ticket # APAL-63379',	57,	87,	1,	'2019-11-23',	'2019-11-23 18:05:30',	1),
(346,	'APAL-51555',	'Approval Ticket # APAL-51555',	61,	87,	1,	'2019-11-23',	'2019-11-23 18:06:15',	1),
(347,	'APAL-7140',	'Approval Ticket # APAL-7140',	59,	87,	1,	'2019-11-23',	'2019-11-23 18:06:45',	1),
(348,	'APAL-46833',	'Approval Ticket # APAL-46833',	22,	87,	1,	'2019-11-23',	'2019-11-23 18:11:34',	1),
(349,	'APAL-21260',	'Approval Ticket # APAL-21260',	23,	87,	1,	'2019-11-23',	'2019-11-23 18:12:31',	1),
(350,	'APAL-2315',	'Approval Ticket # APAL-2315',	57,	87,	1,	'2019-11-23',	'2019-11-23 18:17:06',	1),
(351,	'APAL-60972',	'Approval Ticket # APAL-60972',	61,	87,	1,	'2019-11-23',	'2019-11-23 18:18:06',	1),
(352,	'APAL-70876',	'Approval Ticket # APAL-70876',	59,	87,	1,	'2019-11-23',	'2019-11-23 18:23:50',	1),
(353,	'APAL-1458',	'Approval Ticket # APAL-1458',	21,	87,	1,	'2019-11-24',	'2019-11-24 21:53:12',	1),
(354,	'APAL-63350',	'Approval Ticket # APAL-63350',	50,	87,	1,	'2019-11-25',	'2019-11-25 03:12:02',	1),
(355,	'APAL-3213',	'Approval Ticket # APAL-3213',	41,	87,	1,	'2019-11-25',	'2019-11-25 07:21:42',	1),
(356,	'APAL-54636',	'Approval Ticket # APAL-54636',	20,	87,	1,	'2019-11-25',	'2019-11-25 07:22:42',	1),
(357,	'APAL-7751',	'Approval Ticket # APAL-7751',	29,	87,	1,	'2019-11-25',	'2019-11-25 07:26:30',	1),
(358,	'APAL-24073',	'Approval Ticket # APAL-24073',	46,	87,	1,	'2019-11-25',	'2019-11-25 07:28:22',	1),
(360,	'APAL-29595',	'Approval Ticket # APAL-29595',	21,	87,	1,	'2019-11-25',	'2019-11-25 13:57:26',	1),
(361,	'APAL-34699',	'Approval Ticket # APAL-34699',	23,	87,	1,	'2019-11-25',	'2019-11-25 13:59:46',	1),
(363,	'APAL-6906',	'Approval Ticket # APAL-6906',	29,	87,	1,	'2019-11-25',	'2019-11-25 14:07:15',	1),
(364,	'APAL-15912',	'Approval Ticket # APAL-15912',	52,	87,	1,	'2019-11-25',	'2019-11-25 14:12:06',	1),
(365,	'APAL-47497',	'Approval Ticket # APAL-47497',	59,	87,	1,	'2019-11-25',	'2019-11-25 14:16:55',	1),
(366,	'APAL-6796',	'Approval Ticket # APAL-6796',	52,	87,	1,	'2019-11-25',	'2019-11-25 14:20:26',	1),
(367,	'APAL-73265',	'Approval Ticket # APAL-73265',	44,	87,	1,	'2019-11-26',	'2019-11-26 12:42:47',	1),
(368,	'APAL-77033',	'Approval Ticket # APAL-77033',	45,	87,	1,	'2019-11-26',	'2019-11-26 12:46:44',	1),
(369,	'APAL-62611',	'Approval Ticket # APAL-62611',	45,	87,	1,	'2019-11-26',	'2019-11-26 12:46:59',	1),
(370,	'APAL-43430',	'Approval Ticket # APAL-43430',	41,	87,	1,	'2019-11-26',	'2019-11-26 12:47:35',	1),
(371,	'APAL-47519',	'Approval Ticket # APAL-47519',	41,	87,	1,	'2019-11-26',	'2019-11-26 12:48:29',	1),
(372,	'APAL-82853',	'Approval Ticket # APAL-82853',	20,	87,	1,	'2019-11-26',	'2019-11-26 12:51:14',	1),
(373,	'APAL-77438',	'Approval Ticket # APAL-77438',	20,	87,	1,	'2019-11-26',	'2019-11-26 12:53:25',	1),
(374,	'APAL-54320',	'Approval Ticket # APAL-54320',	21,	87,	1,	'2019-11-26',	'2019-11-26 12:54:34',	1),
(375,	'APAL-54451',	'Approval Ticket # APAL-54451',	21,	87,	1,	'2019-11-26',	'2019-11-26 12:55:01',	1),
(376,	'APAL-83883',	'Approval Ticket # APAL-83883',	23,	87,	1,	'2019-11-26',	'2019-11-26 12:56:58',	1),
(377,	'APAL-66301',	'Approval Ticket # APAL-66301',	23,	87,	1,	'2019-11-26',	'2019-11-26 12:57:18',	1),
(378,	'APAL-28747',	'Approval Ticket # APAL-28747',	29,	87,	1,	'2019-11-26',	'2019-11-26 13:03:56',	1),
(379,	'APAL-82699',	'Approval Ticket # APAL-82699',	46,	87,	1,	'2019-11-26',	'2019-11-26 13:06:25',	1),
(381,	'APAL-9091',	'Approval Ticket # APAL-9091',	45,	87,	1,	'2019-11-26',	'2019-11-26 13:39:23',	1),
(382,	'APAL-62652',	'Approval Ticket # APAL-62652',	41,	87,	1,	'2019-11-26',	'2019-11-26 13:41:37',	1),
(383,	'APAL-1352',	'Approval Ticket # APAL-1352',	41,	87,	1,	'2019-11-26',	'2019-11-26 13:41:55',	1),
(384,	'APAL-60757',	'Approval Ticket # APAL-60757',	20,	87,	1,	'2019-11-26',	'2019-11-26 13:44:36',	1),
(385,	'APAL-65628',	'Approval Ticket # APAL-65628',	20,	87,	1,	'2019-11-26',	'2019-11-26 13:45:09',	1),
(386,	'APAL-4002',	'Approval Ticket # APAL-4002',	21,	87,	1,	'2019-11-26',	'2019-11-26 14:03:54',	1),
(387,	'APAL-10313',	'Approval Ticket # APAL-10313',	23,	87,	1,	'2019-11-26',	'2019-11-26 14:06:58',	1),
(388,	'APAL-33933',	'Approval Ticket # APAL-33933',	23,	87,	1,	'2019-11-26',	'2019-11-26 14:08:47',	1),
(389,	'APAL-65905',	'Approval Ticket # APAL-65905',	29,	87,	1,	'2019-11-26',	'2019-11-26 14:12:12',	1),
(390,	'APAL-79262',	'Approval Ticket # APAL-79262',	46,	87,	1,	'2019-11-26',	'2019-11-26 14:16:43',	1),
(393,	'APAL-13193',	'Approval Ticket # APAL-13193',	59,	87,	1,	'2019-11-27',	'2019-11-27 12:30:12',	1),
(394,	'APAL-73785',	'Approval Ticket # APAL-73785',	8,	87,	1,	'2019-11-27',	'2019-11-27 12:39:22',	1),
(400,	'APAL-19866',	'Approval Ticket # APAL-19866',	8,	87,	1,	'2019-11-27',	'2019-11-27 12:55:31',	1),
(401,	'APAL-79581',	'Approval Ticket # APAL-79581',	18,	87,	1,	'2019-11-27',	'2019-11-27 12:56:09',	1),
(402,	'APAL-28725',	'Approval Ticket # APAL-28725',	19,	87,	1,	'2019-11-27',	'2019-11-27 12:57:44',	1),
(403,	'APAL-52007',	'Approval Ticket # APAL-52007',	63,	87,	1,	'2019-11-27',	'2019-11-27 12:58:44',	1),
(404,	'APAL-67437',	'Approval Ticket # APAL-67437',	39,	87,	1,	'2019-11-27',	'2019-11-27 13:02:27',	1),
(405,	'APAL-64590',	'Approval Ticket # APAL-64590',	19,	87,	1,	'2019-11-27',	'2019-11-27 13:05:48',	1),
(407,	'APAL-23782',	'Approval Ticket # APAL-23782',	3,	87,	5,	'2019-11-27',	'2019-11-27 13:11:44',	5),
(408,	'APAL-7297',	'Approval Ticket # APAL-7297',	3,	87,	1,	'2019-11-27',	'2019-11-27 13:18:51',	1),
(409,	'APAL-7347',	'Approval Ticket # APAL-7347',	3,	87,	5,	'2019-11-27',	'2019-11-27 13:22:36',	5),
(410,	'APAL-15120',	'Approval Ticket # APAL-15120',	29,	87,	1,	'2019-11-27',	'2019-11-27 13:37:06',	1),
(411,	'APAL-30215',	'Approval Ticket # APAL-30215',	52,	87,	1,	'2019-11-27',	'2019-11-27 13:37:59',	1),
(412,	'APAL-44801',	'Approval Ticket # APAL-44801',	59,	87,	1,	'2019-11-27',	'2019-11-27 13:43:39',	1),
(413,	'APAL-26855',	'Approval Ticket # APAL-26855',	59,	87,	1,	'2019-11-27',	'2019-11-27 13:44:22',	1),
(414,	'APAL-32304',	'Approval Ticket # APAL-32304',	59,	87,	1,	'2019-11-27',	'2019-11-27 13:50:46',	1),
(415,	'APAL-50521',	'Approval Ticket # APAL-50521',	8,	87,	1,	'2019-11-27',	'2019-11-27 14:05:15',	1),
(416,	'APAL-84698',	'Approval Ticket # APAL-84698',	18,	87,	1,	'2019-11-27',	'2019-11-27 14:07:34',	1),
(417,	'APAL-9255',	'Approval Ticket # APAL-9255',	18,	87,	1,	'2019-11-27',	'2019-11-27 14:08:26',	1),
(418,	'APAL-80967',	'Approval Ticket # APAL-80967',	19,	87,	1,	'2019-11-27',	'2019-11-27 14:13:21',	1),
(419,	'APAL-25637',	'Approval Ticket # APAL-25637',	63,	87,	1,	'2019-11-27',	'2019-11-27 14:18:13',	1),
(420,	'APAL-64644',	'Approval Ticket # APAL-64644',	39,	87,	1,	'2019-11-27',	'2019-11-27 14:20:01',	1),
(421,	'APAL-11329',	'Approval Ticket # APAL-11329',	3,	87,	5,	'2019-11-27',	'2019-11-27 14:37:15',	5),
(422,	'APAL-32893',	'Approval Ticket # APAL-32893',	59,	87,	1,	'2019-11-27',	'2019-11-27 16:34:39',	1),
(423,	'APAL-63460',	'Approval Ticket # APAL-63460',	59,	87,	1,	'2019-11-27',	'2019-11-27 16:39:24',	1),
(424,	'APAL-31496',	'Approval Ticket # APAL-31496',	59,	87,	1,	'2019-11-27',	'2019-11-27 16:45:22',	1),
(425,	'APAL-24040',	'Approval Ticket # APAL-24040',	50,	87,	1,	'2019-11-27',	'2019-11-27 17:22:58',	1),
(426,	'APAL-75805',	'Approval Ticket # APAL-75805',	29,	87,	1,	'2019-11-28',	'2019-11-28 09:55:58',	1),
(427,	'APAL-44013',	'Approval Ticket # APAL-44013',	23,	87,	1,	'2019-11-28',	'2019-11-28 10:02:02',	1),
(429,	'APAL-47118',	'Approval Ticket # APAL-47118',	65,	87,	1,	'2019-12-01',	'2019-12-01 05:06:01',	1),
(433,	'APAL-30761',	'Approval Ticket # APAL-30761',	20,	87,	1,	'2019-12-03',	'2019-12-03 13:41:48',	1),
(439,	'APAL-4619',	'Approval Ticket # APAL-4619',	20,	87,	1,	'2019-12-03',	'2019-12-03 16:35:56',	1),
(441,	'APAL-49739',	'Approval Ticket # APAL-49739',	20,	87,	1,	'2019-12-03',	'2019-12-03 17:20:42',	1),
(442,	'APAL-45850',	'Approval Ticket # APAL-45850',	20,	87,	1,	'2019-12-08',	'2019-12-08 12:46:56',	1),
(443,	'APAL-89215',	'Approval Ticket # APAL-89215',	4,	87,	1,	'2019-12-08',	'2019-12-08 16:04:22',	1),
(446,	'APAL-82249',	'Approval Ticket # APAL-82249',	42,	87,	1,	'2019-12-13',	'2019-12-13 04:05:02',	1),
(448,	'APAL-67896',	'Approval Ticket # APAL-67896',	20,	87,	1,	'2019-12-13',	'2019-12-13 04:09:20',	1),
(449,	'APAL-3390',	'Approval Ticket # APAL-3390',	43,	87,	1,	'2019-12-13',	'2019-12-13 04:10:04',	1),
(450,	'APAL-78692',	'Approval Ticket # APAL-78692',	44,	87,	1,	'2019-12-13',	'2019-12-13 04:11:04',	1),
(451,	'APAL-77524',	'Approval Ticket # APAL-77524',	45,	87,	1,	'2019-12-13',	'2019-12-13 04:12:02',	1),
(452,	'APAL-28598',	'Approval Ticket # APAL-28598',	20,	87,	1,	'2019-12-13',	'2019-12-13 04:13:18',	1),
(453,	'APAL-61567',	'Approval Ticket # APAL-61567',	41,	87,	1,	'2019-12-13',	'2019-12-13 04:14:01',	1),
(454,	'APAL-78852',	'Approval Ticket # APAL-78852',	33,	87,	1,	'2019-12-13',	'2019-12-13 04:14:52',	1),
(455,	'APAL-73086',	'Approval Ticket # APAL-73086',	51,	87,	1,	'2019-12-13',	'2019-12-13 16:14:20',	1),
(456,	'APAL-46322',	'Approval Ticket # APAL-46322',	52,	87,	1,	'2019-12-13',	'2019-12-13 16:15:08',	1),
(457,	'APAL-49743',	'Approval Ticket # APAL-49743',	45,	87,	1,	'2019-12-14',	'2019-12-14 04:28:21',	1),
(458,	'APAL-85536',	'Approval Ticket # APAL-85536',	41,	87,	1,	'2019-12-14',	'2019-12-14 04:41:24',	1),
(459,	'APAL-38176',	'Approval Ticket # APAL-38176',	20,	87,	1,	'2019-12-15',	'2019-12-15 08:16:59',	1),
(460,	'APAL-80263',	'Approval Ticket # APAL-80263',	44,	87,	1,	'2019-12-15',	'2019-12-15 08:18:39',	1),
(461,	'APAL-18863',	'Approval Ticket # APAL-18863',	52,	87,	1,	'2019-12-15',	'2019-12-15 08:23:05',	1),
(462,	'APAL-35991',	'Approval Ticket # APAL-35991',	20,	87,	1,	'2019-12-15',	'2019-12-15 09:05:20',	1),
(463,	'APAL-17664',	'Approval Ticket # APAL-17664',	45,	87,	1,	'2019-12-15',	'2019-12-15 09:06:40',	1),
(464,	'APAL-8743',	'Approval Ticket # APAL-8743',	3,	87,	1,	'2019-12-15',	'2019-12-15 09:53:15',	1),
(465,	'APAL-52707',	'Approval Ticket # APAL-52707',	65,	87,	1,	'2019-12-15',	'2019-12-15 13:55:06',	1),
(466,	'APAL-80867',	'Approval Ticket # APAL-80867',	3,	87,	5,	'2019-12-15',	'2019-12-15 14:17:14',	5),
(467,	'APAL-22786',	'Approval Ticket # APAL-22786',	49,	87,	1,	'2019-12-15',	'2019-12-15 15:10:22',	1),
(468,	'APAL-89404',	'Approval Ticket # APAL-89404',	3,	87,	5,	'2019-12-15',	'2019-12-15 15:17:11',	5),
(469,	'APAL-78047',	'Approval Ticket # APAL-78047',	19,	87,	1,	'2019-12-15',	'2019-12-15 15:25:35',	1),
(470,	'APAL-51571',	'Approval Ticket # APAL-51571',	48,	87,	1,	'2019-12-16',	'2019-12-16 10:40:23',	1),
(471,	'APAL-31869',	'Approval Ticket # APAL-31869',	49,	87,	1,	'2019-12-16',	'2019-12-16 10:41:18',	1);

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


DROP TABLE IF EXISTS `approval_tracker`;
CREATE TABLE `approval_tracker` (
  `approval_tracker_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_status_id` int(11) NOT NULL,
  `item_key` int(100) NOT NULL,
  `approval_tracker_created_date` date NOT NULL,
  `approval_tracker_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval_tracker_created_by` int(100) NOT NULL,
  `approval_tracker_last_modified_by` int(100) NOT NULL,
  PRIMARY KEY (`approval_tracker_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `approval_tracker_ibfk_1` FOREIGN KEY (`fk_status_id`) REFERENCES `approval` (`approval_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
(1,	'APEM-45322',	'request_detail',	1,	'0000-00-00',	0,	'2019-11-25 03:34:19',	0,	NULL,	NULL),
(2,	'APEM-45323',	'voucher',	1,	'0000-00-00',	0,	'2019-11-15 18:14:11',	0,	NULL,	NULL),
(3,	'APEM-45324',	'request',	1,	'0000-00-00',	0,	'2019-11-25 03:19:05',	0,	NULL,	NULL),
(4,	'APEM-45325',	'budget',	1,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(5,	'APEM-45326',	'budget_item',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(8,	'APEM-45327',	'funder',	1,	'2019-10-22',	1,	'2019-11-20 23:35:59',	1,	NULL,	NULL),
(9,	'APEM-45328',	'workplan',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(13,	'APEM-45329',	'budget_item_detail',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(14,	'APEM-45330',	'voucher_detail',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(18,	'APEM-45331',	'project',	0,	'2019-10-25',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(19,	'APEM-45332',	'project_allocation',	1,	'2019-11-03',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(20,	'APEM-45333',	'office',	1,	'2019-11-03',	1,	'2019-12-08 07:57:15',	1,	NULL,	NULL),
(21,	'APEM-45334',	'role',	0,	'2019-11-04',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(22,	'APEM-45335',	'permission',	0,	'2019-11-04',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(23,	'APEM-45336',	'role_permission',	0,	'2019-11-04',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(24,	'APEM-45337',	'dashboard',	0,	'2019-11-05',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(25,	'APEM-45338',	'permission_label',	0,	'2019-11-06',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(26,	'APEM-45339',	'bank',	0,	'2019-11-06',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(27,	'APEM-45340',	'user_detail',	0,	'2019-11-07',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(28,	'APEM-45341',	'menu_user_order',	0,	'2019-11-07',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(29,	'APEM-45342',	'user',	0,	'2019-11-07',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(30,	'APEM-45343',	'user_setting',	0,	'2019-11-07',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(31,	'APEM-45344',	'approve_item',	0,	'2019-11-07',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(32,	'APEM-45345',	'status',	0,	'2019-11-07',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(33,	'APEM-45346',	'context_center',	0,	'2019-11-13',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(34,	'APEM-45347',	'context',	0,	'2019-11-13',	1,	'2019-12-08 07:59:55',	1,	NULL,	NULL),
(36,	'',	'month',	0,	'2019-11-21',	1,	'2019-11-20 23:15:01',	1,	NULL,	NULL),
(37,	'',	'voucher_type',	0,	'2019-11-21',	1,	'2019-11-20 23:15:43',	1,	NULL,	NULL),
(38,	'',	'reconciliation',	0,	'2019-11-21',	1,	'2019-11-20 23:17:28',	1,	NULL,	NULL),
(39,	'',	'expense_account',	0,	'2019-11-21',	1,	'2019-11-20 23:54:46',	1,	NULL,	NULL),
(40,	'',	'language',	0,	'2019-11-21',	1,	'2019-11-21 00:12:27',	1,	NULL,	NULL),
(41,	'',	'context_cluster',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(42,	'',	'context_global',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(43,	'',	'context_region',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(44,	'',	'context_country',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(45,	'',	'context_cohort',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(46,	'',	'center_user',	0,	'2019-11-21',	1,	'2019-11-21 14:51:30',	1,	NULL,	NULL),
(47,	'',	'menu',	0,	'2019-11-21',	1,	'2019-11-21 15:40:57',	1,	NULL,	NULL),
(48,	'',	'department',	0,	'2019-11-21',	1,	'2019-11-21 16:09:50',	1,	NULL,	NULL),
(49,	'',	'department_user',	0,	'2019-11-21',	1,	'2019-11-21 16:14:04',	1,	NULL,	NULL),
(50,	'',	'context_cluster_user',	0,	'2019-11-21',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(51,	'',	'designation',	0,	'2019-11-21',	1,	'2019-11-21 16:37:42',	1,	NULL,	NULL),
(52,	'',	'context_country_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(53,	'',	'context_cohort_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(54,	'',	'context_global_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(55,	'',	'context_region_user',	0,	'2019-11-22',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(56,	'',	'funding_status',	0,	'2019-11-22',	1,	'2019-11-22 22:07:30',	1,	NULL,	NULL),
(57,	'',	'page_view',	0,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(58,	'',	'page_view_detail',	0,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(59,	'',	'page_view_role',	0,	'2019-11-23',	1,	'2019-11-23 14:11:51',	1,	NULL,	NULL),
(60,	'',	'request_type',	0,	'2019-11-23',	1,	'2019-11-23 14:31:51',	1,	NULL,	NULL),
(61,	'',	'page_view_condition',	0,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL),
(62,	'',	'approval',	0,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL),
(63,	'',	'income_account',	0,	'2019-11-27',	1,	'2019-11-27 12:58:11',	1,	NULL,	NULL),
(65,	'',	'context_center_user',	0,	'2019-11-30',	1,	'2019-12-08 08:45:49',	1,	NULL,	NULL),
(66,	'',	'context_definition',	0,	'2019-12-15',	1,	'2019-12-15 06:51:08',	1,	NULL,	NULL);

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

INSERT INTO `budget` (`budget_id`, `budget_track_number`, `budget_name`, `fk_office_id`, `fk_approval_id`, `fk_status_id`, `budget_year`, `budget_created_by`, `budget_created_date`, `budget_last_modified_by`, `budget_last_modified_date`) VALUES
(2,	'BUET-37550',	'Test Budget',	18,	443,	23,	2019,	1,	'2019-12-08',	1,	NULL);

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
  CONSTRAINT `fk_cheque_book_center_bank1` FOREIGN KEY (`center_bank_id`) REFERENCES `office_bank` (`office_bank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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


DROP TABLE IF EXISTS `context`;
CREATE TABLE `context` (
  `context_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_track_number` varchar(100) NOT NULL,
  `context_name` varchar(100) NOT NULL,
  `context_description` longtext NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `context_created_date` date NOT NULL,
  `context_created_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_created_by` int(11) NOT NULL,
  `context_last_modified_by` int(11) NOT NULL,
  `context_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`context_id`),
  KEY `fk_context_definition_id` (`fk_context_definition_id`),
  CONSTRAINT `context_ibfk_1` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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

INSERT INTO `context_center` (`context_center_id`, `context_center_track_number`, `context_center_name`, `context_center_description`, `fk_context_cluster_id`, `fk_context_definition_id`, `fk_office_id`, `context_center_created_date`, `context_center_created_by`, `context_center_last_modified_by`, `context_center_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COER-53990',	'GRC Shingila',	'This is GRC Shingila',	1,	13,	9,	'2019-12-13',	1,	1,	NULL,	454,	58);

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
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_context_center_id` (`fk_context_center_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `context_center_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_center_user_ibfk_2` FOREIGN KEY (`fk_context_center_id`) REFERENCES `context_center` (`context_center_id`),
  CONSTRAINT `context_center_user_ibfk_3` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_center_user` (`context_center_user_id`, `context_center_user_track_number`, `context_center_user_name`, `fk_user_id`, `fk_context_center_id`, `fk_designation_id`, `context_center_user_is_active`, `context_center_user_created_date`, `context_center_user_last_modified_date`, `context_center_user_created_by`, `context_center_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COER-38672',	'David Mbitsi - GRC',	5,	1,	3,	1,	'2019-12-15',	'2019-12-15 13:55:06',	1,	1,	465,	0);

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
  CONSTRAINT `context_cluster_ibfk_5` FOREIGN KEY (`fk_context_cohort_id`) REFERENCES `context_cohort` (`context_cohort_id`),
  CONSTRAINT `context_cluster_ibfk_6` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`),
  CONSTRAINT `context_cluster_ibfk_7` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `context_cluster` (`context_cluster_id`, `context_cluster_track_number`, `context_cluster_name`, `context_cluster_description`, `fk_office_id`, `fk_context_cohort_id`, `fk_context_definition_id`, `context_cluster_created_date`, `context_cluster_last_modified_date`, `context_cluster_created_by`, `context_cluster_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COER-25606',	'Malindi Cluster',	'This is Malindi cluster',	23,	1,	8,	'2019-12-13',	'2019-12-13 04:14:01',	1,	1,	453,	66),
(2,	'COER-83909',	'Kaloleni Cluster',	'This is a Kaloleni Cluster',	19,	2,	8,	'2019-12-14',	'2019-12-14 04:41:24',	1,	1,	458,	66);

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
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `context_cluster_user_ibfk_1` FOREIGN KEY (`fk_context_cluster_id`) REFERENCES `context_cluster` (`context_cluster_id`),
  CONSTRAINT `context_cluster_user_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_cluster_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `context_cluster_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `context_cluster_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
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

INSERT INTO `context_cohort` (`context_cohort_id`, `context_cohort_track_number`, `context_cohort_name`, `context_cohort_description`, `fk_office_id`, `fk_context_country_id`, `fk_context_definition_id`, `context_cohort_created_date`, `context_cohort_last_modified_date`, `context_cohort_created_by`, `context_cohort_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'CORT-53318',	'Coast and Lower Eastern Cohort',	'This is Coast and Lower Eastern Cohort',	20,	1,	9,	'2019-12-13',	'2019-12-13 04:12:02',	1,	1,	451,	70),
(2,	'CORT-19622',	'Nairobi Area Cohort',	'This is a Nairobi Area Cohort',	15,	1,	9,	'2019-12-14',	'2019-12-14 04:28:21',	1,	1,	457,	70),
(3,	'CORT-57857',	'Uganda East Cohort Context',	'Uganda East Cohort Context',	25,	2,	9,	'2019-12-15',	'2019-12-15 09:06:40',	1,	1,	463,	70);

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
(1,	'CORY-56399',	'Kenya Country Office',	'This is Kenya Country Office',	18,	2,	10,	'2019-12-13',	'2019-12-13 04:11:04',	1,	1,	450,	69),
(2,	'CORY-88987',	'Uganda Country Office',	'Uganda Country Office',	24,	2,	10,	'2019-12-15',	'2019-12-15 08:18:39',	1,	1,	460,	69);

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

INSERT INTO `context_country_user` (`context_country_user_id`, `context_country_user_track_number`, `context_country_user_name`, `fk_user_id`, `fk_context_country_id`, `fk_designation_id`, `context_country_user_is_active`, `context_country_user_created_date`, `context_country_user_last_modified_date`, `context_country_user_created_by`, `context_country_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'COER-3908',	'Nicodemus Karisa - System Admin',	1,	1,	7,	1,	'2019-12-13',	'2019-12-13 16:15:08',	1,	1,	456,	77),
(2,	'COER-46484',	'Nicodemus Karisa for Uganda Sys Admin',	1,	2,	7,	1,	'2019-12-15',	'2019-12-15 08:23:05',	1,	1,	461,	77);

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


DROP TABLE IF EXISTS `context_user`;
CREATE TABLE `context_user` (
  `context_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `context_user_track_number` varchar(100) NOT NULL,
  `context_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_context_id` int(100) NOT NULL,
  `context_user_created_date` date NOT NULL,
  `context_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `context_user_created_by` int(11) NOT NULL,
  `context_user_last_modified_by` int(11) NOT NULL,
  PRIMARY KEY (`context_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_context_id` (`fk_context_id`),
  CONSTRAINT `context_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `context_user_ibfk_2` FOREIGN KEY (`fk_context_id`) REFERENCES `context` (`context_id`)
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

INSERT INTO `department` (`department_id`, `department_track_number`, `department_name`, `department_description`, `department_is_active`, `department_created_date`, `department_last_modified_date`, `department_created_by`, `department_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'DENT-63671',	'Health Promotion',	'Health Promotion Department',	1,	'2019-11-21',	'2019-11-21 16:12:57',	1,	1,	262,	73),
(2,	'DENT-57933',	'Training Department',	'Training Department',	1,	'2019-11-21',	'2019-11-21 16:13:17',	1,	1,	263,	73),
(3,	'DENT-46303',	'Finance',	'Finance department',	1,	'2019-12-16',	'2019-12-16 10:40:23',	1,	1,	470,	73);

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

INSERT INTO `department_user` (`department_user_id`, `department_user_track_number`, `department_user_name`, `fk_user_id`, `fk_department_id`, `department_user_created_date`, `department_user_last_modified_date`, `department_user_created_by`, `department_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'DEER-5510',	'Mapenzi Hellen',	9,	1,	'2019-11-21',	'2019-11-21 17:08:57',	1,	1,	272,	74),
(2,	'DEER-18515',	'Joyce Cherono',	4,	2,	'2019-11-21',	'2019-11-21 19:34:45',	1,	1,	273,	74),
(3,	'DEER-84135',	'Nicodemus Karisa - Training Department',	1,	2,	'2019-12-15',	'2019-12-15 15:10:22',	1,	1,	467,	74),
(4,	'DEER-3294',	'David Mbitsi - Finance Department',	5,	3,	'2019-12-16',	'2019-12-16 10:41:18',	1,	1,	471,	74);

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
(1,	'DEON-28178',	'Project Director',	13,	'2019-11-21',	'2019-11-21 16:40:33',	1,	1,	266,	76),
(2,	'DEON-61891',	'Health Worker',	13,	'2019-11-21',	'2019-11-21 16:40:44',	1,	1,	267,	76),
(3,	'DEON-85720',	'Project Accountant ',	13,	'2019-11-21',	'2019-11-21 16:40:59',	1,	1,	268,	76),
(4,	'DEON-32456',	'Partnership Facilitator',	8,	'2019-11-21',	'2019-11-21 16:41:23',	1,	1,	269,	76),
(5,	'DEON-63399',	'Manager of Partnership',	9,	'2019-11-21',	'2019-11-21 16:41:40',	1,	1,	270,	76),
(6,	'DEON-8049',	'Health Specialist',	10,	'2019-11-21',	'2019-11-21 16:41:58',	1,	1,	271,	76),
(7,	'DEON-68629',	'Country System Admin',	10,	'2019-12-13',	'2019-12-13 16:14:20',	1,	1,	455,	76);

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
(3,	'EAC-87020',	'Expense Account 3',	'Expense 3',	'E003',	0,	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'EXNT-30031',	'Expense 5',	'Expense 5',	'Exp5',	0,	1,	1,	2,	404,	64,	'2019-11-27',	NULL,	1,	1),
(5,	'EXNT-77016',	'Salaries',	'Salaries',	'EXP89',	0,	1,	1,	3,	420,	64,	'2019-11-27',	NULL,	1,	1);

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
(13,	'FUER-41174',	'Funder A',	'Funder A',	'2019-11-27',	NULL,	1,	1,	NULL,	400,	33),
(14,	'FUER-49328',	'Funder B',	'This funder b',	'2019-11-27',	NULL,	1,	1,	NULL,	415,	33);

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
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`income_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table contains the income accounts. ';

INSERT INTO `income_account` (`income_account_id`, `income_account_track_number`, `income_account_name`, `income_account_description`, `income_account_code`, `income_account_is_active`, `income_account_is_budgeted`, `income_account_is_donor_funded`, `income_account_created_date`, `income_account_last_modified_date`, `income_account_created_by`, `income_account_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'INC-65627',	'Income Account 1',	'Project Cost',	'PC',	1,	1,	1,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(2,	'INNT-62852',	'Income Account 5',	'Income Account 5',	'ACC 5',	1,	1,	1,	'2019-11-27',	NULL,	1,	1,	403,	0),
(3,	'INNT-84810',	'Income 6 - Program ',	'Income 6',	'PRG090',	1,	1,	1,	'2019-11-27',	NULL,	1,	1,	419,	0);

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
(1,	'LNG-97389',	'English',	'en',	NULL,	'2019-11-07 10:39:11',	NULL,	NULL,	NULL,	NULL,	NULL),
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
(401,	'Approve_item',	'Approve_item',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(402,	'Status',	'Status',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(470,	'Menu_user_order',	'Menu_user_order',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(478,	'Bank_branch',	'Bank_branch',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(480,	'Department',	'Department',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(481,	'Designation',	'Designation',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(482,	'Expense_account',	'Expense_account',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(483,	'Funding_status',	'Funding_status',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(490,	'Project',	'Project',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(491,	'Reconciliation',	'Reconciliation',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(492,	'Page_view',	'Page_view',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(496,	'Request_type',	'Request_type',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(497,	'Language',	'Language',	1,	NULL,	'2019-11-26 20:45:56',	NULL,	NULL,	NULL,	NULL),
(498,	'Setting',	'Setting',	1,	NULL,	'2019-11-26 22:05:45',	NULL,	NULL,	NULL,	NULL),
(500,	'Income_account',	'Income_account',	1,	NULL,	'2019-11-27 13:24:36',	NULL,	NULL,	NULL,	NULL),
(521,	'Office',	'Office',	1,	NULL,	'2019-12-08 12:10:43',	NULL,	NULL,	NULL,	NULL),
(522,	'Office_bank',	'Office_bank',	1,	NULL,	'2019-12-08 12:10:43',	NULL,	NULL,	NULL,	NULL),
(523,	'Context_definition',	'Context_definition',	1,	NULL,	'2019-12-08 12:20:29',	NULL,	NULL,	NULL,	NULL),
(524,	'Center_bank',	'Center_bank',	1,	NULL,	'2019-12-08 13:57:52',	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `menu_user_order`;
CREATE TABLE `menu_user_order` (
  `menu_user_order_id` int(100) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(100) NOT NULL,
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

INSERT INTO `menu_user_order` (`menu_user_order_id`, `fk_user_id`, `fk_menu_id`, `menu_user_order_is_active`, `menu_user_order_level`, `menu_user_order_priority_item`, `menu_user_order_created_date`, `menu_user_order_last_modified_date`, `menu_user_order_created_by`, `menu_user_order_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(622,	1,	380,	1,	5,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(623,	1,	381,	1,	2,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(624,	1,	382,	1,	3,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(626,	1,	384,	1,	1,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(627,	1,	385,	1,	6,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(628,	1,	386,	1,	7,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(632,	1,	390,	1,	11,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(633,	1,	391,	1,	12,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(634,	1,	392,	1,	13,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(635,	1,	393,	1,	14,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(639,	1,	397,	1,	18,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(640,	1,	398,	1,	19,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(642,	1,	400,	1,	21,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(643,	1,	401,	1,	22,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(644,	1,	402,	1,	23,	0,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
(645,	4,	380,	1,	1,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(646,	4,	381,	1,	2,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(647,	4,	382,	1,	3,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(649,	4,	384,	1,	5,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(650,	4,	385,	1,	6,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(651,	4,	386,	1,	7,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(655,	4,	390,	1,	11,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(656,	4,	391,	1,	12,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(657,	4,	392,	1,	13,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(658,	4,	393,	1,	14,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(662,	4,	397,	1,	18,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(663,	4,	398,	1,	19,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(665,	4,	400,	1,	21,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(666,	4,	401,	1,	22,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(667,	4,	402,	1,	23,	0,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
(668,	2,	380,	1,	1,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(669,	2,	381,	1,	2,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(670,	2,	382,	1,	3,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(672,	2,	384,	1,	5,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(673,	2,	385,	1,	6,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(674,	2,	386,	1,	7,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(678,	2,	390,	1,	11,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(679,	2,	391,	1,	12,	0,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(680,	2,	392,	1,	13,	0,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
(681,	2,	393,	1,	14,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(685,	2,	397,	1,	18,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(686,	2,	398,	1,	19,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(688,	2,	400,	1,	21,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(689,	2,	401,	1,	22,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(690,	2,	402,	1,	23,	0,	NULL,	'2019-11-08 10:08:11',	NULL,	NULL,	NULL,	NULL),
(691,	5,	380,	1,	1,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(692,	5,	381,	1,	2,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(693,	5,	382,	1,	3,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(695,	5,	384,	1,	5,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(696,	5,	385,	1,	6,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(697,	5,	386,	1,	7,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(701,	5,	390,	1,	11,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(702,	5,	391,	1,	12,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(703,	5,	392,	1,	13,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(704,	5,	393,	1,	14,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(708,	5,	397,	1,	18,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(709,	5,	398,	1,	19,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(711,	5,	400,	1,	21,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(712,	5,	401,	1,	22,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(713,	5,	402,	1,	23,	0,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
(776,	12,	380,	1,	1,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(777,	12,	381,	1,	2,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(778,	12,	382,	1,	3,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(780,	12,	384,	1,	5,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(781,	12,	385,	1,	6,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(782,	12,	386,	1,	7,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(785,	12,	390,	1,	10,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(786,	12,	391,	1,	11,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(787,	12,	392,	1,	12,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(788,	12,	393,	1,	13,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(789,	12,	397,	1,	14,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(790,	12,	398,	1,	15,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(791,	12,	400,	1,	16,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(792,	12,	401,	1,	17,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(793,	12,	402,	1,	18,	0,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
(849,	9,	380,	1,	1,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(850,	9,	381,	1,	2,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(851,	9,	382,	1,	3,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(853,	9,	384,	1,	5,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(854,	9,	385,	1,	6,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(855,	9,	386,	1,	7,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(856,	9,	390,	1,	8,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(857,	9,	391,	1,	9,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(858,	9,	392,	1,	10,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(859,	9,	393,	1,	11,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(860,	9,	397,	1,	12,	0,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(861,	9,	398,	1,	13,	0,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(862,	9,	400,	1,	14,	0,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(863,	9,	401,	1,	15,	0,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(864,	9,	402,	1,	16,	0,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(902,	1,	470,	1,	67,	0,	NULL,	'2019-11-21 19:39:33',	NULL,	NULL,	NULL,	NULL),
(903,	5,	470,	1,	67,	0,	NULL,	'2019-11-21 19:51:55',	NULL,	NULL,	NULL,	NULL),
(904,	4,	470,	1,	67,	0,	NULL,	'2019-11-21 22:28:49',	NULL,	NULL,	NULL,	NULL),
(905,	6,	380,	1,	1,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(906,	6,	381,	1,	2,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(907,	6,	382,	1,	3,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(909,	6,	384,	1,	5,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(910,	6,	385,	1,	6,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(911,	6,	386,	1,	7,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(912,	6,	390,	1,	8,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(913,	6,	391,	1,	9,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(914,	6,	392,	1,	10,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(915,	6,	393,	1,	11,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(916,	6,	397,	1,	12,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(917,	6,	398,	1,	13,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(918,	6,	400,	1,	14,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(919,	6,	401,	1,	15,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(920,	6,	402,	1,	16,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(938,	6,	470,	1,	34,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(939,	8,	380,	1,	1,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(940,	8,	381,	1,	2,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(941,	8,	382,	1,	3,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(943,	8,	384,	1,	5,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(944,	8,	385,	1,	6,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(945,	8,	386,	1,	7,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(946,	8,	390,	1,	8,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(947,	8,	391,	1,	9,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(948,	8,	392,	1,	10,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(949,	8,	393,	1,	11,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(950,	8,	397,	1,	12,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(951,	8,	398,	1,	13,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(952,	8,	400,	1,	14,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(953,	8,	401,	1,	15,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(954,	8,	402,	1,	16,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(972,	8,	470,	1,	34,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(980,	1,	478,	1,	39,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(982,	1,	480,	1,	41,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(983,	1,	481,	1,	42,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(984,	1,	482,	1,	43,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(985,	1,	483,	1,	44,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(992,	1,	490,	1,	51,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(993,	1,	491,	1,	52,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(995,	5,	478,	1,	38,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(997,	5,	480,	1,	40,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(998,	5,	481,	1,	41,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(999,	5,	482,	1,	42,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1000,	5,	483,	1,	43,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1007,	5,	490,	1,	50,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1008,	5,	491,	1,	51,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1009,	1,	492,	1,	63,	0,	NULL,	'2019-11-23 08:19:43',	NULL,	NULL,	NULL,	NULL),
(1011,	5,	492,	1,	63,	0,	NULL,	'2019-11-23 10:58:06',	NULL,	NULL,	NULL,	NULL),
(1015,	1,	496,	1,	67,	0,	NULL,	'2019-11-23 14:31:44',	NULL,	NULL,	NULL,	NULL),
(1016,	5,	496,	1,	65,	0,	NULL,	'2019-11-23 16:23:17',	NULL,	NULL,	NULL,	NULL),
(1017,	4,	478,	1,	37,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1019,	4,	480,	1,	39,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1020,	4,	481,	1,	40,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1021,	4,	482,	1,	41,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1022,	4,	483,	1,	42,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1028,	4,	490,	1,	48,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1029,	4,	491,	1,	49,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1030,	4,	492,	1,	50,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1031,	4,	496,	1,	51,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1032,	7,	380,	1,	1,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1033,	7,	381,	1,	2,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1034,	7,	382,	1,	3,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1036,	7,	384,	1,	5,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1037,	7,	385,	1,	6,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1038,	7,	386,	1,	7,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1039,	7,	390,	1,	8,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1040,	7,	391,	1,	9,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1041,	7,	392,	1,	10,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1042,	7,	393,	1,	11,	1,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1043,	7,	397,	1,	12,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1044,	7,	398,	1,	13,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1045,	7,	400,	1,	14,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1046,	7,	401,	1,	15,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1047,	7,	402,	1,	16,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1049,	7,	470,	1,	18,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1050,	7,	478,	1,	19,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1052,	7,	480,	1,	21,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1053,	7,	481,	1,	22,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1054,	7,	482,	1,	23,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1055,	7,	483,	1,	24,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1061,	7,	490,	1,	30,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1062,	7,	491,	1,	31,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1063,	7,	492,	1,	32,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1064,	7,	496,	1,	33,	0,	NULL,	'2019-11-25 03:12:39',	NULL,	NULL,	NULL,	NULL),
(1065,	13,	380,	1,	1,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1066,	13,	381,	1,	2,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1067,	13,	382,	1,	3,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1069,	13,	384,	1,	5,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1070,	13,	385,	1,	6,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1071,	13,	386,	1,	7,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1072,	13,	390,	1,	8,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1073,	13,	391,	1,	9,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1074,	13,	392,	1,	10,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1075,	13,	393,	1,	11,	1,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1076,	13,	397,	1,	12,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1077,	13,	398,	1,	13,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1078,	13,	400,	1,	14,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1079,	13,	401,	1,	15,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1080,	13,	402,	1,	16,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1082,	13,	470,	1,	18,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1083,	13,	478,	1,	19,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1085,	13,	480,	1,	21,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1086,	13,	481,	1,	22,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1087,	13,	482,	1,	23,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1088,	13,	483,	1,	24,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1094,	13,	490,	1,	30,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1095,	13,	491,	1,	31,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1096,	13,	492,	1,	32,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1097,	13,	496,	1,	33,	0,	NULL,	'2019-11-25 07:28:51',	NULL,	NULL,	NULL,	NULL),
(1098,	14,	380,	1,	1,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1099,	14,	381,	1,	2,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1100,	14,	382,	1,	3,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1102,	14,	384,	1,	5,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1103,	14,	385,	1,	6,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1104,	14,	386,	1,	7,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1105,	14,	390,	1,	8,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1106,	14,	391,	1,	9,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1107,	14,	392,	1,	10,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1108,	14,	393,	1,	11,	1,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1109,	14,	397,	1,	12,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1110,	14,	398,	1,	13,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1111,	14,	400,	1,	14,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1112,	14,	401,	1,	15,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1113,	14,	402,	1,	16,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1115,	14,	470,	1,	18,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1116,	14,	478,	1,	19,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1118,	14,	480,	1,	21,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1119,	14,	481,	1,	22,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1120,	14,	482,	1,	23,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1121,	14,	483,	1,	24,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1127,	14,	490,	1,	30,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1128,	14,	491,	1,	31,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1129,	14,	492,	1,	32,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1130,	14,	496,	1,	33,	0,	NULL,	'2019-11-25 14:09:06',	NULL,	NULL,	NULL,	NULL),
(1131,	15,	380,	1,	1,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1132,	15,	381,	1,	2,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1133,	15,	382,	1,	3,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1135,	15,	384,	1,	5,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1136,	15,	385,	1,	6,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1137,	15,	386,	1,	7,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1138,	15,	390,	1,	8,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1139,	15,	391,	1,	9,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1140,	15,	392,	1,	10,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1141,	15,	393,	1,	11,	1,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1142,	15,	397,	1,	12,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1143,	15,	398,	1,	13,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1144,	15,	400,	1,	14,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1145,	15,	401,	1,	15,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1146,	15,	402,	1,	16,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1148,	15,	470,	1,	18,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1149,	15,	478,	1,	19,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1151,	15,	480,	1,	21,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1152,	15,	481,	1,	22,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1153,	15,	482,	1,	23,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1154,	15,	483,	1,	24,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1160,	15,	490,	1,	30,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1161,	15,	491,	1,	31,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1162,	15,	492,	1,	32,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1163,	15,	496,	1,	33,	0,	NULL,	'2019-11-26 13:04:26',	NULL,	NULL,	NULL,	NULL),
(1164,	16,	380,	1,	1,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1165,	16,	381,	1,	2,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1166,	16,	382,	1,	3,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1168,	16,	384,	1,	5,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1169,	16,	385,	1,	6,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1170,	16,	386,	1,	7,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1171,	16,	390,	1,	8,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1172,	16,	391,	1,	9,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1173,	16,	392,	1,	10,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1174,	16,	393,	1,	11,	1,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1175,	16,	397,	1,	12,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1176,	16,	398,	1,	13,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1177,	16,	400,	1,	14,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1178,	16,	401,	1,	15,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1179,	16,	402,	1,	16,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1181,	16,	470,	1,	18,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1182,	16,	478,	1,	19,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1184,	16,	480,	1,	21,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1185,	16,	481,	1,	22,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1186,	16,	482,	1,	23,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1187,	16,	483,	1,	24,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1193,	16,	490,	1,	30,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1194,	16,	491,	1,	31,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1195,	16,	492,	1,	32,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1196,	16,	496,	1,	33,	0,	NULL,	'2019-11-26 14:12:58',	NULL,	NULL,	NULL,	NULL),
(1197,	1,	497,	1,	67,	0,	NULL,	'2019-11-26 20:45:56',	NULL,	NULL,	NULL,	NULL),
(1198,	1,	498,	1,	69,	0,	NULL,	'2019-11-26 22:05:45',	NULL,	NULL,	NULL,	NULL),
(1199,	5,	497,	1,	67,	0,	NULL,	'2019-11-27 10:49:06',	NULL,	NULL,	NULL,	NULL),
(1200,	5,	498,	1,	68,	0,	NULL,	'2019-11-27 10:49:06',	NULL,	NULL,	NULL,	NULL),
(1202,	5,	500,	1,	71,	0,	NULL,	'2019-11-27 13:24:36',	NULL,	NULL,	NULL,	NULL),
(1203,	1,	500,	1,	71,	0,	NULL,	'2019-11-27 13:27:03',	NULL,	NULL,	NULL,	NULL),
(1204,	17,	380,	1,	1,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1205,	17,	381,	1,	2,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1206,	17,	382,	1,	3,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1208,	17,	384,	1,	5,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1209,	17,	385,	1,	6,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1210,	17,	386,	1,	7,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1211,	17,	390,	1,	8,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1212,	17,	391,	1,	9,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1213,	17,	392,	1,	10,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1214,	17,	393,	1,	11,	1,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1215,	17,	397,	1,	12,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1216,	17,	398,	1,	13,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1217,	17,	400,	1,	14,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1218,	17,	401,	1,	15,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1219,	17,	402,	1,	16,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1221,	17,	470,	1,	18,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1222,	17,	478,	1,	19,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1224,	17,	480,	1,	21,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1225,	17,	481,	1,	22,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1226,	17,	482,	1,	23,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1227,	17,	483,	1,	24,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1233,	17,	490,	1,	30,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1234,	17,	491,	1,	31,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1235,	17,	492,	1,	32,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1236,	17,	496,	1,	33,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1237,	17,	497,	1,	34,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1238,	17,	498,	1,	35,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1239,	17,	500,	1,	36,	0,	NULL,	'2019-11-27 13:39:02',	NULL,	NULL,	NULL,	NULL),
(1240,	18,	380,	1,	1,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1241,	18,	381,	1,	2,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1242,	18,	382,	1,	3,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1244,	18,	384,	1,	5,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1245,	18,	385,	1,	6,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1246,	18,	386,	1,	7,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1247,	18,	390,	1,	8,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1248,	18,	391,	1,	9,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1249,	18,	392,	1,	10,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1250,	18,	393,	1,	11,	1,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1251,	18,	397,	1,	12,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1252,	18,	398,	1,	13,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1253,	18,	400,	1,	14,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1254,	18,	401,	1,	15,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1255,	18,	402,	1,	16,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1257,	18,	470,	1,	18,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1258,	18,	478,	1,	19,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1260,	18,	480,	1,	21,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1261,	18,	481,	1,	22,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1262,	18,	482,	1,	23,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1263,	18,	483,	1,	24,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1269,	18,	490,	1,	30,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1270,	18,	491,	1,	31,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1271,	18,	492,	1,	32,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1272,	18,	496,	1,	33,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1273,	18,	497,	1,	34,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1274,	18,	498,	1,	35,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1275,	18,	500,	1,	36,	0,	NULL,	'2019-11-28 11:15:26',	NULL,	NULL,	NULL,	NULL),
(1297,	1,	521,	1,	90,	0,	NULL,	'2019-12-08 12:10:43',	NULL,	NULL,	NULL,	NULL),
(1298,	1,	522,	1,	91,	0,	NULL,	'2019-12-08 12:10:43',	NULL,	NULL,	NULL,	NULL),
(1299,	1,	523,	1,	75,	0,	NULL,	'2019-12-08 12:20:30',	NULL,	NULL,	NULL,	NULL),
(1300,	1,	524,	1,	75,	0,	NULL,	'2019-12-08 13:57:53',	NULL,	NULL,	NULL,	NULL),
(1301,	5,	521,	1,	57,	0,	NULL,	'2019-12-15 13:30:01',	NULL,	NULL,	NULL,	NULL),
(1302,	5,	522,	1,	58,	0,	NULL,	'2019-12-15 13:30:01',	NULL,	NULL,	NULL,	NULL),
(1303,	5,	523,	1,	59,	0,	NULL,	'2019-12-15 13:30:01',	NULL,	NULL,	NULL,	NULL),
(1304,	5,	524,	1,	60,	0,	NULL,	'2019-12-15 13:30:01',	NULL,	NULL,	NULL,	NULL);

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
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`month_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `month` (`month_id`, `month_track_number`, `month_number`, `month_name`, `fk_approval`, `fk_status_id`, `month_created_by`, `month_last_modified_by`, `month_created_date`, `month_last_modified_date`, `fk_approval_id`) VALUES
(1,	'',	1,	'January',	0,	0,	0,	0,	'0000-00-00',	'0000-00-00',	NULL),
(2,	'',	2,	'February',	0,	0,	0,	0,	'0000-00-00',	'0000-00-00',	NULL),
(3,	'MOTH-60467',	3,	'March',	0,	61,	1,	1,	'2019-11-21',	'0000-00-00',	225);

DROP TABLE IF EXISTS `office`;
CREATE TABLE `office` (
  `office_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_track_number` varchar(100) DEFAULT NULL,
  `office_name` varchar(45) NOT NULL,
  `office_description` varchar(45) NOT NULL,
  `office_code` varchar(45) NOT NULL,
  `fk_context_definition_id` int(100) NOT NULL,
  `office_start_date` date NOT NULL,
  `office_end_date` date NOT NULL,
  `office_is_active` int(5) NOT NULL DEFAULT '0',
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
  CONSTRAINT `office_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `office_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `office_ibfk_3` FOREIGN KEY (`fk_context_definition_id`) REFERENCES `context_definition` (`context_definition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the remote sites for the organization';

INSERT INTO `office` (`office_id`, `office_track_number`, `office_name`, `office_description`, `office_code`, `fk_context_definition_id`, `office_start_date`, `office_end_date`, `office_is_active`, `office_created_by`, `office_created_date`, `office_last_modified_date`, `office_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(9,	'CEER-77415',	'GRC Shingila',	'',	'',	13,	'2019-11-07',	'0000-00-00',	1,	1,	'2019-11-07',	'0000-00-00',	1,	151,	45),
(10,	'CEER-86769',	'Mtondia CDC',	'',	'',	13,	'2010-02-18',	'0000-00-00',	1,	1,	'2019-11-21',	'0000-00-00',	1,	254,	45),
(11,	'CEER-31976',	'Mnarani FPFK',	'',	'',	13,	'2003-10-16',	'0000-00-00',	1,	1,	'2019-11-21',	'0000-00-00',	1,	255,	45),
(12,	'CEER-86974',	'Githunguri PCEA',	'',	'',	13,	'1988-11-08',	'0000-00-00',	1,	1,	'2019-11-21',	'0000-00-00',	1,	275,	45),
(13,	'CEER-58399',	'Light CDC',	'',	'',	13,	'2010-03-08',	'0000-00-00',	1,	1,	'2019-11-25',	'0000-00-00',	1,	356,	45),
(14,	'CEER-84915',	'Center 1',	'',	'',	8,	'2019-11-25',	'0000-00-00',	1,	1,	'2019-11-26',	'0000-00-00',	1,	372,	45),
(15,	'CEER-40821',	'Center 2',	'',	'',	13,	'2019-11-26',	'0000-00-00',	1,	1,	'2019-11-26',	'0000-00-00',	1,	373,	45),
(16,	'CEER-45109',	'TAWK',	'',	'',	13,	'2016-01-01',	'0000-00-00',	1,	1,	'2019-11-26',	'0000-00-00',	1,	384,	45),
(17,	'CEER-82530',	'YWT',	'',	'',	13,	'2017-01-01',	'0000-00-00',	1,	1,	'2019-11-26',	'0000-00-00',	1,	385,	45),
(18,	'CEER-5952',	'Kenya Head Office',	'',	'',	10,	'1979-10-17',	'0000-00-00',	1,	1,	'2019-12-03',	'0000-00-00',	1,	433,	45),
(19,	'CEER-29652',	'Kaloleni Cluster Unit',	'',	'',	8,	'2019-06-26',	'0000-00-00',	1,	1,	'2019-12-03',	'0000-00-00',	1,	439,	45),
(20,	'CEER-80112',	'Cohort 1 Unit',	'',	'',	9,	'2009-02-17',	'0000-00-00',	1,	1,	'2019-12-03',	'0000-00-00',	1,	441,	45),
(21,	'OFCE-10254',	'Global Office ',	'',	'G001',	12,	'1990-10-11',	'0000-00-00',	1,	1,	'2019-12-08',	'0000-00-00',	1,	442,	45),
(22,	'OFCE-18309',	'Africa Region Office',	'',	'AFR',	11,	'1979-06-06',	'0000-00-00',	1,	1,	'2019-12-13',	'0000-00-00',	1,	448,	45),
(23,	'OFCE-7255',	'Malindi Cluster',	'',	'MLD',	8,	'2008-07-31',	'0000-00-00',	1,	1,	'2019-12-13',	'0000-00-00',	1,	452,	45),
(24,	'OFCE-76800',	'Uganda Country Office',	'',	'UG',	10,	'1990-07-10',	'0000-00-00',	1,	1,	'2019-12-15',	'0000-00-00',	1,	459,	45),
(25,	'OFCE-78129',	'Uganda East Cohort',	'',	'Uganda East Cohort',	9,	'1994-10-26',	'0000-00-00',	1,	1,	'2019-12-15',	'0000-00-00',	1,	462,	45);

DROP TABLE IF EXISTS `office_bank`;
CREATE TABLE `office_bank` (
  `office_bank_id` int(100) NOT NULL AUTO_INCREMENT,
  `office_bank_track_number` varchar(100) DEFAULT NULL,
  `fk_office_id` int(100) DEFAULT NULL,
  `office_bank_account_number` varchar(50) DEFAULT NULL,
  `fk_bank_branch_id` int(100) DEFAULT NULL,
  `office_bank_created_date` date DEFAULT NULL,
  `office_bank_created_by` int(100) DEFAULT NULL,
  `office_bank_last_modified_date` timestamp NULL DEFAULT NULL,
  `office_bank_last_modified_by` int(100) DEFAULT NULL,
  PRIMARY KEY (`office_bank_id`),
  KEY `fk_center_bank_center1_idx` (`fk_office_id`),
  KEY `fk_center_bank_bank_branch1_idx` (`fk_bank_branch_id`),
  CONSTRAINT `fk_center_bank_bank_branch1` FOREIGN KEY (`fk_bank_branch_id`) REFERENCES `bank_branch` (`bank_branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_center_bank_center1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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

INSERT INTO `page_view` (`page_view_id`, `page_view_track_number`, `page_view_name`, `page_view_description`, `fk_menu_id`, `page_view_is_default`, `page_view_created_date`, `page_view_last_modified_date`, `page_view_created_by`, `page_view_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(14,	'PAEW-5870',	'New requests',	'A list of  new requests',	392,	1,	'2019-11-23',	'2019-11-23 10:48:12',	1,	1,	323,	82),
(15,	'PAEW-78834',	'Requests submitted to head of department ',	'A list of all center submitted requests',	392,	0,	'2019-11-23',	'2019-11-23 11:14:54',	1,	1,	324,	82),
(16,	'PAEW-55574',	'Requests approved by Head of department',	'List all requests approved by head of department',	392,	0,	'2019-11-23',	'2019-11-23 15:45:57',	1,	1,	329,	82),
(17,	'PAEW-3009',	'Request declined by Head of Department',	'Request declined by Head of Department',	392,	1,	'2019-11-23',	'2019-11-23 15:49:09',	1,	1,	331,	82),
(18,	'PAEW-43710',	'Requests approved by finance director',	'Requests approved by finance director',	392,	0,	'2019-11-23',	'2019-11-23 15:50:36',	1,	1,	333,	82),
(19,	'PAEW-29222',	'Requests declined by finance director',	'Requests declined by finance director',	392,	0,	'2019-11-23',	'2019-11-23 15:52:20',	1,	1,	335,	82),
(20,	'PAEW-1180',	'Requests paid by the accountant',	'Requests paid by the accountant',	392,	0,	'2019-11-23',	'2019-11-23 15:53:54',	1,	1,	337,	82),
(21,	'PAEW-59679',	'Requests reinstated to head of department',	'Requests reinstated to head of department',	392,	0,	'2019-11-23',	'2019-11-23 15:54:58',	1,	1,	339,	82),
(22,	'PAEW-44027',	'Requests reinstated to finance director',	'Requests reinstated to finance director',	392,	0,	'2019-11-23',	'2019-11-23 15:56:00',	1,	1,	341,	82);

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

INSERT INTO `page_view_condition` (`page_view_condition_id`, `page_view_condition_track_number`, `page_view_condition_name`, `page_view_condition_field`, `page_view_condition_operator`, `page_view_condition_value`, `fk_page_view_id`, `page_view_condition_created_date`, `page_view_condition_last_modified_date`, `page_view_condition_created_by`, `page_view_condition_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(12,	'PAIL-41326',	NULL,	'fk_status_id',	'equal',	'14',	14,	'2019-11-23',	'2019-11-23 10:48:12',	1,	1,	NULL,	83),
(13,	'PAIL-80580',	NULL,	'fk_status_id',	'equal',	'15',	15,	'2019-11-23',	'2019-11-23 11:14:54',	1,	1,	NULL,	83),
(14,	'PAON-31118',	'Page_view_condition # PAON-31118',	'fk_status_id',	'equal',	'16',	16,	'2019-11-23',	'2019-11-23 15:46:36',	1,	1,	330,	86),
(15,	'PAON-45422',	'Page_view_condition # PAON-45422',	'fk_status_id',	'equal',	'17',	17,	'2019-11-23',	'2019-11-23 15:49:42',	1,	1,	332,	86),
(16,	'PAON-63706',	'Page_view_condition # PAON-63706',	'fk_status_id',	'equal',	'18',	18,	'2019-11-23',	'2019-11-23 15:51:40',	1,	1,	334,	86),
(17,	'PAON-20951',	'Page_view_condition # PAON-20951',	'fk_status_id',	'equal',	'19',	19,	'2019-11-23',	'2019-11-23 15:53:05',	1,	1,	336,	86),
(18,	'PAON-64491',	'Page_view_condition # PAON-64491',	'fk_status_id',	'equal',	'20',	20,	'2019-11-23',	'2019-11-23 15:54:20',	1,	1,	338,	86),
(19,	'PAON-36429',	'Page_view_condition # PAON-36429',	'fk_status_id',	'equal',	'21',	21,	'2019-11-23',	'2019-11-23 15:55:24',	1,	1,	340,	86),
(20,	'PAON-86262',	'Page_view_condition # PAON-86262',	'fk_status_id',	'equal',	'22',	22,	'2019-11-23',	'2019-11-23 15:56:48',	1,	1,	342,	86);

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

INSERT INTO `page_view_role` (`page_view_role_id`, `page_view_role_track_number`, `page_view_role_name`, `page_view_role_is_default`, `fk_page_view_id`, `fk_role_id`, `page_view_role_created_date`, `page_view_role_last_modified_date`, `page_view_role_created_by`, `page_view_role_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'PALE-58330',	'Page_view_role # PALE-58330',	0,	14,	3,	'2019-11-23',	'2019-11-23 14:18:13',	1,	1,	325,	84),
(2,	'PALE-17074',	'Page_view_role # PALE-17074',	1,	15,	3,	'2019-11-23',	'2019-11-23 15:59:55',	1,	1,	343,	84),
(3,	'PALE-70773',	'Page_view_role # PALE-70773',	1,	15,	1,	'2019-11-23',	'2019-11-23 16:00:34',	1,	1,	344,	84),
(4,	'PALE-3178',	'Page_view_role # PALE-3178',	1,	14,	6,	'2019-11-25',	'2019-11-25 14:16:55',	1,	1,	365,	84),
(5,	'PALE-84091',	'Page_view_role # PALE-84091',	0,	16,	3,	'2019-11-27',	'2019-11-27 12:30:12',	1,	1,	393,	84),
(6,	'PALE-44630',	'Page_view_role # PALE-44630',	0,	15,	2,	'2019-11-27',	'2019-11-27 13:43:39',	1,	1,	412,	84),
(7,	'PALE-71536',	'Page_view_role # PALE-71536',	0,	22,	2,	'2019-11-27',	'2019-11-27 13:44:22',	1,	1,	413,	84),
(8,	'PALE-41828',	'Page_view_role # PALE-41828',	0,	16,	2,	'2019-11-27',	'2019-11-27 13:50:46',	1,	1,	414,	84),
(9,	'PALE-16248',	'Page_view_role # PALE-16248',	0,	19,	2,	'2019-11-27',	'2019-11-27 16:34:39',	1,	1,	422,	84),
(10,	'PALE-77323',	'Page_view_role # PALE-77323',	1,	19,	2,	'2019-11-27',	'2019-11-27 16:39:24',	1,	1,	423,	84),
(11,	'PALE-51250',	'Page_view_role # PALE-51250',	0,	17,	3,	'2019-11-27',	'2019-11-27 16:45:22',	1,	1,	424,	84);

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
(30,	'PEON-2742',	'edit_bank',	'Editing a bank record',	1,	3,	1,	'',	381,	199,	47,	'2019-11-08',	1,	NULL,	'2019-11-08 17:29:44',	1),
(31,	'PEON-58643',	'show_user_list',	'Show a list of users',	1,	2,	1,	'',	400,	205,	47,	'2019-11-11',	1,	NULL,	'2019-11-11 09:49:39',	1),
(32,	'PEON-46125',	'show_permission_labels',	'Show a list of permission lables',	1,	2,	1,	'',	390,	220,	47,	'2019-11-20',	1,	NULL,	'2019-11-20 16:51:26',	1),
(33,	'PEON-8856',	'list_users',	'List all users',	1,	1,	1,	'',	400,	222,	47,	'2019-11-20',	1,	NULL,	'2019-11-20 17:04:36',	1),
(34,	'PEON-30929',	'show_my_menu',	'Show you menu items',	1,	2,	1,	'0',	470,	348,	47,	'2019-11-23',	1,	NULL,	'2019-11-23 18:11:34',	1);

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
(1,	'PBL-56069',	'create',	'Mark all permissions used to create a new record',	2,	120,	50,	'2019-11-06',	1,	'2019-11-06 12:48:54',	1),
(2,	'PBL-32200',	'read',	'Mark all permissions used to read a record',	1,	121,	50,	'2019-11-06',	1,	'2019-11-06 12:51:56',	1),
(3,	'PBL-37242',	'update',	'Mark all permissions for updating a record',	3,	122,	50,	'2019-11-06',	1,	'2019-11-06 12:52:25',	1),
(4,	'PBL-14166',	'delete',	'Mark all permissions used to delete a record',	4,	123,	50,	'2019-11-06',	1,	'2019-11-06 12:52:43',	1);

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
(7,	'PRCT-77292',	'Project 1',	'P001',	'Project 1',	'2019-11-01',	'2019-11-30',	13,	100000.00,	1,	1,	1,	'2019-11-27',	'0000-00-00',	401,	43),
(8,	'PRCT-73281',	'Advocacy',	'ADV021',	'This is advocacy funding for funder b',	'2017-11-16',	'2022-07-28',	14,	45000000.00,	1,	1,	1,	'2019-11-27',	'0000-00-00',	416,	43),
(9,	'PRCT-24953',	'WASH',	'WASH435',	'This is a wash project for funder b',	'2017-08-01',	'2022-07-27',	14,	8000000.00,	1,	1,	1,	'2019-11-27',	'0000-00-00',	417,	43);

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

INSERT INTO `project_allocation` (`project_allocation_id`, `project_allocation_track_number`, `fk_project_id`, `project_allocation_name`, `project_allocation_amount`, `project_allocation_is_active`, `fk_office_id`, `fk_status_id`, `fk_approval_id`, `project_allocation_extended_end_date`, `project_allocation_created_date`, `project_allocation_last_modified_date`, `project_allocation_created_by`, `project_allocation_last_modified_by`) VALUES
(5,	'PRON-88526',	7,	'TAWK Project 1 ',	30000.00,	1,	16,	44,	402,	'2019-11-30',	'2019-11-27',	NULL,	1,	1),
(6,	'PRON-66515',	7,	'YWT Project 1',	45000.00,	1,	17,	44,	405,	'2019-11-30',	'2019-11-27',	NULL,	1,	1),
(7,	'PRON-2654',	8,	'TWAK Advocacy',	560000.00,	1,	16,	44,	418,	'2020-03-28',	'2019-11-27',	NULL,	1,	1),
(8,	'PRON-62640',	9,	'GRC Shingila - WASH',	650000.00,	1,	9,	44,	469,	'2019-12-15',	'2019-12-15',	NULL,	1,	1);

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
  `fk_office_id` int(100) DEFAULT NULL,
  `reconciliation_reporting_month` date DEFAULT NULL,
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
  CONSTRAINT `fk_reconciliation_center1` FOREIGN KEY (`fk_office_id`) REFERENCES `office` (`office_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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

INSERT INTO `request` (`request_id`, `request_track_number`, `request_name`, `fk_request_type_id`, `fk_status_id`, `fk_office_id`, `fk_approval_id`, `request_date`, `request_description`, `fk_department_id`, `request_created_date`, `request_created_by`, `request_last_modified_by`, `request_last_modified_date`, `request_deleted_at`) VALUES
(1,	'REST-50733',	'Test',	2,	14,	9,	464,	'2019-12-15',	'Test',	1,	'2019-12-15',	'1',	'1',	'2019-12-15 09:53:15',	NULL),
(2,	'REST-21224',	'Test 2',	1,	15,	9,	466,	'2019-12-15',	'Test 2',	1,	'2019-12-15',	'5',	'5',	'2019-12-15 14:29:53',	NULL),
(3,	'REST-53097',	'Test 3',	2,	14,	9,	468,	'2019-12-15',	'Test 3',	2,	'2019-12-15',	'5',	'5',	'2019-12-15 15:17:11',	NULL);

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
  `request_detail_conversion_set` int(5) DEFAULT '0',
  `fk_voucher_id` int(100) DEFAULT NULL,
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

INSERT INTO `request_detail` (`request_detail_id`, `request_detail_track_number`, `fk_request_id`, `request_detail_description`, `request_detail_quantity`, `request_detail_unit_cost`, `request_detail_total_cost`, `fk_expense_account_id`, `fk_project_allocation_id`, `fk_status_id`, `fk_approval_id`, `request_detail_conversion_set`, `fk_voucher_id`, `request_detail_created_date`, `request_detail_created_by`, `request_detail_last_modified_by`, `request_detail_last_modified_date`) VALUES
(1,	'REIL-77347',	1,	'Test',	20,	200.00,	400.00,	1,	5,	1,	NULL,	0,	NULL,	'2019-12-15',	1,	1,	'2019-12-15 09:53:15'),
(2,	'REIL-54941',	2,	'Test 2',	25,	500.00,	12500.00,	3,	6,	15,	NULL,	0,	NULL,	'2019-12-15',	5,	5,	'2019-12-15 14:29:53'),
(3,	'REIL-8734',	3,	'Test 3',	20,	700.00,	14000.00,	1,	5,	1,	NULL,	0,	NULL,	'2019-12-15',	5,	5,	'2019-12-15 15:17:11'),
(4,	'REIL-24712',	3,	'Test 3',	25,	850.00,	21250.00,	2,	7,	1,	NULL,	0,	NULL,	'2019-12-15',	5,	5,	'2019-12-15 15:17:11');

DROP TABLE IF EXISTS `request_type`;
CREATE TABLE `request_type` (
  `request_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `request_type_track_number` varchar(100) NOT NULL,
  `request_type_name` varchar(100) NOT NULL,
  `request_type_created_date` date DEFAULT NULL,
  `request_type_created_by` int(100) DEFAULT NULL,
  `request_type_last_modified_by` int(100) DEFAULT NULL,
  `request_type_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`request_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `request_type` (`request_type_id`, `request_type_track_number`, `request_type_name`, `request_type_created_date`, `request_type_created_by`, `request_type_last_modified_by`, `request_type_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'REPE-35675',	'General',	'2019-11-23',	1,	1,	'2019-11-23 14:37:14',	326,	85),
(2,	'REPE-52210',	'Child Protection',	'2019-11-23',	1,	1,	'2019-11-23 14:37:52',	327,	85),
(3,	'REPE-29451',	'Health',	'2019-11-23',	1,	1,	'2019-11-23 14:38:04',	328,	85);

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
(1,	'ROL-65362',	'Department Manager',	'departmentmanager',	'Department Manager',	1,	0,	1,	1,	'2019-11-04',	'2019-11-06 06:08:14',	'1',	NULL,	150,	46),
(2,	'ROLE-86037',	'Finance Director',	'financedirector',	'Finance Director',	1,	0,	0,	1,	'2019-11-08',	'2019-11-08 10:06:09',	'1',	NULL,	167,	46),
(3,	'ROLE-23190',	'Office Accountant',	'officeaccountant',	'An Office Accountant',	1,	1,	0,	1,	'2019-11-08',	'2019-11-08 11:38:04',	'1',	NULL,	175,	46),
(4,	'ROLE-9951',	'Admin',	'admin',	'This is a country admin',	1,	0,	0,	1,	'2019-11-20',	'2019-11-20 16:41:17',	'1',	NULL,	219,	46),
(5,	'ROLE-6494',	'National Office Accoutant',	'noaccountant',	'National Office Accoutant',	1,	0,	0,	1,	'2019-11-24',	'2019-11-24 21:53:12',	'1',	NULL,	353,	46),
(6,	'ROLE-8522',	'Test Role',	'tesrole',	'This is a test role',	1,	0,	0,	1,	'2019-11-25',	'2019-11-25 13:57:26',	'1',	NULL,	360,	46),
(7,	'ROLE-24515',	'Test Role 1',	'testrole1',	'Test Role 1',	1,	0,	0,	1,	'2019-11-26',	'2019-11-26 12:54:34',	'1',	NULL,	374,	46),
(8,	'ROLE-10917',	'Test Role 2',	'testrole2',	'Test role 2',	1,	0,	0,	1,	'2019-11-26',	'2019-11-26 12:55:01',	'1',	NULL,	375,	46),
(9,	'ROLE-80181',	'Affiliate Accountant',	'afficiliateaccountant',	'This is role which will allow holders add requests, vouchers etc',	1,	0,	0,	1,	'2019-11-26',	'2019-11-26 14:03:54',	'1',	NULL,	386,	46);

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
(16,	'ROON-28987',	'Finance director editing a bank',	1,	2,	30,	201,	48,	'2019-11-08',	1,	'2019-11-08 17:31:49',	1),
(17,	'ROON-63197',	'Finance Director Listing all users',	1,	2,	31,	206,	48,	'2019-11-11',	1,	'2019-11-11 09:50:29',	1),
(18,	'ROON-77476',	'Show a list of permission labels',	1,	4,	32,	221,	48,	'2019-11-20',	1,	'2019-11-20 16:52:41',	1),
(19,	'ROON-49919',	'List all users',	1,	4,	33,	223,	48,	'2019-11-20',	1,	'2019-11-20 17:05:06',	1),
(20,	'ROON-67098',	'List all permission labels by an department head',	1,	1,	32,	224,	48,	'2019-11-20',	1,	'2019-11-20 17:12:14',	1),
(21,	'ROON-85421',	'Listing requests to center accountant',	1,	3,	22,	274,	48,	'2019-11-21',	1,	'2019-11-21 19:51:30',	1),
(22,	'ROON-78079',	'List requests',	1,	1,	22,	276,	48,	'2019-11-21',	1,	'2019-11-21 22:30:27',	1),
(23,	'ROON-12657',	'Accountant adding a request',	1,	3,	23,	284,	48,	'2019-11-22',	1,	'2019-11-22 10:15:49',	1),
(24,	'ROON-23493',	'Department manager adding a request',	1,	1,	23,	285,	48,	'2019-11-22',	1,	'2019-11-22 10:33:01',	1),
(25,	'ROON-40361',	'Accountant able to view menu items',	1,	3,	34,	349,	48,	'2019-11-23',	1,	'2019-11-23 18:12:31',	1),
(26,	'ROON-53893',	'Allowing listing of requests',	1,	6,	22,	361,	48,	'2019-11-25',	1,	'2019-11-25 13:59:46',	1),
(27,	'ROON-44503',	'Tesr role 1 listing requests',	1,	7,	22,	376,	48,	'2019-11-26',	1,	'2019-11-26 12:56:58',	1),
(28,	'ROON-34108',	'Role 1 Adding requests',	1,	7,	23,	377,	48,	'2019-11-26',	1,	'2019-11-26 12:57:18',	1),
(29,	'ROON-3556',	'Show requests to affiliate accountant',	1,	9,	22,	387,	48,	'2019-11-26',	1,	'2019-11-26 14:06:58',	1),
(30,	'ROON-43907',	'Add request by affiliate accountant',	1,	9,	23,	388,	48,	'2019-11-26',	1,	'2019-11-26 14:08:47',	1),
(31,	'ROON-37252',	'Show requests to AC',	1,	5,	22,	427,	48,	'2019-11-28',	1,	'2019-11-28 10:02:02',	1);

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
  `fk_approve_item_id` int(11) NOT NULL,
  `status_approval_sequence` int(10) NOT NULL,
  `status_backflow_sequence` int(10) NOT NULL,
  `status_approval_direction` int(5) NOT NULL COMMENT '1-straight jumps, 0 - return jumps, -1 - reverse jump',
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
  KEY `fk_role_id` (`fk_role_id`),
  CONSTRAINT `status_ibfk_2` FOREIGN KEY (`fk_approve_item_id`) REFERENCES `approve_item` (`approve_item_id`),
  CONSTRAINT `status_ibfk_3` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `status` (`status_id`, `status_track_number`, `status_name`, `fk_approve_item_id`, `status_approval_sequence`, `status_backflow_sequence`, `status_approval_direction`, `status_is_requiring_approver_action`, `fk_role_id`, `status_created_date`, `status_created_by`, `status_last_modified_date`, `status_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'',	'New',	1,	1,	0,	1,	1,	3,	'0000-00-00',	0,	'2019-11-27 12:03:26',	0,	NULL,	NULL),
(2,	'',	'Submitted to Head of Department	',	1,	2,	0,	1,	1,	1,	'0000-00-00',	0,	'2019-12-15 14:45:42',	0,	NULL,	NULL),
(3,	'',	'Approved By Head of Department',	1,	3,	0,	1,	1,	2,	'0000-00-00',	0,	'2019-11-27 12:04:17',	0,	NULL,	NULL),
(4,	'',	'Declined By Head of Department',	1,	2,	1,	-1,	1,	1,	'0000-00-00',	0,	'2019-11-27 12:05:01',	0,	NULL,	NULL),
(5,	'',	'Approved By Finance Director',	1,	4,	0,	1,	1,	5,	'0000-00-00',	0,	'2019-11-27 12:05:23',	0,	NULL,	NULL),
(6,	'',	'Declined By Finance Director',	1,	3,	1,	-1,	1,	2,	'0000-00-00',	0,	'2019-11-27 12:08:44',	0,	NULL,	NULL),
(7,	'',	'Paid By Accountant',	1,	5,	0,	1,	0,	5,	'0000-00-00',	0,	'2019-11-27 12:09:59',	0,	NULL,	NULL),
(8,	'',	'Reinstated to Head of Department',	1,	2,	0,	0,	1,	1,	'0000-00-00',	0,	'2019-12-15 14:45:42',	0,	NULL,	NULL),
(9,	'',	'Reinstate to Finance Director',	1,	3,	0,	0,	1,	2,	'0000-00-00',	0,	'2019-11-27 12:09:59',	0,	NULL,	NULL),
(10,	'',	'Submitted',	2,	1,	0,	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:05:19',	0,	NULL,	NULL),
(11,	'',	'Approved By Finance Director',	2,	2,	0,	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(12,	'',	'Declined By Finance Director',	2,	2,	0,	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(13,	'',	'Reinstated to Finance Director',	2,	2,	0,	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(14,	'',	'New',	3,	1,	0,	1,	1,	3,	'0000-00-00',	0,	'2019-11-24 21:57:03',	0,	NULL,	NULL),
(15,	'',	'Submitted to Head of Department',	3,	2,	0,	1,	1,	1,	'0000-00-00',	0,	'2019-12-15 14:45:42',	0,	NULL,	NULL),
(16,	'',	'Approved By Head of Department',	3,	3,	0,	1,	1,	2,	'0000-00-00',	0,	'2019-11-24 23:07:03',	0,	NULL,	NULL),
(17,	'',	'Declined By Head of Department',	3,	2,	1,	-1,	1,	1,	'0000-00-00',	0,	'2019-11-24 23:06:30',	0,	NULL,	NULL),
(18,	'',	'Approved By Finance Director',	3,	4,	0,	1,	1,	5,	'0000-00-00',	0,	'2019-11-24 22:30:26',	0,	NULL,	NULL),
(19,	'',	'Declined By Finance Director',	3,	3,	1,	-1,	1,	2,	'0000-00-00',	0,	'2019-11-24 23:07:03',	0,	NULL,	NULL),
(20,	'',	'Paid By Accountant',	3,	5,	0,	1,	0,	5,	'0000-00-00',	0,	'2019-11-24 22:32:23',	0,	NULL,	NULL),
(21,	'',	'Reinstated to Head of Department',	3,	2,	0,	0,	1,	1,	'0000-00-00',	0,	'2019-12-15 14:45:42',	0,	NULL,	NULL),
(22,	'',	'Reinstated to Finance Director',	3,	3,	0,	0,	1,	2,	'0000-00-00',	0,	'2019-11-25 01:22:31',	0,	NULL,	NULL),
(23,	'',	'New',	4,	1,	0,	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(30,	'',	'New',	5,	1,	0,	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(33,	'',	'New',	8,	1,	0,	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(34,	'',	'New',	9,	1,	0,	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(38,	'',	'New',	13,	1,	0,	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(39,	'',	'New',	14,	1,	0,	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(43,	'',	'New',	18,	1,	0,	1,	0,	1,	'2019-10-25',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(44,	'',	'New',	19,	1,	0,	1,	0,	1,	'2019-11-03',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(45,	'',	'New',	20,	1,	0,	1,	0,	1,	'2019-11-03',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(46,	'',	'New',	21,	1,	0,	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(47,	'',	'New',	22,	1,	0,	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(48,	'',	'New',	23,	1,	0,	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(49,	'',	'New',	24,	1,	0,	1,	0,	1,	'2019-11-05',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(50,	'',	'New',	25,	1,	0,	1,	0,	1,	'2019-11-06',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(51,	'',	'New',	26,	1,	0,	1,	0,	1,	'2019-11-06',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(52,	'',	'New',	27,	1,	0,	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(53,	'',	'New',	28,	1,	0,	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(54,	'',	'New',	29,	1,	0,	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(55,	'',	'New',	30,	1,	0,	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(56,	'',	'New',	31,	1,	0,	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(57,	'',	'New',	32,	1,	0,	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(58,	'',	'New',	33,	1,	0,	1,	0,	2,	'2019-11-13',	1,	'2019-11-13 18:19:46',	1,	NULL,	NULL),
(59,	'',	'New',	34,	1,	0,	1,	0,	2,	'2019-11-13',	1,	'2019-11-13 18:19:58',	1,	NULL,	NULL),
(61,	'',	'New',	36,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:15:01',	1,	NULL,	NULL),
(62,	'',	'New',	37,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:15:43',	1,	NULL,	NULL),
(63,	'',	'New',	38,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:17:28',	1,	NULL,	NULL),
(64,	'',	'New',	39,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:54:46',	1,	NULL,	NULL),
(65,	'',	'New',	40,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 00:12:27',	1,	NULL,	NULL),
(66,	'',	'New',	41,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:43:37',	1,	NULL,	NULL),
(67,	'',	'New',	42,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:45:54',	1,	NULL,	NULL),
(68,	'',	'New',	43,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:48:36',	1,	NULL,	NULL),
(69,	'',	'New',	44,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:52:00',	1,	NULL,	NULL),
(70,	'',	'New',	45,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:56:56',	1,	NULL,	NULL),
(71,	'',	'New',	46,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 14:51:30',	1,	NULL,	NULL),
(72,	'',	'New',	47,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 15:40:57',	1,	NULL,	NULL),
(73,	'',	'New',	48,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:09:50',	1,	NULL,	NULL),
(74,	'',	'New',	49,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:14:04',	1,	NULL,	NULL),
(75,	'',	'New',	50,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:31:45',	1,	NULL,	NULL),
(76,	'',	'New',	51,	1,	0,	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:37:42',	1,	NULL,	NULL),
(77,	'',	'New',	52,	1,	0,	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 07:22:23',	1,	NULL,	NULL),
(78,	'',	'New',	53,	1,	0,	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 07:52:16',	1,	NULL,	NULL),
(79,	'',	'New',	54,	1,	0,	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 08:29:59',	1,	NULL,	NULL),
(80,	'',	'New',	55,	1,	0,	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 08:35:26',	1,	NULL,	NULL),
(81,	'',	'New',	56,	1,	0,	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 22:07:30',	1,	NULL,	NULL),
(82,	'',	'New',	57,	1,	0,	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(83,	'',	'New',	58,	1,	0,	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(84,	'',	'New',	59,	1,	0,	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 14:11:51',	1,	NULL,	NULL),
(85,	'',	'New',	60,	1,	0,	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 14:31:51',	1,	NULL,	NULL),
(86,	'',	'New',	61,	1,	0,	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL),
(87,	'',	'New',	62,	1,	0,	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL);

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
  `shortname` varchar(20) NOT NULL,
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

INSERT INTO `user` (`user_id`, `user_track_number`, `user_name`, `shortname`, `user_firstname`, `user_lastname`, `user_email`, `fk_context_definition_id`, `user_is_context_manager`, `user_is_system_admin`, `fk_language_id`, `user_is_active`, `fk_role_id`, `user_password`, `user_created_date`, `user_created_by`, `user_last_modified_date`, `user_last_modifed_by`, `user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'USR-84763',	'Nicodemus Karisa',	'',	'Nicodemus',	'Karisa',	'nkmwambs@gmail.com',	10,	0,	1,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'0000-00-00',	0,	'2019-11-07 07:54:59',	NULL,	0,	NULL,	NULL),
(2,	'USER-24279',	'Mwambire Karisa',	'',	'Mwambire',	'Karisa ',	'nkmwambs2@gmail.com',	8,	0,	0,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 07:21:31',	NULL,	1,	160,	54),
(4,	'USER-85054',	'Joyce Cherono',	'',	'Joyce',	'Cherono',	'jcherono@gmail.com',	8,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 07:55:20',	NULL,	1,	162,	54),
(5,	'USER-35106',	'David Mbitsi',	'',	'David',	'Mbitsi',	'davidm@gmail.com',	13,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 11:57:17',	NULL,	1,	176,	54),
(6,	'USER-8011',	'Betty Kanze',	'',	'Betty',	'Kanze',	'byeri@gmail.com',	8,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:14:22',	NULL,	1,	177,	54),
(7,	'USER-74028',	'Livingstone Onduso',	'',	'Livingstone',	'Onduso',	'onduso@gmail.com',	8,	0,	1,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:16:01',	NULL,	1,	178,	54),
(8,	'USER-56932',	'John Koi',	'',	'John',	'Koi',	'jkoi@gmail.com',	9,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:18:44',	NULL,	1,	179,	54),
(9,	'USER-42367',	'Mapenzi Amani',	'',	'Mapenzi',	'Amani',	'mapenzi@gmail.com',	8,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:23:24',	NULL,	1,	180,	54),
(10,	'USER-14904',	'Hellen Bahati',	'',	'Hellen',	'Bahati',	'hellen@gmail.com',	8,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:24:18',	NULL,	1,	181,	54),
(11,	'USER-45040',	'Trizer Bethuel',	'',	'Trizer',	'Bethuel',	'trizer@gmail.com',	12,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:26:22',	NULL,	1,	182,	54),
(12,	'USER-19929',	'Admin Main',	'',	'Main',	'Admin',	'admin@gmail.com',	8,	0,	0,	1,	1,	4,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-20',	1,	'2019-11-20 16:40:43',	NULL,	1,	218,	54),
(13,	'USER-13258',	'Joan Kampala',	'jkampala',	'Joan',	'Kampala',	'jkampala@gmail.com',	13,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-25',	1,	'2019-11-25 07:26:30',	1,	1,	357,	54),
(14,	'USER-39078',	'Test User',	'',	'Test',	'User',	'tuser@gmail.com',	10,	0,	0,	1,	1,	6,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-25',	1,	'2019-11-25 14:07:15',	NULL,	1,	363,	54),
(15,	'USER-29419',	'Test User 2',	'',	'Test ',	'User 2',	'testuser2@gmail.com',	13,	0,	0,	1,	1,	7,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-26',	1,	'2019-11-26 13:03:56',	NULL,	1,	378,	54),
(16,	'USER-72870',	'Wilson Gitonga',	'',	'Wilson ',	'Wilson Gitonga',	'wilson@gmail.com',	13,	0,	0,	1,	1,	9,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-26',	1,	'2019-11-26 14:12:12',	NULL,	1,	389,	54),
(17,	'USER-1336',	'Mary Joy',	'',	'Mary',	'Joy',	'joy@gmail.com',	10,	0,	0,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-27',	1,	'2019-11-27 13:37:07',	NULL,	1,	410,	54),
(18,	'USER-20992',	'Ben Ken',	'',	'Ben',	'Ken',	'ben@gmail.com',	10,	0,	0,	1,	1,	5,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-28',	1,	'2019-11-28 09:55:58',	NULL,	1,	426,	54);

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
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
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


DROP TABLE IF EXISTS `voucher_type`;
CREATE TABLE `voucher_type` (
  `voucher_type_id` int(100) NOT NULL AUTO_INCREMENT,
  `voucher_type_track_number` varchar(100) NOT NULL,
  `voucher_type_name` varchar(45) DEFAULT NULL,
  `voucher_type_is_active` int(5) DEFAULT NULL,
  `voucher_type_cash_account` varchar(20) DEFAULT NULL COMMENT 'Can either be bank or cash',
  `voucher_type_transaction_effect` varchar(20) DEFAULT NULL COMMENT 'Can be payment or revenue',
  `voucher_type_created_by` int(100) DEFAULT NULL,
  `voucher_type_created_date` date DEFAULT NULL,
  `voucher_type_last_modified_by` int(100) DEFAULT NULL,
  `voucher_type_last_modified_date` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`voucher_type_id`),
  KEY `fk_voucher_type_voucher_type_transaction_effect1_idx` (`voucher_type_transaction_effect`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `voucher_type` (`voucher_type_id`, `voucher_type_track_number`, `voucher_type_name`, `voucher_type_is_active`, `voucher_type_cash_account`, `voucher_type_transaction_effect`, `voucher_type_created_by`, `voucher_type_created_date`, `voucher_type_last_modified_by`, `voucher_type_last_modified_date`, `fk_approval_id`, `fk_status_id`) VALUES
(2,	'',	'Payment by Cash',	1,	'cash',	'expense',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(3,	'',	'Bank payment',	1,	'bank',	'expense',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(4,	'',	'Petty Cash Top Up',	1,	'to_cash',	'contra',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(5,	'',	'Bank Cash Received',	1,	'bank',	'income',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(6,	'',	'Bank Charges',	1,	'bank',	'expense',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(7,	'',	'Bank Interest Receiveable',	1,	'bank',	'income',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(8,	'',	'Petty Cash Income',	1,	'income',	'contra',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL),
(9,	'',	'Petty Cash Rebanking',	1,	'to_bank',	'contra',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);

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


-- 2019-12-16 10:44:40
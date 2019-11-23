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
(155,	'APR-8086',	'Approval Ticket No APR-8086',	3,	87,	1,	'2019-11-07',	'2019-11-11 09:27:24',	1),
(156,	'APAL-81132',	'Approval Ticket # APAL-81132',	19,	87,	1,	'2019-11-07',	'2019-11-07 14:05:14',	1),
(157,	'APAL-76190',	'Approval Ticket # APAL-76190',	22,	87,	1,	'2019-11-07',	'2019-11-07 14:06:25',	1),
(158,	'APAL-52378',	'Approval Ticket # APAL-52378',	19,	87,	1,	'2019-11-07',	'2019-11-07 14:07:04',	1),
(159,	'APAL-10554',	'Approval Ticket # APAL-10554',	3,	87,	1,	'2019-11-07',	'2019-11-07 17:23:55',	1),
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
(204,	'APAL-48936',	'Approval Ticket # APAL-48936',	3,	87,	1,	'2019-11-11',	'2019-11-11 07:54:25',	1),
(205,	'APAL-59716',	'Approval Ticket # APAL-59716',	22,	87,	1,	'2019-11-11',	'2019-11-11 09:49:39',	1),
(206,	'APAL-75533',	'Approval Ticket # APAL-75533',	23,	87,	1,	'2019-11-11',	'2019-11-11 09:50:29',	1),
(207,	'APAL-59488',	'Approval Ticket # APAL-59488',	4,	87,	1,	'2019-11-12',	'2019-11-12 01:17:55',	1),
(208,	'APAL-30369',	'Approval Ticket # APAL-30369',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:49:51',	1),
(209,	'APAL-13369',	'Approval Ticket # APAL-13369',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:50:25',	1),
(210,	'APAL-65785',	'Approval Ticket # APAL-65785',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:51:40',	1),
(211,	'APAL-57065',	'Approval Ticket # APAL-57065',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:51:49',	1),
(212,	'APAL-67930',	'Approval Ticket # APAL-67930',	33,	87,	1,	'2019-11-13',	'2019-11-13 21:52:11',	1),
(213,	'APAL-43010',	'Approval Ticket # APAL-43010',	35,	87,	1,	'2019-11-13',	'2019-11-13 22:16:26',	1),
(214,	'APAL-84605',	'Approval Ticket # APAL-84605',	35,	87,	1,	'2019-11-13',	'2019-11-13 22:16:41',	1),
(215,	'APAL-18767',	'Approval Ticket # APAL-18767',	35,	87,	1,	'2019-11-13',	'2019-11-13 22:16:52',	1),
(216,	'APAL-44736',	'Approval Ticket # APAL-44736',	35,	87,	1,	'2019-11-13',	'2019-11-13 22:17:08',	1),
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
(227,	'APAL-42414',	'Approval Ticket # APAL-42414',	35,	87,	1,	'2019-11-21',	'2019-11-21 05:16:34',	1),
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
(289,	'APAL-66939',	'Approval Ticket # APAL-66939',	3,	87,	1,	'2019-11-22',	'2019-11-22 16:42:41',	1),
(290,	'APAL-8674',	'Approval Ticket # APAL-8674',	3,	87,	1,	'2019-11-22',	'2019-11-22 16:44:15',	1),
(291,	'APAL-54220',	'Approval Ticket # APAL-54220',	3,	87,	1,	'2019-11-22',	'2019-11-22 16:46:53',	1),
(292,	'APAL-84873',	'Approval Ticket # APAL-84873',	3,	87,	1,	'2019-11-22',	'2019-11-22 16:47:44',	1),
(293,	'APAL-25789',	'Approval Ticket # APAL-25789',	3,	87,	1,	'2019-11-22',	'2019-11-22 17:24:28',	1),
(294,	'APAL-14775',	'Approval Ticket # APAL-14775',	3,	87,	1,	'2019-11-22',	'2019-11-22 17:26:09',	1),
(295,	'APAL-38513',	'Approval Ticket # APAL-38513',	45,	87,	1,	'2019-11-22',	'2019-11-22 17:28:20',	1),
(296,	'APAL-47909',	'Approval Ticket # APAL-47909',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:38:55',	1),
(297,	'APAL-42142',	'Approval Ticket # APAL-42142',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:53:20',	1),
(298,	'APAL-53526',	'Approval Ticket # APAL-53526',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:56:32',	1),
(299,	'APAL-19128',	'Approval Ticket # APAL-19128',	8,	87,	1,	'2019-11-22',	'2019-11-22 17:58:41',	1),
(300,	'APAL-50869',	'Approval Ticket # APAL-50869',	8,	87,	1,	'2019-11-22',	'2019-11-22 18:00:10',	1),
(301,	'APAL-14434',	'Approval Ticket # APAL-14434',	8,	87,	1,	'2019-11-22',	'2019-11-22 18:00:32',	1),
(302,	'APAL-69852',	'Approval Ticket # APAL-69852',	8,	87,	1,	'2019-11-22',	'2019-11-22 18:06:42',	1),
(304,	'APAL-4915',	'Approval Ticket # APAL-4915',	3,	87,	1,	'2019-11-22',	'2019-11-22 18:09:23',	1),
(305,	'APAL-13526',	'Approval Ticket # APAL-13526',	3,	87,	1,	'2019-11-22',	'2019-11-22 18:12:54',	1),
(306,	'APAL-27828',	'Approval Ticket # APAL-27828',	3,	87,	1,	'2019-11-22',	'2019-11-22 18:13:20',	1),
(307,	'APAL-50025',	'Approval Ticket # APAL-50025',	40,	87,	1,	'2019-11-22',	'2019-11-22 21:18:48',	1),
(310,	'APAL-34534',	'Approval Ticket # APAL-34534',	3,	87,	1,	'2019-11-23',	'2019-11-23 09:58:59',	1),
(312,	'APAL-27814',	'Approval Ticket # APAL-27814',	57,	87,	1,	'2019-11-23',	'2019-11-23 10:04:46',	1),
(313,	'APAL-23057',	'Approval Ticket # APAL-23057',	8,	87,	1,	'2019-11-23',	'2019-11-23 10:05:58',	1),
(317,	'APAL-69592',	'Approval Ticket # APAL-69592',	3,	87,	1,	'2019-11-23',	'2019-11-23 10:18:15',	1),
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
(352,	'APAL-70876',	'Approval Ticket # APAL-70876',	59,	87,	1,	'2019-11-23',	'2019-11-23 18:23:50',	1);

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
(1,	'APEM-45322',	'request_detail',	0,	'0000-00-00',	0,	'2019-11-15 18:11:56',	0,	NULL,	NULL),
(2,	'APEM-45323',	'voucher',	1,	'0000-00-00',	0,	'2019-11-15 18:14:11',	0,	NULL,	NULL),
(3,	'APEM-45324',	'request',	1,	'0000-00-00',	0,	'2019-11-15 18:14:11',	0,	NULL,	NULL),
(4,	'APEM-45325',	'budget',	1,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(5,	'APEM-45326',	'budget_item',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(8,	'APEM-45327',	'funder',	1,	'2019-10-22',	1,	'2019-11-20 23:35:59',	1,	NULL,	NULL),
(9,	'APEM-45328',	'workplan',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(13,	'APEM-45329',	'budget_item_detail',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(14,	'APEM-45330',	'voucher_detail',	0,	'2019-10-22',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(18,	'APEM-45331',	'project',	0,	'2019-10-25',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(19,	'APEM-45332',	'project_allocation',	1,	'2019-11-03',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(20,	'APEM-45333',	'center',	1,	'2019-11-03',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
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
(33,	'APEM-45346',	'center_group',	0,	'2019-11-13',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(34,	'APEM-45347',	'center_group_hierarchy',	0,	'2019-11-13',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(35,	'APEM-45348',	'center_group_link',	0,	'2019-11-13',	1,	'2019-11-15 18:14:11',	1,	NULL,	NULL),
(36,	'',	'month',	0,	'2019-11-21',	1,	'2019-11-20 23:15:01',	1,	NULL,	NULL),
(37,	'',	'voucher_type',	0,	'2019-11-21',	1,	'2019-11-20 23:15:43',	1,	NULL,	NULL),
(38,	'',	'reconciliation',	0,	'2019-11-21',	1,	'2019-11-20 23:17:28',	1,	NULL,	NULL),
(39,	'',	'expense_account',	0,	'2019-11-21',	1,	'2019-11-20 23:54:46',	1,	NULL,	NULL),
(40,	'',	'language',	0,	'2019-11-21',	1,	'2019-11-21 00:12:27',	1,	NULL,	NULL),
(41,	'',	'group_cluster',	0,	'2019-11-21',	1,	'2019-11-21 05:43:37',	1,	NULL,	NULL),
(42,	'',	'group_global',	0,	'2019-11-21',	1,	'2019-11-21 05:45:54',	1,	NULL,	NULL),
(43,	'',	'group_region',	0,	'2019-11-21',	1,	'2019-11-21 05:48:36',	1,	NULL,	NULL),
(44,	'',	'group_country',	0,	'2019-11-21',	1,	'2019-11-21 05:52:00',	1,	NULL,	NULL),
(45,	'',	'group_cohort',	0,	'2019-11-21',	1,	'2019-11-21 05:56:56',	1,	NULL,	NULL),
(46,	'',	'center_user',	0,	'2019-11-21',	1,	'2019-11-21 14:51:30',	1,	NULL,	NULL),
(47,	'',	'menu',	0,	'2019-11-21',	1,	'2019-11-21 15:40:57',	1,	NULL,	NULL),
(48,	'',	'department',	0,	'2019-11-21',	1,	'2019-11-21 16:09:50',	1,	NULL,	NULL),
(49,	'',	'department_user',	0,	'2019-11-21',	1,	'2019-11-21 16:14:04',	1,	NULL,	NULL),
(50,	'',	'group_cluster_user',	0,	'2019-11-21',	1,	'2019-11-21 16:31:45',	1,	NULL,	NULL),
(51,	'',	'designation',	0,	'2019-11-21',	1,	'2019-11-21 16:37:42',	1,	NULL,	NULL),
(52,	'',	'group_country_user',	0,	'2019-11-22',	1,	'2019-11-22 07:22:23',	1,	NULL,	NULL),
(53,	'',	'group_cohort_user',	0,	'2019-11-22',	1,	'2019-11-22 07:52:16',	1,	NULL,	NULL),
(54,	'',	'group_global_user',	0,	'2019-11-22',	1,	'2019-11-22 08:29:59',	1,	NULL,	NULL),
(55,	'',	'group_region_user',	0,	'2019-11-22',	1,	'2019-11-22 08:35:26',	1,	NULL,	NULL),
(56,	'',	'funding_status',	0,	'2019-11-22',	1,	'2019-11-22 22:07:30',	1,	NULL,	NULL),
(57,	'',	'page_view',	0,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(58,	'',	'page_view_detail',	0,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(59,	'',	'page_view_role',	0,	'2019-11-23',	1,	'2019-11-23 14:11:51',	1,	NULL,	NULL),
(60,	'',	'request_type',	0,	'2019-11-23',	1,	'2019-11-23 14:31:51',	1,	NULL,	NULL),
(61,	'',	'page_view_condition',	0,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL),
(62,	'',	'approval',	0,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL);

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

INSERT INTO `budget` (`budget_id`, `budget_track_number`, `budget_name`, `fk_center_id`, `fk_approval_id`, `fk_status_id`, `budget_year`, `budget_created_by`, `budget_created_date`, `budget_last_modified_by`, `budget_last_modified_date`) VALUES
(1,	'BUET-86205',	'Center 1 FY20',	9,	207,	23,	2019,	1,	'2019-11-12',	1,	NULL);

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
  `fk_group_cluster_id` int(5) NOT NULL,
  `center_created_by` int(100) NOT NULL,
  `center_created_date` date NOT NULL,
  `center_last_modified_date` date NOT NULL,
  `center_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`center_id`),
  UNIQUE KEY `center_code` (`center_code`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `center_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `center_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This table list all the remote sites for the organization';

INSERT INTO `center` (`center_id`, `center_track_number`, `center_name`, `center_code`, `center_start_date`, `center_end_date`, `center_is_active`, `fk_group_cluster_id`, `center_created_by`, `center_created_date`, `center_last_modified_date`, `center_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(9,	'CEER-77415',	'GRC Shingila',	'KE0347',	'2019-11-07',	'0000-00-00',	1,	1,	1,	'2019-11-07',	'0000-00-00',	1,	151,	45),
(10,	'CEER-86769',	'Mtondia CDC',	'KE0530',	'2010-02-18',	'0000-00-00',	1,	1,	1,	'2019-11-21',	'0000-00-00',	1,	254,	45),
(11,	'CEER-31976',	'Mnarani FPFK',	'KE0342',	'2003-10-16',	'0000-00-00',	1,	1,	1,	'2019-11-21',	'0000-00-00',	1,	255,	45),
(12,	'CEER-86974',	'Githunguri PCEA',	'KE0560',	'1988-11-08',	'0000-00-00',	1,	5,	1,	'2019-11-21',	'0000-00-00',	1,	275,	45);

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


DROP TABLE IF EXISTS `center_group_hierarchy`;
CREATE TABLE `center_group_hierarchy` (
  `center_group_hierarchy_id` int(100) NOT NULL AUTO_INCREMENT,
  `center_group_hierarchy_track_number` varchar(100) DEFAULT NULL,
  `center_group_hierarchy_name` varchar(100) DEFAULT NULL,
  `center_group_hierarchy_level` int(5) DEFAULT NULL,
  `center_group_hierarchy_created_date` date DEFAULT NULL,
  `center_group_hierarchy_last_modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `center_group_hierarchy_created_by` int(100) DEFAULT NULL,
  `center_group_hierarchy_last_modified_by` int(100) DEFAULT NULL,
  `center_group_hierarchy_deleted_at` date DEFAULT NULL,
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`center_group_hierarchy_id`),
  UNIQUE KEY `center_group_hierarchy_level` (`center_group_hierarchy_level`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `center_group_hierarchy` (`center_group_hierarchy_id`, `center_group_hierarchy_track_number`, `center_group_hierarchy_name`, `center_group_hierarchy_level`, `center_group_hierarchy_created_date`, `center_group_hierarchy_last_modified_date`, `center_group_hierarchy_created_by`, `center_group_hierarchy_last_modified_by`, `center_group_hierarchy_deleted_at`, `fk_approval_id`, `fk_status_id`) VALUES
(8,	'CEHY-27364',	'Cluster',	2,	'2019-11-21',	'2019-11-21 06:49:58',	1,	1,	NULL,	256,	59),
(9,	'CEHY-40087',	'Cohort',	3,	'2019-11-21',	'2019-11-21 06:50:26',	1,	1,	NULL,	257,	59),
(10,	'CEHY-76588',	'Country',	4,	'2019-11-21',	'2019-11-21 06:50:34',	1,	1,	NULL,	258,	59),
(11,	'CEHY-37430',	'Region',	5,	'2019-11-21',	'2019-11-21 06:50:43',	1,	1,	NULL,	259,	59),
(12,	'CEHY-72349',	'Global',	6,	'2019-11-21',	'2019-11-21 06:50:52',	1,	1,	NULL,	260,	59),
(13,	'CEHY-56809',	'Center',	1,	'2019-11-21',	'2019-11-21 16:39:07',	1,	1,	NULL,	265,	59);

DROP TABLE IF EXISTS `center_user`;
CREATE TABLE `center_user` (
  `center_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `center_user_track_number` varchar(100) NOT NULL,
  `center_user_name` varchar(100) NOT NULL,
  `fk_center_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `center_user_created_date` date NOT NULL,
  `center_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `center_user_created_by` int(100) NOT NULL,
  `center_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`center_user_id`),
  KEY `fk_center_id` (`fk_center_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `center_user_ibfk_1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`),
  CONSTRAINT `center_user_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `center_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `center_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `center_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `center_user` (`center_user_id`, `center_user_track_number`, `center_user_name`, `fk_center_id`, `fk_user_id`, `fk_designation_id`, `center_user_created_date`, `center_user_last_modified_date`, `center_user_created_by`, `center_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'CEER-77346',	'David Mbitsi 2',	9,	5,	1,	'2019-11-21',	'2019-11-21 14:52:09',	1,	1,	261,	71);

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


DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
(2,	'DENT-57933',	'Training Department',	'Training Department',	1,	'2019-11-21',	'2019-11-21 16:13:17',	1,	1,	263,	73);

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
(2,	'DEER-18515',	'Joyce Cherono',	4,	2,	'2019-11-21',	'2019-11-21 19:34:45',	1,	1,	273,	74);

DROP TABLE IF EXISTS `designation`;
CREATE TABLE `designation` (
  `designation_id` int(100) NOT NULL AUTO_INCREMENT,
  `designation_track_number` varchar(100) NOT NULL,
  `designation_name` varchar(100) NOT NULL,
  `fk_center_group_hierarchy_id` int(100) NOT NULL,
  `designation_created_date` date NOT NULL,
  `designation_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `designation_created_by` int(100) NOT NULL,
  `designation_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`designation_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_center_group_hierarchy_id` (`fk_center_group_hierarchy_id`),
  CONSTRAINT `designation_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `designation_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `designation_ibfk_3` FOREIGN KEY (`fk_center_group_hierarchy_id`) REFERENCES `center_group_hierarchy` (`center_group_hierarchy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `designation` (`designation_id`, `designation_track_number`, `designation_name`, `fk_center_group_hierarchy_id`, `designation_created_date`, `designation_last_modified_date`, `designation_created_by`, `designation_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'DEON-28178',	'Project Director',	13,	'2019-11-21',	'2019-11-21 16:40:33',	1,	1,	266,	76),
(2,	'DEON-61891',	'Health Worker',	13,	'2019-11-21',	'2019-11-21 16:40:44',	1,	1,	267,	76),
(3,	'DEON-85720',	'Project Accountant ',	13,	'2019-11-21',	'2019-11-21 16:40:59',	1,	1,	268,	76),
(4,	'DEON-32456',	'Partnership Facilitator',	8,	'2019-11-21',	'2019-11-21 16:41:23',	1,	1,	269,	76),
(5,	'DEON-63399',	'Manager of Partnership',	9,	'2019-11-21',	'2019-11-21 16:41:40',	1,	1,	270,	76),
(6,	'DEON-8049',	'Health Specialist',	10,	'2019-11-21',	'2019-11-21 16:41:58',	1,	1,	271,	76);

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
(1,	'FDR-74473',	'ECRAF',	'East Africa Consortium of Relief Financiers',	'2019-10-07',	'2019-10-07',	NULL,	NULL,	NULL,	296,	33),
(2,	'FDR-68477',	'SSDF',	'Social Security Granters',	'2019-10-07',	'2019-10-07',	NULL,	NULL,	NULL,	297,	33),
(3,	'FUER-85778',	'Third funder',	'This is a test funder',	'2019-11-21',	NULL,	1,	1,	NULL,	226,	33),
(7,	'FUER-23241',	'Test 1',	'Test 1',	'2019-11-22',	NULL,	1,	1,	NULL,	299,	33),
(10,	'FUER-20097',	'Test funder 2',	'Test funder 2',	'2019-11-22',	NULL,	1,	1,	NULL,	302,	33),
(11,	'FUER-11852',	'Funder 100',	'Funder 100',	'2019-11-23',	NULL,	1,	1,	NULL,	313,	33);

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
  `fk_approval_id` int(100) DEFAULT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`funding_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `funding_status` (`funding_status_id`, `funding_status_name`, `funding_status_is_active`, `funding_status_created_date`, `funding_status_created_by`, `funding_status_last_modified_by`, `funding_status_last_modified_date`, `funding_status_is_available`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'Fully Funded',	1,	NULL,	NULL,	NULL,	NULL,	1,	NULL,	NULL);

DROP TABLE IF EXISTS `group_cluster`;
CREATE TABLE `group_cluster` (
  `group_cluster_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_cluster_track_number` varchar(100) NOT NULL,
  `group_cluster_name` varchar(100) NOT NULL,
  `group_cluster_description` longtext NOT NULL,
  `fk_group_cohort_id` int(100) NOT NULL,
  `group_cluster_created_date` date NOT NULL,
  `group_cluster_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_cluster_created_by` int(100) NOT NULL,
  `group_cluster_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_cluster_id`),
  KEY `fk_group_cohort_id` (`fk_group_cohort_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `group_cluster_ibfk_1` FOREIGN KEY (`fk_group_cohort_id`) REFERENCES `group_cohort` (`group_cohort_id`),
  CONSTRAINT `group_cluster_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_cluster_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_cluster` (`group_cluster_id`, `group_cluster_track_number`, `group_cluster_name`, `group_cluster_description`, `fk_group_cohort_id`, `group_cluster_created_date`, `group_cluster_last_modified_date`, `group_cluster_created_by`, `group_cluster_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRER-49569',	'Malindi Cluster',	'Malindi Cluster',	1,	'2019-11-21',	'2019-11-21 05:59:33',	1,	1,	248,	66),
(2,	'GRER-45251',	'Mombasa Cluster',	'Mombasa Cluster',	1,	'2019-11-21',	'2019-11-21 05:59:53',	1,	1,	249,	66),
(3,	'GRER-68546',	'Kaloleni Cluster',	'Kaloleni Cluster',	1,	'2019-11-21',	'2019-11-21 06:00:07',	1,	1,	250,	66),
(4,	'GRER-77003',	'Kinango Cluster',	'Kinango Cluster',	1,	'2019-11-21',	'2019-11-21 06:00:20',	1,	1,	251,	66),
(5,	'GRER-63011',	'Kiambu Cluster',	'Kiambu Cluster',	2,	'2019-11-21',	'2019-11-21 06:00:46',	1,	1,	252,	66),
(6,	'GRER-68915',	'Nairobi West Cluster',	'Nairobi West Cluster',	2,	'2019-11-21',	'2019-11-21 06:01:02',	1,	1,	253,	66);

DROP TABLE IF EXISTS `group_cluster_user`;
CREATE TABLE `group_cluster_user` (
  `group_cluster_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_cluster_user_track_number` varchar(100) NOT NULL,
  `group_cluster_user_name` varchar(100) NOT NULL,
  `fk_group_cluster_id` int(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `group_cluster_user_created_date` date NOT NULL,
  `group_cluster_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_cluster_user_created_by` int(100) NOT NULL,
  `group_cluster_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_cluster_user_id`),
  KEY `fk_group_cluster_id` (`fk_group_cluster_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `group_cluster_user_ibfk_1` FOREIGN KEY (`fk_group_cluster_id`) REFERENCES `group_cluster` (`group_cluster_id`),
  CONSTRAINT `group_cluster_user_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `group_cluster_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_cluster_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `group_cluster_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_cluster_user` (`group_cluster_user_id`, `group_cluster_user_track_number`, `group_cluster_user_name`, `fk_group_cluster_id`, `fk_user_id`, `fk_designation_id`, `group_cluster_user_created_date`, `group_cluster_user_last_modified_date`, `group_cluster_user_created_by`, `group_cluster_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRER-78790',	'Joyce Cherono',	1,	4,	4,	'2019-11-21',	'2019-11-21 16:32:08',	1,	1,	264,	75);

DROP TABLE IF EXISTS `group_cohort`;
CREATE TABLE `group_cohort` (
  `group_cohort_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_cohort_track_number` varchar(100) NOT NULL,
  `group_cohort_name` varchar(100) NOT NULL,
  `group_cohort_description` longtext NOT NULL,
  `fk_group_country_id` int(100) NOT NULL,
  `group_cohort_created_date` date NOT NULL,
  `group_cohort_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_cohort_created_by` int(100) NOT NULL,
  `group_cohort_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_cohort_id`),
  KEY `fk_group_country_id` (`fk_group_country_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `group_cohort_ibfk_1` FOREIGN KEY (`fk_group_country_id`) REFERENCES `group_country` (`group_country_id`),
  CONSTRAINT `group_cohort_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_cohort_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_cohort` (`group_cohort_id`, `group_cohort_track_number`, `group_cohort_name`, `group_cohort_description`, `fk_group_country_id`, `group_cohort_created_date`, `group_cohort_last_modified_date`, `group_cohort_created_by`, `group_cohort_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRRT-50309',	'Coast and Lower East Cohort',	'Coast and Lower East Cohort',	1,	'2019-11-21',	'2019-11-21 05:57:27',	1,	1,	244,	70),
(2,	'GRRT-53777',	'Nairobi and Environs Cohort',	'Nairobi and Environs Cohort',	1,	'2019-11-21',	'2019-11-21 05:57:47',	1,	1,	245,	70),
(3,	'GRRT-36355',	'Western Cohort',	'Western Cohort',	1,	'2019-11-21',	'2019-11-21 05:58:04',	1,	1,	246,	70),
(4,	'GRRT-72222',	'North and Upper Rift Cohort',	'North and Upper Rift Cohort',	1,	'2019-11-21',	'2019-11-21 05:58:37',	1,	1,	247,	70),
(5,	'GRRT-81048',	'Northern Uganda',	'Northern Uganda cohort',	2,	'2019-11-22',	'2019-11-22 16:17:13',	1,	1,	286,	70),
(6,	'GRRT-4147',	'Eastern Uganda',	'Eastern Uganda Cohort',	2,	'2019-11-22',	'2019-11-22 16:18:01',	1,	1,	287,	70),
(7,	'GRRT-78219',	'Western Uganda',	'Western Uganda Cohort',	2,	'2019-11-22',	'2019-11-22 16:24:58',	1,	1,	288,	70),
(8,	'GRRT-6051',	'Southern Uganda',	'Southern Uganda Cohort',	2,	'2019-11-22',	'2019-11-22 17:28:20',	1,	1,	295,	70);

DROP TABLE IF EXISTS `group_cohort_user`;
CREATE TABLE `group_cohort_user` (
  `group_cohort_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_cohort_user_track_number` varchar(100) NOT NULL,
  `group_cohort_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_group_cohort_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `group_cohort_user_created_date` date NOT NULL,
  `group_cohort_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_cohort_user_created_by` int(100) NOT NULL,
  `group_cohort_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_cohort_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_cohort_id` (`fk_group_cohort_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `group_cohort_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `group_cohort_user_ibfk_2` FOREIGN KEY (`fk_group_cohort_id`) REFERENCES `group_cohort` (`group_cohort_id`),
  CONSTRAINT `group_cohort_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_cohort_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `group_cohort_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_cohort_user` (`group_cohort_user_id`, `group_cohort_user_track_number`, `group_cohort_user_name`, `fk_user_id`, `fk_group_cohort_id`, `fk_designation_id`, `group_cohort_user_created_date`, `group_cohort_user_last_modified_date`, `group_cohort_user_created_by`, `group_cohort_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(3,	'GRER-32416',	'John Koi - MoP',	8,	1,	5,	'2019-11-22',	'2019-11-22 09:31:50',	1,	1,	283,	78);

DROP TABLE IF EXISTS `group_country`;
CREATE TABLE `group_country` (
  `group_country_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_country_track_number` varchar(100) NOT NULL,
  `group_country_name` varchar(100) NOT NULL,
  `group_country_description` longtext NOT NULL,
  `fk_group_region_id` int(100) NOT NULL,
  `group_country_created_date` date NOT NULL,
  `group_country_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_country_created_by` int(100) NOT NULL,
  `group_country_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_country_id`),
  KEY `fk_group_region_id` (`fk_group_region_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `group_country_ibfk_1` FOREIGN KEY (`fk_group_region_id`) REFERENCES `group_region` (`group_region_id`),
  CONSTRAINT `group_country_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_country_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_country` (`group_country_id`, `group_country_track_number`, `group_country_name`, `group_country_description`, `fk_group_region_id`, `group_country_created_date`, `group_country_last_modified_date`, `group_country_created_by`, `group_country_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRRY-79828',	'Kenya',	'Kenya',	1,	'2019-11-21',	'2019-11-21 05:52:10',	1,	1,	232,	69),
(2,	'GRRY-81398',	'Uganda',	'Uganda',	1,	'2019-11-21',	'2019-11-21 05:52:27',	1,	1,	233,	69),
(3,	'GRRY-81047',	'Tanzania',	'Tanzania',	1,	'2019-11-21',	'2019-11-21 05:52:42',	1,	1,	234,	69),
(4,	'GRRY-48125',	'Ethiopia',	'Ethiopia',	1,	'2019-11-21',	'2019-11-21 05:52:56',	1,	1,	235,	69),
(5,	'GRRY-34238',	'Rwanda',	'Rwanda',	1,	'2019-11-21',	'2019-11-21 05:53:09',	1,	1,	236,	69),
(6,	'GRRY-60404',	'Togo',	'Togo',	1,	'2019-11-21',	'2019-11-21 05:53:23',	1,	1,	237,	69),
(7,	'GRRY-73002',	'Burkina Faso',	'Burkina Faso',	1,	'2019-11-21',	'2019-11-21 05:53:39',	1,	1,	238,	69),
(8,	'GRRY-3746',	'Ghana',	'Ghana',	1,	'2019-11-21',	'2019-11-21 05:53:53',	1,	1,	239,	69),
(9,	'GRRY-81680',	'Haiti',	'Haiti',	3,	'2019-11-21',	'2019-11-21 05:54:09',	1,	1,	240,	69),
(10,	'GRRY-76451',	'Ecuador',	'Ecuador',	3,	'2019-11-21',	'2019-11-21 05:54:22',	1,	1,	241,	69),
(11,	'GRRY-53630',	'Indonesia',	'Indonesia',	2,	'2019-11-21',	'2019-11-21 05:54:38',	1,	1,	242,	69),
(12,	'GRRY-52300',	'India',	'India',	2,	'2019-11-21',	'2019-11-21 05:54:49',	1,	1,	243,	69);

DROP TABLE IF EXISTS `group_country_user`;
CREATE TABLE `group_country_user` (
  `group_country_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_country_user_track_number` varchar(100) NOT NULL,
  `group_country_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_group_country_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `group_country_user_created_date` date NOT NULL,
  `group_country_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_country_user_created_by` int(100) NOT NULL,
  `group_country_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_country_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_country_id` (`fk_group_country_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `group_country_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `group_country_user_ibfk_2` FOREIGN KEY (`fk_group_country_id`) REFERENCES `group_country` (`group_country_id`),
  CONSTRAINT `group_country_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_country_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `group_country_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_country_user` (`group_country_user_id`, `group_country_user_track_number`, `group_country_user_name`, `fk_user_id`, `fk_group_country_id`, `fk_designation_id`, `group_country_user_created_date`, `group_country_user_last_modified_date`, `group_country_user_created_by`, `group_country_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(2,	'GRER-24985',	'Nicodemus Karisa',	1,	1,	6,	'2019-11-22',	'2019-11-22 08:39:57',	1,	1,	280,	77),
(3,	'GRER-3901',	'Nicodemus Karisa',	1,	2,	6,	'2019-11-22',	'2019-11-22 08:40:52',	1,	1,	281,	77);

DROP TABLE IF EXISTS `group_global`;
CREATE TABLE `group_global` (
  `group_global_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_global_track_number` varchar(100) NOT NULL,
  `group_global_name` varchar(100) NOT NULL,
  `group_global_description` longtext NOT NULL,
  `group_global_created_date` date NOT NULL,
  `group_global_created_by` int(100) NOT NULL,
  `group_global_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_global_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_global_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `group_global_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_global_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_global` (`group_global_id`, `group_global_track_number`, `group_global_name`, `group_global_description`, `group_global_created_date`, `group_global_created_by`, `group_global_last_modified_date`, `group_global_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRAL-33360',	'Global Program',	'This is the topmost center group',	'2019-11-21',	1,	'2019-11-21 05:46:23',	1,	228,	67);

DROP TABLE IF EXISTS `group_global_user`;
CREATE TABLE `group_global_user` (
  `group_global_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_global_user_track_number` varchar(100) NOT NULL,
  `group_global_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_group_global_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `group_global_user_created_date` date NOT NULL,
  `group_global_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_global_user_created_by` int(100) NOT NULL,
  `group_global_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_global_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_global_id` (`fk_group_global_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `group_global_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `group_global_user_ibfk_2` FOREIGN KEY (`fk_group_global_id`) REFERENCES `group_global` (`group_global_id`),
  CONSTRAINT `group_global_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_global_user_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `group_global_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_global_user` (`group_global_user_id`, `group_global_user_track_number`, `group_global_user_name`, `fk_user_id`, `fk_group_global_id`, `fk_designation_id`, `group_global_user_created_date`, `group_global_user_last_modified_date`, `group_global_user_created_by`, `group_global_user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRER-75747',	'Trizer',	11,	1,	6,	'2019-11-22',	'2019-11-22 08:44:08',	1,	1,	282,	79);

DROP TABLE IF EXISTS `group_region`;
CREATE TABLE `group_region` (
  `group_region_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_region_track_number` varchar(100) NOT NULL,
  `group_region_name` varchar(100) NOT NULL,
  `group_region_description` longtext NOT NULL,
  `fk_group_global_id` int(100) NOT NULL,
  `group_region_created_date` date NOT NULL,
  `group_region_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_region_created_by` int(100) NOT NULL,
  `group_region_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `fk_status_id` int(11) NOT NULL,
  PRIMARY KEY (`group_region_id`),
  KEY `fk_group_global_id` (`fk_group_global_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `group_region_ibfk_1` FOREIGN KEY (`fk_group_global_id`) REFERENCES `group_global` (`group_global_id`),
  CONSTRAINT `group_region_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_region_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_region` (`group_region_id`, `group_region_track_number`, `group_region_name`, `group_region_description`, `fk_group_global_id`, `group_region_created_date`, `group_region_last_modified_date`, `group_region_created_by`, `group_region_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'GRON-50422',	'Africa Region',	'This is africa region',	1,	'2019-11-21',	'2019-11-21 05:48:53',	1,	1,	229,	68),
(2,	'GRON-72481',	'Asia Region',	'This is Asia Region',	1,	'2019-11-21',	'2019-11-21 05:49:11',	1,	1,	230,	68),
(3,	'GRON-55637',	'Latin America',	'This is LAC region',	1,	'2019-11-21',	'2019-11-21 05:49:28',	1,	1,	231,	68);

DROP TABLE IF EXISTS `group_region_user`;
CREATE TABLE `group_region_user` (
  `group_region_user_id` int(100) NOT NULL AUTO_INCREMENT,
  `group_region_user_track_number` varchar(100) NOT NULL,
  `group_region_user_name` varchar(100) NOT NULL,
  `fk_user_id` int(100) NOT NULL,
  `fk_group_region_id` int(100) NOT NULL,
  `fk_designation_id` int(100) NOT NULL,
  `group_region_user_created_date` date NOT NULL,
  `group_region_user_last_modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group_region_user_created_by` int(100) NOT NULL,
  `group_region_user_last_modified_by` int(100) NOT NULL,
  `fk_approval_id` int(11) NOT NULL,
  `af_status_id` int(11) NOT NULL,
  `fk_status_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`group_region_user_id`),
  KEY `fk_user_id` (`fk_user_id`),
  KEY `fk_group_region_id` (`fk_group_region_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `af_status_id` (`af_status_id`),
  KEY `fk_designation_id` (`fk_designation_id`),
  CONSTRAINT `group_region_user_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `group_region_user_ibfk_2` FOREIGN KEY (`fk_group_region_id`) REFERENCES `group_region` (`group_region_id`),
  CONSTRAINT `group_region_user_ibfk_3` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`),
  CONSTRAINT `group_region_user_ibfk_4` FOREIGN KEY (`af_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `group_region_user_ibfk_5` FOREIGN KEY (`fk_designation_id`) REFERENCES `designation` (`designation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
(383,	'Center',	'Center',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
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
(457,	'Center_group_hierarchy',	'Center_group_hierarchy',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(470,	'Menu_user_order',	'Menu_user_order',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(478,	'Bank_branch',	'Bank_branch',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(479,	'Center_bank',	'Center_bank',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(480,	'Department',	'Department',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(481,	'Designation',	'Designation',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(482,	'Expense_account',	'Expense_account',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(483,	'Funding_status',	'Funding_status',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(485,	'Group_cluster',	'Group_cluster',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(486,	'Group_cohort',	'Group_cohort',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(487,	'Group_country',	'Group_country',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(488,	'Group_global',	'Group_global',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(489,	'Group_region',	'Group_region',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(490,	'Project',	'Project',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(491,	'Reconciliation',	'Reconciliation',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(492,	'Page_view',	'Page_view',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL),
(496,	'Request_type',	'Request_type',	1,	'2019-11-23',	'2019-11-23 17:30:57',	1,	1,	NULL,	NULL);

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
(625,	1,	383,	1,	4,	1,	NULL,	'2019-11-07 16:39:04',	NULL,	NULL,	NULL,	NULL),
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
(648,	4,	383,	1,	4,	1,	NULL,	'2019-11-08 09:22:08',	NULL,	NULL,	NULL,	NULL),
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
(671,	2,	383,	1,	4,	1,	NULL,	'2019-11-08 10:08:10',	NULL,	NULL,	NULL,	NULL),
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
(694,	5,	383,	1,	4,	1,	NULL,	'2019-11-08 12:40:36',	NULL,	NULL,	NULL,	NULL),
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
(779,	12,	383,	1,	4,	1,	NULL,	'2019-11-20 16:44:02',	NULL,	NULL,	NULL,	NULL),
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
(825,	1,	457,	1,	55,	0,	NULL,	'2019-11-21 06:49:28',	NULL,	NULL,	NULL,	NULL),
(846,	4,	457,	1,	44,	0,	NULL,	'2019-11-21 17:47:49',	NULL,	NULL,	NULL,	NULL),
(849,	9,	380,	1,	1,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(850,	9,	381,	1,	2,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(851,	9,	382,	1,	3,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(852,	9,	383,	1,	4,	1,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
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
(876,	9,	457,	1,	28,	0,	NULL,	'2019-11-21 17:50:01',	NULL,	NULL,	NULL,	NULL),
(896,	5,	457,	1,	44,	0,	NULL,	'2019-11-21 19:27:49',	NULL,	NULL,	NULL,	NULL),
(902,	1,	470,	1,	67,	0,	NULL,	'2019-11-21 19:39:33',	NULL,	NULL,	NULL,	NULL),
(903,	5,	470,	1,	67,	0,	NULL,	'2019-11-21 19:51:55',	NULL,	NULL,	NULL,	NULL),
(904,	4,	470,	1,	67,	0,	NULL,	'2019-11-21 22:28:49',	NULL,	NULL,	NULL,	NULL),
(905,	6,	380,	1,	1,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(906,	6,	381,	1,	2,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(907,	6,	382,	1,	3,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(908,	6,	383,	1,	4,	1,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
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
(932,	6,	457,	1,	28,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(938,	6,	470,	1,	34,	0,	NULL,	'2019-11-22 07:24:48',	NULL,	NULL,	NULL,	NULL),
(939,	8,	380,	1,	1,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(940,	8,	381,	1,	2,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(941,	8,	382,	1,	3,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(942,	8,	383,	1,	4,	1,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
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
(966,	8,	457,	1,	28,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(972,	8,	470,	1,	34,	0,	NULL,	'2019-11-22 07:25:42',	NULL,	NULL,	NULL,	NULL),
(980,	1,	478,	1,	39,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(981,	1,	479,	1,	40,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(982,	1,	480,	1,	41,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(983,	1,	481,	1,	42,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(984,	1,	482,	1,	43,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(985,	1,	483,	1,	44,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(987,	1,	485,	1,	46,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(988,	1,	486,	1,	47,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(989,	1,	487,	1,	48,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(990,	1,	488,	1,	49,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(991,	1,	489,	1,	50,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(992,	1,	490,	1,	51,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(993,	1,	491,	1,	52,	0,	NULL,	'2019-11-22 11:03:23',	NULL,	NULL,	NULL,	NULL),
(995,	5,	478,	1,	38,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(996,	5,	479,	1,	39,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(997,	5,	480,	1,	40,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(998,	5,	481,	1,	41,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(999,	5,	482,	1,	42,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1000,	5,	483,	1,	43,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1002,	5,	485,	1,	45,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1003,	5,	486,	1,	46,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1004,	5,	487,	1,	47,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1005,	5,	488,	1,	48,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1006,	5,	489,	1,	49,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1007,	5,	490,	1,	50,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1008,	5,	491,	1,	51,	0,	NULL,	'2019-11-22 11:05:22',	NULL,	NULL,	NULL,	NULL),
(1009,	1,	492,	1,	63,	0,	NULL,	'2019-11-23 08:19:43',	NULL,	NULL,	NULL,	NULL),
(1011,	5,	492,	1,	63,	0,	NULL,	'2019-11-23 10:58:06',	NULL,	NULL,	NULL,	NULL),
(1015,	1,	496,	1,	67,	0,	NULL,	'2019-11-23 14:31:44',	NULL,	NULL,	NULL,	NULL),
(1016,	5,	496,	1,	65,	0,	NULL,	'2019-11-23 16:23:17',	NULL,	NULL,	NULL,	NULL),
(1017,	4,	478,	1,	37,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1018,	4,	479,	1,	38,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1019,	4,	480,	1,	39,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1020,	4,	481,	1,	40,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1021,	4,	482,	1,	41,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1022,	4,	483,	1,	42,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1023,	4,	485,	1,	43,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1024,	4,	486,	1,	44,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1025,	4,	487,	1,	45,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1026,	4,	488,	1,	46,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1027,	4,	489,	1,	47,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1028,	4,	490,	1,	48,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1029,	4,	491,	1,	49,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1030,	4,	492,	1,	50,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL),
(1031,	4,	496,	1,	51,	0,	NULL,	'2019-11-23 16:35:38',	NULL,	NULL,	NULL,	NULL);

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
(17,	'PAEW-3009',	'Request declined by Head of Department',	'Request declined by Head of Department',	392,	0,	'2019-11-23',	'2019-11-23 15:49:09',	1,	1,	331,	82),
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
(1,	'PALE-58330',	'Page_view_role # PALE-58330',	1,	14,	3,	'2019-11-23',	'2019-11-23 14:18:13',	1,	1,	325,	84),
(2,	'PALE-17074',	'Page_view_role # PALE-17074',	0,	15,	3,	'2019-11-23',	'2019-11-23 15:59:55',	1,	1,	343,	84),
(3,	'PALE-70773',	'Page_view_role # PALE-70773',	1,	15,	1,	'2019-11-23',	'2019-11-23 16:00:34',	1,	1,	344,	84);

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
  `fk_approval_id` int(100) DEFAULT NULL,
  PRIMARY KEY (`reconciliation_id`),
  KEY `fk_reconciliation_center1_idx` (`fk_center_id`),
  CONSTRAINT `fk_reconciliation_center1` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `request`;
CREATE TABLE `request` (
  `request_id` int(100) NOT NULL AUTO_INCREMENT,
  `request_track_number` varchar(100) DEFAULT NULL,
  `request_name` varchar(100) DEFAULT NULL,
  `fk_request_type_id` int(11) DEFAULT '1',
  `fk_status_id` int(11) DEFAULT '0',
  `fk_center_id` int(100) DEFAULT NULL,
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
  KEY `fk_request_center2_idx` (`fk_center_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_department_id` (`fk_department_id`),
  KEY `fk_status_id` (`fk_status_id`),
  KEY `fk_requuest_type_id` (`fk_request_type_id`),
  CONSTRAINT `fk_request_center2` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `request_ibfk_3` FOREIGN KEY (`fk_department_id`) REFERENCES `department` (`department_id`),
  CONSTRAINT `request_ibfk_4` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `request_ibfk_5` FOREIGN KEY (`fk_request_type_id`) REFERENCES `request_type` (`request_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `request` (`request_id`, `request_track_number`, `request_name`, `fk_request_type_id`, `fk_status_id`, `fk_center_id`, `fk_approval_id`, `request_date`, `request_description`, `fk_department_id`, `request_created_date`, `request_created_by`, `request_last_modified_by`, `request_last_modified_date`, `request_deleted_at`) VALUES
(84,	'REQ-15134',	'Test Request',	1,	14,	9,	155,	'2019-11-07',	'Test Request',	1,	'2019-11-07',	'1',	'1',	'2019-11-21 17:03:17',	NULL),
(85,	'REST-84293',	'Another request',	1,	16,	10,	159,	'2019-11-07',	'Another request',	1,	'2019-11-07',	'1',	'1',	'2019-11-21 19:53:00',	NULL),
(86,	'REST-35895',	'Tested',	1,	14,	12,	204,	'2019-11-11',	'Tested',	1,	'2019-11-11',	'1',	'1',	'2019-11-21 22:31:54',	NULL),
(87,	'REST-14973',	'Test 10',	1,	14,	9,	289,	'2019-11-22',	'Test 10',	1,	'2019-11-22',	'1',	'1',	'2019-11-22 16:42:41',	NULL),
(88,	'REST-3905',	'Test 11',	1,	15,	9,	290,	'2019-11-22',	'Test 11',	2,	'2019-11-22',	'1',	'1',	'2019-11-23 16:33:28',	NULL),
(89,	'REST-70937',	'Test 12',	1,	14,	9,	291,	'2019-11-22',	'Test 12',	1,	'2019-11-22',	'5',	'1',	'2019-11-23 18:34:33',	NULL),
(90,	'REST-6965',	'Test 13',	1,	14,	9,	292,	'2019-11-22',	'Test 13',	2,	'2019-11-22',	'5',	'1',	'2019-11-23 18:34:33',	NULL),
(91,	'REST-20616',	'Test 15',	1,	15,	9,	293,	'2019-11-22',	'Test 15',	2,	'2019-11-22',	'1',	'1',	'2019-11-23 16:33:30',	NULL),
(92,	'REST-34835',	'Test request 99',	1,	14,	10,	294,	'2019-11-22',	'Test request 99',	1,	'2019-11-22',	'1',	'1',	'2019-11-23 13:08:54',	NULL),
(94,	'REST-39845',	'Test 35',	1,	14,	9,	304,	'2019-11-22',	'Test 35',	1,	'2019-11-22',	'1',	'1',	'2019-11-22 18:09:23',	NULL),
(95,	'REST-16817',	'Test 50',	1,	14,	9,	305,	'2019-11-22',	'Test 50',	1,	'2019-11-22',	'1',	'1',	'2019-11-22 18:12:54',	NULL),
(96,	'REST-35062',	'Test 50',	1,	15,	9,	306,	'2019-11-22',	'Test 50',	1,	'2019-11-22',	'1',	'1',	'2019-11-23 16:33:33',	NULL),
(97,	'REST-39510',	'Test 101',	1,	14,	10,	310,	'2019-11-23',	'Test 101',	1,	'2019-11-23',	'5',	'1',	'2019-11-23 18:40:37',	NULL),
(98,	'REST-4723',	'Request 600',	1,	15,	11,	317,	'2019-11-23',	'Request 600',	1,	'2019-11-23',	'1',	'1',	'2019-11-23 16:33:52',	NULL);

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
(104,	'RQD-67934',	84,	'Test ',	50,	1200.00,	60000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-07',	1,	1,	'2019-11-07 13:38:01'),
(105,	'REIL-9736',	85,	'Test 2',	100,	600.00,	6000.00,	2,	3,	1,	NULL,	0,	NULL,	'2019-11-07',	1,	1,	'2019-11-07 17:23:55'),
(106,	'REIL-63352',	85,	'Test 3',	150,	650.00,	97500.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-07',	1,	1,	'2019-11-07 17:23:55'),
(107,	'REIL-61548',	86,	'Tested',	115,	255.00,	29325.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-11',	1,	1,	'2019-11-11 07:54:25'),
(108,	'REIL-54534',	87,	'Test 10',	120,	500.00,	60000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 16:42:41'),
(109,	'REIL-55409',	87,	'Test 101',	150,	600.00,	90000.00,	2,	3,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 16:42:41'),
(110,	'REIL-81479',	88,	'Test 11',	45,	1200.00,	54000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 16:44:15'),
(111,	'REIL-22193',	89,	'Test 12',	450,	1000.00,	450000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 16:46:53'),
(112,	'REIL-7820',	90,	'Tst 131',	30,	2100.00,	63000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 16:47:44'),
(113,	'REIL-25685',	90,	'Test 131',	56,	5600.00,	313600.00,	2,	2,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 16:47:44'),
(114,	'REIL-44002',	91,	'Test 15',	45,	1200.00,	54000.00,	2,	4,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 17:24:28'),
(115,	'REIL-50224',	92,	'Request test',	10,	1600.00,	16000.00,	1,	4,	1,	NULL,	0,	NULL,	'2019-11-22',	1,	1,	'2019-11-22 17:26:09'),
(116,	'REIL-49871',	97,	'Test 101',	50,	20.00,	1000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-23',	1,	1,	'2019-11-23 09:59:00'),
(117,	'REIL-57757',	98,	'Request 600',	30,	500.00,	15000.00,	1,	2,	1,	NULL,	0,	NULL,	'2019-11-23',	1,	1,	'2019-11-23 10:18:15');

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
(3,	'ROLE-23190',	'Center Accountant',	'centeraccountant',	'A Center Accountant',	1,	1,	'2019-11-08',	'2019-11-08 11:38:04',	'1',	NULL,	175,	46),
(4,	'ROLE-9951',	'Admin',	'admin',	'This is a country admin',	1,	1,	'2019-11-20',	'2019-11-20 16:41:17',	'1',	NULL,	219,	46);

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
(25,	'ROON-40361',	'Accountant able to view menu items',	1,	3,	34,	349,	48,	'2019-11-23',	1,	'2019-11-23 18:12:31',	1);

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

INSERT INTO `status` (`status_id`, `status_track_number`, `status_name`, `status_action_label`, `fk_approve_item_id`, `status_approval_sequence`, `status_approval_direction`, `status_is_requiring_approver_action`, `fk_role_id`, `status_created_date`, `status_created_by`, `status_last_modified_date`, `status_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'',	'New',	'New',	1,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-15 18:28:22',	0,	NULL,	NULL),
(2,	'',	'Submitted',	'Submit',	1,	'2',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(3,	'',	'Approved By Head of Department',	'Approve',	1,	'3',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(4,	'',	'Declined By Head of Department',	'Decline',	1,	'3',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(5,	'',	'Approved By Finance Director',	'Approve',	1,	'4',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(6,	'',	'Declined By Finance Director',	'Decline',	1,	'4',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(7,	'',	'Paid By Accountant',	'Pay',	1,	'5',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(8,	'',	'Reinstate to Head of Department',	'Reinstate',	1,	'3',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(9,	'',	'Reinstate to Finance Director',	'Reinstate',	1,	'4',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(10,	'',	'Submitted',	'Submit',	2,	'1',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:05:19',	0,	NULL,	NULL),
(11,	'',	'Approved By Finance Director',	'Approve',	2,	'2',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(12,	'',	'Declined By Finance Director',	'Decline',	2,	'2',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(13,	'',	'Reinstated to Finance Director',	'Reinstate',	2,	'2',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(14,	'',	'New',	'',	3,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(15,	'',	'Submitted',	'Submit',	3,	'2',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(16,	'',	'Approved By Head of Department',	'Approve',	3,	'3',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(17,	'',	'Declined By Head of Department',	'Decline',	3,	'3',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-23 15:48:49',	0,	NULL,	NULL),
(18,	'',	'Approved By Finance Director',	'Approve',	3,	'4',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(19,	'',	'Declined By Finance Director',	'Decline',	3,	'4',	-1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(20,	'',	'Paid By Accountant',	'Pay',	3,	'5',	1,	1,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(21,	'',	'Reinstate to Head of Department',	'Reinstate',	3,	'3',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(22,	'',	'Reinstate to Finance Director',	'Reinstate',	3,	'4',	0,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(23,	'',	'New',	'',	4,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(30,	'',	'New',	'',	5,	'1',	1,	0,	1,	'0000-00-00',	0,	'2019-11-07 17:00:11',	0,	NULL,	NULL),
(33,	'',	'New',	'',	8,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(34,	'',	'New',	'',	9,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(38,	'',	'New',	'',	13,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(39,	'',	'New',	'',	14,	'1',	1,	0,	1,	'2019-10-22',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(43,	'',	'New',	'',	18,	'1',	1,	0,	1,	'2019-10-25',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(44,	'',	'New',	'',	19,	'1',	1,	0,	1,	'2019-11-03',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(45,	'',	'New',	'',	20,	'1',	1,	0,	1,	'2019-11-03',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(46,	'',	'New',	'',	21,	'1',	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(47,	'',	'New',	'',	22,	'1',	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(48,	'',	'New',	'',	23,	'1',	1,	0,	1,	'2019-11-04',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(49,	'',	'New',	'',	24,	'1',	1,	0,	1,	'2019-11-05',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(50,	'',	'New',	'',	25,	'1',	1,	0,	1,	'2019-11-06',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(51,	'',	'New',	'',	26,	'1',	1,	0,	1,	'2019-11-06',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(52,	'',	'New',	'',	27,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(53,	'',	'New',	'',	28,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(54,	'',	'New',	'',	29,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(55,	'',	'New',	'',	30,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(56,	'',	'New',	'',	31,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(57,	'',	'New',	'',	32,	'1',	1,	0,	1,	'2019-11-07',	1,	'2019-11-07 17:00:11',	1,	NULL,	NULL),
(58,	'',	'New',	'',	33,	'1',	1,	0,	2,	'2019-11-13',	1,	'2019-11-13 18:19:46',	1,	NULL,	NULL),
(59,	'',	'New',	'',	34,	'1',	1,	0,	2,	'2019-11-13',	1,	'2019-11-13 18:19:58',	1,	NULL,	NULL),
(60,	'',	'New',	'',	35,	'1',	1,	0,	2,	'2019-11-13',	1,	'2019-11-13 18:20:04',	1,	NULL,	NULL),
(61,	'',	'New',	'',	36,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:15:01',	1,	NULL,	NULL),
(62,	'',	'New',	'',	37,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:15:43',	1,	NULL,	NULL),
(63,	'',	'New',	'',	38,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:17:28',	1,	NULL,	NULL),
(64,	'',	'New',	'',	39,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-20 23:54:46',	1,	NULL,	NULL),
(65,	'',	'New',	'',	40,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 00:12:27',	1,	NULL,	NULL),
(66,	'',	'New',	'',	41,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:43:37',	1,	NULL,	NULL),
(67,	'',	'New',	'',	42,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:45:54',	1,	NULL,	NULL),
(68,	'',	'New',	'',	43,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:48:36',	1,	NULL,	NULL),
(69,	'',	'New',	'',	44,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:52:00',	1,	NULL,	NULL),
(70,	'',	'New',	'',	45,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 05:56:56',	1,	NULL,	NULL),
(71,	'',	'New',	'',	46,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 14:51:30',	1,	NULL,	NULL),
(72,	'',	'New',	'',	47,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 15:40:57',	1,	NULL,	NULL),
(73,	'',	'New',	'',	48,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:09:50',	1,	NULL,	NULL),
(74,	'',	'New',	'',	49,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:14:04',	1,	NULL,	NULL),
(75,	'',	'New',	'',	50,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:31:45',	1,	NULL,	NULL),
(76,	'',	'New',	'',	51,	'1',	1,	0,	2,	'2019-11-21',	1,	'2019-11-21 16:37:42',	1,	NULL,	NULL),
(77,	'',	'New',	'',	52,	'1',	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 07:22:23',	1,	NULL,	NULL),
(78,	'',	'New',	'',	53,	'1',	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 07:52:16',	1,	NULL,	NULL),
(79,	'',	'New',	'',	54,	'1',	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 08:29:59',	1,	NULL,	NULL),
(80,	'',	'New',	'',	55,	'1',	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 08:35:26',	1,	NULL,	NULL),
(81,	'',	'New',	'',	56,	'1',	1,	0,	2,	'2019-11-22',	1,	'2019-11-22 22:07:30',	1,	NULL,	NULL),
(82,	'',	'New',	'',	57,	'1',	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(83,	'',	'New',	'',	58,	'1',	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 08:19:50',	1,	NULL,	NULL),
(84,	'',	'New',	'',	59,	'1',	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 14:11:51',	1,	NULL,	NULL),
(85,	'',	'New',	'',	60,	'1',	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 14:31:51',	1,	NULL,	NULL),
(86,	'',	'New',	'',	61,	'1',	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL),
(87,	'',	'New',	'',	62,	'1',	1,	0,	2,	'2019-11-23',	1,	'2019-11-23 15:32:11',	1,	NULL,	NULL);

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
  `fk_center_group_hierarchy_id` int(100) NOT NULL,
  `user_is_center_group_manager` int(5) NOT NULL,
  `user_system_admin` int(5) NOT NULL DEFAULT '0',
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
  KEY `fk_center_group_hierarchy_id` (`fk_center_group_hierarchy_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`role_id`),
  CONSTRAINT `user_ibfk_3` FOREIGN KEY (`fk_language_id`) REFERENCES `language` (`language_id`),
  CONSTRAINT `user_ibfk_4` FOREIGN KEY (`fk_center_group_hierarchy_id`) REFERENCES `center_group_hierarchy` (`center_group_hierarchy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`user_id`, `user_track_number`, `user_name`, `shortname`, `user_firstname`, `user_lastname`, `user_email`, `fk_center_group_hierarchy_id`, `user_is_center_group_manager`, `user_system_admin`, `fk_language_id`, `user_is_active`, `fk_role_id`, `user_password`, `user_created_date`, `user_created_by`, `user_last_modified_date`, `user_last_modifed_by`, `user_last_modified_by`, `fk_approval_id`, `fk_status_id`) VALUES
(1,	'USR-84763',	'Nicodemus Karisa',	'',	'Nicodemus',	'Karisa',	'nkmwambs@gmail.com',	10,	0,	1,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'0000-00-00',	0,	'2019-11-07 07:54:59',	NULL,	0,	NULL,	NULL),
(2,	'USER-24279',	'Mwambire Karisa',	'',	'Mwambire',	'Karisa ',	'nkmwambs2@gmail.com',	8,	0,	0,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 07:21:31',	NULL,	1,	160,	54),
(4,	'USER-85054',	'Joyce Cherono',	'',	'Joyce',	'Cherono',	'jcherono@gmail.com',	8,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 07:55:20',	NULL,	1,	162,	54),
(5,	'USER-35106',	'David Mbitsi',	'',	'David',	'Mbitsi',	'davidm@gmail.com',	13,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 11:57:17',	NULL,	1,	176,	54),
(6,	'USER-8011',	'Betty Kanze',	'',	'Betty',	'Kanze',	'byeri@gmail.com',	8,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:14:22',	NULL,	1,	177,	54),
(7,	'USER-74028',	'Livingstone Onduso',	'',	'Livingstone',	'Onduso',	'onduso@gmail.com',	8,	0,	1,	1,	1,	2,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:16:01',	NULL,	1,	178,	54),
(8,	'USER-56932',	'John Koi',	'',	'John',	'Koi',	'jkoi@gmail.com',	9,	0,	0,	1,	1,	3,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:18:44',	NULL,	1,	179,	54),
(9,	'USER-42367',	'Mapenzi Amani',	'',	'Mapenzi',	'Amani',	'mapenzi@gmail.com',	8,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:23:24',	NULL,	1,	180,	54),
(10,	'USER-14904',	'Hellen Bahati',	'',	'Hellen',	'Bahati',	'hellen@gmail.com',	8,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:24:18',	NULL,	1,	181,	54),
(11,	'USER-45040',	'Trizer Bethuel',	'',	'Trizer',	'Bethuel',	'trizer@gmail.com',	12,	0,	0,	1,	1,	1,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-08',	1,	'2019-11-08 12:26:22',	NULL,	1,	182,	54),
(12,	'USER-19929',	'Admin Main',	'',	'Main',	'Admin',	'admin@gmail.com',	8,	0,	0,	1,	1,	4,	'fbdf9989ea636d6b339fd6b85f63e06e',	'2019-11-20',	1,	'2019-11-20 16:40:43',	NULL,	1,	218,	54);

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
  KEY `fk_voucher_center1_idx` (`fk_center_id`),
  KEY `fk_voucher_voucher_type1_idx` (`fk_voucher_type_id`),
  KEY `fk_approval_id` (`fk_approval_id`),
  KEY `fk_status_id` (`fk_status_id`),
  CONSTRAINT `fk_voucher_voucher_type1` FOREIGN KEY (`fk_voucher_type_id`) REFERENCES `voucher_type` (`voucher_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `voucher_ibfk_1` FOREIGN KEY (`fk_approval_id`) REFERENCES `approval` (`approval_id`) ON DELETE CASCADE,
  CONSTRAINT `voucher_ibfk_2` FOREIGN KEY (`fk_status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION,
  CONSTRAINT `voucher_ibfk_3` FOREIGN KEY (`fk_center_id`) REFERENCES `center` (`center_id`) ON DELETE CASCADE ON UPDATE CASCADE
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


-- 2019-11-23 20:09:14
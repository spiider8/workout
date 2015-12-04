-- Adminer 4.2.2fx MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `train_id` int(11) NOT NULL,
  `number` smallint(3) NOT NULL,
  `blockRest` smallint(3) NOT NULL,
  `unitBlockRest` char(10) NOT NULL,
  `blockSets` tinyint(3) NOT NULL DEFAULT '1',
  `repsOfBlock` tinyint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `train_id` (`train_id`),
  CONSTRAINT `blocks_ibfk_2` FOREIGN KEY (`train_id`) REFERENCES `trains` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `blocks`;
INSERT INTO `blocks` (`id`, `train_id`, `number`, `blockRest`, `unitBlockRest`, `blockSets`, `repsOfBlock`) VALUES
(4,	10,	1,	0,	'',	0,	1),
(5,	10,	2,	0,	'',	0,	1),
(6,	14,	1,	2,	'min',	1,	1),
(7,	15,	1,	2,	'0',	1,	1),
(8,	15,	2,	2,	'0',	1,	5),
(9,	15,	3,	0,	'0',	1,	0),
(11,	17,	1,	0,	'0',	1,	0),
(19,	22,	1,	5,	'min',	1,	1),
(20,	22,	2,	2,	'min',	1,	0),
(21,	22,	3,	2,	'min',	1,	0),
(22,	22,	4,	0,	'min',	1,	5),
(26,	24,	1,	1,	'min',	1,	5),
(27,	24,	2,	0,	'min',	1,	5),
(28,	25,	1,	0,	'min',	1,	10),
(29,	26,	1,	2,	'min',	1,	5),
(30,	26,	2,	2,	'min',	1,	5),
(31,	26,	3,	0,	'min',	1,	1),
(32,	27,	1,	0,	'min',	1,	1),
(33,	28,	1,	0,	'min',	1,	1);

CREATE TABLE `exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `exercises_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `exercises`;
INSERT INTO `exercises` (`id`, `name`, `description`, `user_id`) VALUES
(1,	'Dips',	'',	NULL),
(2,	'Pull ups',	'',	NULL),
(3,	'Push ups',	'',	NULL),
(4,	'Squats',	'',	NULL),
(5,	'Leg Raises',	'',	NULL),
(6,	'Mountain climber',	'',	NULL),
(7,	'Plank',	'',	NULL),
(8,	'Australian push ups',	'',	NULL),
(9,	'Pull ups - holding',	'Make normal pull ups and hold on the top. Then go little down and hold again and then go down absolutely and hold',	5);

CREATE TABLE `exercisesTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercises_id` int(11) NOT NULL,
  `types_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exercises_id` (`exercises_id`),
  KEY `types_id` (`types_id`),
  CONSTRAINT `exercisestypes_ibfk_1` FOREIGN KEY (`exercises_id`) REFERENCES `exercises` (`id`),
  CONSTRAINT `exercisestypes_ibfk_2` FOREIGN KEY (`types_id`) REFERENCES `exercisesTypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `exercisesTypes`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

TRUNCATE `news`;
INSERT INTO `news` (`id`, `title`, `content`, `created`) VALUES
(1,	'New web',	'We run new web. You can create your own training plan, show statistics by graphs, check your progress...etc',	'2015-11-05 00:59:01'),
(2,	'New routine',	'New routine was added by...you can show it here',	'2015-11-05 00:59:57'),
(3,	'New web',	'We run new web. You can create your own training plan, show statistics by graphs, check your progress...etc',	'2015-11-05 00:59:01'),
(4,	'New routine',	'New routine was added by...you can show it here',	'2015-11-05 00:59:57'),
(5,	'New web',	'We run new web. You can create your own training plan, show statistics by graphs, check your progress...etc',	'2015-11-05 00:59:01'),
(6,	'New routine',	'New routine was added by...you can show it here',	'2015-11-05 00:59:57'),
(7,	'New web',	'We run new web. You can create your own training plan, show statistics by graphs, check your progress...etc',	'2015-11-05 00:59:01'),
(8,	'New routine',	'New routine was added by...you can show it here',	'2015-11-05 00:59:57'),
(9,	'New web',	'We run new web. You can create your own training plan, show statistics by graphs, check your progress...etc',	'2015-11-05 00:59:01'),
(10,	'New routine',	'New routine was added by...you can show it here',	'2015-11-05 00:59:57'),
(11,	'New web',	'We run new web. You can create your own training plan, show statistics by graphs, check your progress...etc',	'2015-11-05 00:59:01'),
(12,	'New routine',	'New routine was added by...you can show it here',	'2015-11-05 00:59:57');

CREATE TABLE `routines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `routines`;
INSERT INTO `routines` (`id`, `title`, `dateCreated`) VALUES
(1,	'Full body',	'0000-00-00 00:00:00'),
(2,	'Pyramide',	'0000-00-00 00:00:00');

CREATE TABLE `trainitems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `block_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `sets` int(11) NOT NULL,
  `reps` int(11) NOT NULL,
  `rest` int(11) NOT NULL,
  `unitRest` char(5) NOT NULL,
  `ledderFrom` int(11) NOT NULL,
  `ledderTo` int(11) NOT NULL,
  `moreWeightValue` int(11) NOT NULL,
  `unitMoreWeight` char(5) NOT NULL,
  `hold` tinyint(3) NOT NULL,
  `unitHold` char(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `block_id` (`block_id`),
  KEY `exercise_id` (`exercise_id`),
  CONSTRAINT `trainitems_ibfk_1` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trainitems_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `trainitems`;
INSERT INTO `trainitems` (`id`, `block_id`, `exercise_id`, `sets`, `reps`, `rest`, `unitRest`, `ledderFrom`, `ledderTo`, `moreWeightValue`, `unitMoreWeight`, `hold`, `unitHold`) VALUES
(1,	4,	2,	0,	0,	0,	'0',	1,	10,	0,	'0',	0,	''),
(2,	4,	3,	10,	15,	1,	'0',	0,	0,	0,	'0',	0,	''),
(3,	5,	5,	5,	8,	1,	'0',	0,	0,	0,	'0',	0,	''),
(4,	6,	2,	5,	10,	0,	'0',	0,	0,	0,	'0',	0,	''),
(5,	6,	1,	5,	12,	0,	'0',	0,	0,	0,	'0',	0,	''),
(6,	6,	3,	5,	15,	0,	'0',	0,	0,	0,	'0',	0,	''),
(7,	6,	5,	5,	8,	0,	'0',	0,	0,	0,	'0',	0,	''),
(8,	7,	2,	6,	6,	1,	'0',	0,	0,	0,	'0',	0,	''),
(9,	8,	2,	5,	8,	0,	'0',	0,	0,	0,	'0',	0,	''),
(10,	8,	1,	5,	10,	0,	'0',	0,	0,	0,	'0',	0,	''),
(11,	8,	3,	5,	10,	0,	'0',	0,	0,	0,	'0',	0,	''),
(12,	9,	5,	5,	8,	1,	'0',	0,	0,	0,	'0',	0,	''),
(14,	11,	4,	5,	20,	0,	'0',	0,	0,	0,	'0',	0,	''),
(26,	19,	9,	0,	0,	0,	'min',	1,	5,	0,	'Kg',	10,	's'),
(27,	19,	9,	0,	0,	0,	'min',	5,	1,	0,	'Kg',	10,	's'),
(28,	20,	2,	0,	5,	0,	'min',	0,	0,	15,	'Kg',	0,	's'),
(29,	20,	1,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(30,	21,	2,	0,	5,	0,	'min',	0,	0,	20,	'Kg',	0,	's'),
(31,	21,	1,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(32,	22,	5,	0,	8,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(33,	22,	4,	0,	15,	0,	'min',	0,	0,	20,	'Kg',	0,	's'),
(37,	26,	8,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(38,	26,	2,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(39,	27,	1,	0,	15,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(40,	27,	7,	0,	0,	0,	'min',	0,	0,	0,	'Kg',	1,	'min'),
(41,	28,	7,	0,	0,	0,	'min',	0,	0,	0,	'Kg',	1,	'min'),
(42,	28,	5,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(43,	29,	2,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(44,	29,	3,	0,	20,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(45,	30,	1,	0,	15,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(46,	30,	2,	0,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(47,	31,	5,	5,	10,	0,	'min',	0,	0,	0,	'Kg',	0,	's'),
(48,	32,	2,	1,	0,	0,	'min',	1,	10,	0,	'Kg',	0,	's'),
(49,	33,	2,	1,	0,	0,	'min',	1,	10,	0,	'Kg',	0,	's'),
(50,	33,	2,	4,	5,	0,	'min',	0,	0,	0,	'Kg',	0,	's');

CREATE TABLE `trains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateTrain` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `trains_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `trains`;
INSERT INTO `trains` (`id`, `user_id`, `name`, `dateCreated`, `dateTrain`) VALUES
(10,	5,	'First train',	'2015-11-20 12:46:19',	'2015-11-20'),
(14,	5,	'Second train',	'2015-11-22 13:24:19',	'2015-11-22'),
(15,	5,	'Ring train',	'2015-11-22 13:33:38',	'2015-11-22'),
(17,	5,	'Test',	'2015-11-22 22:37:39',	'2015-11-22'),
(22,	5,	'',	'2015-11-26 22:24:30',	'2015-11-25'),
(24,	3,	'test',	'2015-11-28 20:01:59',	'2015-11-28'),
(25,	3,	'ABS',	'2015-11-29 17:54:21',	'2015-11-29'),
(26,	3,	'Home',	'2015-11-29 18:14:00',	'2015-11-29'),
(27,	3,	'Ledder',	'2015-11-29 18:44:15',	'2015-11-29'),
(28,	3,	'',	'2015-11-29 22:49:02',	'2015-11-29');

CREATE TABLE `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `types`;
INSERT INTO `types` (`id`, `name`) VALUES
(1,	'Ledder'),
(2,	'More weight');

CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `units`;
INSERT INTO `units` (`id`, `name`) VALUES
(1,	'kg'),
(2,	'lb'),
(3,	's'),
(4,	'min');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `password` char(60) NOT NULL,
  `created` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  `roles` varchar(20) NOT NULL,
  `fcbId` varchar(20) NOT NULL,
  `accessToken` text NOT NULL,
  `settings` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `email`, `password`, `created`, `lastLogin`, `roles`, `fcbId`, `accessToken`, `settings`) VALUES
(3,	'zbynda',	'$2y$10$xjDOELVQhKIQOEuKFW.PaOWhCyvY9kFmwhpcQ9r94XsBOLWoA7qpe',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'admin',	'',	'',	''),
(4,	'test@gmail.com',	'$2y$10$1uqNwiHq0HaXEi9rV76kheWa0atBmaPVSyZ0zVNwFlqRUayjcDlxO',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'',	'',	''),
(5,	'',	'',	'2015-11-06 13:46:01',	'0000-00-00 00:00:00',	'user',	'1661302457421428',	'CAAHpmu0mbNYBAIMamngivvDKxR5f0SCYWu9h9kvmvJzuH4TPmRo9fZAPeGu8QkUkMzHzcS58m2PBkCoTbQd312EocwhTBrGTuOaANor7sgXJEEonjMWK0og45ExbDcwPf4ZCmeTxDPV5qpavlFbu1HpwKUFzNnd6jHyEriOJcKMYLdJLO1YUxyaPmMlPYwi7Xx4z5R9QZDZD',	''),
(6,	'',	'',	'2015-11-22 19:12:37',	'0000-00-00 00:00:00',	'user',	'1020556024633832',	'CAAHpmu0mbNYBAEAt2ipqOIipfD4t7F2c4wDhodJAjL6dV0xV8YGR2SG4kUke9ZCoz0zy4r2YHUQdYWZAIJDJPlO7Bx2z9wfAgoHb7pq0BJko7FCnaLgNiSb3wwNZCn09XmEtE6Niw3x8NzJaZCnrVAQ77TyZCaqfjMGFDZCVcUETWlYjZCZAIBmhH4uryRM7ng4ZD',	'');

-- 2015-11-30 07:09:08

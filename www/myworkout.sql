-- Adminer 3.7.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+01:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `exercises`;
CREATE TABLE `exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `exercises` (`id`, `name`, `description`) VALUES
(1,	'Dips',	''),
(2,	'Pull ups',	''),
(3,	'Push ups',	''),
(4,	'Squats',	''),
(5,	'Leg Raises',	''),
(6,	'Mountain climber',	''),
(7,	'Plank',	'');

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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

DROP TABLE IF EXISTS `routines`;
CREATE TABLE `routines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `routines` (`id`, `title`, `dateCreated`) VALUES
(1,	'Full body',	'0000-00-00 00:00:00'),
(2,	'Pyramide',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `trains`;
CREATE TABLE `trains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `trains` (`id`, `name`, `dateCreated`) VALUES
(1,	'Train with Wilson',	'2015-11-05 01:00:23'),
(2,	'Monday train',	'2015-11-05 01:00:34'),
(3,	'ABS + Legs',	'2015-11-05 01:01:07');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `password` char(60) NOT NULL,
  `created` datetime NOT NULL,
  `lastLogin` datetime NOT NULL,
  `roles` varchar(20) NOT NULL,
  `fcbId` varchar(20) NOT NULL,
  `accessToken` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `email`, `password`, `created`, `lastLogin`, `roles`, `fcbId`, `accessToken`) VALUES
(3,	'zbynda',	'$2y$10$xjDOELVQhKIQOEuKFW.PaOWhCyvY9kFmwhpcQ9r94XsBOLWoA7qpe',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'admin',	'',	''),
(4,	'test@gmail.com',	'$2y$10$1uqNwiHq0HaXEi9rV76kheWa0atBmaPVSyZ0zVNwFlqRUayjcDlxO',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	'',	'',	''),
(5,	'',	'',	'2015-11-06 13:46:01',	'0000-00-00 00:00:00',	'user',	'1661302457421428',	'CAAHpmu0mbNYBAHHDgDAcqFA5CnV9wAfonO0FpVLfo728IPo8GJM9xZCamx2qn0TtTfZCKrnBcn0txZAOk9GrdiQ3nprjW3ilWK90aL8Wk2Q9wG5kZAgzLgewdjOtDBw2ZBJLusmcf1VQSKM8iWp6hTpg7REHq3ivJ8ecYBHxH6bColtZCakZBZBR3495dye3OOZBnyxKZCM9ZA4NwZDZD');

-- 2015-11-13 08:18:40

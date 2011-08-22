-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2011 at 07:02 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vacanttaxi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `last_visit` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `type`, `status`, `category`, `online`, `last_visit`) VALUES
(1, 'ardak', 'ardak@inbox.ru', '123', 1113, 0, 0, 1, '2010-07-21'),
(2, 'salta', 'tasalta@gmail.com', '123', 1112, 0, 0, 0, '2011-07-27'),
(4, 'karina', 'k@mail.com', '123', 1111, 0, 0, 0, '0000-00-00'),
(7, 'kairat', 'kairat@mail.com', '123', 1110, 0, 0, 0, '2011-08-02'),
(9, 'Dovezu', 'doveza@gmail.com', 'kara', 1111, 0, 0, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `admins_profile`
--

CREATE TABLE IF NOT EXISTS `admins_profile` (
  `id` int(11) NOT NULL,
  `fist_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins_profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `car_no` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('6111','6112','6113') COLLATE utf8_unicode_ci NOT NULL DEFAULT '6111' COMMENT 'легковая, грузовая, автобус ...',
  `model` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'car.png',
  PRIMARY KEY (`id`),
  KEY `driver_id` (`driver_id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `car`
--


-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Almaty'),
(2, 'Astana'),
(7, 'Kostanay'),
(8, 'Kyzylorda'),
(9, 'Atyrau'),
(10, 'Aktobe'),
(11, 'Kokshetau'),
(12, 'Taraz'),
(13, 'Karaganda'),
(14, 'Semey'),
(15, 'Aktau'),
(16, 'Shymkent'),
(17, 'Turkistan'),
(18, 'Zhezkazgan'),
(19, 'Ust-Kamenogorsk'),
(20, 'Petropavlovsk'),
(21, 'Pavlodar'),
(22, 'Taldykorgan'),
(23, 'Temirtau'),
(24, 'Uralsk'),
(25, 'Baikonur'),
(26, 'Ekibastuz'),
(27, 'Ayagoz'),
(28, 'Stepnogorsk'),
(29, 'Talgar'),
(30, 'Esik'),
(31, 'Kaskelen'),
(32, 'Kentau'),
(33, 'Satbaev'),
(34, 'Usharal');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('11962d26b3fe3b7dd0f621c767258f7a', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.24 (', 1313964709, 'a:2:{s:4:"city";s:6:"Almaty";s:7:"city_id";s:1:"1";}'),
('8aa4e2eb8e4a5488ff66141edf8b8553', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.24 (', 1313989016, 'a:2:{s:4:"city";s:6:"Almaty";s:7:"city_id";s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=176 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `driver_max` int(5) NOT NULL DEFAULT '50',
  `disp_max` int(5) NOT NULL DEFAULT '5',
  `city` int(4) DEFAULT NULL,
  `contacts` text COLLATE utf8_unicode_ci,
  `about` text COLLATE utf8_unicode_ci,
  `logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'company.png',
  `site` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city` (`city`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `company_name`, `driver_max`, `disp_max`, `city`, `contacts`, `about`, `logo`, `site`) VALUES
(1, 4, 'Алматы Такси', 50, 5, 1, 'Адрес:\nРК, г. Алматы, мкрн. "Сайран" 17\nТелефоны:\nВызов такси: +7 (727) 2 555 - 333\nПриемная: +7 (727) 2 258 855\nФакс: +7 (727) 2 250 111\n\nE-mail: info@almatytaxi.kz ', 'Сегодня, ТОО «Алматы-Такси» самый крупный таксомоторный парк не только в Казахстане, но и во всей Центральной Азии, являющийся лидером среди транспортных компаний по перевозкам пассажиров и багажа!', 'http://localhost/VacanTaxi/style/uploads/company_logos/comics_08.jpg', 'http://almatytaxi.kz/'),
(2, NULL, 'Экспресс Такси', 50, 0, 1, 'Адрес: г. Алматы, Мкр. "Мамыр 4 " д.100а оф 203\r\n\r\nТел: 8-727-2-600-600;\r\n\r\nФакс: 8-727-2-26-27-28;\r\n\r\nМоб.тел.: 8-700-2-600-600; 8-701-9-600-600;\r\n\r\ne-mail: 2600600@mail.ru', 'ТОО "Экспресс такси" основано 24 мая 2001года и динамично развивается. Благодаря разумной ценовой политике, постоянной работе по улучшению качества обслуживания, мы каждый день приобретаем новых клиентов.', 'company.png', 'http://www.express-taxi.kz/'),
(3, NULL, 'Aport taxi', 50, 0, 1, 'Диспетчерская служба: +7 727 3 999 400 -многоканальный телефон,+7 777 7 999 400, +7 701 767 67 08\r\nОфис :+7 727 292 21 70, +7 727 293 06 97\r\nФакс: +7 727 292 67 74 \r\nАдрес: Алматы, 050012, ул. Масанчи, 57А,\r\nE-mail: info@aporttaxi.kz', '@port Taxi - это новая сервисная компания, осуществляющая пассажирские автоперевозки по г. Алматы, Казахстану и ближнему зарубежью.\r\n@port Taxi - это гарантированное оказание качественных услуг в сфере автоперевозок  (такси, доставка почты, развозка сотрудников, встреча в аэропорту и т.д.).', 'company.png', 'http://www.aporttaxi.kz/'),
(5, 9, 'Dovezu', 13, 2, 1, '87000323', 'Super compen', 'http://localhost/VacanTaxi/style/uploads/company_logos/japanesemacaque.jpg', 'http://dovezu.kz');

-- --------------------------------------------------------

--
-- Table structure for table `company_dispatcher`
--

CREATE TABLE IF NOT EXISTS `company_dispatcher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mode` int(11) DEFAULT NULL COMMENT 'режим работы',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company_dispatcher`
--

INSERT INTO `company_dispatcher` (`id`, `name`, `user_id`, `company_id`, `phone`, `mode`) VALUES
(1, 'kairat', 7, 1, '87015527794', 3111);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `c_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('4111','4112','4113') COLLATE utf8_unicode_ci NOT NULL DEFAULT '4111' COMMENT 'заправка, свободен, занят',
  `smoke` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'курящий',
  `city` int(4) DEFAULT NULL,
  `category` enum('5001','5010','5011','5100','5101','5110','5111','5000') COLLATE utf8_unicode_ci DEFAULT '5000' COMMENT 'городские, междугородние, выход из города, все',
  `experience` tinyint(3) NOT NULL DEFAULT '0',
  `schedule` enum('1','2','3') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT 'availability(ones, rare, always)',
  `h_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `about` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `user_id`, `c_name`, `status`, `smoke`, `city`, `category`, `experience`, `schedule`, `h_phone`, `m_phone`, `address`, `about`) VALUES
(3, 3, 'Жанат', '4111', 0, 2, '5100', 0, '1', NULL, NULL, NULL, ''),
(2, 2, 'Санат', '4111', 1, 1, '5100', 3, '1', '727272', '8701000001', 'с Орбиты', 'Заберу до работы в Капчагае'),
(5, 7, 'Жанибек', '4111', 0, 1, '5100', 0, '2', '87004266736', '870023000', 'Левый берег', 'Работаю целый день, с пяти утра до восьми вечера'),
(7, 4, '', '4111', 0, 2, '5100', 0, '', NULL, NULL, NULL, ''),
(11, 14, 'Noel', '4111', 0, 1, '5110', 5, '2', '87004266736', '870023000', 'Kaskelen', 'Заберу до работы, в городе'),
(12, 15, 'Johny', '4111', 0, 1, '5110', 10, '2', '87004266736', '870023000', 'Сайран', 'До талдыкоргана'),
(13, 19, '', '4111', 0, 1, '5100', 1, '2', '3762047', '87015527795', 'koktem-2-2-83', ''),
(15, 31, 'akk', '4111', 0, 1, '5100', 3, '2', '87004266736', '870023000', 'Kaskelen', 'Заберу до работы, в городе'),
(16, NULL, '', '4111', 0, 1, '5110', 3, '2', '87004266736', '870023000', 'Kaskelen', 'Заберу до работы, в городе'),
(19, 22, '', '4111', 0, 15, '5100', 0, '1', '', '', '', ''),
(20, 26, '', '4111', 0, NULL, '5000', 0, '1', NULL, NULL, NULL, ''),
(21, 32, '', '4111', 0, NULL, '5000', 0, '1', NULL, NULL, NULL, ''),
(22, 36, '', '4111', 0, 1, '5110', 3, '2', '3245063', '870023000', 'Парк первого президента, Парк Горького', 'Подвезу до Вокзала за 2000');

-- --------------------------------------------------------

--
-- Table structure for table `driver_msg`
--

CREATE TABLE IF NOT EXISTS `driver_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`driver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `driver_msg`
--


-- --------------------------------------------------------

--
-- Table structure for table `driver_to_company`
--

CREATE TABLE IF NOT EXISTS `driver_to_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`driver_id`,`company_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `driver_to_company`
--

INSERT INTO `driver_to_company` (`id`, `driver_id`, `company_id`) VALUES
(1, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `from`, `to`, `date`, `name`, `text`) VALUES
(1, '1', '1', '2011-07-10 16:26:07', 'kamila', 'privet'),
(27, '1', '1', '2011-07-11 13:51:44', 'f', 'faa'),
(26, '1', '1', '2011-07-11 13:51:03', 'kamila', 'fe'),
(25, '1', '1', '2011-07-11 13:49:50', 'f', 'faa'),
(24, '1', '1', '2011-07-11 13:49:05', 'kamila', 'ha'),
(23, '1', '1', '2011-07-11 12:51:07', 'f', 'f'),
(22, '1', '4', '2011-07-11 12:51:02', 'f', 'f'),
(21, '1', '1', '2011-07-11 12:50:49', 'kjlklja', 'akla'),
(20, '1', '1', '2011-07-11 12:50:39', 'kjlklja', 'akla');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contacts` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `when` date NOT NULL,
  `time` time NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `surname`, `name`, `contacts`, `from`, `to`, `when`, `time`, `orderDate`) VALUES
(1, 'surname', 'name', 'contacts', 'otkuda', 'kuda', '0000-00-00', '00:00:00', '2011-06-02 11:40:02'),
(2, 'surname', 'name', 'contacts', 'otkuda', 'kuda', '0000-00-00', '00:00:00', '2011-06-02 11:40:51'),
(3, 'surname', 'name', 'contacts', 'otkuda', 'kuda', '0000-00-00', '00:00:00', '2011-06-02 11:42:42'),
(4, 'Zhienbayev', 'Meiran', '87012222737', 'tastak', 'orbita', '0002-06-11', '21:15:00', '2011-06-02 11:45:31'),
(5, 'Tursyngaliyev', 'Iliyas', '87012324444', 'tolebi 147', 'Alfarabi Lenina', '2011-06-02', '13:00:00', '2011-06-02 11:51:16'),
(6, 'Abdykarim', 'Madina', '87014556575', 'tastak', 'Mega', '2011-06-05', '20:00:00', '2011-06-02 11:53:16'),
(7, 'Tolebi', 'Gulnur', '87021628982', 'Aksai', 'Orbita', '2011-06-07', '14:00:00', '2011-06-03 09:53:15'),
(8, 'Tolegenova', 'Altynkul', '87013454545', 'Taldybulak', 'Abaya Pravda', '2011-06-08', '18:15:00', '2011-06-03 09:55:18'),
(9, 'Tasybayeva', 'Gaini', '87004043548', 'Ainabulak', 'Zhanaturmys', '2011-06-09', '08:00:00', '2011-06-07 04:48:36'),
(10, 'Shalkar', 'Ardak', '87009999999', 'tastak', 'orbita', '0011-06-25', '14:00:00', '2011-06-13 16:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `driver_id` int(11) NOT NULL,
  `lat` double NOT NULL DEFAULT '0',
  `lon` double NOT NULL DEFAULT '0',
  UNIQUE KEY `user_id` (`driver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`driver_id`, `lat`, `lon`) VALUES
(0, 43.243265, 76.907301),
(1, 43.243265, 76.907301),
(2, 43.253365, 76.918301);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `driver_id` int(4) NOT NULL,
  `rating` int(10) unsigned NOT NULL DEFAULT '0',
  `total_rating` int(10) unsigned NOT NULL DEFAULT '0',
  `total_ratings` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `driver_id` (`driver_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`driver_id`, `rating`, `total_rating`, `total_ratings`) VALUES
(1, 5, 5, 1),
(2, 0, 0, 0),
(3, 0, 0, 0),
(4, 4, 4, 1),
(5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clientinfo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('1111','1112','1113') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1111' COMMENT 'новое,выполнено, принят, ',
  `company_id` int(11) DEFAULT NULL,
  `message` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reservation`
--


-- --------------------------------------------------------

--
-- Table structure for table `unofficial_order`
--

CREATE TABLE IF NOT EXISTS `unofficial_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `message` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contacts` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `to` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `accomplished` int(11) NOT NULL,
  `access_token` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `unofficial_order`
--

INSERT INTO `unofficial_order` (`id`, `name`, `message`, `contacts`, `date`, `from`, `to`, `user_id`, `type`, `accomplished`, `access_token`) VALUES
(65, 'Marram Marram', '2000 через пять минут', '87009999999', '2011-08-21 23:23:20', 'Вокзал-1', 'Барахолка', 38, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `displayname` varchar(120) COLLATE utf8_bin NOT NULL,
  `identity` varchar(120) COLLATE utf8_bin NOT NULL,
  `provider` varchar(120) COLLATE utf8_bin NOT NULL,
  `type` varchar(120) COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=39 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`, `displayname`, `identity`, `provider`, `type`, `status`) VALUES
(36, 'ardakshalkar', '$2a$08$K/3wFNG3KM6wLn4.F0NbsuxrbEDxSVMFDygy4VBzper13E7nTm.3y', 'ardak.shalkar@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2011-08-10 12:38:47', '2011-08-10 12:23:22', '2011-08-10 16:38:47', 'Ardak Shalkarbayuly', '', '', '', 1),
(37, '', '', 'alhalal.kz@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '0000-00-00 00:00:00', '2011-08-17 23:59:00', '2011-08-18 03:59:00', 'Alhalal Kz', 'http://www.facebook.com/profile.php?id=1280830524', 'http://www.facebook.com/', '', 0),
(38, 'marram', '$2a$08$aYezZzfUTNeTp7k54YKdW.ROzLpyZw0MXBZj38LjQcsIR2A9QDfpO', 'marram@gmail.com', 1, 0, NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '2011-08-21 13:14:02', '2011-08-21 12:46:32', '2011-08-21 17:14:02', 'Marram Marram', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--


-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dob` date NOT NULL,
  `photo` varchar(200) COLLATE utf8_bin NOT NULL,
  `status` varchar(160) COLLATE utf8_bin NOT NULL,
  `contacts` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=40 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`, `dob`, `photo`, `status`, `contacts`) VALUES
(34, 33, NULL, NULL, '1986-03-20', 'http://vkontakte.ru/images/question_c.gif', '', ''),
(35, 34, NULL, NULL, '0000-00-00', '', '', ''),
(36, 35, NULL, NULL, '0000-00-00', '', '', ''),
(37, 36, NULL, NULL, '0000-00-00', '', '', ''),
(38, 37, NULL, NULL, '0000-00-00', 'https://graph.facebook.com/1280830524/picture', '', ''),
(39, 38, NULL, NULL, '0000-00-00', '', '', '');

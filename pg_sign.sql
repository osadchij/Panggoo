-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 27 2015 г., 03:14
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `pg_sign`
--

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` text,
  `token` varchar(40) DEFAULT NULL,
  `reg_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `account`
--

INSERT INTO `account` (`Id`, `username`, `password`, `email`, `token`, `reg_date`) VALUES
(1, 'first', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'first@first.com', '9197ee4bc1e5eace3b3469bff4ea32de30c581be', '2015-08-18 00:00:00'),
(2, 'first2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mail@mail.ru', 'a8eab3b6d15710887f6aaacd94408afd25c60d98', '2015-08-18 00:00:00'),
(3, '555', 'fc7a734dba518f032608dfeb04f4eeb79f025aa7', '', '9a98b47cbc94cb7b1de415236ccee406cb61ce69', '2015-08-21 00:00:00'),
(4, 'hjjj', 'c8c92f464126edf9e49f874d027c53fc2905dc0e', '', '49cefa7851a5f6406bca6b7ffb2c7ee883727147', '2015-08-21 00:00:00'),
(5, 'ghjhj', '0344045c02ee3c446fa982e0451aa7bf5b615a7c', '', 'dc8f08a0aaf751b76119b932ef623201c553567a', '2015-08-21 00:00:00'),
(6, '345345345345', 'be8fe541144dfe858ea1f4301657870bda63f169', '', '2eb6b26950975d140d5727fea169d340839434de', '2015-08-21 00:00:00'),
(7, 'osadcgijjj', '495096cb58190d3d18ca0b498c38eeaf785c79c9', 'swcalc@gmail.com', 'ddc9e782a947567fa529a7525c7c7dac8cd2f5c6', '2015-08-21 00:00:00'),
(8, 'osadchijjj', '6fa354a20b994c92eacdaaa4fe3b54dc51395925', 'swcalc@gmail.com', '85a6e4c5611b4241abc66d9194c962c189702243', '2015-08-21 00:00:00'),
(9, 'swcalc12', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'osadchijjj@mail.ru', 'c83285ca54a43cb438ac0a93ebeff45f241ead26', '2015-08-21 00:00:00'),
(10, 'createdaccount', '6894cffbf678b56423f37ef778059061c415f017', 'vadim.osadchij@gmail.com', '286336f1ebf27a98a85a9baea564b19758ef4526', '2015-08-22 06:37:51'),
(11, 'qwert', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'qwert@mail.ru', 'b6a44b15bad3e387079f9a44aff1776086c0a4b8', '2015-08-22 20:52:00'),
(12, 'qwert1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'qwert1@mail.ru', 'e83965d895f8ce23054f37e34d99dc97608e2fc2', '2015-08-22 21:06:20'),
(13, '12312sw', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'qweqwe@dsf.com', '51f5948ebce37b391d902f0a7a3a2bb4c5283634', '2015-08-22 21:16:35'),
(14, 'sdfsdfsf', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123@123.ru', 'a69c2ed5e971a88e2ac35b1c972471bf6822ec66', '2015-08-22 21:20:17'),
(15, 'sdfsdfsf1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1231@123.ru', '234b8a225e086d14171e9309fd0b47cf5383cdac', '2015-08-22 21:20:38'),
(16, 'sdfsdfsf15', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '12317@123.ru', '10733e2f1475d0a74efa18e938edc7965ce98a7e', '2015-08-22 21:24:52'),
(17, '123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '00457e8de5d6d2b2440b3102c02463ea05543b38', '2015-08-22 22:40:17'),
(18, 'createdaccount1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mail@mail.ru1', 'f5b8668dd60db73a1ef67208ab2f0d95e9f520b0', '2015-08-24 10:05:14'),
(19, 'createdaccount12', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'mail@mail.ru12', '23b15d038d0439888e8bb37b2909ec7603a51191', '2015-08-24 10:10:26'),
(20, 'createdaccount2222', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'createdaccount2222@mail.ru', '82224831ead378909a821f3e25edf5ec9ae64c76', '2015-08-24 10:10:39'),
(21, 'createdaccount7777777', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'createdaccount@asd.ru', '64e683a9ad8eca5710a8f71fcd889e9aeb95b9f0', '2015-08-24 10:14:38'),
(22, 'createdaccount23234234234', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'createdaccount23234234234@mail.ru', 'dd626c7314a37c9e6e6e0869dfa089823bdb6fa8', '2015-08-24 10:16:28');

-- --------------------------------------------------------

--
-- Структура таблицы `recovery`
--

CREATE TABLE IF NOT EXISTS `recovery` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) DEFAULT '0',
  `token` varchar(40) DEFAULT NULL,
  `date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `recovery`
--

INSERT INTO `recovery` (`Id`, `owner`, `token`, `date`) VALUES
(1, 7, '531191bc4aef592287cc4fbc81e725cf04baf57e', '2015-08-24 23:10:51');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

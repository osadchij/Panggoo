-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 24 2015 г., 14:01
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `pg_advert`
--

-- --------------------------------------------------------

--
-- Структура таблицы `advert`
--

CREATE TABLE IF NOT EXISTS `advert` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) DEFAULT '0',
  `url` text,
  `title` varchar(35) DEFAULT NULL,
  `picture` text,
  `unacceptable` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `advert`
--

INSERT INTO `advert` (`Id`, `owner`, `url`, `title`, `picture`, `unacceptable`) VALUES
(1, 22, 'http://panggoo.com/php/sitemap.php', 'rthrth', 'http://jsfiddle.net/img/logo.png', NULL),
(2, 22, 'url://url/url.html', 'Titlteeeeee', 'http://jsfiddle.net/img/logo.png', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

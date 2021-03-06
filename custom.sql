-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-06-12 12:35:43
-- 服务器版本： 5.7.28
-- PHP 版本： 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `custom`
--

-- --------------------------------------------------------

--
-- 表的结构 `options`
--

CREATE TABLE `options` (
  `name` varchar(32) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `options`
--

INSERT INTO `options` (`name`, `value`) VALUES
('plugins', 'a:1:{s:10:\"HelloWorld\";a:3:{s:10:\"class_name\";s:33:\"Content\\Plugins\\HelloWorld\\Plugin\";s:6:\"config\";a:1:{s:5:\"value\";s:12:\"Hello World!\";}s:7:\"handles\";a:2:{s:22:\"admin/header.php:brief\";a:1:{i:0;s:41:\"Content\\Plugins\\HelloWorld\\Plugin::render\";}s:14:\"index.php:main\";a:1:{i:0;s:39:\"Content\\Plugins\\HelloWorld\\Plugin::main\";}}}}'),
('routingTable', 'a:2:{i:0;a:3:{s:4:\"regx\";s:9:\"/^[\\/]?$/\";s:6:\"widget\";s:20:\"\\Custom\\Widget\\Index\";s:6:\"action\";s:6:\"render\";}i:1;a:3:{s:4:\"regx\";s:35:\"/^\\/action\\/([_0-9a-zA-Z-]+)[\\/]?$/\";s:6:\"widget\";s:21:\"\\Custom\\Widget\\Action\";s:6:\"params\";a:1:{i:0;s:6:\"action\";}}}'),
('theme', 'default');

--
-- 转储表的索引
--

--
-- 表的索引 `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

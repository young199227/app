-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-04-21 09:33:02
-- 伺服器版本： 8.0.31
-- PHP 版本： 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '姓名',
  `IDnumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身分證號',
  `Birthday` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '生日(加密處理)',
  `Phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話(加密處理)',
  `Postalcode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '郵遞區號',
  `Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '住址(加密處理)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`id`, `Name`, `IDnumber`, `Birthday`, `Phone`, `Postalcode`, `Address`) VALUES
(44, '123', '12', 'MjAyMy0wNC0yMA==', 'MTI=', '1', 'MQ=='),
(46, '123', '12', 'MjAyMy0wNC0wNg==', 'MTI=', '123', 'MTIz'),
(49, 'ggyy', '12', 'MjAyMy0wNC0wOA==', 'MTI=', '123', 'MQ=='),
(48, 'ggg', '122345', 'MjAyMy0wNC0wNQ==', 'MTI=', '1', 'MTIz'),
(45, '123', '12', 'MjAyMy0wNC0wNw==', 'MTI=', '1', 'MQ=='),
(50, 'llll', '12', 'MjAyMy0wNC0wNg==', 'MTI=', '1', 'MQ=='),
(51, '123', '12', 'MjAyMy0wNC0wMQ==', 'MTI=', '12', 'MTI=');

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` int NOT NULL COMMENT '產品名稱',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderId` int NOT NULL AUTO_INCREMENT,
  `Name` int NOT NULL COMMENT '訂單名稱',
  PRIMARY KEY (`OrderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `SalesId` int NOT NULL AUTO_INCREMENT,
  `Name` int NOT NULL COMMENT '業務姓名',
  PRIMARY KEY (`SalesId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `sales`
--

INSERT INTO `sales` (`SalesId`, `Name`) VALUES
(1, 0),
(2, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `StoreId` int NOT NULL AUTO_INCREMENT,
  `SalesId` int NOT NULL COMMENT '業務id',
  `Name` int NOT NULL COMMENT '店家名稱',
  PRIMARY KEY (`StoreId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

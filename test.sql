-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-04-25 08:37:09
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
  `CustomerId` int NOT NULL AUTO_INCREMENT COMMENT '客戶 ID',
  `Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '顧客姓名',
  `IDnumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '身分證號',
  `Birthday` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '生日(加密處理)',
  `Phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '電話(加密處理)',
  `Postalcode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '郵遞區號',
  `Address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '住址(加密處理)',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`CustomerId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='客戶表格';

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`CustomerId`, `Name`, `IDnumber`, `Birthday`, `Phone`, `Postalcode`, `Address`, `CreatedTime`) VALUES
(5, 'Emma', 'M122', 'MjAyMy0wNC0wNg==', 'MTIz', '123', 'MTIz', '2023-04-24 02:18:00'),
(6, 'Jack', 'M123', 'MjAyMy0wNC0yMA==', 'MTIz', '123', 'MTIz', '2023-04-24 02:18:59'),
(7, 'Lily', 'M124', 'MjAyMy0wNC0wNA==', 'MTIz', '123', 'MTIz', '2023-04-24 02:19:10'),
(8, 'Max', 'M125', 'MjAyMy0wNC0wMQ==', 'MTIz', '123', 'MTIz', '2023-04-24 02:19:21'),
(9, 'Ava', 'M126', 'MjAyMy0wNC0wNw==', 'MTIz', '123', 'MTIz', '2023-04-24 02:19:30'),
(10, '123', '123', 'MjAyMy0wNC0yNQ==', 'MTIz', '123', 'MTIz', '2023-04-25 06:23:17');

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ItemsId` int NOT NULL AUTO_INCREMENT COMMENT '產品 ID',
  `StoreId` int NOT NULL COMMENT '店家 ID',
  `ItemsName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '產品名稱',
  `ItemsPrice` int DEFAULT NULL COMMENT '產品售價',
  `ItemsState` int NOT NULL DEFAULT '0' COMMENT '產品狀態0開1停',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`ItemsId`),
  KEY `StoreId` (`StoreId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='產品品項表格';

--
-- 傾印資料表的資料 `items`
--

INSERT INTO `items` (`ItemsId`, `StoreId`, `ItemsName`, `ItemsPrice`, `ItemsState`, `CreatedTime`) VALUES
(3, 2, 'apple', 15, 0, '2023-04-24 01:25:11'),
(4, 5, 'car', 180000, 0, '2023-04-24 08:34:01'),
(5, 8, 'pen', 5, 0, '2023-04-24 08:34:28'),
(9, 5, '1', 200000, 0, '2023-04-25 03:20:44'),
(10, 5, '123456', 456, 0, '2023-04-25 03:22:40'),
(11, 5, '1', 123, 0, '2023-04-25 03:23:04');

-- --------------------------------------------------------

--
-- 資料表結構 `items_car`
--

DROP TABLE IF EXISTS `items_car`;
CREATE TABLE IF NOT EXISTS `items_car` (
  `Items_carId` int NOT NULL AUTO_INCREMENT COMMENT '購物車id',
  `CustomerId` int NOT NULL COMMENT '客戶id',
  `ItemsId` int NOT NULL COMMENT '產品id',
  `ItemsQuantity` int DEFAULT NULL COMMENT '產品數量	',
  `ItemsTotalMoney` int DEFAULT NULL COMMENT '	產品總價	',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Items_carId`),
  KEY `CustomerId` (`CustomerId`),
  KEY `itemsId` (`ItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='購物車';

--
-- 傾印資料表的資料 `items_car`
--

INSERT INTO `items_car` (`Items_carId`, `CustomerId`, `ItemsId`, `ItemsQuantity`, `ItemsTotalMoney`, `CreatedTime`) VALUES
(8, 10, 4, 4, 720000, '2023-04-25 07:45:45'),
(9, 10, 3, 1, 15, '2023-04-25 07:45:47');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderId` int NOT NULL AUTO_INCREMENT COMMENT '訂單 ID',
  `CustomerId` int NOT NULL COMMENT '客戶 ID',
  `OrderMoney` int NOT NULL COMMENT '訂單總價',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`OrderId`),
  KEY `CustomerId` (`CustomerId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='訂單表格';

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`OrderId`, `CustomerId`, `OrderMoney`, `CreatedTime`) VALUES
(2, 5, 900000, '2023-04-24 08:36:39'),
(3, 5, 700000, '2023-03-20 12:30:00'),
(4, 5, 800000, '2023-03-20 13:45:00'),
(5, 6, 600000, '2023-03-21 10:20:00'),
(6, 6, 500000, '2023-03-21 15:30:00'),
(7, 7, 900000, '2023-03-22 09:00:00'),
(8, 7, 600000, '2023-03-22 17:00:00'),
(9, 8, 800000, '2023-03-23 11:11:00'),
(10, 8, 700000, '2023-03-23 16:00:00'),
(11, 9, 1000000, '2023-03-24 14:30:00'),
(12, 9, 900000, '2023-03-24 19:00:00'),
(13, 5, 600000, '2023-03-25 09:00:00'),
(14, 5, 800000, '2023-03-25 18:00:00'),
(15, 6, 900000, '2023-03-26 10:00:00'),
(16, 6, 500000, '2023-03-26 15:00:00'),
(17, 7, 700000, '2023-03-27 11:30:00'),
(18, 7, 800000, '2023-03-27 16:00:00'),
(19, 8, 600000, '2023-03-28 09:00:00'),
(20, 8, 900000, '2023-03-28 18:00:00'),
(21, 9, 1000000, '2023-03-29 10:30:00'),
(22, 9, 700000, '2023-03-29 15:00:00'),
(23, 5, 800000, '2023-03-30 13:00:00'),
(24, 5, 600000, '2023-03-30 19:00:00'),
(25, 6, 500000, '2023-03-31 11:30:00');

-- --------------------------------------------------------

--
-- 資料表結構 `order_content`
--

DROP TABLE IF EXISTS `order_content`;
CREATE TABLE IF NOT EXISTS `order_content` (
  `order_contentId` int NOT NULL AUTO_INCREMENT COMMENT '訂單內容Id',
  `OrderId` int NOT NULL COMMENT '訂單ID',
  `ItemsId` int NOT NULL COMMENT '產品ID',
  `ItemsQuantity` int DEFAULT NULL COMMENT '產品數量',
  `ItemsTotalMoney` int DEFAULT NULL COMMENT '產品總價',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_contentId`),
  KEY `OrderId` (`OrderId`),
  KEY `ItemId` (`ItemsId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='訂單內容表格';

--
-- 傾印資料表的資料 `order_content`
--

INSERT INTO `order_content` (`order_contentId`, `OrderId`, `ItemsId`, `ItemsQuantity`, `ItemsTotalMoney`, `CreatedTime`) VALUES
(2, 2, 4, 5, 900000, '2023-04-24 08:37:00'),
(3, 3, 3, 8, 120, '2023-03-20 12:00:00'),
(4, 3, 4, 2, 360000, '2023-03-20 12:00:00'),
(5, 4, 5, 20, 100, '2023-03-21 12:00:00'),
(6, 4, 3, 5, 75, '2023-03-21 12:00:00'),
(7, 5, 4, 1, 180000, '2023-03-22 12:00:00'),
(8, 5, 5, 10, 50, '2023-03-22 12:00:00'),
(9, 6, 3, 3, 45, '2023-03-23 12:00:00'),
(10, 6, 4, 2, 360000, '2023-03-23 12:00:00'),
(11, 7, 5, 15, 75, '2023-03-24 12:00:00'),
(12, 7, 3, 6, 90, '2023-03-24 12:00:00'),
(13, 8, 4, 3, 540000, '2023-03-25 12:00:00'),
(14, 8, 5, 5, 25, '2023-03-25 12:00:00'),
(15, 9, 3, 9, 135, '2023-03-26 12:00:00'),
(16, 9, 4, 1, 180000, '2023-03-26 12:00:00'),
(17, 10, 5, 12, 60, '2023-03-27 12:00:00'),
(18, 10, 3, 4, 60, '2023-03-27 12:00:00'),
(19, 11, 4, 4, 720000, '2023-03-28 12:00:00'),
(20, 11, 5, 2, 10, '2023-03-28 12:00:00'),
(21, 12, 3, 6, 90, '2023-03-29 12:00:00'),
(22, 12, 4, 3, 540000, '2023-03-29 12:00:00'),
(23, 13, 5, 8, 40, '2023-03-30 12:00:00'),
(24, 13, 3, 5, 75, '2023-03-30 12:00:00'),
(25, 14, 4, 5, 900000, '2023-03-31 12:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `SalesId` int NOT NULL AUTO_INCREMENT COMMENT '業務人員 ID',
  `SalesName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '業務名稱',
  `SalesPw` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '業務密碼',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`SalesId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='業務人員表格';

--
-- 傾印資料表的資料 `sales`
--

INSERT INTO `sales` (`SalesId`, `SalesName`, `SalesPw`, `CreatedTime`) VALUES
(2, 'ggyy', '123456', '2023-04-24 01:24:42'),
(3, 'ain', '123456', '2023-04-24 02:11:37'),
(4, 'Lin', '123456', '2023-04-24 02:11:45');

-- --------------------------------------------------------

--
-- 資料表結構 `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `StoreId` int NOT NULL AUTO_INCREMENT COMMENT '店家 ID',
  `SalesId` int NOT NULL COMMENT '業務人員 ID',
  `StoreName` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '店家名稱',
  `StorePw` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '店家密碼',
  `StoreState` int NOT NULL DEFAULT '0' COMMENT '店家狀態0開1停2刪',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`StoreId`),
  KEY `SalesId` (`SalesId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='店家表格';

--
-- 傾印資料表的資料 `store`
--

INSERT INTO `store` (`StoreId`, `SalesId`, `StoreName`, `StorePw`, `StoreState`, `CreatedTime`) VALUES
(2, 2, 'fruit', '123456', 0, '2023-04-24 01:24:56'),
(3, 2, 'fruit2', '123456', 0, '2023-04-24 02:13:51'),
(4, 2, 'fruit3', '123456', 0, '2023-04-24 02:14:10'),
(5, 3, 'car', '123456', 0, '2023-04-24 02:14:27'),
(6, 3, 'car2', '123456', 0, '2023-04-24 02:14:41'),
(7, 3, 'car3', '123456', 0, '2023-04-24 02:14:48'),
(8, 4, 'pen', '123456', 0, '2023-04-24 02:15:28'),
(9, 4, 'pen2', '123456', 0, '2023-04-24 02:15:32'),
(10, 4, 'pen3', '123456', 0, '2023-04-24 02:15:38'),
(11, 2, '123', '123', 0, '2023-04-24 07:15:02'),
(12, 3, 'car4', '123456', 0, '2023-04-24 09:21:02');

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`StoreId`) REFERENCES `store` (`StoreId`);

--
-- 資料表的限制式 `items_car`
--
ALTER TABLE `items_car`
  ADD CONSTRAINT `items_car_ibfk_1` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`),
  ADD CONSTRAINT `items_car_ibfk_2` FOREIGN KEY (`ItemsId`) REFERENCES `items` (`ItemsId`);

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`);

--
-- 資料表的限制式 `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `order_content_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `order` (`OrderId`),
  ADD CONSTRAINT `order_content_ibfk_2` FOREIGN KEY (`ItemsId`) REFERENCES `items` (`ItemsId`);

--
-- 資料表的限制式 `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`SalesId`) REFERENCES `sales` (`SalesId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

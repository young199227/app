-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3308
-- 產生時間： 2023-04-23 12:52:27
-- 伺服器版本： 5.7.40
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
  `CustomerId` int(11) NOT NULL AUTO_INCREMENT COMMENT '客戶 ID',
  `Name` varchar(50) DEFAULT NULL COMMENT '顧客姓名',
  `IDnumber` varchar(50) DEFAULT NULL COMMENT '身分證號',
  `Birthday` varchar(50) DEFAULT NULL COMMENT '生日(加密處理)',
  `Phone` varchar(50) DEFAULT NULL COMMENT '電話(加密處理)',
  `Postalcode` varchar(50) DEFAULT NULL COMMENT '郵遞區號',
  `Address` varchar(100) DEFAULT NULL COMMENT '住址(加密處理)',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`CustomerId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='客戶表格';

--
-- 傾印資料表的資料 `customer`
--

INSERT INTO `customer` (`CustomerId`, `Name`, `IDnumber`, `Birthday`, `Phone`, `Postalcode`, `Address`, `CreatedTime`) VALUES
(3, '123', '12', 'MjAyMy0wNC0wNg==', 'MTI=', '12', 'MTI=', '2023-04-22 07:27:01');

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `ItemId` int(11) NOT NULL AUTO_INCREMENT COMMENT '產品 ID',
  `StoreId` int(11) NOT NULL COMMENT '店家 ID',
  `Name` varchar(50) NOT NULL DEFAULT '' COMMENT '產品名稱',
  `Price` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '產品售價',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`ItemId`),
  KEY `StoreId` (`StoreId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='產品品項表格';

--
-- 傾印資料表的資料 `items`
--

INSERT INTO `items` (`ItemId`, `StoreId`, `Name`, `Price`, `CreatedTime`) VALUES
(1, 1, 'gy', '10.00', '2023-04-22 07:08:09');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `OrderId` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單 ID',
  `ItemId` int(11) NOT NULL COMMENT '產品 ID',
  `CustomerId` int(11) NOT NULL COMMENT '客戶 ID',
  `Quantity` int(11) NOT NULL DEFAULT '1' COMMENT '數量',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`OrderId`),
  KEY `ItemId` (`ItemId`),
  KEY `CustomerId` (`CustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='訂單表格';

-- --------------------------------------------------------

--
-- 資料表結構 `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `SalesId` int(11) NOT NULL AUTO_INCREMENT COMMENT '業務人員 ID',
  `Name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`SalesId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='業務人員表格';

--
-- 傾印資料表的資料 `sales`
--

INSERT INTO `sales` (`SalesId`, `Name`, `CreatedTime`) VALUES
(1, 'ggyy', '2023-04-22 07:07:37');

-- --------------------------------------------------------

--
-- 資料表結構 `store`
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE IF NOT EXISTS `store` (
  `StoreId` int(11) NOT NULL AUTO_INCREMENT COMMENT '店家 ID',
  `SalesId` int(11) NOT NULL COMMENT '業務人員 ID',
  `Name` varchar(50) NOT NULL DEFAULT '' COMMENT '店家名稱',
  `CreatedTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
  PRIMARY KEY (`StoreId`),
  KEY `SalesId` (`SalesId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='店家表格';

--
-- 傾印資料表的資料 `store`
--

INSERT INTO `store` (`StoreId`, `SalesId`, `Name`, `CreatedTime`) VALUES
(1, 1, 'gggyyy', '2023-04-22 07:07:53');

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`StoreId`) REFERENCES `store` (`StoreId`);

--
-- 資料表的限制式 `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`ItemId`) REFERENCES `items` (`ItemId`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `customer` (`CustomerId`);

--
-- 資料表的限制式 `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`SalesId`) REFERENCES `sales` (`SalesId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

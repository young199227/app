-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2023-02-11 08:54:44
-- 伺服器版本： 5.7.40
-- PHP 版本： 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `fruit_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `Goods_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品編號',
  `Goods_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名稱',
  `Goods_money` int(11) NOT NULL COMMENT '商品價錢',
  `Goods_sum` int(11) NOT NULL COMMENT '商品數量',
  `Goods_area` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品產地',
  `Goods_detail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `Goods_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '商品創建時間',
  PRIMARY KEY (`Goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `goods_car`
--

DROP TABLE IF EXISTS `goods_car`;
CREATE TABLE IF NOT EXISTS `goods_car` (
  `Member_id` int(11) NOT NULL,
  `Goods_id` int(11) NOT NULL,
  PRIMARY KEY (`Member_id`,`Goods_id`),
  KEY `Goods_id` (`Goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `goods_imges`
--

DROP TABLE IF EXISTS `goods_imges`;
CREATE TABLE IF NOT EXISTS `goods_imges` (
  `Goods_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `Goods_id` int(11) NOT NULL COMMENT '商品編號',
  `Goods_img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品圖片',
  PRIMARY KEY (`Goods_img_id`),
  KEY `Goods_id` (`Goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `Member_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員ID',
  `Member_email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員email',
  `Member_password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員密碼',
  `Member_state` int(11) NOT NULL DEFAULT '1',
  `Member_session` int(11) DEFAULT NULL,
  `Member_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '會員創建時間',
  PRIMARY KEY (`Member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`Member_id`, `Member_email`, `Member_password`, `Member_state`, `Member_session`, `Member_created_at`) VALUES
(1, 'owner', '123456', 0, 0, '2022-12-14 14:03:39'),
(2, 'demomap', '123456', 0, 0, '2022-12-14 14:03:39'),
(3, '123', '123', 1, NULL, '2023-02-10 01:30:11');

-- --------------------------------------------------------

--
-- 資料表結構 `order_content`
--

DROP TABLE IF EXISTS `order_content`;
CREATE TABLE IF NOT EXISTS `order_content` (
  `Order_id` int(11) NOT NULL,
  `Goods_id` int(11) NOT NULL,
  PRIMARY KEY (`Order_id`,`Goods_id`),
  KEY `Goods_id` (`Goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `oredr`
--

DROP TABLE IF EXISTS `oredr`;
CREATE TABLE IF NOT EXISTS `oredr` (
  `Order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單ID',
  `Member_id` int(11) NOT NULL COMMENT '會員ID',
  `Order_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '訂單創建時間',
  PRIMARY KEY (`Order_id`),
  KEY `Member_id` (`Member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `goods_car`
--
ALTER TABLE `goods_car`
  ADD CONSTRAINT `goods_car_ibfk_1` FOREIGN KEY (`Member_id`) REFERENCES `member` (`Member_id`),
  ADD CONSTRAINT `goods_car_ibfk_2` FOREIGN KEY (`Goods_id`) REFERENCES `goods` (`Goods_id`);

--
-- 資料表的限制式 `goods_imges`
--
ALTER TABLE `goods_imges`
  ADD CONSTRAINT `goods_imges_ibfk_1` FOREIGN KEY (`Goods_id`) REFERENCES `goods` (`Goods_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `order_content_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `oredr` (`Order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_content_ibfk_2` FOREIGN KEY (`Goods_id`) REFERENCES `goods` (`Goods_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `oredr`
--
ALTER TABLE `oredr`
  ADD CONSTRAINT `oredr_ibfk_1` FOREIGN KEY (`Member_id`) REFERENCES `member` (`Member_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

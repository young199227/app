-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 02 月 10 日 09:30
-- 伺服器版本： 8.0.31-0ubuntu0.22.04.1
-- PHP 版本： 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
CREATE TABLE `goods` (
  `Goods_id` int NOT NULL COMMENT '商品編號',
  `Goods_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名稱',
  `Goods_money` int NOT NULL COMMENT '商品價錢',
  `Goods_sum` int NOT NULL COMMENT '商品數量',
  `Goods_area` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品產地',
  `Goods_detail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `Goods_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '商品創建時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `goods`
--

INSERT INTO `goods` (`Goods_id`, `Goods_name`, `Goods_money`, `Goods_sum`, `Goods_area`, `Goods_detail`, `Goods_created_at`) VALUES
(1, '蘋果', 50, 0, '', '', '2022-12-14 14:30:13'),
(2, '草莓', 100, 0, '', '', '2022-12-14 14:30:21'),
(3, '大西瓜', 100, 0, '', '', '2022-12-14 14:30:31');

-- --------------------------------------------------------

--
-- 資料表結構 `goods_car`
--

DROP TABLE IF EXISTS `goods_car`;
CREATE TABLE `goods_car` (
  `Member_id` int NOT NULL,
  `Goods_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `goods_imges`
--

DROP TABLE IF EXISTS `goods_imges`;
CREATE TABLE `goods_imges` (
  `Goods_img_id` int NOT NULL,
  `Goods_id` int NOT NULL COMMENT '商品編號',
  `Goods_img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品圖片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `Member_id` int NOT NULL COMMENT '會員ID',
  `Member_meail` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員email',
  `Member_password` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員密碼',
  `Member_state` int NOT NULL DEFAULT '1',
  `Member_session` int DEFAULT NULL,
  `Member_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '會員創建時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`Member_id`, `Member_meail`, `Member_password`, `Member_state`, `Member_session`, `Member_created_at`) VALUES
(1, 'owner', '123456', 0, 0, '2022-12-14 14:03:39'),
(4, '123', '123', 1, NULL, '2023-02-10 01:30:11');

-- --------------------------------------------------------

--
-- 資料表結構 `order_content`
--

DROP TABLE IF EXISTS `order_content`;
CREATE TABLE `order_content` (
  `Order_id` int NOT NULL,
  `Goods_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `oredr`
--

DROP TABLE IF EXISTS `oredr`;
CREATE TABLE `oredr` (
  `Order_id` int NOT NULL COMMENT '訂單ID',
  `Member_id` int NOT NULL COMMENT '會員ID',
  `Order_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '訂單創建時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`Goods_id`);

--
-- 資料表索引 `goods_car`
--
ALTER TABLE `goods_car`
  ADD PRIMARY KEY (`Member_id`,`Goods_id`),
  ADD KEY `Goods_id` (`Goods_id`);

--
-- 資料表索引 `goods_imges`
--
ALTER TABLE `goods_imges`
  ADD PRIMARY KEY (`Goods_img_id`),
  ADD KEY `Goods_id` (`Goods_id`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_id`);

--
-- 資料表索引 `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`Order_id`,`Goods_id`),
  ADD KEY `Goods_id` (`Goods_id`);

--
-- 資料表索引 `oredr`
--
ALTER TABLE `oredr`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Member_id` (`Member_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `goods`
--
ALTER TABLE `goods`
  MODIFY `Goods_id` int NOT NULL AUTO_INCREMENT COMMENT '商品編號', AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `goods_imges`
--
ALTER TABLE `goods_imges`
  MODIFY `Goods_img_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `Member_id` int NOT NULL AUTO_INCREMENT COMMENT '會員ID', AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `oredr`
--
ALTER TABLE `oredr`
  MODIFY `Order_id` int NOT NULL AUTO_INCREMENT COMMENT '訂單ID', AUTO_INCREMENT=7;

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

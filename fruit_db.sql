-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2023 年 02 月 15 日 07:47
-- 伺服器版本： 5.7.34
-- PHP 版本： 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `fruit_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `Goods_id` int(11) NOT NULL COMMENT '商品編號',
  `Goods_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名稱',
  `Goods_money` int(11) NOT NULL COMMENT '商品價錢',
  `Goods_sum` int(11) NOT NULL COMMENT '商品數量',
  `Goods_area` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品產地',
  `Goods_detail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `Goods_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '商品創建時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `goods`
--

INSERT INTO `goods` (`Goods_id`, `Goods_name`, `Goods_money`, `Goods_sum`, `Goods_area`, `Goods_detail`, `Goods_created_at`) VALUES
(4, '蘋果', 177, 99, '南投縣仁愛鄉', '蘋果很好吃', '2023-02-15 07:10:22'),
(5, '葡萄', 3780, 99, '雲林縣古坑鄉', '葡萄很好吃', '2023-02-15 07:18:05'),
(6, '草莓', 666, 99, '苗栗縣大湖鄉', '草莓很好吃', '2023-02-15 07:23:23'),
(7, '奇異果', 888, 99, '新竹縣五峰鄉', '奇異果健康', '2023-02-15 07:34:19'),
(8, '柳丁', 680, 99, '嘉義縣大林鎮', '柳丁柳丁', '2023-02-15 07:37:21'),
(9, '香蕉', 1000, 99, '南投縣中寮鄉', '蕉流', '2023-02-15 07:46:29'),
(10, '西瓜', 88, 99, '宜蘭縣大同鄉', '呱呱', '2023-02-15 07:46:29'),
(11, '青龍蘋果', 188, 99, '南投縣仁愛鄉', '青蘋果', '2023-02-15 07:46:29'),
(12, '橘子像柳丁', 980, 99, '南投縣仁愛鄉', '橘橘子', '2023-02-15 07:46:29'),
(13, '檸檬', 550, 99, '彰化縣二水鄉', '檸檬酸酸', '2023-02-15 07:46:29'),
(14, '蕃茄', 440, 99, '高雄市美濃區', '蕃茄紅紅通', '2023-02-15 07:46:29'),
(15, '牛蕃茄', 450, 99, '高雄市美濃區', '哞哞蕃茄', '2023-02-15 07:46:29'),
(16, '木瓜', 300, 99, '臺南市大內區', '呱呱木', '2023-02-15 07:46:29'),
(17, '富士蘋果', 199, 99, '南投縣仁愛鄉', '蘋果很好吃', '2023-02-15 07:46:29'),
(18, '鳳梨', 288, 99, '花蓮縣瑞穗鄉', '好刺好刺', '2023-02-15 07:46:29'),
(19, '巨峰葡萄', 4000, 99, '雲林縣古坑鄉', '葡萄很好吃', '2023-02-15 07:46:29'),
(20, '水蜜桃', 150, 99, '桃園市大溪區', '水蜜桃甜蜜蜜', '2023-02-15 08:10:22'),
(21, '芭樂', 250, 99, '屏東縣恆春鎮', '芭樂清香可口', '2023-02-15 08:18:05'),
(22, '火龍果', 200, 99, '嘉義市東區', '火龍果口感清新', '2023-02-15 08:23:23'),
(23, '橙子', 120, 99, '苗栗縣頭份市', '橙子汁多又好吃', '2023-02-15 08:34:19'),
(24, '柚子', 300, 99, '彰化縣福興鄉', '柚子富含維他命C', '2023-02-15 08:37:21'),
(25, '奇芙蓉', 420, 99, '南投縣中寮鄉', '奇芙蓉營養豐富', '2023-02-15 08:46:29'),
(26, '香橙', 200, 99, '臺北市中正區', '香橙鮮美好吃', '2023-02-15 08:46:29'),
(27, '芒果', 1000, 99, '屏東縣恆春鎮', '芒果酸甜可口', '2023-02-15 08:46:29'),
(28, '榴槤', 2000, 99, '臺中市北區', '榴槤濃郁好味', '2023-02-15 08:46:29'),
(29, '龍眼', 300, 99, '桃園市八德區', '龍眼清甜可口', '2023-02-15 08:46:29'),
(30, '木瓜牛奶', 400, 99, '高雄市岡山區', '木瓜牛奶好喝', '2023-02-15 08:46:29'),
(31, '甜橙', 180, 99, '苗栗縣竹南鎮', '甜橙多汁好吃', '2023-02-15 08:46:29'),
(32, '水梨', 120, 99, '新竹市北區', '水梨清爽好吃', '2023-02-15 08:46:29');

-- --------------------------------------------------------

--
-- 資料表結構 `goods_car`
--

DROP TABLE IF EXISTS `goods_car`;
CREATE TABLE `goods_car` (
  `Member_id` int(11) NOT NULL,
  `Goods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `goods_imges`
--

DROP TABLE IF EXISTS `goods_imges`;
CREATE TABLE `goods_imges` (
  `Goods_img_id` int(11) NOT NULL,
  `Goods_id` int(11) NOT NULL COMMENT '商品編號',
  `Goods_img` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品圖片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `goods_imges`
--

INSERT INTO `goods_imges` (`Goods_img_id`, `Goods_id`, `Goods_img`) VALUES
(2, 4, '/img/fruit_images/fruit1.jpg'),
(3, 4, '/img/fruit_images/fruit34.png'),
(4, 4, '/img/fruit_images/fruit50.png'),
(5, 4, '/img/fruit_images/fruit55.png'),
(6, 4, '/img/fruit_images/fruit56.png'),
(7, 5, '/img/fruit_images/fruit4.jpg'),
(8, 5, '/img/fruit_images/fruit17.png'),
(9, 5, '/img/fruit_images/fruit24.png'),
(10, 5, '/img/fruit_images/fruit26.png'),
(11, 5, '/img/fruit_images/fruit25.png'),
(12, 6, '/img/fruit_images/fruit5.jpg'),
(13, 6, '/img/fruit_images/fruit30.png'),
(14, 6, '/img/fruit_images/fruit39.png'),
(15, 6, '/img/fruit_images/fruit10.jpg'),
(16, 7, '/img/fruit_images/fruit12.jpg'),
(17, 7, '/img/fruit_images/fruit31.png'),
(18, 7, '/img/fruit_images/fruit32.png'),
(19, 7, '/img/fruit_images/fruit33.png'),
(20, 8, '/img/fruit_images/fruit8.jpg'),
(21, 8, '/img/fruit_images/fruit37.png'),
(22, 9, '/img/fruit_images/fruit6.jpg'),
(23, 9, '/img/fruit_images/fruit42.png'),
(24, 10, '/img/fruit_images/fruit14.jpg'),
(25, 10, '/img/fruit_images/fruit46.png'),
(26, 11, '/img/fruit_images/fruit9.jpg'),
(27, 11, '/img/fruit_images/fruit002.jpg'),
(28, 12, '/img/fruit_images/fruit23.png'),
(29, 13, '/img/fruit_images/fruit18.png'),
(30, 13, '/img/fruit_images/fruit19.png'),
(31, 13, '/img/fruit_images/fruit22.png'),
(32, 14, '/img/fruit_images/fruit11.jpg'),
(33, 14, '/img/fruit_images/fruit47.png'),
(34, 14, '/img/fruit_images/fruit53.png'),
(35, 15, '/img/fruit_images/fruit48.png'),
(36, 16, '/img/fruit_images/fruit28.png'),
(37, 16, '/img/fruit_images/fruit29.png'),
(38, 17, '/img/fruit_images/fruit27.png'),
(39, 18, '/img/fruit_images/fruit51.png'),
(40, 19, '/img/fruit_images/fruit25.png');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `Member_id` int(11) NOT NULL COMMENT '會員ID',
  `Member_email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員email',
  `Member_password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員密碼',
  `Member_state` int(11) NOT NULL DEFAULT '1',
  `Member_session` int(11) DEFAULT NULL,
  `Member_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '會員創建時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE `order_content` (
  `Order_id` int(11) NOT NULL,
  `Goods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `oredr`
--

DROP TABLE IF EXISTS `oredr`;
CREATE TABLE `oredr` (
  `Order_id` int(11) NOT NULL COMMENT '訂單ID',
  `Member_id` int(11) NOT NULL COMMENT '會員ID',
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
  MODIFY `Goods_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品編號', AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `goods_imges`
--
ALTER TABLE `goods_imges`
  MODIFY `Goods_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `Member_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '會員ID', AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `oredr`
--
ALTER TABLE `oredr`
  MODIFY `Order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '訂單ID', AUTO_INCREMENT=7;

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

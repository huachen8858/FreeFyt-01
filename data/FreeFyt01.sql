-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 10 月 24 日 08:54
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `FreeFyt01`
--

-- --------------------------------------------------------

--
-- 資料表結構 `order_list`
--

CREATE TABLE `order_list` (
  `sid` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `member_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_date` date DEFAULT NULL,
  `recipient` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `shipping_method` varchar(255) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `product_categories`
--

CREATE TABLE `product_categories` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_categories`
--

INSERT INTO `product_categories` (`sid`, `name`, `parent_sid`) VALUES
(1, '物品', 0),
(2, '食品', 0),
(3, '服裝', 1),
(4, '器材', 1),
(5, '裝備', 1),
(6, '蛋白', 2),
(7, '非蛋白', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `product_detail`
--

CREATE TABLE `product_detail` (
  `sid` int(11) NOT NULL,
  `product_sid` varchar(30) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_detail`
--

INSERT INTO `product_detail` (`sid`, `product_sid`, `img`) VALUES
(50, 'FYT-20231019-0020', '92217ae96dc8abe8925969ba10071f393bf337c1.jpg'),
(51, 'FYT-20231020-0001', 'fe4e3b4c99fa3f8551f2d7cdb7532c04c0a7a86f.jpg'),
(54, 'FYT-20231020-0004', '70c3bb3a49655608b332180efe7302bbda17ba62.webp'),
(55, 'FYT-20231020-0005', 'c68c78924bb7e0383725c28f7b51e90877e469cf.webp'),
(56, 'FYT-20231020-0007', 'ff97b02beaad622f03d00671c267231ff06c1558.webp'),
(57, 'FYT-20231020-0009', '0c21158e0336a1ccbf64c329934903137afa2ae8.webp'),
(58, 'FYT-20231020-0011', '4639b98261adf0b0ad91e3c36ad01fa8e97f813b.webp'),
(59, '0', '4f114f036f7aec6e9590f6668782fd841084d33e.webp'),
(60, '0', '2258e750eec76c1838e9a99eb36123173f3a697c.webp');

-- --------------------------------------------------------

--
-- 資料表結構 `product_list`
--

CREATE TABLE `product_list` (
  `sid` int(11) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `main_category` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `descriptions` varchar(255) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `purchase_qty` int(11) DEFAULT NULL,
  `launch` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product_list`
--

INSERT INTO `product_list` (`sid`, `product_id`, `name`, `price`, `main_category`, `category`, `descriptions`, `inventory`, `purchase_qty`, `launch`, `create_date`, `img`) VALUES
(1, 'FYT-20230618-00001', 'yoga mat', 1580, 0, 4, '提供您瑜珈練習所需的完美支持和舒適。我們的瑜珈墊採用高品質的材料，提供出色的防滑性和緩衝效果，確保您在每個動作中都感到穩定和安心。瑜珈墊的良好選擇，幫助您實現更深入的冥想和伸展。', 12, 22, 1, '2023-06-18', ''),
(2, 'FYT-20231018-00001', '123', 100, 0, 5, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 22, 0, 1, '2023-10-18', ''),
(3, 'FYT-20231018-00001', '有氧運動步機 Aerobic Treadmill', 5499, 0, 5, '這款有氧運動步機適合在家中或健身房使用。它具有多種運動模式和傾斜調整，幫助您達到心臟健康和體重管理的目標。', 22, 0, 1, '2023-10-18', ''),
(4, 'FYT-20231018-00001', '123', 111, 0, 5, '111111111111', 11, 0, 1, '2023-10-18', ''),
(5, 'FYT-20231018-00001', '123', 111, 0, 5, '222', 22, 0, 1, '2023-10-18', ''),
(6, 'FYT-20231018-00001', '1111', 111, 0, 5, '12233456666666', 66, 0, 1, '2023-10-18', ''),
(7, 'FYT-20231018-00001', '1111', 111, 0, 5, '12233456666666', 66, 0, 1, '2023-10-18', ''),
(8, 'FYT-20231018-00002', '111111', 111, 0, 5, '1111111111', 11, 0, 1, '2023-10-18', ''),
(9, 'FYT-20231018-0003', 'Elliptical Machine ', 4200, 0, 4, '這款橢圓機提供低衝擊的全身運動，幫助您增強心肺功能和塑造肌肉，同時保護關節。', 3, 0, 1, '2023-10-18', ''),
(10, 'FYT-20231018-0004', '123', 100, 0, 5, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 22, 0, 1, '2023-10-18', ''),
(11, 'FYT-20231018-0005', 'Elliptical Machine ', 4200, 0, 4, '這款橢圓機提供低衝擊的全身運動，幫助您增強心肺功能和塑造肌肉，同時保護關節。', 22, 0, 0, '2023-10-18', ''),
(12, 'FYT-20231018-0006', '123', 123, 0, 5, '2342342341', 12, 0, 1, '2023-10-18', ''),
(13, 'FYT-20231018-0007', '123', 211, 0, 5, '1111111111', 11, 0, 1, '2023-10-18', ''),
(14, 'FYT-20231018-0008', '123', 211, 0, 5, '1111111111', 11, 0, 1, '2023-10-18', ''),
(15, 'FYT-20231018-0009', '111', 111, 0, 5, '11111', 11, 0, 1, '2023-10-18', ''),
(16, 'FYT-20231018-0010', '111', 111, 0, 5, '11111', 11, 0, 1, '2023-10-18', ''),
(17, 'FYT-20231018-0011', '11', 111, 0, 5, '11111111', 111, 0, 1, '2023-10-18', ''),
(18, 'FYT-20231018-0012', '11', 111, 0, 5, '1111', 111, 0, 1, '2023-10-18', ''),
(19, 'FYT-20231018-0013', '123', 111, 0, 5, '1111111111', 11, 0, 1, '2023-10-18', ''),
(20, 'FYT-20231018-0014', '111', 1111, 0, 5, '11111111111', 1111, 0, 1, '2023-10-18', ''),
(21, 'FYT-20231018-0015', '111', 1111, 0, 5, '11111111111', 1111, 0, 1, '2023-10-18', ''),
(22, 'FYT-20231018-0016', '111', 1111, 0, 5, '1111111111', 1111, 0, 1, '2023-10-18', ''),
(23, 'FYT-20231018-0017', '11111', 11111, 0, 5, '111111111111', 111, 0, 1, '2023-10-18', ''),
(24, 'FYT-20231018-0018', '111', 1111, 0, 5, '1111111111111', 1111, 0, 1, '2023-10-18', ''),
(25, 'FYT-20231018-0019', '111', 1111, 0, 5, '1111111111111', 1111, 0, 1, '2023-10-18', ''),
(26, 'FYT-20231018-0020', '11111', 333, 0, 5, '333', 3333, 0, 1, '2023-10-18', ''),
(27, 'FYT-20231018-0021', '111', 111, 0, 5, '11111111111', 11, 0, 1, '2023-10-18', ''),
(28, 'FYT-20231019-0001', '123', 1111, 0, 5, 'whvifoafka;ggnnvk.', 111, 0, 1, '2023-10-19', ''),
(29, 'FYT-20231019-0002', '123', 111, 0, 5, '11111111111', 11, 0, 1, '2023-10-19', ''),
(30, 'FYT-20231019-0003', '123', 1111, 0, 5, '1111111', 11, 0, 1, '2023-10-19', ''),
(31, 'FYT-20231019-0004', '123', 100, 0, 5, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 22, 0, 1, '2023-10-19', ''),
(32, 'FYT-20231019-0005', '123', 100, 0, 5, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 22, 0, 1, '2023-10-19', ''),
(33, 'FYT-20231019-0006', '1111', 111111, 0, 5, '1111111111111', 11111, 0, 1, '2023-10-19', ''),
(34, 'FYT-20231019-0007', '1111', 111111, 0, 5, '1111111111111', 11111, 0, 1, '2023-10-19', ''),
(35, 'FYT-20231019-0008', '1111', 111111, 0, 5, '1111111111111', 11111, 0, 1, '2023-10-19', ''),
(36, 'FYT-20231019-0009', '1111', 111111, 0, 6, '1111111111111', 11111, 0, 1, '2023-10-19', ''),
(37, 'FYT-20231019-0010', '123', 100, 0, 5, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 22, 0, 1, '2023-10-19', ''),
(38, 'FYT-20231019-0011', '123', 100, 0, 5, 'qqq', 1, 0, 1, '2023-10-19', ''),
(39, 'FYT-20231019-0012', '3333', 3333, 0, 4, '33333333333333', 33, 0, 1, '2023-10-19', ''),
(40, 'FYT-20231019-0013', '4444', 444, 0, 5, '444444', 44, 0, 1, '2023-10-19', ''),
(41, 'FYT-20231019-0014', '111111', 1111, 0, 4, '222222222222', 22, 0, 1, '2023-10-19', ''),
(42, 'FYT-20231019-0015', '2222', 222, 0, 5, '222222222222', 22, 0, 1, '2023-10-19', ''),
(43, 'FYT-20231019-0016', '11111', 11111, 0, 6, '111111', 11111, 0, 1, '2023-10-19', ''),
(44, 'FYT-20231019-0017', '222', 22, 0, 5, '2222222222', 12, 0, 0, '2023-10-19', ''),
(45, 'FYT-20231019-0018', '5555', 555, 0, 5, '555555', 55, 0, 1, '2023-10-19', ''),
(46, 'FYT-20231019-0019', '1111', 111, 0, 5, '11111111111', 111, 0, 1, '2023-10-19', ''),
(47, 'FYT-20231019-0020', '1111', 111, 0, 5, '1111', 0, 0, 0, '2023-10-19', ''),
(48, 'FYT-20231020-0001', '翹臀圈 Booty Band', 159, 1, 4, '想要練習翹臀和強化臀部肌肉嗎？這個翹臀圈是您的理想選擇，可以增加臀部訓練的效果。', 30, 0, 1, '2023-10-20', ''),
(51, 'FYT-20231020-0004', '彈力帶-套組一 hip circles band ', 1280, 1, 4, '這款彈力帶是多功能的訓練工具，可用於強化肌肉和提高柔軟度。不同強度選項可供選擇，適合各種運動愛好者。', 22, 0, 1, '2023-10-20', ''),
(52, 'FYT-20231020-0005', '彈力帶-套組二 hip circles band ', 580, 1, 4, '實現夢寐以求的翹臀和強壯的臀部肌肉，我們的翹臀圈是您的最佳選擇。這個設計精美的工具可以有效鍛鍊臀部、大腿和髖部肌肉，同時提高核心穩定性。無論您是新手還是經驗豐富的運動員，翹臀圈都能助您實現完美的翹臀。', 33, 0, 1, '2023-10-20', ''),
(53, 'FYT-20231020-0006', '123', 100, 2, 6, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 1, 0, 1, '2023-10-20', ''),
(54, 'FYT-20231020-0007', '彈力帶-套組二 hip circles band ', 580, 1, 4, '實現夢寐以求的翹臀和強壯的臀部肌肉，我們的翹臀圈是您的最佳選擇。這個設計精美的工具可以有效鍛鍊臀部、大腿和髖部肌肉，同時提高核心穩定性。無論您是新手還是經驗豐富的運動員，翹臀圈都能助您實現完美的翹臀。', 32, 0, 1, '2023-10-20', ''),
(55, 'FYT-20231020-0008', '123', 100, 2, 6, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 1, 0, 1, '2023-10-20', ''),
(56, 'FYT-20231020-0009', '彈力帶-套組二 hip circles band ', 580, 1, 5, '實現夢寐以求的翹臀和強壯的臀部肌肉，我們的翹臀圈是您的最佳選擇。這個設計精美的工具可以有效鍛鍊臀部、大腿和髖部肌肉，同時提高核心穩定性。無論您是新手還是經驗豐富的運動員，翹臀圈都能助您實現完美的翹臀。', 22, 0, 1, '2023-10-20', ''),
(57, 'FYT-20231020-0010', '123', 100, 2, 6, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 1, 0, 1, '2023-10-20', ''),
(58, 'FYT-20231020-0011', '123', 100, 2, 6, '1111111111111fughsiuhgrjgnrkvndjkd;ahjkhfuiefhruhg;ahug;ohurheouhjkjwndjbahbhsdkasdsdsdsdsdsd', 1, 0, 1, '2023-10-20', ''),
(59, 'FYT-20231020-0012', '1111', 1111, 1, 5, '111111', 223, 0, 1, '2023-10-20', ''),
(60, 'FYT-20231020-0013', '1111', 111, 1, 5, '111111111111', 11, 0, 1, '2023-10-20', ''),
(61, 'FYT-20231020-0014', '111', 11, 1, 5, '111111111111', 111, 0, 1, '2023-10-20', ''),
(63, 'FYT-20231020-0015', '11', 1111, 1, 5, '11111111111', 111, 0, 1, '2023-10-20', ''),
(65, 'FYT-20231020-0016', '1111', 1111, 1, 5, '1111111111', 11, 0, 1, '2023-10-20', ''),
(67, 'FYT-20231020-0017', '11', 11, 1, 5, '1111111111', 11, 0, 1, '2023-10-20', ''),
(69, 'FYT-20231020-0018', '11', 11, 1, 5, '1111111111', 11, 0, 0, '2023-10-20', '8441216b130dd9734eef3489a01de2029ca2198a.webp'),
(71, 'FYT-20231020-0019', '瑜珈墊 yoga mat', 1580, 1, 5, '提供您瑜珈練習所需的完美支持和舒適。我們的瑜珈墊採用高品質的材料，提供出色的防滑性和緩衝效果，確保您在每個動作中都感到穩定和安心。瑜珈墊的良好選擇，幫助您實現更深入的冥想和伸展。', 20, 0, 0, '2023-10-20', 'e4f6d0780a889c5a833ef0d527e085a47ce39014.webp'),
(73, 'FYT-20231020-0020', '1111', 11111, 1, 4, '1111111111', 111, 0, 1, '2023-10-20', ''),
(75, 'FYT-20231020-0021', '筋膜球 fascia massage ball', 380, 1, 5, '舒緩肌肉疲勞和緊張，改善身體的靈活性和血液循環。我們的筋膜按摩球設計緊湊，方便攜帶，適合在辦公室、健身房或家中使用。不論您是運動愛好者還是長時間坐辦公室的人，筋膜按摩球都能幫助您獲得最佳的放鬆和康復。', 32, 0, 1, '2023-10-20', ''),
(81, 'FYT-20231021-0001', '123', 100, 2, 7, '2222222222', 22, 0, 1, '2023-10-21', '8c15f72592ec34ee4d876cb9fbe31c3916c41a97.webp'),
(85, 'FYT-20231021-0003', '1111', 1111, 1, 5, '1111111111111', 11, 0, 1, '2023-10-21', ''),
(89, 'FYT-20231021-0004', '1111', 1111, 1, 5, '1111111111', 11, 0, 1, '2023-10-21', ''),
(91, 'FYT-20231021-0005', '111', 111, 1, 5, '111111111', 111, 0, 1, '2023-10-21', ''),
(93, 'FYT-20231021-0006', '111', 111, 1, 5, '111111111111', 111, 0, 1, '2023-10-21', ''),
(99, 'FYT-20231021-0009', '111', 111, 1, 5, '11111111111', 11, 0, 0, '2023-10-21', 'e653ff6b35334261d9749fda2b89f5e9de067919.webp'),
(103, 'FYT-20231021-0011', '123', 122, 1, 5, '1111111111', 11, 0, 1, '2023-10-21', ''),
(105, 'FYT-20231021-0012', '111', 111, 1, 5, '111111111', 11, 0, 1, '2023-10-21', ''),
(107, 'FYT-20231021-0013', '332', 22, 1, 5, '22222222222', 22, 0, 1, '2023-10-21', 'be5138b776cc3f9dfe31d4c8590b5d16f686f84d.webp'),
(109, 'FYT-20231021-0014', '111111', 111, 1, 4, '1111111111', 0, 0, 0, '2023-10-21', 'b6b7af148f26eaf508b82c606c3460e17be1ecec.webp');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_list`
--
ALTER TABLE `order_list`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product_list`
--
ALTER TABLE `product_list`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

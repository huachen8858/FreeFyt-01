-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2023 年 10 月 18 日 10:57
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
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `sid` int(30) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `subCategory` varchar(11) NOT NULL,
  `price` int(30) NOT NULL,
  `descriptions` varchar(255) NOT NULL,
  `inventory` int(11) NOT NULL,
  `purchase_qty` int(11) NOT NULL,
  `create_date` date DEFAULT NULL,
  `launch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`sid`, `product_id`, `name`, `category`, `subCategory`, `price`, `descriptions`, `inventory`, `purchase_qty`, `create_date`, `launch`) VALUES
(1, 'P001', 'yoga mat', 1, 'B', 1580, '提供您瑜珈練習所需的完美支持和舒適。我們的瑜珈墊採用高品質的材料，提供出色的防滑性和緩衝效果，確保您在每個動作中都感到穩定和安心。瑜珈墊的良好選擇，幫助您實現更深入的冥想和伸展。', 15, 15, '2023-06-28', 1),
(2, 'P002', 'fascia massage ball', 1, 'B', 380, '舒緩肌肉疲勞和緊張，改善身體的靈活性和血液循環。我們的筋膜按摩球設計緊湊，方便攜帶，適合在辦公室、健身房或家中使用。不論您是運動愛好者還是長時間坐辦公室的人，筋膜按摩球都能幫助您獲得最佳的放鬆和康復。', 12, 32, '2023-06-30', 1),
(3, 'P003', 'felastic rope', 1, 'B', 280, '增加您的運動挑戰，強化肌肉，提高身體的柔軟度和力量。我們的彈力帶由耐用的材料製成，提供多種不同強度選項，適合各種體適能水平。它們非常適合伸展、提升力量和改善體態，是您達到健康目標的理想工具。', 0, 20, '2023-06-22', 0),
(4, 'P004', 'hip circle', 1, 'B', 1280, '實現夢寐以求的翹臀和強壯的臀部肌肉，我們的翹臀圈是您的最佳選擇。這個設計精美的工具可以有效鍛鍊臀部、大腿和髖部肌肉，同時提高核心穩定性。無論您是新手還是經驗豐富的運動員，翹臀圈都能助您實現完美的翹臀。', 0, 22, '2023-06-25', 1),
(5, 'P005', 'puller', 1, 'B', 680, '提供多功能的全身運動訓練，增加肌肉強度和柔軟度。我們的拉力帶採用高彈性橡膠材質，提供多個不同強度選項，適用於伸展、提升力量和改善體態。無論您是在健身房還是在家中，拉力帶都是實現您的運動目標的理想伴侶。', 56, 4, '2023-06-25', 1),
(6, 'P006', 'Sit-Up Training Machine', 1, 'B', 1200, '這款仰臥起坐訓練器專為強化腹肌而設計。輕鬆調整角度，讓您享受最佳的仰臥起坐體驗，提升核心力量。', 26, 24, '2023-06-29', 1),
(7, 'P007', 'Resistance Rubber Band Set', 1, 'B', 800, '這套阻力橡皮帶提供多種強度，適合各種訓練需求。適合伸展、強化肌肉和改善靈活性。', 22, 38, '2023-07-05', 1),
(8, 'P008', 'Dumbbell Set', 1, 'B', 2500, '這套亞鈴組合包含多種重量，適合健身愛好者和尋求增肌或強化肌力的人。', 32, 48, '2023-07-12', 1),
(9, 'P009', 'Jump Rope Trainer', 1, 'B', 350, '這款跳繩訓練器是提升心肺健康和協調性的理想選擇。可調節長度，適合不同身高的使用者。', 23, 27, '2023-07-25', 1),
(10, 'P010', 'Spin Bike', 1, 'B', 380, '這款飛輪腳踏車提供實戰感的騎行體驗，幫助您增強心肺功能和塑造腿部肌肉。', 33, 17, '2023-07-13', 1),
(11, 'P011', 'Sit-Up Bench', 1, 'B', 950, '這款仰臥起坐椅提供支持和舒適，是實現完美腹部肌肉的理想工具。可調節角度，適合不同體能水平。', 45, 5, '2023-07-03', 1),
(12, 'P012', 'Suspension Training Straps', 1, 'B', 1300, '這套懸吊訓練帶可幫助您在室內或室外進行全身訓練。提升核心穩定性和力量。', 55, 5, '2023-07-09', 1),
(13, 'P013', 'Elliptical Machine ', 1, 'B', 4200, '款橢圓機提供低衝擊的全身運動，幫助您增強心肺功能和塑造肌肉，同時保護關節。', 10, 5, '2023-07-01', 1),
(14, 'P014', 'Fitness Gloves', 1, 'C', 150, '這款健身手套提供保護和握力支持，適合舉重、健身和體能訓練。', 39, 11, '2023-06-28', 1),
(15, 'P015', 'Aerobic Step', 1, 'B', 600, '這款有氧運動臺適合各種有氧運動，如跳躍、跳簧和健身課程。提供高度調節選項。', 0, 25, '2023-07-17', 0),
(16, 'P016', 'Weighted Training Vest', 1, 'C', 750, '這款重量訓練背心可增加訓練強度，提升力量和耐力。適合跑步、引體上升和訓練。', 0, 25, '2023-07-07', 0),
(17, 'P017', 'Exercise Ball ', 1, 'B', 300, '這個健身球適合伸展、平衡和核心訓練。提供穩定性和舒適性，幫助改善體態。', 18, 32, '2023-07-12', 1),
(18, 'P018', 'Multi-Functional Fitness Equipment', 1, 'B', 3900, '這款多功能健身器材適合家庭使用，提供多種運動選項，包括啞鈴訓練、引體向上、仰臥起坐等。它堅固耐用，是打造理想身材的理想選擇。', 0, 34, '2023-07-17', 0),
(19, 'P019', 'Fitness Ball', 1, 'B', 299, '這款橢圓機提供低衝擊的全身運動，幫助您增強心肺功能和塑造肌肉，同時保護關節。', 0, 35, '2023-07-03', 0),
(20, 'P020', 'Indoor Cycling Bike', 1, 'B', 4499, '這款健身手套提供保護和握力支持，適合舉重、健身和體能訓練。', 24, 26, '2023-07-01', 1),
(21, 'P021', 'Suspension Training System', 1, 'B', 1199, '這個懸吊訓練系統可以幫助您進行全身運動，提高力量、平衡和靈活性。它適合在家或戶外使用，是全面訓練的好幫手。', 0, 12, '2023-07-05', 0),
(22, 'P022', 'Multi-Function Fitness Machine', 1, 'B', 8990, '這款多功能健身機設計精巧，適合各種運動訓練，包括重量訓練、有氧運動和伸展。它具有多個設定，可協助您達到健身目標，提供全面的身體鍛煉。', 14, 7, '2023-07-02', 1),
(23, 'P023', '有氧運動步機 Aerobic Treadmill', 1, 'B', 5499, '這款有氧運動步機適合在家中或健身房使用。它具有多種運動模式和傾斜調整，幫助您達到心臟健康和體重管理的目標。', 2, 13, '2023-06-29', 1),
(24, 'P024', '拉力帶套組 Resistance Band Set', 1, 'B', 199, '我們的拉力帶套組包括多個不同強度的帶子，適合伸展、力量訓練和康復運動。它們輕巧便攜，是健身旅程中的理想伴侶。', 0, 55, '2023-07-08', 0),
(25, 'P025', '懸吊訓練帶 Suspension Training Straps', 1, 'B', 799, '懸吊訓練帶是打造全身強壯和穩定性的理想工具。它可以輕鬆固定在門框、樹木或其他支撐上，讓您進行各種身體重量運動。適合室內和戶外運動。', 0, 30, '2023-06-27', 0),
(26, 'P026', '健身單車 Exercise Bike', 1, 'B', 2499, '這台健身單車適合室內運動，讓您進行有氧運動，提高心肺健康。它配備了多個運動模式，可調節的座椅和心率監測功能。', 12, 8, '2023-07-04', 1),
(27, 'P027', '彈力帶套裝 Resistance Band Set', 1, 'B', 499, '這套彈力帶包括多種不同強度的彈力帶，適用於各種運動，如伸展、肌肉強化和拉力訓練。輕巧便攜，適合隨身攜帶。', 0, 22, '2023-06-25', 0),
(28, 'P028', '筋膜按摩球 Foam Massage Ball', 1, 'B', 180, '這個筋膜按摩球專為紓緩肌肉緊張和減輕肌肉疲勞而設計。緊湊且方便攜帶，適合運動後的按摩和伸展。', 22, 13, '2023-07-19', 1),
(29, 'P029', '彈力帶 Resistance Band', 1, 'B', 299, '這款彈力帶是多功能的訓練工具，可用於強化肌肉和提高柔軟度。不同強度選項可供選擇，適合各種運動愛好者。', 14, 36, '2023-07-06', 1),
(30, 'P030', '翹臀圈 Booty Band', 1, 'B', 159, '想要練習翹臀和強化臀部肌肉嗎？這個翹臀圈是您的理想選擇，可以增加臀部訓練的效果。', 30, 41, '2023-06-28', 1),
(31, 'FYT-20230705-0001', '拉力帶套組 Resistance Band Set', 1, 'B', 150, '我們的拉力帶套組包括多個不同強度的帶子，適合伸展、力量訓練和康復運動。它們輕巧便攜，是健身旅程中的理想伴侶。', 35, 13, '2023-07-05', 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `sid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1587;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
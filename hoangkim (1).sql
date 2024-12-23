-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 23, 2024 lúc 08:49 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hoangkim`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--
CREATE database hoangkim;
use hoangkim;
CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `zone` enum('trong nhà','ngoài trời','vip') DEFAULT 'trong nhà',
  `status` enum('trống','đã đặt') DEFAULT 'trống',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('superadmin','admin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `phone`, `role`, `created_at`) VALUES
(1, 'admin1', '$2y$10$QcnbwfmgbzxDOaFwl7uEE.vTf8S9YS/QJwNcMsXKTFSq1GduKq9Ay', 'admin1@example.com', '12345678911', 'superadmin', '2024-11-28 07:11:37'),
(2, 'test12', '$2y$10$VIHPs/lLcD4bV6YRjrPUD.Z2ZhQmw1qDaLxqvu.Ce/nc28cIa3oky', 'editor1@exampleeee.com', '09876542222321', 'admin', '2024-11-28 07:11:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cancellation_reasons`
--

CREATE TABLE `cancellation_reasons` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `reason` text NOT NULL,
  `cancelled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `problem`, `content`, `created_at`) VALUES
(1, 'Alice Johnson', 'alice@example.com', 'Booking Issue', 'I tried to book a table, but I received an error. Please assist.', '2024-11-28 07:11:37'),
(2, 'Robert Wilson', 'robert@example.com', 'General Inquiry', 'What are your opening hours on holidays?', '2024-11-28 07:11:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `subContent` varchar(255) NOT NULL,
  `mainContent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `events`
--

INSERT INTO `events` (`id`, `name`, `price`, `image`, `subContent`, `mainContent`, `created_at`) VALUES
(1, 'Live Jazz Night', 50.00, '/images/jazz_event.jpg', 'An unforgettable evening of live jazz music.', 'Join us for a live jazz performance by renowned musicians.', '2024-11-28 07:11:37'),
(2, 'Wine Tasting Festival', 30.00, '/images/wine_event.jpg', 'Explore the world of fine wines.', 'Taste a variety of fine wines from around the globe.', '2024-11-28 07:11:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subContent` varchar(255) NOT NULL,
  `mainContent` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `display` tinyint(1) DEFAULT 1,
  `feature` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `price`, `subContent`, `mainContent`, `image`, `category`, `display`, `feature`, `created_at`) VALUES
(1, 'Súp Bắp Cua', 80000.00, 'ok test1 1111', 'ádadadasd', '../uploads/cake.jpg', 'Món Chính', 1, 1, '2024-12-04 14:01:03'),
(2, 'Gỏi Cuốn Tôm Thịt', 100000.00, 'test 1 2 3 4 56 ', 'Món gỏi tươi ngon kết hợp giữa tôm, thịt heo, bún và rau sống cuốn trong bánh tráng mềm chấm với nước chấm chua ngọt', '../uploads/goi_cuon_tom_thit.jpg', 'Khai Vị', 1, 0, '2024-12-07 01:44:29'),
(3, 'Bò Lúc Lắc', 200000.00, 'test mon an bo luc lac', 'Thịt bò mềm, được xào cùng ớt chuông và hành tây, thấm đẫm sốt tiêu đen đậm đà, ăn kèm với khoai tây chiên.', '../uploads/bo_luc_lac.jpg', 'Món Chính', 1, 0, '2024-12-07 01:45:08'),
(4, 'Chè Khúc Bạch', 30000.00, 'che khuc bach day ok nhe', 'che khuc bach rat ngon vi dam da khong qua ngot', '../uploads/che_khuc_bach.jpg', 'Tráng Miệng', 1, 1, '2024-12-07 01:46:02'),
(5, 'Gà Nướng Mật Ong', 250000.00, 'ga  rat ngon rat ok ', 'Gà Nướng Mật Ong Gà Nướng Mật Ong Gà Nướng Mật Ong', '../uploads/ga_nuong_mat_ong.jpg', 'Món Chính', 1, 1, '2024-12-07 01:46:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `reservation_time` datetime NOT NULL,
  `table_id` int(11) NOT NULL,
  `guests_count` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('Chờ duyệt','Đã duyệt','Hủy bàn','Hoàn Thành') DEFAULT 'Chờ duyệt',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reservations`
--

INSERT INTO `reservations` (`id`, `customer_name`, `customer_email`, `customer_phone`, `reservation_time`, `table_id`, `guests_count`, `notes`, `status`, `created_at`) VALUES
(1, 'test1day', 'test1day@yahoo.com', '01234567189', '2024-11-25 19:00:00', 1, 4, 'den muon do dung doi', 'Hoàn Thành', '2024-11-28 07:11:36'),
(2, 'goi ten em ', 'noibuonsaulang@gmail.com', '0212876512', '2024-11-26 20:00:00', 3, 2, 'tiec sinh nhat cua toi', 'Hủy bàn', '2024-11-28 07:11:36'),
(4, 'tran xuan bach', 'oktest@gmail.com', '09781231123', '2024-12-05 08:59:02', 4, 2, 'cha co gi de notes', 'Hoàn Thành', '2024-12-05 07:59:29'),
(5, 'bxt', 'oktest@gmail.com', '09123123121', '2024-12-06 10:28:34', 1, 2, 'khong co gi ca', 'Hoàn Thành', '2024-12-06 09:28:57'),
(6, 'bach day', 'okmail@gmail.com', '091231312311', '2024-12-06 10:29:06', 5, 2, 'cha co gi de note ca hihi ', 'Hủy bàn', '2024-12-06 09:29:31'),
(7, 'ok ok ok duoc do', 'okmailday@gmail.com', '0132131313123', '2024-12-06 10:29:34', 3, 2, 'cha co gi de note ca huhu hihi hehe', 'Hủy bàn', '2024-12-06 09:30:25'),
(8, 'tran xbach', 'mailsad@gmail.com', '091231312311', '2024-12-06 10:30:26', 6, 2, 'duoc do mot hai ba bon nam sau bay ngay troi', 'Hủy bàn', '2024-12-06 09:31:05'),
(9, 'bach01', 'bach01@gmail.com', '0123123121', '2024-12-07 02:48:59', 1, 3, 'toi se den muon 30p ', 'Đã duyệt', '2024-12-07 01:49:48'),
(10, 'bach02', 'bach02@gmail.com', '01231241231', '2024-12-07 02:49:52', 2, 2, 'o kia con chim hot liu lo', 'Hoàn Thành', '2024-12-07 01:50:16'),
(11, 'bach03', 'bach03@gmail.com', '2312391301312', '2024-12-07 02:50:19', 3, 2, 'danh dau tuy chon lich su xoa sach', 'Chờ duyệt', '2024-12-07 01:51:03'),
(12, 'bach04', 'goitenemtrongdem@gmail.com', '09123138131', '2024-12-07 02:51:05', 4, 5, 'mua dong da vay kin ki niem cua doi minh ', 'Hủy bàn', '2024-12-07 01:51:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `profession`, `content`, `created_at`) VALUES
(1, 'review1', 'Sale', 'đồ ăn ok, phục vụ chuẩn', '2024-11-28 07:11:37'),
(2, 'review2', 'Dev', 'ok day, rat ok, nha hang duoc\r\n', '2024-11-28 07:11:37'),
(3, 'j97', 'Singer', 'thien ly oi, thien ly oi', '2024-12-07 01:41:04'),
(4, 'bbi203', 'Dancer', '1 2 3 4 5 6 7 ngay troi', '2024-12-07 01:41:27'),
(5, 'hereweare', 'Vaccin', 'gucci amiri sao thang cho nay no nhieu qua vay', '2024-12-07 01:42:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tables`
--



--
-- Đang đổ dữ liệu cho bảng `tables`
--

INSERT INTO `tables` (`id`, `capacity`, `zone`, `status`, `created_at`) VALUES
(1, 4, 'trong nhà', 'đã đặt', '2024-11-28 07:11:36'),
(2, 2, 'vip', 'trống', '2024-12-05 08:22:23'),
(3, 2, 'vip', 'trống', '2024-11-28 07:11:36'),
(4, 6, 'trong nhà', 'trống', '2024-11-28 07:11:36'),
(5, 5, 'trong nhà', 'trống', '2024-12-05 04:20:55'),
(6, 2, 'trong nhà', 'trống', '2024-12-05 08:22:06');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `cancellation_reasons`
--
ALTER TABLE `cancellation_reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_id` (`table_id`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `cancellation_reasons`
--
ALTER TABLE `cancellation_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cancellation_reasons`
--
ALTER TABLE `cancellation_reasons`
  ADD CONSTRAINT `cancellation_reasons_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `tables` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

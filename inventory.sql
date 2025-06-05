-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 05, 2025 lúc 07:38 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `inventory`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbcat_customer`
--

CREATE TABLE `tbcat_customer` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `identity_number` varchar(50) NOT NULL,
  `issued_date` date NOT NULL,
  `issued_place` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbcat_product`
--

CREATE TABLE `tbcat_product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbsys_permissions`
--

CREATE TABLE `tbsys_permissions` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbsys_userpermissions`
--

CREATE TABLE `tbsys_userpermissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `can_view` tinyint(1) DEFAULT 0,
  `can_add` tinyint(1) DEFAULT 0,
  `can_edit` tinyint(1) DEFAULT 0,
  `can_delete` tinyint(1) DEFAULT 0,
  `other1` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbsys_users`
--

CREATE TABLE `tbsys_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbsys_users`
--

INSERT INTO `tbsys_users` (`id`, `full_name`, `email`, `phone`, `password_hash`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Phong võ', 'admin@local.com', '', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2025-06-04 14:56:09', '2025-06-04 14:56:17'),
(2, 'Phong võ1', 'admin1@local.com', '0123456789', 'c4ca4238a0b923820dcc509a6f75849b', 1, '2025-06-05 22:44:00', '2025-06-05 22:44:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbtxn_contracts`
--

CREATE TABLE `tbtxn_contracts` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `delivery_address` text NOT NULL,
  `status` enum('Mới ký','Chưa giao','Đã giao','Đã thu đối ứng','Công nợ','Trả đủ') NOT NULL DEFAULT 'Mới ký',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbcat_customer`
--
ALTER TABLE `tbcat_customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbcat_product`
--
ALTER TABLE `tbcat_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbsys_permissions`
--
ALTER TABLE `tbsys_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `tbsys_userpermissions`
--
ALTER TABLE `tbsys_userpermissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Chỉ mục cho bảng `tbsys_users`
--
ALTER TABLE `tbsys_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `tbtxn_contracts`
--
ALTER TABLE `tbtxn_contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_customer` (`customer_id`),
  ADD KEY `contract_product` (`product_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbcat_customer`
--
ALTER TABLE `tbcat_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbcat_product`
--
ALTER TABLE `tbcat_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbsys_permissions`
--
ALTER TABLE `tbsys_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbsys_users`
--
ALTER TABLE `tbsys_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbtxn_contracts`
--
ALTER TABLE `tbtxn_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbsys_userpermissions`
--
ALTER TABLE `tbsys_userpermissions`
  ADD CONSTRAINT `tbsys_userpermissions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbsys_users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbsys_userpermissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `tbsys_permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `tbtxn_contracts`
--
ALTER TABLE `tbtxn_contracts`
  ADD CONSTRAINT `contract_customer` FOREIGN KEY (`customer_id`) REFERENCES `tbcat_customer` (`id`),
  ADD CONSTRAINT `contract_product` FOREIGN KEY (`product_id`) REFERENCES `tbcat_product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

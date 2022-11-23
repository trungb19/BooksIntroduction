-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2022 lúc 04:27 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `books`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `AccountId` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPass` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`AccountId`, `UserID`, `UserEmail`, `UserPass`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hao@gmail.com', '$2y$10$N97Q1lUAoHVro8ImpiVmhOkYXUbEP0.BPdU3BUG460ztRV98Yfr8e', '2022-11-15 09:26:53', '2022-11-15 09:26:53'),
(2, 2, 'Trung@gmail.com', '$2y$10$mAE3BVB.JpPTtisoRl2Ayu9oaq4v8dtecxw4hmKGvnZctwowXDeH6', '2022-11-15 09:27:19', '2022-11-15 09:27:19'),
(5, 5, 'admin@gmail.com', '$2y$10$iTDr5l.EL7LI3byUW5DQ8e.YoxiON2c7xsgoFAyvMv4BiQizR7XtG', '2022-11-20 09:14:52', '2022-11-20 09:14:52'),
(6, 6, 'Trung31102022@gmail.com', '$2y$10$wjfEeyKywus6dXJXCZxKxu1aXjJ5XmjPF3KhK6mQWWGMs3XAvyzPK', '2022-11-21 13:33:27', '2022-11-21 13:33:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bookmark`
--

CREATE TABLE `bookmark` (
  `BookmarkID` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookFavorite` varchar(40) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bookmark`
--

INSERT INTO `bookmark` (`BookmarkID`, `UserID`, `BookFavorite`, `created_at`, `updated_at`) VALUES
('NqBiCgAAQBAJ', 2, 'Blockchain Revolution', '2022-11-23 03:00:04', '2022-11-23 03:00:04'),
('X8oXDAAAQBAJ', 2, 'The Business Blockchain', '2022-11-23 04:25:03', '2022-11-23 04:25:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Permission` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Permission`, `created_at`, `updated_at`) VALUES
(1, 'Pham Nhat Hao', 'user', '2022-11-15 09:26:53', '2022-11-21 03:38:44'),
(2, 'Dang Thanh Trung', 'user', '2022-11-15 09:27:19', '2022-11-15 09:27:19'),
(5, 'admin', 'admin', '2022-11-20 09:14:52', '2022-11-20 09:14:52'),
(6, 'Trung31102022', 'user', '2022-11-21 13:33:27', '2022-11-21 13:33:27');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`BookmarkID`,`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Các ràng buộc cho bảng `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

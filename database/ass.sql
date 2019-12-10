-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 10, 2019 lúc 11:34 AM
-- Phiên bản máy phục vụ: 10.4.8-MariaDB
-- Phiên bản PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ass`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `link1` varchar(1000) DEFAULT NULL,
  `link2` varchar(1000) DEFAULT NULL,
  `link3` varchar(1000) DEFAULT NULL,
  `idSoftware` int(11) NOT NULL,
  `version` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `link`
--

-- INSERT INTO `link` (`id`, `link1`, `link2`, `link3`, `idSoftware`, `version`) VALUES
-- (2, 'https://az764295.vo.msecnd.net/stable/f359dd69833dd8800b54d458f6d37ab7c78df520/VSCodeUserSetup-x64-1.40.2.exe', '', '', 2, '10.8'),
-- (3, 'http://v236.x8top.net/2107tmp/cf/soft/2019/10/ba/5/adobe-illustrator_cc2020-2400330.exe', '', '', 3, 'CC 2020'),
-- (8, 'https://officecdn.microsoft.com/db/492350F6-3A01-4F97-B9C0-C7C6DDF67D60/media/en-US/ProfessionalRetail.img', '', '', 8, '8.0'),
-- (9, 'https://officecdn.microsoft.com/db/492350F6-3A01-4F97-B9C0-C7C6DDF67D60/media/en-US/ProfessionalRetail.img', '', '', 9, '8.0'),
-- (10, 'https://officecdn.microsoft.com/db/492350F6-3A01-4F97-B9C0-C7C6DDF67D60/media/en-US/ProfessionalRetail.img', '', '', 10, '8.0'),
-- (11, 'https://officecdn.microsoft.com/db/492350F6-3A01-4F97-B9C0-C7C6DDF67D60/media/en-US/ProfessionalRetail.img', '', '', 11, '8.0'),
-- (12, 'https://officecdn.microsoft.com/db/492350F6-3A01-4F97-B9C0-C7C6DDF67D60/media/en-US/ProfessionalRetail.img', '', '', 12, '8.0'),
-- (13, 'https://officecdn.microsoft.com/db/492350F6-3A01-4F97-B9C0-C7C6DDF67D60/media/en-US/ProfessionalRetail.img', '', '', 13, '8.0'),
-- (17, 'https://www.webslesson.info/2017/07/live-add-edit-delete-datatables-records-using-php-ajax.html', 'https://www.youtube.com/watch?v=F3hTW9e20d8', '', 16, '9.6'),
-- (20, 'http://demo.webslesson.info/live-datatables-insert-update-delete/', '', '', 2, '8.3'),
-- (21, 'https://www.webslesson.info/2017/07/live-add-edit-delete-datatables-records-using-php-ajax.html', '', '', 2, '9.6'),
-- (22, 'http://localhost:8080/phpmyadmin/sql.php?db=ass&table=link&pos=0', '', '', 2, '8.4'),
-- (23, 'http://localhost:8080/phpmyadmin/sql.php?db=ass&table=link&pos=0', '', '', 2, '7.6'),
-- (24, 'http://localhost:8080/phpmyadmin/sql.php?db=ass&table=link&pos=0', '', '', 2, '8.5'),
-- (25, 'http://localhost:8080/phpmyadmin/sql.php?db=ass&table=link&pos=0', '', '', 2, '9.4'),
-- (26, 'http://localhost:8080/phpmyadmin/sql.php?db=ass&table=link&pos', 'http://localhost:8080/phpmyadmin/sql.php?server=1&db=ass&table=link&pos=0', '', 2, '8.1'),
-- (34, 'https://az764295.vo.msecnd.net/stable/f359dd69833dd8800b54d458f6d37ab7c78df520/VSCodeUserSetup-x64-1.40.2.exe', '', '', 19, '9.4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(10000) DEFAULT NULL,
  `Ltype` varchar(50) NOT NULL,
  `kind` varchar(50) NOT NULL,
  `loc` tinyint(1) NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `software`
--

-- INSERT INTO `software` (`id`, `idUser`, `name`, `description`, `Ltype`, `kind`, `loc`, `image`) VALUES
-- (2, 3, 'Visual', 'Best edit of me', 'Freeware', 'Utilities', 0, 'icon_app/browser_chrome.png'),
-- (3, 3, 'Ai', 'Photoshop :))', 'Trial', 'Utilities', 0, 'icon_app/office.png'),
-- (8, 3, 'Office', 'Word, Excel, Power Point,...', 'Commercial', 'Business', 0, 'icon_app/office_logo.png'),
-- (16, 3, 'Zalo', 'Social Network', 'Commercial', 'Social', 0, 'icon_app/zalo.jpg'),
-- (19, 3, 'Firefox', 'Firefox', 'Freeware', 'Internet', 0, 'icon_app/firefox1.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `loc` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `firstName`, `lastName`, `email`, `loc`) VALUES
(1, 'lasdtiger', '123456', 'value-4', 'value-5', '', 0),
(2, 'nhanvu', '073deebe90916d67db7a2e3ef96c0989', 'VÅ©', 'Tráº§n', 'nhanvu1998@gmail.com', 0),
(3, 'vanson', 'f43939ab30fed8bf0189237677d9076c', 'Thor', 'Jim', 'oncepice1@gmail.com', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSoftware` (`idSoftware`);

--
-- Chỉ mục cho bảng `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `software_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

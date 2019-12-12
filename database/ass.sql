-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2019 at 03:54 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS test;
USE test;
-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(10) NOT NULL,
  `linkWindows` varchar(200) NOT NULL,
  `linkLinux` varchar(200) NOT NULL,
  `linkMac` varchar(200) NOT NULL,
  `idSoftware` int(10) NOT NULL,
  `version` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `linkWindows`, `linkLinux`, `linkMac`, `idSoftware`, `version`) VALUES
(1, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2FChromeStandaloneSetup64.exe', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2Fgoogle-chrome-stable_current_amd64.deb', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2Fgooglechrome.dmg', 1, '78.0.3904.97'),
(2, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2FChromeStandaloneSetup64.exe', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2Fgoogle-chrome-stable_current_amd64.deb', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2Fgooglechrome.dmg', 1, '76.0.3809.100');

-- --------------------------------------------------------

--
-- Table structure for table `software`
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
-- Dumping data for table `software`
--

INSERT INTO `software` (`id`, `idUser`, `name`, `description`, `Ltype`, `kind`, `loc`, `image`) VALUES
(1, 2, 'Google Chrome', 'Google Chrome is a cross-platform web browser developed by Google. It was first released in 2008 for Microsoft Windows, and was later ported to Linux, macOS, iOS, and Android. The browser is also the main component of Chrome OS, where it serves as the platform for web apps.', 'Demo', 'Browser', 0, 'images/browser_chrome.png'),
(22, 2, 'Zalo', 'Zalo is a free message and call application on mobile released on 8 August 2012 for iOS, Android, Windows Phone and Nokia Java. Free messaging (with sharing emotion, images and video) Make free calls (voice and video calls) Share status (comment is only viewable by common friends comments) Make friend Highlights Modify Fast, stable messaging on all 3G, 2.5G, 3G, 4G and WiFi bands. Voice messaging feature in 5 minutes. \"Diary\" function for users to post emotions and upload photos. High security At the end of May, Vietnam Television (VTV) used Zalo as a bridge for the community to share their feelings and thoughts about the island and send messages of encouragement to the people and Soldiers are on duty in Changsha.', 'Freeware', 'Social', 0, 'images/zalo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `loc` tinyint(1) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `firstName`, `lastName`, `email`, `loc`, `isAdmin`) VALUES
(1, 'lasdtiger', '123456', 'value-4', 'value-5', '', 0, 0),
(2, 'nhanvu', '073deebe90916d67db7a2e3ef96c0989', 'VÅ©', 'Tráº§n NhÃ¢n', 'nhanvu1998@gmail.com', 0, 1),
(3, 'vanson', 'f43939ab30fed8bf0189237677d9076c', 'Thor', 'Jim', 'oncepice1@gmail.com', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idSoftware` (`idSoftware`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`idSoftware`) REFERENCES `ass`.`software` (`id`);

--
-- Constraints for table `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `software_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

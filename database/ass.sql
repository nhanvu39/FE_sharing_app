-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2019 at 04:18 PM
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
-- Database: `ass`
--

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `linkDownload` varchar(1000) NOT NULL,
  `kind` varchar(50) NOT NULL,
  `idSoftware` int(11) NOT NULL,
  `version` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `linkDownload`, `kind`, `idSoftware`, `version`) VALUES
(1, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2FChromeStandaloneSetup64.exe', 'windows', 1, '78.0.3904.97'),
(2, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2FChromeStandaloneSetup64.exe', 'windows', 1, '76.0.3809.100'),
(3, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2Fgoogle-chrome-stable_current_amd64.deb', 'linux', 1, '78.0.3904.97'),
(4, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2Fgoogle-chrome-stable_current_amd64.deb', 'linux', 1, '76.0.3809.100'),
(5, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2Fgooglechrome.dmg', 'mac', 1, '78.0.3904.97'),
(6, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2Fgooglechrome.dmg', 'mac', 1, '76.0.3809.100');

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `kind` varchar(50) NOT NULL,
  `loc` tinyint(1) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`id`, `name`, `description`, `kind`, `loc`, `image`, `idUser`) VALUES
(1, 'Chrome', 'Google Chrome is a cross-platform web browser developed by Google. It was first released in 2008 for Microsoft Windows, and was later ported to Linux, macOS, iOS, and Android. The browser is also the main component of Chrome OS, where it serves as the platform for web apps.', 'browser', 0, 'browser_chrome.png', 2),
(2, 'Zalo', 'Zalo is a free message and call application on mobile released on 8 August 2012 for iOS, Android, Windows Phone and Nokia Java. Free messaging (with sharing emotion, images and video) Make free calls (voice and video calls) Share status (comment is only viewable by common friends comments) Make friend Highlights Modify Fast, stable messaging on all 3G, 2.5G, 3G, 4G and WiFi bands. Voice messaging feature in 5 minutes. \"Diary\" function for users to post emotions and upload photos. High security At the end of May, Vietnam Television (VTV) used Zalo as a bridge for the community to share their feelings and thoughts about the island and send messages of encouragement to the people and Soldiers are on duty in Changsha.', 'social', 0, 'zalo.jpg', NULL),
(3, 'Word', 'Microsoft Word (or simply Word) is a word processor developed by Microsoft. It was first released on October 25, 1983 under the name Multi-Tool Word for Xenix systems. Subsequent versions were later written for several other platforms including IBM PCs running DOS (1983), Apple Macintosh running the Classic Mac OS (1985), AT&T Unix PC (1985), Atari ST (1988), OS/2 (1989), Microsoft Windows (1989), SCO Unix (1994), and macOS (formerly OS X; 2001).', 'office', 0, 'office_word.png', NULL),
(4, 'Visual Studio Code', 'Visual Studio Code is a source-code editor developed by Microsoft for Windows, Linux and macOS. It includes support for debugging, embedded Git control and GitHub, syntax highlighting, intelligent code completion, snippets, and code refactoring. It is highly customizable, allowing users to change the theme, keyboard shortcuts, preferences, and install extensions that add additional functionality. The source code is free and open source and released under the permissive MIT License. The compiled binaries are freeware and free for private or commercial use.', 'program', 0, 'Visual.png', NULL);

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
  `loc` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `firstName`, `lastName`, `email`, `loc`) VALUES
(1, 'lasdtiger', '123456', 'value-4', 'value-5', '', 0),
(2, 'nhanvu', '073deebe90916d67db7a2e3ef96c0989', 'VÅ©', 'Tráº§n', 'nhanvu1998@gmail.com', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`idSoftware`) REFERENCES `software` (`id`);

--
-- Constraints for table `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `software_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

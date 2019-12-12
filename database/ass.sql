-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2019 at 04:13 PM
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
  `id` int(10) NOT NULL,
  `linkWindows` varchar(500) NOT NULL,
  `linkLinux` varchar(500) NOT NULL,
  `linkMac` varchar(500) NOT NULL,
  `idSoftware` int(10) NOT NULL,
  `version` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `link`
--

INSERT INTO `link` (`id`, `linkWindows`, `linkLinux`, `linkMac`, `idSoftware`, `version`) VALUES
(1, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2FChromeStandaloneSetup64.exe', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2Fgoogle-chrome-stable_current_amd64.deb', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F78.0.3904.97%2Fgooglechrome.dmg', 1, '78.0.3904.97'),
(2, 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2FChromeStandaloneSetup64.exe', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2Fgoogle-chrome-stable_current_amd64.deb', 'https://www.slimjet.com/chrome/download-chrome.php?file=files%2F76.0.3809.100%2Fgooglechrome.dmg', 1, '76.0.3809.100'),
(7, 'https://res-update-pc-te-vnso-zn-17.zadn.vn/hybrid/ZaloSetup-19.11.3a.exe?fbclid=IwAR0BhVC_t9fvVW9RCDP2vue5ncDtOzgBaDBYoc_2rs9DgwDcERuWlsVLS_M', 'fb.com', 'https://res-download-pc-te-vnso-pt-8.zadn.vn/mac/ZaloSetup-19.11.3a.dmg', 22, '19.11.3a'),
(8, 'https://files02.tchspt.com/storage2/temp/FirefoxSetup71.0x64.exe', 'https://files02.tchspt.com/storage2/temp/firefox-71.0x86_64.tar.bz2', 'https://download-installer.cdn.mozilla.net/pub/firefox/releases/71.0/mac/en-US/Firefox%2071.0.dmg', 23, '71.0'),
(9, 'https://net.geo.opera.com/opera/stable/windows?utm_tryagain=yes&utm_source=google_via_opera_com&utm_medium=ose&utm_campaign=(none)_via_opera_com_https&http_referrer=https%3A%2F%2Fwww.google.com%2F&utm_site=opera_com&utm_lastpage=opera.com/download&dl_token=41993614', 'https://download3.operacdn.com/pub/opera/desktop/65.0.3467.69/linux/opera-stable_65.0.3467.69_amd64.deb', 'https://net.geo.opera.com/opera/stable/mac?utm_tryagain=yes&utm_source=google_via_opera_com&utm_medium=ose&utm_campaign=(none)_via_opera_com_https&http_referrer=https%3A%2F%2Fwww.google.com%2F&utm_site=opera_com&utm_lastpage=opera.com/&dl_token=78319502', 24, '65.0.3467.69'),
(10, 'https://az764295.vo.msecnd.net/stable/f359dd69833dd8800b54d458f6d37ab7c78df520/VSCodeUserSetup-ia32-1.40.2.exe', 'https://az764295.vo.msecnd.net/stable/f359dd69833dd8800b54d458f6d37ab7c78df520/code_1.40.2-1574694120_amd64.deb', 'https://az764295.vo.msecnd.net/stable/f359dd69833dd8800b54d458f6d37ab7c78df520/VSCode-darwin-stable.zip', 26, '1.40.2');

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
(22, 2, 'Zalo', 'Zalo is a free message and call application on mobile released on 8 August 2012 for iOS, Android, Windows Phone and Nokia Java. Free messaging (with sharing emotion, images and video) Make free calls (voice and video calls) Share status (comment is only viewable by common friends comments) Make friend Highlights Modify Fast, stable messaging on all 3G, 2.5G, 3G, 4G and WiFi bands. Voice messaging feature in 5 minutes. \"Diary\" function for users to post emotions and upload photos. High security At the end of May, Vietnam Television (VTV) used Zalo as a bridge for the community to share their feelings and thoughts about the island and send messages of encouragement to the people and Soldiers are on duty in Changsha.', 'Freeware', 'Social', 0, 'images/zalo.jpg'),
(23, 1, 'Firefox', 'Mozilla Firefox, Firefox Browser, or simply Firefox, is a free and open-source web browser developed by the Mozilla Foundation and its subsidiary, Mozilla Corporation. Firefox uses the Gecko layout engine to render web pages, which implements current and anticipated web standards. In 2017, Firefox began incorporating new technology under the code name Quantum to promote parallelism and a more intuitive user interface. Firefox is officially available for Windows 7 or newer, macOS and Linux; its unofficial ports are available for various Unix and Unix-like operating systems including FreeBSD, OpenBSD, NetBSD, illumos and Solaris Unix. Firefox is also available for Android and iOS, however the iOS version uses the WebKit layout engine instead of Gecko due to platform limitations, as with all other iOS web browsers.', 'Freeware', 'Browser', 0, 'images/browser/firefox1.png'),
(24, 3, 'Opera', 'Opera is a freeware web browser for Microsoft Windows, Android, iOS, macOS, and Linux operating systems, developed by Opera Software. Opera is a Chromium-based browser using the Blink layout engine. It differentiates itself because of a distinct user interface and other features.', 'Freeware', 'Browser', 0, 'images/browser/opera1.png'),
(25, 2, 'Word', 'Microsoft Word (or simply Word) is a word processor developed by Microsoft. It was first released on October 25, 1983 under the name Multi-Tool Word for Xenix systems. Subsequent versions were later written for several other platforms including IBM PCs running DOS (1983), Apple Macintosh running the Classic Mac OS (1985), AT&T Unix PC (1985), Atari ST (1988), OS/2 (1989), Microsoft Windows (1989), SCO Unix (1994), and macOS (formerly OS X; 2001).', 'Freeware', 'Office', 0, 'images/office_word.png'),
(26, 2, 'Visual Studio Code', 'Visual Studio Code is a source-code editor developed by Microsoft for Windows, Linux and macOS. It includes support for debugging, embedded Git control and GitHub, syntax highlighting, intelligent code completion, snippets, and code refactoring. It is highly customizable, allowing users to change the theme, keyboard shortcuts, preferences, and install extensions that add additional functionality. The source code is free and open source and released under the permissive MIT License. The compiled binaries are freeware and free for private or commercial use.', 'Freeware', 'Editor', 0, 'images/Visual.png');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2024 at 10:05 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bilit`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `name`) VALUES
(1, 'کوپه ای 6 نفره'),
(2, 'سالنی 4 ردیفه'),
(3, 'کوپه ای 4 نفره');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE `reserve` (
  `rid` int(10) UNSIGNED NOT NULL,
  `userid` int(11) NOT NULL,
  `ticketid` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(10) UNSIGNED NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `capacity` int(11) NOT NULL,
  `orgin` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `starttime` varchar(255) DEFAULT NULL,
  `startdate` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `company`, `catid`, `price`, `capacity`, `orgin`, `destination`, `starttime`, `startdate`, `pic`, `created_at`) VALUES
(1, 'رجا', 2, 1200000, 350, 'تهران', 'مشهد', '20:30', '1402/02/26', 'd964f75346ab5dae.jpg', 1662813289),
(2, 'رجا', 3, 240000, 500, 'مشهد', 'تهران', '21:30', '1402/02/19', 'z22.ae32cd1.jpg', 1662813762),
(3, 'فدک', 3, 180000, 0, 'مشهد', 'تهران', '15:30', '1402/01/22', 'c4bdb94ce5ef76f3.jpg', 1662822050);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `family` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `per` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `password`, `email`, `mobile`, `per`, `created_at`) VALUES
(1, 'حامد ', 'رحیمی', 'e10adc3949ba59abbe56e057f20f883e', 'hamedrahimi2405@gmail.com', '09212112581', 1, 1662809211),
(2, 'مهدی', ' رسولی', '6512bd43d9caa6e02c990b0a82652dca', 'mmrasouli1381@gmail.com', '09399588872', 0, 1689754166);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `rid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

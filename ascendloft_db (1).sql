-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2023 at 08:57 AM
-- Server version: 5.7.42
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ascendloft_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_work`
--

CREATE TABLE `additional_work` (
  `id` int(11) NOT NULL,
  `repack_id` int(10) NOT NULL,
  `work_order` int(10) NOT NULL,
  `qbcode` varchar(100) DEFAULT NULL,
  `description` longtext,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `containers`
--

CREATE TABLE `containers` (
  `id` int(10) NOT NULL,
  `customer` int(10) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `serial` varchar(100) DEFAULT NULL,
  `dom` varchar(100) DEFAULT NULL,
  `aad` varchar(100) NOT NULL,
  `aad_serial` varchar(100) DEFAULT NULL,
  `aad_install` date DEFAULT NULL,
  `aad_next_maintenance` date DEFAULT NULL,
  `aad_eol` date DEFAULT NULL,
  `reserve` varchar(100) NOT NULL,
  `reserve_size` int(4) DEFAULT NULL,
  `reserve_serial` varchar(100) DEFAULT NULL,
  `main` varchar(100) DEFAULT NULL,
  `main_size` int(4) DEFAULT NULL,
  `main_serial` varchar(100) DEFAULT NULL,
  `notes` text,
  `next_repack` date DEFAULT NULL,
  `enter_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company` text,
  `address` text,
  `address_2` text,
  `city` text,
  `state` text,
  `zip` varchar(20) DEFAULT NULL,
  `country` text,
  `email` text NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `sponsor` text,
  `notes` text,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `active` char(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `company`, `address`, `address_2`, `city`, `state`, `zip`, `country`, `email`, `phone`, `sponsor`, `notes`, `password`, `type`, `active`, `last_login`) VALUES
(1, 'Ian', 'Halliday', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ian@ndevix.com', '7086993654', NULL, NULL, '$2y$10$zrPKzAr4LFYsRe/dCoiPjevxKtAAbEucK1RisVRQw/AY/O1PClrq6', 'customer', '1', NULL),
(2, 'Matt', 'Smith', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mattericsmith@yahoo.com', '6308852365', NULL, NULL, '$2y$10$sq94uuoHeE0EheyTf51W8Oed5f1joyCcrOFQ3iNvkmuc5TyPgZNHS', 'customer', '1', NULL),
(3, 'James', 'Spencer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'spencer6524@gmail.com', '16302630806', NULL, NULL, '$2y$10$MLTc12Tryia27x6Y09wjSOfR9iwZYN3nM1rACRuUyn47Iv9yLqt5u', 'customer', '1', NULL),
(4, 'Mariusz', 'Filonowicz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sargebucky@comcast.net', '7732189647', NULL, NULL, '$2y$10$rgHJ9zn7/jMt7Ot0oBnyXOouXbZyzQFZwd40hHRlBbd5hYIUabWJy', 'customer', '1', NULL),
(6, 'Al', 'Aninon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nixer@ndevix.com', NULL, NULL, NULL, '$2y$10$9SpXEOMU0nx4oMGO7eAz9OvDmZkzoAC8.Kah03ZNTov5iad8qBtAe', 'customer', '1', '2023-06-26 12:36:47'),
(7, 'Dave', 'Singer', 'ASCEND PARACHUTE SERVICES, INC', '1207 West Gurler Road', '2nd Floor CSC hangar', 'ROCHELLE', 'IL', '61068', 'United States', 'dave@ascendrigging.com', '8134699355', '', '', '$2y$10$IE3/qPvDg9b4eV2KbEWAo.kR3QZ2sk8eWFlY5nyi.JaswCp0hXc9K', 'customer', '1', '2023-06-26 04:54:59'),
(17, 'John', 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dj_drumfire@mac.com', '834020002', NULL, NULL, '$2y$10$5fHeDCJpsi.QrHrHDaiML.dFoWtcFuty4a//p39nDL88MlM6NiAtC', 'customer', '1', '2023-06-26 12:35:55'),
(20, 'irawan', 'irawan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'irawan.wijanarko@gmail.com', '0', NULL, NULL, '$2y$10$goB1YiRNP7LuPpsPFnloSutf8nh/.66UPOkBjTiZe9DVBhRsyGs.G', 'customer', '1', '2023-06-27 08:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) NOT NULL,
  `project` int(10) NOT NULL,
  `step` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `private` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repacks`
--

CREATE TABLE `repacks` (
  `id` int(10) NOT NULL,
  `work_order` int(10) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `customer` int(10) DEFAULT NULL,
  `container` int(10) NOT NULL,
  `status` varchar(100) NOT NULL,
  `schedule_date` datetime DEFAULT NULL,
  `dropoff_date` datetime DEFAULT NULL,
  `speed` varchar(100) DEFAULT NULL,
  `estimated_pickup` datetime NOT NULL,
  `completed` datetime DEFAULT NULL,
  `notes` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `repack_log`
--

CREATE TABLE `repack_log` (
  `id` int(10) NOT NULL,
  `user` int(10) NOT NULL,
  `repack` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `action` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bpass` text,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `active` int(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `bpass`, `first_name`, `last_name`, `phone`, `type`, `last_login`, `active`, `created`) VALUES
(1, 'ihalliday@ndevix.com', '$2y$10$uwucaDxO2t.AUvE9u17Uju/GkEYpW/wEea6oQ5VwYIGtafxAbvoBq', '', 'Ian', '', '7086993654', 'admin', '2023-06-27 08:47:42', 1, '2023-04-05 17:53:03'),
(2, 'dave@ascendrigging.com', '$2y$10$7yix1I6gkqkIBSNEqpc9IejXttLiCwgxX.YD0NwXuj0sDA2H3ovVa', 'cawcaw1234', 'Dave', 'Dave', '8134699355', 'admin', '2023-06-26 12:14:53', 1, '2023-05-31 06:23:40'),
(3, 'nixer@ndevix.com', '$2y$10$9SpXEOMU0nx4oMGO7eAz9OvDmZkzoAC8.Kah03ZNTov5iad8qBtAe', '', 'Al', 'Aninon', '8889788463', 'admin', '2023-06-26 12:12:06', 1, '2023-06-22 09:39:27'),
(4, 'irawan.wijanarko@gmail.com', '$2y$10$w4Ag19gvHOwNWPANDeP5v.SYFsKhtHcQ67NNg2A//AYrT4s4ZNpgm', '123', 'Irawan', 'Irawan', '6285727998747', 'admin', '2023-06-27 08:54:10', 1, '2023-06-21 20:41:56'),
(5, 'ian@ndevix.com', '$2y$10$zrPKzAr4LFYsRe/dCoiPjevxKtAAbEucK1RisVRQw/AY/O1PClrq6', '', 'Ian', 'Halliday', '7086993654', 'customer', '2023-06-25 02:04:18', 0, '2023-04-06 15:42:54'),
(8, 'mattericsmith@yahoo.com', '$2y$10$sq94uuoHeE0EheyTf51W8Oed5f1joyCcrOFQ3iNvkmuc5TyPgZNHS', '', 'Matt', 'Smith', '6308852365', 'customer', '2023-05-28 11:15:06', 0, '2023-05-28 11:15:06'),
(9, 'spencer6524@gmail.com', '$2y$10$MLTc12Tryia27x6Y09wjSOfR9iwZYN3nM1rACRuUyn47Iv9yLqt5u', '', 'James', 'Spencer', '16302630806', 'customer', '2023-05-30 12:14:10', 0, '2023-05-30 12:14:10'),
(10, 'sargebucky@comcast.net', '$2y$10$rgHJ9zn7/jMt7Ot0oBnyXOouXbZyzQFZwd40hHRlBbd5hYIUabWJy', '', 'Mariusz', 'Filonowicz', '7732189647', 'customer', '2023-06-13 09:57:10', 0, '2023-06-13 09:57:10'),
(11, 'test@mail.com', '$2y$10$NcY8/14N5qJlOmoQNVcRheLrumLDk4tJNDTBLcBIIjqC2LGlcasJu', 'qwerty', 'test', 'test', '0', 'admin', '2023-06-27 08:50:29', 0, '2023-06-27 08:48:24');

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE `work_orders` (
  `id` int(10) NOT NULL,
  `customer` int(10) DEFAULT NULL,
  `container` int(10) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `schedule_date` datetime DEFAULT NULL,
  `dropoff_date` datetime DEFAULT NULL,
  `estimated_pickup` datetime DEFAULT NULL,
  `completion_date` datetime DEFAULT NULL,
  `notes` text NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `initial_price` decimal(10,2) DEFAULT NULL,
  `paid` decimal(10,2) DEFAULT NULL,
  `additional_cost` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_work`
--
ALTER TABLE `additional_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `containers`
--
ALTER TABLE `containers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repacks`
--
ALTER TABLE `repacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repack_log`
--
ALTER TABLE `repack_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_work`
--
ALTER TABLE `additional_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `containers`
--
ALTER TABLE `containers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repacks`
--
ALTER TABLE `repacks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repack_log`
--
ALTER TABLE `repack_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `work_orders`
--
ALTER TABLE `work_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

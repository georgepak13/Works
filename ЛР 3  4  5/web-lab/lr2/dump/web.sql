-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2023 at 05:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--

DROP DATABASE IF EXISTS web;
CREATE DATABASE web;
USE web;

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`id`, `name`) VALUES
(1, 'Main Campus'),
(2, 'North Campus'),
(3, 'South Campus'),
(4, 'East Campus'),
(5, 'West Campus');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `number` varchar(100) DEFAULT NULL,
  `campus` int(11) NOT NULL,
  `furniture` text NOT NULL,
  `students` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `photo`, `number`, `campus`, `furniture`, `students`) VALUES
(1, 'classroom1.jpg', '101', 1, 'Desks, Chairs, Whiteboard', 30),
(2, 'classroom2.jpg', '201', 2, 'Tables, Chairs, Projector', 25),
(3, 'classroom3.jpg', '301', 1, 'Desks, Chairs, Smartboard', 35),
(4, 'classroom4.jpg', '102', 3, 'Tables, Chairs, Whiteboard', 40),
(5, 'classroom5.jpg', '202', 4, 'Desks, Chairs, Projector', 28),
(6, 'classroom6.jpg', '302', 2, 'Tables, Chairs, Smartboard', 32),
(7, 'classroom7.jpg', '103', 5, 'Desks, Chairs, Whiteboard', 22),
(8, 'classroom8.jpg', '203', 3, 'Tables, Chairs, Projector', 33),
(9, 'classroom9.jpg', '303', 4, 'Desks, Chairs, Smartboard', 26),
(10, 'classroom10.jpg', '104', 1, 'Desks, Chairs, Whiteboard', 31),
(11, 'classroom11.jpg', '204', 2, 'Tables, Chairs, Projector', 29),
(12, 'classroom12.jpg', '304', 5, 'Desks, Chairs, Smartboard', 36),
(13, 'classroom13.jpg', '105', 3, 'Desks, Chairs, Whiteboard', 27),
(14, 'classroom14.jpg', '205', 4, 'Tables, Chairs, Projector', 38),
(15, 'classroom15.jpg', '305', 1, 'Desks, Chairs, Smartboard', 24),
(16, 'classroom16.jpg', '106', 2, 'Tables, Chairs, Whiteboard', 34),
(17, 'classroom17.jpg', '206', 3, 'Desks, Chairs, Projector', 37),
(18, 'classroom18.jpg', '306', 4, 'Tables, Chairs, Smartboard', 23),
(19, 'classroom19.jpg', '107', 5, 'Desks, Chairs, Whiteboard', 39),
(20, 'classroom20.jpg', '207', 1, 'Tables, Chairs, Projector', 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campus` (`campus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`campus`) REFERENCES `campus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

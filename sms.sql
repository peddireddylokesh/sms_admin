-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2022 at 07:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` enum('ADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `user_id`, `password`, `account_type`) VALUES
(1, 'admin', 'admin@admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('MALE','FEMALE','OTHER') DEFAULT NULL,
  `dob` date NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `center_code` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `course` varchar(255) NOT NULL,
  `admission_number` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `dob`, `mobile_number`, `state`, `city`, `img`, `center_code`, `registration_date`, `course`, `admission_number`, `batch`, `created_at`, `updated_at`) VALUES
(15, 'derftgyhuj', 'MALE', '2022-09-22', '1234567890', 'ap', 'vskp', '60040- ', '123654', '2022-09-22', 'eee', '6288', '2014-15', '2022-09-22 12:54:11', '2022-09-22 18:55:13'),
(20, 'loki', 'MALE', '2022-09-22', '1234567890', 'ap', 'vskp', '62395-graduate-student-5748686-4800729.jpg ', '12345214', '2022-09-22', 'eee', '1234', '2017-18', '2022-09-22 16:29:22', '2022-09-22 18:54:50'),
(24, 'naga', 'MALE', '2022-09-23', '111111111', 'ap', 'vskp', '76518-graduate-student-5748686-4800729.jpg ', 'q', '2022-09-23', 'qqq', '12343456789', '2011-12', '2022-09-22 18:43:44', '2022-09-22 18:50:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_number` (`admission_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

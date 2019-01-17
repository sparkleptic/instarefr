-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 18, 2016 at 04:20 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instarefr`
--

-- --------------------------------------------------------

--
-- Table structure for table `insta_job_category`
--

CREATE TABLE `insta_job_category` (
  `insta_job_category_id` int(11) NOT NULL,
  `insta_job_category` varchar(225) NOT NULL,
  `insta_job_category_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `insta_job_category`
--

INSERT INTO `insta_job_category` (`insta_job_category_id`, `insta_job_category`, `insta_job_category_status`) VALUES
(1, 'Sales&Marketing', 1),
(2, 'IT', 1),
(3, 'Human Resource', 1),
(4, 'Operations', 1),
(5, 'Core Engineering', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `insta_job_category`
--
ALTER TABLE `insta_job_category`
  ADD PRIMARY KEY (`insta_job_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `insta_job_category`
--
ALTER TABLE `insta_job_category`
  MODIFY `insta_job_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

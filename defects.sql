-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2021 at 10:15 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fluid_control`
--

-- --------------------------------------------------------

--
-- Table structure for table `defects`
--

CREATE TABLE `defects` (
  `id` int(11) NOT NULL,
  `defect_name` text NOT NULL,
  `part_name` text NOT NULL,
  `found_by` text NOT NULL,
  `assigned_to` text NOT NULL,
  `found_on` date NOT NULL,
  `due_date` date NOT NULL,
  `description` text NOT NULL,
  `sol_status` int(11) DEFAULT NULL,
  `defect_status` varchar(255) DEFAULT NULL,
  `rejected_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `defects`
--

INSERT INTO `defects` (`id`, `defect_name`, `part_name`, `found_by`, `assigned_to`, `found_on`, `due_date`, `description`, `sol_status`, `defect_status`, `rejected_count`) VALUES
(11, 'cvgt', 'brgr', '4', '1', '2021-10-23', '2021-10-24', 'qsdfvgbnmkjhgvc', 1, 'ACCEPTED_1', NULL),
(12, 'ghjy', 'fgr', '4', '1', '2021-10-24', '2021-10-24', 'dswfedfdee', 0, '', 0),
(13, 'vgru', 'dfed', '4', '1', '2021-10-23', '2021-10-31', 'djkhfrhgijfeklvde', 1, 'REJECTED_1', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `defects`
--
ALTER TABLE `defects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `defects`
--
ALTER TABLE `defects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

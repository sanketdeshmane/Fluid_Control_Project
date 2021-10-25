-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 05:41 PM
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
-- Table structure for table `con_dept`
--

CREATE TABLE `con_dept` (
  `id` int(11) NOT NULL,
  `emp_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `con_dept`
--

INSERT INTO `con_dept` (`id`, `emp_name`, `email`, `password`) VALUES
(1, 'ayushi', 'w@b.c', '202cb962ac59075b964b07152d234b70'),
(3, 'shree', 's@j.k', '202cb962ac59075b964b07152d234b70'),
(6, 'usopp', 'gawandeshrinidhi@gmail.com', '202cb962ac59075b964b07152d234b70');

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
  `defect_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `defects`
--

INSERT INTO `defects` (`id`, `defect_name`, `part_name`, `found_by`, `assigned_to`, `found_on`, `due_date`, `description`, `defect_status`) VALUES
(33, 'turbine', 'motor', '4', '6', '2021-10-25', '2021-10-26', 'sjfiorehgkfdgjbthtefhf', 'ACCEPTED_1'),
(34, 'sdgth', 'tgdbgvd', '4', '6', '2021-10-25', '2021-10-26', 'awfaegbde', NULL),
(35, 'cxvdfnb', 'fdbfc ', '4', '6', '2021-10-26', '2021-10-26', 'ascdgevewger', 'SUBMITTED'),
(36, 'vcbdfhrf', 'fbf', '4', '6', '2021-10-25', '2021-10-26', 'qwertyuytg', 'ACCEPTED_1'),
(37, 'tdbghfn', 'motec', '4', '6', '2021-10-25', '2021-10-26', 'wdewtryj4etf', 'ACCEPTED_1'),
(38, 'fdgdtfh', 'dfgbf', '4', '6', '2021-10-25', '2021-10-26', 'festgerg', 'ACCEPTED_1');

-- --------------------------------------------------------

--
-- Table structure for table `quality_control`
--

CREATE TABLE `quality_control` (
  `id` int(11) NOT NULL,
  `emp_name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quality_control`
--

INSERT INTO `quality_control` (`id`, `emp_name`, `email`, `password`) VALUES
(1, 'suru', 's@b.c', '202cb962ac59075b964b07152d234b70'),
(3, 'abc', 'a@b.c', '202cb962ac59075b964b07152d234b70'),
(4, 'luffy', 'onepiece@gmail.com', '202cb962ac59075b964b07152d234b70'),
(5, 'zoro', 'zoro@g.c', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `id` int(11) NOT NULL,
  `defect_id` int(11) NOT NULL,
  `solution` text NOT NULL,
  `attachment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solution`
--

INSERT INTO `solution` (`id`, `defect_id`, `solution`, `attachment`) VALUES
(43, 38, 'Uploaded File', 'Project Certificate.pdf'),
(44, 37, 'fvdrhbdgtng', 'Project Certificate.pdf'),
(45, 36, 'Uploaded File', 'FTR 1.pptx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `con_dept`
--
ALTER TABLE `con_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `defects`
--
ALTER TABLE `defects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quality_control`
--
ALTER TABLE `quality_control`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solution` (`defect_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `con_dept`
--
ALTER TABLE `con_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `defects`
--
ALTER TABLE `defects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `quality_control`
--
ALTER TABLE `quality_control`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `solution`
--
ALTER TABLE `solution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `solution`
--
ALTER TABLE `solution`
  ADD CONSTRAINT `solution` FOREIGN KEY (`defect_id`) REFERENCES `defects` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

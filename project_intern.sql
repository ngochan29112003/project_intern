-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2024 at 11:30 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `salary_id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `salary_coefficient` float DEFAULT NULL,
  `allowance_salary_coefficient` float DEFAULT NULL,
  `gross_salary` float DEFAULT NULL,
  `social_insurance` float DEFAULT NULL,
  `health_insurance` float DEFAULT NULL,
  `accident_insurance` float DEFAULT NULL,
  `net_salary` float DEFAULT NULL,
  `description_salary` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `employee_id`, `salary_coefficient`, `allowance_salary_coefficient`, `gross_salary`, `social_insurance`, `health_insurance`, `accident_insurance`, `net_salary`, `description_salary`) VALUES
(1, 16, 3, NULL, 7020000, 561600, 105300, 70200, 6282900, NULL),
(2, 15, 3, NULL, 7020000, 561600, 105300, 70200, 6282900, NULL),
(3, 14, 3, NULL, 7020000, 561600, 105300, 70200, 6282900, NULL),
(4, 13, 3, 0.2, 7488000, 599040, 112320, 74880, 6701760, NULL),
(5, 12, 2.34, NULL, 5475600, 438048, 82134, 54756, 4900660, NULL),
(6, 11, 2.34, NULL, 5475600, 438048, 82134, 54756, 4900660, NULL),
(7, 10, 2.34, NULL, 5475600, 438048, 82134, 54756, 4900660, NULL),
(8, 8, 2.34, NULL, 5475600, 438048, 82134, 54756, 4900660, NULL),
(9, 6, 3.66, NULL, 8564400, 685152, 128466, 85644, 7665140, NULL),
(10, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

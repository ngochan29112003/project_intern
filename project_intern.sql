-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2024 at 07:04 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.25

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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` text,
  `password` text,
  `permission` int(11) DEFAULT NULL,
  `id_employee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `permission`, `id_employee`) VALUES
(4, 'admindt', '$2y$10$brX2LMOYrEUiyX4oZlsiBukDELfme0qz/vQYUFaLlmp07F0JTMCxC', 1, 4),
(5, 'tuananh', '$2y$10$8De1cXl/xP/57bwzEyyNreRB.KHGNejngp1OZDpV15ARu/.xm4ary', 1, 5),
(6, 'ngochan', '$2y$10$iRR0RHFnkm.3K1R5FO3ZDeC6iygS0fjNYXW1hLv0Wf9.GJCtuv3Z.', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `phone_number` text NOT NULL,
  `email` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `phone_number`, `email`, `employee_id`, `address`, `project_id`) VALUES
(1, 'hana', '543', 'dasds', 1, 'dfsdf', 0),
(4, '231', '543', 'dasds', 3, 'dfsdf', 1),
(5, '231', '312', '3213', 3, 'dfsdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_code` text,
  `department_name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_code`, `department_name`) VALUES
(5, 'NE', 'Network Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `discipline_id` int(11) NOT NULL,
  `discipline_code` varchar(50) NOT NULL,
  `discipline_name` varchar(100) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`discipline_id`, `discipline_code`, `discipline_name`, `employee_id`, `description`) VALUES
(1, '2132', '3213', 231, ''),
(2, '4', '3213', 7, 'rew');

-- --------------------------------------------------------

--
-- Table structure for table `education_level`
--

CREATE TABLE `education_level` (
  `education_level_id` int(11) NOT NULL,
  `education_level_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `education_level`
--

INSERT INTO `education_level` (`education_level_id`, `education_level_name`) VALUES
(1, 'College'),
(2, 'University'),
(3, 'High School'),
(4, 'Secondary School'),
(5, 'Primary School');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` text,
  `img` text,
  `gender` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` text,
  `id_card_number` int(20) DEFAULT NULL,
  `education_level_id` int(11) NOT NULL,
  `status` text,
  `type_employee_id` int(11) DEFAULT NULL,
  `job_position_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `img`, `gender`, `birth_date`, `birth_place`, `id_card_number`, `education_level_id`, `status`, `type_employee_id`, `job_position_id`) VALUES
(3, 'abc', 'avt.png', 0, '2024-08-02', '123', 1233, 4, '1', 2, 3),
(4, 'admin dep trai', 'avt.png', 0, '2024-08-18', '1', 1, 4, '1', 3, 3),
(6, 'Hanaa Nhe', '1722879167_310066267_184130727510201_3026934422886984661_n.jpg', 1, '2003-11-29', 'BVDK VL', 4444, 2, '1', 3, 3),
(7, 'ewqew', 'avt.png', 1, '2024-08-16', 'ewqe', 43243, 3, '1', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

CREATE TABLE `job_positions` (
  `job_position_id` int(11) NOT NULL,
  `job_position_code` varchar(50) NOT NULL,
  `job_position_name` varchar(100) NOT NULL,
  `job_position_salary` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_positions`
--

INSERT INTO `job_positions` (`job_position_id`, `job_position_code`, `job_position_name`, `job_position_salary`, `description`) VALUES
(3, 'NIS', 'Network Infrastructure Specialist', '100999', 'không có'),
(4, '3213', '231', '213', '231'),
(5, 'rewrew', '2312', '32132', 'ewqew');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `payroll_code` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `monthly_salary` text NOT NULL,
  `work_days` int(11) NOT NULL,
  `net_salary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `payroll_code`, `employee_id`, `position_id`, `monthly_salary`, `work_days`, `net_salary`) VALUES
(2, '321', 3213, 32131, '321312', 321312, '321'),
(3, '2', 321, 231, '2', 2, 'dsad'),
(4, 'rewr', 12, 3213, '213', 3213, 'dsadas');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(11) NOT NULL,
  `project_code` text NOT NULL,
  `project_name` text NOT NULL,
  `status` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `emloyee_id` int(11) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_code`, `project_name`, `status`, `customer_id`, `emloyee_id`, `start_date`, `end_date`) VALUES
(2, 'dsa', 'dsa', 'dsa', 2, 3, '23/1/2024', '3/10/2024'),
(3, '2e322', '23423', '342', 1, 1, '2024-08-09', '2024-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `rewards_id` int(11) NOT NULL,
  `reward_code` text NOT NULL,
  `reward_name` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`rewards_id`, `reward_code`, `reward_name`, `employee_id`, `description`) VALUES
(1, '213', '2231', 231, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salary_calculation`
--

CREATE TABLE `salary_calculation` (
  `salary_calculation_id` int(11) NOT NULL,
  `payroll_code` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `work_days` int(11) NOT NULL,
  `allowance` text NOT NULL,
  `advance` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id_task` int(11) NOT NULL,
  `task_code` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `purpose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id_task`, `task_code`, `employee_id`, `start_date`, `end_date`, `location`, `purpose`) VALUES
(2, '32312', 3213, '2024-08-15', '2024-08-21', '3213', '21323'),
(3, 'edwqew', 3213, '2024-08-10', '2024-08-29', 'ưqew', 'eqwe');

-- --------------------------------------------------------

--
-- Table structure for table `type_employees`
--

CREATE TABLE `type_employees` (
  `type_employee_id` int(11) NOT NULL,
  `type_employee_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_employees`
--

INSERT INTO `type_employees` (`type_employee_id`, `type_employee_name`) VALUES
(1, 'Part time'),
(2, 'Intern'),
(3, 'official staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`discipline_id`);

--
-- Indexes for table `education_level`
--
ALTER TABLE `education_level`
  ADD PRIMARY KEY (`education_level_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `job_positions`
--
ALTER TABLE `job_positions`
  ADD PRIMARY KEY (`job_position_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`rewards_id`);

--
-- Indexes for table `salary_calculation`
--
ALTER TABLE `salary_calculation`
  ADD PRIMARY KEY (`salary_calculation_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id_task`);

--
-- Indexes for table `type_employees`
--
ALTER TABLE `type_employees`
  ADD PRIMARY KEY (`type_employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `discipline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `education_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `job_position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `rewards_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salary_calculation`
--
ALTER TABLE `salary_calculation`
  MODIFY `salary_calculation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_employees`
--
ALTER TABLE `type_employees`
  MODIFY `type_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2024 at 09:04 PM
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
(6, 'ngochan', '$2y$10$iRR0RHFnkm.3K1R5FO3ZDeC6iygS0fjNYXW1hLv0Wf9.GJCtuv3Z.', 1, 6),
(7, 'admin', '$2y$10$5BulCzwUQ0IJX2H7OPZBi.H5nIPT7.AVVZVhE18QXTBweDhndtaoO', 2, 8);

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
  `action_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`discipline_id`, `discipline_code`, `discipline_name`, `employee_id`, `action_id`, `description`) VALUES
(1, '2132', '3213', 231, 0, ''),
(2, '4', '3213', 7, 0, 'rew');

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
  `last_name` text,
  `first_name` text,
  `img` text,
  `gender` int(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` text,
  `place_of_resident` text,
  `email` text,
  `permanent_address` text,
  `cic_number` int(20) DEFAULT NULL,
  `education_level_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `type_employee_id` int(11) DEFAULT NULL,
  `job_position_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `last_name`, `first_name`, `img`, `gender`, `birth_date`, `birth_place`, `place_of_resident`, `email`, `permanent_address`, `cic_number`, `education_level_id`, `status`, `type_employee_id`, `job_position_id`) VALUES
(6, 'Ngọc Hân', 'Lê', '1723383903_z4267405085287_894fee42d649fcc4dd0057af55628d87.jpg', 1, '2003-11-29', 'Vĩnh Long', NULL, 'ngochan@gmail.com', 'VL', 1234567890, 2, 0, 1, 3),
(8, 'Admin', 'Account', '1723384561_jichangwook_1618310272_2550893909509181281_550618621.jpg', 0, '2003-09-24', 'Kiên Giang', NULL, 'account@gmail.com', 'RG', 123, 2, 1, 1, 3),
(10, 'anh', 'tuấn', 'avt.png', 1, '2024-08-01', 'Kiên Giang', NULL, 'tuananh@gmail.com', 'abc', 123, 2, 0, 3, 3);

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
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `application_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` text NOT NULL,
  `start_date` text NOT NULL,
  `status` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `payroll_code` varchar(50) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `job_position_id` int(11) NOT NULL,
  `monthly_salary` text NOT NULL,
  `work_days` int(11) NOT NULL,
  `net_salary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `payroll_code`, `employee_id`, `job_position_id`, `monthly_salary`, `work_days`, `net_salary`) VALUES
(2, '321', 3213, 32131, '321312', 321312, '321'),
(3, '2', 321, 231, '2', 2, 'dsad'),
(4, 'rewr', 12, 3213, '213', 3213, 'dsadas'),
(5, '5', 3, 3, '3', 3, 'sdư');

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
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `proposal_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type_proposal_id` int(11) NOT NULL,
  `proposal_date` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`proposal_id`, `employee_id`, `type_proposal_id`, `proposal_date`, `status`) VALUES
(1, 4, 2, '2024-08-12', '2024-08-31'),
(2, 6, 2, '2024-08-02', '2024-08-30'),
(4, 3, 1, '2024-08-08', 'fas');

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
(1, '213', '2231', 231, NULL),
(2, 'thuong tien', 'tiennnn', 6, NULL);

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

--
-- Dumping data for table `salary_calculation`
--

INSERT INTO `salary_calculation` (`salary_calculation_id`, `payroll_code`, `employee_id`, `work_days`, `allowance`, `advance`, `description`) VALUES
(1, '1', 7, 30, '1', '1', 'ưq');

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
(3, 'edwqew', 3213, '2024-08-10', '2024-08-29', 'ưqew', 'eqwe'),
(4, '1', 4, '2024-08-16', '2024-08-31', 'dsa', 'fdsfasd');

-- --------------------------------------------------------

--
-- Table structure for table `type_disciplines`
--

CREATE TABLE `type_disciplines` (
  `action_id` int(11) NOT NULL,
  `disciplinary_action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_disciplines`
--

INSERT INTO `type_disciplines` (`action_id`, `disciplinary_action`) VALUES
(1, 'Warning'),
(2, 'Reprimand'),
(3, 'Suspension'),
(4, 'Demotion'),
(5, 'Termination');

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

-- --------------------------------------------------------

--
-- Table structure for table `type_leaves`
--

CREATE TABLE `type_leaves` (
  `type_leave_id` int(11) NOT NULL,
  `type_leave_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_leaves`
--

INSERT INTO `type_leaves` (`type_leave_id`, `type_leave_name`) VALUES
(1, 'Sick Leave'),
(2, 'Casual Leave'),
(3, 'Maternity Leave'),
(4, 'Paternity Leave'),
(5, 'Unpaid Leave'),
(6, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `type_proposals`
--

CREATE TABLE `type_proposals` (
  `type_proposal_id` int(11) NOT NULL,
  `proposal_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_proposals`
--

INSERT INTO `type_proposals` (`type_proposal_id`, `proposal_name`) VALUES
(1, 'Leave Request'),
(2, 'Salary Increase'),
(3, 'Position Change');

-- --------------------------------------------------------

--
-- Table structure for table `type_rewards`
--

CREATE TABLE `type_rewards` (
  `type_reward_id` int(11) NOT NULL,
  `type_reward_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_rewards`
--

INSERT INTO `type_rewards` (`type_reward_id`, `type_reward_name`) VALUES
(1, 'Employee of the Month'),
(2, 'Outstanding Performance'),
(3, 'Team Achievement'),
(4, 'Long Service'),
(5, 'Innovation Award');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `leave_application`
--
ALTER TABLE `leave_application`
  ADD PRIMARY KEY (`application_id`);

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
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`proposal_id`);

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
-- Indexes for table `type_disciplines`
--
ALTER TABLE `type_disciplines`
  ADD PRIMARY KEY (`action_id`);

--
-- Indexes for table `type_employees`
--
ALTER TABLE `type_employees`
  ADD PRIMARY KEY (`type_employee_id`);

--
-- Indexes for table `type_leaves`
--
ALTER TABLE `type_leaves`
  ADD PRIMARY KEY (`type_leave_id`);

--
-- Indexes for table `type_proposals`
--
ALTER TABLE `type_proposals`
  ADD PRIMARY KEY (`type_proposal_id`);

--
-- Indexes for table `type_rewards`
--
ALTER TABLE `type_rewards`
  ADD PRIMARY KEY (`type_reward_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `job_position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `rewards_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary_calculation`
--
ALTER TABLE `salary_calculation`
  MODIFY `salary_calculation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `type_disciplines`
--
ALTER TABLE `type_disciplines`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_employees`
--
ALTER TABLE `type_employees`
  MODIFY `type_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_leaves`
--
ALTER TABLE `type_leaves`
  MODIFY `type_leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `type_proposals`
--
ALTER TABLE `type_proposals`
  MODIFY `type_proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_rewards`
--
ALTER TABLE `type_rewards`
  MODIFY `type_reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

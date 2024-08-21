-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2024 at 10:50 PM
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
(7, 'admin', '$2y$10$5BulCzwUQ0IJX2H7OPZBi.H5nIPT7.AVVZVhE18QXTBweDhndtaoO', 2, 8),
(8, 'hr', '$2y$10$1MhowbbF6NRiBuLQ9wxHKeGwljYBI1qGiEtA3nAl7dDF7Q9cxO2Cm', 2, 11),
(9, 'super', '$2y$10$SC.3L/CyVF2RPQ9.1u6UbeIxHW86mP4LOKU7LODDtVmQ91lS1QULy', 1, 12),
(10, 'em', '$2y$10$TrsjKovFpwGV/4j680Ic.uaUQq98oFg6VVWpL0Ap6fiyb/vy5fZY2', 3, 13),
(11, 'dir', '$2y$10$a8AwaJo0hwDonyzZi/b7ZuiR6peI.C6rOqhNH/2gT2F9IJ4Rb1ahO', 2, 15),
(12, 'dm', '$2y$10$ZqrBsxjKKjYguSiSIWyLmufx.KR5kkczo6urIWGixJZrAcya6WYjS', 2, 14),
(13, 'u_taichinh', '$2y$10$obJIQc0greChxik3.czGKu2Ep0ePYT1Zgo3ZynkBtn2TWukjlNrxy', 2, 17);

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
(0, 'None', 'Chưa thuộc phòng ban nào'),
(9, 'HC', 'Phòng Hành Chính'),
(12, 'TC', 'Phòng Tài Chính'),
(13, 'NCTVPT', 'Phòng Nghiên Cứu, Tư Vấn và Chuyển Giao Công Nghệ'),
(15, 'VHHT', 'Phòng Vận Hành Hệ Thống');

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `discipline_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`discipline_id`, `action_id`, `employee_id`) VALUES
(5, 5, 8),
(6, 2, 8);

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
(1, 'Cao Đẳng '),
(2, 'Đại Học'),
(3, 'THPT'),
(4, 'THCS'),
(5, 'Tiểu Học');

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
  `education_level_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type_employee_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `job_detail_id` int(11) DEFAULT NULL,
  `ethnic` text,
  `religion` text,
  `marital_status` int(11) DEFAULT NULL,
  `nation` text,
  `phone_number` text,
  `place_of_issue` text,
  `date_of_issue` date DEFAULT NULL,
  `date_of_exp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `last_name`, `first_name`, `img`, `gender`, `birth_date`, `birth_place`, `place_of_resident`, `email`, `permanent_address`, `cic_number`, `education_level_id`, `status`, `type_employee_id`, `department_id`, `job_detail_id`, `ethnic`, `religion`, `marital_status`, `nation`, `phone_number`, `place_of_issue`, `date_of_issue`, `date_of_exp`) VALUES
(12, 'admin', 'super', 'avt.png', 0, '2000-11-11', 'Hà Nam', 'abc', 'superad@gmail.com', 'abc', 123, 2, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Tuấn', 'Trịnh', 'avt.png', 0, '1997-04-12', 'Bến Tre', NULL, NULL, NULL, NULL, 4, 0, 2, 0, NULL, 'Kinh', 'Không', 0, 'Vietnam', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_details`
--

CREATE TABLE `job_details` (
  `id_job_detail` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `job_position_id` int(11) DEFAULT NULL,
  `job_level` int(11) DEFAULT NULL,
  `salary_code` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_details`
--

INSERT INTO `job_details` (`id_job_detail`, `employee_id`, `job_position_id`, `job_level`, `salary_code`) VALUES
(3, 16, 10, 3, 'vv');

-- --------------------------------------------------------

--
-- Table structure for table `job_level`
--

CREATE TABLE `job_level` (
  `id_job_level` int(11) NOT NULL,
  `job_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_level`
--

INSERT INTO `job_level` (`id_job_level`, `job_level`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `job_positions`
--

CREATE TABLE `job_positions` (
  `job_position_id` int(11) NOT NULL,
  `job_position_code` text NOT NULL,
  `job_position_name` text NOT NULL,
  `salary_code` text,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_positions`
--

INSERT INTO `job_positions` (`job_position_id`, `job_position_code`, `job_position_name`, `salary_code`, `description`) VALUES
(6, 'TP', 'Trưởng phòng', NULL, 'none'),
(7, 'GD', 'Giám đốc', NULL, 'none'),
(8, 'HR', 'Kế toán', NULL, 'none'),
(10, 'NV', 'Nhân viên', NULL, 'none'),
(11, 'CNTT', 'Công nghệ thông tin', 'V11.06.14', 'none'),
(12, 'ATTT', 'An toàn thông tin', 'V11.05.11', 'none'),
(13, 'PGD', 'Phó giám đốc', NULL, 'none'),
(14, 'TP', 'Phó trưởng phòng', NULL, 'none'),
(15, 'TP', 'Thủ quỹ', NULL, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `leave_application`
--

CREATE TABLE `leave_application` (
  `application_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type_leave_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `leave_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leave_application`
--

INSERT INTO `leave_application` (`application_id`, `employee_id`, `type_leave_id`, `start_date`, `end_date`, `duration`, `leave_status`) VALUES
(1, 6, 6, '2024-08-10', '2024-08-15', NULL, 1),
(2, 8, 4, '2024-08-08', '2024-08-16', NULL, 1),
(3, 8, 5, '2024-08-07', '2024-08-30', NULL, 1),
(4, 14, 1, '2024-08-17', '2024-08-18', 2, 1),
(5, 13, 1, '2024-08-19', '2024-08-21', 3, 0);

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
(5, '5', 3, 3, '3', 3, 'sdư'),
(6, '2', 8, 3, '3', 2, 'ew'),
(7, '5', 8, 4, '3', 2, 'wqewq');

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
  `proposal_description` text NOT NULL,
  `proposal_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`proposal_id`, `employee_id`, `type_proposal_id`, `proposal_description`, `proposal_status`, `created_at`) VALUES
(10, 8, 3, 'abcde', 2, '2024-08-15 15:13:54'),
(11, 10, 3, 'hoc ngu dua di hoc them', 2, '2024-08-16 01:49:33'),
(12, 13, 2, 'Toi muon duoc tang luong', 0, '2024-08-18 18:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_file`
--

CREATE TABLE `proposal_file` (
  `proposal_file_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `proposal_file_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `rewards_id` int(11) NOT NULL,
  `type_reward_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`rewards_id`, `type_reward_id`, `employee_id`) VALUES
(6, 5, 8),
(7, 3, 8),
(8, 3, 6),
(9, 2, 10),
(10, 5, 16);

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
(5, 12, 2.34, NULL, 5475600, 438048, 82134, 54756, 4900660, NULL),
(14, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
(1, '1', 7, 30, '1', '1', 'ưq'),
(2, '5', 6, 30, '1', '1', 'ewqew'),
(3, '32', 8, 30, '1', '1', 'kl;k;l');

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
(4, '1', 4, '2024-08-16', '2024-08-31', 'dsa', 'fdsfasd'),
(5, 'CIR', 8, '2024-08-17', '2024-08-30', 'ds', 'dsad');

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
(1, 'Cảnh cáo'),
(2, 'Khiển trách'),
(3, 'Đình chỉ'),
(4, 'Giáng chức'),
(5, 'Sa thải');

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
(1, 'Nhân viên chính thức'),
(2, 'Nhân viên tập sự');

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
(1, 'Nghỉ bệnh'),
(2, 'Nghỉ phép thông thường'),
(3, 'Nghỉ thai sản'),
(5, 'Nghỉ không lương'),
(6, 'Khác');

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
(1, 'Yêu cầu nghỉ phép'),
(2, 'Đề xuất tăng lương'),
(3, 'Đề xuất đổi vị trí làm việc');

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
(1, 'Nhân viên của tháng'),
(2, 'Hiệu suất vượt trội'),
(3, 'Thành tựu của đội'),
(4, 'Giải thưởng thâm niên'),
(5, 'Giải thưởng sáng tạo');

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
-- Indexes for table `job_details`
--
ALTER TABLE `job_details`
  ADD PRIMARY KEY (`id_job_detail`);

--
-- Indexes for table `job_level`
--
ALTER TABLE `job_level`
  ADD PRIMARY KEY (`id_job_level`);

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
-- Indexes for table `proposal_file`
--
ALTER TABLE `proposal_file`
  ADD PRIMARY KEY (`proposal_file_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`rewards_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`salary_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `discipline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `education_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `job_details`
--
ALTER TABLE `job_details`
  MODIFY `id_job_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_level`
--
ALTER TABLE `job_level`
  MODIFY `id_job_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_positions`
--
ALTER TABLE `job_positions`
  MODIFY `job_position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `leave_application`
--
ALTER TABLE `leave_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proposal_file`
--
ALTER TABLE `proposal_file`
  MODIFY `proposal_file_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `rewards_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `salary_calculation`
--
ALTER TABLE `salary_calculation`
  MODIFY `salary_calculation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_disciplines`
--
ALTER TABLE `type_disciplines`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_employees`
--
ALTER TABLE `type_employees`
  MODIFY `type_employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

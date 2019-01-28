-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2018 at 06:23 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sna_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cur_date`
--

CREATE TABLE `cur_date` (
  `id` int(11) NOT NULL,
  `month` tinyint(3) UNSIGNED NOT NULL,
  `year` smallint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cur_date`
--

INSERT INTO `cur_date` (`id`, `month`, `year`) VALUES
(1, 7, 2018);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(25) NOT NULL DEFAULT 'Administration'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(4, 'Finance'),
(3, 'Operation'),
(2, 'Program');

-- --------------------------------------------------------

--
-- Table structure for table `emp_details`
--

CREATE TABLE `emp_details` (
  `emp_id` varchar(10) NOT NULL DEFAULT 'SOLBD00',
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `supervisor` varchar(30) NOT NULL,
  `birth_date` date NOT NULL,
  `join_date` date NOT NULL,
  `dept_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `position` varchar(50) NOT NULL,
  `mobile` text NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `user_status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `note` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_details`
--

INSERT INTO `emp_details` (`emp_id`, `first_name`, `last_name`, `password`, `email`, `supervisor`, `birth_date`, `join_date`, `dept_id`, `location_id`, `position`, `mobile`, `user_type`, `user_status`, `note`) VALUES
('SOLBD0068', 'A N M', 'Suza', '123', 'mostofa.suza@solidaridadnetwork.org', 'Ami O Amra', '1978-12-25', '2018-04-01', 3, 1, 'IT Officer', '2323776400', 'System Admin', 'enable', 'Test with password hash'),
('SOLBD0079', 'Farzana', 'Huda', '123', 'farzana@solidaridadnetwork.org', 'SOLBD0077', '1971-04-11', '2013-03-28', 4, 2, 'Asst. Finance Manager', '232377600000000', 'User', 'enable', ''),
('SOLBD0080', 'Chistia Hyder', 'Sharmin', '123', 'suza786@gmail.com', 'SOLBD0068', '1988-02-17', '2018-04-20', 3, 1, 'HR Offier', '01768980657', 'HR', 'enable', ''),
('SOLBD0090', 'Ferdous', 'Karim', '123', 'suza786@gmail.com', 'SOLBD0068', '1983-03-23', '2017-12-18', 3, 3, 'Planning and Monitoring Officer', '01714075086', 'User', 'enable', ''),
('SOLBD0095', 'Mirza', 'Galib', '$2y$10$jhQuEP6Jws55ZEzEInSZguGNK7bXT.jQrVhGtwy7Q3NecnxIsOsyu', 'suza786@gmail.com', 'SOLBD0068', '1982-10-25', '2018-08-01', 2, 1, 'Monitoring Officer', '2323776203', 'User', 'enable', ''),
('SOLBD0096', 'Muhammad Shakil', 'Anwar', '$2y$10$xcpZ6RvJhVZwH7o6CeCKY.VOrHJ8ZZpmDlYh6Cy/ubnYu9bpXRiSq', 'shakil@solidaridadnetwork.org', 'SOLBD0080', '1973-04-14', '2018-11-01', 3, 1, 'COO', '01841116304', 'User', 'enable', ''),
('SOLBD0097', 'Saiful', 'Hasan', '$2y$10$dkZGZl4xZT28VhWEwbW0iuIiho5VdrCZsDBC2CKZq6V1zh/FoogSK', 'saiful.hasan@solidaridadnetwork.org', 'SOLBD0096', '1982-12-03', '2018-11-01', 2, 1, 'M&E ', '01714075086', 'User', 'enable', '');

-- --------------------------------------------------------

--
-- Table structure for table `emp_location`
--

CREATE TABLE `emp_location` (
  `location_id` int(3) NOT NULL,
  `location_name` varchar(25) NOT NULL DEFAULT 'Khulna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_location`
--

INSERT INTO `emp_location` (`location_id`, `location_name`) VALUES
(1, 'Dhaka'),
(3, 'Jeshore'),
(2, 'Khulna'),
(4, 'Noakhali');

-- --------------------------------------------------------

--
-- Table structure for table `holiday_list`
--

CREATE TABLE `holiday_list` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `date_` date NOT NULL,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday_list`
--

INSERT INTO `holiday_list` (`id`, `name`, `date_`, `note`) VALUES
(2, 'Test Eid Holiday', '2018-04-29', 'Test multiday entry'),
(3, 'Test Eid Holiday', '2018-04-30', 'Test multiday entry'),
(4, 'Test Eid Holiday', '2018-05-01', 'Test multiday entry'),
(5, 'Test Holiday', '2018-05-14', 'Full day'),
(6, 'Eid-ul-Adha', '2018-08-21', 'Korbanir Eid'),
(7, 'Eid-ul-Adha', '2018-08-22', 'Korbanir Eid'),
(8, 'Eid-ul-Adha', '2018-08-23', 'Korbanir Eid'),
(9, 'Durga puja', '2018-10-16', 'durga puja'),
(10, 'Durga puja', '2018-10-17', 'durga puja'),
(11, 'vd', '2018-12-16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `last_emp_id`
--

CREATE TABLE `last_emp_id` (
  `id` bit(2) NOT NULL,
  `emp_id` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_emp_id`
--

INSERT INTO `last_emp_id` (`id`, `emp_id`) VALUES
(b'01', 97);

-- --------------------------------------------------------

--
-- Table structure for table `leave_entitled_regular`
--

CREATE TABLE `leave_entitled_regular` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `leave_type_id` int(6) NOT NULL,
  `cycle_start_date` date NOT NULL,
  `cycle_end_date` date NOT NULL,
  `balance` float(10,2) NOT NULL,
  `leave_year` smallint(5) UNSIGNED NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_entitled_regular`
--

INSERT INTO `leave_entitled_regular` (`id`, `emp_id`, `leave_type_id`, `cycle_start_date`, `cycle_end_date`, `balance`, `leave_year`, `comments`) VALUES
(200, 'SOLBD0068', 11, '2018-01-01', '2018-12-31', 8.00, 2017, ''),
(201, 'SOLBD0068', 12, '2018-01-01', '2018-12-31', 4.00, 2017, ''),
(202, 'SOLBD0068', 13, '2018-01-01', '2018-12-31', 15.00, 2017, ''),
(203, 'SOLBD0080', 11, '2018-01-01', '2018-12-31', 9.00, 2017, ''),
(204, 'SOLBD0080', 12, '2018-01-01', '2018-12-31', 12.00, 2017, ''),
(205, 'SOLBD0080', 13, '2018-01-01', '2018-12-31', -16.00, 2017, ''),
(206, 'SOLBD0090', 11, '2018-01-01', '2018-12-31', 8.00, 2017, ''),
(207, 'SOLBD0090', 12, '2018-01-01', '2018-12-31', 10.00, 2017, ''),
(208, 'SOLBD0090', 13, '2018-01-01', '2018-12-31', 15.00, 2017, ''),
(212, 'SOLBD0104', 11, '2018-01-01', '2018-12-31', 10.00, 2017, ''),
(213, 'SOLBD0104', 12, '2018-01-01', '2018-12-31', 12.00, 2017, ''),
(214, 'SOLBD0104', 13, '2018-01-01', '2018-12-31', 4.00, 2017, ''),
(224, 'SOLBD0068', 11, '2018-01-01', '2018-12-31', 8.00, 2018, ''),
(225, 'SOLBD0068', 12, '2018-01-01', '2018-12-31', 1.00, 2018, ''),
(226, 'SOLBD0068', 13, '2018-01-01', '2018-12-31', 3.00, 2018, ''),
(227, 'SOLBD0080', 11, '2018-01-01', '2018-12-31', 9.00, 2018, ''),
(228, 'SOLBD0080', 12, '2018-01-01', '2018-12-31', 12.00, 2018, ''),
(229, 'SOLBD0080', 13, '2018-01-01', '2018-12-31', -18.00, 2018, ''),
(230, 'SOLBD0090', 11, '2018-01-01', '2018-12-31', 6.00, 2018, ''),
(231, 'SOLBD0090', 12, '2018-01-01', '2018-12-31', 9.00, 2018, ''),
(232, 'SOLBD0090', 13, '2018-01-01', '2018-12-31', 2.00, 2018, ''),
(233, 'SOLBD0095', 11, '2018-01-01', '2018-12-31', 10.00, 2017, ''),
(234, 'SOLBD0095', 12, '2018-01-01', '2018-12-31', 12.00, 2017, ''),
(235, 'SOLBD0095', 13, '2018-01-01', '2018-12-31', 2.00, 2017, ''),
(236, 'SOLBD0104', 11, '2018-01-01', '2018-12-31', 10.00, 2018, ''),
(237, 'SOLBD0104', 12, '2018-01-01', '2018-12-31', 12.00, 2018, ''),
(238, 'SOLBD0104', 13, '2018-01-01', '2018-12-31', 2.00, 2018, ''),
(254, 'SOLBD0078', 11, '2018-07-16', '2018-12-31', 4.58, 2018, ''),
(255, 'SOLBD0078', 12, '2018-07-16', '2018-12-31', 5.50, 2018, ''),
(256, 'SOLBD0078', 13, '2018-07-16', '2018-12-31', 11.00, 2018, ''),
(257, 'SOLBD0079', 11, '2018-07-15', '2018-12-31', 4.61, 2018, ''),
(258, 'SOLBD0079', 12, '2018-07-15', '2018-12-31', 5.53, 2018, ''),
(259, 'SOLBD0079', 13, '2018-07-15', '2018-12-31', 11.07, 2018, ''),
(263, 'SOLBD0095', 11, '2018-08-01', '2018-12-31', 4.17, 2018, ''),
(264, 'SOLBD0095', 12, '2018-08-01', '2018-12-31', 5.00, 2018, ''),
(265, 'SOLBD0095', 13, '2018-08-01', '2018-12-31', 10.00, 2018, ''),
(266, 'SOLBD0096', 11, '2018-11-01', '2018-12-31', 1.67, 2018, ''),
(267, 'SOLBD0096', 12, '2018-11-01', '2018-12-31', 2.00, 2018, ''),
(268, 'SOLBD0096', 13, '2018-11-01', '2018-12-31', 4.00, 2018, ''),
(269, 'SOLBD0097', 11, '2018-11-01', '2018-12-31', 1.67, 2018, ''),
(270, 'SOLBD0097', 12, '2018-11-01', '2018-12-31', 2.00, 2018, ''),
(271, 'SOLBD0097', 13, '2018-11-01', '2018-12-31', 4.00, 2018, '');

-- --------------------------------------------------------

--
-- Table structure for table `leave_forwarded`
--

CREATE TABLE `leave_forwarded` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `fwrd_el` float(10,2) UNSIGNED NOT NULL,
  `fwrd_sl` float(10,2) UNSIGNED NOT NULL,
  `leave_year` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requested`
--

CREATE TABLE `leave_requested` (
  `req_id` int(3) NOT NULL,
  `emp_id` varchar(10) NOT NULL,
  `leave_type_id` int(11) NOT NULL,
  `curr_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `num_of_days` smallint(6) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Requested',
  `supervisor_id` varchar(10) NOT NULL,
  `doc_of_ir_leave` varchar(50) NOT NULL,
  `note` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_requested`
--

INSERT INTO `leave_requested` (`req_id`, `emp_id`, `leave_type_id`, `curr_date`, `start_date`, `end_date`, `num_of_days`, `status`, `supervisor_id`, `doc_of_ir_leave`, `note`) VALUES
(1, 'SOLBD0090', 11, '2018-07-11', '2018-07-19', '2018-07-22', 2, 'Requested', 'SOLBD0090', '', 'Test Leave'),
(2, 'SOLBD0095', 13, '2018-08-17', '2018-08-20', '2018-08-27', 3, 'Requested', 'SOLBD0068', '', 'Submit form web server'),
(3, 'SOLBD0095', 13, '2018-08-17', '2018-08-19', '2018-08-26', 3, 'Requested', 'SOLBD0068', '', 'Request from web server'),
(4, 'SOLBD0095', 11, '2018-08-18', '2018-08-19', '2018-08-20', 2, 'Requested', 'SOLBD0068', '', 'Test form web'),
(5, 'SOLBD0095', 16, '2018-08-18', '2018-08-15', '2018-08-23', 9, 'Requested', 'SOLBD0068', 'railway_e_ticket-for consultant.pdf', 'test from web'),
(6, '', 16, '2018-08-18', '2018-08-15', '2018-08-23', 9, 'Requested', 'SOLBD0068', 'railway_e_ticket-for consultant.pdf', 'test from web'),
(7, 'SOLBD0095', 13, '2018-08-18', '2018-08-20', '2018-08-27', 3, 'Requested', 'SOLBD0068', '', 'test from web with mizan'),
(8, 'SOLBD0095', 13, '2018-08-18', '2018-08-20', '2018-08-27', 3, 'Requested', 'SOLBD0068', '', 'test from web with mizan'),
(9, 'SOLBD0095', 13, '2018-08-18', '2018-08-20', '2018-08-27', 3, 'Requested', 'SOLBD0068', '', 'test from web with mizan'),
(10, 'SOLBD0095', 13, '2018-08-19', '2018-08-20', '2018-08-27', 3, 'Requested', 'SOLBD0068', '', 'aa v'),
(11, 'SOLBD0095', 11, '2018-09-22', '2018-10-15', '2018-10-23', 5, 'Planed', 'SOLBD0068', '', 'test from ikracom-bd'),
(12, 'SOLBD0090', 11, '2018-10-20', '2018-10-22', '2018-10-23', 2, 'Approved', 'SOLBD0068', '', 'test with email'),
(13, 'SOLBD0090', 12, '2018-10-20', '2018-10-23', '2018-10-24', 2, 'Approved', 'SOLBD0068', '', 'leave mail test'),
(14, 'SOLBD0068', 11, '2018-11-05', '2018-12-13', '2018-12-17', 2, 'Rejected', 'SOLBD0080', '', ''),
(15, 'SOLBD0068', 12, '2018-11-11', '2018-11-12', '2018-11-13', 2, 'Approved', 'SOLBD0080', '', ''),
(16, 'SOLBD0068', 12, '2018-11-11', '2018-11-12', '2018-11-13', 2, 'Approved', 'SOLBD0080', '', ''),
(17, 'SOLBD0068', 12, '2018-11-11', '2018-11-12', '2018-11-13', 2, 'Approved', 'SOLBD0080', '', ''),
(18, 'SOLBD0068', 12, '2018-11-11', '2018-11-12', '2018-11-13', 2, 'Approved', 'SOLBD0080', '', ''),
(19, 'SOLBD0080', 11, '2018-11-11', '2018-11-14', '2018-11-14', 1, 'Approved', 'SOLBD0080', '', ''),
(20, 'SOLBD0068', 11, '2018-11-12', '2018-11-19', '2018-11-20', 2, 'Approved', 'SOLBD0080', '', ''),
(21, 'SOLBD0080', 13, '2018-11-25', '2018-11-29', '2018-12-29', 20, 'Approved', 'SOLBD0096', '', 'Test Leave ');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `leave_type_id` int(3) NOT NULL,
  `leave_type` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`leave_type_id`, `leave_type`, `description`, `category`) VALUES
(11, 'Casual Leave', '', 'regular'),
(12, 'Sick Leave', '', 'regular'),
(13, 'Earned Leave', '', 'regular'),
(14, 'Compensatory Leave', '', 'irregular'),
(15, 'Maternity Leave', '', 'irregular'),
(16, 'Paternity Leave', '', 'irregular'),
(17, 'Miscarriage Leave', '', 'irregular');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_emp_details`
-- (See below for the actual view)
--
CREATE TABLE `vw_emp_details` (
`emp_id` varchar(10)
,`first_name` varchar(40)
,`last_name` varchar(40)
,`birth_date` date
,`position` varchar(50)
,`join_date` date
,`dept_name` varchar(25)
,`location_name` varchar(25)
,`email` text
,`mobile` text
,`supervisor` varchar(30)
,`user_type` varchar(20)
,`user_status` enum('enable','disable')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_leave_requested_details`
-- (See below for the actual view)
--
CREATE TABLE `vw_leave_requested_details` (
`req_id` int(3)
,`emp_id` varchar(10)
,`first_name` varchar(40)
,`last_name` varchar(40)
,`curr_date` date
,`start_date` date
,`end_date` date
,`leave_type` varchar(20)
,`num_of_days` smallint(6)
,`supervisor_id` varchar(10)
,`status` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_emp_details`
--
DROP TABLE IF EXISTS `vw_emp_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_details`  AS  select `e`.`emp_id` AS `emp_id`,`e`.`first_name` AS `first_name`,`e`.`last_name` AS `last_name`,`e`.`birth_date` AS `birth_date`,`e`.`position` AS `position`,`e`.`join_date` AS `join_date`,`d`.`dept_name` AS `dept_name`,`el`.`location_name` AS `location_name`,`e`.`email` AS `email`,`e`.`mobile` AS `mobile`,`e`.`supervisor` AS `supervisor`,`e`.`user_type` AS `user_type`,`e`.`user_status` AS `user_status` from ((`emp_details` `e` join `department` `d` on((`e`.`dept_id` = `d`.`dept_id`))) join `emp_location` `el` on((`el`.`location_id` = `e`.`location_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_leave_requested_details`
--
DROP TABLE IF EXISTS `vw_leave_requested_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ikracombd`@`localhost` SQL SECURITY INVOKER VIEW `vw_leave_requested_details`  AS  select `l`.`req_id` AS `req_id`,`e`.`emp_id` AS `emp_id`,`e`.`first_name` AS `first_name`,`e`.`last_name` AS `last_name`,`l`.`curr_date` AS `curr_date`,`l`.`start_date` AS `start_date`,`l`.`end_date` AS `end_date`,`lt`.`leave_type` AS `leave_type`,`l`.`num_of_days` AS `num_of_days`,`l`.`supervisor_id` AS `supervisor_id`,`l`.`status` AS `status` from ((`emp_details` `e` join `leave_requested` `l` on((`e`.`emp_id` = `l`.`emp_id`))) join `leave_type` `lt` on((`lt`.`leave_type_id` = `l`.`leave_type_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cur_date`
--
ALTER TABLE `cur_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`);

--
-- Indexes for table `emp_details`
--
ALTER TABLE `emp_details`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `emp_location`
--
ALTER TABLE `emp_location`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Indexes for table `holiday_list`
--
ALTER TABLE `holiday_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last_emp_id`
--
ALTER TABLE `last_emp_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_entitled_regular`
--
ALTER TABLE `leave_entitled_regular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_forwarded`
--
ALTER TABLE `leave_forwarded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requested`
--
ALTER TABLE `leave_requested`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`leave_type_id`),
  ADD UNIQUE KEY `leave_type` (`leave_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cur_date`
--
ALTER TABLE `cur_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emp_location`
--
ALTER TABLE `emp_location`
  MODIFY `location_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `holiday_list`
--
ALTER TABLE `holiday_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leave_entitled_regular`
--
ALTER TABLE `leave_entitled_regular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `leave_forwarded`
--
ALTER TABLE `leave_forwarded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requested`
--
ALTER TABLE `leave_requested`
  MODIFY `req_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `leave_type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

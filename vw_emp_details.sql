-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2018 at 09:40 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akashvara_sna_lms`
--

-- --------------------------------------------------------

--
-- Structure for view `vw_emp_details`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_details`  AS  select `e`.`emp_id` AS `emp_id`,`e`.`first_name` AS `first_name`,`e`.`last_name` AS `last_name`,`e`.`birth_date` AS `birth_date`,`e`.`position` AS `position`,`e`.`join_date` AS `join_date`,`d`.`dept_name` AS `dept_name`,`el`.`location_name` AS `location_name`,`e`.`email` AS `email`,`e`.`mobile` AS `mobile`,`e`.`supervisor` AS `supervisor`,`e`.`user_type` AS `user_type`,`e`.`user_status` AS `user_status`,`e`.`note` AS `note` from ((`smf`.`emp_details` `e` join `smf`.`department` `d` on((`e`.`dept_id` = `d`.`dept_id`))) join `smf`.`emp_location` `el` on((`el`.`location_id` = `e`.`location_id`))) ;

--
-- VIEW  `vw_emp_details`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

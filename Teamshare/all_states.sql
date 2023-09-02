-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 07:53 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_states`
--

CREATE TABLE `all_states` (
  `state_code` text DEFAULT NULL,
  `state_name` text DEFAULT NULL,
  `country_code` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_states`
--

INSERT INTO `all_states` (`state_code`, `state_name`, `country_code`) VALUES
('1', 'Andaman & Nicobar [AN]', '+91'),
('2', 'Andhra Pradesh [AP]', '+91'),
('3', 'Arunachal Pradesh [AR]', '+91'),
('4', 'Assam [AS]', '+91'),
('5', 'Bihar [BH]', '+91'),
('6', 'Chandigarh [CH]', '+91'),
('7', 'Chhattisgarh [CG]', '+91'),
('8', 'Dadra & Nagar Haveli [DN]', '+91'),
('9', 'Daman & Diu [DD]', '+91'),
('10', 'Delhi [DL]', '+91'),
('11', 'Goa [GO]', '+91'),
('12', 'Gujarat [GU]', '+91'),
('13', 'Haryana [HR]', '+91'),
('14', 'Himachal Pradesh [HP]', '+91'),
('15', 'Jammu & Kashmir [JK]', '+91'),
('16', 'Jharkhand [JH]', '+91'),
('17', 'Karnataka [KR]', '+91'),
('18', 'Kerala [KL]', '+91'),
('19', 'Lakshadweep [LD]', '+91'),
('20', 'Madhya Pradesh [MP]', '+91'),
('21', 'Maharashtra [MH]', '+91'),
('22', 'Manipur [MN]', '+91'),
('23', 'Meghalaya [ML]', '+91'),
('24', 'Mizoram [MM]', '+91'),
('25', 'Nagaland [NL]', '+91'),
('26', 'Orissa [OR]', '+91'),
('27', 'Pondicherry [PC]', '+91'),
('28', 'Punjab [PJ]', '+91'),
('29', 'Rajasthan [RJ]', '+91'),
('30', 'Sikkim [SK]', '+91'),
('31', 'Tamil Nadu [TN]', '+91'),
('32', 'Tripura [TR]', '+91'),
('33', 'Uttar Pradesh [UP]', '+91'),
('34', 'Uttaranchal [UT]', '+91'),
('35', 'West Bengal [WB]', '+91');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

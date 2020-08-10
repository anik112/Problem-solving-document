-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2020 at 01:42 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_hearing`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_patient_pendding_list`
--

CREATE TABLE `tb_patient_pendding_list` (
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_number` varchar(50) DEFAULT NULL,
  `doctor_name` varchar(100) DEFAULT NULL,
  `doctor_number` varchar(50) DEFAULT NULL,
  `apt_time` varchar(50) DEFAULT NULL,
  `doctor_meet_links` varchar(200) DEFAULT NULL,
  `doctor_whatsapp_links` varchar(200) DEFAULT NULL,
  `check_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_patient_pendding_list`
--

INSERT INTO `tb_patient_pendding_list` (`patient_id`, `doctor_id`, `patient_name`, `patient_number`, `doctor_name`, `doctor_number`, `apt_time`, `doctor_meet_links`, `doctor_whatsapp_links`, `check_status`) VALUES
(1, 0, 'Shuvo', '01826995639', 'Pranta', NULL, '12.50 PM', 'https://meet.google.com/kto-nsfw-fae', 'https://wa.me/8801826995639', 1),
(1, 1, 'Shuvo', '01582365214', 'Shuvo', NULL, '12.50 PM', 'https://meet.google.com/kto-nsfw-fae', 'https://wa.me/8801789564123', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

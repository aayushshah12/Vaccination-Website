-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2022 at 09:29 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vdrive1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appoinment`
--

DROP TABLE IF EXISTS `appoinment`;
CREATE TABLE IF NOT EXISTS `appoinment` (
  `appo_no` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `age` varchar(255) NOT NULL,
  `aadhaar_no` varchar(255) NOT NULL,
  `aadhaar_img` varchar(255) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `vc_id` int(10) NOT NULL,
  `vaccine_name` varchar(50) NOT NULL,
  `appo_user_id` varchar(255) NOT NULL,
  `appo_time` varchar(50) NOT NULL,
  `appo_date` varchar(255) NOT NULL,
  `appo_status` varchar(50) NOT NULL,
  PRIMARY KEY (`aadhaar_no`),
  UNIQUE KEY `appo_no` (`appo_no`),
  UNIQUE KEY `appo_user_id` (`appo_user_id`),
  KEY `vc_id` (`vc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `state_id`, `district_name`) VALUES
(1, 7, 'Ahmedabad'),
(2, 7, 'Mehasana'),
(3, 1, 'Anantapur'),
(4, 1, 'Visakhapatnam'),
(5, 2, 'Anjaw'),
(6, 2, 'Changlang'),
(7, 3, 'Baksa'),
(8, 3, 'Barpeta'),
(9, 4, 'Araria'),
(10, 4, 'Aurangabad'),
(11, 8, 'Ambala'),
(12, 8, 'Faridabad'),
(13, 10, 'Bokaro'),
(14, 10, 'Chatra'),
(15, 12, 'Kannur'),
(16, 12, 'Kasaragod'),
(17, 13, 'Agar Malwa'),
(18, 13, 'Alirajpur'),
(19, 14, 'Ahmednagar'),
(20, 14, 'Amravati'),
(21, 20, 'Amritsar'),
(22, 20, 'Barnala'),
(23, 21, 'Ajmer'),
(24, 21, 'Bikaner'),
(25, 27, 'Dehradun'),
(26, 27, 'Haridwar'),
(27, 28, 'Alipurduar'),
(28, 28, 'Bankura');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `stock_no` int(50) NOT NULL,
  `vc_id` int(50) NOT NULL,
  `vaccinator_id` int(50) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `schedule_date` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `remain_quantity` varchar(50) NOT NULL,
  PRIMARY KEY (`no`),
  KEY `schedule_ibfk_1` (`vc_id`),
  KEY `schedule_ibfk_2` (`vaccinator_id`),
  KEY `stock_no` (`stock_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Arunachal Pradesh'),
(3, 'Assam'),
(4, 'Bihar'),
(5, 'Chhattisgarh'),
(6, 'Goa'),
(7, 'Gujarat'),
(8, 'Haryana'),
(9, 'Himachal Pradesh'),
(10, 'Jharkhand'),
(11, 'Karnataka'),
(12, 'Kerala'),
(13, 'Madhya Pradesh'),
(14, 'Maharashtra'),
(15, 'Manipur'),
(16, 'Meghalaya'),
(17, 'Mizoram'),
(18, 'Nagaland'),
(19, 'Odisha'),
(20, 'Punjab'),
(21, 'Rajasthan'),
(22, 'Sikkim'),
(23, 'Tamil Nadu'),
(24, 'Telangana'),
(25, 'Tripura'),
(26, 'Uttar Pradesh'),
(27, 'Uttarakhand'),
(28, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `adhaar_no` varchar(255) NOT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `age` varchar(2) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cnumber` varchar(12) NOT NULL,
  `pincode` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `account_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

DROP TABLE IF EXISTS `vaccination`;
CREATE TABLE IF NOT EXISTS `vaccination` (
  `no` int(50) NOT NULL AUTO_INCREMENT,
  `vc_id` int(50) NOT NULL,
  `appo_no` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` varchar(2) NOT NULL,
  `aadhaar_no` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `vaccine_name` varchar(50) NOT NULL,
  `vaccination_status` varchar(50) NOT NULL,
  PRIMARY KEY (`aadhaar_no`),
  KEY `no` (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vaccinator`
--

DROP TABLE IF EXISTS `vaccinator`;
CREATE TABLE IF NOT EXISTS `vaccinator` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `aadhaar_no` varchar(255) NOT NULL,
  `aadhaar_img` varchar(255) DEFAULT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `vc_id` int(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `aadhaar_no` (`aadhaar_no`),
  KEY `vc_id` (`vc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccinator`
--

INSERT INTO `vaccinator` (`ID`, `name`, `aadhaar_no`, `aadhaar_img`, `age`, `gender`, `email`, `password`, `phone_no`, `address`, `vc_id`) VALUES
(3, 'harshil', '123456', '../uploads/vaccinator/Screenshot (3).png', '54', 'male', 'harshil98shah@gmail.com', '123', 656645, 'jhkgkjdhfgjd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_center`
--

DROP TABLE IF EXISTS `vaccine_center`;
CREATE TABLE IF NOT EXISTS `vaccine_center` (
  `vc_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `distrik` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `address` varchar(200) NOT NULL,
  PRIMARY KEY (`vc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccine_center`
--

INSERT INTO `vaccine_center` (`vc_id`, `name`, `type`, `contact_no`, `email`, `state`, `distrik`, `city`, `pincode`, `address`) VALUES
(1, 'AGALI PHC', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '1', '3', 'Andhra Pradesh', '515311', 'Rolla Road, Anantapur, Andhra Pradesh'),
(2, 'PCVC APOLLO CLINIC VIZAG', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '1', '4', 'Andhra Pradesh', '530016', 'Beside BVK College Seethampeta, Visakhapatnam, Andhra Pradesh'),
(3, 'HAYULIANG DH', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '2', '5', 'Arunachal Pradesh', '792104', 'Swamy Camp, Anjaw, Arunachal Pradesh'),
(4, 'CHC BORDUMSA', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '2', '6', 'Arunachal Pradesh', '792056', 'Bordumsa, Changlang, Arunachal Pradesh'),
(5, 'ADALBARI SD', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '3', '7', 'Assam', '781372', 'Adalbari, Baksa, Assam'),
(6, 'AKAYA MPHC', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '3', '8', 'Assam', '781329', 'AkayGaon, Barpeta, Assam'),
(7, 'AMS MIRZAPUR FBG 15-18Y', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '4', '9', 'Bihar', '854318', 'MIRJA PUR FORBESGANJ, Araria, Bihar'),
(8, 'AKAUNA GOH', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '4', '10', 'Bihar', '824203', 'AKAUNA GOH, Aurangabad, Bihar'),
(9, 'ADVAL HIGHSCHOOL', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '7', '1', 'Gujarat', '382460', 'At-Adval Ta-Dhandhuka Dist-Ahmedabad, Ahmedabad, Gujarat'),
(10, 'CHC SATLASANA', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '7', '2', 'Gujarat', '384330', 'Satlasana Dist Mahesana, Mehsana, Gujarat'),
(11, 'ARSH HOSPITAL', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '8', '11', 'Haryana', '121002', 'Opp. Era Redwood Residency Tigaon Rd Sector 78 Faridabad, Faridabad, Haryana'),
(12, 'ARSH HOSPITAL', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '8', '12', 'Haryana', '121002', 'Opp. Era Redwood Residency Tigaon Rd Sector 78 Faridabad, Faridabad, Haryana'),
(13, 'AKOLE PHC BRAHMANWADA', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '14', '19', 'Maharashtra', '422610', 'Bramanwada Akole, Ahmednagar, Maharashtra'),
(14, '10 MORSHI SDH 45-', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '14', '20', 'Maharashtra', '444905', 'Morshi SDH, Amravati, Maharashtra'),
(15, 'GNDU HEALTH CENTER', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '20', '21', 'Punjab', '143001', 'Guru Nanak Dev University, Amritsar, Punjab'),
(16, 'BARNALA DH PP UNIT', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '20', '22', 'Punjab', '148101', 'Barnala DH PP Unit, Barnala, Punjab'),
(17, 'AIIMS RISHIKESH -D', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '27', '25', 'Uttarakhand', '249203', 'Rishikesh, Dehradun, Uttarakhand'),
(18, '12-14 BANJAREWALA', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '27', '26', 'Uttarakhand', '247661', 'Banjarewala, Haridwar, Uttarakhand'),
(19, 'ALIPURDUAR DISTRICT HOSPITAL 3', 'Gov', '1234567890', 'vaccinecenter@gmail.com', '28', '27', 'West Bengal', '736121', 'Alipurduar DH, Alipurduar District, West Bengal'),
(20, 'AMBIKANAGAR SC RANI', 'Pvt', '1234567890', 'vaccinecenter@gmail.com', '28', '28', 'West Bengal', '722135', 'Ambikanagar SC Ranibandh Bankura, Bankura, West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine_stock`
--

DROP TABLE IF EXISTS `vaccine_stock`;
CREATE TABLE IF NOT EXISTS `vaccine_stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `vaccine_center_id` int(11) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `comp_pnumber` varchar(11) NOT NULL,
  `comp_state` varchar(255) NOT NULL,
  `comp_district` varchar(255) NOT NULL,
  `comp_pincode` varchar(6) NOT NULL,
  `comp_address` text NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD CONSTRAINT `appoinment_ibfk_1` FOREIGN KEY (`vc_id`) REFERENCES `vaccine_center` (`vc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`vc_id`) REFERENCES `vaccine_center` (`vc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`vaccinator_id`) REFERENCES `vaccinator` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`stock_no`) REFERENCES `vaccine_stock` (`stock_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccinator`
--
ALTER TABLE `vaccinator`
  ADD CONSTRAINT `vaccinator_ibfk_1` FOREIGN KEY (`vc_id`) REFERENCES `vaccine_center` (`vc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

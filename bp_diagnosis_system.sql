-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2019 at 11:30 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bp_diagnosis_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `hashedPassword` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `name`, `email`, `gender`, `hashedPassword`, `created_on`) VALUES
(1, 'doctorsalman12345', 'salman', 'salman@gmail.com', '1', '$2y$10$aX2VYnTUebj2WMls5rHhwuGhOpk0v4B8wToG/CIJWIHLf3fO0wMsO', '0000-00-00 00:00:00'),
(2, 'doctorsalman123456', 'salman', 'salmanDoctor@gmail.com', '1', '$2y$10$gIK7.CDTP/AkJsR4Q0QPYec/GZBlGsudDgYzH0Ydfqrfe7YfpDUiu', '0000-00-00 00:00:00'),
(3, 'admin12345678', 'Shahzaib Mughal', 'admin@gmail.com', 'male', '$2y$10$NIcDESZ0Anp5jjRVBzAX7.1b5la6hfvtpVd.yD015ZO4tx66PU9DC', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_problem` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_problem`, `patient_id`, `doctor_id`, `date`, `time`, `status`, `created_on`) VALUES
(11, 'Lorem ipsum', 47, 15, '2019-04-18', '01:00', 'CONFIRMED BY DOCTOR', '0000-00-00 00:00:00'),
(12, 'Lorem ipsumm', 47, 15, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '0000-00-00 00:00:00'),
(13, 'Lorem ipsummmm', 47, 15, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '0000-00-00 00:00:00'),
(14, 'Lorem ipsummmm', 47, 15, '2019-04-16', '01:00', 'CONFIRMED BY DOCTOR', '2019-04-08 19:28:04'),
(15, 'Lorem ipsummmm', 47, 15, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '2019-04-08 19:28:15'),
(16, 'abcdef', 48, 15, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '2019-04-11 14:18:52'),
(17, 'dsaf', 47, 15, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '2019-04-11 14:23:45'),
(18, 'Wooooooooooooooooooooooooooooo', 47, 15, '2019-04-13', '01:00', 'CONFIRMED BY DOCTOR', '2019-04-11 19:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `hashedPassword` varchar(255) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `specialization` varchar(60) NOT NULL,
  `qualification` varchar(60) NOT NULL,
  `fees` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `username`, `name`, `email`, `gender`, `hashedPassword`, `phone`, `address`, `city`, `dob`, `about`, `specialization`, `qualification`, `fees`, `created_on`) VALUES
(15, 'doc@gmail.com', 'Doctor Sulman Chisti', 'doctor@gmail.com', 'male', '$2y$10$W3RGT/MRjjbygyyyKE/5M.xkfNgkfGdQFnn3RHwgT4wqvHhzJHI8m', '03056302013', 'Cheema Colony Street #6 Sialkot Road', 'lahore', '2019-03-07', 'lorem ipsum ipsum lorem lorem ', 'Heart specialisttttttttt', 'MBBS', 4200, '2019-03-29 20:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `hashedPassword` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `username`, `name`, `email`, `gender`, `hashedPassword`, `phone`, `address`, `city`, `dob`, `created_on`) VALUES
(47, 'shahzaib123456789', 'Shahzaib', 'patient@gmail.com', 'male', '$2y$10$hRPUxcdtC724tla8kUpnGem8JFCgF5kW2CtbNWaZTxulHlqQ76pgC', '03050710090', 'Cheema coloney street no 12, near noria rizwia masjid', 'wazirabad', '2019-03-05', '2019-03-29 20:31:15'),
(48, 'tayyab123456', 'Tayyab', 'tayyab@gmail.com', 'female', '$2y$10$sjUuE1v9ft6SGCVbJ21oDuoFWO1c5yJ/W3Y6AWz8Sj3xckKZdzvBy', '03041612193', 'Lorem ipslum ipsum lorem lorem', 'Wazirabad', '2019-04-26', '2019-04-11 14:16:15'),
(49, 'test123456', 'test', 'test@gmail.com', 'male', '$2y$10$EKy06WcP0uonF5nXwJSR3eTEPt/1f48dnsgreuaBe/LYujHx7WDGK', '03056302013', 'asdjfl sdkljf klasdjf afj klasdfklasdj ls', 'wazirabad', '2019-04-25', '2019-04-12 16:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_table`
--

CREATE TABLE `prescription_table` (
  `prescription_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` varchar(60) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `bp_low` int(5) NOT NULL,
  `bp_high` int(5) NOT NULL,
  `headache` tinyint(1) NOT NULL DEFAULT '0',
  `dizziness` tinyint(1) NOT NULL DEFAULT '0',
  `visual_changes` varchar(255) NOT NULL,
  `medication` varchar(255) NOT NULL,
  `food_detail` varchar(255) NOT NULL,
  `exercise_detail` varchar(255) NOT NULL,
  `other_info` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_table`
--

INSERT INTO `prescription_table` (`prescription_id`, `doctor_id`, `patient_id`, `status`, `subject`, `bp_low`, `bp_high`, `headache`, `dizziness`, `visual_changes`, `medication`, `food_detail`, `exercise_detail`, `other_info`, `created_on`) VALUES
(16, 15, 47, 'NOT Answered', 'lorem ipsum', 60, 150, 1, 1, 'no ', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:00'),
(17, 15, 47, 'Answered', '2222 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:24'),
(18, 15, 47, 'Answered', '33333 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:29'),
(19, 15, 47, 'Answered', '44444 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:33'),
(20, 15, 47, 'Answered', '555555 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:37'),
(21, 15, 47, 'NOT Answered', '6666666  redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:42'),
(22, 15, 47, 'Answered', 'Sir drd', 234, 423423, 1, 1, 'asfasd', 'asdfasdf', 'sdafasdf', 'asdfasd', 'afdfdasfasd', '2019-03-30 12:20:17'),
(23, 0, 47, 'NOT Answered', 'Problem', 90, 130, 1, 1, 'pale', 'cetrizine', 'rice, bread', 'walking', '', '2019-04-08 12:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `prescription_id` int(11) NOT NULL,
  `is_doctor_reply` tinyint(1) NOT NULL,
  `replay_message` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`prescription_id`, `is_doctor_reply`, `replay_message`, `timestamp`) VALUES
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'asdfdasfad', '0000-00-00 00:00:00'),
(12, 1, 'Hello', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, '232232', '0000-00-00 00:00:00'),
(12, 1, '232232', '0000-00-00 00:00:00'),
(13, 1, '4343', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(12, 1, 'sdafad', '0000-00-00 00:00:00'),
(16, 1, 'Hello ', '0000-00-00 00:00:00'),
(21, 1, '43343', '0000-00-00 00:00:00'),
(18, 1, 'Haloooooo', '0000-00-00 00:00:00'),
(18, 0, 'Hello from patient', '0000-00-00 00:00:00'),
(18, 0, 'Hello from patient', '0000-00-00 00:00:00'),
(18, 0, 'Hello from patient', '0000-00-00 00:00:00'),
(18, 0, 'Hello from patient', '0000-00-00 00:00:00'),
(18, 1, 'Haloooo From doctor', '0000-00-00 00:00:00'),
(18, 0, 'Haloo from patient', '0000-00-00 00:00:00'),
(22, 1, 'HalllllllllOOOOOOOOO', '0000-00-00 00:00:00'),
(22, 0, '', '0000-00-00 00:00:00'),
(17, 1, 'aaaa', '0000-00-00 00:00:00'),
(19, 1, '423423243asdfasd ', '0000-00-00 00:00:00'),
(20, 1, '', '0000-00-00 00:00:00'),
(20, 1, 'asdfdas', '0000-00-00 00:00:00'),
(20, 1, 'dsesdafsd', '0000-00-00 00:00:00'),
(20, 1, 'dsesdafsdasdfsd', '0000-00-00 00:00:00'),
(20, 1, '243asfd', '0000-00-00 00:00:00'),
(20, 1, 'sdfadsfsasd', '0000-00-00 00:00:00'),
(20, 1, 'Hallllllllllllllllllllllllooooooooooooooooooooooooooooo', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `rating` int(2) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `rating`, `doctor_id`, `patient_id`, `subject`, `message`, `created_on`) VALUES
(1, 5, 15, 47, 'Happyyyyyyyyyyyyyyytttttt', 'heheehhehehehhhehehehhe', '2019-04-11 21:19:33'),
(3, 3, 15, 48, 'Lorem Ipsum', 'sdafasdfas', '2019-04-11 21:19:33'),
(6, 5, 15, 49, '43543q', 'sdafdasfsda', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `prescription_table`
--
ALTER TABLE `prescription_table`
  ADD PRIMARY KEY (`prescription_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `prescription_table`
--
ALTER TABLE `prescription_table`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

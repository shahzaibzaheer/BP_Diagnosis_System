-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2019 at 12:11 PM
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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_problem` varchar(255) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_problem`, `patient_id`, `doctor_id`, `date`, `time`, `status`, `created_on`) VALUES
(1, 'Lorem Ipsum', 47, 15, '2019-03-12', '02:00', 'CANCELED_BY_DOCTOR', '0000-00-00 00:00:00'),
(2, 'Lorem Ipsum', 47, 15, '2019-03-06', '01:00', 'CANCELED_BY_PATIENT', '0000-00-00 00:00:00'),
(3, '', 0, 0, '', '', '0', '0000-00-00 00:00:00'),
(4, '', 0, 0, '', '', '0', '0000-00-00 00:00:00'),
(5, '', 0, 0, '', '', '0', '0000-00-00 00:00:00'),
(6, '', 0, 0, '', '', '0', '0000-00-00 00:00:00'),
(7, 'asdf', 47, 15, ' ---- ', ' ---- ', 'CANCELED_BY_PATIENT', '0000-00-00 00:00:00'),
(8, 'Halooooooo', 47, 15, '', '', '0', '0000-00-00 00:00:00'),
(9, 'asdfasd', 47, 15, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '0000-00-00 00:00:00');

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
(15, 'doc@gmail.com', 'doctorsulamn', 'doctor@gmail.com', 'male', '$2y$10$W3RGT/MRjjbygyyyKE/5M.xkfNgkfGdQFnn3RHwgT4wqvHhzJHI8m', '03056302013', 'Cheema Colony Street #6 Sialkot Road', 'lahore', '2019-03-07', 'lorem ipsum ipsum lorem lorem ', 'Heart specialist', 'MBBS', 200, '2019-03-29 20:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '1',
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
(47, 'shahzaib123456789', 'Shahzaib', 'patient@gmail.com', 1, '$2y$10$hRPUxcdtC724tla8kUpnGem8JFCgF5kW2CtbNWaZTxulHlqQ76pgC', '03050710090', 'Cheema coloney street no 12, near noria rizwia masjid', 'wazirabad', '2019-03-05', '2019-03-29 20:31:15');

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
(17, 0, 47, 'NOT Answered', '2222 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:24'),
(18, 15, 47, 'Answered', '33333 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:29'),
(19, 0, 47, 'NOT Answered', '44444 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:33'),
(20, 0, 47, 'NOT Answered', '555555 redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:37'),
(21, 15, 47, 'NOT Answered', '6666666  redsfsd', 60, 150, 1, 1, 'no asfd', 'no ', 'no ', 'no ', 'no ', '2019-03-29 20:33:42');

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
(18, 0, 'Haloo from patient', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `prescription_table`
--
ALTER TABLE `prescription_table`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

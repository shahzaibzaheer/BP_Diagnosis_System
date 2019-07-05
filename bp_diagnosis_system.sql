-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2019 at 10:13 PM
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
(4, 'Admin123456789', 'Admin', 'admin@gmail.com', 'male', '$2y$10$F/0N15TitjDlABn8Garo4O69Hj0jv3q5biqq0ZTNVv6Od/bRAEXya', '0000-00-00 00:00:00');

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
(26, 'Low Blood Pressure Problem', 56, 23, '2019-07-31', '13:00', 'CONFIRMED BY DOCTOR', '2019-07-05 19:56:21'),
(27, 'H', 56, 23, ' ---- ', ' ---- ', 'CANCELED_BY_DOCTOR', '2019-07-05 19:59:46'),
(28, 'Low blood pressure problem', 56, 24, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '2019-07-05 20:00:36'),
(29, 'Lorem Ipsum', 56, 23, ' ---- ', ' ---- ', 'NOT CONFIRMED BY DOCTOR', '2019-07-05 20:11:07');

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
(23, 'Doctor123456789', 'Ijaz', 'doctor@gmail.com', 'male', '$2y$10$WoSZSYYybPOMY8wZfV/3.eimZCM7.TeU7F0BGFSreUSWHQT05uwQO', '03041111111', '4177 Ruckman Road Oklahoma City, OK 73116', 'Oklahoma', '1995-03-16', 'i am experts on the heart and blood vessels. You might see them for heart failure, a heart attack, high blood pressure, or an irregular heartbeat.', 'Heart Specialist', 'MBBS', 1500, '2019-07-05 19:53:29'),
(24, 'asghar123456789', 'Asghar', 'asghar@gmail.com', 'male', '$2y$10$mjL/V8I/7jl0MSEHT7GZ7efcBYMf/4oOVPEse//TsxZ/d04OvtUdy', '03112222222', '4177 Ruckman Road Oklahoma City, OK 73116', 'Oklahoma', '2015-06-18', 'Lorem ipsum , lorem ipsum ipsum lorem', 'Cardiologist', 'MBBS', 600, '2019-07-05 19:58:46');

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
(56, 'Patient123456789', 'Ahmed ', 'patient@gmail.com', 'male', '$2y$10$lvpohl48h5ROH0jfk9blEuSLnc4ZT4T8BDQFaVTXvjQc8C2MLw/W2', '03051213145', '4177 Ruckman Road Oklahoma City, OK 73116', 'Oklahoma', '1998-01-01', '2019-07-05 19:48:45');

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
(26, 23, 56, 'Answered', 'Low Blood Pressure Problem', 60, 120, 0, 0, 'Pale', 'First time i feel low blood pressure, no modication used before', 'Junk Food', 'No Exercise', '', '2019-07-05 19:55:55'),
(27, 0, 56, 'NOT Answered', 'Lorem Ipsum', 100, 190, 0, 0, 'no', 'no', 'no', 'no', 'no', '2019-07-05 20:10:45');

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
(26, 1, 'I understand your problem, Here\'s my number #0300-1234567 contact me', '0000-00-00 00:00:00');

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
(8, 4, 23, 56, 'Greate Doctor', 'Very Great doctor, listen carefully and fast response time', '0000-00-00 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `prescription_table`
--
ALTER TABLE `prescription_table`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

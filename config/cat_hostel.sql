-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2023 at 12:08 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.8
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Database: `cat_hostel`
--
DROP DATABASE IF EXISTS `cat_hostel`;
CREATE DATABASE IF NOT EXISTS `cat_hostel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `cat_hostel`;
-- --------------------------------------------------------
--
-- Table structure for table `Booking`
--

DROP TABLE IF EXISTS `Booking`;
CREATE TABLE `Booking` (
  `booking_id` int NOT NULL,
  `room_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `booking_reference` varchar(10) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
-- --------------------------------------------------------
--
-- Table structure for table `Cat`
--

DROP TABLE IF EXISTS `Cat`;
CREATE TABLE `Cat` (
  `cat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_gender` varchar(10) NOT NULL,
  `cat_color` varchar(15) NOT NULL,
  `cat_weight` int NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
--
-- Dumping data for table `Cat`
--

INSERT INTO `Cat` (
    `cat_id`,
    `user_id`,
    `cat_name`,
    `cat_gender`,
    `cat_color`,
    `cat_weight`
  )
VALUES (1, 1, 'Meow', 'Male', 'Orange', 3),
  (2, 2, 'Cat', 'Male', 'White', 3);
-- --------------------------------------------------------
--
-- Table structure for table `Room`
--

DROP TABLE IF EXISTS `Room`;
CREATE TABLE `Room` (
  `room_id` int NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `room_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
--
-- Dumping data for table `Room`
--

INSERT INTO `Room` (`room_id`, `room_name`, `room_description`)
VALUES (2, 'New Room', 'Test add new room');
-- --------------------------------------------------------
--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_contact` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_role` varchar(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
--
-- Dumping data for table `User`
--

INSERT INTO `User` (
    `user_id`,
    `user_name`,
    `user_gender`,
    `user_contact`,
    `user_email`,
    `user_password`,
    `user_role`
  )
VALUES (
    1,
    'staff',
    'Male',
    '12345',
    'staff@email.com',
    'password',
    'Staff'
  ),
  (
    2,
    'customer',
    'Male',
    '12345',
    'customer@email.com',
    'password',
    'Customer'
  );
--
-- Indexes for dumped tables
--

--
-- Indexes for table `Booking`
--
ALTER TABLE `Booking`
ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_cat` (`cat_id`),
  ADD KEY `booking_room` (`room_id`);
--
-- Indexes for table `Cat`
--
ALTER TABLE `Cat`
ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_owner` (`user_id`);
--
-- Indexes for table `Room`
--
ALTER TABLE `Room`
ADD PRIMARY KEY (`room_id`);
--
-- Indexes for table `User`
--
ALTER TABLE `User`
ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Booking`
--
ALTER TABLE `Booking`
MODIFY `booking_id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Cat`
--
ALTER TABLE `Cat`
MODIFY `cat_id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `Room`
--
ALTER TABLE `Room`
MODIFY `room_id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `user_id` int NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Booking`
--
ALTER TABLE `Booking`
ADD CONSTRAINT `booking_cat` FOREIGN KEY (`cat_id`) REFERENCES `Cat` (`cat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_room` FOREIGN KEY (`room_id`) REFERENCES `Room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- Constraints for table `Cat`
--
ALTER TABLE `Cat`
ADD CONSTRAINT `cat_owner` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
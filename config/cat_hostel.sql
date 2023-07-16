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
CREATE DATABASE IF NOT EXISTS `cat_hostel`;
USE `cat_hostel`;
DROP TABLE IF EXISTS `Booking`;
CREATE TABLE `Booking` (
  `booking_id` int NOT NULL,
  `room_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `booking_reference` varchar(10) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `Booking`;
DROP TABLE IF EXISTS `Cat`;
CREATE TABLE `Cat` (
  `cat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_gender` varchar(10) NOT NULL,
  `cat_color` varchar(15) NOT NULL,
  `cat_weight` int NOT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `Cat`;
DROP TABLE IF EXISTS `Room`;
CREATE TABLE `Room` (
  `room_id` int NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `room_description` varchar(255) DEFAULT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `Room`;
DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_contact` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `user_active` tinyint(1) NOT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `User`;
INSERT INTO `User` (
    `user_id`,
    `user_name`,
    `user_gender`,
    `user_contact`,
    `user_email`,
    `user_password`,
    `user_role`,
    `user_active`
  )
VALUES (
    1,
    'staff',
    'Male',
    '12345',
    'staff@email.com',
    'password',
    'Staff',
    1
  ),
  (
    2,
    'customer',
    'Female',
    '12345',
    'customer2@email.com',
    'password',
    'Customer',
    0
  );
ALTER TABLE `Booking`
ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_cat` (`cat_id`),
  ADD KEY `booking_room` (`room_id`);
ALTER TABLE `Cat`
ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_owner` (`user_id`);
ALTER TABLE `Room`
ADD PRIMARY KEY (`room_id`);
ALTER TABLE `User`
ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
ALTER TABLE `Booking`
MODIFY `booking_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `Cat`
MODIFY `cat_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `Room`
MODIFY `room_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `User`
MODIFY `user_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `Booking`
ADD CONSTRAINT `booking_cat` FOREIGN KEY (`cat_id`) REFERENCES `Cat` (`cat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_room` FOREIGN KEY (`room_id`) REFERENCES `Room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `Cat`
ADD CONSTRAINT `cat_owner` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
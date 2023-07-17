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
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `booking_id` int NOT NULL,
  `room_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `booking_reference` varchar(10) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `booking`;
DROP TABLE IF EXISTS `cat`;
CREATE TABLE `cat` (
  `cat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_gender` varchar(10) NOT NULL,
  `cat_color` varchar(15) NOT NULL,
  `cat_weight` int NOT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `cat`;
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `room_id` int NOT NULL,
  `room_name` varchar(50) NOT NULL,
  `room_description` varchar(255) DEFAULT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `room`;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_contact` varchar(15) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_role` varchar(10) NOT NULL,
  `user_active` tinyint(1) NOT NULL
) ENGINE = InnoDB;
TRUNCATE TABLE `user`;
INSERT INTO `user` (
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
    '$2y$10$OClEyak21GcxN.EAahQyBOexKPbhtGAXwfRGZWt33GwHizyOYYnx2',
    'Staff',
    1
  ),
  (
    2,
    'customer',
    'Female',
    '12345',
    'customer@email.com',
    '$2y$10$ZGwKrqFPT1JHusq3CDVQiurM7rWlY0Vvi/gDt0QxZf/SMacZM9A32',
    'Customer',
    0
  );
ALTER TABLE `booking`
ADD PRIMARY KEY (`booking_id`),
  ADD KEY `booking_cat` (`cat_id`),
  ADD KEY `booking_room` (`room_id`);
ALTER TABLE `cat`
ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_owner` (`user_id`);
ALTER TABLE `room`
ADD PRIMARY KEY (`room_id`);
ALTER TABLE `user`
ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
ALTER TABLE `booking`
MODIFY `booking_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `cat`
MODIFY `cat_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `room`
MODIFY `room_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `user`
MODIFY `user_id` int NOT NULL AUTO_INCREMENT;
ALTER TABLE `booking`
ADD CONSTRAINT `booking_cat` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`cat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `booking_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `cat`
ADD CONSTRAINT `cat_owner` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
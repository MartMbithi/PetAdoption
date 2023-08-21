-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2023 at 05:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_adoption`
--

-- --------------------------------------------------------

--
-- Table structure for table `adopter`
--

CREATE TABLE `adopter` (
  `adopter_id` int(200) NOT NULL,
  `adopter_full_name` varchar(200) NOT NULL,
  `adoper_contacts` varchar(200) NOT NULL,
  `adopter_email` varchar(200) NOT NULL,
  `adopter_login_id` varchar(200) NOT NULL,
  `adopter_location` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adopter`
--

INSERT INTO `adopter` (`adopter_id`, `adopter_full_name`, `adoper_contacts`, `adopter_email`, `adopter_login_id`, `adopter_location`) VALUES
(3, 'Hillary Brim', '+344-7764098-943', 'hillary909@gmail.com', 'e642cbecb2b0fc071b17fa7f6b6e1eb500bf9cb2c12b', '120 Dallas, Texas'),
(4, 'Brian O`Corner', '+9008-88842395-43', 'brianoc90@gmail.com', '8f89bdd0e0433903a3b4f8c32b4cf71fce99dd993cb2', '127-987 Detroit, Michigan'),
(7, 'Salma Moses', '90348231213', 'salma90@gmail.com', '11f60750eacd9d6570335786d781f63a33e561009991f4', '9093 Hydrabad');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(200) NOT NULL,
  `login_email` varchar(200) NOT NULL,
  `login_password` varchar(200) NOT NULL,
  `login_rank` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_email`, `login_password`, `login_rank`) VALUES
('11f60750eacd9d6570335786d781f63a33e561009991f4', 'salma90@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Pet Adopter'),
('61354fd7a36f8a20f8947cbecfdb44eff36ff934c8', 'admin@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Administrator'),
('6b96aeafd7a36f8a20f8947cbecfdb44eff36ff934c8', 'kim90@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Pet Owner'),
('8f89bdd0e0433903a3b4f8c32b4cf71fce99dd993cb2', 'brianoc90@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Pet Adopter'),
('97b6286056956dc5fef496b6a3a885c363a81e272742b2', 'mahindra90@outlook.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Pet Owner'),
('ac68b13414a283910ffbe94fce1165367580fc9809d5', 'dedanjones90@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Pet Owner'),
('e642cbecb2b0fc071b17fa7f6b6e1eb500bf9cb2c12b', 'hillary909@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Pet Adopter');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pet_id` int(200) NOT NULL,
  `pet_name` varchar(200) NOT NULL,
  `pet_breed` varchar(200) NOT NULL,
  `pet_age` varchar(200) NOT NULL,
  `pet_health_status` varchar(200) NOT NULL,
  `pet_pet_owner` int(200) NOT NULL,
  `pet_adoption_status` varchar(200) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`pet_id`, `pet_name`, `pet_breed`, `pet_age`, `pet_health_status`, `pet_pet_owner`, `pet_adoption_status`) VALUES
(3, 'Dark Knight', 'Dog', '1 Year', 'Ill', 3, 'Adopted'),
(5, 'Fire Dragon', 'Dove', '5 Years', 'Healthy', 2, 'Adopted'),
(6, 'Fierce Tiger', 'Dog', '3 Years', 'Healthy', 2, 'Adopted'),
(7, 'Chihuahua', 'Dog', '20 Months', 'Healthy', 5, 'Adopted'),
(8, 'German Shepard', 'Dog', '2 Years', 'Healthy', 5, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `pet_adoption_id` int(200) NOT NULL,
  `pet_adoption_pet_id` int(200) NOT NULL,
  `pet_adoption_adopter_id` int(200) NOT NULL,
  `pet_adoption_date_adopted` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`pet_adoption_id`, `pet_adoption_pet_id`, `pet_adoption_adopter_id`, `pet_adoption_date_adopted`) VALUES
(16, 5, 3, '08/03/2022'),
(17, 3, 4, '09/02/2023'),
(19, 6, 4, '08/29/2022'),
(20, 7, 7, '06/17/2023');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption_feedback`
--

CREATE TABLE `pet_adoption_feedback` (
  `feedback_id` int(200) NOT NULL,
  `feedback_pet_adoption_id` int(200) NOT NULL,
  `feedback_title` longtext NOT NULL,
  `feedback_details` longtext NOT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_adoption_feedback`
--

INSERT INTO `pet_adoption_feedback` (`feedback_id`, `feedback_pet_adoption_id`, `feedback_title`, `feedback_details`, `feedback_date`) VALUES
(1, 16, 'This is a test feedback', 'This is a test feedback to test the feedback module.', '2023-06-17 09:08:08'),
(2, 20, 'Pet health status', 'Hello, \r\nThis pet has unforseen health condition. But you had indicated that it is health, even though its not a big issue I have taken it to a vet, soon it will be aright.', '2023-06-17 09:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `pet_owner`
--

CREATE TABLE `pet_owner` (
  `pet_owner_id` int(200) NOT NULL,
  `pet_owner_full_name` varchar(200) NOT NULL,
  `pet_owner_email` varchar(200) NOT NULL,
  `pet_owner_contacts` varchar(200) NOT NULL,
  `pet_owner_address` longtext NOT NULL,
  `pet_owner_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_owner`
--

INSERT INTO `pet_owner` (`pet_owner_id`, `pet_owner_full_name`, `pet_owner_email`, `pet_owner_contacts`, `pet_owner_address`, `pet_owner_login_id`) VALUES
(2, 'Dedan John', 'dedanjones90@gmail.com', '+9093-999423-04', '90126 Localhost', 'ac68b13414a283910ffbe94fce1165367580fc9809d5'),
(3, 'Kim Hayes', 'kim90@gmail.com', '+90-88483889', '90236 Michigan Detroit', '6b96aeafd7a36f8a20f8947cbecfdb44eff36ff934c8'),
(5, 'Mahindra Gadhi ', 'mahindra90@outlook.com', '+908923242323', '127 Hydrebad', '97b6286056956dc5fef496b6a3a885c363a81e272742b2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopter`
--
ALTER TABLE `adopter`
  ADD PRIMARY KEY (`adopter_id`),
  ADD KEY `AopterLoginID` (`adopter_login_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `PetOwnerPet` (`pet_pet_owner`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`pet_adoption_id`),
  ADD KEY `PetDetails` (`pet_adoption_pet_id`),
  ADD KEY `AdopterDetails` (`pet_adoption_adopter_id`);

--
-- Indexes for table `pet_adoption_feedback`
--
ALTER TABLE `pet_adoption_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `FeedbackPetAdoptionID` (`feedback_pet_adoption_id`);

--
-- Indexes for table `pet_owner`
--
ALTER TABLE `pet_owner`
  ADD PRIMARY KEY (`pet_owner_id`),
  ADD KEY `PetOwnerLogin` (`pet_owner_login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopter`
--
ALTER TABLE `adopter`
  MODIFY `adopter_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `pet_adoption_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pet_adoption_feedback`
--
ALTER TABLE `pet_adoption_feedback`
  MODIFY `feedback_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet_owner`
--
ALTER TABLE `pet_owner`
  MODIFY `pet_owner_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adopter`
--
ALTER TABLE `adopter`
  ADD CONSTRAINT `AopterLoginID` FOREIGN KEY (`adopter_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `PetOwnerPet` FOREIGN KEY (`pet_pet_owner`) REFERENCES `pet_owner` (`pet_owner_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `AdopterDetails` FOREIGN KEY (`pet_adoption_adopter_id`) REFERENCES `adopter` (`adopter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PetDetails` FOREIGN KEY (`pet_adoption_pet_id`) REFERENCES `pets` (`pet_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_adoption_feedback`
--
ALTER TABLE `pet_adoption_feedback`
  ADD CONSTRAINT `FeedbackPetAdoptionID` FOREIGN KEY (`feedback_pet_adoption_id`) REFERENCES `pet_adoption` (`pet_adoption_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_owner`
--
ALTER TABLE `pet_owner`
  ADD CONSTRAINT `PetOwnerLogin` FOREIGN KEY (`pet_owner_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

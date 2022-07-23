-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 19, 2022 at 05:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `driver_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_requests`
--

CREATE TABLE `accepted_requests` (
  `accepted_request_id` int(200) NOT NULL,
  `accepted_request_request_id` int(200) NOT NULL,
  `accepted_request_driver_id` int(200) NOT NULL,
  `accepted_request_date` varchar(200) NOT NULL,
  `accepted_request_time` varchar(200) NOT NULL,
  `accepted_request_coodinates` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accepted_requests`
--

INSERT INTO `accepted_requests` (`accepted_request_id`, `accepted_request_request_id`, `accepted_request_driver_id`, `accepted_request_date`, `accepted_request_time`, `accepted_request_coodinates`) VALUES
(5, 1, 4, '2022-07-25', '00:00', 'Machakos'),
(6, 5, 6, '2022-07-26', '11:25', 'Likoni - Mombasa'),
(8, 7, 5, '2022-07-26', '00:00', 'Mtwapa - Mombasa'),
(9, 8, 5, '2022-07-26', '23:00', 'Bamburi - Mombasa'),
(10, 4, 5, '2022-07-26', '12:00', 'Nairobi - Imara Daima'),
(11, 12, 5, '2022-07-26', '12:00', 'Machakos - Machakos CBD');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(200) NOT NULL,
  `car_model` varchar(200) NOT NULL,
  `car_reg_no` varchar(200) NOT NULL,
  `car_color` varchar(200) NOT NULL,
  `car_type` longtext NOT NULL,
  `car_customer_id` int(200) NOT NULL,
  `car_image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_model`, `car_reg_no`, `car_color`, `car_type`, `car_customer_id`, `car_image`) VALUES
(1, 'Toyota Hilux', 'KAA 908T', 'Navy Blue', 'Pick Up Truck', 1, 'ZJDPE03492.jpg'),
(3, 'Nissan Skyline', 'KDC 126 Q', 'Pearl White', 'Coupe', 5, 'HXYWN69038.jpg'),
(4, 'Nissan Juke', 'KBL 986 F', 'Red', 'Coupe', 4, 'GVXJH10269.jpg'),
(5, 'Ford Mustang ', 'KDG 110 Q', 'Neon Orange', 'Sport Car', 4, 'AZTXW29876.jpg'),
(7, 'Mitsubishi Lancer Evolution', 'KCA 876F', 'Maroon', 'Coupe', 4, 'YCJOF86450.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(200) NOT NULL,
  `customer_first_name` varchar(200) NOT NULL,
  `customer_other_names` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `customer_mobile_no` varchar(200) NOT NULL,
  `customer_login_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_first_name`, `customer_other_names`, `customer_email`, `customer_mobile_no`, `customer_login_id`) VALUES
(1, 'Hillary', 'Keith Johnson', 'hillarykei56@gmail.com', '+908-56386-97', '98bba7b2c183578fb2cdc3206c22862ced8258443297'),
(4, 'Frankie Grant', 'Adams', 'frankie67h@gmail.com', '+90-56638-9754', '83d85c2712d943e6c336e60c334779726a5aa0512f72'),
(5, 'Franklyn ', 'Monroe', 'monroe900@gmail.com', '+18-7564-9978534', '1061e6edb371ed64b234ba71b4cad22d5df933d7b353');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(200) NOT NULL,
  `driver_first_name` varchar(200) NOT NULL,
  `driver_other_names` varchar(200) NOT NULL,
  `driver_email` varchar(200) NOT NULL,
  `driver_mobile_no` varchar(200) NOT NULL,
  `driver_login_id` varchar(200) NOT NULL,
  `driver_image` longtext NOT NULL,
  `driver_driving_class_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_first_name`, `driver_other_names`, `driver_email`, `driver_mobile_no`, `driver_login_id`, `driver_image`, `driver_driving_class_id`) VALUES
(4, 'Jean ', 'Klause', 'jk908@gmail.com', '+65-55631242', 'ceac3e158694dd2789b8f011b158ee50ad007910bde6', 'QDOUL95467.jpg', 8),
(5, 'Jayne', 'Hudson', 'janethud67@gmail.com', '+254-73722659', '690bb31f38c6332df51a3ac100ca4d21ae7e06ae2f07', 'TKCVN30719.jpg', 6),
(6, 'Fridah', 'Klause', 'fridahkl87@hotmail.com', '+254 73456473', 'eff5bb6f6066fa5fc219bb2a4893606d18615ebc8f28', 'AQWOU63472.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `driving_classes`
--

CREATE TABLE `driving_classes` (
  `driving_class_id` int(200) NOT NULL,
  `driving_class_name` varchar(200) NOT NULL,
  `driving_class_desc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driving_classes`
--

INSERT INTO `driving_classes` (`driving_class_id`, `driving_class_name`, `driving_class_desc`) VALUES
(2, 'C1 Light Truck', 'Enables one to drive a light truck with a Gross Vehicle Weight (GVW) \r\nexceeding 3500 kg and a maximum of 7500 kg with maximum one light \r\ntrailer not exceeding 750 kg<br> Equipped with manual or automatic gear box'),
(3, 'A1 Moped', 'Enables one to ride a motorcycle of up to 50cc\r\nNo passengers allowed to be carried.\r\nNo loads\r\nNo passenger\r\nMinimum age of 16 years'),
(4, 'A2 Light Motorcycle', '<p>Enables one to ride a ride motorcycle above 50cc Can carry a maximum load of 60 Kg (for up to 400cc) Can carry a passenger</p>'),
(5, 'A3 Motorcycle taxi Couriers Three wheelers ', 'Enables one to ride a motorcycle above 100cc\r\nCan carry a maximum load of 100 Kg (for up to 50cc)\r\nCan carry a passenger'),
(6, 'B1 Light Vehicle', 'Enables one to drive a light vehicle (passenger car) with a maximum Gross Vehicle Weight (GVW) of 3500 kg with one light trailer (not exceeding 750 kg)\r\nCan drive a vehicle equipped with both a manual or automatic gearbox\r\nCan carry up to a maximum of 7 passengers'),
(7, 'B2 Light Vehicle Automatic', '<p>Enable one to drive a light vehicle (passenger car) with an automatic gear box and a maximum Gross Vehicle Weight (GVW) of 3500 kg with one light trailer (not exceeding 750 kg) Cannot drive a vehicle equipped with a manual gearbox Can carry up to a maximum of 7 passengers Minimum age of 18 years</p>'),
(8, 'B3 Professional', 'Enables one to drive a light vehicle (passenger car) with a maximum Gross Vehicle Weight (GVW) of 3500 kg with one light trailer (not exceeding 750 kg)\r\nEquipped with a manual or automatic gear box\r\nCan carry up to a maximum of 7 passengers\r\nMinimum age of 21 years');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` varchar(200) NOT NULL,
  `login_user_name` varchar(200) NOT NULL,
  `login_password` varchar(200) NOT NULL,
  `login_rank` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_user_name`, `login_password`, `login_rank`) VALUES
('1061e6edb371ed64b234ba71b4cad22d5df933d7b353', 'monroe900@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('263e6d859a74146e14440a14867868f5f5be4bce34ee', 'martdevelopers254@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Administrator'),
('3ee36c8b15b91295c6dfd3ed006a55ca618f3f92d8b0', 'sysadmin@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Administrator'),
('690bb31f38c6332df51a3ac100ca4d21ae7e06ae2f07', 'janethud67@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Driver'),
('83d85c2712d943e6c336e60c334779726a5aa0512f72', 'frankie67h@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('98bba7b2c183578fb2cdc3206c22862ced8258443297', 'hillarykei56@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Customer'),
('ceac3e158694dd2789b8f011b158ee50ad007910bde6', 'jk908@gmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Driver'),
('eff5bb6f6066fa5fc219bb2a4893606d18615ebc8f28', 'fridahkl87@hotmail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(200) NOT NULL,
  `payment_amount` varchar(200) NOT NULL,
  `payment_ref` varchar(200) NOT NULL,
  `payment_mode` varchar(200) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_accepted_request_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_amount`, `payment_ref`, `payment_mode`, `payment_date`, `payment_accepted_request_id`) VALUES
(2, '2500', '05INJEDRM4', 'Mpesa', '2022-07-19 12:07:19', 5),
(4, '56000', 'RA90FVJU3Z', 'Cheque / Bank Transfer', '2022-07-19 12:38:59', 6),
(5, '4500', 'YZ62B9X5CN', 'Cash', '2022-07-19 14:36:14', 10),
(6, '56000', '6BIF91385W', 'Cheque / Bank Transfer', '2022-07-19 14:36:35', 8),
(7, '5900', 'RJAGSEL62M', 'Cheque / Bank Transfer', '2022-07-19 15:45:08', 11);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(200) NOT NULL,
  `rating_stars` varchar(200) NOT NULL,
  `rating_description` longtext NOT NULL,
  `rating_accepted_requested_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `rating_stars`, `rating_description`, `rating_accepted_requested_id`) VALUES
(7, '5', '<p>Fully skilled driver, delivered my car in one piece, clean and without a scratch. Thanks a lot.<br></p>', 6),
(8, '5', 'Fully skilled driver, delivered my car in one piece, clean and without a scratch. Thanks a lot.s', 10),
(9, '5', '<p>Fully skilled driver, delivered my car in one piece, clean and without a scratch. Thanks a lot.</p>', 9),
(10, '5', '<p>Fully skilled driver, delivered my car in one piece, clean and without a scratch. Thanks a lot.s<br></p>', 11);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(200) NOT NULL,
  `request_ref` varchar(200) NOT NULL,
  `request_car_id` int(200) NOT NULL,
  `request_source_coodinates` longtext NOT NULL,
  `request_destination_coodinates` longtext NOT NULL,
  `request_date` varchar(200) NOT NULL,
  `request_time` varchar(200) NOT NULL,
  `request_status` varchar(200) NOT NULL DEFAULT 'Pending',
  `request_total_amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `request_ref`, `request_car_id`, `request_source_coodinates`, `request_destination_coodinates`, `request_date`, `request_time`, `request_status`, `request_total_amount`) VALUES
(1, 'C9X2ZWFA', 1, 'Nairobi - Imara Daima', 'Nairobi - Kiambu Road', '2022-07-25', '10:00', 'Accepted', '2500'),
(4, '80Y1RPMS', 1, 'Nairobi - Imara Daima', 'Kiambu', '2022-07-26', '12:09', 'Accepted', '4500'),
(5, '3DYGWES9', 5, 'Port Of Mombasa', 'Nairobi - Kiambu Road', '2022-07-26', '00:00', 'Accepted', '56000'),
(7, 'FTEGWE89', 3, 'Port Of Mombasa', 'Nairobi - Sarit Center, Westlands', '2022-07-26', '00:00', 'Accepted', '56000'),
(8, 'RDFT6753', 1, 'Port Of Mombasa', 'Machakos - Machakos Town', '2022-07-26', '00:00', 'Accepted', '56000'),
(10, 'OQSFHXLC', 4, 'Machakos', 'Nairobi - Karen', '2022-07-19', '14:33', 'Pending', '4500'),
(11, '4I8PHTAM', 5, 'Nairobi - Imara Daima', 'Machakos', '2022-07-26', '09:00', 'Pending', '1500'),
(12, 'G52VSJ7O', 7, 'Kisumu', 'Nairobi - Karen', '2022-08-02', '09:00', 'Accepted', '5900');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_requests`
--
ALTER TABLE `accepted_requests`
  ADD PRIMARY KEY (`accepted_request_id`),
  ADD KEY `AcceptedRequestID` (`accepted_request_request_id`),
  ADD KEY `AcceptedRequestDriverID` (`accepted_request_driver_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `CarCustomerID` (`car_customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `CustomerLoginID` (`customer_login_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `DriverLoginID` (`driver_login_id`),
  ADD KEY `DriverDrivingClassID` (`driver_driving_class_id`);

--
-- Indexes for table `driving_classes`
--
ALTER TABLE `driving_classes`
  ADD PRIMARY KEY (`driving_class_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `PaymentAcceptedRequestID` (`payment_accepted_request_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `RatingAcceptedID` (`rating_accepted_requested_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `RequestCarID` (`request_car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_requests`
--
ALTER TABLE `accepted_requests`
  MODIFY `accepted_request_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `driving_classes`
--
ALTER TABLE `driving_classes`
  MODIFY `driving_class_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted_requests`
--
ALTER TABLE `accepted_requests`
  ADD CONSTRAINT `AcceptedRequestDriverID` FOREIGN KEY (`accepted_request_driver_id`) REFERENCES `driver` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `AcceptedRequestID` FOREIGN KEY (`accepted_request_request_id`) REFERENCES `request` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `CarCustomerID` FOREIGN KEY (`car_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `CustomerLoginID` FOREIGN KEY (`customer_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `DriverDrivingClassID` FOREIGN KEY (`driver_driving_class_id`) REFERENCES `driving_classes` (`driving_class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `DriverLoginID` FOREIGN KEY (`driver_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `PaymentAcceptedRequestID` FOREIGN KEY (`payment_accepted_request_id`) REFERENCES `accepted_requests` (`accepted_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `RatingAcceptedID` FOREIGN KEY (`rating_accepted_requested_id`) REFERENCES `accepted_requests` (`accepted_request_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `RequestCarID` FOREIGN KEY (`request_car_id`) REFERENCES `car` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

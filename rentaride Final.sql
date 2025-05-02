-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 03:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentaride`
--

-- --------------------------------------------------------

--
-- Table structure for table `bike`
--

CREATE TABLE `bike` (
  `bike_name` varchar(30) NOT NULL,
  `bike_brand` varchar(15) NOT NULL,
  `bike_type` varchar(10) NOT NULL,
  `bike_fuel` varchar(10) NOT NULL,
  `bike_no` varchar(15) NOT NULL,
  `bike_price` decimal(5,0) NOT NULL,
  `bike_avail` tinyint(1) NOT NULL DEFAULT 1,
  `bike_img` varchar(500) NOT NULL,
  `agent_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bike`
--

INSERT INTO `bike` (`bike_name`, `bike_brand`, `bike_type`, `bike_fuel`, `bike_no`, `bike_price`, `bike_avail`, `bike_img`, `agent_id`) VALUES
('Royal Enfield Classic 350', 'royalenfield', 'Bike', 'Petrol', 'GJ01AK5685', 750, 1, '350.jpg', 'agent2@9876543210'),
('Royal Enfield Classic 500', 'royalenfield', 'Bike', 'Petrol', 'GJ01AD4578', 950, 1, '500.jpg', 'agent2@9876543210'),
('TVS Jupiter 125', 'tvs', 'Scooter', 'Petrol', 'DD02JK7898', 650, 1, 'jypiter125.png', 'agent2@9876543210'),
('Honda Shine 125', 'honda', 'Bike', 'Petrol', 'GJ04DK7788', 700, 1, 'shine125.png', 'agent2@9876543210'),
('Bajaj Pulsar N125', 'bajaj', 'Bike', 'Petrol', 'KL10AS5321', 1200, 1, 'pulsarn125.png', 'agent2@9876543210'),
('Hero Splendor Plus', 'hero', 'Bike', 'Petrol', 'GJ04WE2176', 450, 1, 'splendor.png', 'agent2@9876543210'),
('Ola S1 Pro', 'ola', 'Scooter', 'Ev', 'MH02SK4474', 400, 1, 'ola-s1-air.png', 'agent2@9876543210'),
('Aprilia SR 150', 'aprilia', 'Bike', 'Ev', 'GA01AM7320', 500, 1, 'aprilia-sr-150.png', 'agent2@9876543210'),
('Vespa VXL 150', 'vespa', 'Scooter', 'Ev', 'GJ24NM5688', 650, 1, 'vespa.png', 'agent2@9876543210'),
('Suzuki Access 125', 'suzuki', 'Scooter', 'Petrol', 'DD01SD7800', 650, 1, 'access125.png', 'agent2@9876543210'),
('Suzuki V-Strom SX', 'suzuki', 'Bike', 'Petrol', 'WB02VV1236', 1350, 1, 'vstromx.png', 'agent2@9876543210'),
('Yamaha FZ S FI', 'yamaha', 'Bike', 'Petrol', 'KL23SD4565', 1000, 1, 'fzsfi.png', 'agent2@9876543210');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `b_id` int(11) NOT NULL,
  `c_id` text NOT NULL,
  `a_id` text NOT NULL,
  `b_amount` int(6) NOT NULL,
  `v_id` varchar(10) NOT NULL,
  `v_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_name` varchar(25) NOT NULL,
  `car_brand` text NOT NULL,
  `car_trans` text NOT NULL,
  `car_fuel` text NOT NULL,
  `car_seat` int(1) NOT NULL,
  `car_milege` text NOT NULL,
  `car_price` decimal(5,0) NOT NULL,
  `car_no` text NOT NULL,
  `car_avail` tinyint(1) NOT NULL DEFAULT 1,
  `car_img` varchar(500) NOT NULL,
  `agent_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_name`, `car_brand`, `car_trans`, `car_fuel`, `car_seat`, `car_milege`, `car_price`, `car_no`, `car_avail`, `car_img`, `agent_id`) VALUES
('Toyota Innova', 'Toyota', 'Manual', 'Petrol', 7, '16kmpl', 2800, 'BL15NN7898', 1, 'innova.jpeg', 'agent2@9876543210'),
('Kia Carnival', 'Kia', 'Automatic', 'Diesel', 9, '8kmpl', 3000, 'DL05MM5645', 1, 'carnival.jpeg', 'agent2@9876543210'),
('Volkswagen Virtus', 'Volkswagen', 'Manual', 'Diesel', 5, '10kmpl', 2500, 'GA02DD2321', 1, 'virtus.jpeg', 'agent2@9876543210'),
('Maruti Suzuki Swift', 'Maruti Suzuki', 'Manual', 'Petrol', 5, '25kmpl', 1500, 'GJ05AK4558', 1, 'swift.jpeg', 'agent2@9876543210'),
('Maruti Suzuki Fronx', 'Maruti Suzuki', 'Automatic', 'Petrol', 5, '18kmpl', 1800, 'KL10EW5696', 1, 'fronx.jpeg', 'agent2@9876543210'),
('Hyundai i20', 'Hyundai', 'Automatic', 'Diesel', 5, '15kmpl', 2000, 'MH26AZ5598', 1, 'i20.png', 'agent2@9876543210');

-- --------------------------------------------------------

--
-- Table structure for table `rental_agent`
--

CREATE TABLE `rental_agent` (
  `agent_name` text NOT NULL,
  `agent_id` text NOT NULL,
  `agent_email` text NOT NULL,
  `agent_contact` decimal(10,0) NOT NULL,
  `agent_add` text NOT NULL,
  `agent_state` text NOT NULL,
  `agent_city` text DEFAULT NULL,
  `agent_aadhr` decimal(12,0) NOT NULL,
  `agent_pass` text NOT NULL,
  `agent_profile` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rental_agent`
--

INSERT INTO `rental_agent` (`agent_name`, `agent_id`, `agent_email`, `agent_contact`, `agent_add`, `agent_state`, `agent_city`, `agent_aadhr`, `agent_pass`, `agent_profile`) VALUES
('Agent Main', 'agent2@9876543210', 'agent2@gmail.com', 9876543210, 'Sector-1', 'Gujarat', 'Dwrka', 121011090807, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_name` text NOT NULL,
  `user_id` text NOT NULL,
  `email` text NOT NULL,
  `contact` decimal(10,0) NOT NULL,
  `address` text NOT NULL,
  `user_state` text NOT NULL,
  `user_city` text DEFAULT NULL,
  `user_aadhr` decimal(2,0) NOT NULL,
  `user_pass` text NOT NULL,
  `user_profile` longblob NOT NULL,
  `user_license` longblob NOT NULL,
  `booked_car` int(2) NOT NULL DEFAULT 0,
  `booked_bike` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_name`, `user_id`, `email`, `contact`, `address`, `user_state`, `user_city`, `user_aadhr`, `user_pass`, `user_profile`, `user_license`, `booked_car`, `booked_bike`) VALUES
('Yashvi', 'rentaride@00000059', 'yashvi@gmail.com', 9898789845, 'Parth Society', 'Gujarat', 'Bhavnagar', 14, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0x75706c6f6164732f42756c6c6574486f6d652e706e67, 0x75706c6f6164732f42756c6c6574486f6d652e706e67, 0, 0),
('Sneha ', 'rentaride@1235487986', 'sneha@gmail.com', 1235487986, 'Bhavnagar', 'Gujarat', 'Bhavnagar', 20, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0x75706c6f6164732f70726f66696c655f706e672e706e67, 0x75706c6f6164732f64726976696e672d6c6963656e73652d696e2d67756a617261742e6a7067, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bike`
--
ALTER TABLE `bike`
  ADD UNIQUE KEY `bike_no` (`bike_no`(10));

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`b_id`) USING BTREE;

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_no`(10));

--
-- Indexes for table `rental_agent`
--
ALTER TABLE `rental_agent`
  ADD PRIMARY KEY (`agent_id`(30));

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`(15)),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

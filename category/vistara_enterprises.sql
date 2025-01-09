-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 11:35 AM
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
-- Database: `vistara_enterprises`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `cat_id` int(100) NOT NULL,
  `cat_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `cat_name`) VALUES
(1, 'common spices'),
(2, 'Aromatic Spices'),
(3, 'Hot (Pungent) Spices'),
(4, 'Mild Flavored Spices'),
(5, 'Leaves'),
(6, 'Seed'),
(7, 'Fruits/Berries'),
(8, 'Masalas'),
(9, 'Pulses');

-- --------------------------------------------------------

--
-- Table structure for table `pro`
--

CREATE TABLE `pro` (
  `pro_id` int(100) NOT NULL,
  `pro_name` varchar(200) NOT NULL,
  `image` varchar(256) NOT NULL,
  `cat_id` varchar(200) NOT NULL,
  `cat_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pro`
--

INSERT INTO `pro` (`pro_id`, `pro_name`, `image`, `cat_id`, `cat_name`) VALUES
(24, ' Turmeric', ' upload/4c79e434-137c-41ff-a7d1-bd08c8d6ca70.jpg', '', 'common spices'),
(25, 'Saffron', ' upload/9a9b6d57-0675-40e3-8fc6-d18fdb12063d.jpg', '', 'common spices'),
(26, 'Ginger', ' upload/2f8863f2-412c-4bf3-a584-00d1b08a802f.jpg', '', 'common spices'),
(27, 'Cinnamon stick', ' upload/eabdd44d-7324-411c-b1fc-f507b15e52c1.jpg', '', 'common spices'),
(28, 'Tamarind', ' upload/871745f5-0f16-46b5-8fa7-dec0d9d56ff9.jpg', '', 'common spices'),
(29, 'Cardamom', ' upload/e2d2cf0e-2d53-4251-80cf-f56334ef6bcd.jpg', '', 'common spices'),
(30, 'Peppercorns', ' upload/5123e261-de92-48e7-91cb-e2ca65a0e414.jpg', '', 'common spices'),
(31, 'Malabar leaf/bay leaf', ' upload/2c10c778-f3dd-4ba1-b87e-88ffabf56798.jpg', '', 'common spices'),
(32, 'Coriander', ' upload/6d3c8b0a-3ebb-4c9e-b6c2-167da4afd9d9.jpg', '', 'common spices'),
(33, 'Nutmeg', ' upload/c499efed-a343-43a8-aec3-d1847bf1c445.jpg', '', 'common spices'),
(34, 'Fenugreek', ' upload/d39a8755-2c7a-4c82-aba4-5be928f5b39f.jpg', '', 'common spices'),
(35, 'Clove', ' upload/8a8e1a13-bdf8-485d-b6e2-1c82700efdfa.jpg', '', 'common spices'),
(36, 'Poppyseed', ' upload/11104a45-1ce3-49ae-a55d-2181653f310f.jpg', '', 'common spices'),
(37, 'Clove', ' upload/8a8e1a13-bdf8-485d-b6e2-1c82700efdfa.jpg', '', 'Aromatic Spices'),
(38, 'Cumin', ' upload/7f9d32fb-90f3-4715-a7e5-921dab497201.jpg', '', 'Aromatic Spices'),
(39, 'Dill seed', ' upload/ee3f6b6d-67e8-4d36-968a-418f3f3fb6d0.jpg', '', 'Aromatic Spices'),
(40, 'Fennel seed', ' upload/e2d2cf0e-2d53-4251-80cf-f56334ef6bcd.jpg', '', 'Aromatic Spices'),
(41, 'Nutmeg', ' upload/c499efed-a343-43a8-aec3-d1847bf1c445.jpg', '', 'Aromatic Spices'),
(42, 'Cinnamon', ' upload/eabdd44d-7324-411c-b1fc-f507b15e52c1.jpg', '', 'Aromatic Spices'),
(43, 'Black and white peppers', ' upload/90bec6ed-5f7e-4537-a630-d1de3f49e6ae.jpg', '', 'Hot (Pungent) Spices'),
(44, 'Mustard', ' upload/788e3976-314b-4bb3-9c46-b29a9a287a4a.jpg', '', 'Hot (Pungent) Spices'),
(45, 'Red pepper', ' upload/22ed9d2b-f289-41e2-ae7a-ef8096e1e9a9.jpg', '', 'Hot (Pungent) Spices'),
(46, 'Paprika', ' upload/22ed9d2b-f289-41e2-ae7a-ef8096e1e9a9.jpg', '', 'Mild Flavored Spices'),
(47, 'Coriander', ' upload/cd8595b9-9842-40a0-9ae9-85cbc77bb994.jpg', '', 'Mild Flavored Spices'),
(48, 'Basil', ' upload/63de64d9-b4f0-4d66-ac74-32a48e832041.jpg', '', 'Leaves'),
(49, 'Bay leaf', ' upload/2c10c778-f3dd-4ba1-b87e-88ffabf56798.jpg', '', 'Leaves'),
(50, 'Chive', ' upload/2ec5e2a6-dd03-498e-a3d5-f6cdffe2c75e.jpg', '', 'Leaves'),
(51, 'Cilantro', ' upload/cd8595b9-9842-40a0-9ae9-85cbc77bb994.jpg', '', 'Leaves'),
(52, 'Oregano', ' upload/9eda7ff1-061f-47e4-8ecc-9836431da609.jpg', '', 'Leaves'),
(53, 'Parsley', ' upload/6d3c8b0a-3ebb-4c9e-b6c2-167da4afd9d9.jpg', '', 'Leaves'),
(54, 'Rosemary', ' upload/a58827f3-f966-4009-b06f-f6a8edc63a4a.jpg', '', 'Leaves'),
(55, 'Sage', ' upload/9eda7ff1-061f-47e4-8ecc-9836431da609.jpg', '', 'Leaves'),
(56, 'Thyme', ' upload/9d1fff26-05b5-43b7-88e8-bbe7f5e0e278.jpg', '', 'Leaves'),
(57, 'Cardamom', ' upload/e2d2cf0e-2d53-4251-80cf-f56334ef6bcd.jpg', '', 'Seed'),
(58, 'Coriander', ' upload/6d3c8b0a-3ebb-4c9e-b6c2-167da4afd9d9.jpg', '', 'Seed'),
(59, 'Cumin', ' upload/7f9d32fb-90f3-4715-a7e5-921dab497201 (1).jpg', '', 'Seed'),
(60, 'Dill', ' upload/9d1fff26-05b5-43b7-88e8-bbe7f5e0e278.jpg', '', 'Seed'),
(61, 'Fennel', ' upload/57943dfd-a034-4685-8a8e-6b2a11406e1e.jpg', '', 'Seed'),
(62, 'Fenugreek', ' upload/788e3976-314b-4bb3-9c46-b29a9a287a4a.jpg', '', 'Seed'),
(63, 'Mustard', ' upload/0069f5e3-6aaa-4776-b6b8-a264a5825392.jpg', '', 'Seed'),
(64, 'Black pepper', ' upload/90bec6ed-5f7e-4537-a630-d1de3f49e6ae.jpg', '', 'Fruits/Berries'),
(65, 'Red pepper', ' upload/e0d472fd-70c0-43c4-adfb-a93fd8449b70.jpg', '', 'Fruits/Berries'),
(66, 'Paprika', ' upload/22ed9d2b-f289-41e2-ae7a-ef8096e1e9a9.jpg', '', 'Fruits/Berries'),
(67, 'Garam masala', ' upload/42ba5f0b-726b-45e1-aa18-7f4f3a7de1a9.jpg', '', 'Masalas'),
(68, 'Curry masala', ' upload/51f3648f-62cd-422c-a967-4511a07667fa.jpg', '', 'Masalas'),
(69, 'Tandoori masala', ' upload/e0d472fd-70c0-43c4-adfb-a93fd8449b70.jpg', '', 'Masalas'),
(70, 'Rasam and sambar powder', ' upload/0d0cc359-41b8-4f92-911e-e6525a7445fb.jpg', '', 'Masalas'),
(71, 'Lentils (All types)', ' upload/4d1fdee1-15b7-4f34-baeb-e8bbf8be9c6b.jpg', '', 'Pulses'),
(72, 'Chickpeas', ' upload/2c047015-af43-4378-b724-4c0c02f3718c.jpg', '', 'Pulses'),
(73, 'Black Eyed Peas', ' upload/1111111111.jpg', '', 'Pulses'),
(74, 'Mung Beans', ' upload/7e9bd695-2a11-4084-be79-f37c88cb9da5.jpg', '', 'Pulses'),
(75, 'Red Kidney Beans', ' upload/i.jpg', '', 'Pulses'),
(76, ' Pulses', ' upload/1.jpg', '', 'Pulses');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pro`
--
ALTER TABLE `pro`
  MODIFY `pro_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

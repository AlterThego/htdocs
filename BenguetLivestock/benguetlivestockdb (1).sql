-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 02:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benguetlivestockdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `livestockpopulation`
--

CREATE TABLE `livestockpopulation` (
  `municipality_id` int(11) NOT NULL,
  `municipality_name` varchar(255) DEFAULT NULL,
  `carabao_count` int(11) DEFAULT NULL,
  `cattle_count` int(11) DEFAULT NULL,
  `swine_count` int(11) DEFAULT NULL,
  `goat_count` int(11) DEFAULT NULL,
  `dog_count` int(11) DEFAULT NULL,
  `sheep_count` int(11) DEFAULT NULL,
  `horse_count` int(11) DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livestockpopulation`
--

INSERT INTO `livestockpopulation` (`municipality_id`, `municipality_name`, `carabao_count`, `cattle_count`, `swine_count`, `goat_count`, `dog_count`, `sheep_count`, `horse_count`, `date_updated`) VALUES
(2601, ' La Trinidad', 0, 0, 0, 0, 0, 0, 0, '2023-12-05'),
(2603, ' Tuba', 123, 123, 123, 123, 123, 123, 123, '2023-12-05'),
(2604, 'Itogon', 123, 123, 23, 123, 123, 123213, 1233, '2023-12-02'),
(2605, 'Bokod', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2606, 'Kabayan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2607, 'Bugias', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2608, 'Mankayan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2610, 'Bakun', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2611, 'Kibungan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2612, 'Atok', 247, 1049, 3743, 317, 2092, 15, 5, '2023-12-02'),
(2613, 'Kapangan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2614, 'Sablan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2615, 'Tublay', 0, 0, 0, 0, 0, 0, 0, '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `livestocktrend`
--

CREATE TABLE `livestocktrend` (
  `livestock_year` int(11) NOT NULL,
  `carabao_count` int(11) DEFAULT NULL,
  `cattle_count` int(11) DEFAULT NULL,
  `swine_count` int(11) DEFAULT NULL,
  `goat_count` int(11) DEFAULT NULL,
  `dog_count` int(11) DEFAULT NULL,
  `sheep_count` int(11) DEFAULT NULL,
  `horse_count` int(11) DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livestocktrend`
--

INSERT INTO `livestocktrend` (`livestock_year`, `carabao_count`, `cattle_count`, `swine_count`, `goat_count`, `dog_count`, `sheep_count`, `horse_count`, `date_updated`) VALUES
(2017, 123, 0, 0, 0, 0, 0, 0, '2023-12-05'),
(2018, 112, 12, 12, 12, 545, 645, 65, '2023-12-03'),
(2019, 0, 0, 0, 0, 0, 0, 0, '2023-12-03'),
(2020, 0, 0, 0, 0, 0, 0, 0, '2023-12-03'),
(2021, 0, 0, 0, 0, 0, 0, 0, '2023-12-03'),
(2022, 0, 0, 0, 0, 0, 0, 0, '2023-12-03'),
(2023, 0, 0, 0, 0, 0, 0, 0, '2023-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `livestockvolume`
--

CREATE TABLE `livestockvolume` (
  `municipality_id` int(11) NOT NULL,
  `municipality_name` varchar(255) DEFAULT NULL,
  `cattle_volume` int(11) DEFAULT NULL,
  `swine_volume` int(11) DEFAULT NULL,
  `carabao_volume` int(11) DEFAULT NULL,
  `goat_volume` int(11) DEFAULT NULL,
  `chicken_volume` int(11) DEFAULT NULL,
  `duck_volume` int(11) DEFAULT NULL,
  `fish_volume` int(11) DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livestockvolume`
--

INSERT INTO `livestockvolume` (`municipality_id`, `municipality_name`, `cattle_volume`, `swine_volume`, `carabao_volume`, `goat_volume`, `chicken_volume`, `duck_volume`, `fish_volume`, `date_updated`) VALUES
(2601, ' La Trinidad', 123, 0, 0, 0, 0, 0, 0, '2023-12-05'),
(2603, ' Tuba', 0, 0, 0, 0, 123, 0, 0, '2023-12-05'),
(2604, 'Itogon', 123, 123, 23, 123, 123, 123213, 1233, '2023-12-02'),
(2605, 'Bokod', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2606, 'Kabayan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2607, 'Bugias', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2608, 'Mankayan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2610, ' Bakun', 0, 0, 0, 0, 0, 0, 0, '2023-12-05'),
(2611, 'Kibungan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2612, 'Atok', 247, 1049, 3743, 317, 2092, 15, 5, '2023-12-02'),
(2613, 'Kapangan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2614, 'Sablan', 0, 0, 0, 0, 0, 0, 0, '2023-12-02'),
(2615, 'Tublay', 123, 0, 0, 0, 0, 0, 0, '2023-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE `municipalities` (
  `municipality_id` int(11) NOT NULL,
  `municipality_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`municipality_id`, `municipality_name`) VALUES
(2601, 'La Trinidad'),
(2603, 'Tuba'),
(2604, 'Itogon'),
(2605, 'Bokod'),
(2606, 'Kabayan'),
(2607, 'Bugias'),
(2608, 'Mankayan'),
(2610, 'Bakun'),
(2611, 'Kibungan'),
(2612, 'Atok'),
(2613, 'Kapangan'),
(2614, 'Sablan'),
(2615, 'Tublay');

-- --------------------------------------------------------

--
-- Table structure for table `poultrypopulation`
--

CREATE TABLE `poultrypopulation` (
  `poultry_type_id` int(11) NOT NULL,
  `poultry_type_name` varchar(255) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poultrypopulation`
--

INSERT INTO `poultrypopulation` (`poultry_type_id`, `poultry_type_name`, `count`, `date_updated`) VALUES
(2, '', 3123, '2023-12-05'),
(3, '', 123123, '2023-12-05'),
(4, '', 14, '2023-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `poultrytype`
--

CREATE TABLE `poultrytype` (
  `poultry_type_id` int(11) NOT NULL,
  `poultry_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poultrytype`
--

INSERT INTO `poultrytype` (`poultry_type_id`, `poultry_type_name`) VALUES
(2, 'Broiler'),
(4, 'Fighting/ Fancy Fowl'),
(1, 'Layers'),
(3, 'Native/ Range');

-- --------------------------------------------------------

--
-- Table structure for table `poultry_trend`
--

CREATE TABLE `poultry_trend` (
  `poultry_year` int(11) NOT NULL,
  `layers_count` int(11) DEFAULT NULL,
  `broiler_count` int(11) DEFAULT NULL,
  `native_count` int(11) DEFAULT NULL,
  `fighting_count` int(11) DEFAULT NULL,
  `date_updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poultry_trend`
--

INSERT INTO `poultry_trend` (`poultry_year`, `layers_count`, `broiler_count`, `native_count`, `fighting_count`, `date_updated`) VALUES
(2018, 0, 0, 0, 0, '2023-12-03'),
(2019, 0, 0, 0, 0, '2023-12-03'),
(2020, 0, 0, 0, 0, '2023-12-03'),
(2021, 0, 0, 0, 0, '2023-12-03'),
(2022, 0, 0, 0, 0, '2023-12-03'),
(2023, 12, 0, 0, 0, '2023-12-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livestockpopulation`
--
ALTER TABLE `livestockpopulation`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `livestocktrend`
--
ALTER TABLE `livestocktrend`
  ADD PRIMARY KEY (`livestock_year`);

--
-- Indexes for table `livestockvolume`
--
ALTER TABLE `livestockvolume`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `municipalities`
--
ALTER TABLE `municipalities`
  ADD PRIMARY KEY (`municipality_id`);

--
-- Indexes for table `poultrypopulation`
--
ALTER TABLE `poultrypopulation`
  ADD PRIMARY KEY (`poultry_type_id`),
  ADD KEY `poultry_type_name` (`poultry_type_name`);

--
-- Indexes for table `poultrytype`
--
ALTER TABLE `poultrytype`
  ADD PRIMARY KEY (`poultry_type_id`),
  ADD UNIQUE KEY `poultry_type_name` (`poultry_type_name`);

--
-- Indexes for table `poultry_trend`
--
ALTER TABLE `poultry_trend`
  ADD PRIMARY KEY (`poultry_year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poultrytype`
--
ALTER TABLE `poultrytype`
  MODIFY `poultry_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livestockpopulation`
--
ALTER TABLE `livestockpopulation`
  ADD CONSTRAINT `livestockpopulation_ibfk_1` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`municipality_id`);

--
-- Constraints for table `poultrypopulation`
--
ALTER TABLE `poultrypopulation`
  ADD CONSTRAINT `poultrypopulation_ibfk_1` FOREIGN KEY (`poultry_type_id`) REFERENCES `poultrytype` (`poultry_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 04:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dealership`
--

-- --------------------------------------------------------

--
-- Table structure for table `carinventory`
--

CREATE TABLE `carinventory` (
  `Make` varchar(20) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `TheYear` int(4) NOT NULL,
  `VIN` varchar(17) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Miles` decimal(11,2) NOT NULL,
  `isNew` varchar(3) DEFAULT NULL CHECK (`isNew` in ('Yes','No'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerName` varchar(20) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `PhoneNumber` int(10) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerName`, `CustomerID`, `Address`, `PhoneNumber`, `Email`) VALUES
('Kevin De Broyn', 11, 'Mancity', 2147483647, 'kdb@gmail.com'),
('Palmmer', 12, 'City', 2147483647, 'palm@gmail.com'),
('Someone', 13, 'Somewhere', 2147483647, 'an@gmail.com'),
('Maradona', 14, 'Bogota', 2147483647, 'lamanodedios@gmail.com'),
('Shakira', 15, 'Miai', 2147483647, 'shaki@gmsil.com'),
('Maradona', 16, 'Bogota', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 17, 'Bogota', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 18, 'Bogota', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 19, 'Bogota', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 20, 'Bogota', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 21, 'Malabo', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 22, 'Malabo', 1427894512, 'lamanodedios@gmail.com'),
('Maradona', 23, 'Malabo', 1427894512, 'lamanodedios@gmail.com'),
('Dani Alves', 24, 'Qatar', 1427894512, 'alvesdani@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `EmployeeName` varchar(20) NOT NULL,
  `Gender` varchar(15) DEFAULT NULL,
  `Address` varchar(30) NOT NULL,
  `PhoneNumber` int(10) NOT NULL,
  `Position` varchar(20) NOT NULL,
  `Salary` decimal(10,2) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Password`, `EmployeeName`, `Gender`, `Address`, `PhoneNumber`, `Position`, `Salary`, `Email`) VALUES
(2220000, 'MD1234', 'Maria Dolores', 'Female', 'Ikunde 3', 222764953, 'Manager', '8899970.00', 'mariad@gmail.com'),
(2220001, 'lm10', 'Lionel Messi', 'Male', 'Paris', 1451251425, 'CEO', '9654785.00', 'lmessi@gmail.com'),
(2220002, 'neyjr', 'Neymar Jr', 'Male', 'Rio de Janeiro', 2147483647, 'Salesman', '1236547.00', 'neymajr@gmail.com'),
(2220006, 'cr7', 'Cristiano Ronaldo', 'Male', 'Malabo', 2147483647, 'Manager', '35.00', 'cr7@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `ProvID` int(11) NOT NULL,
  `provName` varchar(20) DEFAULT NULL,
  `Address` varchar(30) NOT NULL,
  `PhoneNumber` int(10) NOT NULL,
  `ProvType` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

CREATE TABLE `sold` (
  `Make` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `theYear` smallint(4) NOT NULL,
  `VIN` varchar(17) NOT NULL,
  `Miles` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`Make`, `Model`, `theYear`, `VIN`, `Miles`) VALUES
('Toyota', 'COROLLA', 2002, 'A3DSEWCDR4TGBHN78', '301000');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `CustomerID` int(10) DEFAULT NULL,
  `ProvID` int(10) DEFAULT NULL,
  `EmployeeID` int(10) DEFAULT NULL,
  `VIN` varchar(17) DEFAULT NULL,
  `TheDate` date DEFAULT NULL,
  `SoB` varchar(6) DEFAULT NULL CHECK (`SoB` in ('Sold','Bought')),
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `CustomerID`, `ProvID`, `EmployeeID`, `VIN`, `TheDate`, `SoB`, `Price`) VALUES
(1, 11, NULL, 2220000, 'A3DSEWCDR4TGBHN78', '2022-11-09', 'Sold', '753453.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carinventory`
--
ALTER TABLE `carinventory`
  ADD PRIMARY KEY (`VIN`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`ProvID`);

--
-- Indexes for table `sold`
--
ALTER TABLE `sold`
  ADD PRIMARY KEY (`VIN`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `ProvID` (`ProvID`),
  ADD KEY `VIN` (`VIN`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2220008;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `ProvID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`ProvID`) REFERENCES `provider` (`ProvID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`VIN`) REFERENCES `sold` (`VIN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

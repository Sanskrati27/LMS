-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 10:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(5) NOT NULL,
  `isbn` int(5) NOT NULL,
  `bimage` varchar(250) NOT NULL,
  `bname` varchar(50) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `quantity` int(5) NOT NULL,
  `aquantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `isbn`, `bimage`, `bname`, `aname`, `quantity`, `aquantity`) VALUES
(5, 555, 'books_image/d487d36abd0b88e02561bbd112ece646book1.png', 'English', 'Julie', 50, 50),
(6, 556, 'books_image/0ee98dff2dfdce284c97bbd10e16caadbook2.jpg', 'Novel', 'John Faraday', 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lid` int(5) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`id`, `name`, `email`, `password`, `lid`, `status`) VALUES
(1, 'Mayank', 'mayank@gmail.com', 'mayank', 1234, 'Activated'),
(2, 'Riya', 'riya@gmail.com', 'riya', 1235, 'Activated'),
(4, 'Ram Kumar', 'ramkumar212@gmail.com', 'ram212', 1236, 'Deactivated'),
(5, 'Priya', 'priya@gmail.com', 'priya', 1237, 'Deactivated');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `id` int(5) NOT NULL,
  `lid` int(5) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `semail` varchar(50) NOT NULL,
  `isbn` int(5) NOT NULL,
  `bname` varchar(50) NOT NULL,
  `issuedate` date NOT NULL,
  `returndate` date NOT NULL,
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `returned`
--

CREATE TABLE `returned` (
  `id` int(5) NOT NULL,
  `libid` int(5) NOT NULL,
  `stuname` varchar(50) NOT NULL,
  `stuemail` varchar(50) NOT NULL,
  `isbn` int(50) NOT NULL,
  `bookname` varchar(50) NOT NULL,
  `idate` date NOT NULL,
  `rdate` date NOT NULL,
  `fine` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returned`
--

INSERT INTO `returned` (`id`, `libid`, `stuname`, `stuemail`, `isbn`, `bookname`, `idate`, `rdate`, `fine`) VALUES
(1, 1238, 'Rahul', 'rahul@gmail.com', 555, 'English', '2023-06-23', '2023-06-30', 4),
(2, 1235, 'Riya', 'riya@gmail.com', 556, 'Novel', '2023-06-17', '2023-06-22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_book`
--
ALTER TABLE `issue_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned`
--
ALTER TABLE `returned`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `issue_book`
--
ALTER TABLE `issue_book`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `returned`
--
ALTER TABLE `returned`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2019 at 10:54 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_done`
--

CREATE TABLE `tbl_done` (
  `id` int(11) NOT NULL,
  `todo_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_done`
--

INSERT INTO `tbl_done` (`id`, `todo_id`, `text`, `date`) VALUES
(2, 1, 'Call the Doctor', '2019-02-03 07:27:13'),
(3, 11, 'one more task', '2019-02-03 08:40:07'),
(4, 14, 'one more task', '2019-02-03 09:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo_list`
--

CREATE TABLE `tbl_todo_list` (
  `id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_todo_list`
--

INSERT INTO `tbl_todo_list` (`id`, `position`, `text`, `date`) VALUES
(1, 4, 'Call the Doctor', '2019-02-02 19:42:12'),
(2, 3, 'Call the Enginner', '2019-02-02 19:42:12'),
(3, 5, 'Call the doctor', '2019-02-02 19:42:12'),
(4, 6, 'Call the doctor', '2019-02-02 19:42:12'),
(6, 8, 'add a work', '2019-02-02 19:42:12'),
(7, 9, 'add a work', '2019-02-02 19:42:12'),
(8, 10, 'another work', '2019-02-02 19:42:12'),
(9, 11, 'another work', '2019-02-02 19:42:12'),
(10, 12, 'lets do another task', '2019-02-02 19:42:12'),
(11, 13, 'one more task', '2019-02-02 19:42:12'),
(12, 14, 'one more task', '2019-02-02 19:42:12'),
(13, 15, 'one more task', '2019-02-02 19:42:12'),
(18, 16, 'once again testing', '2019-02-02 19:42:12'),
(19, 17, 'testing without error', '2019-02-02 19:42:12'),
(20, 2, 'testing testing', '2019-02-02 19:42:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_done`
--
ALTER TABLE `tbl_done`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `todo_id` (`todo_id`);

--
-- Indexes for table `tbl_todo_list`
--
ALTER TABLE `tbl_todo_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_done`
--
ALTER TABLE `tbl_done`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_todo_list`
--
ALTER TABLE `tbl_todo_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

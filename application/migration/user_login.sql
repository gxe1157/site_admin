-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2017 at 03:58 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `njpob`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `security_code` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_access` int(11) NOT NULL,
  `user_priv` int(11) NOT NULL DEFAULT '0',
  `app_completed_date` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `modified_date` int(11) NOT NULL,
  `avatar_name` varchar(100) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `last_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `email`, `password`, `security_code`, `status`, `user_access`, `user_priv`, `app_completed_date`, `create_date`, `modified_date`, `avatar_name`, `admin_id`, `last_login`) VALUES
(1, '', 'evelio@mailers.com', '$2y$11$jekUbWMbzfOQw5ihj6skfetb994DKRT6j6hbby3Qi8QbFa5.mFYHG', '1505509944RyR6mBU57HUrvAp685NZ', 0, 0, 0, 1503167117, 1502490142, 1503167117, 'annon_user.png', 1, 1505351897),
(2, '', 'sam@mailers.com', '$2y$11$Ny8SYRwjHle5IWCO8O7MJu9rYMAU8qYXaSTschjxYE1gM3BjmTzhi', '123456', 0, 0, 0, 1502504617, 1502503681, 1502504617, '', 2, 0),
(3, '', 'jane@mailers.com', '$2y$11$mr0/PjuWDGHpZOcvpn0v/eSdrbcnoRnaOYucFrMw/TLzk.Ql0uD.K', '123456', 0, 0, 0, 1502550832, 1502504833, 1502550832, '', 3, 1502850624),
(4, '', 'jason@mailers.com', '$2y$11$oJH.7RtpjSIeLkJ1e08k0u1O5ybkcMbuBVQ2YDVY/cgAFGwPoMZmW', 'ZLv7t3QKSqW5cyRbam6zbNfG5dcBXj', 0, 0, 0, 0, 1502539331, 1502549641, '', 4, 1502841973),
(5, '', 'john@mailers.com', '$2y$11$Tkq/rlU8bsXzsXQnoGKOx.sWOii6tzk0AcVQbPjo4nrFUIXcTJjMe', '123456789', 0, 0, 0, 1502831078, 1502830918, 1502831078, '', 5, 0),
(6, '', 'danny@mailers.com', '$2y$11$RHnSmoXmf4EW4TZQRSx3yOrmASgSD6tmnWpw83ItK0BFnkcXv1ryi', '1504042686|xNxhLjw7NmyHBT7HS4hx', 1, 1, 1, 1502836521, 1502836521, 0, 'annon_user.png', 0, 1505219413),
(7, '', 'leury@mailers.com', '$2y$11$YyLOGv1U.pAHLoLPPCx0jOqWVYNgyuf.Wsy5si0QgHQIBgHGfIx6u', '123456789', 0, 0, 0, 1503170092, 1503168293, 1503170092, 'annon_user.png', 7, 1503619818),
(8, '', 'larry@mailers.com', '$2y$11$/H9tDhRHV7E70mV85EyM..WgLrWjMM62zp7IFtA/Myd4UuEUhdyHW', 'rfEYJ7SpXccKuvYR5X7st6wZumLNgf', 0, 0, 0, 0, 1503714817, 0, '', 0, 0),
(9, '', 'smitty@mailers.com', '$2y$11$OjKvIw1bq0zB/pkBEoRH0uBaxEeB1VEfJa7zSB6ByLYs9arUc9q6a', 'vxfgUQU8fqzRqcb8EpBCu2DKHNhuRs', 0, 0, 0, 0, 1504497254, 0, '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

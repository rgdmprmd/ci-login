-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 03:43 PM
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
-- Database: `uanq`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `idBulan` int(11) NOT NULL,
  `namaBulan` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`idBulan`, `namaBulan`) VALUES
(1, 'Jan'),
(2, 'Feb'),
(3, 'Mar'),
(4, 'Apr'),
(5, 'May'),
(6, 'Jun'),
(7, 'Jul'),
(8, 'Aug'),
(9, 'Sep'),
(10, 'Oct'),
(11, 'Nov'),
(12, 'Dec');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `idEarning` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `transaksi` varchar(40) NOT NULL,
  `income` int(11) NOT NULL,
  `outcome` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`idEarning`, `email`, `transaksi`, `income`, `outcome`, `dateCreated`, `dateModified`) VALUES
(1, 'ranggadpermadi@gmail.com', 'Modal Awal', 607000, 0, '2020-01-19', '2020-01-19'),
(2, 'ranggadpermadi@gmail.com', 'Fotocopy', 0, 2000, '2020-01-19', '2020-01-19'),
(5, 'bonuslupis@gmail.com', 'Jual Sepeda Balap', 60000000, 0, '2020-01-20', '2020-01-20'),
(6, 'ranggadpermadi@gmail.com', 'Beli Indomie 4', 0, 7500, '2020-01-20', '2020-01-20'),
(7, 'ranggadpermadi@gmail.com', 'Fotocopy', 0, 1000, '2020-01-20', '2020-01-20'),
(8, 'ranggadpermadi@gmail.com', 'Beli Saos', 0, 6200, '2020-01-20', '2020-01-20'),
(9, 'ranggadpermadi@gmail.com', 'Subisidi nasi padang', 0, 2000, '2020-01-20', '2020-01-20'),
(10, 'ranggadpermadi@gmail.com', 'Nemu receh', 1000, 300, '2020-01-20', '2020-01-20'),
(11, 'ranggadpermadi@gmail.com', 'Bensin', 0, 50000, '2020-01-21', '2020-01-21'),
(12, 'ranggadpermadi@gmail.com', 'Isi angin', 0, 6000, '2020-01-21', '2020-01-21'),
(13, 'ranggadpermadi@gmail.com', 'Sarapan', 0, 15000, '2020-01-21', '2020-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `namaUser` varchar(128) NOT NULL,
  `emailUser` varchar(128) NOT NULL,
  `imageUser` varchar(128) NOT NULL,
  `passwordUser` varchar(255) NOT NULL,
  `idRole` int(11) NOT NULL,
  `isActive` int(1) NOT NULL,
  `dateCreated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idUser`, `namaUser`, `emailUser`, `imageUser`, `passwordUser`, `idRole`, `isActive`, `dateCreated`) VALUES
(1, 'Rangga Dimas Permadi', 'ranggadpermadi@gmail.com', 'bmw.png', '$2y$10$f6/ZzO1zZGLiWlg3v7YKSOFpoNgpRb4aEvUY/mpn7X5e7H7DLPUIi', 1, 1, 1577105734),
(2, 'Boris', 'bonuslupis@gmail.com', 'default.jpg', '$2y$10$OmixDpHYYs.nvFg6iEruiO0qETyejnSFaIQ/g.vSxKsV36Bsgk0lq', 2, 1, 1579512012);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `idAccess` int(11) NOT NULL,
  `idRole` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`idAccess`, `idRole`, `idMenu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4),
(6, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `idMenu` int(11) NOT NULL,
  `namaMenu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`idMenu`, `namaMenu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Inventory');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `idRole` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`idRole`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `idSubMenu` int(11) NOT NULL,
  `idMenu` int(11) NOT NULL,
  `judulSubMenu` varchar(128) NOT NULL,
  `urlSubMenu` varchar(128) NOT NULL,
  `iconSubMenu` varchar(128) NOT NULL,
  `isActiveMenu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`idSubMenu`, `idMenu`, `judulSubMenu`, `urlSubMenu`, `iconSubMenu`, `isActiveMenu`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(8, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(9, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(10, 2, 'Earnings', 'user/earning', 'fas fa-fw fa-coins', 1),
(11, 4, 'Inventory', 'inventory', 'fas fa-fw fa-warehouse', 1),
(12, 4, 'Orders', 'inventory/orders', 'fas fa-fw fa-boxes', 1),
(13, 4, 'Deals', 'inventory/deals', 'far fa-fw fa-money-bill-alt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `idToken` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`idBulan`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`idEarning`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`idAccess`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`idSubMenu`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`idToken`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `idBulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `idEarning` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `idAccess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `idSubMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `idToken` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

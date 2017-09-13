-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2017 at 01:37 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karaoke`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `taikhoan` text NOT NULL,
  `matkhau` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `taikhoan`, `matkhau`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `machitiet` int(11) NOT NULL,
  `mahoadon` int(11) NOT NULL,
  `mamathang` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`machitiet`, `mahoadon`, `mamathang`, `soluong`, `dongia`) VALUES
(1, 2, 1, 10, 20000),
(3, 2, 0, 5, 0),
(4, 3, 1, 2, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `danhsachthietbi`
--

CREATE TABLE `danhsachthietbi` (
  `id` int(11) NOT NULL,
  `maphong` int(11) NOT NULL,
  `mathietbi` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `tinhtrang` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `danhsachthietbi`
--

INSERT INTO `danhsachthietbi` (`id`, `maphong`, `mathietbi`, `soluong`, `tinhtrang`) VALUES
(1, 1, 5, 1, 'Tá»‘t láº¯m');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `mahoadon` int(11) NOT NULL,
  `manhanvien` int(11) NOT NULL,
  `maphong` int(11) NOT NULL,
  `thoigianlap` datetime NOT NULL,
  `tongtien` int(11) NOT NULL,
  `tinhtrang` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`mahoadon`, `manhanvien`, `maphong`, `thoigianlap`, `tongtien`, `tinhtrang`) VALUES
(2, 1, 1, '2017-02-28 15:05:24', 200000, 1),
(3, 1, 1, '2017-03-02 16:05:17', 200000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mathang`
--

CREATE TABLE `mathang` (
  `mamathang` int(11) NOT NULL,
  `tenmathang` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mathang`
--

INSERT INTO `mathang` (`mamathang`, `tenmathang`, `dongia`) VALUES
(1, 'Bia HÃ  Ná»™i', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `manhanvien` int(11) NOT NULL,
  `taikhoan` text NOT NULL,
  `matkhau` text NOT NULL,
  `hoten` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `diachi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sdt` text NOT NULL,
  `cmnd` text NOT NULL,
  `luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`manhanvien`, `taikhoan`, `matkhau`, `hoten`, `diachi`, `sdt`, `cmnd`, `luong`) VALUES
(1, 'NV1', '123456789', 'Nguyá»…n VÄƒn A', 'Cáº§u Giáº¥y, HÃ  Ná»™i', '123456789', '11111111111', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `maphong` int(11) NOT NULL,
  `tenphong` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`maphong`, `tenphong`, `trangthai`) VALUES
(1, 'PhÃ²ng 1', 0),
(2, 'PhÃ²ng  2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `thietbi`
--

CREATE TABLE `thietbi` (
  `mathietbi` int(11) NOT NULL,
  `tenthietbi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thietbi`
--

INSERT INTO `thietbi` (`mathietbi`, `tenthietbi`) VALUES
(5, 'Micro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`machitiet`);

--
-- Indexes for table `danhsachthietbi`
--
ALTER TABLE `danhsachthietbi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`mahoadon`);

--
-- Indexes for table `mathang`
--
ALTER TABLE `mathang`
  ADD PRIMARY KEY (`mamathang`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`manhanvien`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`maphong`);

--
-- Indexes for table `thietbi`
--
ALTER TABLE `thietbi`
  ADD PRIMARY KEY (`mathietbi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `machitiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `danhsachthietbi`
--
ALTER TABLE `danhsachthietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `mahoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mathang`
--
ALTER TABLE `mathang`
  MODIFY `mamathang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `manhanvien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `phong`
--
ALTER TABLE `phong`
  MODIFY `maphong` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `thietbi`
--
ALTER TABLE `thietbi`
  MODIFY `mathietbi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

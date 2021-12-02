-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 08:41 AM
-- Server version: 8.0.26
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart-web`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Position` int DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Position`) VALUES
(6, 'Laptop', 2),
(2, 'USB', 5),
(3, 'Điện Thoại', 1),
(9, 'Loa', 1),
(8, 'IPad', 5);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `GroupID` int NOT NULL,
  `GroupName` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`) VALUES
(1, 'Admin'),
(2, 'Moder'),
(3, 'Khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `ManufacturerID` int NOT NULL,
  `ManufacturerName` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`ManufacturerID`, `ManufacturerName`) VALUES
(13, 'Dell'),
(12, 'HP'),
(10, 'Samsung'),
(11, 'Iphone'),
(14, 'Asus'),
(15, 'Huawei'),
(16, 'Lenovo'),
(17, 'Kington'),
(18, 'XIAOMI'),
(23, 'Nokia');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderID` int NOT NULL,
  `ProductID` int NOT NULL,
  `Quantity` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderID`, `ProductID`, `Quantity`) VALUES
(60, 49, 1),
(60, 45, 5),
(60, 48, 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int NOT NULL,
  `UserID` int NOT NULL,
  `AddedDate` datetime NOT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Sum` int DEFAULT NULL,
  `Status` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `AddedDate`, `Address`, `Phone`, `Sum`, `Status`) VALUES
(60, 39, '2021-01-15 10:23:48', '53 Võ Văn Ngân', '0939461842', 178380000, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int NOT NULL,
  `ManufacturerID` int NOT NULL,
  `CategoryID` int NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Version` int NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ManufacturerID`, `CategoryID`, `ProductName`, `Version`) VALUES
(49, 13, 6, 'Laptop Dell Vostro 3578 i7 ', 0),
(145, 13, 6, 'trung hau', 0),
(42, 14, 6, 'Laptop Asus X407UA', 0),
(44, 17, 2, 'USB 3.0 Transcend JF700 64GB', 0),
(45, 12, 6, 'Laptop HP 15 da0048TU ', 0),
(46, 13, 6, 'Laptop Dell Inspiron 3576', 0),
(41, 15, 3, 'Huawei Y7 Pro', 0),
(39, 16, 6, 'Laptop Lenovo IdeaPad 330', 0),
(40, 11, 3, 'iPhone 7 Plus 32GB', 0),
(35, 10, 3, 'Samsung Galaxy S10+ 128GB', 0),
(43, 17, 2, 'USB 2.0 ADATA C008 16GB', 0),
(36, 13, 3, 'Samsung Galaxy A50 64GB', 0),
(37, 10, 3, 'Samsung Galaxy A70', 0),
(38, 11, 3, 'iPhone Xr 64GB', 0);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `PropertyID` int NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `Price` int DEFAULT NULL,
  `ImageUrl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ProductID` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`PropertyID`, `Description`, `Quantity`, `Price`, `ImageUrl`, `ProductID`) VALUES
(90, 'asd', 12, 12, '', 145),
(63, 'Laptop Dell Vostro 3578 là dòng máy tính xách tay mới của Dell trong năm 2018 với cấu hình cực cao bao gồm vi xử lý i7 8550U thế hệ thứ 8 có hiệu năng vượt trội, card màn hình rời Radeon 520 và 8 GB RAM. Với cấu hình mạnh mẽ máy có thể chạy tốt các ứng dụ', 20, 20990000, '1140683981dell-vostro-3578-ngmpf11-450x300-600x600-600x600.jpg', 49),
(66, '258406264asus-x407ua-i5-8250u-4gb-16gb-1tb-win10-bv485t-thumb33397-600x600.jpg', 30, 13390000, '258406264asus-x407ua-i5-8250u-4gb-16gb-1tb-win10-bv485t-thumb33397-600x600.jpg', 42),
(67, 'Trang bị cổng kết nối USB 3.0. Dung lượng lên đến 64GB. Tương thích với hầu hết các thiết bị công nghệ ', 30, 240000, '174519347716768070975518.jpg', 44),
(68, 'Laptop HP 15 da0048TU N5000 là chiếc máy tính xách tay có màn hình 15.6 inch độ phân giải HD phù hợp cho người dùng cần một chiếc máy để học tập, làm việc, giải trí. Kết hợp cùng vi xử lý Intel Pentium và 4 GB DDR4 máy có thể đáp ứng các nhu cầu cơ bản mộ', 10, 7300000, '384886800hp-15-da0048tu-4me63pa-33397-ava1-600x600.jpg', 45),
(69, 'Thiết kế thanh lịch, trọng lượng khá nhẹ phù hợp cho việc di chuyển hằng ngày đến lớp học, công sở - Laptop Dell Inspiron 3576 i5 8250U được trang bị cấu hình đủ mạnh để chạy tốt các ứng dụng văn phòng, cho phản hồi các thao tác kéo thả trong photoshop, A', 30, 14390000, '767040166dell-inspiron-3576-p63f002n76f-450-600x600.png', 46),
(71, 'Hoàn toàn lột xác so với phiên bản tiền nhiệm, Y7 Pro (2019) đã giúp Huawei có thêm điểm cộng trong mắt người dùng nhờ việc đem thiết kế mặt lưng gradient, màn hình giọt nước và pin khủng lên chiếc smartphone giá rẻ của mình.', 30, 3490000, '1148255722huawei-y7-pro-2019-400x460.png', 41),
(82, 'Mặc dù giữ nguyên vẻ bề ngoài so với dòng điện thoại iPhone đời trước, bù lại iPhone 7 Plus 32GB lại được trang bị nhiều nâng cấp đáng giá như camera kép đầu tiên cũng như cấu hình mạnh mẽ.', 30, 12990000, '270258762iphone-7-plus-gold-400x460.png', 40),
(83, 'Samsung Galaxy S10+ đã ra mắt và thực sự người dùng khó có thể cường lại sức hút kỳ lạ tới từ siêu phẩm này của Samsung và giờ đây hãng sản xuất smartphone tới từ Hàn Quốc tiếp tục tung ra phiên bản Samsung Galaxy S10+ 128GB Bạc Đa Sắc thậm chí còn thu hú', 10, 23990000, '15348725291810508630samsung-galaxy-s10-plus-128gb-bac-da-sac-400x460.png', 35),
(89, 'Là  chiếc điện thoại iPhone có mức giá dễ chịu, phù hợp với nhiều khách hàng hơn, iPhone Xr vẫn được ưu ái trang bị chip Apple A12 mạnh mẽ, màn hình tai thỏ cùng khả năng chống nước chống bụi.', 17990000, 17990000, '1612599405iphone-xr-black-400x460.png', 38),
(88, 'Samsung Galaxy A70 là một phiên bản phóng to của chiếc Samsung Galaxy A50 đã ra mắt trước đó với nhiều cải tiến tới từ bên trong.', 30, 9290000, '607206203samsung-galaxy-a70-black-400x460.png', 37),
(86, '- Thiết kế thời trang, cá tính. \r\n- Tốc độ truyền tải dữ liệu nhanh. \r\n- Tự động nhận driver. ', 30, 108000, '25969262610814335483934.png', 43),
(87, 'Samsung Galaxy A50 là chiếc smartphone tầm trung mới của Samsung trong năm 2019 với nhiều tính năng hấp dẫn, đặc biệt là có cả cảm biến vân tay dưới màn hình.', 20, 6999000, '1867882765samsung-galaxy-a50-black-1-400x460.png', 36);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL,
  `GroupID` int DEFAULT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `PassWord` varchar(32) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `GroupID`, `FullName`, `UserName`, `PassWord`, `Email`) VALUES
(80, 3, 'tinh', 'tinh', '802df3c585cfbaf52752a907665bc12f', 'tinh@gmail.com'),
(79, 3, 'hau', 'hau', 'a23ed18c6f9425dc306fc002e5c2046e', 'hau@gmail.com'),
(76, 1, 'vu', 'vu', '0730b75e96c0453b1b196be7ff4fa194', 'vu@gmail.com'),
(65, 1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com'),
(77, 3, 'tuan', 'tuan', 'd6b8cc42803ea100735c719f1d7f5e11', 'tuan@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`ManufacturerID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ManufacturerID` (`ManufacturerID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`PropertyID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `GroupID` (`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `ManufacturerID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `PropertyID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

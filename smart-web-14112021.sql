-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3309
-- Thời gian đã tạo: Th10 14, 2021 lúc 03:39 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `smart-web`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Position` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Position`) VALUES
(6, 'Laptop', 2),
(2, 'USB', 5),
(3, 'Điện Thoại', 1),
(9, 'Loa', 1),
(8, 'IPad', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `groups`
--

CREATE TABLE `groups` (
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `groups`
--

INSERT INTO `groups` (`GroupID`, `GroupName`) VALUES
(1, 'Admin'),
(2, 'Moder'),
(3, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufacturers`
--

CREATE TABLE `manufacturers` (
  `ManufacturerID` int(11) NOT NULL,
  `ManufacturerName` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `manufacturers`
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
-- Cấu trúc bảng cho bảng `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orderitems`
--

INSERT INTO `orderitems` (`OrderID`, `ProductID`, `Quantity`) VALUES
(60, 49, 1),
(60, 45, 5),
(60, 48, 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AddedDate` datetime NOT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Sum` int(11) DEFAULT NULL,
  `Status` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `AddedDate`, `Address`, `Phone`, `Sum`, `Status`) VALUES
(60, 39, '2021-01-15 10:23:48', '53 Võ Văn Ngân', '0939461842', 178380000, b'1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ManufacturerID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ProductID`, `ManufacturerID`, `CategoryID`, `ProductName`) VALUES
(49, 13, 6, 'Laptop Dell Vostro 3578 i7 '),
(48, 13, 6, 'Laptop HP 15 da0054TU'),
(42, 14, 6, 'Laptop Asus X407UA'),
(44, 17, 2, 'USB 3.0 Transcend JF700 64GB'),
(45, 12, 6, 'Laptop HP 15 da0048TU '),
(46, 13, 6, 'Laptop Dell Inspiron 3576'),
(47, 14, 6, 'Laptop Asus VivoBook'),
(41, 15, 3, 'Huawei Y7 Pro'),
(39, 16, 6, 'Laptop Lenovo IdeaPad 330'),
(40, 11, 3, 'iPhone 7 Plus 32GB'),
(35, 10, 3, 'Samsung Galaxy S10+ 128GB'),
(43, 17, 2, 'USB 2.0 ADATA C008 16GB'),
(36, 13, 3, 'Samsung Galaxy A50 64GB'),
(37, 10, 3, 'Samsung Galaxy A70'),
(38, 11, 3, 'iPhone Xr 64GB');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `property`
--

CREATE TABLE `property` (
  `PropertyID` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `ImageUrl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ProductID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `property`
--

INSERT INTO `property` (`PropertyID`, `Description`, `Quantity`, `Price`, `ImageUrl`, `ProductID`) VALUES
(70, 'Asus A411UA (EB688T) là chiếc laptop sở hữu cấu hình cho hiệu năng hoạt động ổn định với chip Intel Core i3 thế hệ thứ 8, 4 GB RAM, ổ cứng lưu trữ HDD 1 TB, cùng hệ điều hành Windows bản quyền được cài sẵn trên máy. Asus A411UA phù hợp với những ai đang t', 30, 11290000, '1545754616asus-a411ua-i3-8130u-eb688t-ava-600x600.jpg', 47),
(65, 'Laptop HP 15 da0054TU là phiên bản máy tính xách tay với cấu hình được trang bị vi xử lý chip Intel Core i3 Kabylake thế hệ 7 đem đến hiệu năng ổn định khi thao tác các tác vụ cơ bản, phù hợp cho công việc văn phòng, học tập.', 30, 10990000, '734178429hp-15-da0054tu-4me68pa-thumbnail-600x600.jpg', 48),
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
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `GroupID` int(11) DEFAULT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `PassWord` varchar(32) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`UserID`, `GroupID`, `FullName`, `UserName`, `PassWord`, `Email`) VALUES
(80, 3, 'tinh', 'tinh', '802df3c585cfbaf52752a907665bc12f', 'tinh@gmail.com'),
(79, 3, 'hau', 'hau', 'a23ed18c6f9425dc306fc002e5c2046e', 'hau@gmail.com'),
(76, 1, 'vu', 'vu', '0730b75e96c0453b1b196be7ff4fa194', 'vu@gmail.com'),
(65, 1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com'),
(77, 3, 'tuan', 'tuan', 'd6b8cc42803ea100735c719f1d7f5e11', 'tuan@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Chỉ mục cho bảng `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Chỉ mục cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`ManufacturerID`);

--
-- Chỉ mục cho bảng `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ManufacturerID` (`ManufacturerID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Chỉ mục cho bảng `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`PropertyID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `GroupID` (`GroupID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `groups`
--
ALTER TABLE `groups`
  MODIFY `GroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `ManufacturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT cho bảng `property`
--
ALTER TABLE `property`
  MODIFY `PropertyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

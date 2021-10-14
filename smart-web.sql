-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 06:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

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
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Position` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`, `Position`) VALUES
(3, 'Điện Thoại', 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `ManufacturerID` int(11) NOT NULL,
  `ManufacturerName` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`ManufacturerID`, `ManufacturerName`) VALUES
(5, 'Nokia'),
(4, 'Samsung'),
(8, 'Apple'),
(9, 'OPPO'),
(6, 'Xiaomi');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `id_product`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 42, 1001, 2, '2021-10-08', '2021-10-19'),
(10, 42, 1006, 1, '2021-10-12', '2021-10-12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `ManufacturerID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ImageUrl` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL DEFAULT 0,
  `Quantity` int(11) NOT NULL DEFAULT 0,
  `Description` varchar(1000) NOT NULL,
  `Origin` text NOT NULL,
  `Feature` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ManufacturerID`, `CategoryID`, `ProductName`, `ImageUrl`, `Price`, `Quantity`, `Description`, `Origin`, `Feature`) VALUES
(1001, 5, 3, 'Nokia C20', 'nokiac20.jpg', 10000000, 11, 'Giá rẻ lý tưởng với thời lượng pin cả ngày, hệ điều hành Android 11 Go phiên bản mới nhất, kết nối 4G và chất lượng hoàn thiện bền bỉ', 'Việt Nam', 0),
(1002, 4, 3, 'Samsung galaxy note20 ultra', 'samsungnote20.jpg', 80000000, 11, 'Màn hình tràn viền góc cạnh tối đa, kế thừa những đặc tính từ thế hệ trước, công nghệ màn hình Dynamic AMOLED 2X giảm thiểu tối đa ánh sáng xanh gây hại, giúp hạn chế tình trạng mỏi mắt giúp tối ưu trải nghiệm của người dùng.', 'Nhật Bản', 0),
(1003, 4, 3, 'Samsung Galaxy A12', 'samsunga12.jpg', 6400000, 11, 'Sỡ hữu camera macro 2MP chụp cận cản, bao gồm một cảm biến chính 48MP giúp nâng tầm trải nghiệm nhiếp ảnh đa chiều và sắc nét hơn bao giờ hết.', 'Việt Nam', 1),
(1004, 8, 3, 'Iphone 7plus', 'ip7s.jpg', 7400000, 11, '2 dải anten ở mặt sau, jack 3.5mm bị loại bỏ hoàn toàn và phải dùng chung cổng sạc, ở cạnh dưới có 2 hàng loa đối xứng nhau.', 'China', 1),
(1005, 8, 3, 'Iphone 8plus', 'ip8s.jpg', 8550000, 11, 'Những đường nét thiết kế đã hoàn thiện từ thế hệ trước nhưng sửdụng phong cách 2 mặt kính cường lực kết hợp bộ khung kim loại.', 'Ameriva', 0),
(1006, 8, 3, 'Iphone 11 pro max', 'ip11promax.jpg', 14550000, 11, 'iPhone 11 Pro Max được trang bị thêm một ống kính góc siêu rộng, chụp đêm hoàn hảo và cấu hình máy siêu phầm', 'America', 1),
(1007, 8, 3, 'Iphone 12 pro max', 'ip12promax.jpg', 19990000, 11, 'Công nghệ màn hình trên 12 Pro Max cũng được đổi mới và trang bị tốt hơn cùng kích thước lên đến 6.7 inch, lớn hơn so với điện thoại iPhone 12. Với công nghệ màn hình OLED cho khả năng hiển thị hình ảnh lên đến 2778 x 1284 pixels. Bên cạnh đó, màn hình này còn cho độ sáng tối đa cao nhất lên đến 800 nits, luôn đảm bảo cho bạn một độ sáng cao và dễ nhìn nhất ngoài nắng.', 'America', 0),
(1008, 9, 3, 'Oppo a15', 'oppoa15.jpg', 3999000, 11, 'Màn hình giọt nước 6.52\'\' HD+ mở rộng không gian trải nghiệm,Chip Helio P35 8 nhân cho khả năng đa nhiệm tốt, tác vụ mượt mà,Cụm 3 camera AI 13MP+2MP+2MP chụp ảnh rõ nét, sống động,Camera trước 8MP tích hợp làm đẹp AI cho ảnh selfie đẹp tự nhiên', 'Việt Nam', 0),
(1009, 9, 3, 'Oppo a92', 'oppoa92.jpg', 4999000, 11, 'Chiếc điện thoại gây ấn tượng với thiết kế màn hình khoét lỗ tràn viền, cụm 4 camera ấn tượng và được bán với mức giá vô cùng phải chăng.', 'Việt Nam', 1),
(1010, 9, 3, 'Oppo f9', 'oppof9.jpg', 7999999, 11, 'Là chiếc điện thoại OPPO mới nhất sở hữu công nghệ sạc VOOC đột phá, OPPO F9 còn được ưu ái nhiều tính năng nổi trội như thiết kế mặt lưng chuyển màu độc đáo, màn hình tràn viền giọt nước và camera chụp chân dung tích hợp trí tuệ nhân tạo A.I hoàn hảo.', 'Việt Nam', 0),
(1011, 9, 3, 'Oppo f11', 'oppof11.jpg', 7999999, 11, 'OPPO F11 gây ấn tượng với người dùng bởi thiết kế màn hình tràn viền hình giọt nước và camera sau khủng đến 48 MP.', 'Việt Nam', 0),
(1012, 9, 3, 'Oppo f1s', 'oppof1s', 3999999, 11, 'OPPO F1s sẽ là chiếc điện thoại thông minh được OPPO giới thiệu tại Việt Nam nhằm đánh vào sở thích selfie của giới trẻ với điểm nhấn là camera trước có độ phân giải lên tới 16 MP.', 'Việt Nam', 1),
(1013, 6, 3, 'Xiaomi note 5', 'xiaominote5.jpg', 2000903, 11, 'Thiết kế nguyên khối bằng kim loại sang trọng với cụm camera kép đặt dọc.', 'Việt Nam', 0),
(1014, 6, 3, 'Xiaomi note 7', 'xiaominote7.jpg', 6999999, 11, 'Redmi Note 7 xứng đáng là một trong những chiếc smartphone có hiệu năng tốt, với điểm Antutu đo được khoảng 137586.', 'Việt Nam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserTypeID` int(11) DEFAULT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `PassWord` varchar(32) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserTypeID`, `FullName`, `UserName`, `PassWord`, `Email`) VALUES
(42, 1, 'admin', 'admin', 'admin', 'admin@gmail.com'),
(43, NULL, 'Hoang Vu', 'vu', 'vu1234', 'vu@gmail.com'),
(44, NULL, 'Hoàng Vũ', 'hoangvuff', '1', 'vu2k1@gmail.com'),
(45, NULL, 'Quốc Tuấn', 'tuan', 'tuan', 'tuan@gmail.com'),
(46, NULL, 'Hoàng Vũ', 'hoangvu', 'vu', 'vu2k11@gmail.com'),
(47, NULL, 'Hoàng Vũ', 'Phanhoangvu622', 'vu', 'a'),
(48, NULL, 'tuan', 'tuanbo', '1', 'tuan1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `UserTypeID` int(11) NOT NULL,
  `UserTypeName` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`UserTypeID`, `UserTypeName`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`ManufacturerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ManufacturerID` (`ManufacturerID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `GroupID` (`UserTypeID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`UserTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `ManufacturerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1015;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `UserTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

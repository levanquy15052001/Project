-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 20, 2023 at 02:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoping`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_12_06_062352_create_tbl_admin_table', 1),
(4, '2022_12_06_082956_create_tbl_category_product', 2),
(5, '2022_12_07_110232_create_tbl_brand_product', 3),
(6, '2022_12_10_070202_create_tbl_product', 4),
(7, '2023_01_06_184431_create_img_desc_table', 5),
(8, '2023_01_06_185002_create_cart_table', 5),
(9, '2023_01_10_115714_tbl_information', 5),
(10, '2023_01_11_100111_tbl_shopping', 5),
(11, '2023_03_02_075225_create_customer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand_product`
--

CREATE TABLE `tbl_brand_product` (
  `brand_id` int UNSIGNED NOT NULL,
  `brand_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_status` int NOT NULL,
  `id_user_add` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_brand_product`
--

INSERT INTO `tbl_brand_product` (`brand_id`, `brand_name`, `brand_desc`, `brand_status`, `id_user_add`, `created_at`, `updated_at`, `del_flag`) VALUES
(1, 'Asus', 'Asus', 2, 1, '2022-12-07 04:25:15', '2022-12-12 20:57:01', 0),
(2, 'MSI', 'MSI', 2, 1, '2022-12-07 04:39:07', '2022-12-12 20:39:25', 0),
(3, 'GIGABYTE', 'GIGABYTE', 2, 1, '2022-12-07 04:39:32', '2022-12-12 20:43:06', 0),
(4, 'Coler Master', 'Coler Master', 2, 2, '2023-02-19 05:26:29', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int UNSIGNED NOT NULL,
  `shoping_id` int NOT NULL,
  `price` float NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `shoping_id`, `price`, `status`, `created_at`, `updated_at`) VALUES
(10, 6, 9699000, 1, '2023-03-06 20:33:13', '2023-03-06 20:33:13'),
(11, 7, 17490000, 1, '2023-03-13 18:11:48', '2023-03-13 18:11:48'),
(12, 8, 210000, 1, '2023-03-13 18:11:50', '2023-03-13 18:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_product`
--

CREATE TABLE `tbl_category_product` (
  `category_id` int UNSIGNED NOT NULL,
  `category_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_status` int NOT NULL,
  `id_user_add` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_category_product`
--

INSERT INTO `tbl_category_product` (`category_id`, `category_name`, `category_desc`, `category_status`, `id_user_add`, `created_at`, `updated_at`, `del_flag`) VALUES
(1, 'Màn Hình', 'Thuộc Loại Màn Hình', 2, 1, '2022-12-06 01:45:04', '2022-12-06 03:57:43', 0),
(7, 'Tai Nghe', 'Tai Nghe', 2, 1, '2022-12-11 23:21:16', NULL, 0),
(8, 'Lap Top', 'Lap Top', 2, 2, '2022-12-11 23:21:51', '2022-12-12 20:50:45', 0),
(9, 'Nguồn Máy Tính', 'Nguồn Máy Tính', 2, 2, '2023-02-19 05:18:15', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_img_desc`
--

CREATE TABLE `tbl_img_desc` (
  `img_desc_id` int UNSIGNED NOT NULL,
  `id_product` int NOT NULL,
  `img_id_prduct` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_information`
--

CREATE TABLE `tbl_information` (
  `id` int UNSIGNED NOT NULL,
  `customer_id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_information`
--

INSERT INTO `tbl_information` (`id`, `customer_id`, `name`, `email`, `phone`, `address`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'Le Van Quy', 'levanquy15@gmail.com', '0347026392', '120/ 9 luong ngoc Quyen P5 go vap, TPHCM', 'Giao ngay cuoi tuan', NULL, '2023-03-02 02:03:36'),
(11, 3, 'testUSer1', 'testUSer1@gmail.com', '0347026392', 'Thôn Kế Tân, xã IaSol, huyện Phú Thiện, Gia Lai', '', '2023-03-05 10:52:58', '2023-03-05 10:52:58'),
(12, 4, 'Testuser3', 'Testuser3@gmail.com', '0347026392', '120/9 luong ngoc quyen Phường 05 Quận Gò Vấp Thành phố Hồ Chí Minh', '', '2023-03-05 11:15:01', '2023-03-05 11:15:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int UNSIGNED NOT NULL,
  `category_id` int NOT NULL,
  `product_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int NOT NULL,
  `product_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `del_flag` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_name`, `brand_id`, `product_desc`, `product_content`, `product_price`, `product_img`, `product_status`, `created_at`, `updated_at`, `del_flag`) VALUES
(4, 8, 'Laptop Gaming Asus TUF A15 FA506IHRB-HN080W Geforce GTX 1650 4GB AMD Ryzen 5 4600H 8GB 512GB 15.6″ 144Hz IPS Win 11 Gray Metal RGB', 1, 'ASUS TUF A15 FA506IHRB-HN080W sẽ thay đổi cách bạn nhìn vào laptop chơi game. được trang bị phần cứng ấn tượng, thiết kế gọn nhưng mạnh mẽ. Trang bị bộ vi xử lý AMD thế hệ mới nhất, hỗ trợ ram tối đa 32GB, VGA GTX 16 series, màn hình IPS 144Hz với bàn phím có đèn nền RGB. Có bàn phím chuyên dụng chơi game với các phím RGB-backlit. Cụm phím WASD nổi bật và công nghệ Overstroke để thao tác nhanh và chính xác. Với màn hình NanoEdge IPS cấp độ tiên tiến, và độ bền được chứng nhận kiểm tra MIL-STD-810G. ASUS TUF A15 FA506IHRB-HN080W mang đến trải nghiệm chơi game phong phú mọi lúc mọi nơi!', 'Thiết kế màn hình NanoEdge mới với viền mỏng chỉ 6.5mm. Khung máy nhỏ gọn hơn nhưng không làm giảm kích thước khung hình. Sở hữu màn hình IPS-level với tần số quét cực nhanh lên đến 144Hz cho gameplay siêu mượt giúp tạo ra các hình ảnh cực rõ nét. Độ phủ màu sRGB đạt 63% và góc nhìn rộng đảm bảo màu sắc sống động và chân thực nhất.', '16890000', '1670826319_TUF-A15-FA506IHRB-HN080W.jpg', 2, '2022-12-11 23:25:19', '2022-12-12 20:57:01', 0),
(5, 8, 'Laptop Asus VivoBook Pro 15X A1503ZA-L1151W Intel Core i3 1220P 8GB 256GB 15.6\" OLED FHD Win11 Moonlight', 1, 'Tỏa sáng với cả thế giới cùng ASUS VivoBook Pro 15X A1503ZA-L1151W, máy tính xách tay đầy đủ tính năng với màn hình OLED HDR cực sáng với dải màu DCI-P3 đẳng cấp điện ảnh. VivoBook Pro 15X A1503ZA-L1151W cho phép hoàn thành mọi việc dễ dàng, mọi lúc mọi nơi: mọi khía cạnh đều được cải tiến, từ bộ vi xử lý di động Intel® thế hệ 12 mạnh mẽ tới bản lề duỗi thẳng 180°, thiết kế hình học thanh mảnh và màu sắc hiện đại. Bắt đầu ngày mới đầy hứng khởi với VivoBook Pro 15X A1503ZA-L1151W OLED!', 'ASUS VivoBook Pro 15X A1503ZA-L1151W là người bạn đồng hành bắt mắt hàng ngày của bạn, luôn sẵn sàng thực hiện mọi tác vụ một cách dễ dàng cho dù bạn làm việc văn phòng hay cá nhân, chuẩn bị bài thuyết trình hay giải trí. Bộ vi xử lý Intel® Core™ thế hệ 12 được tăng tốc với bộ nhớ nhanh 8 GB và ổ SSD lên đến 256GB tốc độ cao, điều đó có nghĩa là bạn luôn có thêm sức mạnh dự phòng khi cần.', '15890000', '1670826382_vivo15x-aa.jpg', 2, '2022-12-11 23:26:22', '2022-12-12 20:57:01', 0),
(6, 8, 'Laptop Asus VivoBook Pro 15X M1503QA-L1044W AMD Ryzen 7 5800H 8GB 512GB 15.6\" OLED FHD Win11 Silver', 1, 'Asus VivoBook Pro 15X M1503QA-L1044W là dòng sản phẩm được định vị nằm giữa VivoBook Pro và ZenBook. Hướng đến đối tượng người sáng tạo nội dung trẻ tuổi, vlogger hoặc những nghệ sĩ tự do. Bề mặt của máy được hoàn thiện với họa tiết dệt cho cảm giác như. những tờ giấy nhám cực mịn và hạn chế tối đa việc để lại dấu tay. Thiết kế của máy cũng cực kì trẻ trung, khu vực bàn phím được mã màu rõ ràng cho từng khu vực phím. Touchpad kích thước lớn tích hợp phím xoay ASUS DialPad với chức năng tương tự như con xoay vật lí trên máy Studiobook.', 'Màn hình sẽ là thứ làm người dùng hài lòng khi sử dụng công nghệ OLED. Kích thước 15.6 inches độ phân giải 1920 x 1080. Tỉ lệ 16:9 thích hợp để làm việc. Về cổng kết nối, máy có đầy đủ những cổng kết nối mà người dùng làm sáng tạo nội dung cần đến như cổng. USB Type A, cổng USB Type C, cổng HDMI và cổng đầu đọc thẻ nhớ. Cuối cùng cấu hình của máy sẽ đủ để đáp ứng nhu cầu. Khi trang bị CPU AMD Ryzen 5000 H-Series, đồ họa AMD Radeon, lưu trữ SSD PCIe và bộ nhớ 16GB DDR4 tốc độ cao.', '17490000', '1670826437_vivo15pro-ma005w-1114x828-1.jpg', 2, '2022-12-11 23:27:17', '2022-12-12 20:57:01', 0),
(7, 8, 'Thin GF63 11UD (473VN)', 2, 'CPU Intel® Core™ i5-11400H\r\nHĐH Windows 11 Home\r\nGPU NVIDIA® GeForce RTX™ 3050Ti 4GB GDDR6\r\nMàn hình 15.6\" FHD, IPS-level\r\nRAM 8GB / SSD 512GB', 'Hiệu năng đỉnh cao cùng hệ thống tản nhiệt mạnh mẽ, giúp máy luôn ổn định ngay cả khi chơi các tựa game nặng, đáp ứng mọi nhu cầu khắt khe của các game thủ.', '21990000', '1670826691_ThinGF63.png', 2, '2022-12-11 23:31:31', NULL, 0),
(8, 8, 'Modern 14 B11MOU (1033VN)', 2, 'CPU Intel®Core™ i7-1195G7\r\nHĐH Windows 11 Home\r\nGPU Intel® Iris Xe Graphics\r\nMàn hình 14\" FHD, IPS-level\r\nRAM 8GB / SSD 512GB', 'Dòng máy Doanh nhân & Văn phòng của MSI mang lại hiệu năng, độ bền, tính cơ động, độ bảo mật và thời lượng pin cao. Nhờ đó bạn có thể xử lí công việc thường ngày một cách hiệu quả nhất.', '16990000', '1670826760_Modern-14-B11S.png', 2, '2022-12-11 23:32:40', NULL, 0),
(9, 8, 'Creator M16 A12UC (291VN)', 2, 'CPU Intel®Core™ i7-12700H\r\nHĐH Windows 11 Home\r\nGPU NVIDIA® GeForce RTX™ 3050 4GB GDDR6\r\nMàn hình 16\" QHD+, 100% DCI-P3\r\nRAM 16GB / SSD 512GB', 'Dòng máy Sáng tạo nội dung là công cụ hoàn hảo để giúp bạn tạo nên những tác phẩm để đời. Với Creator series, chúng tôi đáp ứng mọi nhu cầu của các nhà sáng tạo.', '36990000', '1670826809_Creator-M16-A12U-1583.png', 2, '2022-12-11 23:33:29', NULL, 0),
(10, 8, 'Laptop Gigabyte U4 (UD-50S1823SO)', 3, 'Phiên bản laptop GIGABYTE sở hữu trọng lượng 0.99 kg và dày 17.2 mm với lớp vỏ kim loại cao cấp bên ngoài, mang đến một thiết bị di động, sẵn sàng nằm gọn trong balo, phục vụ bạn suốt hành trình chuyến đi, cả khi đang di chuyển.', 'Giải quyết hàng loạt tác vụ văn phòng trên các ứng dụng Word, Excel,... một cách nhanh gọn và hiệu quả nhờ sức mạnh đến từ bộ vi xử lý intel thế hệ 11, không những cùng bạn hoàn thành tốt mọi công việc văn phòng mà còn thoả mãn niềm đam mê thiết kế sản phẩm, sáng tạo nội dung của bạn.', '16099000', '1670826953_250_63934_laptop_gigabyte_u4_11.jpeg', 2, '2022-12-11 23:35:53', NULL, 0),
(11, 8, 'Laptop Gigabyte Gaming G5', 3, 'Lớp vỏ của chiếc laptop GIGABYTE này được làm từ nhựa để thoát nhiệt tốt hơn và sở hữu gam màu đen cực mạnh mẽ, logo kim loại sáng bóng nằm giữa mặt lưng thu hút từ ánh nhìn đầu tiên. Máy có trọng lượng 2.03 kg và có độ dày 24.9 mm đáp ứng khá tốt nhu cầu di chuyển của người dùng cùng với một chiếc laptop gaming.', 'Laptop được trang bị con chip Intel Core i thế hệ 11 hậu tố H với cấu trúc 6c/12t với i5 và 8c/16t với 7 đem đến xung nhịp tối đa đạt hơn 4.5 GHz trên công nghệ Turbo Boost cho hiệu suất tăng 20% so với các thế hệ trước, không chỉ chơi game tốt mà nó còn đem đến sức mạnh vượt trội xử lý nhanh gọn các phần mềm văn phòng trên Word, Excel, PowerPoint,... hay thiết kế poster, chỉnh sửa hình ảnh, render video,... mượt mà.', '19299000', '1670827014_62495_laptop_gigabyte_gaming_g5_gd_14.png', 2, '2022-12-11 23:36:54', NULL, 0),
(12, 1, 'Màn hình chơi game cong TUF Gaming VG30VQL1A', 1, 'Màn hình chơi game cong 29.5 inch độ phân giải WFHD (2560x1080), độ cong 1500R, với tốc độ làm mới 200Hz cực nhanh được thiết kế cho các game thủ chuyên nghiệp và mang lại trải nghiệm đắm chìm trong game', 'Công nghệ Extreme Low Motion Blur (ELMB ™) của ASUS cho phép thời gian đáp ứng là 1ms (MPRT) cùng với công nghệ Adaptive-sync, giúp loại bỏ hiện tưởng bóng mờ và xé hình với những hình ảnh trong game sắc nét có tốc độ khung hình cực cao', '2000000', '1670827167_w692.png', 2, '2022-12-11 23:39:27', '2022-12-12 20:57:01', 0),
(13, 1, 'Màn hình chơi game ASUS VP279QGL', 1, 'Màn hình LED IPS 27 inch Full HD với góc nhìn rộng 178° trong thiết kế không viền mang đến độ sáng rực rỡ từng góc nhìn', 'Tốc độ làm mới 75Hz và công nghệ Adaptive-Sync/FreeSync™ giúp loại bỏ hiện tượng xé hình và tốc độ khung hình bị giật', '6000000', '1670827230_P_setting_xxx_0_90_end_692.png', 2, '2022-12-11 23:40:30', '2022-12-12 20:57:01', 0),
(14, 8, 'Màn hình máy tính Gaming Gigabyte G34WQC A_EK 34', 3, 'Màn hình máy tính Gaming', 'Màn hình máy tính Gaming', '9699000', '1670827374_gigabeyte_aek34.png', 2, '2022-12-11 23:42:54', NULL, 0),
(15, 7, 'ROG Delta S Core', 1, 'Lightweight 3.5 mm gaming headset with 50 mm ASUS Essence drivers, virtual 7.1 surround sound, compatible with PCs, PlayStation® 5, Nintendo Switch™ and Xbox', 'Exclusive 50 mm ASUS Essence drivers and airtight chamber technology for immersive sound', '400000', '1670827536_h525.png', 2, '2022-12-11 23:45:36', '2022-12-12 20:57:01', 0),
(16, 7, 'Tai nghe MSI H991', 2, 'Còn ở phía mặt sau của chiếc vỏ hộp này, nhà sản xuất sẽ cho các bạn thấy được toàn bộ về tính năng đặc trưng và thông số kỹ thuật của Tai nghe Gaming MSI H991.Tiến hành mở hôp và hình ảnh ngay trước mắt các bạn, chính là chân dung thực tế của chiếc Tai nghe Gaming MSI H991. Một trong những Gaming Headset Over-Ear phổ biến nhất được sử dụng cho hầu hết mọi Gamer.', 'Toàn bộ bề mặt bên ngoài của chiếc Tai nghe Gaming MSI H991 được chia thành 3 khu vực với 3 thành phần nguyên liệu khác nhau.\r\n\r\n– Khu vực thứ nhất chính là phần Housing Frame, nó được làm từ nhựa tổng hợp chất lượng cao cùng với Logo Metal MSI DRAGON rất đẹp.\r\n\r\n– Khu vực thứ hai chính là phần Headband Frame, nó được làm từ kim loại dẻo chắc chắn với bề mặt được phủ sơn chống rỉ.\r\n\r\n– Khu vực cuối cùng chính là Earpad Cushion, hay các bạn có thể gọi nó là vòng tròn đệm tai. Nó được làm từ chất liệu da PU rất mềm với kích thước cực lớn để có thể bao phủ được toàn bộ phần khung bên trong.', '390.000', '1670827600_Tai-nghe-MSI-H991-1.jpg', 2, '2022-12-11 23:46:40', NULL, 0),
(17, 7, 'Tai nghe GIGABYTE AORUS H1 GAMING HEADSET 7.1', 3, 'GIGABYTE, nhà sản xuất phần cứng chơi game cao cấp hàng đầu thế giới đã trình làng mẫu tai nghe gaming mới - AORUS H1. AORUS H1 sử dụng driver 50mm và tạo âm thanh vòm giả lập 7.1 cho phép game thủ nghe được các hướng âm chính xác hơn. Chẳng hạn như việc người chơi có thể nhận ra vị trí thực tế của kẻ thù bằng tiếng bước chân, điều này giúp game thủ dễ dàng giành chiến thắng trong trò chơi mà không bỏ lỡ bất kỳ âm thanh nhỏ nào. Micro trang bị công nghệ ENC (Khử tiếng ồn môi trường xung quanh), giúp lọc tiếng ồn xung quanh một cách hiệu quả để giao tiếp rõ ràng dù người chơi ở đâu. Giao tiếp rõ ràng với các đồng đội giúp hạn chế tình trạng hiểu nhầm ý cũng như tăng khả năng chiến thắng của cả team. Hơn nữa, đối với những người dùng quan tâm đến âm thanh, phần mềm AORUS H1 Audio cung cấp các chế độ có thể tùy chỉnh như bộ chỉnh âm, chế độ môi trường và hiệu ứng giọng nói, v.v., tất cả sẽ mang lại trải nghiệm âm thanh tuyệt vời hơn bao giờ hết.', 'GIGABYTE cân nhắc đến khoảng thời gian chơi game kéo dài, do đó thiết kế AORUS H1 với trọng lượng nhẹ để có thể giảm trực tiếp trọng lượng trên đầu của người dùng. Với thiết kế cấu trúc linh hoạt, mũ chụp tai có phạm vi linh hoạt cho các đường nét khuôn mặt khác nhau, phần bịt tai mềm mại, thoáng khí, và khung đỡ tai nghe linh hoạt có thể phù hợp với nhiều hình dạng đầu khác nhau, do đó người dùng có thể điều chỉnh cho vừa vặn để tránh tạo áp lực lên tai quá mức. Người dùng sẽ cảm thấy tai nghe gaming AORUS tiện dụng hơn, từ đó thoải mái chiến game với trải nghiệm tốt nhất.', '210000', '1670827697_8238_90cb5697_fa60_44c6_b213_05402ae0f0ec.png', 2, '2022-12-11 23:48:17', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shopping`
--

CREATE TABLE `tbl_shopping` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `id_information` int NOT NULL,
  `qty` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_shopping`
--

INSERT INTO `tbl_shopping` (`id`, `product_id`, `customer_id`, `id_information`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(6, 14, 3, 11, 1, 2, '2023-03-05 10:52:58', '2023-03-06 20:33:13'),
(7, 6, 3, 11, 1, 2, '2023-03-05 10:53:21', '2023-03-13 18:11:48'),
(8, 17, 4, 12, 1, 2, '2023-03-05 11:15:01', '2023-03-13 18:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_flag` int NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `admin_flag`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lee Van Quy', 'levanquy@123', '0347026392', NULL, '$2y$10$ZxFGMRzDixlcLgcRG88OJuPXtGdcIR5nV0Zv27hMP7LGYdrKZ9hke', 0, NULL, '2023-02-19 05:08:48', NULL),
(2, 'admin', 'admin@123', '0347026392', NULL, '$2y$10$ZxFGMRzDixlcLgcRG88OJuPXtGdcIR5nV0Zv27hMP7LGYdrKZ9hke', 1, NULL, '2023-02-19 05:11:12', NULL),
(3, 'testsUser', 'testsUser1@gmail11.com', '0347026392', NULL, '$2y$10$ZxFGMRzDixlcLgcRG88OJuPXtGdcIR5nV0Zv27hMP7LGYdrKZ9hke', 0, NULL, '2023-03-02 02:10:15', NULL),
(4, 'testsUser2', 'testsUser2@gmail11.com', '0347026392', NULL, '$2y$10$ZxFGMRzDixlcLgcRG88OJuPXtGdcIR5nV0Zv27hMP7LGYdrKZ9hke', 0, NULL, '2023-03-02 02:10:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_brand_product`
--
ALTER TABLE `tbl_brand_product`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_img_desc`
--
ALTER TABLE `tbl_img_desc`
  ADD PRIMARY KEY (`img_desc_id`);

--
-- Indexes for table `tbl_information`
--
ALTER TABLE `tbl_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_shopping`
--
ALTER TABLE `tbl_shopping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_brand_product`
--
ALTER TABLE `tbl_brand_product`
  MODIFY `brand_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_category_product`
--
ALTER TABLE `tbl_category_product`
  MODIFY `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_img_desc`
--
ALTER TABLE `tbl_img_desc`
  MODIFY `img_desc_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_information`
--
ALTER TABLE `tbl_information`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_shopping`
--
ALTER TABLE `tbl_shopping`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

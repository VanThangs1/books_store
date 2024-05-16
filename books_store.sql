-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 06, 2023 lúc 06:39 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `books_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biography` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`id`, `added_by`, `name`, `biography`, `email`, `phone_number`, `address`, `gender`, `date_of_birth`, `image`, `thumbnail`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Thích Nhất Hạnh', NULL, 'nhathanh@gmail.com', '0987654321', NULL, 'male', NULL, 'http://localhost:8000/storage/uploads/image/yxVK9tPLVFzmsVp3Zhwv.jpg', 'http://localhost:8000/storage/uploads/thumbnail/xIVkTwSM3mqrjxw6cFEx.jpg', '1', NULL, '2023-10-05 17:54:55', '2023-10-05 17:54:55'),
(2, 1, 'Nguyên Phong', NULL, 'nguyenphong@gmail.com', '0987654123', NULL, 'male', NULL, 'http://localhost:8000/storage/uploads/image/giQXRLYnFRO8fErFGmU5.jpg', 'http://localhost:8000/storage/uploads/thumbnail/DCcLxdmK6dGdOqCSelbs.jpg', '1', NULL, '2023-10-05 17:55:46', '2023-10-05 17:55:46'),
(3, 1, 'T. Harv Eker', NULL, 'eker@gmail.com', '0987654221', NULL, 'male', NULL, 'http://localhost:8000/storage/uploads/image/0iaQYhg0zVM26wWz4BXC.jpg', 'http://localhost:8000/storage/uploads/thumbnail/ueDT0zfqGlwrgg8eZ1ms.jpg', '1', NULL, '2023-10-05 18:11:49', '2023-10-05 18:11:49'),
(4, 1, 'Parag Mahajan', NULL, 'Parag@gmail.com', '0875466577', NULL, 'male', NULL, 'http://localhost:8000/storage/uploads/image/wfIOUKqsmq9xclZJXWdP.jpg', 'http://localhost:8000/storage/uploads/thumbnail/utpSuDosmNeK7j489ZaJ.jpg', '1', NULL, '2023-10-05 18:15:40', '2023-10-05 18:15:40'),
(5, 1, 'Jimmy Soni', NULL, 'jimmy@gmail.com', '0976543533', NULL, 'male', NULL, 'http://localhost:8000/storage/uploads/image/IsIMhV2A7Geg9Zi5DmHV.jpg', 'http://localhost:8000/storage/uploads/thumbnail/qbKcLsIphrNEIJHKtHP6.jpg', '1', NULL, '2023-10-05 18:18:12', '2023-10-05 18:18:12'),
(6, 1, 'Đoàn Giỏi', NULL, 'doangioi@gmail.com', '0987565454', NULL, 'male', NULL, 'http://localhost:8000/storage/uploads/image/doUaOAKsG1BWCCtMSeoy.jpg', 'http://localhost:8000/storage/uploads/thumbnail/SICxemV2kHRU09wrprSu.jpg', '1', NULL, '2023-10-05 18:21:15', '2023-10-05 18:21:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `borrows`
--

CREATE TABLE `borrows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` datetime NOT NULL,
  `return_date` datetime NOT NULL,
  `actual_return_date` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `added_by`, `title`, `slug`, `description`, `content`, `parent_id`, `meta_title`, `meta_description`, `image`, `thumbnail`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tiểu thuyết', 'tieu-thuyet', 'Mô tả', 'Content', NULL, 'sadasd', 'ádasd', 'http://localhost:8000/storage/uploads/image/JNEEIXbGeoemEIJ82icW.jpeg', 'http://localhost:8000/storage/uploads/thumbnail/6b9jCkhvTWSLdQBWPsiX.jpeg', '1', '2023-10-05 17:37:44', '2023-10-05 17:37:37', '2023-10-05 17:37:44'),
(2, 1, 'Ngôn Tình Đam Mỹ', 'ngon-tinh-dam-my', NULL, NULL, NULL, NULL, NULL, 'http://localhost:8000/storage/uploads/image/yDxmHG3cHeO28bNKddDA.jpg', 'http://localhost:8000/storage/uploads/thumbnail/DfPAe11a1G1QlgF4ODJU.jpg', '1', NULL, '2023-10-05 17:51:45', '2023-10-05 17:51:45'),
(3, 1, 'Tâm Linh Luân Hồi', 'tam-linh-luan-hoi', NULL, NULL, NULL, NULL, NULL, 'http://localhost:8000/storage/uploads/image/F43R1ZwDmPMqEIRzfT30.jpg', 'http://localhost:8000/storage/uploads/thumbnail/ae7b4xegUNajNQ1uMPYI.jpg', '1', NULL, '2023-10-05 17:52:10', '2023-10-05 17:52:10'),
(4, 1, 'Thiếu Nhi', 'thieu-nhi', NULL, NULL, NULL, NULL, NULL, 'http://localhost:8000/storage/uploads/image/JijamE3VDQ7euGtjuTAW.jpg', 'http://localhost:8000/storage/uploads/thumbnail/YDBLIxBPA1rR9mWHhNZE.jpg', '1', NULL, '2023-10-05 17:52:31', '2023-10-05 17:52:31'),
(5, 1, 'Tiểu Thuyết', 'tieu-thuyet', NULL, NULL, NULL, NULL, NULL, 'http://localhost:8000/storage/uploads/image/LEikV7pqAzul8UraDEg4.jpg', 'http://localhost:8000/storage/uploads/thumbnail/8fmUMGJkzvClalOE9iXe.jpg', '1', NULL, '2023-10-05 17:52:50', '2023-10-05 17:52:50'),
(6, 1, 'Văn Học Kinh Điển', 'van-hoc-kinh-dien', NULL, NULL, NULL, NULL, NULL, 'http://localhost:8000/storage/uploads/image/bzAcnuMnn22q8dPJRUsP.jpg', 'http://localhost:8000/storage/uploads/thumbnail/YOFnRkMe77PlTQpNDP3G.jpg', '1', NULL, '2023-10-05 17:53:14', '2023-10-05 17:53:14'),
(7, 1, 'Xu Hướng Kinh Tế', 'xu-huong-kinh-te', NULL, NULL, NULL, NULL, NULL, 'http://localhost:8000/storage/uploads/image/cDHIzhnpwpuIjY2lG4a5.jpg', 'http://localhost:8000/storage/uploads/thumbnail/6LjQBnt46kyeTewYCUoe.jpg', '1', NULL, '2023-10-05 17:53:40', '2023-10-05 17:53:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(141, '2014_10_12_000000_create_users_table', 1),
(142, '2014_10_12_100000_create_password_resets_table', 1),
(143, '2019_08_19_000000_create_failed_jobs_table', 1),
(144, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(145, '2023_09_10_142249_create_categories_table', 1),
(146, '2023_09_10_191254_create_authors_table', 1),
(147, '2023_09_10_191255_create_products_table', 1),
(148, '2023_09_14_142825_create_orders_table', 1),
(149, '2023_09_14_143137_create_order_details_table', 1),
(150, '2023_09_24_200248_create_borrows_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` bigint(20) NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `order_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `order_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_note` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `successfully_delivery_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `addby_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `item_price` bigint(20) NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ISBN` bigint(20) NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `publication_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `ISBN`, `added_by`, `title`, `slug`, `image`, `thumbnail`, `author_id`, `category_id`, `price`, `quantity`, `description`, `content`, `meta_title`, `meta_description`, `type`, `status`, `publication_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 8935278607311, 1, 'Không Diệt Không Sinh Đừng Sợ Hãi', 'khong-diet-khong-sinh-dung-so-hai', 'http://localhost:8000/storage/uploads/image/72Ui3lqFvsswyReG2ui1.jpg', 'http://localhost:8000/storage/uploads/thumbnail/dtvPi9Et8gE94KNJC8Z7.jpg', 1, 3, 88000, 137, NULL, 'Nhiều người trong chúng ta tin rằng cuộc đời của ta bắt đầu từ lúc chào đời và kết thúc khi ta chết. Chúng ta tin rằng chúng ta tới từ cái Không, nên khi chết chúng ta cũng không còn lại gì hết. Và chúng ta lo lắng vì sẽ trở thành hư vô.\r\n\r\nBụt có cái hiểu rất khác về cuộc đời. Ngài hiểu rằng sống và chết chỉ là những ý niệm không có thực. Coi đó là sự thực, chính là nguyên do gây cho chúng ta khổ não. Bụt dạy không có sinh, không có diệt, không tới cũng không đi, không giống nhau cũng không khác nhau, không có cái ngã thường hằng cũng không có hư vô. Chúng ta thì coi là Có hết mọi thứ. Khi chúng ta hiểu rằng mình không bị hủy diệt thì chúng ta không còn lo sợ. Đó là sự giải thoát. Chúng ta có thể an hưởng và thưởng thức đời sống một cách mới mẻ.\r\n\r\nKhông diệt Không sinh Đừng sợ hãi là tựa sách được Thiền sư Thích Nhất Hạnh viết nên dựa trên kinh nghiệm của chính mình. Ở đó, Thầy Nhất Hạnh đã đưa ra một thay thế đáng ngạc nhiên cho hai triết lý trái ngược nhau về vĩnh cửu và hư không: “Tự muôn đời tôi vẫn tự do. Tử sinh chỉ là cửa ngõ ra vào, tử sinh là trò chơi cút bắt. Tôi chưa bao giờ từng sinh cũng chưa bao giờ từng diệt” và “Nỗi khổ lớn nhất của chúng ta là ý niệm về đến-đi, lui-tới.”\r\n\r\nĐược lặp đi lặp lại nhiều lần, Thầy khuyên chúng ta thực tập nhìn sâu để chúng ta hiểu được và tự mình nếm được sự tự do của con đường chính giữa, không bị kẹt vào cả hai ý niệm của vĩnh cửu và hư không. Là một thi sĩ nên khi giải thích về các sự trái ngược trong đời sống, Thầy đã nhẹ nhàng vén bức màn vô minh ảo tưởng dùm chúng ta, cho phép chúng ta (có lẽ lần đầu tiên trong đời) được biết rằng sự kinh hoàng về cái chết chỉ có nguyên nhân là các ý niệm và hiểu biết sai lầm của chính mình mà thôi.\r\n\r\nTri kiến về sống, chết của Thầy vô cùng vi tế và đẹp đẽ. Cũng như những điều vi tế, đẹp đẽ khác, cách thưởng thức hay nhất là thiền quán trong thinh lặng. Lòng nhân hậu và từ bi phát xuất từ suối nguồn thâm tuệ của Thiền sư Thích Nhất Hạnh là một loại thuốc chữa lành những vết thương trong trái tim chúng ta.\r\n\r\nMã hàng	8935278607311\r\nTên Nhà Cung Cấp	Saigon Books\r\nTác giả	Thích Nhất Hạnh\r\nNXB	Thế Giới\r\nNăm XB	2022\r\nTrọng lượng (gr)	250\r\nKích Thước Bao Bì	20.5 x 13 cm x 1.2\r\nSố trang	224\r\nHình thức	Bìa Mềm\r\nSản phẩm hiển thị trong	\r\nSách Sắp Phát Hành\r\nSaigon Books\r\nSản phẩm bán chạy nhất	Top 100 sản phẩm Tôn Giáo bán chạy của tháng\r\nGiá sản phẩm trên Fahasa.com đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...\r\nChính sách khuyến mãi trên Fahasa.com không áp dụng cho Hệ thống Nhà sách Fahasa trên toàn quốc\r\nNhiều người trong chúng ta tin rằng cuộc đời của ta bắt đầu từ lúc chào đời và kết thúc khi ta chết. Chúng ta tin rằng chúng ta tới từ cái Không, nên khi chết chúng ta cũng không còn lại gì hết. Và chúng ta lo lắng vì sẽ trở thành hư vô.\r\n\r\nBụt có cái hiểu rất khác về cuộc đời. Ngài hiểu rằng sống và chết chỉ là những ý niệm không có thực. Coi đó là sự thực, chính là nguyên do gây cho chúng ta khổ não. Bụt dạy không có sinh, không có diệt, không tới cũng không đi, không giống nhau cũng không khác nhau, không có cái ngã thường hằng cũng không có hư vô. Chúng ta thì coi là Có hết mọi thứ. Khi chúng ta hiểu rằng mình không bị hủy diệt thì chúng ta không còn lo sợ. Đó là sự giải thoát. Chúng ta có thể an hưởng và thưởng thức đời sống một cách mới mẻ.\r\n\r\nKhông diệt Không sinh Đừng sợ hãi là tựa sách được Thiền sư Thích Nhất Hạnh viết nên dựa trên kinh nghiệm của chính mình. Ở đó, Thầy Nhất Hạnh đã đưa ra một thay thế đáng ngạc nhiên cho hai triết lý trái ngược nhau về vĩnh cửu và hư không: “Tự muôn đời tôi vẫn tự do. Tử sinh chỉ là cửa ngõ ra vào, tử sinh là trò chơi cút bắt. Tôi chưa bao giờ từng sinh cũng chưa bao giờ từng diệt” và “Nỗi khổ lớn nhất của chúng ta là ý niệm về đến-đi, lui-tới.”\r\n\r\nĐược lặp đi lặp lại nhiều lần, Thầy khuyên chúng ta thực tập nhìn sâu để chúng ta hiểu được và tự mình nếm được sự tự do của con đường chính giữa, không bị kẹt vào cả hai ý niệm của vĩnh cửu và hư không. Là một thi sĩ nên khi giải thích về các sự trái ngược trong đời sống, Thầy đã nhẹ nhàng vén bức màn vô minh ảo tưởng dùm chúng ta, cho phép chúng ta (có lẽ lần đầu tiên trong đời) được biết rằng sự kinh hoàng về cái chết chỉ có nguyên nhân là các ý niệm và hiểu biết sai lầm của chính mình mà thôi.\r\n\r\nTri kiến về sống, chết của Thầy vô cùng vi tế và đẹp đẽ. Cũng như những điều vi tế, đẹp đẽ khác, cách thưởng thức hay nhất là thiền quán trong thinh lặng. Lòng nhân hậu và từ bi phát xuất từ suối nguồn thâm tuệ của Thiền sư Thích Nhất Hạnh là một loại thuốc chữa lành những vết thương trong trái tim chúng ta.', NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 17:58:01', '2023-10-05 17:58:01'),
(2, 8932000121619, 1, 'Phép Lạ Của Sự Tỉnh Thức', 'phep-la-cua-su-tinh-thuc', 'http://localhost:8000/storage/uploads/image/v6LFbouX3XeQZ9xK29t5.jpg', 'http://localhost:8000/storage/uploads/thumbnail/3wzQ0pX6hUboI28owiu4.jpg', 1, 3, 70000, 50, NULL, NULL, NULL, NULL, '0', '1', '1975-11-11', NULL, '2023-10-05 18:00:28', '2023-10-05 18:00:28'),
(3, 8932000131458, 1, 'Giận', 'gian', 'http://localhost:8000/storage/uploads/image/ytSziDswuyMDjhkJqZqA.jpg', 'http://localhost:8000/storage/uploads/thumbnail/AB15uW7ECna50zWmSSYc.jpg', 1, 3, 120000, 76, NULL, NULL, NULL, NULL, '0', '1', '2001-11-11', NULL, '2023-10-05 18:01:46', '2023-10-05 18:01:46'),
(4, 8932000133704, 1, 'Đường Xưa Mây Trắng - Theo Gót Chân Bụt', 'duong-xua-may-trang-theo-got-chan-but', 'http://localhost:8000/storage/uploads/image/s3i7Z5OHsvLmLW0Pv4M9.jpg', 'http://localhost:8000/storage/uploads/thumbnail/ikGgJAYRZQLYiSCIwb3w.jpg', 1, 3, 239200, 67, NULL, NULL, NULL, NULL, '0', '1', '1987-01-01', NULL, '2023-10-05 18:03:16', '2023-10-05 18:03:16'),
(5, 8935086851760, 1, 'Muôn Kiếp Nhân Sinh - Many Times, Many Lives', 'muon-kiep-nhan-sinh-many-times-many-lives', 'http://localhost:8000/storage/uploads/image/5pG1cxHMQTdyz8Xk80PJ.jpg', 'http://localhost:8000/storage/uploads/thumbnail/z6JrOBRXzsaR5PSBgwMI.jpg', 2, 3, 108000, 123, NULL, NULL, NULL, NULL, '0', '1', '1999-01-01', NULL, '2023-10-05 18:05:21', '2023-10-05 18:05:21'),
(6, 4978348937, 1, 'Minh Triết Trong Đời Sống (Tái Bản)', 'minh-triet-trong-doi-song-tai-ban', 'http://localhost:8000/storage/uploads/image/5izJoVT4ViCo6v68tEhs.webp', 'http://localhost:8000/storage/uploads/thumbnail/m8kMMdeSQQRkGP1Ofmy1.webp', 2, 3, 100000, 232, NULL, NULL, NULL, NULL, '0', '1', '1976-01-01', NULL, '2023-10-05 18:06:18', '2023-10-05 18:06:18'),
(7, 1281278, 1, 'Hoa Sen Trên Tuyết', 'hoa-sen-tren-tuyet', 'http://localhost:8000/storage/uploads/image/MBYXfnqmDQTRGfEdp5Ab.webp', 'http://localhost:8000/storage/uploads/thumbnail/m7ykcOMoWBHJG2pJeJXD.webp', 2, 3, 123000, 342, NULL, NULL, NULL, NULL, '0', '1', '1887-01-01', NULL, '2023-10-05 18:07:35', '2023-10-05 18:07:35'),
(8, 2198174817, 1, 'Trở Về Từ Cõi Sáng (Tái Bản)', 'tro-ve-tu-coi-sang-tai-ban', 'http://localhost:8000/storage/uploads/image/Z0gjpsqPQIwH1AeHSazg.webp', 'http://localhost:8000/storage/uploads/thumbnail/bPwkU0GT8meMbKUjVt9d.webp', 2, 3, 198000, 242, NULL, NULL, NULL, NULL, '0', '1', '1908-07-09', NULL, '2023-10-05 18:08:30', '2023-10-05 18:08:30'),
(9, 8935086854624, 1, 'Bí Mật Tư Duy Triệu Phú (Tái Bản 2021)', 'bi-mat-tu-duy-trieu-phu-tai-ban-2021', 'http://localhost:8000/storage/uploads/image/zkaMbFKTWH8nlCCJ2syE.jpg', 'http://localhost:8000/storage/uploads/thumbnail/hk48Df6sqq3h0QcGTJmW.jpg', 3, 7, 86400, 200, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 18:12:50', '2023-10-05 18:12:50'),
(10, 8936144201930, 1, 'Million Muskmelons - Triệu Quả Dưa Lưới', 'million-muskmelons-trieu-qua-dua-luoi', 'http://localhost:8000/storage/uploads/image/IpsZr1UHPptp3YoRdv65.jpg', 'http://localhost:8000/storage/uploads/thumbnail/Itt10bdwwG5l3VxL0PfV.jpg', 4, 7, 138000, 100, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 18:16:51', '2023-10-05 18:16:51'),
(11, 8936066696753, 1, 'Elon Musk Và Cuộc Cách Mạng Tài Chính Toàn Cầu', 'elon-musk-va-cuoc-cach-mang-tai-chinh-toan-cau', 'http://localhost:8000/storage/uploads/image/DuUkJxQZp9zHGxIwqEWY.jpg', 'http://localhost:8000/storage/uploads/thumbnail/KGCzmV4gRAUAdmHwHHuA.jpg', 5, 7, 188000, 23, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 18:19:29', '2023-10-05 18:19:29'),
(12, 8935244872002, 1, 'Đất Rừng Phương Nam', 'dat-rung-phuong-nam', 'http://localhost:8000/storage/uploads/image/1I89RwsFIbTqhOBW68Zw.jpg', 'http://localhost:8000/storage/uploads/thumbnail/55OfkJot0E1Ii4B9ByGd.jpg', 6, 6, 200000, 100, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 18:22:14', '2023-10-06 04:28:43'),
(13, 9786042081313, 1, 'Trần Văn Ơn', 'tran-van-on', 'http://localhost:8000/storage/uploads/image/stklGtAQIiIK2O1BsWLY.jpg', 'http://localhost:8000/storage/uploads/thumbnail/I3rRImZBjlkrPs8AJCcw.jpg', 6, 6, 34000, 343, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 18:23:33', '2023-10-05 18:23:33'),
(14, 9786042081276, 1, 'Người Thủy Thủ Già Trên Hòn Đảo Lưu Đày', 'nguoi-thuy-thu-gia-tren-hon-dao-luu-day', 'http://localhost:8000/storage/uploads/image/ly2idoCsdVHIQQAKevKV.jpg', 'http://localhost:8000/storage/uploads/thumbnail/EX8kBH2wqASpYqBUAU52.jpg', 6, 6, 62000, 21, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, '2023-10-05 18:24:46', '2023-10-05 18:24:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone_number`, `address`, `gender`, `date_of_birth`, `image`, `thumbnail`, `is_admin`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Van Duc', 'hoduc589@gmail.com', NULL, '$2y$10$bprHhaqnA2UAJQiqUruqbO6TPjs8ycBSCxaQEMqpsJJ6mVLL.RcCW', NULL, NULL, NULL, NULL, '', '', '1', '1', NULL, NULL, '2023-10-05 17:36:46', '2023-10-05 17:36:46');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authors_added_by_foreign` (`added_by`);

--
-- Chỉ mục cho bảng `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrows_user_id_foreign` (`user_id`),
  ADD KEY `borrows_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_added_by_foreign` (`added_by`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_added_by_foreign` (`added_by`),
  ADD KEY `products_author_id_foreign` (`author_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `authors_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `borrows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `products_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

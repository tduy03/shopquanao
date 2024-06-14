-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 14, 2024 lúc 10:37 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shopquanao`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(9) NOT NULL,
  `iddh` int(9) NOT NULL,
  `idpro` int(8) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 0,
  `donggia` double(10,2) NOT NULL DEFAULT 0.00,
  `size` varchar(50) NOT NULL,
  `giacu` varchar(50) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `img` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `iddh`, `idpro`, `soluong`, `donggia`, `size`, `giacu`, `tensp`, `img`) VALUES
(118, 140, 117, 2, 350000.00, 'L', '400000', 'OLD SKOOL FLANNEL RED', '../uploads/mat_truoc_12fe8692d6c646bab692bf1d0821ff94_master.jpg'),
(119, 140, 118, 1, 350000.00, 'XL', '400000', '', '../uploads/1__2__d5b4832db3f34643b8fb144eb31f536f_master.webp'),
(120, 141, 118, 1, 350000.00, 'XL', '400000', '', '../uploads/1__2__d5b4832db3f34643b8fb144eb31f536f_master.webp'),
(123, 144, 118, 1, 350000.00, '', '400000', '', '../uploads/1__2__d5b4832db3f34643b8fb144eb31f536f_master.webp'),
(124, 144, 83, 1, 400000.00, 'XL', '500000', 'YEAR OF DRAGON SHIRT', '../uploads/2_15b30f99190d466e8073d871fe1f791d_grande.webp'),
(127, 147, 117, 1, 350000.00, 'XL', '400000', 'OLD SKOOL FLANNEL RED', '../uploads/mat_truoc_12fe8692d6c646bab692bf1d0821ff94_master.jpg'),
(128, 148, 119, 1, 400000.00, 'L', '500000', 'B-ROCKER TEE - GREY', '../uploads/grey_1_6ae65d6694fb44798a0c4b78adf394a8_master.png'),
(129, 148, 116, 1, 380000.00, 'XL', '400000', 'BAD HABITS JERSEY', '../uploads/1_57682ff617e74086bc333e2e742fac19_master.webp'),
(130, 149, 118, 1, 350000.00, 'L', '400000', '', '../uploads/1__2__d5b4832db3f34643b8fb144eb31f536f_master.webp'),
(132, 151, 118, 1, 350000.00, 'M', '400000', '', '../uploads/1__2__d5b4832db3f34643b8fb144eb31f536f_master.webp'),
(133, 152, 107, 1, 500000.00, 'XL', '650000', 'DISSTRESS BAD DENIM LABEL', '../uploads/1_24c39319e96e45e2a67aa725c9e45067_master.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `id` int(4) NOT NULL,
  `tendm` varchar(50) NOT NULL,
  `uutien` int(4) NOT NULL DEFAULT 0,
  `hienthi` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`id`, `tendm`, `uutien`, `hienthi`) VALUES
(4, 'LOCALBRAND', 0, 1),
(5, 'ĐỒ THỂ THAO', 0, 1),
(14, 'MẶC HÀNG NGÀY', 0, 1),
(20, 'BEST - SELLING', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_image_libary`
--

CREATE TABLE `tbl_image_libary` (
  `id` int(11) NOT NULL,
  `product_id` int(6) NOT NULL,
  `img` varchar(250) NOT NULL,
  `ngaytao` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_image_libary`
--

INSERT INTO `tbl_image_libary` (`id`, `product_id`, `img`, `ngaytao`) VALUES
(8, 100, '../uploads/1.webp', ''),
(9, 100, '../uploads/2.webp', ''),
(10, 100, '../uploads/3.webp', ''),
(11, 100, '../uploads/4.webp', ''),
(12, 116, '../uploads/2_eca4bca0d1c34e7e8a084ebb513e988b_master.webp', ''),
(13, 116, '../uploads/bh37_22fe69dc1cfe4ffdb9db86db667a9bb9_master.webp', ''),
(14, 116, '../uploads/ban_sao_cua_bh34_78ebcb17f7c645d38030895fcb49f65d_master.webp', ''),
(15, 116, '../uploads/1_57682ff617e74086bc333e2e742fac19_master.webp', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_oder`
--

CREATE TABLE `tbl_oder` (
  `id` int(9) NOT NULL,
  `madh` varchar(20) NOT NULL,
  `tongdonhang` double(10,0) NOT NULL DEFAULT 0,
  `pttt` tinyint(4) NOT NULL DEFAULT 1,
  `iduser` int(6) NOT NULL,
  `hoten` varchar(30) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `ngaydat` datetime NOT NULL,
  `trangthai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_oder`
--

INSERT INTO `tbl_oder` (`id`, `madh`, `tongdonhang`, `pttt`, `iduser`, `hoten`, `address`, `email`, `tel`, `ngaydat`, `trangthai`) VALUES
(140, 'DYU91183', 1050000, 2, 0, 'Lê Đức Anh', 'Ninh Bình', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-14 19:07:17', 'Đã xác nhận'),
(141, 'DYU99225', 350000, 2, 0, 'Đinh Tuấn Duy', 'Ninh Bình', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-14 19:31:10', 'Đã xác nhận'),
(144, 'DYU72283', 750000, 2, 0, 'Hoàng Văn Quý', 'Ninh Bình', '21111064581@hunre.edu.vn', '0355027177', '2024-06-14 20:21:12', 'Đã xác nhận'),
(147, 'DYU2904', 350000, 2, 0, 'Đinh Tuấn Khanh', 'Lãng Nội', '21111064581@hunre.edu.vn', '0392861103', '2024-06-14 20:48:54', 'Đã xác nhận'),
(148, 'DYU58020', 780000, 2, 0, 'Đinh Tuấn Duy', 'Ninh Bình', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-14 20:49:37', 'Chưa xác nhận'),
(149, 'DYU16268', 350000, 2, 0, 'Đinh Tuấn Duy', 'Ninh Bình', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-14 21:03:21', 'Chưa xác nhận'),
(151, 'DYU65638', 350000, 2, 0, 'Đinh Tuấn Duy', 'Ninh Bình', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-14 21:13:10', 'Huỷ đơn hàng'),
(152, 'DYU95496', 500000, 2, 0, 'Đinh Tuấn Duy', 'Ninh Bình', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-14 21:41:18', 'Đã xác nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id` int(6) NOT NULL,
  `tensp` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `giacu` varchar(50) NOT NULL DEFAULT '0',
  `gia` varchar(50) NOT NULL DEFAULT '0',
  `iddm` int(4) NOT NULL,
  `view` int(6) NOT NULL DEFAULT 0,
  `special` tinyint(1) NOT NULL DEFAULT 0,
  `mota` varchar(255) DEFAULT NULL,
  `dacdiem` varchar(100) NOT NULL,
  `size` varchar(10) NOT NULL,
  `ngaytao` varchar(50) NOT NULL,
  `chatlieu` varchar(50) NOT NULL,
  `detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id`, `tensp`, `img`, `giacu`, `gia`, `iddm`, `view`, `special`, `mota`, `dacdiem`, `size`, `ngaytao`, `chatlieu`, `detail`) VALUES
(52, 'STOP THINK BOXY TEE - BLACK', '../uploads/1.webp', '400000', '350000', 4, 0, 0, '<p>xcb</p>', '<p>svd</p>', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(83, 'YEAR OF DRAGON SHIRT', '../uploads/2_15b30f99190d466e8073d871fe1f791d_grande.webp', '500000', '400000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% cotton', NULL),
(84, 'TOO BAD, TOO LAZY RAGPLAN HOODIE - BROWN', '../uploads/1__4__c45c7db8141442599bcaa4a852ba2c9b_cc8bd85b591747faba411036dbb77268_master.webp', '400000', '350000', 4, 0, 0, '', '', 'S,M,L', '2024-06-13', '100% Cotton', NULL),
(85, 'BLACK TEE STREETWEAR', '../uploads/2_0a0067b96cdb4f6c818ae94ebc08dae6_master.webp', '400000', '350000', 5, 0, 0, '', '', 'S,M,L', '2024-06-13', '100% Cotton', NULL),
(92, 'YOUR SHADOW TEE', '../uploads/rabbit-special-tee_ebe7ea140fc248c49c78e76bcd6cd1e1_master.webp', '400000', '350000', 4, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(100, 'BLACK TEE STREETWEAR', '../uploads/2.webp', '400000', '350000', 4, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(101, 'EYE BOXY TEE', '../uploads/1__10__403b025fc25747aa918f4c1699cccfb0_master.webp', '0', '420000', 4, 0, 0, '', '', 'S,M,L,XL', '2024-06-14', '100% Cotton', NULL),
(102, 'PROTECT FROM FEAR TEE', '../uploads/protect_from_fear_tee1_ed18d0c6fef44232a1da43e09842bca0_master.webp', '400000', '350000', 5, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(104, 'STOP THINK BOXY TEE - BLACK', '../uploads/5_5387ffd9a5ee4382ba60cfb5c7c8077c_master.webp', '400000', '350000', 14, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(105, 'DOUBLE DESTROYED BAGGY SHORT', '../uploads/2_5d409bc25dfc478aaca2671b1f7711a0_master.webp', '400000', '350000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(106, 'IDLE ZIP POLO', '../uploads/1_ef88bbd410a44e5f9c755427b6502d52_master.webp', '600000', '300000', 14, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(107, 'DISSTRESS BAD DENIM LABEL', '../uploads/1_24c39319e96e45e2a67aa725c9e45067_master.webp', '650000', '500000', 20, 0, 0, '', '', 'M,L,XL', '2024-06-13', '100% Cotton', NULL),
(108, 'DEJAVU BOXY TEE - GREY', '../uploads/1__1__b68a39383a5b4bb0b29d7034870cac1f_master.webp', '400000', '350000', 4, 0, 0, '', '', 'S,M,L', '2024-06-13', '100% Cotton', NULL),
(109, 'DEJAVU BOXY TEE - CREAM', '../uploads/5_4f709f08b06c451381256a65225ecf93_master.webp', '350000', '200000', 5, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(110, 'COFFEE COLOUR BAD & LAZY BABY TEE', '../uploads/7_b8c5d1b42a3e4a2d9ff88d7534e2eae6_master.webp', '400000', '350000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(111, '\"I\'M A BADSTAR\" BAGGY SHORT', '../uploads/1_c3a9de241b1e414fbadb2d47879f2199_master.webp', '400000', '350000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(112, 'SAND MIND ESCAPLE TEE', '../uploads/mind-escape_4e240c883bff4bd3ab0f73bdabe90b00_master.webp', '500000', '400000', 5, 0, 0, '', '', 'M,L,XL', '2024-06-13', '100% Cotton', NULL),
(113, 'GREY DISTRESSED SWEATPANTS', '../uploads/1__2__4542eacfc375452491579ce04a1c78a7_master.webp', '800000', '690000', 5, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(114, 'STONE OF HEART TEE', '../uploads/1__10__403b025fc25747aa918f4c1699cccfb0_master.webp', '400000', '350000', 4, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(115, 'WHITE SUPERLOGO TEE', '../uploads/6__4__c897e219c2e14ad6a55d6dd6215cd80b_master.webp', '400000', '350000', 14, 0, 0, '', '', 'S,M,L,XL', '2024-06-13', '100% Cotton', NULL),
(116, 'BAD HABITS JERSEY', '../uploads/1_57682ff617e74086bc333e2e742fac19_master.webp', '400000', '380000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-14', '100% Cotton', NULL),
(117, 'OLD SKOOL FLANNEL RED', '../uploads/mat_truoc_12fe8692d6c646bab692bf1d0821ff94_master.jpg', '400000', '350000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-14', '100% Cotton', NULL),
(118, '\"HỔ BÁO\" SHIRT', '../uploads/1__2__d5b4832db3f34643b8fb144eb31f536f_master.webp', '400000', '350000', 20, 0, 0, '', '', 'S,M,L,XL', '2024-06-14', '100% Cotton', NULL),
(119, 'B-ROCKER TEE - GREY', '../uploads/grey_1_6ae65d6694fb44798a0c4b78adf394a8_master.png', '500000', '400000', 4, 0, 0, '', '', 'S,M,L,XL', '2024-06-14', '100% Cotton', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(6) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `tel`, `user`, `pass`, `role`) VALUES
(1, 'Đinh Tuấn Duy', '0392861103', 'duy', '123', 1),
(2, 'Oliver Keng', '0355027177', 'user', '1', 0),
(4, 'Đinh Tuấn Khanh', '0392861103', 'khanh', '123', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_userbuy`
--

CREATE TABLE `tbl_userbuy` (
  `id` int(9) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `ngaytao` datetime NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_userbuy`
--

INSERT INTO `tbl_userbuy` (`id`, `name`, `email`, `tel`, `ngaytao`, `pass`) VALUES
(1, 'Đinh Tuấn Duy', 'dinhtuanduy01@gmail.com', '0392861103', '0000-00-00 00:00:00', '123'),
(4, 'Đinh Tuấn Khanh', 'dinhtuanduy01@gmail.com', '0392861103', '2024-06-13 04:21:42', '123'),
(5, 'Đinh Tuấn Duy', '21111064581@hunre.edu.vn', '0392861103', '2024-06-13 04:21:52', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddh` (`iddh`),
  ADD KEY `idpro` (`idpro`);

--
-- Chỉ mục cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_image_libary`
--
ALTER TABLE `tbl_image_libary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_oder`
--
ALTER TABLE `tbl_oder`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sanpham_danhmuc` (`iddm`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_userbuy`
--
ALTER TABLE `tbl_userbuy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbl_image_libary`
--
ALTER TABLE `tbl_image_libary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tbl_oder`
--
ALTER TABLE `tbl_oder`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_userbuy`
--
ALTER TABLE `tbl_userbuy`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`iddh`) REFERENCES `tbl_oder` (`id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`idpro`) REFERENCES `tbl_sanpham` (`id`);

--
-- Các ràng buộc cho bảng `tbl_image_libary`
--
ALTER TABLE `tbl_image_libary`
  ADD CONSTRAINT `tbl_image_libary_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_sanpham` (`id`);

--
-- Các ràng buộc cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`iddm`) REFERENCES `tbl_danhmuc` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

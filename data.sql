-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 13, 2022 lúc 01:45 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `getlink`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `advast` varchar(10000) NOT NULL,
  `adpopup` varchar(6000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `ads`
--

INSERT INTO `ads` (`id`, `advast`, `adpopup`) VALUES
(2, 'https://haun.live/vast.xml', 'https://haun.live/Popup.js');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episode`
--

CREATE TABLE `episode` (
  `id` int(20) NOT NULL,
  `tmdb` int(100) NOT NULL,
  `tentap` varchar(10) NOT NULL,
  `tenphan` varchar(255) NOT NULL,
  `hlink` varchar(255) NOT NULL,
  `link1` varchar(255) NOT NULL,
  `link2` varchar(255) NOT NULL,
  `link3` varchar(255) NOT NULL,
  `link4` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `episode`
--

INSERT INTO `episode` (`id`, `tmdb`, `tentap`, `tenphan`, `hlink`, `link1`, `link2`, `link3`, `link4`) VALUES
(1, 0, '1', '', 'https://www.fembed.com/v/4lo0jr-px9q', 'https://www.fembed.com/v/dzx57fx5px510q2', 'https://www.fembed.com/v/dzx57fx5px510q2', '', ''),
(3, 84958, '1', '1', 'https://file-examples-com.github.io/uploads/2017/04/file_example_MP4_1920_18MG.mp4', 'https://www.fembed.com/v/dzx57fx5px510q2', '', '', ''),
(4, 71712, '1', '2', 'https://file-examples-com.github.io/uploads/2017/04/file_example_MP4_1920_18MG.mp4', 'https://www.fembed.com/v/dzx57fx5px510q2', '', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(7, 'Nguyễn', 'Hậu', 'admin@gmail.com', '$2y$04$UKHGGdO9689WKcovXsZ6c.cUDnaWyuy7KwxIKJETDt1CZb8siPMhC', '2021-08-24 15:30:23', '2021-08-24 15:30:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` int(10) NOT NULL,
  `tmdb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `imdb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tenphim` varchar(255) CHARACTER SET utf8 NOT NULL,
  `anh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `theloai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anhnen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hlink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link4` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `tmdb`, `imdb`, `tenphim`, `anh`, `theloai`, `anhnen`, `hlink`, `link1`, `link2`, `link3`, `link4`) VALUES
(57, '76341', 'tt1392190', 'Max Điên: Con Đường Tử Thần', 'https://image.tmdb.org/t/p/w185/3xyBAAOeCW59Tf9nOf9VtKA5oPn.jpg', 'Phim Hành Động', 'https://image.tmdb.org/t/p/w185/nlCHUWjY9XWbuEUQauCBgnY8ymF.jpg', 'https://www.fembed.com/v/dzx57fx5px510q2', 'https://www.fembed.com/v/dzx57fx5px510q2', 'https://www.fembed.com/v/dzx57fx5px510q2', 'https://www.fembed.com/v/dzx57fx5px510q2', ''),
(58, '335983', 'tt1270797', 'Venom', 'https://image.tmdb.org/t/p/w185/bURIWlkMbzT8RdpemzCmQECo2Uh.jpg', 'Phim Khoa Học Viễn Tưởng', 'https://image.tmdb.org/t/p/w185/VuukZLgaCrho2Ar8Scl9HtV3yD.jpg', 'https://file-examples-com.github.io/uploads/2017/04/file_example_MP4_1920_18MG.mp4', 'https://file-examples-com.github.io/uploads/2017/04/file_example_MP4_1920_18MG.mp4', 'https://www.fembed.com/v/dzx57fx5px510q2', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `season`
--

CREATE TABLE `season` (
  `id` int(20) NOT NULL,
  `anh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tmdb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenphim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tenphan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idphan` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `season`
--

INSERT INTO `season` (`id`, `anh`, `tmdb`, `tenphim`, `tenphan`, `idphan`) VALUES
(16, 'https://image.tmdb.org/t/p/w185/z1K4mJwISETia59rrnMdXxzoSrZ.jpg', '71712', 'Bác Sĩ Thiên Tài', 'Phần 1', '1'),
(17, 'https://image.tmdb.org/t/p/w185/z1K4mJwISETia59rrnMdXxzoSrZ.jpg', '71712', 'Bác Sĩ Thiên Tài', 'Phần 2', '2'),
(18, 'https://image.tmdb.org/t/p/w185/z1K4mJwISETia59rrnMdXxzoSrZ.jpg', '71712', 'Bác Sĩ Thiên Tài', 'Phần 3', '3'),
(19, 'https://image.tmdb.org/t/p/w185/z1K4mJwISETia59rrnMdXxzoSrZ.jpg', '71712', 'Bác Sĩ Thiên Tài', 'Phần 4', '4'),
(21, 'https://image.tmdb.org/t/p/w185/kEl2t3OhXc3Zb9FBh1AuYzRTgZp.jpg', '84958', 'Loki Thần Lừa Lọc', 'Phần 1', '1'),
(22, 'https://image.tmdb.org/t/p/w185/bURIWlkMbzT8RdpemzCmQECo2Uh.jpg', '71712', 'Bác Sĩ Thiên Tài', '', '5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(1) NOT NULL,
  `adblock` varchar(100) NOT NULL DEFAULT '1',
  `default_video` varchar(100) DEFAULT NULL,
  `jw_license` varchar(100) DEFAULT NULL,
  `default_banner` varchar(100) DEFAULT NULL,
  `loading` varchar(1) DEFAULT '1',
  `autoplay` varchar(1) DEFAULT '0',
  `register` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPRESSED;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `adblock`, `default_video`, `jw_license`, `default_banner`, `loading`, `autoplay`, `register`) VALUES
(1, '1', 'http://localhost/uploads/no-video.mp4', 'https://ssl.p.jwpcdn.com/player/v/8.8.6/jwplayer.js', 'http://localhost/uploads/no-video.png', '0', '1', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subtitle`
--

CREATE TABLE `subtitle` (
  `id` int(20) NOT NULL,
  `sublink` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tmdb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imdb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tap` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subtitle`
--

INSERT INTO `subtitle` (`id`, `sublink`, `caption`, `tmdb`, `imdb`, `phan`, `tap`) VALUES
(52, '', 'Vietnamese', '335983', 'tt1270797', '1', '1'),
(53, '', 'Vietnamese', '71712', '', '2', '1'),
(54, '', 'Vietnamese', '71712', '', '1', '1'),
(55, '', 'Vietnamese', '71712', '', '3', '1'),
(56, '', 'Vietnamese', '84958', '', '1', '1'),
(57, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(58, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(59, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(60, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(61, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(62, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(63, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(64, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(65, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(66, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(67, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(68, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(69, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(70, '', 'Vietnamese', '335983', 'tt1270797', '', ''),
(71, '', 'Vietnamese', '84958', '', '1', '1'),
(72, '', 'Vietnamese', '71712', '', '2', '1'),
(73, '', 'English', '335983', 'tt1270797', '', ''),
(74, '', 'English', '335983', 'tt1270797', '', ''),
(75, '', 'English', '335983', 'tt1270797', '', ''),
(76, '', 'English', '335983', 'tt1270797', '', ''),
(77, '', 'English', '335983', 'tt1270797', '', ''),
(78, '', 'English', '335983', 'tt1270797', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tvseries`
--

CREATE TABLE `tvseries` (
  `id` int(10) NOT NULL,
  `tmdb` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `tenphim` varchar(255) CHARACTER SET utf8 NOT NULL,
  `anh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `theloai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anhnen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sophan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tvseries`
--

INSERT INTO `tvseries` (`id`, `tmdb`, `tenphim`, `anh`, `theloai`, `anhnen`, `sophan`) VALUES
(30, '71712', 'Bác Sĩ Thiên Tài', 'https://image.tmdb.org/t/p/w185/z1K4mJwISETia59rrnMdXxzoSrZ.jpg', 'Phim Chính Kịch', 'https://image.tmdb.org/t/p/w185/iDbIEpCM9nhoayUDTwqFL1iVwzb.jpg', '5'),
(31, '84958', 'Loki Thần Lừa Lọc', 'https://image.tmdb.org/t/p/w185/kEl2t3OhXc3Zb9FBh1AuYzRTgZp.jpg', 'Phim Chính Kịch', 'https://image.tmdb.org/t/p/w185/f5tjVQtxihaVwXOdpITSPeIqlpX.jpg', '1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD UNIQUE KEY `id` (`id`,`adblock`,`default_video`,`jw_license`,`default_banner`,`loading`,`autoplay`),
  ADD KEY `id_3` (`id`,`adblock`,`default_video`,`jw_license`,`default_banner`,`loading`,`autoplay`);

--
-- Chỉ mục cho bảng `subtitle`
--
ALTER TABLE `subtitle`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tvseries`
--
ALTER TABLE `tvseries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `episode`
--
ALTER TABLE `episode`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT cho bảng `season`
--
ALTER TABLE `season`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `subtitle`
--
ALTER TABLE `subtitle`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `tvseries`
--
ALTER TABLE `tvseries`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

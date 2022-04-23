-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2022 at 06:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `full_name`, `email`, `phone`, `message`) VALUES
(1, 'tutor', 'tutor@test.com', '1234567890', 'test message from tutor'),
(2, 'fhvbhq', 'gfhbjn@g', '1234567890', 'wesdfghjbnm,');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `full_name`, `video`, `photo`) VALUES
(10, 'Python', 'adthfvehjfsy w k,nsxb vjknbjhvcfxd', 'tutor', 'racingriderreel.mp4', '855088628desktopwallpaper.jpg'),
(12, 'C++', 'dcfvghjbklhjklghjbkgkl;kjhg;;ljkhgfdhgjknbvcxdzfghjkl,mrestgjkl;jhfgdsasDESGTSFYHDGFHKGFHGdtjfkglh', 'test2', 'racingriderreel (1).mp4', '1367806620youtube.png'),
(14, 'C', 'sfdg', 'test2', 'instavideo.mp4', '1036436984wallpaperflare.com_wallpaper.jpg'),
(15, 'Java', 'fdghgfdsertghyfgdvcsdasertghtg', 'test2', '13310779.mp4', '1716754257SS 1_framed (1).png'),
(16, 'Android', 'szdxfcgvhbjmkl,;.', 'tutor', 'output_free.mp4', '1139477506bg.jpg'),
(17, 'PHP', 'sfdgchjbkl;kiuytrdsdxfcvbnkliukytfgvhbjkiuyktjnc bnbj', 'tutor', 'trim1.mp4', '3973233161.png'),
(18, 'ABC', 'aestryhtjykjl;uykujlik;.,fdjshraeyukulijthrahysjdkflv./bgfdk', 'tutor', 'whatsapp-video-2020-08-02-at-111954-am-pedi6yrq-uuva_w8Z6ke0J_W74R.mp4', '1920592345image-removebg-preview (31).png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `is_tutor` enum('student','tutor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `token`, `status`, `photo`, `is_tutor`) VALUES
(11, 'bhavin', 'bhavinshiyaniya1201@gmail.com', 'f4cc399f0effd13c888e310ea2cf5399', '97aeb9ccd26b9fe0328dd5de5b07f82e', 1, '1932054933online_vision.jpg', 'tutor'),
(14, 'admin', 'admin@gmail.com', 'c3284d0f94606de1fd2af172aba15bf3', '1ca4f9932e8c075c5ceb8fc35ecd3e06', 1, '311439592logo.png', 'tutor'),
(15, 'Student', 'test@test.com', '098F6BCD4621D373CADE4E832627B4F6', 'ee38650e20c10c232921a2a46cf00432', 1, '86304595images (4).png', 'student'),
(16, 'test1', 'test1@test.com', '098f6bcd4621d373cade4e832627b4f6', '08d096ca987ea37219d95088334321b3', 1, '647157698image-removebg-preview (31).png', 'student'),
(17, 'test2', 'test2@test.com', 'fb469d7ef430b0baf0cab6c436e70375', '28ec5819ebc22cdca34b85e4f9ef9aff', 1, '2137689870image-removebg-preview (32).png', 'tutor'),
(19, 'a', 'a@a.com', '098F6BCD4621D373CADE4E832627B4F6', 'dbc89a3aaed302ca57ad3f65edfc0f27', 1, '19489772821910070-bigthumbnail.jpg', 'student'),
(20, 'tutor', 'tutor@test.com', '098F6BCD4621D373CADE4E832627B4F6', '981f92757f5453718270baa4feb174d5', 1, '1514082105signin boy.jpg', 'tutor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 06:13 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabaco_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(200) NOT NULL,
  `category_id` int(5) NOT NULL,
  `publish_date` varchar(50) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `category_id`, `publish_date`, `quantity`) VALUES
(1, '0805074481', 'An Army at Dawn : The War in North Africa, 1942-1943', 'Rick Atkinson', 10, 'October 2003', 10),
(2, '7111196260', 'The C Programming Language', 'Dennis M. Ritchie and Brian W. Kernighan', 8, 'January 2006', 10),
(3, '0062869000', 'Obliteration : An Awakened Novel', 'Darren Wearmouth and James S. Murray', 16, 'March 2021', 10),
(4, '1119293359', 'Guitar for Dummies', 'Hal Leonard Corporation, Jon Chappell, Mark Phillips', 4, 'June 2016', 10),
(5, '0749928301', 'The Dip by Seth Godin (2007) Paperback', 'Seth Godin', 6, 'July 2007', 10),
(6, '1506719171', 'Dragon Age: the First Five Graphic Novels', 'Alexander Freed, Greg Rucka, Nunzio DeFilippis, et al.', 17, 'March 2021', 9),
(7, '1481461311', 'Pocket Full of Colors : The Magical World of Mary Blair', 'Amy Guglielmo and Jacqueline Tourville', 19, 'August 2017', 10),
(8, '0553496395', 'Half Baked Harvest Cookbook : Recipes from My Barn in the Mountains', 'Tieghan Gerard', 18, 'September 2017', 10),
(9, '1784042889', 'Animal Farm', 'George Orwell and George Orwel', 2, 'January 2014', 10),
(10, '0590402331', 'If You Give a Mouse a Cookie', 'Laura Joffe Numeroff', 15, 'January 1988', 10),
(11, '1101873442', 'Wild (Movie Tie-In Edition) : From Lost to Found on the Pacific Crest Trail', 'Cheryl Strayed', 5, 'November 2014', 10),
(12, '0143038583', 'The Omnivore\'s Dilemma : A Natural History of Four Meals', 'Michael Pollan', 9, 'August 2007', 10);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id`, `user_id`, `book_id`, `date_borrowed`) VALUES
(6, 2, 6, '2021-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sci-Fi & Fantasy'),
(2, 'Education & Reference'),
(3, 'Science & Math'),
(4, 'Kids'),
(5, 'Biographies'),
(6, 'Business'),
(7, 'Hobbies & Crafts'),
(8, 'Computers & Tech'),
(9, 'Health & Fitness'),
(10, 'History'),
(11, 'Religion'),
(12, 'Travel'),
(13, 'Sports'),
(14, 'Social Sciences'),
(15, 'Entertainment'),
(16, 'Horror'),
(17, 'Comics'),
(18, 'Cooking'),
(19, 'Arts & Music'),
(20, 'Literature & Fiction'),
(21, 'Medical'),
(22, 'Mysteries'),
(23, 'Parenting'),
(24, 'Romance'),
(25, 'Self-Help'),
(26, 'Westerns'),
(27, 'Crime'),
(28, 'Journals'),
(29, 'Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `returned`
--

CREATE TABLE `returned` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `date_borrowed` date NOT NULL,
  `date_returned` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `returned`
--

INSERT INTO `returned` (`id`, `user_id`, `book_id`, `borrow_id`, `date_borrowed`, `date_returned`) VALUES
(1, 2, 1, 1, '2001-05-07', '2021-05-07'),
(2, 2, 1, 3, '0000-00-00', '2021-05-07'),
(3, 2, 10, 2, '2021-05-07', '2021-05-07'),
(4, 2, 5, 4, '2021-05-07', '2021-05-07'),
(5, 2, 8, 5, '2021-05-07', '2021-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(100) NOT NULL DEFAULT 'admin123',
  `image` varchar(255) NOT NULL DEFAULT '../assets/img/default_avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `phone`, `email`, `type`, `password`, `image`) VALUES
(1, 'Administrator', '909090990', 'admin@gmail.com', 0, '12345', '../assets/img/default_avatar.png'),
(2, 'Mark Angelo Limpo', '09984621456', 'limpo.mark@gmail.com', 1, 'user', '../assets/img/default_avatar.png'),
(3, 'Ace Malto', '09984624321', 'acemalto@gmail.com', 1, 'acemalto', '../assets/img/default_avatar.png'),
(4, 'Marc Barcelo', '123467', 'marcbarcelo@email.com', 1, 'marcbarcelo', '../assets/img/default_avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returned`
--
ALTER TABLE `returned`
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
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `returned`
--
ALTER TABLE `returned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

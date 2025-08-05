-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2025 at 11:53 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u168376570_LibraryPlus`
--

-- --------------------------------------------------------

--
-- Table structure for table `ai_chat_history`
--

CREATE TABLE `ai_chat_history` (
  `chatID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_message` text NOT NULL,
  `ai_response` text NOT NULL,
  `context_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`context_data`)),
  `response_time` decimal(5,3) DEFAULT NULL,
  `satisfaction_rating` int(1) DEFAULT NULL COMMENT '1-5 rating',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_recommendations`
--

CREATE TABLE `ai_recommendations` (
  `recommendationID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) NOT NULL,
  `recommendation_type` enum('personalized','trending','similar','category_based') DEFAULT 'personalized',
  `confidence_score` decimal(3,2) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `user_feedback` enum('liked','disliked','neutral') DEFAULT NULL,
  `rating` int(1) DEFAULT NULL COMMENT '1-5 rating',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `feedback_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_search_logs`
--

CREATE TABLE `ai_search_logs` (
  `logID` int(11) NOT NULL,
  `search_query` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `results_count` int(11) DEFAULT 0,
  `search_type` enum('intelligent','basic','recommendation') DEFAULT 'intelligent',
  `response_time` decimal(5,3) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ai_training_data`
--

CREATE TABLE `ai_training_data` (
  `trainingID` int(11) NOT NULL,
  `data_type` enum('book_mapping','user_preference','search_improvement','recommendation_feedback') DEFAULT 'book_mapping',
  `data` longtext NOT NULL,
  `status` enum('pending','processed','failed') DEFAULT 'pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `processed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `bookcategoryID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `isbnno` varchar(100) NOT NULL,
  `coverphoto` varchar(200) NOT NULL,
  `codeno` varchar(100) NOT NULL,
  `rackID` int(11) DEFAULT NULL,
  `editionnumber` varchar(100) NOT NULL,
  `editiondate` datetime DEFAULT NULL,
  `publisher` varchar(100) NOT NULL,
  `publisheddate` datetime DEFAULT NULL,
  `notes` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0= Book Available, 1= Book Not Available',
  `deleted_at` tinyint(4) NOT NULL COMMENT '0= Book Available, 1=Book Deleted ',
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `name`, `author`, `bookcategoryID`, `quantity`, `price`, `isbnno`, `coverphoto`, `codeno`, `rackID`, `editionnumber`, `editiondate`, `publisher`, `publisheddate`, `notes`, `status`, `deleted_at`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'Mathematics', 'SWU', 1, 6, 2000.00, '12334223', 'dff2176d407a5ffc144269c8e8a8cb2a8141371f2df6fcbcd2eb5134f52deb8cbfd1de7d27d7bf3ef8f3fb5379dffcf3d58f6013529af84a57c24675696c7491.png', '123', 1, '12121', '2025-07-06 00:00:00', 'Mr. Morgan', '2025-06-29 00:00:00', '', 0, 0, '2025-07-20 01:47:27', 1, 1, '2025-07-20 01:47:27', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookcategory`
--

CREATE TABLE `bookcategory` (
  `bookcategoryID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `coverphoto` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookcategory`
--

INSERT INTO `bookcategory` (`bookcategoryID`, `name`, `description`, `coverphoto`, `status`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'Mathematics', 'Mathematics books', '9ab3973fbc9d6415265668365a7b124a918490bb6e4af722f825cf570c413f780e17885b17eba94884d46c98d5014691094ae80594871a3c53d128147f1f9e15.png', 1, '2025-07-20 01:44:28', 1, 1, '2025-07-20 01:44:28', 1, 1),
(2, 'Englsih', 'English Description', 'be23dfc26a4f2e1c0a6b617f1fc6d68a60be994937aee483916a5636e81e01e9407acc7832211f39af1c4a0357b23dffba4d04dccbe9be7d72211cb6b5fbf79a.jpg', 1, '2025-07-20 01:45:18', 1, 1, '2025-07-20 01:45:18', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookissue`
--

CREATE TABLE `bookissue` (
  `bookissueID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `bookcategoryID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `bookno` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `issue_date` datetime NOT NULL,
  `expire_date` datetime NOT NULL,
  `renewed` tinyint(4) NOT NULL,
  `max_renewed_limit` tinyint(4) NOT NULL,
  `book_fine_per_day` decimal(10,2) NOT NULL,
  `fineamount` decimal(10,2) NOT NULL,
  `paymentamount` decimal(10,2) NOT NULL,
  `discountamount` decimal(10,2) NOT NULL,
  `paidstatus` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = due,  1 = partial, 2 = Paid',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Issued,  1 = Return, 2 = Lost',
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Not Deleted, 1 = Deleted',
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookissue`
--

INSERT INTO `bookissue` (`bookissueID`, `roleID`, `memberID`, `bookcategoryID`, `bookID`, `bookno`, `notes`, `issue_date`, `expire_date`, `renewed`, `max_renewed_limit`, `book_fine_per_day`, `fineamount`, `paymentamount`, `discountamount`, `paidstatus`, `status`, `deleted_at`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 3, 3, 1, 1, 2, 'you  must return in 72hours', '2025-07-19 00:00:00', '2025-07-29 00:00:00', 1, 10, 10.00, 0.00, 0.00, 0.00, 0, 0, 0, '2025-07-20 01:48:45', 1, 1, '2025-07-20 01:48:45', 1, 1),
(2, 5, 2, 1, 1, 3, '', '2025-06-29 00:00:00', '2025-06-29 00:00:00', 1, 0, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '2025-07-20 01:50:25', 1, 1, '2025-07-20 01:50:25', 1, 1),
(3, 2, 4, 1, 1, 4, '', '2025-07-15 00:00:00', '2025-07-30 00:00:00', 1, 15, 15.00, 0.00, 0.00, 0.00, 0, 0, 0, '2025-07-20 01:50:50', 1, 1, '2025-07-20 01:50:50', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bookitem`
--

CREATE TABLE `bookitem` (
  `bookitemID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `bookno` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0= Book Available, 1= Book Issued, 2=Book Lost',
  `deleted_at` tinyint(4) NOT NULL COMMENT '0= Book Available, 1= Book Not Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `bookitem`
--

INSERT INTO `bookitem` (`bookitemID`, `bookID`, `bookno`, `status`, `deleted_at`) VALUES
(1, 1, 1, 0, 0),
(2, 1, 2, 1, 0),
(3, 1, 3, 1, 0),
(4, 1, 4, 1, 0),
(5, 1, 5, 0, 0),
(6, 1, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_tags`
--

CREATE TABLE `book_tags` (
  `tagID` int(11) NOT NULL,
  `bookID` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL,
  `tag_type` enum('genre','mood','theme','audience','style') DEFAULT 'genre',
  `confidence` decimal(3,2) DEFAULT 1.00,
  `created_by` enum('manual','ai','system') DEFAULT 'manual',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chatID` int(11) NOT NULL,
  `message` text NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chatID`, `message`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'hello', '2025-07-20 01:26:40', 1, 1, '2025-07-20 01:26:40', 1, 1),
(2, 'How are you doing admin?', '2025-07-21 01:31:55', 1, 1, '2025-07-21 01:31:55', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `ebookID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `coverphoto` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `file_original_name` varchar(200) NOT NULL,
  `notes` text NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`ebookID`, `name`, `author`, `coverphoto`, `file`, `file_original_name`, `notes`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'Mathematics', 'Coastal Polytechnic', '9ed81e499da32b5e0d4a50f4d00528f3642755ebbbf188ea85bc8e9188fc0070d0a9811e1b2f5ab08ba3433d82173f5f2b87f2f57bececc1696a759a7b49a2af.png', 'de273e5c6ec2790db195d28b924343e31e95d5ec5f8dd7d62120b76f5a6056d50c0ad6ceb6b529b32dbff7d049d88365a1b0d857903370d35d643bf16275c29d.pdf', 'Goal+Setting+Questions.pdf', '', '2025-07-20 01:51:38', 1, 1, '2025-07-20 01:51:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emailsend`
--

CREATE TABLE `emailsend` (
  `emailsendID` int(11) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `sender_name` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sender_memberID` int(11) NOT NULL,
  `sender_roleID` int(11) NOT NULL,
  `emailtemplateID` int(11) NOT NULL DEFAULT 0,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `on_deleted` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=show, 1=delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emailsend`
--

INSERT INTO `emailsend` (`emailsendID`, `subject`, `message`, `sender_name`, `email`, `sender_memberID`, `sender_roleID`, `emailtemplateID`, `create_date`, `create_memberID`, `create_roleID`, `on_deleted`) VALUES
(1, 'Installation', '<p>hello</p>', 'Ettu Emeka', NULL, 0, 3, 0, '2025-07-20 01:53:55', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emailsetting`
--

CREATE TABLE `emailsetting` (
  `optionkey` varchar(100) NOT NULL,
  `optionvalue` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emailsetting`
--

INSERT INTO `emailsetting` (`optionkey`, `optionvalue`) VALUES
('mail_driver', ''),
('mail_encryption', ''),
('mail_host', ''),
('mail_password', ''),
('mail_port', ''),
('mail_username', '');

-- --------------------------------------------------------

--
-- Table structure for table `emailtemplate`
--

CREATE TABLE `emailtemplate` (
  `emailtemplateID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `template` text NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expenseID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `file` varchar(200) DEFAULT NULL,
  `fileoriginalname` varchar(200) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `finehistory`
--

CREATE TABLE `finehistory` (
  `finehistoryID` int(11) NOT NULL,
  `bookissueID` int(11) NOT NULL,
  `bookstatusID` int(11) NOT NULL COMMENT '0 = Issued,  1 = Return, 2 = Lost',
  `renewed` tinyint(4) NOT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `fineamount` decimal(10,2) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `finehistory`
--

INSERT INTO `finehistory` (`finehistoryID`, `bookissueID`, `bookstatusID`, `renewed`, `from_date`, `to_date`, `fineamount`, `notes`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 1, 0, 1, NULL, NULL, 0.00, NULL, '2025-07-20 01:48:45', 1, 1, '2025-07-20 01:48:45', 1, 1),
(2, 2, 0, 1, NULL, NULL, 0.00, NULL, '2025-07-20 01:50:25', 1, 1, '2025-07-20 01:50:25', 1, 1),
(3, 3, 0, 1, NULL, NULL, 0.00, NULL, '2025-07-20 01:50:50', 1, 1, '2025-07-20 01:50:50', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `generalsetting`
--

CREATE TABLE `generalsetting` (
  `optionkey` varchar(100) NOT NULL,
  `optionvalue` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `generalsetting`
--

INSERT INTO `generalsetting` (`optionkey`, `optionvalue`) VALUES
('address', ''),
('ai_chat_enabled', '1'),
('ai_enabled', '1'),
('ai_max_search_results', '10'),
('ai_model_version', 'gpt-3.5-turbo'),
('ai_recommendations_enabled', '1'),
('ai_recommendation_count', '5'),
('ai_response_timeout', '30'),
('ai_search_enabled', '1'),
('copyright_by', ''),
('delivery_charge', '0'),
('ebook_download', '0'),
('email', ''),
('frontend', '1'),
('logo', ''),
('openai_api_key', ''),
('paypal_payment_method', '1'),
('phone', ''),
('registration', ''),
('settheme', 'black'),
('sitename', 'LibraryPlus'),
('stripe_key', ''),
('stripe_payment_method', '1'),
('stripe_secret', ''),
('web_address', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `incomeID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `file` varchar(200) DEFAULT NULL,
  `fileoriginalname` varchar(200) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `libraryconfigure`
--

CREATE TABLE `libraryconfigure` (
  `libraryconfigureID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `max_issue_book` int(11) NOT NULL,
  `max_renewed_limit` int(11) NOT NULL,
  `per_renew_limit_day` int(11) NOT NULL,
  `book_fine_per_day` decimal(11,0) NOT NULL,
  `issue_off_limit_amount` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `libraryconfigure`
--

INSERT INTO `libraryconfigure` (`libraryconfigureID`, `roleID`, `max_issue_book`, `max_renewed_limit`, `per_renew_limit_day`, `book_fine_per_day`, `issue_off_limit_amount`) VALUES
(1, 1, 20, 20, 20, 20, 200),
(2, 2, 15, 15, 15, 15, 150),
(3, 3, 10, 10, 10, 10, 100),
(4, 4, 5, 5, 5, 5, 50);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `dateofbirth` datetime DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `address` text DEFAULT NULL,
  `joinningdate` datetime DEFAULT NULL,
  `photo` varchar(200) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(128) NOT NULL,
  `roleID` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=New, 1=active, 2=Block',
  `deleted_at` tinyint(4) DEFAULT 0 COMMENT '0 = Not Deleted, 1 = Deleted',
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `name`, `dateofbirth`, `gender`, `religion`, `email`, `phone`, `bloodgroup`, `address`, `joinningdate`, `photo`, `username`, `password`, `roleID`, `status`, `deleted_at`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'admin', '2025-07-14 00:00:00', 'Male', 'Unknown', 'admin@LibraryPlus.com', '', '', '', '2025-07-14 00:00:00', '', 'admin', 'e7573078c45686d09ad5b3ec524a028d46f13d7c250a49e9615c6818f45ff64681b81fcfa9c3c25ed8100cba7e45baf401f3c4309337eb1d1d83ee29f508d56f', 1, 1, 0, '2025-07-14 04:11:44', 1, 1, '2025-07-14 04:11:44', 1, 0),
(2, 'Nehemiah', '2020-01-01 00:00:00', 'Male', 'Christian', 'okekenehemiah300@gmail.com', '08119281144', 'B+', 'NoAvenue 22Oba Akran Avenue Ikeja, LA NG\r\nOba Akran', '2025-07-18 00:00:00', '7a5f55d5133579a7306456ca2670f3413facb086125fc018990772827e0ac3597bc6aa95f233be492115bd407bb113cfd25ab29299a79cf74cd8c011e01be583.png', 'nehemiah', '820aae110b31702859c53fd190ac68e144a9f2a85f606de55e6fb818a9088069f9be4f8ce194cccf7d4549f64478a9d18cd4635da356a31ed843c5446e863bed', 5, 1, 0, '2025-07-20 01:31:21', 1, 1, '2025-07-20 01:31:21', 1, 1),
(3, 'Ettu Emeka', '2023-07-31 00:00:00', 'Male', 'Christian', 'ettuemeka@gmail.com', '07016888782', 'A+', 'Lagos, Ikeja', '2024-09-09 00:00:00', 'default.png', 'ettu', '820aae110b31702859c53fd190ac68e144a9f2a85f606de55e6fb818a9088069f9be4f8ce194cccf7d4549f64478a9d18cd4635da356a31ed843c5446e863bed', 3, 1, 0, '2025-07-20 01:32:31', 1, 1, '2025-07-20 01:32:31', 1, 1),
(4, 'Emmanuel', '2023-07-31 00:00:00', 'Male', 'Christian', 'emmanueljur53@gmail.com', '08038943720', 'A+', 'Plot 1151, A Close, 331 Road Phase II 3rd avenu Und St. Gwarimpa 3', '2025-07-18 00:00:00', 'default.png', 'emmanuel', '820aae110b31702859c53fd190ac68e144a9f2a85f606de55e6fb818a9088069f9be4f8ce194cccf7d4549f64478a9d18cd4635da356a31ed843c5446e863bed', 2, 1, 0, '2025-07-20 01:35:53', 1, 1, '2025-07-20 01:35:53', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menuID` int(11) NOT NULL,
  `menuname` varchar(128) NOT NULL,
  `menulink` varchar(128) NOT NULL,
  `menuicon` varchar(128) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 500,
  `parentmenuID` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuID`, `menuname`, `menulink`, `menuicon`, `priority`, `parentmenuID`, `status`) VALUES
(1, 'dashboard', 'dashboard', 'fa fa-dashboard', 500, 0, 1),
(2, 'bookissue', 'bookissue', 'fa lms-educational-book', 500, 0, 1),
(3, 'member', 'member', 'fa fa-user-plus', 500, 0, 1),
(4, 'ebook', 'ebook', 'fa lms-study', 500, 0, 1),
(5, 'books', '#', 'fa lms-book', 500, 0, 1),
(6, 'book', 'book', 'fa fa-book', 500, 5, 1),
(7, 'rack', 'rack', 'fa lms-bookshelf', 500, 5, 1),
(8, 'bookcategory', 'bookcategory', 'fa lms-notebook', 500, 5, 1),
(9, 'bookbarcode', 'bookbarcode', 'fa fa-barcode', 500, 5, 1),
(10, 'requestbook', 'requestbook', 'fa lms-professor', 500, 0, 1),
(11, 'storemanagement', '#', 'fa fa-shopping-cart', 500, 0, 1),
(12, 'order', 'order', 'fa fa-first-order', 500, 11, 1),
(13, 'storebook', 'storebook', 'fa fa-book', 0, 11, 1),
(14, 'storebookcategory', 'storebookcategory', 'fa lms-notebook', 0, 11, 1),
(15, 'emailsend', 'emailsend', 'fa fa-envelope', 500, 0, 1),
(16, 'account', '#', 'fa lms-merchant', 500, 0, 1),
(17, 'income', 'income', 'fa lms-incomes', 500, 16, 1),
(18, 'expense', 'expense', 'fa lms-salary', 500, 16, 1),
(19, 'reports', '#', 'fa fa-clipboard', 500, 0, 1),
(20, 'bookreport', 'bookreport', 'fa lms-library', 500, 19, 1),
(21, 'bookissuereport', 'bookissuereport', 'fa lms-writing', 500, 19, 1),
(22, 'memberreport', 'memberreport', 'fa lms-community', 500, 19, 1),
(23, 'idcardreport', 'idcardreport', 'fa lms-id-card', 500, 19, 1),
(24, 'transactionreport', 'transactionreport', 'fa fa-credit-card', 500, 19, 1),
(25, 'bookbarcodereport', 'bookbarcodereport', 'fa fa-barcode', 0, 19, 1),
(26, 'administrator', '#', 'fa fa-lock', 500, 0, 1),
(27, 'menu', 'menu', 'fa fa-bars', 500, 26, 1),
(28, 'role', 'role', 'fa fa-users', 500, 26, 1),
(29, 'emailtemplate', 'emailtemplate', 'fa lms-template-design', 500, 26, 1),
(30, 'permissions', 'permissions', 'fa fa-balance-scale', 500, 26, 1),
(31, 'permissionlog', 'permissionlog', 'fa fa-key', 500, 26, 1),
(32, 'update', 'update', 'fa fa-upload', 0, 26, 1),
(33, 'backup', 'backup', 'fa fa-download', 0, 26, 1),
(34, 'settings', '#', 'fa fa-cogs', 500, 0, 1),
(35, 'generalsetting', 'generalsetting', 'fa fa-cog', 500, 34, 1),
(36, 'emailsetting', 'emailsetting', 'fa lms-open-envelope', 500, 34, 1),
(37, 'libraryconfigure', 'libraryconfigure', 'fa lms-settings', 500, 34, 1),
(38, 'themesetting', 'themesetting', 'fa fa-paint-brush', 0, 34, 1),
(39, 'paymentsetting', 'paymentsetting', 'fa fa-credit-card-alt', 0, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `newsletterID` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `verify` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderitemID` bigint(20) UNSIGNED NOT NULL,
  `orderID` bigint(20) UNSIGNED NOT NULL,
  `storebookID` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` double(13,2) UNSIGNED NOT NULL,
  `subtotal` double(13,2) UNSIGNED NOT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `modify_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` bigint(20) UNSIGNED NOT NULL,
  `memberID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` double(13,2) UNSIGNED NOT NULL,
  `subtotal` double(13,2) UNSIGNED NOT NULL,
  `total` double(13,2) UNSIGNED NOT NULL,
  `payment_status` tinyint(3) UNSIGNED NOT NULL COMMENT 'PAID=5, UNPAID=10',
  `payment_method` tinyint(3) UNSIGNED NOT NULL COMMENT 'CASH_ON_DELIVERY=5',
  `paid_amount` double(13,2) UNSIGNED NOT NULL,
  `discounted_price` double(13,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `misc` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT 'PENDING = 5, CANCEL = 10, REJECT = 15, ACCEPT = 20, PROCESS = 25, ON_THE_WAY = 30, COMPLETED = 35',
  `notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` timestamp NULL DEFAULT NULL,
  `modify_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentanddiscount`
--

CREATE TABLE `paymentanddiscount` (
  `paymentanddiscountID` int(11) NOT NULL,
  `bookissueID` int(11) NOT NULL,
  `paymentamount` decimal(10,2) NOT NULL,
  `discountamount` decimal(10,2) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissionlog`
--

CREATE TABLE `permissionlog` (
  `permissionlogID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` enum('yes','no') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `permissionlog`
--

INSERT INTO `permissionlog` (`permissionlogID`, `name`, `description`, `active`) VALUES
(1, 'dashboard', 'Dashboard', 'yes'),
(2, 'bookissue', 'Book Issue', 'yes'),
(3, 'bookissue_add', 'Book Issue Add', 'yes'),
(4, 'bookissue_edit', 'Book Issue Edit', 'yes'),
(5, 'bookissue_view', 'Book Issue View', 'yes'),
(6, 'bookissue_delete', 'Book Issue Delete', 'yes'),
(7, 'member', 'Member', 'yes'),
(8, 'member_add', 'Member Add', 'yes'),
(9, 'member_edit', 'Member Edit', 'yes'),
(10, 'member_view', 'Member View', 'yes'),
(11, 'member_delete', 'Member Delete', 'yes'),
(12, 'ebook', 'Ebook', 'yes'),
(13, 'ebook_add', 'Ebook Add', 'yes'),
(14, 'ebook_edit', 'Ebook Edit', 'yes'),
(15, 'ebook_view', 'Ebook View', 'yes'),
(16, 'ebook_delete', 'Ebook Delete', 'yes'),
(17, 'book', 'Book', 'yes'),
(18, 'book_add', 'Book Add', 'yes'),
(19, 'book_edit', 'Book Edit', 'yes'),
(20, 'book_delete', 'Book Delete', 'yes'),
(21, 'book_view', 'Book View', 'yes'),
(22, 'rack', 'Rack', 'yes'),
(23, 'rack_add', 'Rack Add', 'yes'),
(24, 'rack_edit', 'Rack Edit', 'yes'),
(25, 'rack_delete', 'Rack Delete', 'yes'),
(26, 'bookcategory', 'Bool Category', 'yes'),
(27, 'bookcategory_add', 'Book Category Add', 'yes'),
(28, 'bookcategory_edit', 'Book Category Edit', 'yes'),
(29, 'bookcategory_delete', 'Book Category Delete', 'yes'),
(30, 'requestbook', 'Request Book', 'yes'),
(31, 'requestbook_add', 'Request Book Add', 'yes'),
(32, 'requestbook_edit', 'Request Book Edit', 'yes'),
(33, 'requestbook_view', 'Request Book View', 'yes'),
(34, 'requestbook_delete', 'Request Book Delete', 'yes'),
(35, 'emailsend', 'emailsend', 'yes'),
(36, 'emailsend_add', 'Emailsend Add', 'yes'),
(37, 'emailsend_view', 'Emailsend View', 'yes'),
(38, 'emailsend_delete', 'Emailsend Delete', 'yes'),
(39, 'income', 'Income', 'yes'),
(40, 'income_add', 'Income Add', 'yes'),
(41, 'income_edit', 'Income Edit', 'yes'),
(42, 'income_delete', 'Income Delete', 'yes'),
(43, 'expense', 'Expense', 'yes'),
(44, 'expense_add', 'Expense Add', 'yes'),
(45, 'expense_edit', 'Expense Edit', 'yes'),
(46, 'expense_delete', 'Expense Delete', 'yes'),
(47, 'bookreport', 'Book Report', 'yes'),
(48, 'bookissuereport', 'Book Issue Report', 'yes'),
(49, 'memberreport', 'Member Report', 'yes'),
(50, 'idcardreport', 'ID Card Report', 'yes'),
(51, 'transactionreport', 'Transaction Report', 'yes'),
(52, 'menu', 'Menu', 'yes'),
(53, 'menu_add', 'Menu Add', 'yes'),
(54, 'menu_edit', 'Menu Edit', 'yes'),
(55, 'menu_delete', 'Menu Delete', 'yes'),
(56, 'role', 'Role', 'yes'),
(57, 'role_add', 'Role Add', 'yes'),
(58, 'role_edit', 'Role Edit', 'yes'),
(59, 'role_delete', 'Role Delete', 'yes'),
(60, 'emailsetting', 'Email Setting', 'yes'),
(61, 'emailtemplate', 'Email template', 'yes'),
(62, 'emailtemplate_add', 'Email Template Add', 'yes'),
(63, 'emailtemplate_edit', 'Email Template Edit', 'yes'),
(64, 'emailtemplate_delete', 'Email Template Delete', 'yes'),
(65, 'emailtemplate_view', 'Email Template', 'yes'),
(66, 'permissions', 'Permissions', 'yes'),
(67, 'permissionlog', 'Permissionlog', 'yes'),
(68, 'permissionlog_add', 'Permissionlog', 'yes'),
(69, 'permissionlog_edit', 'Permissionlog', 'yes'),
(70, 'permissionlog_delete', 'Permissionlog', 'yes'),
(71, 'generalsetting', 'General Setting', 'yes'),
(73, 'libraryconfigure', 'Library Configure', 'yes'),
(74, 'libraryconfigure_add', 'Library Configure Add', 'yes'),
(75, 'libraryconfigure_edit', 'Library Configure Edit', 'yes'),
(76, 'libraryconfigure_delete', 'Library Configure Delete', 'yes'),
(77, 'themesetting', 'Theme Setting', 'yes'),
(78, 'backup', 'Backup', 'yes'),
(79, 'update', 'Update', 'yes'),
(80, 'bookbarcodereport', 'Book Barcode Report', 'yes'),
(81, 'bookbarcode', 'Book Barcode', 'yes'),
(82, 'smssetting', 'SMS Setting', 'yes'),
(83, 'storebookcategory', 'Store Book Category', 'yes'),
(84, 'storebookcategory_add', 'Store Book Category Add', 'yes'),
(85, 'storebookcategory_edit', 'Store Book Category Edit', 'yes'),
(86, 'storebookcategory_view', 'Store Book Category View', 'yes'),
(87, 'storebookcategory_delete', 'Store Book Category Delete', 'yes'),
(88, 'storebook', 'Store Book', 'yes'),
(89, 'storebook_add', 'Store Book Add', 'yes'),
(90, 'storebook_edit', 'Store Book Edit', 'yes'),
(91, 'storebook_view', 'Store Book View', 'yes'),
(92, 'storebook_delete', 'Store Book Delete', 'yes'),
(93, 'order', 'Order', 'yes'),
(94, 'order_view', 'Order View', 'yes'),
(95, 'order_edit', 'Order Edit', 'yes'),
(96, 'paymentsetting', 'Payment Setting', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissionlogID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permissionlogID`, `roleID`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(6, 1),
(5, 1),
(7, 1),
(8, 1),
(9, 1),
(11, 1),
(10, 1),
(12, 1),
(13, 1),
(14, 1),
(16, 1),
(15, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(34, 1),
(33, 1),
(35, 1),
(36, 1),
(38, 1),
(37, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(87, 1),
(86, 1),
(88, 1),
(89, 1),
(90, 1),
(92, 1),
(91, 1),
(93, 1),
(95, 1),
(94, 1),
(96, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(6, 2),
(5, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(12, 2),
(13, 2),
(14, 2),
(16, 2),
(15, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(34, 2),
(33, 2),
(35, 2),
(36, 2),
(38, 2),
(37, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(80, 2),
(81, 2),
(83, 2),
(84, 2),
(85, 2),
(87, 2),
(86, 2),
(88, 2),
(89, 2),
(90, 2),
(92, 2),
(91, 2),
(93, 2),
(95, 2),
(94, 2),
(1, 3),
(2, 3),
(5, 3),
(7, 3),
(10, 3),
(12, 3),
(15, 3),
(17, 3),
(21, 3),
(22, 3),
(26, 3),
(30, 3),
(31, 3),
(32, 3),
(34, 3),
(33, 3),
(35, 3),
(36, 3),
(37, 3),
(81, 3),
(83, 3),
(86, 3),
(88, 3),
(91, 3),
(93, 3),
(94, 3),
(1, 5),
(2, 5),
(5, 5),
(7, 5),
(10, 5),
(12, 5),
(15, 5),
(17, 5),
(21, 5),
(22, 5),
(50, 5),
(52, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `rackID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`rackID`, `name`, `description`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'Mathematics', 'Math Rack', '2025-07-20 01:45:34', 1, 1, '2025-07-20 01:45:34', 1, 1),
(2, 'English', 'English Rack', '2025-07-20 01:45:50', 1, 1, '2025-07-20 01:45:50', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `requestbook`
--

CREATE TABLE `requestbook` (
  `requestbookID` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `coverphoto` varchar(200) NOT NULL,
  `bookcategoryID` int(11) NOT NULL,
  `isbnno` varchar(100) DEFAULT NULL,
  `editionnumber` varchar(50) DEFAULT NULL,
  `editiondate` date DEFAULT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `publisheddate` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0= Request Book, 1= Request Book Accepet, 2= Request Book Rejected',
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0= Request Book Not Deleted, 1=Request Book Deleted ',
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resetpassword`
--

CREATE TABLE `resetpassword` (
  `resetpasswordID` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `code` varchar(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) UNSIGNED NOT NULL,
  `role` varchar(30) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `create_roleID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL,
  `modify_roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `role`, `create_date`, `create_memberID`, `create_roleID`, `modify_date`, `modify_memberID`, `modify_roleID`) VALUES
(1, 'Admin', '2019-09-25 20:19:22', 1, 1, '2019-09-25 20:19:22', 1, 1),
(2, 'Librarian', '2019-09-25 20:19:32', 1, 1, '2020-01-29 23:32:27', 1, 1),
(3, 'Member', '2019-09-25 20:19:39', 1, 1, '2019-11-03 00:03:22', 1, 1),
(4, 'Customer', '2019-12-10 20:38:31', 1, 1, '2019-12-10 20:38:31', 1, 1),
(5, 'Student', '2025-07-20 01:29:20', 1, 1, '2025-07-20 01:29:20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `storebook`
--

CREATE TABLE `storebook` (
  `storebookID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `storebookcategoryID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `isbnno` varchar(100) NOT NULL,
  `coverphoto` varchar(200) NOT NULL,
  `codeno` varchar(100) NOT NULL,
  `editionnumber` varchar(100) NOT NULL,
  `editiondate` datetime DEFAULT NULL,
  `publisher` varchar(100) NOT NULL,
  `publisheddate` datetime DEFAULT NULL,
  `notes` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0= Book Available, 1= Book Not Available',
  `deleted_at` tinyint(4) NOT NULL COMMENT '0= Book Available, 1=Book Deleted ',
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storebookcategory`
--

CREATE TABLE `storebookcategory` (
  `storebookcategoryID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `coverphoto` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_memberID` int(11) NOT NULL,
  `modify_date` datetime NOT NULL,
  `modify_memberID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storebookimage`
--

CREATE TABLE `storebookimage` (
  `storebookimageID` int(11) NOT NULL,
  `storebookID` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `meta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `updateID` int(11) NOT NULL,
  `version` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `memberID` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ai_chat_history`
--
ALTER TABLE `ai_chat_history`
  ADD PRIMARY KEY (`chatID`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_session_id` (`session_id`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `ai_recommendations`
--
ALTER TABLE `ai_recommendations`
  ADD PRIMARY KEY (`recommendationID`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_book_id` (`book_id`),
  ADD KEY `idx_recommendation_type` (`recommendation_type`);

--
-- Indexes for table `ai_search_logs`
--
ALTER TABLE `ai_search_logs`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `ai_training_data`
--
ALTER TABLE `ai_training_data`
  ADD PRIMARY KEY (`trainingID`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_by` (`created_by`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `bookcategory`
--
ALTER TABLE `bookcategory`
  ADD PRIMARY KEY (`bookcategoryID`);

--
-- Indexes for table `bookissue`
--
ALTER TABLE `bookissue`
  ADD PRIMARY KEY (`bookissueID`);

--
-- Indexes for table `bookitem`
--
ALTER TABLE `bookitem`
  ADD PRIMARY KEY (`bookitemID`);

--
-- Indexes for table `book_tags`
--
ALTER TABLE `book_tags`
  ADD PRIMARY KEY (`tagID`),
  ADD KEY `idx_book_id` (`bookID`),
  ADD KEY `idx_tag_name` (`tag_name`),
  ADD KEY `idx_tag_type` (`tag_type`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chatID`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`ebookID`);

--
-- Indexes for table `emailsend`
--
ALTER TABLE `emailsend`
  ADD PRIMARY KEY (`emailsendID`);

--
-- Indexes for table `emailsetting`
--
ALTER TABLE `emailsetting`
  ADD UNIQUE KEY `frontendkey` (`optionkey`);

--
-- Indexes for table `emailtemplate`
--
ALTER TABLE `emailtemplate`
  ADD PRIMARY KEY (`emailtemplateID`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expenseID`);

--
-- Indexes for table `finehistory`
--
ALTER TABLE `finehistory`
  ADD PRIMARY KEY (`finehistoryID`);

--
-- Indexes for table `generalsetting`
--
ALTER TABLE `generalsetting`
  ADD UNIQUE KEY `frontendkey` (`optionkey`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`incomeID`);

--
-- Indexes for table `libraryconfigure`
--
ALTER TABLE `libraryconfigure`
  ADD PRIMARY KEY (`libraryconfigureID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`newsletterID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderitemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `paymentanddiscount`
--
ALTER TABLE `paymentanddiscount`
  ADD PRIMARY KEY (`paymentanddiscountID`);

--
-- Indexes for table `permissionlog`
--
ALTER TABLE `permissionlog`
  ADD PRIMARY KEY (`permissionlogID`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`rackID`);

--
-- Indexes for table `requestbook`
--
ALTER TABLE `requestbook`
  ADD PRIMARY KEY (`requestbookID`);

--
-- Indexes for table `resetpassword`
--
ALTER TABLE `resetpassword`
  ADD PRIMARY KEY (`resetpasswordID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `storebook`
--
ALTER TABLE `storebook`
  ADD PRIMARY KEY (`storebookID`);

--
-- Indexes for table `storebookcategory`
--
ALTER TABLE `storebookcategory`
  ADD PRIMARY KEY (`storebookcategoryID`);

--
-- Indexes for table `storebookimage`
--
ALTER TABLE `storebookimage`
  ADD PRIMARY KEY (`storebookimageID`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`updateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ai_chat_history`
--
ALTER TABLE `ai_chat_history`
  MODIFY `chatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_recommendations`
--
ALTER TABLE `ai_recommendations`
  MODIFY `recommendationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_search_logs`
--
ALTER TABLE `ai_search_logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ai_training_data`
--
ALTER TABLE `ai_training_data`
  MODIFY `trainingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookcategory`
--
ALTER TABLE `bookcategory`
  MODIFY `bookcategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookissue`
--
ALTER TABLE `bookissue`
  MODIFY `bookissueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookitem`
--
ALTER TABLE `bookitem`
  MODIFY `bookitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `book_tags`
--
ALTER TABLE `book_tags`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `ebookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emailsend`
--
ALTER TABLE `emailsend`
  MODIFY `emailsendID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emailtemplate`
--
ALTER TABLE `emailtemplate`
  MODIFY `emailtemplateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expenseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finehistory`
--
ALTER TABLE `finehistory`
  MODIFY `finehistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `incomeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `libraryconfigure`
--
ALTER TABLE `libraryconfigure`
  MODIFY `libraryconfigureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `newsletterID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderitemID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentanddiscount`
--
ALTER TABLE `paymentanddiscount`
  MODIFY `paymentanddiscountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissionlog`
--
ALTER TABLE `permissionlog`
  MODIFY `permissionlogID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
  MODIFY `rackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requestbook`
--
ALTER TABLE `requestbook`
  MODIFY `requestbookID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resetpassword`
--
ALTER TABLE `resetpassword`
  MODIFY `resetpasswordID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `storebook`
--
ALTER TABLE `storebook`
  MODIFY `storebookID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storebookcategory`
--
ALTER TABLE `storebookcategory`
  MODIFY `storebookcategoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `storebookimage`
--
ALTER TABLE `storebookimage`
  MODIFY `storebookimageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `updateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_tags`
--
ALTER TABLE `book_tags`
  ADD CONSTRAINT `book_tags_ibfk_1` FOREIGN KEY (`bookID`) REFERENCES `book` (`bookID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

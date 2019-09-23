-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 12:06 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `getsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `acc_req_db`
--

CREATE TABLE `acc_req_db` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_req_db`
--

INSERT INTO `acc_req_db` (`ID`, `Name`, `Email`, `Contact`, `Password`, `Status`, `account_type`) VALUES
(36, 'Robert Sampang', 'trebor0912@yahoo.com', '09000000000', '7XyePzEq', 'Approved', '2'),
(37, 'Iana Vergara', 'imvergara16@gmail.com', '09000000000', 'k0uB8YsO', 'Approved', '2'),
(38, 'Ann Rivera', 'gacusanafam@gmail.com', '09000000000', '6bJztldp', 'Pending', '2'),
(39, 'Isabel Roque', 'isabelroque046@gmail.com', '09000000000', 'bCsTqQuO', 'Pending', '2'),
(40, 'Josh canlas', 'sample6@gmail.com', '09000000000', 'XTqtRrBg', 'Pending', '2'),
(41, 'Camille ', 'itsyuwi@gmail.com', '09000000000', '8xbwvOX5', 'Pending', '2'),
(42, 'Catherine Rivera', 'Catherinerivera0201@gmail.com', '09000000000', 'jEsIv0Xi', 'Approved', '2');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `AID` int(11) NOT NULL,
  `LID` int(11) NOT NULL,
  `Activity` varchar(255) NOT NULL,
  `Time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`AID`, `LID`, `Activity`, `Time`) VALUES
(10, 86, 'Logged In', '06:25 PM'),
(11, 86, 'Logged Out', '06:25 PM'),
(12, 86, 'Logged In', '06:28 PM'),
(13, 86, 'Inserted Response to sample 2', '06:28 PM'),
(14, 86, 'Logged Out', '06:28 PM'),
(15, 87, 'Logged In', '06:35 PM'),
(16, 87, 'Logged Out', '06:35 PM'),
(17, 86, 'Logged In', '06:38 PM'),
(18, 86, 'Created Survey asd', '06:38 PM'),
(19, 86, 'Logged Out', '06:43 PM'),
(20, 86, 'Logged In', '06:43 PM'),
(21, 86, 'Logged Out', '06:43 PM'),
(22, 87, 'Logged In', '06:44 PM'),
(23, 87, 'Logged Out', '06:44 PM'),
(24, 88, 'Logged In', '06:47 PM'),
(25, 88, 'Logged Out', '06:47 PM'),
(26, 89, 'Logged In', '06:52 PM'),
(27, 89, 'Logged Out', '06:52 PM'),
(28, 90, 'Logged In', '06:52 PM'),
(29, 90, 'Logged Out', '06:52 PM'),
(30, 91, 'Logged In', '06:52 PM'),
(31, 91, 'Logged Out', '06:52 PM'),
(35, 89, 'Logged In', '06:55 PM'),
(36, 89, 'Logged Out', '06:55 PM'),
(37, 92, 'Logged In', '10:21 AM'),
(38, 92, 'Logged Out', '10:22 AM'),
(39, 93, 'Logged In', '07:15 PM'),
(40, 93, 'Logged Out', '07:20 PM'),
(41, 94, 'Logged In', '12:18 AM'),
(42, 94, 'Logged Out', '12:32 AM'),
(43, 95, 'Logged In', '11:55 PM'),
(44, 96, 'Created Survey yyyy', '12:05 AM'),
(45, 96, 'Logged Out', '12:32 AM'),
(46, 96, 'Logged In', '01:44 AM'),
(47, 96, 'Logged Out', '01:45 AM'),
(48, 97, 'Logged In', '12:50 AM'),
(49, 97, 'Logged Out', '12:50 AM');

-- --------------------------------------------------------

--
-- Table structure for table `answertbl`
--

CREATE TABLE `answertbl` (
  `Answer_ID` int(11) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `Answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answertbl`
--

INSERT INTO `answertbl` (`Answer_ID`, `Question_ID`, `Answer`) VALUES
(104, 82, 'Male'),
(105, 82, 'Female'),
(106, 83, '2016'),
(107, 83, '2017'),
(108, 83, '2018'),
(109, 85, '2016'),
(110, 85, '2017'),
(111, 85, '2018'),
(112, 90, 'Single'),
(113, 90, 'Married'),
(114, 90, 'Separated/Divorced'),
(115, 90, 'Married but not living w/ spouse'),
(116, 90, 'Single Parent (born a child but not married)'),
(117, 91, 'Male'),
(118, 91, 'Female'),
(119, 95, 'Yes'),
(120, 95, 'No'),
(121, 95, 'Never Employed'),
(122, 96, 'Advanced or further study'),
(123, 96, 'Family Concern and decided not to find a job'),
(124, 96, 'Health related reason(s)'),
(125, 96, 'Lack of work experience'),
(126, 96, 'No job opportunity'),
(127, 96, 'Did not look for a job'),
(128, 97, 'Regular or Permanent'),
(129, 97, 'Temporary'),
(130, 97, 'Casual'),
(131, 97, 'Contractual'),
(132, 97, 'Self-employed'),
(133, 98, 'Officials of Government, Corporate Executives, Managers, Managing Proprietors and Supervisors '),
(134, 98, 'Professionals'),
(135, 98, 'Technicians and Associate Professionals'),
(136, 98, 'Clerks'),
(137, 98, 'Service workers , Shop and Market Sales Workers'),
(138, 98, 'Trades and Related Workers'),
(139, 99, 'Local'),
(140, 99, 'Abroad'),
(141, 101, 'Rank or Clerical'),
(142, 101, 'Professional, Technical or Supervisory'),
(143, 101, 'Managerial or Executive'),
(144, 101, 'Self-employed'),
(145, 102, 'Yes'),
(146, 102, 'No'),
(147, 104, 'Yes'),
(148, 104, 'No'),
(149, 105, 'less than a month'),
(150, 105, '1 to 6 months'),
(151, 105, '7 to 11 months'),
(152, 105, '1 year to less than 2 years'),
(153, 105, '2 years to less than 3 years'),
(154, 105, '3 years and above'),
(155, 106, 'below P5,000'),
(156, 106, 'P5,000 to less than P10,000'),
(157, 106, 'P10,000 to less than P15,000'),
(158, 106, 'P15,000 to less than P20,000'),
(159, 106, 'P20,000 to less than P25,000'),
(160, 106, 'P25,000 and above'),
(161, 107, 'Very Relevant'),
(162, 107, 'Relevant'),
(163, 107, 'Not Relevant'),
(166, 114, 'Male'),
(167, 114, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `enumeratortbl`
--

CREATE TABLE `enumeratortbl` (
  `EID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Contact` varchar(11) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enumeratortbl`
--

INSERT INTO `enumeratortbl` (`EID`, `Name`, `Contact`, `Email`) VALUES
(4, 'Catherine Rivera', '00000000000', 'Catherinerivera0201@gmail.com'),
(5, 'Iana Vergara', '09999999999', 'Iana@gmail.com'),
(6, 'rica bognot', '00000000000', 'bognot@gmail.com'),
(7, 'Robert Sampang', '0000000000', 'RobertSampang@gmail.com'),
(8, 'Isabelle Roque', '09000000000', 'isabelroque046@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `logstbl`
--

CREATE TABLE `logstbl` (
  `LID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `Date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logstbl`
--

INSERT INTO `logstbl` (`LID`, `UID`, `Date`) VALUES
(86, 39, 'August 27, 2019'),
(87, 56, 'August 27, 2019'),
(88, 56, 'August 28, 2019'),
(89, 39, 'August 29, 2019'),
(90, 56, 'August 29, 2019'),
(91, 53, 'August 29, 2019'),
(92, 39, 'August 30, 2019'),
(93, 39, 'August 31, 2019'),
(94, 39, 'September 01, 2019'),
(95, 39, 'September 02, 2019'),
(96, 39, 'September 03, 2019'),
(97, 56, 'September 04, 2019');

-- --------------------------------------------------------

--
-- Table structure for table `mysurveytbl`
--

CREATE TABLE `mysurveytbl` (
  `Survey_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `Title` varchar(250) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Date_created` varchar(50) NOT NULL,
  `End_date` varchar(50) NOT NULL,
  `Status` varchar(11) NOT NULL,
  `Respondents` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mysurveytbl`
--

INSERT INTO `mysurveytbl` (`Survey_ID`, `user_ID`, `Title`, `Description`, `Date_created`, `End_date`, `Status`, `Respondents`) VALUES
(19, 39, 'Gaduates Employability Tracer Survey', 'DHVSU Graduates Employabilty Tracer Study', '08-08-19', '2019-08-30', 'Incomplete', '150'),
(23, 56, 'elmer sample survey', 'Sample Description ', '19-08-12', '2019-08-28', 'Incomplete', '200'),
(24, 39, 'sample title', 'sample description', '19-08-26', '2019-08-31', 'Incomplete', '100'),
(27, 56, 'Employability Tracer Survey batch 2016 2017 2018', 'Employability Tracer Survey batch 2016 2017 2018', 'August 28, 2019', '2019-08-31', 'Incomplete', '100');

-- --------------------------------------------------------

--
-- Table structure for table `otherstbl`
--

CREATE TABLE `otherstbl` (
  `OtherID` int(11) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `RespondentID` int(11) NOT NULL,
  `Response` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otherstbl`
--

INSERT INTO `otherstbl` (`OtherID`, `Question_ID`, `RespondentID`, `Response`) VALUES
(23, 98, 121, 'Web Developer'),
(26, 98, 129, 'Call Center'),
(30, 98, 143, 'Human Resource'),
(31, 98, 159, 'Customer Service Representative');

-- --------------------------------------------------------

--
-- Table structure for table `questiontbl`
--

CREATE TABLE `questiontbl` (
  `QuestionID` int(11) NOT NULL,
  `Survey_ID` int(11) NOT NULL,
  `QuestionType` varchar(255) NOT NULL,
  `Question` varchar(255) NOT NULL,
  `Required` varchar(11) NOT NULL,
  `Others` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questiontbl`
--

INSERT INTO `questiontbl` (`QuestionID`, `Survey_ID`, `QuestionType`, `Question`, `Required`, `Others`) VALUES
(79, 23, 'ShortAnswer', 'Full Name', '', ''),
(80, 23, 'Date', 'Birthday', '', ''),
(81, 23, 'LongAnswer', 'Address', '', ''),
(82, 23, 'Multiplechoice', 'Gender', '', ''),
(83, 23, 'Multiplechoice', 'Year Graduated', '', ''),
(84, 23, 'ShortAnswer', 'Email Address', '', ''),
(85, 19, 'Multiplechoice', 'Year Graduated', 'yes', 'no'),
(86, 19, 'ShortAnswer', 'Full Name', 'yes', ''),
(87, 19, 'LongAnswer', 'Permanent Address', '', ''),
(88, 19, 'ShortAnswer', 'Email Address', '', ''),
(89, 19, 'ShortAnswer', 'Contact No.', '', ''),
(90, 19, 'Multiplechoice', 'Civil Status', '', ''),
(91, 19, 'Multiplechoice', 'Sex', '', 'no'),
(92, 19, 'Date', 'Birthday', '', ''),
(93, 19, 'LongAnswer', 'Professional Examination Passed', '', ''),
(94, 19, 'LongAnswer', 'Training(s) and Advance Studies Attended After College', '', ''),
(95, 19, 'Multiplechoice', 'Are you presently employed?', 'yes', 'no'),
(96, 19, 'Checkbox', 'If No, Never Been Employed. state reason(s) why you are not yet employed', '', ''),
(97, 19, 'Multiplechoice', 'Present Employment Status', '', ''),
(98, 19, 'Checkbox', 'Present Occupation', '', ''),
(99, 19, 'Multiplechoice', 'Place of work', '', 'no'),
(100, 19, 'ShortAnswer', 'Name of Company', '', ''),
(101, 19, 'Multiplechoice', 'Job Level Position', '', ''),
(102, 19, 'Multiplechoice', 'Is This Your First Job After College?', '', ''),
(103, 19, 'ShortAnswer', 'If No, How many jobs did you have before your present job?', '', ''),
(104, 19, 'Multiplechoice', 'Is Your First Job Related To The Course You Took Up In College?', '', ''),
(105, 19, 'Multiplechoice', 'How long did it take you to land your first job?', '', ''),
(106, 19, 'Multiplechoice', 'What is your initial gross monthly earning in your first job after college?', '', ''),
(107, 19, 'Multiplechoice', 'How relevant was the curriculum you had in college to your present job?', '', ''),
(108, 19, 'LongAnswer', 'Please list down suggestions to further improve your course curriculum', '', ''),
(109, 24, 'ShortAnswer', 'Year Graduated', 'yes', 'no'),
(111, 24, 'ShortAnswer', 'Full Name', 'yes', 'no'),
(114, 24, 'Multiplechoice', 'Gender', 'yes', 'no'),
(116, 27, 'ShortAnswer', 'Year Graduated', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `respondenttbl`
--

CREATE TABLE `respondenttbl` (
  `RID` int(11) NOT NULL,
  `Survey_ID` int(11) NOT NULL,
  `EnumeratorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `respondenttbl`
--

INSERT INTO `respondenttbl` (`RID`, `Survey_ID`, `EnumeratorID`) VALUES
(120, 19, 4),
(121, 19, 5),
(127, 19, 5),
(128, 19, 6),
(129, 19, 4),
(143, 19, 5),
(144, 19, 5),
(145, 19, 7),
(146, 19, 6),
(147, 19, 7),
(159, 19, 4),
(160, 19, 6),
(161, 19, 7),
(162, 24, 5),
(163, 24, 4),
(164, 24, 4),
(171, 23, 5);

-- --------------------------------------------------------

--
-- Table structure for table `responsetbl`
--

CREATE TABLE `responsetbl` (
  `ResponseID` int(11) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `RespondentID` int(11) NOT NULL,
  `Response` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responsetbl`
--

INSERT INTO `responsetbl` (`ResponseID`, `Question_ID`, `RespondentID`, `Response`) VALUES
(873, 85, 120, '2018'),
(874, 86, 120, 'Luis Punsalan'),
(875, 87, 120, 'San fernando, Pampanga'),
(876, 88, 120, 'Not Answered'),
(877, 89, 120, '09051640108'),
(878, 90, 120, 'Single'),
(879, 91, 120, 'Male'),
(880, 92, 120, '1997-09-01'),
(881, 93, 120, 'CSE Pro'),
(882, 94, 120, 'Microsoft Office'),
(883, 95, 120, 'Yes'),
(884, 96, 120, 'Not Answered'),
(885, 97, 120, 'Regular or Permanent'),
(886, 98, 120, 'Technicians and Associate Professionals'),
(887, 99, 120, 'Local'),
(888, 100, 120, 'VillarGroup of Company'),
(889, 101, 120, 'Professional, Technical or Supervisory'),
(890, 102, 120, 'No'),
(891, 103, 120, '1'),
(892, 104, 120, 'No'),
(893, 105, 120, '1 to 6 months'),
(894, 106, 120, 'P10,000 to less than P15,000'),
(895, 107, 120, 'Relevant'),
(896, 108, 120, 'Not Answered'),
(897, 85, 121, '2017'),
(898, 86, 121, 'Erick Laxamana'),
(899, 87, 121, 'Mexico, Pampanga'),
(900, 88, 121, 'erick.laxamana03@gmail.com'),
(901, 89, 121, '09268458367'),
(902, 90, 121, 'Single'),
(903, 91, 121, 'Male'),
(904, 92, 121, '1996-10-03'),
(905, 93, 121, 'Not Answered'),
(906, 94, 121, 'Basic non issurance cash management'),
(907, 95, 121, 'Yes'),
(908, 96, 121, 'Not Answered'),
(909, 97, 121, 'Regular or Permanent'),
(910, 99, 121, 'Local'),
(911, 100, 121, 'Quedy Media'),
(912, 101, 121, 'Professional, Technical or Supervisory'),
(913, 102, 121, 'No'),
(914, 103, 121, 'Not Answered'),
(915, 104, 121, 'Not Answered'),
(916, 105, 121, 'Not Answered'),
(917, 106, 121, 'P5,000 to less than P10,000'),
(918, 107, 121, 'Relevant'),
(919, 108, 121, 'Use or at least introduce the latest tools in developing web sites, mobile apps and system application'),
(938, 85, 127, '2018'),
(939, 86, 127, 'Lorena Puno Maglalang'),
(940, 87, 127, 'block 8 lot 15 camia st. northville 10 sampaga, san vicente, apalit, pampanga'),
(941, 88, 127, 'lorenamaglalang@gmail.com'),
(942, 89, 127, '9069165133'),
(943, 90, 127, 'Single'),
(944, 91, 127, 'Female'),
(945, 92, 127, '1995-07-06'),
(946, 93, 127, 'Not Answered'),
(947, 94, 127, 'Basic non issurance cash management'),
(948, 95, 127, 'Yes'),
(949, 96, 127, 'Not Answered'),
(950, 97, 127, 'Regular or Permanent'),
(951, 98, 127, 'Clerks'),
(952, 99, 127, 'Local'),
(953, 100, 127, 'Philippines first insurance co. inc'),
(954, 101, 127, 'Rank or Clerical'),
(955, 102, 127, 'Yes'),
(956, 103, 127, 'Not Answered'),
(957, 104, 127, 'No'),
(958, 105, 127, '1 to 6 months'),
(959, 106, 127, 'P10,000 to less than P15,000'),
(960, 107, 127, 'Relevant'),
(961, 108, 127, 'Not Answered'),
(962, 85, 128, '2017'),
(963, 86, 128, 'Michael Ramos Manganti'),
(964, 87, 128, 'Sindalan CSFP'),
(965, 88, 128, 'maykmikel@gmail.com'),
(966, 89, 128, '9192528894'),
(967, 90, 128, 'Single'),
(968, 91, 128, 'Male'),
(969, 92, 128, '1996-01-06'),
(970, 93, 128, 'Not Answered'),
(971, 94, 128, 'Not Answered'),
(972, 95, 128, 'Yes'),
(973, 96, 128, 'Not Answered'),
(974, 97, 128, 'Regular or Permanent'),
(975, 98, 128, 'Service workers , Shop and Market Sales Workers'),
(976, 99, 128, 'Local'),
(977, 100, 128, 'YAMAHA'),
(978, 101, 128, 'Professional, Technical or Supervisory'),
(979, 102, 128, 'Yes'),
(980, 103, 128, 'Not Answered'),
(981, 104, 128, 'Yes'),
(982, 105, 128, '2 years to less than 3 years'),
(983, 106, 128, 'P10,000 to less than P15,000'),
(984, 107, 128, 'Relevant'),
(985, 108, 128, 'Not Answered'),
(986, 85, 129, '2017'),
(987, 86, 129, 'Ma. Lourdes D. Lugtu'),
(988, 87, 129, 'Madapdap Resettlement Mabalacat city'),
(989, 88, 129, 'Anunalourdes1710@gmail.com'),
(990, 89, 129, '9556730799'),
(991, 90, 129, 'Single'),
(992, 91, 129, 'Female'),
(993, 92, 129, '1997-10-17'),
(994, 93, 129, 'Not Answered'),
(995, 94, 129, 'Not Answered'),
(996, 95, 129, 'Yes'),
(997, 96, 129, 'Not Answered'),
(998, 97, 129, 'Regular or Permanent'),
(999, 99, 129, 'Local'),
(1000, 100, 129, 'IQor'),
(1001, 101, 129, 'Rank or Clerical'),
(1002, 102, 129, 'Yes'),
(1003, 103, 129, 'Not Answered'),
(1004, 104, 129, 'Yes'),
(1005, 105, 129, '1 to 6 months'),
(1006, 106, 129, 'P20,000 to less than P25,000'),
(1007, 107, 129, 'Relevant'),
(1008, 108, 129, 'Not Answered'),
(1308, 85, 143, '2017'),
(1309, 86, 143, 'Karl Joshua Carlos'),
(1310, 87, 143, 'Floridablanca, pampanga'),
(1311, 88, 143, 'carloscarljoshua@gmail.com'),
(1312, 89, 143, '9057216695'),
(1313, 90, 143, 'Single'),
(1314, 91, 143, 'Male'),
(1315, 92, 143, '1997-04-02'),
(1316, 93, 143, 'Not Answered'),
(1317, 94, 143, 'Not Answered'),
(1318, 95, 143, 'Yes'),
(1319, 96, 143, 'Not Answered'),
(1320, 97, 143, 'Regular or Permanent'),
(1321, 99, 143, 'Local'),
(1322, 100, 143, 'Not Answered'),
(1323, 101, 143, 'Managerial or Executive'),
(1324, 102, 143, 'No'),
(1325, 103, 143, '1'),
(1326, 104, 143, 'No'),
(1327, 105, 143, '1 to 6 months'),
(1328, 106, 143, 'P15,000 to less than P20,000'),
(1329, 107, 143, 'Not Relevant'),
(1330, 108, 143, 'just add more mathematical subjects like engineering subject(abacus).'),
(1331, 85, 144, '2018'),
(1332, 86, 144, 'Dianne Millama Buendia'),
(1333, 87, 144, 'Santa Rita, Pampanga'),
(1334, 88, 144, 'Not Answered'),
(1335, 89, 144, 'Not Answered'),
(1336, 90, 144, 'Single'),
(1337, 91, 144, 'Female'),
(1338, 92, 144, '1997-01-22'),
(1339, 93, 144, 'Not Answered'),
(1340, 94, 144, 'Not Answered'),
(1341, 95, 144, 'Yes'),
(1342, 96, 144, 'Not Answered'),
(1343, 97, 144, 'Regular or Permanent'),
(1344, 98, 144, 'Clerks'),
(1345, 99, 144, 'Local'),
(1346, 100, 144, 'SolidCare Enterprises'),
(1347, 101, 144, 'Rank or Clerical'),
(1348, 102, 144, 'No'),
(1349, 103, 144, '2'),
(1350, 104, 144, 'No'),
(1351, 105, 144, '1 to 6 months'),
(1352, 106, 144, 'P5,000 to less than P10,000'),
(1353, 107, 144, 'Relevant'),
(1354, 108, 144, 'Not Answered'),
(1355, 85, 145, '2018'),
(1356, 86, 145, 'Mariella Joy Santos'),
(1357, 87, 145, 'Block 119 Lot 18 Bulaon Resettlement City of Sanfernando, Pampanga'),
(1358, 88, 145, 'mariellajoy1718@yahoo.com'),
(1359, 89, 145, '0912110911'),
(1360, 90, 145, 'Single'),
(1361, 91, 145, 'Female'),
(1362, 92, 145, '1998-01-18'),
(1363, 93, 145, 'Not Answered'),
(1364, 94, 145, 'Not Answered'),
(1365, 95, 145, 'No'),
(1366, 96, 145, 'Did not look for a job'),
(1367, 97, 145, 'Not Answered'),
(1368, 98, 145, 'Not Answered'),
(1369, 99, 145, 'Not Answered'),
(1370, 100, 145, 'Not Answered'),
(1371, 101, 145, 'Not Answered'),
(1372, 102, 145, 'Not Answered'),
(1373, 103, 145, 'Not Answered'),
(1374, 104, 145, 'Not Answered'),
(1375, 105, 145, 'Not Answered'),
(1376, 106, 145, 'Not Answered'),
(1377, 107, 145, 'Not Answered'),
(1378, 108, 145, 'Not Answered'),
(1379, 85, 146, '2017'),
(1380, 86, 146, 'Mark Tungul'),
(1381, 87, 146, 'Fiesta Homes Malpitic'),
(1382, 88, 146, 'romeoTungul@gmail.com'),
(1383, 89, 146, '9365519032'),
(1384, 90, 146, 'Married'),
(1385, 91, 146, 'Male'),
(1386, 92, 146, '1996-09-05'),
(1387, 93, 146, 'Not Answered'),
(1388, 94, 146, 'Not Answered'),
(1389, 95, 146, 'Yes'),
(1390, 96, 146, 'Not Answered'),
(1391, 97, 146, 'Regular or Permanent'),
(1392, 98, 146, 'Professionals'),
(1393, 99, 146, 'Local'),
(1394, 100, 146, 'IbossAsia'),
(1395, 101, 146, 'Rank or Clerical'),
(1396, 102, 146, 'No'),
(1397, 103, 146, '3'),
(1398, 104, 146, 'No'),
(1399, 105, 146, 'less than a month'),
(1400, 106, 146, 'P15,000 to less than P20,000'),
(1401, 107, 146, 'Not Relevant'),
(1402, 108, 146, 'Not Answered'),
(1403, 85, 147, '2017'),
(1404, 86, 147, 'Romeo Lacap jr.'),
(1405, 87, 147, 'Bagang Masantol Pampanga'),
(1406, 88, 147, 'romeolacap@gmail.com'),
(1407, 89, 147, '9350593722'),
(1408, 90, 147, 'Single'),
(1409, 91, 147, 'Male'),
(1410, 92, 147, '1993-11-28'),
(1411, 93, 147, 'Not Answered'),
(1412, 94, 147, 'Not Answered'),
(1413, 95, 147, 'Yes'),
(1414, 96, 147, 'Not Answered'),
(1415, 97, 147, 'Regular or Permanent'),
(1416, 98, 147, 'Professionals'),
(1417, 99, 147, 'Local'),
(1418, 100, 147, 'Sterling Global'),
(1419, 101, 147, 'Rank or Clerical'),
(1420, 102, 147, 'No'),
(1421, 103, 147, '3'),
(1422, 104, 147, 'No'),
(1423, 105, 147, '7 to 11 months'),
(1424, 106, 147, 'P10,000 to less than P15,000'),
(1425, 107, 147, 'Very Relevant'),
(1426, 108, 147, 'Not Answered'),
(1634, 85, 159, '2017'),
(1635, 86, 159, 'Roxette G. Sta Rita'),
(1636, 87, 159, 'Benedicto Floridablanca, pampanga'),
(1637, 88, 159, 'ettexor3115@gmail.com'),
(1638, 89, 159, '9977468729'),
(1639, 90, 159, 'Single'),
(1640, 91, 159, 'Female'),
(1641, 92, 159, '1997-01-31'),
(1642, 93, 159, 'Not Answered'),
(1643, 94, 159, 'Not Answered'),
(1644, 95, 159, 'Yes'),
(1645, 96, 159, 'Not Answered'),
(1646, 97, 159, 'Regular or Permanent'),
(1647, 99, 159, 'Local'),
(1648, 100, 159, 'Sutherland Global Services'),
(1649, 101, 159, 'Rank or Clerical'),
(1650, 102, 159, 'Yes'),
(1651, 103, 159, 'Not Answered'),
(1652, 104, 159, 'No'),
(1653, 105, 159, '1 to 6 months'),
(1654, 106, 159, 'P15,000 to less than P20,000'),
(1655, 107, 159, 'Relevant'),
(1656, 108, 159, 'Not Answered'),
(1657, 85, 160, '2017'),
(1658, 86, 160, 'Marlon Quito'),
(1659, 87, 160, 'San jaun, San Luis, Pampanga'),
(1660, 88, 160, 'marlonquito09@gmail.com'),
(1661, 89, 160, '09069478714'),
(1662, 90, 160, 'Single'),
(1663, 91, 160, 'Male'),
(1664, 92, 160, '1996-11-09'),
(1665, 93, 160, 'Not Answered'),
(1666, 94, 160, 'Not Answered'),
(1667, 95, 160, 'Yes'),
(1668, 96, 160, 'Not Answered'),
(1669, 97, 160, 'Contractual'),
(1670, 98, 160, 'Officials of Government, Corporate Executives, Managers, Managing Proprietors and Supervisors '),
(1671, 99, 160, 'Local'),
(1672, 100, 160, 'San Luis District Hospital'),
(1673, 101, 160, 'Rank or Clerical'),
(1674, 102, 160, 'No'),
(1675, 103, 160, '2'),
(1676, 104, 160, 'Yes'),
(1677, 105, 160, '1 to 6 months'),
(1678, 106, 160, 'P10,000 to less than P15,000'),
(1679, 107, 160, 'Relevant'),
(1680, 108, 160, 'Not Answered'),
(1681, 85, 161, '2017'),
(1682, 86, 161, 'Jubie Ocampo'),
(1683, 87, 161, 'San juan,Mexico Pampanga'),
(1684, 88, 161, 'jubangocampo@gmail.com'),
(1685, 89, 161, '0997130914'),
(1686, 90, 161, 'Single'),
(1687, 91, 161, 'Female'),
(1688, 92, 161, '1997-08-05'),
(1689, 93, 161, 'Not Answered'),
(1690, 94, 161, 'Not Answered'),
(1691, 95, 161, 'Yes'),
(1692, 96, 161, 'Not Answered'),
(1693, 97, 161, 'Contractual'),
(1694, 98, 161, 'Technicians and Associate Professionals'),
(1695, 99, 161, 'Local'),
(1696, 100, 161, 'Teletech'),
(1697, 101, 161, 'Professional, Technical or Supervisory'),
(1698, 102, 161, 'Yes'),
(1699, 103, 161, 'Not Answered'),
(1700, 104, 161, 'Yes'),
(1701, 105, 161, '1 to 6 months'),
(1702, 106, 161, 'P10,000 to less than P15,000'),
(1703, 107, 161, 'Relevant'),
(1704, 108, 161, 'Not Answered'),
(1705, 109, 162, '2017'),
(1706, 111, 162, 'josh canlas'),
(1707, 114, 162, 'Male'),
(1708, 109, 163, '2016'),
(1709, 111, 163, 'albert nucum'),
(1710, 114, 163, 'Male'),
(1711, 109, 164, '2016'),
(1712, 111, 164, 'ivan pineda'),
(1713, 114, 164, 'Male'),
(1743, 79, 171, 'Josue Canlas'),
(1744, 80, 171, 'Not Answered'),
(1745, 81, 171, 'Not Answered'),
(1746, 82, 171, 'Not Answered'),
(1747, 83, 171, 'Not Answered'),
(1748, 84, 171, 'Not Answered');

-- --------------------------------------------------------

--
-- Table structure for table `userstb`
--

CREATE TABLE `userstb` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `attempt` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL,
  `account_type` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstb`
--

INSERT INTO `userstb` (`ID`, `Name`, `Email`, `Contact`, `Password`, `attempt`, `log_time`, `account_type`) VALUES
(31, 'Admin', 'joshcanlas2017@gmail.com', '09550959895', 'admin123', '0', '', '1'),
(39, 'Phau Canlas', 'phau_david@yahoo.com', '09550959894', 'qweasd123', '0', '', '2'),
(53, 'Path Path', 'pathpath@gmail.com', '09000000002', 'YIfxkj4m', '0', '', '2'),
(55, 'Jayson castro', 'jayson@gmail.com', '09778545645', 'EoORtfLH', '0', '', '2'),
(56, 'Elmer Cruz', 'Elmer@gmail.com', '09282323232', 'QzPJqigo', '0', '', '2'),
(61, 'Chris chris', 'chris@gmail.com', '09550959895', '1SUcf3lv', '0', '', '2'),
(62, 'philip philip', 'philip@gmail.com', '02222212312', 'MDSWw8Eo', '0', '', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acc_req_db`
--
ALTER TABLE `acc_req_db`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `LID` (`LID`);

--
-- Indexes for table `answertbl`
--
ALTER TABLE `answertbl`
  ADD PRIMARY KEY (`Answer_ID`),
  ADD KEY `answertbl_ibfk_1` (`Question_ID`);

--
-- Indexes for table `enumeratortbl`
--
ALTER TABLE `enumeratortbl`
  ADD PRIMARY KEY (`EID`);

--
-- Indexes for table `logstbl`
--
ALTER TABLE `logstbl`
  ADD PRIMARY KEY (`LID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `mysurveytbl`
--
ALTER TABLE `mysurveytbl`
  ADD PRIMARY KEY (`Survey_ID`),
  ADD KEY `mysurveytbl_ibfk_1` (`user_ID`);

--
-- Indexes for table `otherstbl`
--
ALTER TABLE `otherstbl`
  ADD PRIMARY KEY (`OtherID`),
  ADD KEY `otherstbl_ibfk_1` (`Question_ID`),
  ADD KEY `otherstbl_ibfk_2` (`RespondentID`);

--
-- Indexes for table `questiontbl`
--
ALTER TABLE `questiontbl`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `questiontbl_ibfk_1` (`Survey_ID`);

--
-- Indexes for table `respondenttbl`
--
ALTER TABLE `respondenttbl`
  ADD PRIMARY KEY (`RID`),
  ADD KEY `respondenttbl_ibfk_1` (`Survey_ID`),
  ADD KEY `respondenttbl_ibfk_2` (`EnumeratorID`);

--
-- Indexes for table `responsetbl`
--
ALTER TABLE `responsetbl`
  ADD PRIMARY KEY (`ResponseID`),
  ADD KEY `responsetbl_ibfk_1` (`RespondentID`),
  ADD KEY `responsetbl_ibfk_2` (`Question_ID`);

--
-- Indexes for table `userstb`
--
ALTER TABLE `userstb`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acc_req_db`
--
ALTER TABLE `acc_req_db`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `answertbl`
--
ALTER TABLE `answertbl`
  MODIFY `Answer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `enumeratortbl`
--
ALTER TABLE `enumeratortbl`
  MODIFY `EID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logstbl`
--
ALTER TABLE `logstbl`
  MODIFY `LID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `mysurveytbl`
--
ALTER TABLE `mysurveytbl`
  MODIFY `Survey_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `otherstbl`
--
ALTER TABLE `otherstbl`
  MODIFY `OtherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `questiontbl`
--
ALTER TABLE `questiontbl`
  MODIFY `QuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `respondenttbl`
--
ALTER TABLE `respondenttbl`
  MODIFY `RID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `responsetbl`
--
ALTER TABLE `responsetbl`
  MODIFY `ResponseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1749;

--
-- AUTO_INCREMENT for table `userstb`
--
ALTER TABLE `userstb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`LID`) REFERENCES `logstbl` (`LID`) ON DELETE CASCADE;

--
-- Constraints for table `answertbl`
--
ALTER TABLE `answertbl`
  ADD CONSTRAINT `answertbl_ibfk_1` FOREIGN KEY (`Question_ID`) REFERENCES `questiontbl` (`QuestionID`) ON DELETE CASCADE;

--
-- Constraints for table `logstbl`
--
ALTER TABLE `logstbl`
  ADD CONSTRAINT `logstbl_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `userstb` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `mysurveytbl`
--
ALTER TABLE `mysurveytbl`
  ADD CONSTRAINT `mysurveytbl_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `userstb` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `otherstbl`
--
ALTER TABLE `otherstbl`
  ADD CONSTRAINT `otherstbl_ibfk_1` FOREIGN KEY (`Question_ID`) REFERENCES `questiontbl` (`QuestionID`) ON DELETE CASCADE,
  ADD CONSTRAINT `otherstbl_ibfk_2` FOREIGN KEY (`RespondentID`) REFERENCES `respondenttbl` (`RID`) ON DELETE CASCADE;

--
-- Constraints for table `questiontbl`
--
ALTER TABLE `questiontbl`
  ADD CONSTRAINT `questiontbl_ibfk_1` FOREIGN KEY (`Survey_ID`) REFERENCES `mysurveytbl` (`Survey_ID`) ON DELETE CASCADE;

--
-- Constraints for table `respondenttbl`
--
ALTER TABLE `respondenttbl`
  ADD CONSTRAINT `respondenttbl_ibfk_1` FOREIGN KEY (`Survey_ID`) REFERENCES `mysurveytbl` (`Survey_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `respondenttbl_ibfk_2` FOREIGN KEY (`EnumeratorID`) REFERENCES `enumeratortbl` (`EID`) ON DELETE CASCADE;

--
-- Constraints for table `responsetbl`
--
ALTER TABLE `responsetbl`
  ADD CONSTRAINT `responsetbl_ibfk_1` FOREIGN KEY (`RespondentID`) REFERENCES `respondenttbl` (`RID`) ON DELETE CASCADE,
  ADD CONSTRAINT `responsetbl_ibfk_2` FOREIGN KEY (`Question_ID`) REFERENCES `questiontbl` (`QuestionID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

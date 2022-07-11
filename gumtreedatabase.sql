-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 12:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gumtreedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(8) NOT NULL,
  `UserID` int(8) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemDescription` varchar(1000) NOT NULL,
  `ItemCategory` enum('Sports and Leisure','Electronics','Home and Garden','Fashion','Pets','Games and Toys') NOT NULL,
  `DateAdded` datetime NOT NULL,
  `ItemCondition` enum('Good','Great','Needs Repairs') NOT NULL,
  `ItemPrice` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `UserID`, `ItemName`, `ItemDescription`, `ItemCategory`, `DateAdded`, `ItemCondition`, `ItemPrice`) VALUES
(1, 2, 'Land Yachtz Long Board', 'Second hand long board. Wheels needs new bearings. And you might want to put on a new grip pad on top. Includes two sets of wheels.', 'Sports and Leisure', '2022-06-14 09:25:23', 'Needs Repairs', 1200),
(2, 2, 'Samsung 24 inch curved monitor', 'Curved monitor optimal for gaming. 24 inches. Glossy black color.', 'Electronics', '2022-06-13 11:13:36', 'Good', 2400),
(3, 1, 'Alfa Dimple Hockey Ball', 'Hockey ball - only used once. Orange. ', 'Sports and Leisure', '2022-06-21 22:18:11', 'Great', 25),
(4, 1, 'Grays AC9 Senior Hockey Stick ', 'Second-hand Grays hockey stick. Used in three provincial games.', 'Sports and Leisure', '2022-06-21 22:46:58', 'Good', 1200),
(5, 6, 'Campmaster Hard Arm Chair', 'Second-hand camping chair. Two years old. Not used much. ', 'Sports and Leisure', '2022-06-21 22:55:12', 'Good', 300),
(6, 5, 'Desert Rock Easy-Up Chair', 'Unopened camping chair. Got it as a gift, but do not want it. ', 'Sports and Leisure', '2022-06-21 22:59:10', 'Great', 350),
(7, 7, 'Huffy Granite Mountain Bike ', '26 inches. Five years old. Not serviced recently. ', 'Sports and Leisure', '2022-06-22 10:34:35', 'Needs Repairs', 1010),
(8, 7, 'Hoyle Waterproof Clear Playing Cards', 'Pack of playing cards, waterproof. Unopened.', 'Sports and Leisure', '2022-06-22 10:37:28', 'Great', 150),
(9, 8, 'Electronics For Dummies', 'Book. Bought two years ago.', 'Electronics', '2022-06-22 10:41:42', 'Good', 110),
(10, 9, 'Logitech K380 Multi Device Bluetooth Keyboard', 'Bluetooth keyboard; still works as intended. The L-key is a bit loose.', 'Electronics', '2022-06-22 10:42:44', 'Needs Repairs', 250),
(11, 10, 'GIZZU 8800mAh Mini Dual DC UPS Black', 'High-capacity lithium-ion batteries, dual-voltage DC outputs, voltage selection, and intelligent protective design.\r\nBought 6 months ago. Selling since a bigger one is needed.', 'Electronics', '2022-06-22 10:46:06', 'Good', 500),
(12, 10, 'Huntkey PBA3500 PowerBank', 'Portable battery back for your cell phone or other electronic gadgets. ', 'Electronics', '2022-06-22 10:49:32', 'Good', 130),
(13, 11, 'Raynic Digital Alarm Clock ', 'Bluetooth With FM Radio, Dual Alarms, USB Charging Ports, 7-Color Night Light, Sleep Timer, Snooze, Dimmer. Selling because I am 76 years old and this device is too complicated for me. Would like an old fashioned alarm clock.', 'Electronics', '2022-06-22 10:52:04', 'Great', 1200),
(14, 12, 'Hamster House', 'Cute pink wooden house for hamsters. My hamster is too fat and does not use it; therefore, I am selling it. ', 'Pets', '2022-06-22 10:56:34', 'Good', 375),
(15, 13, 'Audrey Hepburn Polka Dot dress', 'Vintage polka dot cocktail dress. Only worn once. ', 'Fashion', '2022-06-22 10:58:16', 'Great', 400),
(16, 13, 'Nike Essential Crew Sweatshirt', 'Black sweatshirt. Never worn-wrong size.', 'Fashion', '2022-06-22 11:03:40', 'Great', 700),
(17, 14, 'Sage Lace Glam Dress', 'Young Designers Emporium. Silver. ', 'Fashion', '2022-06-22 11:06:11', 'Great', 1400),
(18, 13, 'Xbox series X', 'Still in good condition, don\'t have time to use it anymore. One button is dysfunctional.', 'Games and Toys', '2022-06-22 11:10:05', 'Needs Repairs', 8000),
(19, 25, 'Activision destiny Playstation 4', 'Still new. ', 'Games and Toys', '2022-06-22 11:12:32', 'Great', 150),
(20, 21, 'Dog collar', 'Durable heavy-duty adjustable dog collar. ', 'Pets', '2022-06-22 11:14:58', 'Good', 145),
(21, 29, 'USB Adapter', 'Smart USB charger adapter. Eight ports.', 'Electronics', '2022-06-22 11:18:37', 'Good', 350),
(22, 37, 'DJI Drone', 'DJI FPV combo. Black.', 'Electronics', '2022-06-22 11:21:21', 'Good', 12000),
(23, 41, 'Golden Retriever Puppy', 'One puppy left from 4. Male. 9 weeks old.', 'Pets', '2022-06-22 11:24:58', 'Great', 4000),
(24, 33, 'Dress', 'Long pink dress. Never worn. ', 'Fashion', '2022-06-22 11:26:39', 'Great', 230),
(25, 35, 'Connect 4', 'Connect 4 Hasbro game, 2 missing pieces. ', 'Games and Toys', '2022-06-22 11:28:34', 'Needs Repairs', 100),
(26, 22, 'Monitor', 'Dell 21.5-inch Full HD Monitor - SE2222H', 'Electronics', '2022-06-22 11:40:15', 'Great', 3000),
(27, 39, 'Dress', 'Zara Floral Print dress. ', 'Fashion', '2022-06-22 11:43:11', 'Great', 850),
(28, 30, 'Dog and cat bed', 'SAVFOX Original Calming Dog and Cat Bed, Orthopedic Anti Anxiety Round Comfy Donut Cuddler Cozy Soft Fluffy Faux Fur Long Plush Marshmallow Pet Bed.', 'Pets', '2022-06-22 11:45:14', 'Good', 780),
(29, 10, 'LG HD Monitor', 'LG 22 Inch Full HD Monitor (22MK400H)', 'Electronics', '2022-06-22 11:46:26', 'Great', 1950),
(30, 23, 'Smeg kettle', 'White smeg kettle. Bought 5 months ago.', 'Home and Garden', '2022-06-22 11:49:15', 'Good', 1600),
(31, 24, 'Jack Russel puppies', 'Four puppies, six weeks old. Injected and dewormed. Not registered. One male, three female. ', 'Pets', '2022-06-22 11:52:16', 'Great', 2000),
(32, 27, 'Patio set', 'Davis 4-seater patio set. Few scratch marks.', 'Home and Garden', '2022-06-22 11:54:02', 'Needs Repairs', 5000),
(33, 32, 'Montana Jacket', 'Mens Montana jacket. Black.', 'Fashion', '2022-06-22 11:56:49', 'Good', 1220),
(34, 38, 'Anti-bacterial pet bowl', 'White. Used once (my dog barks at it). ', 'Pets', '2022-06-22 11:58:01', 'Great', 270),
(35, 11, 'Sunbed', 'Skagerak Riviera Sunbed.', 'Home and Garden', '2022-06-22 11:59:41', 'Good', 18000),
(36, 18, 'Qwirkle', 'Qwirkle game. Bought 3 years ago, still in good condition.', 'Games and Toys', '2022-06-22 12:00:55', 'Good', 300),
(37, 15, 'Blazer', 'Black, size 46. Bought at Truworths.', 'Fashion', '2022-06-22 12:03:24', 'Good', 1050),
(38, 28, 'Hisense refrigerator', 'Hisense 165L Combi Fridge/Freezer (Titan Silver)', 'Home and Garden', '2022-06-22 12:05:23', 'Good', 2750),
(39, 16, 'Toy aeroplane', 'lsrc-b3 rc airplane 2.4ghz rc plane with led lights', 'Games and Toys', '2022-06-22 12:07:58', 'Good', 1240),
(40, 37, 'Seiko men\'s watch', 'Seiko Men\'s Stainless_Steel Analog Wrist Watch SPB091J1', 'Fashion', '2022-06-22 12:09:50', 'Good', 38000),
(41, 34, 'Kittens', '7 weeks old. Four females, one male. Dewormed.', 'Pets', '2022-06-22 12:11:14', 'Great', 900),
(42, 36, 'Accent lamp', 'Meyda Tiffany 18\"H Lamella Accent Lamp 134533. One glass piece has a chip.', 'Home and Garden', '2022-06-22 12:13:01', 'Needs Repairs', 4300),
(43, 36, 'Stained glass bedside lamp', 'American Tiffany Stained Glass Table Lamp Resin Base Living Room Bedside Lamp.', 'Home and Garden', '2022-06-22 12:14:54', 'Good', 4100);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `PictureID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `PictureName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`PictureID`, `ItemID`, `PictureName`) VALUES
(1, 1, 'Picture1.jpg'),
(2, 2, 'Picture2.jpg'),
(3, 3, 'Picture3.png'),
(4, 4, 'Picture4.jpg'),
(5, 5, 'Picture5.png'),
(6, 6, 'Picture6.png'),
(7, 7, 'Picture7.jpg'),
(8, 8, 'Picture8.jpg'),
(9, 9, 'Picture9.jpg'),
(10, 10, 'Picture10.jpg'),
(11, 11, 'Picture11.jpg'),
(12, 12, 'Picture12.jpg'),
(13, 13, 'Picture13.jpg'),
(14, 14, 'Picture14.jpg'),
(15, 15, 'Picture15.jpg'),
(16, 16, 'Picture16.jpg'),
(17, 17, 'Picture17.jpg'),
(18, 18, 'Picture18.jpg'),
(19, 19, 'Picture19.jpg'),
(20, 20, 'Picture20.jpg'),
(21, 21, 'Picture21.jpg'),
(22, 22, 'Picture22.jpg'),
(23, 23, 'Picture23.jpg'),
(24, 24, 'Picture24.jpg'),
(25, 25, 'Picture25.jpg'),
(26, 26, 'Picture26.jpg'),
(27, 27, 'Picture27.jpg'),
(28, 28, 'Picture28.jpg'),
(29, 29, 'Picture29.jpg'),
(30, 30, 'Picture30.jpg'),
(31, 31, 'Picture31.jpg'),
(32, 32, 'Picture32.jpg'),
(33, 33, 'Picture33.jpg'),
(34, 34, 'Picture34.jpg'),
(35, 35, 'Picture35.jpg'),
(36, 36, 'Picture36.jpg'),
(37, 37, 'Picture37.jpg'),
(38, 38, 'Picture38.jpg'),
(39, 39, 'Picture39.jpg'),
(40, 40, 'Picture40.jpg'),
(41, 41, 'Picture41.jpg'),
(42, 42, 'Picture42.jpg'),
(43, 43, 'Picture43.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(8) NOT NULL,
  `UserFName` varchar(50) NOT NULL,
  `UserLName` varchar(50) NOT NULL,
  `AdminPrivilege` tinyint(1) DEFAULT 0,
  `UserHomeTown` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `CellNumber` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserFName`, `UserLName`, `AdminPrivilege`, `UserHomeTown`, `UserPassword`, `UserEmail`, `CellNumber`) VALUES
(1, 'Jacques', 'Troskie', 1, 'Potchefstroom', 'Otter@79', 'jtroskie@gmail.com', '0629986651'),
(2, 'Paul', 'Rheeder', 0, 'Stellenbosch', 'Stellies@22', 'paul.rheeder@gmail.com', '0723549801'),
(3, 'Wian', 'Koekemoer', 1, 'Welkom', 'Pie@49', 'wian.koe49@gmail.com', '0829908412'),
(4, 'Ansophie', 'Olivier', 0, 'Swartruggens', 'Manifique49*', 'olivieransophie@gmail.com', '0725743764'),
(5, 'Wouter', 'De Vries', 1, 'Potchefstroom', 'Mahikeng54', 'wouterdevries20@gmail.com', '0823455678'),
(6, 'Marie-Tinka', 'Olivier', 1, 'Swartruggens', 'MTOReii414', 'marietinkaolivier99@gmail.com', '0729998577'),
(7, 'Hendri', 'Horden', 0, 'Hartbeespoort', '423Quality', 'horden87@gmailcom', '0798564325'),
(8, 'Corli', 'Smit', 0, 'Lichtenburg', 'Pharm56', 'csmit5689@gmail.com', '0798564367'),
(9, 'Marcel', 'Oosthuizen', 0, 'Hartenbos', 'SeeisBlou45', 'marceloost002@gmail.com', '0658568325'),
(10, 'Henk', 'Montgomery', 0, 'Hoedspruit', 'Wildtuin73', 'henkmonty67@gmail.com', '0834723409'),
(11, 'Anri', 'Cilliers', 0, 'Zeerust', 'BotswanaGrens654', 'cilliersanri@gmail,,om', '0826734523'),
(12, 'Elrette', 'Coetsee', 0, 'Bloemfontein', 'Oranje26', 'elrettecoetsee76@gmail.com', '0657608735'),
(13, 'Danie', 'Greyling', 0, 'Rustenburg', 'RHSberg34*', 'greyling49@gmail.com', '0723987234'),
(14, 'Susan', 'Boyle', 0, 'Upington', 'lhbtYIh84!', 'upboyles@gmail.co,', '0738564325'),
(15, 'Walton', 'Day', 0, 'East London', 'BoatingF38', 'dayboat66@gmail.com', '0647630082'),
(16, 'Tracy', 'Stutton', 0, 'Kei Mouth', 'hnUJof70', 'traceystutton25@gmail.com', '0728664325'),
(17, 'Thea', 'Verster', 0, 'Ficksburg', 'KoudVdag75?', 'versterthea@gmail.com', '0727745867'),
(18, 'Warrick', 'Adams', 0, 'Johannesburg', 'gioV56I', 'warrickadamsjhb@gmail.com', '0653398867'),
(19, 'Alex', 'Burton', 0, 'Coligny', 'treeGreen', 'alexburton98@yahoo.com', '0793329076'),
(20, 'Mia', 'Malan', 0, 'Struisbaai', 'Hello65', 'miamalan20@gmail.com', '0729798577'),
(21, 'Gunther', 'van der Merwe', 0, 'Oudtshoorn', 'volstruis44', 'vandermerwegh72@gmail.com', '0844723509'),
(22, 'Robert', 'Stevens', 0, 'Durban', 'surferSun11!', 'robertstevens37@yahoo.com', '0720958537'),
(23, 'Marlene', 'Lewis', 0, 'Middelburg', 'stoffberg55', 'marlenelewis@gmail.com', '0844773504'),
(24, 'Nicola', 'Louw', 0, 'Brits', 'nieksbraai5!', 'nicolalouw95@gmail.com', '0728765322'),
(25, 'Valco', 'du Plessis', 0, 'Cape Town', 'tablemountain34', 'valcodupl007@gmail.com', '0657809729'),
(26, 'Edwin', 'Deming', 0, 'Gquberha', 'notEdwardsDeming', 'edwindeming@yahoo.com', '0659430056'),
(27, 'Walter', 'Shewhart', 0, 'Hermanus', 'controlchartsAreNecessary', 'shewhartwalter@gmail.com', '0748684349'),
(28, 'Leanka', 'Froneman', 0, 'Graaff Reinet', 'Grafies!*89', 'leankafroneman4@gmail.com', '0837590238'),
(29, 'John', 'Turner', 0, 'Pretoria', 'Carribean56', 'turner74@gmail.com', '0658867734'),
(30, 'Mary', 'Walker', 0, 'Pietermaritzburg', 'pietermaritz49', 'walkermary@gmail.com', '0835726479'),
(31, 'Sheldon', 'Roberts', 0, 'Robertson', 'morewinelesswhine', 'sheldonroberts@gmail.com', '0727848524'),
(32, 'Elton', 'John', 0, 'Newcastle', 'candleInTheWind', 'eltonjohnuk23@gmail.com', '0657548934'),
(33, 'Mary', 'Decker', 0, 'St Lucia', 'trippnRun', 'marydecker67@gmail.com', '0826794583'),
(34, 'Zola', 'Budd', 0, 'Ulundi', 'gottarun55', 'zolabudd34@gmail.com', '0657834523'),
(35, 'Edward', 'Fourie', 0, 'Mosselbaai', 'fourietjieMB48', 'edwardfourie03@gmail.com', '0837698274'),
(36, 'Megan', 'van Deventer', 0, 'Johannesburg', 'mvdjhbUJ', 'megsvandeventer@gmail.com', '0798730284'),
(37, 'Mark', 'Shawl', 0, 'Pretoria', 'jacarandafm', 'markshawl64@gmail.com', '0638576392'),
(38, 'Leah', 'Marks', 0, 'Haenertsburg', 'hannleah92', 'marksleah29@gmail.com', '0673901123'),
(39, 'Tanya', 'Fouche', 0, 'Cape Town', 'badAtpassing', 'tanyafouche57@gmail.com', '0778534311'),
(40, 'Carl', 'Harris', 0, 'Darling', 'NVCrxD38', 'carlharris19@gmail.com', '0778964725'),
(41, 'Anne ', 'Farris', 0, 'Klerksdorp', 'reii414saleco', 'annefarris93@gmail.com', '0826670923');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`PictureID`),
  ADD UNIQUE KEY `PictureName` (`PictureName`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `PictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

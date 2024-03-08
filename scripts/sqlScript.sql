SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thezalma_TeamMinion`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
    `ID` int(11) NOT NULL,
    `type` varchar(300) DEFAULT NULL,
    `reservationDate` date DEFAULT NULL,
    `reservationTime` time NOT NULL,
    `firstName` varchar(100) DEFAULT NULL,
    `lastName` varchar(100) DEFAULT NULL,
    `email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ID`, `type`, `reservationDate`, `reservationTime`, `firstName`, `lastName`, `email`) VALUES
                                                                                                                      (20, 'massage', '2024-03-20', '00:00:00', 'Josh', 'Rickman', 'jrick@mail.com'),
                                                                                                                      (19, 'massage', '2024-03-20', '00:00:00', 'Lord John', 'Whorfin', 'lord.johnw@mail.com'),
                                                                                                                      (17, 'massage', '2024-03-20', '00:00:00', 'Josh', 'Rickman', 'jrick@mail.com'),
                                                                                                                      (18, 'massage', '2024-03-20', '00:00:00', 'Buckaroo', 'Bonzai', 'buck.bonz@mail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
    ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
    MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `reservations`
(
`ID` int(11) NOT NULL,
`type` varchar(300) DEFAULT NULL,
`reservationDate` date DEFAULT NULL,
`reservationTime` time NOT NULL,
`firstName` varchar(100) DEFAULT NULL,
`lastName` varchar(100) DEFAULT NULL,
`email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `massages`
(
`massageID` int(11) NOT NULL,
`massageDate` date NOT NULL,
`massageTime` time NOT NULL,
`massageType` varchar(40) NOT NULL,
`hotStones` tinyint(1) NOT NULL,
`massageIntensity` varchar(40) NOT NULL,
`firstName` varchar(100) NOT NULL,
`lastName` varchar(100) NOT NULL,
`email` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

ALTER TABLE `reservations`
    ADD PRIMARY KEY (`ID`);

ALTER TABLE `reservations`
    MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `massages`
    ADD PRIMARY KEY (`massageID`);

ALTER TABLE `massages`
    MODIFY `massageID` int(11) NOT NULL AUTO_INCREMENT;

COMMIT;
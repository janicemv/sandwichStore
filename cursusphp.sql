CREATE TABLE `bestellingen` (
  `bestelID` int NOT NULL AUTO_INCREMENT,
  `broodjeID` int NOT NULL,
  `klantID` int NOT NULL,
  `afhaalmoment` datetime NOT NULL,
  `statusID` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`bestelID`),
  KEY `FK_broodje_bestelling` (`broodjeID`),
  KEY `FK_klant_bestelling` (`klantID`),
  KEY `FK_status_bestelling` (`statusID`),
  CONSTRAINT `FK_broodje_bestelling` FOREIGN KEY (`broodjeID`) REFERENCES `broodjes` (`broodjeID`),
  CONSTRAINT `FK_klant_bestelling` FOREIGN KEY (`klantID`) REFERENCES `klanten` (`klantID`),
  CONSTRAINT `FK_status_bestelling` FOREIGN KEY (`statusID`) REFERENCES `statussen` (`statusID`)
) ENGINE = InnoDB AUTO_INCREMENT = 30 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci broodjes 

CREATE TABLE `broodjes` (
  `broodjeID` int NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) NOT NULL,
  `omschrijving` varchar(500) NOT NULL,
  `prijs` decimal(10, 2) DEFAULT NULL,
  PRIMARY KEY (`broodjeID`)
) ENGINE = InnoDB AUTO_INCREMENT = 9 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci broodjes_bestellijnen 

CREATE TABLE `broodjes_bestellijnen` (
  `lijnId` int NOT NULL AUTO_INCREMENT,
  `bestelId` int NOT NULL,
  `broodjeID` int NOT NULL,
  `totaalPrijs` float NOT NULL,
  PRIMARY KEY (`lijnId`),
  UNIQUE KEY `lijnId_UNIQUE` (`lijnId`),
  KEY `fk_broodjes_bestelLijnen_broodjes_bestellingen1_idx` (`bestelId`),
  KEY `fk_broodjes_bestelLijnen_broodjes1_idx` (`broodjeID`),
  CONSTRAINT `fk_broodjes_bestelLijnen_broodjes1` FOREIGN KEY (`broodjeID`) REFERENCES `broodjes` (`broodjeID`),
  CONSTRAINT `fk_broodjes_bestelLijnen_broodjes_bestellingen1` FOREIGN KEY (`bestelId`) REFERENCES `broodjes_bestellingen` (`bestelId`)
) ENGINE = InnoDB AUTO_INCREMENT = 43 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci broodjes_bestellingen 

CREATE TABLE `broodjes_bestellingen` (
  `bestelId` int NOT NULL AUTO_INCREMENT,
  `userId` int NOT NULL,
  `date` datetime NOT NULL,
  `statusID` int NOT NULL,
  PRIMARY KEY (`bestelId`),
  UNIQUE KEY `bestelId_UNIQUE` (`bestelId`),
  KEY `fk_broodjes_bestellingen_users1_idx` (`userId`),
  KEY `fk_broodjes_bestellingen_statussen1_idx` (`statusID`),
  CONSTRAINT `fk_broodjes_bestellingen_statussen1` FOREIGN KEY (`statusID`) REFERENCES `statussen` (`statusID`),
  CONSTRAINT `fk_broodjes_bestellingen_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 33 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci broodjes_extras_lijnen 

CREATE TABLE `broodjes_extras_lijnen` (
  `lijnId` int NOT NULL,
  `extraId` int NOT NULL,
  KEY `fk_broodjes_extras_lijnen_broodjes_bestelLijnen1_idx` (`lijnId`),
  KEY `fk_broodjes_extras_lijnen_extras1_idx` (`extraId`),
  CONSTRAINT `fk_broodjes_extras_lijnen_broodjes_bestelLijnen1` FOREIGN KEY (`lijnId`) REFERENCES `broodjes_bestellijnen` (`lijnId`),
  CONSTRAINT `fk_broodjes_extras_lijnen_extras1` FOREIGN KEY (`extraId`) REFERENCES `extras` (`extraId`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci extras 

CREATE TABLE `extras` (
  `extraId` int NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `naam` varchar(255) NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`extraId`)
) ENGINE = InnoDB AUTO_INCREMENT = 6 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci statussen

 CREATE TABLE `statussen` (
  `statusID` int NOT NULL AUTO_INCREMENT,
  `status` varchar(40) NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci users 

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 16 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(3, 'jmv@gmail.com', '7bWW'),
(4, 'oi@oi.com.br', 'AEhA'),
(5, 'test@test.com', 'gZ0A'),


INSERT INTO `broodjes` (`broodjeID`, `naam`, `omschrijving`, `prijs`) VALUES
(1, 'Boulet', 'Schijfjes boulet, ketchup, mayo en ui', 3.20),
(2, 'Smos', 'Kaas, ham, groentjes, mayo', 3.50),
(3, 'Martino', 'Americain, martinosaus, ui, augurk', 3.50),
(4, 'Kaas', 'Kaas, boter', 2.80),
(5, 'Ham', 'Ham, boter', 2.80),
(6, 'Veggie', 'Assortiment van groenten met feettakaas', 3.20),
(7, 'Vegan', 'Assortiment van groenten', 2.80),
(8, 'Carnivoor', 'Rosbief met groentjes en een heerlijk pepersausje', 3.50);


INSERT INTO `extras` (`extraId`, `naam`, `prijs`) VALUES
(1, 'mayo', 0.2),
(2, 'bacon', 0.5),
(3, 'kaas', 0.4),
(4, 'sla', 0.2),
(5, 'ham', 0.2);

INSERT INTO `statussen` (`statusID`, `status`) VALUES
(1, 'Besteld'),
(2, 'Gemaakt'),
(3, 'Afgehaald');

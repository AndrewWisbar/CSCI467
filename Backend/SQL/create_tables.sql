CREATE TABLE `inventory` (
    `ItemID` int(11) NOT NULL,
    `Quantity` int(11) NOT NULL,
    UNIQUE KEY `ItemID` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `orderdetails` (
    `OrderID` int(11) NOT NULL AUTO_INCREMENT,
    `time` datetime NOT NULL DEFAULT current_timestamp(),
    `fname` varchar(35) NOT NULL,
    `lname` varchar(35) NOT NULL,
    `email` varchar(255) NOT NULL,
    `addr` varchar(35) NOT NULL,
    `TotalPrice` decimal(8,2) NOT NULL,
    `TotalWeight` decimal(8,2) NOT NULL,
    `Status` int(11) NOT NULL DEFAULT 0,
     PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

	
CREATE TABLE `orderquantity` (
    `OrderID` int(11) NOT NULL,
    `ItemID` int(11) NOT NULL,
    `OrderedQuantity` int(11) NOT NULL,
    PRIMARY KEY (`OrderID`,`ItemID`),
    KEY `fk_item_id` (`ItemID`),
    CONSTRAINT `fk_item_id` FOREIGN KEY (`ItemID`) REFERENCES `inventory` (`ItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `shiprate` (
    `bound` int(11) NOT NULL,
    `rate` decimal(8,2) NOT NULL,
    PRIMARY KEY (`bound`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

	
CREATE TABLE InventoryDatabase(
    	ItemID	        INT			    	AUTO_INCREMENT UNIQUE NOT NULL,
    	Quantity 	INT		        	NOT NULL,
	CONSTRAINT InventoryDatabase_PK PRIMARY KEY (ItemID)
);	

CREATE TABLE OrderParts(
    	OrderID	        INT			    	AUTO_INCREMENT UNIQUE NOT NULL,
    	ItemID		INT			    	NOT NULL,
    	OrderQuantity 	INT		        	NOT NULL,
	CONSTRAINT PRIMARY KEY(OrderID, ItemID)
);	

CREATE TABLE OrderTotals(
    	OrderID	        INT			    	AUTO_INCREMENT UNIQUE NOT NULL,
    	TotalPrice      DECIMAL(8,2)			NOT NULL,
    	TotalWeight     DECIMAL(4,2)		    	NOT NULL,
    	Status          INT(11)                         NOT NULL DEFAULT 0
	CONSTRAINT PRIMARY KEY(OrderID)
);	

CREATE TABLE ShippingInfo(
    	WeightLimit	DECIMAL(5,2)    NOT NULL,
    	HigherCost   	DECIMAL(5,2)  	NOT NULL,
    	LowerCost    	DECIMAL(5,2)  	NOT NULL,
);	

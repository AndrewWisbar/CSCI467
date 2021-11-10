	
CREATE TABLE InventoryDatabase(
    	ItemID	        INT			    	AUTO_INCREMENT UNIQUE NOT NULL,
    	Quantity 	INT		        	NOT NULL,
	CONSTRAINT InventoryDatabase_PK PRIMARY KEY (ItemID)
);	

CREATE TABLE OrderDatabase(
    	OrderID	        INT			    	AUTO_INCREMENT UNIQUE NOT NULL,
    	ItemID		INT			    	NOT NULL,
    	TotalPrice      DECIMAL(8,2)			NOT NULL,
    	TotalWeight     DECIMAL(4,2)		    	NOT NULL,
    	OrderQuantity 	INT		        	NOT NULL,
	CONSTRAINT PRIMARY KEY(OrderID, ItemID)
);	
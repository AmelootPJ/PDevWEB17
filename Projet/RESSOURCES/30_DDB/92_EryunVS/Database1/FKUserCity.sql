ALTER TABLE [Eryun].[User]
	ADD CONSTRAINT [FKUserCity]
	FOREIGN KEY (Address_City)
	REFERENCES [City] (ID)

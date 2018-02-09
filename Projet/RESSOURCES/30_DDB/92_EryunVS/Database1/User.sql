CREATE TABLE [dbo].[Table1]
(
	[Id] INT NOT NULL PRIMARY KEY, 
    [Nickname] NCHAR(20) NOT NULL, 
    [Name] NCHAR(20) NOT NULL, 
    [FirstName] NCHAR(20) NOT NULL, 
    [Birthdate] DATETIME NOT NULL, 
    [Address_Street] NCHAR(50) NOT NULL, 
    [Address_City] INT NOT NULL, 
    [Address_Country] NCHAR(20) NOT NULL, 
    [Description] TEXT NULL, 
    [Character] NCHAR(10) NULL
)

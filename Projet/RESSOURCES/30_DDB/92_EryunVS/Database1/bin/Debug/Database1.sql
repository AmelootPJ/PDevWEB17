/*
Script de déploiement pour Database1

Ce code a été généré par un outil.
La modification de ce fichier peut provoquer un comportement incorrect et sera perdue si
le code est régénéré.
*/

GO
SET ANSI_NULLS, ANSI_PADDING, ANSI_WARNINGS, ARITHABORT, CONCAT_NULL_YIELDS_NULL, QUOTED_IDENTIFIER ON;

SET NUMERIC_ROUNDABORT OFF;


GO
:setvar DatabaseName "Database1"
:setvar DefaultFilePrefix "Database1"
:setvar DefaultDataPath "C:\Users\Pierre-Jean\AppData\Local\Microsoft\VisualStudio\SSDT\Eryun\"
:setvar DefaultLogPath "C:\Users\Pierre-Jean\AppData\Local\Microsoft\VisualStudio\SSDT\Eryun\"

GO
:on error exit
GO
/*
Détectez le mode SQLCMD et désactivez l'exécution du script si le mode SQLCMD n'est pas pris en charge.
Pour réactiver le script une fois le mode SQLCMD activé, exécutez ce qui suit :
SET NOEXEC OFF; 
*/
:setvar __IsSqlCmdEnabled "True"
GO
IF N'$(__IsSqlCmdEnabled)' NOT LIKE N'True'
    BEGIN
        PRINT N'Le mode SQLCMD doit être activé de manière à pouvoir exécuter ce script.';
        SET NOEXEC ON;
    END


GO
IF EXISTS (SELECT 1
           FROM   [master].[dbo].[sysdatabases]
           WHERE  [name] = N'$(DatabaseName)')
    BEGIN
        ALTER DATABASE [$(DatabaseName)]
            SET ARITHABORT ON,
                CONCAT_NULL_YIELDS_NULL ON,
                CURSOR_DEFAULT LOCAL 
            WITH ROLLBACK IMMEDIATE;
    END


GO
IF EXISTS (SELECT 1
           FROM   [master].[dbo].[sysdatabases]
           WHERE  [name] = N'$(DatabaseName)')
    BEGIN
        ALTER DATABASE [$(DatabaseName)]
            SET PAGE_VERIFY NONE,
                DISABLE_BROKER 
            WITH ROLLBACK IMMEDIATE;
    END


GO
USE [$(DatabaseName)];


GO
PRINT N'L''opération de refactorisation de changement de nom avec la clé ee50efc5-7dcc-4627-b031-9ae8a6328758 est ignorée, l''élément [dbo].[Table1].[Name] (SqlSimpleColumn) ne sera pas renommé en Nickname';


GO
PRINT N'L''opération de refactorisation de changement de nom avec la clé 8c72cffa-577e-4e5a-9894-56c773eed6e7 est ignorée, l''élément [dbo].[Table2].[Id] (SqlSimpleColumn) ne sera pas renommé en City';


GO
PRINT N'Création de [dbo].[Table1]...';


GO
CREATE TABLE [dbo].[Table1] (
    [Id]              INT        NOT NULL,
    [Nickname]        NCHAR (20) NOT NULL,
    [Name]            NCHAR (20) NOT NULL,
    [FirstName]       NCHAR (20) NOT NULL,
    [Birthdate]       DATETIME   NOT NULL,
    [Address_Street]  NCHAR (50) NOT NULL,
    [Address_City]    NCHAR (20) NOT NULL,
    [Address_Country] NCHAR (20) NOT NULL,
    [Description]     TEXT       NULL,
    [Character]       NCHAR (10) NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC)
);


GO
PRINT N'Création de [dbo].[Table2]...';


GO
CREATE TABLE [dbo].[Table2] (
    [City]    NCHAR (20) NOT NULL,
    [State]   NCHAR (20) NOT NULL,
    [Country] NCHAR (20) NOT NULL,
    PRIMARY KEY CLUSTERED ([City] ASC)
);


GO
-- Étape de refactorisation pour mettre à jour le serveur cible avec des journaux de transactions déployés

IF OBJECT_ID(N'dbo.__RefactorLog') IS NULL
BEGIN
    CREATE TABLE [dbo].[__RefactorLog] (OperationKey UNIQUEIDENTIFIER NOT NULL PRIMARY KEY)
    EXEC sp_addextendedproperty N'microsoft_database_tools_support', N'refactoring log', N'schema', N'dbo', N'table', N'__RefactorLog'
END
GO
IF NOT EXISTS (SELECT OperationKey FROM [dbo].[__RefactorLog] WHERE OperationKey = 'ee50efc5-7dcc-4627-b031-9ae8a6328758')
INSERT INTO [dbo].[__RefactorLog] (OperationKey) values ('ee50efc5-7dcc-4627-b031-9ae8a6328758')
IF NOT EXISTS (SELECT OperationKey FROM [dbo].[__RefactorLog] WHERE OperationKey = '8c72cffa-577e-4e5a-9894-56c773eed6e7')
INSERT INTO [dbo].[__RefactorLog] (OperationKey) values ('8c72cffa-577e-4e5a-9894-56c773eed6e7')

GO

GO
PRINT N'Mise à jour terminée.';


GO

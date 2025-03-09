CREATE DATABASE IF NOT EXISTS project_db;
USE project_db; 

CREATE TABLE document_type(
documentTypeId INT(11) AUTO_INCREMENT PRIMARY KEY, 
documentTypeName VARCHAR(20) NOT NULL UNIQUE
)

CREATE TABLE person (
personId INT(11) AUTO_INCREMENT PRIMARY KEY, 
personName VARCHAR(20) NOT NULL,
personLast_name VARCHAR(20) NOT NULL,
personDocument VARCHAR(10) NOT NULL,
documentTypeFk INT(11) NOT NULL,
FOREIGN KEY (documentTypeFk) REFERENCES document_type(documentTypeId)
)



CREATE DATABASE apiSENA;

CREATE TABLE Role(
Role_id INT(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
Role_name VARCHAR(20) NOT NULL,
Role_description VARCHAR(100) NULL
);

CREATE TABLE User_status(
User_status_id INT(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
User_status_name VARCHAR(20) NOT NULL,
User_status_description VARCHAR(100) NULL
);


CREATE TABLE User(
User_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
User_user VARCHAR(30) NOT NULL UNIQUE,
User_password VARCHAR(256) NOT NULL,
User_status_id INT(11) NOT NULL  ,
Role_id INT(11) NOT NULL ,
FOREIGN KEY (User_status_id) REFERENCES User_status(User_status_id),
FOREIGN KEY (Role_id) REFERENCES Role(Role_id)
);


INSERT INTO `role`(`Role_id`, `Role_name`, `Role_description`) VALUES 
(null,'Administrator','Administrator'),
(null,'Client','Client');


INSERT INTO `user_status`(`User_status_id`, `User_status_name`, `User_status_description`) VALUES (null,'Active','Active'),
(null,'Cancel','Cancel');

INSERT INTO `user`(`User_id`, `User_user`, `User_password`, `User_status_id`, `Role_id`) VALUES (null,'sena@gmail.com','123456',1,1),
(null,'sena1@gmail.com','123456',1,2),
(null,'sena2@gmail.com','123456',1,1);

SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id;

SELECT * FROM `user_status` WHERE 1; 



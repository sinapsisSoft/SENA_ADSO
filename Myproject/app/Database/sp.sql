/*User - get data users*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_all_user`$$
CREATE PROCEDURE `sp_select_all_user`()  
BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1;
END$$
/*User - get user data by Id*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_id_user`$$
CREATE PROCEDURE `sp_select_id_user`(IN IdUser INT)  
BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1 AND US.User_id=IdUser;
END$$
/*User - update data user*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_update_user`$$
CREATE PROCEDURE `sp_update_user`(IN IdUser INT,UserStatusId INT,RoleId INT)  
BEGIN
UPDATE user SET User_status_id=UserStatusId,Role_id=RoleId WHERE User_id=IdUser;
END$$
/*User - delete data user*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_delete_user`$$
CREATE PROCEDURE `sp_delete_user`(IN IdUser INT)  
BEGIN
DELETE FROM user WHERE User_id=IdUser;
END$$
/*User - validate login - get data User*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE PROCEDURE `sp_login`(IN UserUser VARCHAR(30))  
BEGIN
SELECT User_id,Role_id,User_password FROM user WHERE User_user=UserUser;
END$$
/*User - chnages password*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_change_password`$$
CREATE PROCEDURE `sp_change_password`(IN IdUser INT,UserPassword VARCHAR(256))  
BEGIN
UPDATE user SET User_password=UserPassword WHERE User_id=IdUser;
END$$
/*User - insert user*/
DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_insert_user`$$
CREATE PROCEDURE `sp_insert_user`(IN UserStatusId INT,RoleId INT,UserPassword VARCHAR(256),UserUser VARCHAR(30))  
BEGIN
INSERT INTO `user`(`User_id`, `User_user`, `User_password`, `User_status_id`, `Role_id`) VALUES 
(null,UserUser,UserPassword,UserStatusId,RoleId);
END$$
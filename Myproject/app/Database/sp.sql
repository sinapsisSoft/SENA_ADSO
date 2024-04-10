DELIMITER $$
DROP PROCEDURE IF EXISTS `changePassword`$$ 
CREATE PROCEDURE `changePassword`(IN userId INT,UserPassword VARCHAR(256) )
BEGIN
UPDATE user SET User_password=UserPassword WHERE User_id=userId;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `loginUser`$$ 
CREATE PROCEDURE `loginUser`(IN `user` VARCHAR(30))
BEGIN
SELECT User_password FROM user WHERE User_user=user AND User_status_id=1;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_change_password`$$ 
CREATE PROCEDURE `sp_change_password`(IN IdUser INT,UserPassword VARCHAR(256))
BEGIN
UPDATE user SET User_password=UserPassword WHERE User_id=IdUser;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_delete_user`$$
CREATE PROCEDURE `sp_delete_user`(IN `IdUser` INT)
BEGIN
DELETE FROM user WHERE User_id=IdUser;
SELECT COUNT(*) FROM user WHERE User_id=IdUser; 
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_insert_user`$$
CREATE PROCEDURE `sp_insert_user`(IN `UserUser` VARCHAR(30), IN `UserPassword` VARCHAR(256), IN `UserStatusId` INT, IN `RoleId` INT)
BEGIN
INSERT INTO `user`(`User_id`, `User_user`, `User_password`, `User_status_id`, `Role_id`) VALUES (null,UserUser,UserPassword,UserStatusId,RoleId);

SELECT LAST_INSERT_ID();
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_login`$$
CREATE PROCEDURE `sp_login`(IN UserUser VARCHAR(30))
BEGIN
SELECT User_id,Role_id,User_password FROM user WHERE User_user=UserUser;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_all_users`$$
CREATE PROCEDURE `sp_select_all_users`()
BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_id_user`$$
CREATE PROCEDURE `sp_select_id_user`(IN IdUser INT)
BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1 AND US.User_id=IdUser;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_update_user`$$
CREATE PROCEDURE `sp_update_user`(IN `IdUser` INT, IN `UserStatusId` INT, IN `RoleId` INT)
BEGIN
UPDATE user SET User_status_id=UserStatusId,Role_id=RoleId WHERE User_id=IdUser;
CALL`sp_select_all_users`();
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS `validateUser`$$
CREATE PROCEDURE `validateUser`(IN UserUser VARCHAR(30))
BEGIN
SELECT COUNT(*) FROM user WHERE User_user=UserUser AND User_status_id=1;
END$$
DELIMITER ;

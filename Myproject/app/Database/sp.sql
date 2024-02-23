DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_all_user`$$
CREATE PROCEDURE `sp_select_all_user`()  
BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1;
END$$


DELIMITER $$
DROP PROCEDURE IF EXISTS `sp_select_id_user`$$
CREATE PROCEDURE `sp_select_id_user`(IN IdUser INT)  
BEGIN
SELECT US.User_id,US.User_user,US.User_password,US.User_status_id,UST.User_status_name, US.Role_id,ROL.Role_name FROM `user` US
INNER JOIN role ROL ON US.Role_id=ROL.Role_id
INNER JOIN user_status UST ON US.User_status_id=UST.User_status_id 
WHERE US.User_status_id=1 AND US.User_id=IdUser;
END$$


DELIMITER $$
DROP PROCEDURE IF EXISTS loginUser$$
CREATE PROCEDURE loginUser(IN user VARCHAR(256))
BEGIN
SELECT User_password FROM user WHERE User_user=user AND User_status_id=1;
END$$

DELIMITER $$
CREATE PROCEDURE changePassword(IN userId INT,UserPassword VARCHAR(256) )
BEGIN
UPDATE user SET User_password=UserPassword WHERE User_id=userId;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `validateUser`(IN UserUser VARCHAR(30))
BEGIN
SELECT COUNT(*) FROM user WHERE User_user=UserUser AND User_status_id=1;
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `loginUser`(IN `user` VARCHAR(30))
BEGIN
SELECT User_password FROM user WHERE User_user=user AND User_status_id=1;
END$$
DELIMITER ;
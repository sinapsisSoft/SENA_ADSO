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
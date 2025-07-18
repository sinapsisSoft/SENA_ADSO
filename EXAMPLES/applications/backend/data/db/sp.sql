DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE sp_module_role_user (IN userId INT, roleId INT)   BEGIN
SELECT MD.id, MD.name, MD.route, MD.icon, MD.description, MD.is_active FROM module_role AS MR
INNER JOIN module AS MD ON MR.module_fk=MD.id
WHERE role_user_fk= (SELECT id FROM user_role WHERE user_id=userId AND role_id=roleId) ORDER BY  MD.name DESC;
END;

CREATE PROCEDURE sp_show_id_user_active (IN Id INT)   BEGIN
    SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
    INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 AND US.id=Id ORDER BY US.id;
    END$$

CREATE PROCEDURE sp_show_profile ()   BEGIN 

SELECT PR.id, PR.user_id, US.username, PR.first_name, PR.last_name, PR.address, PR.phone, PR.document_type_id, DT.name AS document_type_name ,PR.document_number, PR.photo_url, PR.birth_date FROM profile AS PR 
INNER JOIN user AS US ON PR.user_id = US.id
INNER JOIN document_type AS DT ON PR.document_type_id = DT.id;

END$$

CREATE PROCEDURE sp_show_user_active ()   BEGIN
    SELECT US.id,US.username,US.email,US.password_hash,US.status_id,UST.name AS status_name,US.last_login,US.created_at,US.updated_at  FROM user AS US 
    INNER JOIN  user_status UST ON US.status_id=UST.id WHERE US.status_id=1 ORDER BY US.id;
    END$$

CREATE PROCEDURE sp_user_role_id (IN userID INT)   BEGIN
SELECT UR.id, UR.user_id,US.username AS user_name,  UR.role_id,RL.name AS role_name,  UR.status_id,ST.name 
FROM user_role AS UR
INNER JOIN user US on UR.user_id=US.id
INNER JOIN role RL on UR.role_id=RL.id
INNER JOIN user_status ST on UR.status_id=ST.id
WHERE UR.user_id=userID AND UR.status_id=1;
END$$

DELIMITER ;
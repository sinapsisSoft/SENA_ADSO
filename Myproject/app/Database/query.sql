/*Select Users*/
SELECT US.User_id,US.User_user,US.User_password,US.User_status_FK,US.Role_FK, RO.Role_name,STU.User_status_name 
FROM users AS US 
INNER JOIN role RO ON US.Role_FK=RO.Role_id
INNER JOIN user_status STU ON US.User_status_FK=STU.User_status_id
WHERE STU.User_status_id=1;


/*Select Module Role for User*/
SELECT MROL.Module_role_id,MROL.Module_FK, MROL.Role_FK, MO.Module_name,MO.Module_route, MO.Module_icon,RO.Role_name 
FROM module_role AS MROL 
INNER JOIN module MO ON MROL.Module_FK=MO.Module_id
INNER JOIN role RO ON MROL.Role_FK=RO.Role_id
WHERE MROL.Role_FK=(SELECT Role_FK AS role FROM users WHERE User_id=?)


/*Select Permitions for Module Role */
SELECT PER.Permitions_id,PER.Permitions_name  
FROM permitions_module_role AS PMR
INNER JOIN permitions PER ON PMR.Permitions_FK=PER.Permitions_id
INNER JOIN module_role MROL ON PMR.Module_role_FK=MROL.Module_role_id
WHERE MROL.Module_role_id=?;
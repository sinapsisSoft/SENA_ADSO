/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import {Router} from 'express';
import {showUser,showUserId,addUser,updateUser,deleteUser} from '../controllers/user.controller.js';

const router=Router();
const apiName='/user';

router.route(apiName)
  .get(showUser)  // Get all user
  .post(addUser); // Add user

router.route(`${apiName}/:id`)
  .get(showUserId)  // Get user by Id
  .put(updateUser)  // Update user by Id
  .delete(deleteUser); // Delete user by Id

export default router;
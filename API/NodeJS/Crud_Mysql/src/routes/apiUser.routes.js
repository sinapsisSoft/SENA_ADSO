/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import { Router } from 'express';
import { showApiUser, showApiUserId, addApiUser, updateApiUser, deleteApiUser, loginApiUser } from '../controllers/apiUser.controller.js';

const router = Router();
const apiName = '/apiUser';

router.route(apiName)
  .get(showApiUser)  // Get all user
  .post(addApiUser); // Add user

router.route('/apiUserLogin')
  .post(loginApiUser); // Login

router.route(`${apiName}/:id`)
  .get(showApiUserId)  // Get user by Id
  .put(updateApiUser)  // Update user by Id
  .delete(deleteApiUser); // Delete user by Id

export default router;
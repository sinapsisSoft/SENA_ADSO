/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import {Router} from 'express';
import {showUserStatus,showUserStatusId,addUserStatus,updateUserStatus,deleteUserStatus} from '../controllers/userStatus.controller.js';

const router=Router();
const apiName='/userStatus';

router.route(apiName)
  .get(showUserStatus)  // Get all UserStatus
  .post(addUserStatus); // Add UserStatus

router.route(`${apiName}/:id`)
  .get(showUserStatusId)  // Get UserStatus by Id
  .put(updateUserStatus)  // Update UserStatus by Id
  .delete(deleteUserStatus); // Delete UserStatus by Id

export default router;
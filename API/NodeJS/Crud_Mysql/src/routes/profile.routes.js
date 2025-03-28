/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import {Router} from 'express';
import {showProfile,showProfileId,addProfile,updateProfile, deleteProfile} from '../controllers/profile.controller.js';

const router=Router();
const apiName='/profile';

router.route(apiName)
  .get(showProfile)  // Get all profile
  .post(addProfile); // Add profile

router.route(`${apiName}/:id`)
  .get(showProfileId)  // Get profile by Id
  .put(updateProfile)  // Update profile by Id
  .delete(deleteProfile); // Delete profile by Id

export default router;
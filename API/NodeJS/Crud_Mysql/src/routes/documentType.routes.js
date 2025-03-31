/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import {Router} from 'express';
import {showDocumentType,showDocumentTypeId,addDocumentType,updateDocumentType,deleteDocumentType} from '../controllers/documentType.controller.js';

const router=Router();
const apiName='/documentType';

router.route(apiName)
  .get(showDocumentType)  // Get all Role
  .post(addDocumentType); // Add Role

router.route(`${apiName}/:id`)
  .get(showDocumentTypeId)  // Get Role by Id
  .put(updateDocumentType)  // Update Role by Id
  .delete(deleteDocumentType); // Delete Role by Id

export default router;
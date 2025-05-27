/**
*Author: 	DIEGO CASALLAS
*Date:		27/05/2025  
*Description:	Index file for the API - NODEJS
**/
import { Router } from 'express';
import { showMysql} from '../controllers/testMysql.controller.js';

const router = Router();
const apiName = '/testMysql';

router.route(apiName)
  .get(showMysql)  // Get all tables in the MySQL database

export default router;
/*
  author: Diego Casallas
  date: 14/07/2025  
  description: Backend application using Node.js and MongoDB.
  version: 1.0.0    
  license: MIT License
*/

import { Router } from "express";
import AuthController from '../controllers/auth.controller.js'; 
import {verifyToken} from '../middleware/authMiddleware.js'; 
const router = Router();

// Public route
router.post('/auth/register',verifyToken, AuthController.register);
router.post('/auth/login', AuthController.login);

export default router;
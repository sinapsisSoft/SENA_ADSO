/*
  author: Diego Casallas
  date: 14/07/2025  
  description: Backend application using Node.js and MongoDB.
  version: 1.0.0    
  license: MIT License
*/
import { Router } from "express";
import UserController from '../controllers/user.controller.js'; 
import {verifyToken} from '../middleware/authMiddleware.js'; 

const router = Router();
const name="/user";
// Verify token middleware
router.use(verifyToken);
// Route for user registration and list
router.route(name)
.post(UserController.addUser)
.get(UserController.show);
//Route for user by ID
 router.route(`${name}/:id`)
  .get(UserController.findById)
  .put(UserController.update)
  .delete(UserController.delete);

export default router;
import { Router } from "express";
import UserController from '../controllers/user.controller.js';
import { verifyToken } from '../middleware/authMiddleware.js';
const router = Router();
const name = '/user';
const nameLogin = '/login';
// Public route
router.route(name)
  .post(UserController.register) // Register a new user
  .get(UserController.show);// Show all users

router.route(`${name}/:id`)
  .get(verifyToken, UserController.findById)// Show a user by ID
  .put(verifyToken, UserController.update)// Update a user by ID
  .delete(verifyToken, UserController.delete);// Delete a user by ID

//Login route
router.route(nameLogin)
  .post(UserController.login);// Login a user

export default router;
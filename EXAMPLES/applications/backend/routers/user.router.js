import { Router } from "express";
import UserController from '../controllers/user.controller.js';
const router = Router();
const name = '/user';
const nameLogin = '/login';
// Public route
router.route(name)
  .post(UserController.register) // Register a new user
  .get(UserController.show);// Show all users

router.route(`${name}/:id`)
  .get(UserController.findById)// Show a user by ID
  .put(UserController.update)// Update a user by ID
  .delete(UserController.delete);// Delete a user by ID

//Login route
router.route(nameLogin)
  .post(UserController.login);// Login a user

export default router;
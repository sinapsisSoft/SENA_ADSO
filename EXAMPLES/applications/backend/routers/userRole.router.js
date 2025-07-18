import { Router } from "express";
import UserRoleController from '../controllers/userRole.controller.js';
const router = Router();
const name = '/userRole';
const nameUserRole = '/userIdRole';

// Public route
router.route(name)
  .post(UserRoleController.register) // Register a new user
  .get(UserRoleController.show);// Show all users

router.route(`${name}/:id`)
  .get(UserRoleController.findById)// Show a user by ID
  .put(UserRoleController.update)// Update a user by ID
  .delete(UserRoleController.delete);// Delete a user by ID

  //Login route
  router.route(`${nameUserRole}/:id`)
    .get(UserRoleController.showRoleUser);// Login a user

export default router;
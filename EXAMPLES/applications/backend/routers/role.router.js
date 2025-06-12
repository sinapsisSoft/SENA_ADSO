import { Router } from "express";
import RoleController from '../controllers/role.controller.js';
import { verifyToken } from '../middleware/authMiddleware.js';
// Importing necessary modules
const router= Router();
const name='/role';
// Public route
router.route(name)
  .post(RoleController.register) // Register a new user
  .get(RoleController.show);// Show all users

router.route(`${name}/:id`)
  .get(RoleController.findById)// Show a user by ID
  .put(RoleController.update)// Update a user by ID
  .delete(RoleController.delete);// Delete a user by ID

export default router;
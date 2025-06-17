import { Router } from "express";
import ProfileController from "../controllers/profile.controller.js";
const router = Router();
const name = '/profile';

// Public route


router.route(name)
  .post(ProfileController.register) // Register a new profile
  .get(ProfileController.show);// Show all profile

router.route(`${name}/:id`)
  .get(ProfileController.findById)// Show a profile by ID
  .put(ProfileController.update)// Update a profile by ID
  .delete(ProfileController.delete);// Delete a profile by ID


export default router;
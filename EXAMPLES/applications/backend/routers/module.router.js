import { Router } from "express";
import ModuleController from '../controllers/module.controller.js';
const router = Router();
const name = '/module';
const nameUserRole = '/moduleUserRole';

// Public route
router.route(name)
  .post(ModuleController.register) // Register a new module
  .get(ModuleController.show);// Show all module

router.route(`${name}/:id`)
  .get(ModuleController.findById)// Show a module by ID
  .put(ModuleController.update)// Update a module by ID
  .delete(ModuleController.delete);// Delete a module by ID

  // Public route
router.route(nameUserRole)
  .post(ModuleController.modulesByUserRole) // Get modules by user role



export default router;
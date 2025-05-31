import { Router } from "express";
import ProfileController from '../controllers/profile.controller.js';
const router = Router();
const name = '/profile';

// Public route
router.post(name, ProfileController.register);
router.get(name + '/', ProfileController.show);
router.get(name + '/:id', ProfileController.findById);
router.put(name + '/:id', ProfileController.update);
router.delete(name + '/:id', ProfileController.delete);

export default router;
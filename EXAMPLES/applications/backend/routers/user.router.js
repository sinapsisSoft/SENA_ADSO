import { Router } from "express";
import UserController from '../controllers/user.controller.js';
const router = Router();
const name = '/user';
const nameLogin = '/login';
// Public route
router.post(name, UserController.register);
router.get(name + '/', UserController.show);
router.get(name + '/:id', UserController.findById);
router.put(name + '/:id', UserController.update);
router.delete(name + '/:id', UserController.delete);
//Login route
router.post(nameLogin, UserController.login);
export default router;
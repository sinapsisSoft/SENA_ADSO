import { Router } from "express";
import UserStatusController from '../controllers/userStatus.controller.js';
const router= Router();
const name='/userStatus';
// Public route
router.post(name, UserStatusController.register);
router.get(name+'/',UserStatusController.show);
router.get(name+'/:id',UserStatusController.findById);
router.put(name+'/:id', UserStatusController.update);
router.delete(name+'/:id',UserStatusController.delete);

export default router;
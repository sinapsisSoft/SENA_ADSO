import { Router } from "express";
import RoleController from '../controllers/role.controller.js';
const router= Router();
const name='/role';
// Public route
router.post(name, RoleController.register);
router.get(name+'/',RoleController.show);
router.get(name+'/:id',RoleController.findById);
router.put(name+'/:id', RoleController.update);
router.delete(name+'/:id',RoleController.delete);

export default router;
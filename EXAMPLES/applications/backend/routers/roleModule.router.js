import { Router } from "express";
import RoleModuleController from '../controllers/roleModule.controller.js';
const router= Router();
const name='/roleModule';
// Public route
router.post(name, RoleModuleController.register);
router.get(name+'/',RoleModuleController.show);
router.get(name+'/:id',RoleModuleController.findById);
router.put(name+'/:id', RoleModuleController.update);
router.delete(name+'/:id',RoleModuleController.delete);

export default router;
import { Router } from "express";
import RoleController from "../controllers/role.controller.js";

const router=Router();
router.post('/role',RoleController.createRole);
router.get('/role',RoleController.showRole);
router.get('/role',RoleController.showIdRole);
router.put('/role',RoleController.updateRole);
router.delete('/role',RoleController.deleteRole);
export default router

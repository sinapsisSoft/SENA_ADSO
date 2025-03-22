import { Router } from "express";
import UserStatusController from "../controllers/userStatus.controller.js";
const router=Router();
router.post('/userStatus',UserStatusController.createUserStatus);
router.get('/userStatus',UserStatusController.showUserStatus);
router.get('/userStatus',UserStatusController.showIdUserStatus);
router.put('/userStatus',UserStatusController.updateUserStatus);
router.delete('/userStatus',UserStatusController.deleteUserStatus);
export default router;

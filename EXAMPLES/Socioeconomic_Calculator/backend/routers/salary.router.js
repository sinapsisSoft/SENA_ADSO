import { Router } from "express";
import salaryClassifier from "../controllers/salary.controller.js";

const router=Router();
router.post('/classify',salaryClassifier);
export default router;
import { Router } from "express";
import salaryClassifier from "../controllers/salary.controller.js";

const router=Router();
router.get('/classify',salaryClassifier);
export default router;
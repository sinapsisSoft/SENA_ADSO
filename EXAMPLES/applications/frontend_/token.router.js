import { Router } from "express";
import { verifyToken } from '../controllers/token.controller.js';
const router = Router();
const name = '/validate-token';

// Public route
router.post(name, verifyToken);

export default router;
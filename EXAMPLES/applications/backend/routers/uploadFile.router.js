import { Router } from "express";
import { uploadFile } from "../controllers/uploadFile.controller.js";

const router= Router();
router.post("/upload", uploadFile);
export default router;
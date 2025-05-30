import { Router } from "express";
import DocumentTypeController from '../controllers/documentType.controller.js';
const router= Router();
const name='/documentType';
// Public route
router.post(name, DocumentTypeController.register);
router.get(name+'/',DocumentTypeController.show);
router.get(name+'/:id',DocumentTypeController.findById);
router.put(name+'/:id', DocumentTypeController.update);
router.delete(name+'/:id',DocumentTypeController.delete);

export default router;
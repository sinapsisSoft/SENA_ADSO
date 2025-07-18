import { Router } from "express";
import { fileController } from '../controllers/file.controller.js';
import { verifyToken } from '../middleware/authMiddleware.js';

const router = Router();
const name = '/files';

router.use(verifyToken);

router.route(`${name}/upload`)
  .post(fileController.uploadFile) //upload file

router.route(`${name}`)
  .get(fileController.getFiles); //search files

router.route(`${name}/download/:filename`)
  .get(fileController.downloadFile); // download file

router.route(`${name}/:filename`)
  .get(fileController.getFile) // get file details for name
  .delete(fileController.deleteFile); // delete file for name

export default router;

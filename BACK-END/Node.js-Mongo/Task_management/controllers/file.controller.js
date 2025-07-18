import path from 'path';
import { upload, getFilePath, fileExists, getFilesPath } from '../config/files/filesConfig.js';
import fs from 'fs';

export const fileController = {
  /**
   * uploadFile
   */
  uploadFile: [
    upload.single('file'),
    async (req, res) => {
      try {
        if (!req.file) {
          return res.status(400).json({ error: 'Did not upload any files' });
        }
        res.status(201).json({
          message: 'File uploaded successfully',
          name: req.file.filename,
          originalName: req.file.originalname,
          size: req.file.size,
          mimetype: req.file.mimetype,
          url: getFilePath(req.file.filename),
          extension: path.extname(req.file.filename).toLowerCase(),
          uploadedAt: new Date()
        });
      } catch (error) {
        console.error('Error uploading file :', error);
        res.status(500).json({
          error: error.message || 'Error uploading file.'
        });
      }
    }
  ],

  /**
   * Search  all files and return their details
   */
  getFiles: async (req, res) => {
    try {
      const filePath = getFilesPath;
      const fileStats = await fs.readdirSync(filePath);
      if (fileStats.length === 0) {
        return res.status(404).json({ error: 'No files found.' });
      }
      res.json({
        files: fileStats.map(file => {
          const filePath = getFilePath(file);
          const stats = fs.statSync(filePath);
          return {
            name: file,
            originalName: stats.originalName,
            size: stats.size,
            createdAt: stats.birthtime,
            updatedAt: stats.mtime,
            uploadedAt: stats.ctime,
            mimetype: stats.mimetype || 'application/octet-stream', // Default type, can be improved
            extension: path.extname(file).toLowerCase(),
            url: filePath,
          }
        }
        )
      });
    } catch (error) {
      console.error('Error to search the file:', error);
      res.status(500).json({ error: 'Error searching the file.' });
    }
  },

  /**
   * Search for a file by filename and return its details
   */
  getFile: async (req, res) => {
    try {
      const { filename } = req.params;
      if (!await fileExists(filename)) {
        return res.status(404).json({ error: 'File not found' });
      }
      const filePath = getFilePath(filename);
      const fileStats = await fs.statSync(filePath);
      res.json({
        name: filename,
        url: filePath,
        size: fileStats.size,
        extension: path.extname(filename).toLowerCase(),
        createdAt: fileStats.birthtime,
        updatedAt: fileStats.mtime
      });
    } catch (error) {
      console.error('Error al buscar archivo:', error);
      res.status(500).json({ error: 'Error al buscar el archivo.' });
    }
  },

  /**
   * Delete a file by filename
   */
  deleteFile: async (req, res) => {
    try {
      const { filename } = req.params;
      if (!await fileExists(filename)) {
        return res.status(404).json({ error: 'Archivo no encontrado.' });
      }
      const filePath = getFilePath(filename);
      await fs.unlinkSync(filePath);
      res.json({
        message: 'delete file: ' + filePath + ' successfully',
        filename
      });
    } catch (error) {
      console.error('Error delete file:', error);
      res.status(500).json({ error: 'Error  delete file.' });
    }
  },

  /**
   * Download a file by filename
   */
  downloadFile: async (req, res) => {
    try {
      const { filename } = req.params;
      const filePath = getFilePath(filename);
      if (!await fileExists(filename)) {
        return res.status(404).json({ error: 'File not found.' });
      }
      res.download(filePath, filename, (err) => {
        if (err) {
          console.error('Error Downloading file:', err);
          res.status(500).json({ error: 'Error downloading file.' });
        }
      });
    } catch (error) {
      console.error('Error download file:', error);
      res.status(500).json({ error: 'Error downloading file.' });
    }
  }
};
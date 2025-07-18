import multer from 'multer';
import path from 'path';
import { fileURLToPath } from 'url';
import fs from 'fs/promises';

// Get the current directory and file path
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Configurations for file uploads
const UPLOAD_DIR = path.join(__dirname, '../../uploads');
// Define the path for the uploads directory
export const getFilesPath = UPLOAD_DIR;

// Create the uploads directory if it doesn't exist
const ensureUploadsDir = async () => {
  try {
    await fs.access(UPLOAD_DIR);
  } catch {
    await fs.mkdir(UPLOAD_DIR, { recursive: true });
  }
};

// Configure Multer storage
const storage = multer.diskStorage({
  destination: async (req, file, cb) => {
    await ensureUploadsDir();
    cb(null, UPLOAD_DIR);
  },
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    const sanitizedName = file.originalname.replace(/[^a-zA-Z0-9._-]/g, '');
    cb(null, `${uniqueSuffix}-${sanitizedName}`);
  }
});

// Filter to allow only specific file types
const fileFilter = (req, file, cb) => {
  const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
  if (allowedTypes.includes(file.mimetype)) {
    cb(null, true);
  } else {
    cb(new Error('Allowed files types: JPEG, PNG, GIF and PDF.'), false);
  }
};

// Configure Multer upload
export const upload = multer({
  storage,
  limits: { fileSize: 5 * 1024 * 1024 }, // Límite de 5MB
  fileFilter
});

// Funtion to get the full path of a file
export const getFilePath = (filename) => path.join(UPLOAD_DIR, filename);

// Function to check if a file exists
export const fileExists = async (filename) => {
  try {
    await fs.access(getFilePath(filename));
    return true;
  } catch {
    return false;
  }
};
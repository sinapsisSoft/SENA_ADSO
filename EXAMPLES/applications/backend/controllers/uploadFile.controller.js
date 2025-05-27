import multer from 'multer';
import path from 'path';
import { fileURLToPath } from 'url';
import { dirname } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const pathImg = '../data/uploads';

const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, path.join(__dirname, pathImg));
  },
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    cb(null, uniqueSuffix + '-' + file.originalname);
  }
});

const fileFilter = (req, file, cb) => {
  const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
  if (allowedTypes.includes(file.mimetype)) {
    cb(null, true);
  } else {
    cb(new Error('Invalid file type. Only JPEG, PNG, and GIF are allowed.'), false);
  }
};

const upload = multer({
  storage: storage,
  limits: { fileSize: 5 * 1024 * 1024 }, // Limit file size to 5MB
  fileFilter: fileFilter
});

export const uploadFile=[
  upload.single('file'), // 'file' is the name of the form field
  (req, res) => {
    try {
      if(!req.file) {
        return res.status(400).json({ error: 'No file uploaded.' });
      }
      res.status(200).json({
        message: 'File uploaded successfully',
        file: req.file
      });
    } catch (error) {
      console.error(error);
      res.status(500).json({ error: 'An error occurred while uploading the file.' });
    }

  } 
];
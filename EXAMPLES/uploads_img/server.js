const express = require('express');
const multer = require('multer');
const path = require('path');
const app = express();
const port = 3000;

/* The line `const UPLOAD_PATH = path.join(__dirname, 'uploads');` is defining the directory path where
the uploaded images will be stored. */
const UPLOAD_PATH = path.join(__dirname, 'uploads');

/* The `const storage = multer.diskStorage({ ... })` code block is configuring the storage settings for
multer, a middleware for handling file uploads in Node.js applications. Here's a breakdown of what
each part of this configuration does: */
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, UPLOAD_PATH);
  },
  filename: (req, file, cb) => {
    /* The code snippet you provided is part of the configuration for storing uploaded files with
    unique filenames using multer in a Node.js application. Here's a breakdown of what it does: */
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
    const fileExtension = path.extname(file.originalname);
    cb(null, file.fieldname + '-' + uniqueSuffix + fileExtension);
  }
});

const upload = multer({ storage: storage });

/* The line `app.use(express.static('public'));` is setting up a static file server in your Express
application. It tells Express to serve static files from the 'public' directory. */
app.use(express.static('public'));

/* This code snippet is defining a route in your Express application that handles POST requests to the
'/upload' endpoint. Here's a breakdown of what it does: */
app.post('/upload', upload.single('image'), (req, res) => {
  if (!req.file) {
    return res.status(400).send('No se ha seleccionado ningún archivo.');
  }
/* The line `const imagePath = `/uploads/${req.file.filename}`;` is creating a variable `imagePath`
that stores the path to the uploaded image file. */
  const imagePath = `/uploads/${req.file.filename}`;

  /* The `res.send(` ... `);` block of code is sending a response back to the client after a successful
  image upload. It is sending an HTML response that includes a message confirming the successful
  upload of the image. The HTML structure includes a title, a heading indicating the successful
  upload, an image tag displaying the uploaded image using the `imagePath` variable, and a link to
  upload another image. */
  res.send(`
         <!DOCTYPE html>
         <html>
         <head>
             <title>Imagen Subida</title>
         </head>
         <body>
             <h1>Imagen subida exitosamente</h1>
             <img src="${imagePath}" alt="Imagen subida" style="max-width: 500px;">
             <p><a href="/">Subir otra imagen</a></p>
         </body>
         </html>
     `);
});

/* The `app.listen(port, () => { ... });` code block is starting the Express server and listening for
incoming HTTP requests on the specified port. Here's a breakdown of what it does: */
app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
  console.log(`Las imágenes se guardarán en: ${UPLOAD_PATH}`);
});
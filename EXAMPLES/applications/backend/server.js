/**
 * Author:Diego Casallas
 * Date: 2025-05-19
 * Description: This is the main server file for the backend of the application.
*/
import express from 'express';
import cors from 'cors';
import uploadFile from './routers/uploadFile.router.js';
//import salaryRouter from './routers/salary.router.js';


const app = express();
const PORT = 3000;

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

//app.use('/api_v1',salaryRouter);
app.use('/api_v1',uploadFile);


app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});

/**
 * Author:Diego Casallas
 * Date: 2025-05-27
 * Description: 
*/
import express from 'express';
import cors from 'cors';
/* The routers are imported to handle specific routes in the application.*/
import uploadFile from '../routers/uploadFile.router.js';
import salaryRouter from '../routers/salary.router.js';
import testMysqlRouter from '../routers/testMysql.router.js';

const app = express();

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Prefix for all profile routes, facilitating scalability
app.use('/api_v1',salaryRouter);
app.use('/api_v1',uploadFile);
app.use('/api_v1',testMysqlRouter);

app.use((rep, res, nex) => {
  res.status(404).json({
    message: 'Endpoint losses'
  });
});

export default app;
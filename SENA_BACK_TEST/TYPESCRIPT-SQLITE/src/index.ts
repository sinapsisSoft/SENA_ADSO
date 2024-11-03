import express from "express";
import cors from 'cors';
import studentRoutes from './routes/student-routes';

//Declared
const app=express();
const port=3000;

//middleware

app.use(cors());
app.use(express.json());

//routes
app.use('/api-v1',studentRoutes);

app.listen(port,()=>{
  console.log(`Listener Server http://localhost:${port}`);
})
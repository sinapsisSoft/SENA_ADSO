import express from 'express';
import personRoutes from './routes/person.routes.js';

const app=express();

app.use(express.json());
app.use('/api',personRoutes);

app.use((rep,res,nex)=>{
  res.status(404).json({
    Message:'Endpoint losses'
  });
});


app.listen(3000);
console.log("Server running....");

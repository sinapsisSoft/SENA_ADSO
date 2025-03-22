import express from 'express';
import morgan from 'morgan';
import userRoutes from '../routers/user.router.js';
import userStatusRoutes from '../routers/userStatus.router.js';
import rolesRoutes from '../routers/role.router.js';

const app=express();
app.use(morgan('dev'));

app.use(express.json());
app.use(express.urlencoded({extended:true}));

app.use('/api/v1',userRoutes);
app.use('/api/v1',userStatusRoutes);
app.use('/api/v1',rolesRoutes);

app.use((rep,res,next)=>{
  res.status(404).json({
    message:'Endpoint losses...'
  });
});
export default app;



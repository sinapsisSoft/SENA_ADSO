/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import express from 'express';
import { connect } from '../db/connect.js';
import  profileRoutes  from './routes/profile.routes.js';

const app=express();
const PORT=3000;

app.get('/api_v1/ping',async (req,res)=>{
  const result=await connect.query('SHOW TABLES');
  res.json(result[0]);
});

app.use(profileRoutes);

app.listen(PORT,()=>console.log("Server running... on port "+PORT));
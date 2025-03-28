/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import express from 'express';
import  profileRoutes  from './routes/profile.routes.js';

const app = express();
const PORT = process.env.PORT || 3000; // Allow dynamic port configuration

// Middleware to handle JSON
app.use(express.json());

// Prefix for all profile routes, facilitating scalability
app.use('/api_v1', profileRoutes);

// Start the server
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));

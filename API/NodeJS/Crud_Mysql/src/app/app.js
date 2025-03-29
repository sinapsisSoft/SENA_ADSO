import express from 'express';
import profileRoutes from '../routes/profile.routes.js';
import userRoutes from '../routes/user.routes.js';
import userStatusRoutes from '../routes/userStatus.routes.js';
import roleRoutes from '../routes/role.routes.js';
import userApiRoutes from '../routes/apiUser.routes.js';

const app = express();
// Middleware to handle JSON
app.use(express.json());
// Prefix for all profile routes, facilitating scalability
app.use('/api_v1', profileRoutes);
app.use('/api_v1', userRoutes);
app.use('/api_v1', userStatusRoutes);
app.use('/api_v1', roleRoutes);
app.use('/api_v1', userApiRoutes);

app.use((rep, res, nex) => {
  res.status(404).json({
    message: 'Endpoint losses'
  });
});

export default app;
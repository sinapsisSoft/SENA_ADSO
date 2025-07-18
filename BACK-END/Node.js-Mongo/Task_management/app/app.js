import express from 'express';
import { connectDB } from '../config/db/connection.js'; // Import the connection
// Import routes
import authRouter from '../routes/auth.routes.js';
import userRouter from '../routes/user.routes.js';
import taskRouter from '../routes/task.routes.js';
import emailRouter from '../routes/email.routes.js';
import filesRouter from '../routes/file.routes.js';

const app = express();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Connect to MongoDB
connectDB();// Call the connection function

// Use routes
app.use('/api', authRouter);
app.use('/api', userRouter);
app.use('/api', taskRouter);
app.use('/api', emailRouter);
app.use('/api', filesRouter);

app.use((rep, res, nex) => {
  res.status(404).json({
    message: 'Endpoint losses'
  });
});

export default app;
import mongoose from 'mongoose';
import dotenv from 'dotenv';

dotenv.config();
const MONGODB_URI = process.env.MONGODB_URI || 'mongodb://127.0.0.1:27017/task_app';
// Function to connect to MongoDB
export const connectDB = async () => {
  try {
    await mongoose.connect(MONGODB_URI);
    console.log('Connected to MongoDB');
  } catch (error) {
    console.error('Error connecting to MongoDB:', error.message);
    process.exit(1); // Exit the process with error
  }
};
// Connection events
mongoose.connection.on('connected', () => {
  //console.log(' Connected to MongoDB');
});
mongoose.connection.on('error', (err) => {
  console.log('Error connecting to MongoDB:', err);
});
mongoose.connection.on('disconnected', () => {
  console.log('Mongoose offline');
});
// Export the connection and mongoose in case it is needed
export { mongoose };
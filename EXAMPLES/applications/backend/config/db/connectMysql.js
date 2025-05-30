import dotenv from 'dotenv';
import { createPool } from "mysql2/promise";


dotenv.config();
// Database configuration
const dbConfig = {
  host:process.env.DB_HOST|| 'localhost',
  user:process.env.DB_USER|| 'root',
  password:process.env.DB_PASSWORD|| '',
  database:process.env.DB_NAME|| 'crud_node',
  port:process.env.DB_PORT||'3306'
};
export const connect = createPool(dbConfig);
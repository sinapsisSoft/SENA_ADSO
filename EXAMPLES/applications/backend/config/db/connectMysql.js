import dotenv from 'dotenv';
import { createPool } from "mysql2/promise";

dotenv.config();
export const connect = createPool({
  host:process.env.DB_HOST,
  user:process.env.DB_USER,
  password:process.env.DB_PASSWORD,
  database:process.env.DB_NAME,
  port:process.env.DB_PORT
});
import jwt from "jsonwebtoken";
import dotenv from "dotenv";

dotenv.config();

// Middleware to verify the token
export const verifyToken = (req, res, next) => {
  const token = req.header("Authorization");
  if (!token) return res.status(401).json({ error: "Access denied" });

  try {
    const verified = jwt.verify(token.replace("Bearer ", ""), process.env.JWT_SECRET);
    req.user = verified;
    //See data token encrypted
    //console.log(verified);
    next();
  } catch (err) {
    res.status(400).json({ error: "Invalid Token" });
  }
};
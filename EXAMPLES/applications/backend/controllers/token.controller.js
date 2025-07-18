import jwt from "jsonwebtoken";
import dotenv from "dotenv";

dotenv.config();

// Middleware to verify the token
export const verifyToken = (req, res) => {
  const token = req.header("Authorization");
  if (!token) return res.status(401).json({ error: "Access denied" });

  try {
    const verified = jwt.verify(token.replace("Bearer ", ""), process.env.JWT_SECRET);
    res.status(200).json({message:"Verified", valid: true,data: verified});
  } catch (err) {
    res.status(400).json({ error: "Invalid Token",valid: false });
  }
};
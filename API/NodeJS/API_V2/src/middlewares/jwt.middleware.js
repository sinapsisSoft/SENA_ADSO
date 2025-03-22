
import jwt from 'jsonwebtoken';
const verifyToken = (req, res, next) => {
 
  try {
    let token = req.headers.authorization;
    if (!token) {
      return res.status(401).json({ error: "Token not provided" });
    } 
    token = token.split(" ")[1];
    const { email } = jwt.verify(token, process.env.JWK_SECRET);
    console.log(email);
    next();
  } catch (err) {
    return res.status(400).json({ error: "Invalid Token not provided "+err.message });
  }
}
export default verifyToken;
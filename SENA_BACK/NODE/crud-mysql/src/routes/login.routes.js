/**
 * Author:DIEGO CASALLAS
 * Date:03/11/2024
 * Descriptions:The route controller manager for login user data
*/

/* The code snippet is importing necessary modules and setting up variables for the route controller
manager for login user data. Here's a breakdown: */
const { Router } = require("express");
const DBConnection = require('../config/dbConnection');
const bcrypt = require('bcrypt');
const saltRounds = 10;
const router = Router();

/* This code snippet is defining a POST route handler using Express.js. Here's a breakdown of what it
does: */
router.post('/', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getUser = await db.query(`SELECT * FROM user WHERE user_user="${req.body.user}"`);
    if (Object.keys(getUser).length != 0) {
      const isMatch = await bcrypt.compare(req.body.password, getUser[0]['user_password']);
      if (isMatch) {
        res.json({ message: "Method Post : Successful Entry", data: 'ok', status: 200});
      } else {
        res.json({ message: "Method Post : Password Error", data: 'error', status: 404 });
      }
    } else {
      res.json({ message: "Method Post : The user not created", data: 'error', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Post ", data: err.message,status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})

module.exports = router;
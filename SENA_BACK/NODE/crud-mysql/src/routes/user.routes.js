/**
 * Author:DIEGO CASALLAS
 * Date:02/11/2024
 * Descriptions:The route controller manages user data,sending data to the database
*/
/* This code snippet is importing necessary modules and setting up initial configurations for the route
controller. Here's a breakdown: */
const { Router } = require("express");
const DBConnection = require('../config/dbConnection');
const bcrypt = require('bcrypt');
const saltRounds = 10;
const router = Router();

/* This specific code block defines a route that handles a GET request to retrieve all records from the
"user" table in the database. Here is a breakdown of what the code is doing: */
router.get('/', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    // Execute a query
    const results = await db.query(`SELECT * FROM user`);
    if (Object.keys(results).length != 0) {
      res.json({ message: "Method Get", data: results, status: 200 });
    } else {
      res.json({ message: "there are no records", data: results, status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Get", data: err.message, status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
});

/* This specific code block defines a route that handles a GET request with a dynamic parameter `:id`.
When a GET request is made to this route with a specific user ID provided in the URL, the code
attempts to retrieve information about that particular user from the database. */
router.get('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    // Execute a query
    const getUser = await db.query(`SELECT * FROM user WHERE user_id=${req.params.id}`);
    if (Object.keys(getUser).length != 0) {
      res.json({ message: "Method Get Id", data: getUser, status: 200 });
    } else {
      res.json({ message: "Unregistered user", data: getUser, status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Get Id", data: err.message, status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})

/* The `router.post('/', async (req, res) => { ... }` function is handling a POST request to insert a
new user record into the database. Here is a breakdown of what the code is doing: */
router.post('/', async (req, res) => {
  const db = new DBConnection();
  try {
    const hashedPassword = await bcrypt.hash(req.body.password, saltRounds);
    var dataQry = [req.body.user, hashedPassword, req.body.status, req.body.role];
    var qry = `INSERT INTO user (user_user,user_password,userStatus_fk,role_fk) VALUES(?,?,?,?);`;
    await db.connect();
    // Execute a query
    const results = await db.query(qry, dataQry);
    if (Object.keys(results).length != 0) {
      res.json({ message: "Method Post ", data: 'ok', status: 200 });
    } else {
      res.json({ message: "Method Post ", data: 'error', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Post ", data: err.message, status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})

/* The `router.put('/:id', async (req, res) => { ... }` function is handling a PUT request to update a
specific user's information based on the user ID provided in the URL parameter. Here is a breakdown
of what the code is doing: */
router.put('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    
    await db.connect();
    const getUser = await db.query(`SELECT * FROM user WHERE user_id=${req.params.id}`);
    if (Object.keys(getUser).length != 0) {
      var dataQry = [req.body.status, req.body.role];
      var qry = `UPDATE user SET userStatus_fk=?,role_fk=? WHERE user_id=${req.params.id};`;
      // Execute a query
      const results = await db.query(qry, dataQry);

      if (Object.keys(results).length != 0) {
        res.json({ message: "Method Put", data: "ok", status: 200 });
      }else{
        res.json({ message: "Error Put", data: "error", status: 404 });
      }
    } else {
      res.json({ message: "Unregistered user", data: results, status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Put", data: err.message, status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})

/* This part of the code defines a route for handling DELETE requests to delete a specific user based
on the user ID. Here is a breakdown of what the code does: */
router.delete('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getUser = await db.query(`SELECT * FROM user WHERE user_id=${req.params.id}`);
    if (Object.keys(getUser).length != 0) {
      var qry = `DELETE from user WHERE user_id=${req.params.id};`;
      // Execute a query
      const results = await db.query(qry);
      if (Object.keys(results).length != 0) {
        res.json({ message: "Method Delete ", data: 'ok', status: 200 });
      } else {
        res.json({ message: "Method Delete ", data: 'error', status: 404 });
      }
    } else {
      res.json({ message: "user not Delete", data: 'error', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Delete ", data: err.message });
  } finally {
    // Close the connection
    await db.close();
  }
})

module.exports = router;
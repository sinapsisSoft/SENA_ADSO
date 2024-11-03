const { Router } = require("express");
const DBConnection = require('../config/dbConnection');

const router = Router();
router.get('/', async (req, res) => {

  const db = new DBConnection();
  try {
    await db.connect();
    // Execute a query
    const results = await db.query('SELECT * FROM user');
    res.json({ message: "Method Get", data: results });
  } catch (err) {
    res.json({ message: "Error Get", data: err.message });
  } finally {
    // Close the connection
    await db.close();
  }
});
router.get('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    // Execute a query
    const results = await db.query(`SELECT * FROM user WHERE user_id=${req.params.id}`);
    res.json({ message: "Method Get Id", data: results });
  } catch (err) {
    res.json({ message: "Error Get Id", data: err.message });
  } finally {
    // Close the connection
    await db.close();
  }
})

router.post('/', async (req, res) => {
  const db = new DBConnection();
  try {
    var dataQry = [req.body.user,req.body.password,req.body.status,req.body.role];
    var qry = `INSERT INTO user (user_user,user_password,userStatus_fk,role_fk) VALUES(?,?,?,?);`;
    await db.connect();
    // Execute a query
    const results = await db.query(qry, dataQry);
    if (results) {
      res.json({ message: "Method Post ", data: 'ok', status: 200 });
    } else {
      res.json({ message: "Method Post ", data: 'error', status: 400 });
    }
  } catch (err) {
    res.json({ message: "Error Post ", data: err.message });
  } finally {
    // Close the connection
    await db.close();
  }
})

router.put('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getUser = await db.query(`SELECT * FROM user WHERE user_id=${req.params.id}`);
    if (getUser) {
      var dataQry = [req.body.status,req.body.role];
      var qry = `UPDATE user SET userStatus_fk=?,role_fk? WHERE user_id=${req.params.id};`;
      // Execute a query
      const results = await db.query(qry, dataQry);
      if (results) {
        res.json({ message: "Method Put ", data: 'ok', status: 200 });
      } else {
        res.json({ message: "Method Put ", data: 'error', status: 400 });
      }
    } else {
      res.json({ message: "user not create", data: 'error', status: 400 });
    }

  } catch (err) {
    res.json({ message: "Error Post ", data: err.message });
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
    if (getUser) {
      var dataQry = [req.body.user_name];
      var qry = `DELETE from user WHERE user_id=${req.params.id};`;
      // Execute a query
      const results = await db.query(qry, dataQry);
      if (results) {
        res.json({ message: "Method Delete ", data: 'ok', status: getUser });
      } else {
        res.json({ message: "Method Delete ", data: 'error', status: 400 });
      }
    } else {
      res.json({ message: "user not Delete", data: 'error', status: 400 });
    }
  } catch (err) {
    res.json({ message: "Error Delete ", data: err.message });
  } finally {
    // Close the connection
    await db.close();
  }
})

module.exports = router;
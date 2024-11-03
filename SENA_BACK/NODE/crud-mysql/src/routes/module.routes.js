/**
 * Author:DIEGO CASALLAS
 * Date:02/11/2024
 * Descriptions:The route controller manager for module database 
*/
const { Router } = require("express");
const DBConnection = require('../config/dbConnection');
const router = Router();

router.get('/', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getModules = await db.query(`SELECT * FROM module`);
    if (Object.keys(getModules).length != 0) {
        res.json({ message: "Method Get : Successful Query", data: getModules, status: 200});
    } else {
      res.json({ message: "Method Get ", data: '', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Get ", data: err.message,status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
});

router.get('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getModule = await db.query(`SELECT * FROM module WHERE module_id=${req.params.id}`);
    if (Object.keys(getModule).length != 0) {
        res.json({ message: "Method Get : Successful Query", data: getModule, status: 200});
    } else {
      res.json({ message: "Method Get ", data: '', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Get ", data: err.message ,status: 404});
  } finally {
    // Close the connection
    await db.close();
  }
})

router.post('/', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    var dataQry = [req.body.module_name,req.body.module_route,req.body.module_description];
    var qry = `INSERT INTO module (module_name,module_route,module_description) VALUES(?,?,?);`;
    const results = await db.query(qry, dataQry);
    if (Object.keys(results).length != 0) {
      res.json({ message: "Method Post ", data: 'ok', status: 200 });
    } else {
      res.json({ message: "Method Post ", data: 'error', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Post ", data: err.message,status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})

router.put('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getModule = await db.query(`SELECT * FROM module WHERE module_id=${req.params.id}`);
    if (Object.keys(getModule).length != 0) {
      var dataQry = [req.body.module_name,req.body.module_route,req.body.module_description];
      var qry = `UPDATE module SET module_name=?,module_route=?,module_description=? WHERE module_id=${req.params.id};`;
      // Execute a query
      const results = await db.query(qry, dataQry);
      if (Object.keys(results).length != 0) {
        res.json({ message: "Method Put ", data: 'ok', status: 200 });
      } else {
        res.json({ message: "Method Put ", data: 'error', status: 404 });
      }
    } else {
      res.json({ message: "module not create", data: 'error', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Post ", data: err.message,status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})


router.delete('/:id', async (req, res) => {
  const db = new DBConnection();
  try {
    await db.connect();
    const getModule = await db.query(`SELECT * FROM module WHERE module_id=${req.params.id}`);
    if (Object.keys(getModule).length != 0) {
      var qry = `DELETE from module WHERE module_id=${req.params.id};`;
      // Execute a query
      const results = await db.query(qry);
      if (Object.keys(results).length != 0) {
        res.json({ message: "Method Delete ", data: 'ok', status: 200 });
      } else {
        res.json({ message: "Method Delete ", data: 'error', status: 404 });
      }
    } else {
      res.json({ message: "module not Delete", data: 'error', status: 404 });
    }
  } catch (err) {
    res.json({ message: "Error Delete ", data: err.message,status: 404 });
  } finally {
    // Close the connection
    await db.close();
  }
})

module.exports = router;
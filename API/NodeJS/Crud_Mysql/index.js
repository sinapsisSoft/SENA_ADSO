/* Author:DIEGO CASALLAS
* Date:20/03/2025
* Descriptions:This is controller back-end User
* **/
/* These lines of code are importing necessary modules and setting up the basic configuration for a
Node.js application using Express framework. Here's a breakdown: */
const express = require("express");
const cors = require('cors');
const db = require("./database");
const bcrypt = require('./appBcrypt');
const app = express();
const port = 3000;


/* The lines `app.use(cors());` and `app.use(express.json());` are setting up middleware in a Node.js
application using Express framework. */
app.use(cors());
app.use(express.json());


/****************ROTES API ROLES */
/* This code snippet is setting up a POST endpoint at "/api_v1/roles" in the Node.js application using
Express framework. When a POST request is made to this endpoint, it expects a JSON object in the
request body with a property named "name". */
app.post("/api_v1/roles", (req, res) => {
    const { name } = req.body;
    db.run("INSERT INTO role (Role_name) VALUES (?)", [name], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ id: this.lastID, name });
    });
});


/* This code snippet is setting up a GET endpoint at "/api_v1/roles" in the Node.js application using
Express framework. When a GET request is made to this endpoint, it queries the database to select
all records from the "role" table. If there is an error during the database query, it will return a
500 status with an error message. If the query is successful, it will return a JSON response
containing the rows retrieved from the database. */
app.get("/api_v1/roles", (req, res) => {
    db.all("SELECT * FROM role", [], (err, rows) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(rows);
    });
});


/* This code snippet defines a GET endpoint at "/api_v1/roles/:id" in the Node.js application using
Express framework. When a GET request is made to this endpoint with a specific role ID parameter, it
queries the database to select a specific record from the "role" table based on the Role_id matching
the provided ID parameter. */
app.get("/api_v1/roles/:id", (req, res) => {
    db.get("SELECT * FROM role WHERE Role_id = ?", [req.params.id], (err, row) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(row);
    });
});


/* This code snippet is setting up a PUT endpoint at "/api_v1/roles/:id" in the Node.js application
using Express framework. When a PUT request is made to this endpoint with a specific role ID
parameter, it expects a JSON object in the request body with a property named "user". */
app.put("/api_v1/roles/:id", (req, res) => {
    const { user } = req.body;
    db.run("UPDATE role SET Role_name = ? WHERE Role_id = ?", [user, req.params.id], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ updated: this.changes });
    });
});


/* This code snippet is setting up a DELETE endpoint at "/api_v1/roles/:id" in the Node.js application
using Express framework. When a DELETE request is made to this endpoint with a specific role ID
parameter, it executes a SQL DELETE query to remove a specific record from the "role" table based on
the Role_id matching the provided ID parameter. */
app.delete("/api_v1/roles/:id", (req, res) => {
    db.run("DELETE FROM role WHERE Role_id = ?", [req.params.id], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ deleted: this.changes });
    });
});

/****************END ROTES API ROLES */

/****************ROTES API USERS */
/* The code snippet `app.post("/api_v1/users", (req, res) => { ... }` is setting up a POST endpoint at
"/api_v1/users" in the Node.js application using Express framework. When a POST request is made to
this endpoint, it expects a JSON object in the request body with properties named "user",
"password", and "role". */
app.post("/api_v1/users", async (req, res) => {
    const { user, password, role } = req.body;
    const hashedPassword = await bcrypt.encryptPassword(password);
    db.run("INSERT INTO users (User_email,User_password,Role_fk) VALUES (?,?,?)", [user, hashedPassword, role], function (err) {
        if (err) return res.status(500).json({status:500, error: err.message });
        res.json({ id: this.lastID, user, hashedPassword, role });
    });
});


/* The code snippet `app.get("/api_v1/users", (req, res) => { ... }` is setting up a GET endpoint at
"/api_v1/users" in the Node.js application using Express framework. */
app.get("/api_v1/users", (req, res) => {
    db.all("SELECT * FROM users", [], (err, rows) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(rows);
    });
});
/* This code snippet defines a GET endpoint at "/api_v1/users/:id" in the Node.js application using
Express framework. When a GET request is made to this endpoint with a specific user ID parameter, it
queries the database to select a specific record from the "users" table based on the User_id
matching the provided ID parameter. If there is an error during the database query, it will return a
500 status with an error message. If the query is successful, it will return a JSON response
containing the user record retrieved from the database. */
app.get("/api_v1/users/:id", (req, res) => {
    db.get("SELECT User_id,User_email AS user,User_password AS password,Role_fk AS role FROM users WHERE User_id = ?", [req.params.id], (err, row) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(row);
    });
});

/* The code snippet `app.put("/api_v1/users/:id", (req, res) => { ... }` is setting up a PUT endpoint
at "/api_v1/users/:id" in the Node.js application using Express framework. */
app.put("/api_v1/users/:id", (req, res) => {
    const { user, role } = req.body;
    db.run("UPDATE users SET User_email = ?,Role_fk=? WHERE User_id = ?", [user, role, req.params.id], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ updated: this.changes });
    });
});
/* The code snippet `app.delete("/api_v1/users/:id", ...)` is setting up a DELETE endpoint at
"/api_v1/users/:id" in the Node.js application using Express framework. When a DELETE request is
made to this endpoint with a specific user ID parameter, it executes a SQL DELETE query to remove a
specific record from the "users" table based on the User_id matching the provided ID parameter. */
app.delete("/api_v1/users/:id", (req, res) => {
    db.run("DELETE FROM users WHERE User_id = ?", [req.params.id], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ deleted: this.changes });
    });
});
/****************END ROTES API USERS */
/****************ROTES API LOGIN */
/* The code snippet `app.post("/api_v1/login", ...)` is setting up a POST endpoint at "/api_v1/login"
in the Node.js application using Express framework. When a POST request is made to this endpoint, it
expects a JSON object in the request body with properties named "user" and "password". */
app.post("/api_v1/login", (req, res) => {
    const { user, password } = req.body;
    db.get("SELECT * FROM users WHERE User_email = ?", [user], async (err, row) => {
        if (err) return res.status(500).json({ status:500,error: "Query error" });
        if (!row) return res.status(401).json({ status:401,error: "User not found" });
        const isMatch = await bcrypt.comparePassword(password, row.User_password);
        if (!isMatch) {
            return res.status(401).json({status:401, message: 'Error password' });
        }
        res.status(200).json({status:200,row});
    });

});
/* The code snippet `app.put("/api_v1/login", ...)` is setting up a PUT endpoint at "/api_v1/login" in
the Node.js application using Express framework. When a PUT request is made to this endpoint, it
expects a JSON object in the request body with a property named "email". */
app.put("/api_v1/login", (req, res) => {
    const { email } = req.body;
    db.get("SELECT * FROM users WHERE User_email= ?", [email], function (err,row) {
        if (err) return res.status(500).json({status:500, error: err.message });
        if (!row) return res.status(401).json({ status:401,error: "User not found" });
        //Send email to change password
        res.status(200).json({status:200,email:row.User_email});
    });
});
/****************END ROTES API LOGIN */


app.listen(port, () => {
    console.log(`Server running http://localhost:${port}`);
});


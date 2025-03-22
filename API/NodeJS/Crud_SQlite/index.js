/* Author:DIEGO CASALLAS
* Date:20/03/2025
* Descriptions:This is controller back-end User
* **/
/* These lines of code are importing necessary modules and setting up the basic configuration for a
Node.js application using Express framework. Here's a breakdown: */
const express = require("express");
const cors = require('cors');
const db = require("./database");
const app = express();
const port = 3000;

/* The lines `app.use(cors());` and `app.use(express.json());` are setting up middleware in a Node.js
application using Express framework. */
app.use(cors());
app.use(express.json());

// User Creation
// POST /users
/* The `app.post("/users", ...)` function is handling a POST request to create a new user in the
database. Here's a breakdown of what it does: */
app.post("/users", (req, res) => {
    const { name, email } = req.body;
    db.run("INSERT INTO users (name, email) VALUES (?, ?)", [name, email], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ id: this.lastID, name, email });
    });
});

// Get data users
/* The `app.get("/users", ...)` function is handling a GET request to retrieve all users from the
database. Here's a breakdown of what it does: */
app.get("/users", (req, res) => {
    db.all("SELECT * FROM users", [], (err, rows) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(rows);
    });
});

// get individual user
/* This code snippet is handling a GET request to retrieve an individual user from the database based
on the provided `id` parameter. Here's a breakdown of what it does: */
app.get("/users/:id", (req, res) => {
    db.get("SELECT * FROM users WHERE id = ?", [req.params.id], (err, row) => {
        if (err) return res.status(500).json({ error: err.message });
        res.json(row);
    });
});

// update user
/* The `app.put("/users/:id", ...)` function is handling a PUT request to update an existing user in
the database based on the provided `id` parameter. Here's a breakdown of what it does: */
app.put("/users/:id", (req, res) => {
    const { name, email } = req.body;
    db.run("UPDATE users SET name = ?, email = ? WHERE id = ?", [name, email, req.params.id], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ updated: this.changes });
    });
});

// delete user
/* The `app.delete("/users/:id", ...)` function is handling a DELETE request to delete a user from the
database based on the provided `id` parameter. Here's a breakdown of what it does: */
app.delete("/users/:id", (req, res) => {
    db.run("DELETE FROM users WHERE id = ?", [req.params.id], function (err) {
        if (err) return res.status(500).json({ error: err.message });
        res.json({ deleted: this.changes });
    });
});

/* The `app.listen(port, () => { console.log(`Server running http://localhost:`); });` code
snippet is starting the Express application server to listen for incoming HTTP requests on the
specified port. */
app.listen(port, () => {
    console.log(`Server running http://localhost:${port}`);
});


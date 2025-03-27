const sqlite3 = require("sqlite3").verbose();
const db = new sqlite3.Database("database.db");

db.serialize(() => {
    db.run("CREATE TABLE IF NOT EXISTS role (Role_id INTEGER PRIMARY KEY, Role_name TEXT UNIQUE)");
    db.run("CREATE TABLE IF NOT EXISTS users (User_id INTEGER PRIMARY KEY, User_email TEXT UNIQUE," 
        +"User_password TEXT, Role_fk INTEGER, FOREIGN KEY(Role_fk) REFERENCES role(Role_id))");
});

module.exports = db;
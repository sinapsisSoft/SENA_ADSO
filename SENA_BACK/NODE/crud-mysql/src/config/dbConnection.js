
/**
 * Author:DIEGO CASALLAS
 * Date:01/11/2024
 * Descriptions:The route controller manages user data,sending data to the database
*/
const mysql = require('mysql');

class DBConnection {
  constructor() {
    this.connection = mysql.createConnection({
      host:'localhost',
      user:'root',
      password:'',
      port:3306,
      database:'crud-node-app' 
    });
  }

// Method to connect to the database
/**
 * The `connect` function establishes a database connection and returns a promise that resolves if the
 * connection is successful and rejects if there is an error.
 * @returns The `connect()` function is returning a Promise.
 */
connect() {
    return new Promise((resolve, reject) => {
      this.connection.connect((err) => {
        if (err) {
          console.error('Connection error:', err.message);
          reject(err);
        } else {
          console.log('Database connection successful');
          resolve();
        }
      });
    });
  }

// Method to query the database
/**
 * The function `query` executes a SQL query using a connection and returns a promise that resolves
 * with the query results or rejects with an error.
 * @param sql - The `sql` parameter in the `query` function is a string that represents the SQL query
 * you want to execute. It can be a SELECT, INSERT, UPDATE, DELETE, or any other valid SQL statement.
 * @param [args] - The `args` parameter in the `query` function is an optional array that contains the
 * values to be used as parameters in the SQL query. These values will be dynamically inserted into the
 * SQL query to prevent SQL injection attacks and to allow for parameterized queries.
 * @returns The `query` function returns a Promise.
 */
  query(sql, args = []) {
    return new Promise((resolve, reject) => {
      this.connection.query(sql, args, (err, results) => {
        if (err) {
          console.error('Query error:', err.message);
          reject(err);
        } else {
          resolve(results);
        }
      });
    });
  }


// Method to close the connection
/* The `close()` method in the DBConnection class is responsible for closing the connection to the
database. It returns a Promise that resolves if the connection is closed successfully and rejects if
there is an error while closing the connection. Inside the method, it calls `this.connection.end()`
to close the connection, and based on whether there is an error or not, it logs the appropriate
message and resolves or rejects the Promise accordingly. */
  close() {
    return new Promise((resolve, reject) => {
      this.connection.end((err) => {
        if (err) {
          console.error('Error closing connection:', err.message);
          reject(err);
        } else {
          console.log('Connection closed successfully');
          resolve();
        }
      });
    });
  }
}

module.exports = DBConnection;
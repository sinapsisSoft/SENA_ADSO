import {connPool} from "../db/connect.js";
/**
 * The function `sleep` returns a promise that resolves after a specified number of milliseconds.
 * @param ms - The `ms` parameter in the `sleep` function represents the number of milliseconds for
 * which the function will pause execution before resolving the promise.
 * @returns The `sleep` function is returning a Promise.
 */
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
/**
 * The function `executeQuery` asynchronously executes a query using a connection from a pool, logs the
 * results, handles errors, and releases the connection after a delay.
 * @param pool - The `pool` parameter in the `executeQuery` function is typically an instance of a
 * connection pool provided by a database library such as `mysql` or `pg`. Connection pools are used to
 * manage and reuse database connections efficiently in applications. They help in improving
 * performance by reducing the overhead of creating and
 * @param query - The `query` parameter in the `executeQuery` function is a SQL query string that you
 * want to execute using the provided `pool` connection pool. This query will be sent to the database
 * for execution, and the results will be logged to the console if the query is successful. If there is
 */
async function executeQuery(pool, query) {
  let connection;
  try {
    // Getting a connection from the pool
    connection = await pool.getConnection();
    const [results, ] = await connection.execute(query);
    console.log(results);
  } catch (error) {
    console.error('Error executing query:', error);
  } finally {
    await sleep(2000);
    // Don't forget to release the connection when finished!
    if (connection) connection.release();
  }
}
const queries = [
  'CREATE TABLE document_type (documentTypeId INT(11) AUTO_INCREMENT PRIMARY KEY,documentTypeName VARCHAR(20) NOT NULL UNIQUE);',
  'CREATE TABLE person (personId INT(11) AUTO_INCREMENT PRIMARY KEY,personName VARCHAR(20) NOT NULL, personLast_name VARCHAR(20) NOT NULL,personDocument VARCHAR(10) NOT NULL,documentTypeFk INT(11) NOT NULL, FOREIGN KEY (documentTypeFk) REFERENCES document_type(documentTypeId));'
];
for (let query of queries) {
  executeQuery(connPool, query);
}

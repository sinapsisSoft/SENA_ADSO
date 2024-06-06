import { connPool } from '../../db/connect.js';

/**
 * The function `createPerson` is an asynchronous function that inserts a new person record into a
 * database table and returns the inserted person's details.
 * @param req - The `req` parameter in the `createPerson` function represents the request object, which
 * contains information about the HTTP request that triggered the function. This object typically
 * includes details such as the request headers, parameters, body, URL, and more. In this specific
 * function, `req.body` is used
 * @param res - The `res` parameter in the `createPerson` function is the response object that is used
 * to send a response back to the client making the request. In this case, it is being used to send a
 * JSON response with the newly created person's details such as `id`, `name`, `
 * @returns The createPerson function is returning an object with the following properties:
 * - id: The insertId of the result from the database query
 * - name: The name extracted from the request body
 * - lastName: The lastName extracted from the request body
 * - document: The document extracted from the request body
 * - documentType: The documentType extracted from the request body
 */
export const createPerson = async (req, res) => {
  try {
    const { name, lastName, document, documentType } = req.body;
    let sqlQuery = "INSERT INTO person (personName,personLast_name,personDocument,documentTypeFk) VALUES(?,?,?,?)";
    const [result] = await connPool.query(sqlQuery, [name, lastName, document, documentType]);
    res.send({
      id: result.insertId,
      name: name,
      lastName: lastName,
      document: document,
      documentType: documentType
    });
  } catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the consultation'
    });
  }
};

/**
 * The function `showPerson` retrieves all records from the "person" table and sends the first result
 * as a JSON response, handling any errors with a 500 status code and an error message.
 * @param req - The `req` parameter typically represents the HTTP request object in Node.js
 * applications. It contains information about the incoming request such as the request headers,
 * parameters, body, and more. In the context of your code snippet, `req` is likely an instance of the
 * request object that is passed to the
 * @param res - The `res` parameter in the `showPerson` function is the response object that is used to
 * send a response back to the client making the request. In this case, it is being used to send a JSON
 * response containing the result of a database query to fetch all records from the "person"
 * @returns The `showPerson` function is returning a JSON response with the data from the first row of
 * the result obtained from the query "SELECT * FROM person". If an error occurs during the query
 * execution, a 500 status response with a JSON object containing the message 'Something went wrong in
 * the consultation' will be returned.
 */
export const showPerson = async (req, res) => {
  try {
    const result = await connPool.query("SELECT * FROM person");
    res.json(result[0]);
  } catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the consultation'
    });
  }
};

/**
 * The function `showPersonId` retrieves a person's data from a database based on their ID and returns
 * it as a JSON response, handling errors appropriately.
 * @param req - The `req` parameter in the `showPersonId` function is typically an object representing
 * the HTTP request. It contains information about the request made by the client, such as the request
 * headers, parameters, body, and other details. In this case, it is used to extract the `id`
 * @param res - The `res` parameter in the `showPersonId` function is the response object that will be
 * sent back to the client making the request. It is used to send a response back to the client with
 * the data retrieved from the database query. In the code snippet provided, the response object is
 * used
 * @returns If the query is successful and a matching personId is found in the database, the details of
 * the person with that personId will be returned in the response as a JSON object. If the personId is
 * not found in the database, a 404 status with a message 'data not found' will be returned. If an
 * error occurs during the query execution, a 500 status with a message '
 */
export const showPersonId = async (req, res) => {
  try {
    const [result] = await connPool.query("SELECT * FROM person WHERE personId=?", [req.params.id]);
    if (result.length <= 0) return res.status(404).json({
      message: 'data not found'
    });
    res.json(result[0]);
  } catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the consultation'
    });
  }
};

/**
 * The function `updatePerson` updates a person's information in a database table and returns the
 * updated data or an error message.
 * @param req - The `req` parameter in the `updatePerson` function is an object that represents the
 * HTTP request. It contains information about the request made to the server, such as the request body
 * (`req.body`) which includes the data to update the person, and the parameters in the URL
 * (`req.params.id
 * @param res - The `res` parameter in the `updatePerson` function is the response object that will be
 * used to send a response back to the client making the request. It is typically used to send HTTP
 * responses with data or error messages. In the provided code snippet, `res` is used to send JSON
 * @returns The function `updatePerson` is returning the updated person data in JSON format if the
 * update was successful. If the data was not found (no rows affected), it returns a 404 status with a
 * message 'data not found'. If an error occurs during the process, it returns a 500 status with a
 * message 'Something went wrong in the consultation'.
 */
export const updatePerson = async (req, res) => {
  try {
    const { name, lastName, document, documentType } = req.body;
    let sqlQuery = "UPDATE person SET personName=IFNULL(?,personName)," +
      "personLast_name=IFNULL(?,personLast_name),personDocument=IFNULL(?,personDocument),documentTypeFk=IFNULL(?,documentTypeFk) WHERE personId=?";
    const [result] = await connPool.query(sqlQuery, [name, lastName, document, documentType, req.params.id]);
    if (result.affectedRows === 0) return res.status(404).json({ message: 'data not found' });
    const [row] = await connPool.query("SELECT * FROM person WHERE personId=?", [req.params.id]);
    res.json(
      row[0]
    );
  } catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the consultation'
    });
  }
};

export const deletePerson = async (req, res) => {
  try {
    const [result] = await connPool.query("DELETE FROM person WHERE personId=?", [req.params.id]);
    if (result.affectedRows <= 0) return res.status(404).json({ message: 'data not found' });
    res.sendStatus(204);
  } catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the consultation'
    });
  }
};
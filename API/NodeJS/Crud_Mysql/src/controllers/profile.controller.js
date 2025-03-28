import { connect } from '../../db/connect.js';

export const showProfile = async (req, res) => {
  try {
    let sqlQuery = "SELECT * FROM profile";
    const [result] = await connect.query(sqlQuery);
    res.status(200).json(result);
  } catch (error) {
    res.status(500).json({ error: "Error fetching profiles", details: error.message });
  }
};

/**
 * The function `showProfileId` retrieves a profile from a database based on the provided ID and
 * returns it as a JSON response, handling errors appropriately.
 * @param req - The `req` parameter in the `showProfileId` function is typically an object representing
 * the HTTP request that the server receives. It contains information such as the request headers,
 * parameters, body, and other details sent by the client. In this case, `req.params.id` is used to
 * access
 * @param res - The `res` parameter in the `showProfileId` function is the response object that is used
 * to send a response back to the client making the request. It is typically used to set the HTTP
 * status code and send data back in the response body.
 * @returns If the profile with the specified ID exists in the database, the function will return the
 * profile information in JSON format with a status code of 200. If the profile is not found, it will
 * return a JSON object with an error message "Profile not found" and a status code of 404. If there is
 * an error during the database query, it will return a JSON object with an error message
 */
export const showProfileId = async (req, res) => {
  try {
    const [result] = await connect.query('SELECT * FROM profile WHERE Profile_id = ?', [req.params.id]);
    if (result.length === 0) return res.status(404).json({ error: "Profile not found" });
    res.status(200).json(result[0]);
  } catch (error) {
    res.status(500).json({ error: "Error fetching profile", details: error.message });
  }
};

/**
 * The function `addProfile` is an asynchronous function that inserts a new profile into a database
 * table with error handling for missing required fields.
 * @param req - The `req` parameter in the `addProfile` function represents the request object, which
 * contains information about the HTTP request that triggered the function. This object typically
 * includes properties such as `body` (request body), `params` (route parameters), `query` (query
 * parameters), `headers`
 * @param res - The `res` parameter in the `addProfile` function is the response object that will be
 * used to send a response back to the client making the request. It is typically used to send HTTP
 * responses with status codes, headers, and data back to the client. In the provided code snippet, `
 * @returns If all required fields are present in the request body, the function will insert a new
 * profile into the database and return a JSON response with the newly inserted profile data including
 * the ID, name, last name, document, email, phone, photo, address, and document type. The status code
 * returned will be 201 for a successful creation.
 */
export const addProfile = async (req, res) => {
  try {
    const { name, last_name, document, email, phone, photo, address, document_type,user_id } = req.body;
    if (!name || !last_name || !document || !email || !phone) {
      return res.status(400).json({ error: "Missing required fields" });
    }
    let sqlQuery = "INSERT INTO profile (Profile_name,Profile_last_name,Profile_document,Profile_email,Profile_phone,Profile_photo,Profile_address,Document_type_fk,User_fk) VALUES (?,?,?,?,?,?,?,?,?)";
    const [result] = await connect.query(sqlQuery, [name, last_name, document, email, phone, photo, address, document_type,user_id]);
    res.status(201).json({
      data: [{ id: result.insertId, name, last_name, document, email, phone, photo, address, document_type,user_id }],
      status: 201
    });
  } catch (error) {
    res.status(500).json({ error: "Error adding profile", details: error.message });
  }
};
/**
 * The function `updateProfile` updates a user profile in a database based on the provided request
 * data.
 * @param req - The `req` parameter in the `updateProfile` function represents the request object,
 * which contains information about the HTTP request that triggered the function. This object typically
 * includes properties such as `body` (request body data), `params` (URL parameters), `query` (query
 * parameters), `headers
 * @param res - The `res` parameter in the `updateProfile` function is the response object that is used
 * to send a response back to the client making the request. It is typically used to send HTTP
 * responses with status codes, headers, and data back to the client. In the provided code snippet,
 * `res
 * @returns If all required fields are present in the request body, the function will attempt to update
 * the profile information in the database based on the provided data. If successful, it will return a
 * JSON response with the updated profile data including name, last name, document, email, phone,
 * photo, address, and document type. The response will also include a status of 200 and the number of
 * rows affected by
 */
export const updateProfile = async (req, res) => {
  try {
    const { name, last_name, document, email, phone, photo, address, document_type } = req.body;
    if (!name || !last_name || !document || !email || !phone) {
      return res.status(400).json({ error: "Missing required fields" });
    }
    let sqlQuery = "UPDATE profile SET Profile_name=?,Profile_last_name=?,Profile_document=?,Profile_email=?,Profile_phone=?,Profile_photo=?,Profile_address=?,Document_type_fk=?,Updated_at=? WHERE Profile_id = ?";
    const updated_at = new Date().toLocaleString("en-CA", { timeZone: "America/Bogota" }).replace(",", "").replace("/", "-").replace("/", "-");
    const [result] = await connect.query(sqlQuery, [name, last_name, document, email, phone, photo, address, document_type,updated_at, req.params.id]);
    if (result.affectedRows === 0) return res.status(404).json({ error: "Profile not found" });
    res.status(200).json({
      data: [{ name, last_name, document, email, phone, photo, address, document_type,updated_at}],
      status: 200,
      updated: result.affectedRows
    });
  } catch (error) {
    res.status(500).json({ error: "Error updating profile", details: error.message });
  }
};
/**
 * The function `deleteProfile` deletes a profile from a database based on the provided ID and returns
 * a success message or an error message if the profile is not found or if there is an error.
 * @param req - The `req` parameter in the `deleteProfile` function is the request object, which
 * contains information about the HTTP request that triggered the function. This object typically
 * includes details such as the request headers, parameters, body, URL, and more. In this specific
 * function, `req.params.id` is
 * @param res - The `res` parameter in the `deleteProfile` function is the response object that is used
 * to send a response back to the client making the request. It is typically used to set the status
 * code of the response (e.g., 200 for success, 404 for not found, 500
 * @returns The deleteProfile function returns a JSON response with either a success message and the
 * number of rows deleted if the profile was successfully deleted, or an error message if there was an
 * issue with the deletion process.
 */
export const deleteProfile = async (req, res) => {
  try {
    let sqlQuery = "DELETE FROM profile WHERE Profile_id = ?";
    const [result] = await connect.query(sqlQuery, [req.params.id]);
    if (result.affectedRows === 0) return res.status(404).json({ error: "Profile not found" });
    res.status(200).json({
      data: [],
      status: 200,
      deleted: result.affectedRows
    });
  } catch (error) {
    res.status(500).json({ error: "Error deleting profile", details: error.message });
  }
};



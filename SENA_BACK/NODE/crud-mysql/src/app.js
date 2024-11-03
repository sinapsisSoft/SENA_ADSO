/**
 * Author:DIEGO CASALLAS
 * Date:02/11/2024
 * Descriptions:The route controller manages user data,sending data to the database
*/
const express = require("express");
const cors = require("cors");
const userRoutes = require("./routes/user.routes");
const roleRoutes = require("./routes/role.routes");
const userStatusRoutes = require("./routes/userStatus.routes");
const moduleRoutes = require("./routes/module.routes");
const roleModuleRoutes = require("./routes/roleModule.routes");
const loginRoutes = require("./routes/login.routes");

//Declared
const app=express();
const port=4000;

//Middleware

app.use(cors());
app.use(express.json());

//Routes
/* These lines of code are setting up routes for different parts of the application. Each `app.use`
statement is associating a specific route path with a corresponding set of routes defined in
separate files. */
app.use('/api-v1/user',userRoutes);
app.use('/api-v1/role',roleRoutes);
app.use('/api-v1/userStatus',userStatusRoutes);
app.use('/api-v1/module',moduleRoutes);
app.use('/api-v1/roleModule',roleModuleRoutes);
app.use('/api-v1/login',loginRoutes);

/* The `app.listen(port,()=>{ console.log(`Listener Server http://localhost:`); });` code
snippet is setting up a server to listen on a specific port (in this case, port 4000). When the
server is successfully started and listening on the specified port, it will log a message to the
console indicating that the server is running and accessible at `http://localhost:4000`. */
app.listen(port,()=>{
  console.log(`Listener Server http://localhost:${port}`);
});
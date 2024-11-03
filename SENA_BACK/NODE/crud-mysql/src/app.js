const express = require("express");
const cors = require("cors");
const userRoutes = require("./routes/user.routes");
const roleRoutes = require("./routes/role.routes");
const userStatusRoutes = require("./routes/userStatus.routes");
const moduleRoutes = require("./routes/module.routes");
const roleModuleRoutes = require("./routes/roleModule.routes");

//Declared
const app=express();
const port=4000;

//Middleware

app.use(cors());
app.use(express.json());

//Routes
app.use('/api-v1/user',userRoutes);
app.use('/api-v1/role',roleRoutes);
app.use('/api-v1/userStatus',userStatusRoutes);
app.use('/api-v1/module',moduleRoutes);
app.use('/api-v1/roleModule',roleModuleRoutes);


app.listen(port,()=>{
  console.log(`Listener Server http://localhost:${port}`);
});
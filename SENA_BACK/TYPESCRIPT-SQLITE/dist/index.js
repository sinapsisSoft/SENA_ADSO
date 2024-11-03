"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const cors_1 = __importDefault(require("cors"));
const student_routes_1 = __importDefault(require("./routes/student-routes"));
require("reflect-metadata");
const typeorm_1 = require("typeorm");
//Declare 
const app = (0, express_1.default)();
const port = 3000;
(0, typeorm_1.createConnection)().then(result => { }).catch(error => { console.error(error); });
app.use((0, cors_1.default)());
app.use(express_1.default.json());
//Routes
app.use('/api-v1', student_routes_1.default);
app.listen(port, () => {
    console.log(`Listener Server http://localhost:${port}`);
});

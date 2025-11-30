const express = require("express");
const cors = require("cors");
const Colors = require('colors');
require("dotenv").config();

const app = express();
const corsOptions = {
	origin: process.env.CORS_ADDRESS
}

app.use(cors(corsOptions));
app.use(express.json())

require('./routes/users.js')(app)
require('./routes/todos.js')(app)

app.listen(8888, () => {
	console.log("Server listening on port 8888".green);
});
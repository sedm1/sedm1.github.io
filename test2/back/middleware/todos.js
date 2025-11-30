const {
	FIREBASE_GET_ITEMS,
	FIREBASE_ADD_ITEM,
	FIREBASE_DELETE_ITEM,
	FIREBASE_UPDATE_ITEM,
	dateTime,
} = require("../config/config.js");

// GET TODOS
exports.getAllTodos = async (req, res) => {
	// Get all todos of a specific user
	const id = req.User;
	if (!id){
		console.log(dateTime().blue, " ", "GET TODOS FAILE".bold.red);
		return res.status(400).send({ message: "UserId is required.", getTodosSuccess: false });
	}

	const result = await FIREBASE_GET_ITEMS("Todos", "UserId", id);

	console.log(dateTime().blue, " ", "GET TODOS SUCCESS".bold.green);
	res.status(200).send(result);
};

// ADD TODOS
exports.addTodo = async (req, res) => {
	// Add todo of a specific user
	const id = req.User;
	const reqData = req.body;

	if (!reqData.Content || reqData.done == null) {
		console.log(dateTime().blue, " ", "ADD TODO FAILE".bold.red);
		return res.status(400).send({
			message: "Todo content can not be empty.",
			addTodoSuccess: false
		});
	}

	Object.assign(reqData, { UserId: id });
	const result = await FIREBASE_ADD_ITEM("Users", "Todos", id, reqData);
	if (!result.addItemSuccess) {
		console.log(dateTime().blue, " ", "ADD TODO FAILE".bold.red);
		return res.status(400).send({ addTodoSuccess: false });
	} else {
		delete result['addItemSuccess']
		Object.assign(result, { addTodoSuccess: true });
		console.log(dateTime().blue, " ", "ADD TODO SUCCESS".bold.green);
		res.status(200).send(result);
	}
};

// DELETE TODO
exports.deleteTodo = async (req, res) => {
	// Delete todo of a specific user
	const reqData = req.body;
	if (!reqData.Id) {
		return res.status(400).send({
			message: "Todo Id can not be empty.",
			deleteTodoSuccess: false,
		});
	}

	const result = await FIREBASE_DELETE_ITEM("Todos", reqData.Id);
	if (!result.deleteItemSuccess){
		console.log(dateTime().blue, " ", "DELETE TODO FAILE".bold.red);
		return res.status(400).send({ message: result.message, deleteTodoSuccess: false });
	}
	console.log(dateTime().blue, " ", "DELETE TODO SUCCESS".bold.green);
	res.status(200).send({ deleteTodoSuccess: true });
};

// UPDATE TODO
exports.updateTodo = async (req, res) => {
	// Update todo of a specific user
	const UserId = req.User;
	const reqData = req.body;

	const { Content, done, Id } = reqData;
	if(!Content || !Id || done == null) {
		console.log(dateTime().blue, " ", "UPDATE TODO FAILE".bold.red);
		return res.status(400).send({ message: 'Todo content can not be empty.', updateTodoSuccess: false });
	}
	const result = await FIREBASE_UPDATE_ITEM("Todos", Id, {
		Content,
		UserId,
		done,
	});
	if (!result.updateItemSuccess) {
		console.log(dateTime().blue, " ", "UPDATE TODO FAILE".bold.red);
		return res.status(400).send({ updateTodoSuccess: false });
	} else {
		delete result['updateItemSuccess']
		Object.assign(result, { updateTodoSuccess: true });
		console.log(dateTime().blue, " ", "UPDATE TODO SUCCESS".bold.green);
		res.status(200).send(result);
	}
};


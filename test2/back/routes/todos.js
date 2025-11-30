module.exports = (app) => {
    const todos = require('../middleware/todos.js')
    const { verifyToken } = require('../middleware/authorize')

    app.get('/todo/all', verifyToken, todos.getAllTodos)
    app.post('/todo', verifyToken, todos.addTodo)
    app.delete('/todo', verifyToken, todos.deleteTodo)
    app.patch('/todo', verifyToken, todos.updateTodo)
}
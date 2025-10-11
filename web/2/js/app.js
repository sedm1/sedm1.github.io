import { renderHeader } from './components/header.js'
import { renderTodo } from './components/todo.js';
import { renderAddButton } from './components/addButton.js';
import { renderModal } from './components/modal.js';
import { addTodoItem, todoItems } from './services/todo.js';


const root = document.getElementById('root');

const renderPage = () => {
    renderHeader(root)
    renderTodo(root, todoItems)
    renderAddButton(root)
    renderModal(root)

    window.addEventListener('dialogClose', (e) => {
        addTodoItem(e.detail.title, e.detail.time)
        renderTodo(root, todoItems)
    })
}

document.addEventListener("DOMContentLoaded", renderPage);
const todoItems = JSON.parse(localStorage.getItem('todoItems')) ?? [];

const addTodoItem = (title, time) => {
  const newItem = {
    id: Date.now(),
    title,
    time,
    done: false
  };
  todoItems.push(newItem);

  localStorage.setItem('todoItems', JSON.stringify(todoItems));
};

const toggleTodoDone = (id) => {
  const index = todoItems.findIndex(item => item.id === id);
  if (index !== -1) {
    todoItems[index].done = !todoItems[index].done;
    localStorage.setItem('todoItems', JSON.stringify(todoItems));
  }
};

const deleteTodoItem = (id) => {
  const index = todoItems.findIndex(item => item.id === id);
  if (index !== -1) {
    todoItems.splice(index, 1);
    localStorage.setItem('todoItems', JSON.stringify(todoItems));
  }
};

const updateTodoItem = (id, title, time) => {
  const index = todoItems.findIndex(item => item.id === id);
  if (index !== -1) {
    todoItems[index].title = title;
    todoItems[index].time = time;
    localStorage.setItem('todoItems', JSON.stringify(todoItems));
  }
};

export {
  todoItems,
  addTodoItem,
  toggleTodoDone,
  deleteTodoItem,
  updateTodoItem
};
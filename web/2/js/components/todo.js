import { toggleTodoDone, deleteTodoItem, todoItems } from "../services/todo.js";

const renderTodo = (root, items) => {
    let main = root.querySelector('main');
    if (!main) main = document.createElement('main');

    while (main.firstChild) main.removeChild(main.firstChild);

    const mainContainer = document.createElement('div');
    mainContainer.classList.add('container');

    let currentQuery = '';
    let currentStatus = 'all';

    const applyFilters = () => {
        let filtered = items;

        if (currentStatus === 'active') {
            filtered = filtered.filter(it => !it.done);
        } else if (currentStatus === 'completed') {
            filtered = filtered.filter(it => it.done);
        }

        if (currentQuery.trim().toLowerCase()) filtered = filtered.filter(it => (it.title || '').toLowerCase().includes(currentQuery.trim().toLowerCase()));

        renderTodoItems(mainContainer, filtered, applyFilters);
    };

    renderFilter(mainContainer, {
        onSubmitQuery: (query) => { currentQuery = query; applyFilters(); },
        onChangeStatus: (status) => { currentStatus = status; applyFilters(); }
    });

    applyFilters();

    main.appendChild(mainContainer);
    root.appendChild(main);
};

const renderFilter = (mainContainer, { onSubmitQuery, onChangeStatus }) => {
    const form = document.createElement('form');

    const inputBlock = document.createElement('div');
    inputBlock.classList.add('form_inputBlock');

    const input = document.createElement('input');
    input.placeholder = 'Поиск по названию';

    const searchButton = document.createElement('button');
    searchButton.classList.add('form_inputBlockSearch');
    searchButton.type = 'submit';

    const searchButtonIcon = document.createElement('img');
    searchButtonIcon.setAttribute('src', '../../img/search.svg');

    searchButton.appendChild(searchButtonIcon);
    inputBlock.appendChild(input);
    inputBlock.appendChild(searchButton);
    form.appendChild(inputBlock);

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        onSubmitQuery(input.value || '');
    });

    renderStatusFilter(form, (statusValue) => {
        onChangeStatus(statusValue);
    });

    mainContainer.appendChild(form);
};

const renderStatusFilter = (form, onChange) => {
    const statusFilter = document.createElement('select');

    const optAll = document.createElement('option');
    optAll.value = 'all';
    optAll.textContent = 'Все';

    const optActive = document.createElement('option');
    optActive.value = 'active';
    optActive.textContent = 'Активные';

    const optCompleted = document.createElement('option');
    optCompleted.value = 'completed';
    optCompleted.textContent = 'Выполненые';

    statusFilter.appendChild(optAll);
    statusFilter.appendChild(optActive);
    statusFilter.appendChild(optCompleted);

    statusFilter.addEventListener('change', (e) => {
        onChange(e.target.value);
    });

    form.appendChild(statusFilter);
};

const renderTodoItems = (mainContainer, items, reapplyFilters) => {
    const prevBlock = mainContainer.querySelector('.todoBlock');
    if (prevBlock && prevBlock.parentNode) prevBlock.parentNode.removeChild(prevBlock);

    const todoBlock = document.createElement('div');
    todoBlock.classList.add('todoBlock');

    if (!items.length) {
        todoBlock.classList.add('todoBlock-empty');

        const todoBlockImg = document.createElement('img');
        todoBlockImg.classList.add('todoBlock_img');
        todoBlockImg.setAttribute('src', '../../img/empty.svg');

        const todoBlockText = document.createElement('h2');
        todoBlockText.classList.add('todoBlock_title');
        todoBlockText.textContent = 'Добавь пжпж...';

        todoBlock.appendChild(todoBlockImg);
        todoBlock.appendChild(todoBlockText);
    } else {
        items.forEach((item) => {
            const todoBlockItem = document.createElement('div');
            todoBlockItem.classList.add('todoBlockItem');
            if (item.done) todoBlockItem.classList.add('todoBlockItem-completed');

            const todoBlockItemLeft = document.createElement('div');
            todoBlockItemLeft.classList.add('todoBlockItemLeft')

            const todoBlockItemCheckbox = document.createElement('input');
            todoBlockItemCheckbox.type = 'checkbox';
            todoBlockItemCheckbox.checked = item.done;

            todoBlockItemCheckbox.addEventListener('change', () => {
                toggleTodoDone(item.id);
                reapplyFilters();
            });

            todoBlockItemLeft.appendChild(todoBlockItemCheckbox);

            const todoBlockItemTitle = document.createElement('h3');
            todoBlockItemTitle.textContent = item.title;
            todoBlockItemTitle.classList.add('todoBlockItemTitle');
            todoBlockItemLeft.appendChild(todoBlockItemTitle);

            const todoBlockItemDate = document.createElement('p');
            todoBlockItemDate.classList.add('todoBlockItemDate');

            const readableDate = new Date(item.time).toLocaleString('ru-RU', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            todoBlockItemDate.textContent = readableDate;
            todoBlockItemLeft.appendChild(todoBlockItemDate);

            todoBlockItem.appendChild(todoBlockItemLeft)

            const todoBlockItemRight = document.createElement('div')
            todoBlockItemRight.classList.add('todoBlockItemRight')

            const deleteButton = document.createElement('button')
            deleteButton.addEventListener('click', () => {
                deleteTodoItem(item.id)
                reapplyFilters()
            })
            const deleteButtonIcon = document.createElement('img')
            deleteButtonIcon.setAttribute('src', '../../img/delete.svg')
            deleteButton.appendChild(deleteButtonIcon)
            todoBlockItemRight.appendChild(deleteButton)


            todoBlockItem.appendChild(todoBlockItemRight)

            todoBlock.appendChild(todoBlockItem);
        });
    }

    mainContainer.appendChild(todoBlock);
};

export {
    renderTodo
};

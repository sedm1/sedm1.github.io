const renderModal = (container) => {
    const dialog = document.createElement('dialog')
    dialog.setAttribute('closedby', 'any')

    const dialogForm = document.createElement('form')
    dialogForm.setAttribute('method', 'dialog')

    const dialogTitle = document.createElement('h2')
    dialogTitle.classList.add('dialog-title')
    dialogTitle.textContent = 'Новая тудушка'
    dialogForm.appendChild(dialogTitle)

    const dialogTodoItems = document.createElement('div')
    dialogTodoItems.classList.add('dialog-todos')

    const dialogTodoTitle = document.createElement('input')
    dialogTodoTitle.setAttribute('required', '')
    dialogTodoTitle.setAttribute('name', 'title')
    dialogTodoTitle.placeholder = 'Введите заметку...'

    const dialogTodoDate = document.createElement('input')
    dialogTodoDate.setAttribute('type', 'datetime-local')
    dialogTodoDate.setAttribute('name', 'date')
    dialogTodoDate.setAttribute('required', '')

    dialogTodoItems.appendChild(dialogTodoTitle)
    dialogTodoItems.appendChild(dialogTodoDate)

    dialogForm.appendChild(dialogTodoItems)

    const dialogButtons = document.createElement('div')
    dialogButtons.classList.add('dialog-buttons')

    const dialogButtonCancel = document.createElement("input")
    dialogButtonCancel.classList.add('dialog-buttonsCancel')
    dialogButtonCancel.setAttribute('value', 'Отменить')
    dialogButtonCancel.setAttribute('formnovalidate', '')
    dialogButtonCancel.setAttribute('type', 'submit')

    const dialogButtonSubmit = document.createElement("input")
    dialogButtonSubmit.classList.add('dialog-buttonsSubmit')
    dialogButtonSubmit.setAttribute('value', 'Добавить')
    dialogButtonSubmit.setAttribute('type', 'submit')
    dialogButtonSubmit.addEventListener('click', (e) => {
        if (!dialogForm.checkValidity()) {
            e.preventDefault();
            dialogForm.reportValidity();
            return;
        }
        onDialogClose(dialogTodoTitle.value, dialogTodoDate.value);
        dialog.close();
    });

    dialogButtons.appendChild(dialogButtonCancel)
    dialogButtons.appendChild(dialogButtonSubmit)

    dialogForm.appendChild(dialogButtons)
    dialog.appendChild(dialogForm)

    container.appendChild(dialog)
}

const showModal = () => {
    const dialog = document.querySelector('dialog')

    dialog.showModal()
}

const onDialogClose = (title, time) => {
    dispatchEvent(new CustomEvent('dialogClose', {
        detail: {
            title: title,
            time: time
        }
    }))
}

export {
    renderModal,
    showModal
}
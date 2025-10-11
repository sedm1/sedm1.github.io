import { showModal } from "./modal.js"

const renderAddButton = (container) => {
    const addButton = document.createElement('button')
    addButton.classList.add('addButton')

    const addButtonImg = document.createElement('img')
    addButtonImg.setAttribute('src', '../../img/add.svg')

    addButton.appendChild(addButtonImg)

    container.appendChild(addButton)


    addButton.addEventListener('click', showModal)
}

export {
    renderAddButton
}
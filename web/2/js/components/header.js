const renderHeader = (root) => {
    const header = document.createElement('header')

    const headerContainer = document.createElement('div');
    headerContainer.classList.add('container')

    const headerTitle = document.createElement('h1')
    headerTitle.textContent = 'TODO LIST'

    headerContainer.appendChild(headerTitle)

    header.appendChild(headerContainer)
    root.appendChild(header)
}

export {
    renderHeader
}
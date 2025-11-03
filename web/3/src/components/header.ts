export const renderHeader = (root: Element) => {
    const header = createHeader()

    const headerTitle = document.createElement('h1')
    headerTitle.textContent = '2048'
    header.appendChild(headerTitle)

    root.appendChild(header)
}

const createHeader = (): Element => {
    let header = document.querySelector('header')
    if (!header) {
        header = document.createElement('header')
        header.classList.add('header')
    }
    while (header.firstChild) {
        header.removeChild(header.firstChild);
    }

    return header
}
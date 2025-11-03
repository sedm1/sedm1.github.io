export const createField = (fieldValue: number) => {
    const fieldHtml = document.createElement('div')
    fieldHtml.classList.add('board-item')
    fieldHtml.classList.add('board-item-' + fieldValue)
    if (fieldValue) fieldHtml.textContent = fieldValue + ''

    return fieldHtml;
}
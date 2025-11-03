import { createField } from "./field.js"

export const renderBoard = (root: Element, fields: number[][]) => {
    const board = createBoard()

    addFieldsToBoard(board, fields)

    root.appendChild(board)
}

const createBoard = (): Element => {
    let board = document.querySelector('.board')
    if (!board) {
        board = document.createElement('div')
        board.classList.add('board')
    }
    while (board.firstChild) {
        board.removeChild(board.firstChild);
    }

    return board
}

const addFieldsToBoard = (board: Element, fields: number[][]) => {
    fields.forEach((fieldRow) => {
        fieldRow.forEach((fieldValue) => {
            const fieldHtml = createField(fieldValue)

            board.appendChild(fieldHtml)
        })
    });
}
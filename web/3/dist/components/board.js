import { createField } from "./field.js";
export const renderBoard = (root, fields) => {
    const board = createBoard();
    addFieldsToBoard(board, fields);
    root.appendChild(board);
};
const createBoard = () => {
    let board = document.querySelector('.board');
    if (!board) {
        board = document.createElement('div');
        board.classList.add('board');
    }
    while (board.firstChild) {
        board.removeChild(board.firstChild);
    }
    return board;
};
const addFieldsToBoard = (board, fields) => {
    fields.forEach((fieldRow) => {
        fieldRow.forEach((fieldValue) => {
            const fieldHtml = createField(fieldValue);
            board.appendChild(fieldHtml);
        });
    });
};
//# sourceMappingURL=board.js.map
import { renderBoard } from "./components/board.js"
import { addFieldToRandomPlace, genFieldValue } from "./services/field.js"

window.onload = () => {
    const root = document.getElementById('root')
    startGame(root)
}

const FIELDS = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
]

const startGame = (root) => {
    addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
    addFieldToRandomPlace(FIELDS,  genFieldValue([2, 4]))

    renderBoard(root, FIELDS);
}


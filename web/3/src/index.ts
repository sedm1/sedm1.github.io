import { renderBoard } from "./components/board.js"
import { initController } from "./services/controller.js"
import { addFieldToRandomPlace, genFieldValue } from "./services/field.js"

window.onload = () => {
    const root = document.getElementById('root')
    if (!root) return;

    startGame(root)
    
    initController()
}

const FIELDS = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
]

const startGame = (root: Element) => {
    addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
    addFieldToRandomPlace(FIELDS,  genFieldValue([2, 4]))

    renderBoard(root, FIELDS);
}


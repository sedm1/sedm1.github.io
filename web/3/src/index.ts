import { renderBoard } from "./components/board.js"
import { renderGameItems } from "./components/gameItems.js"
import { renderHeader } from "./components/header.js"
import { initController } from "./services/controller.js"
import { addFieldToRandomPlace, genFieldValue, isFull } from "./services/field.js"
import { slideBoard } from "./services/field/slide.js"

let FIELDS = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
]
let previousFieldsState = JSON.parse(JSON.stringify(FIELDS));
let score = 0;
let canGoBack = false;

window.onload = () => {
    const root = document.getElementById('root')
    if (!root) return;

    renderHeader(root);
    startGame(root)

    window.addEventListener('backButtonClick', () => {
        canGoBack = false;

        FIELDS = JSON.parse(JSON.stringify(previousFieldsState))
        renderBoard(root, FIELDS)
        renderGameItems(root, score, canGoBack)
    })
}

const startGame = (root: Element) => {
    addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
    addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]))

    renderBoard(root, FIELDS);
    renderGameItems(root, score, canGoBack)

    initController(root, (action) => {
        canGoBack = true;
        previousFieldsState = JSON.parse(JSON.stringify(FIELDS));

        slideBoard(action, FIELDS)

        if (JSON.stringify(FIELDS) === JSON.stringify(previousFieldsState) && isFull(FIELDS)) {
            canGoBack = false;
            renderGameItems(root, score, canGoBack)
            endGame();
            return;
        }

        addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]))
        renderBoard(root, FIELDS)
        renderGameItems(root, score, canGoBack)
    })
}

const endGame = () => {
    
}
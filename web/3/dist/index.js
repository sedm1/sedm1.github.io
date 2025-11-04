import { renderBoard } from "./components/board.js";
import { dialogOpen } from "./components/dialogs/endgame.js";
import { renderGameItems } from "./components/gameItems.js";
import { renderHeader } from "./components/header.js";
import { animateBoard } from "./services/boardAnimation.js";
import { initController } from "./services/controller.js";
import { addFieldToRandomPlace, genFieldValue, isFull } from "./services/field.js";
import { slideBoard } from "./services/field/slide.js";
import { saveGameStateToLocalStorage, getGameState, deleteGameState } from "./services/localstorage.js";
let FIELDS = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
];
let previousFieldsState = JSON.parse(JSON.stringify(FIELDS));
let score = { value: 0 };
let scorePrev = JSON.parse(JSON.stringify(score));
let canGoBack = false;
let unsubscribeController = () => { };
const root = document.getElementById('root');
window.onload = () => {
    const state = getGameState();
    if (state) {
        alert('Партия была восстановлена');
        FIELDS = state.fields;
        score = state.score;
    }
    if (!root)
        return;
    renderHeader(root);
    startGame(root, state === null);
    window.addEventListener('backButtonClick', () => {
        canGoBack = false;
        FIELDS = JSON.parse(JSON.stringify(previousFieldsState));
        score = JSON.parse(JSON.stringify(scorePrev));
        renderBoard(root, FIELDS);
        renderGameItems(root, score.value, canGoBack);
        saveGameStateToLocalStorage(FIELDS, score);
    });
    window.addEventListener('startNewGame', () => {
        deleteGameState();
        unsubscribeController();
        FIELDS = [
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0],
        ];
        previousFieldsState = JSON.parse(JSON.stringify(FIELDS));
        score = { value: 0 };
        scorePrev = JSON.parse(JSON.stringify(score));
        canGoBack = false;
        startGame(root, true);
    });
};
const startGame = (root, isNewGame) => {
    if (isNewGame) {
        addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
        addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
    }
    renderBoard(root, FIELDS);
    renderGameItems(root, score.value, canGoBack);
    unsubscribeController = initController(root, (action) => {
        canGoBack = true;
        previousFieldsState = JSON.parse(JSON.stringify(FIELDS));
        scorePrev = JSON.parse(JSON.stringify(score));
        slideBoard(action, FIELDS, score);
        if (JSON.stringify(FIELDS) === JSON.stringify(previousFieldsState) && isFull(FIELDS)) {
            canGoBack = false;
            renderGameItems(root, score.value, canGoBack);
            endGame();
            return;
        }
        addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
        renderBoard(root, FIELDS);
        animateBoard(root, previousFieldsState, FIELDS, action);
        renderGameItems(root, score.value, canGoBack);
        saveGameStateToLocalStorage(FIELDS, score);
    });
};
const endGame = () => {
    if (!root)
        return;
    unsubscribeController();
    dialogOpen(root, score.value);
};
//# sourceMappingURL=index.js.map
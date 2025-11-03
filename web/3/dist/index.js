import { renderBoard } from "./components/board.js";
import { initController } from "./services/controller.js";
import { addFieldToRandomPlace, genFieldValue } from "./services/field.js";
import { slideBoard } from "./services/field/slide.js";
const FIELDS = [
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
    [0, 0, 0, 0],
];
window.onload = () => {
    const root = document.getElementById('root');
    if (!root)
        return;
    startGame(root);
    initController(root, (action) => {
        slideBoard(action, FIELDS);
        addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
        renderBoard(root, FIELDS);
    });
};
const startGame = (root) => {
    addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
    addFieldToRandomPlace(FIELDS, genFieldValue([2, 4]));
    renderBoard(root, FIELDS);
};
//# sourceMappingURL=index.js.map
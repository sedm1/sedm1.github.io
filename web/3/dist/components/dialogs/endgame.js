export const createEndGameDialog = () => {
    let endGameDialog = document.querySelector('dialog.endGame');
    if (!endGameDialog) {
        endGameDialog = document.createElement('dialog');
        endGameDialog.classList.add('endGame');
    }
    while (endGameDialog.firstChild) {
        endGameDialog.removeChild(endGameDialog.firstChild);
    }
    return endGameDialog;
};
export const dialogOpen = (root, score) => {
    const endGameDialog = createEndGameDialog();
    const item = document.createElement('h2');
    item.textContent = 'Вы проиграли, хаха!';
    item.classList.add('endGame-title');
    endGameDialog.appendChild(item);
    const scoreHtml = document.createElement('h3');
    scoreHtml.classList.add('endGame-score');
    scoreHtml.textContent = 'Ваш счет:' + score;
    endGameDialog.appendChild(scoreHtml);
    let startNewGameButton = endGameDialog.querySelector('.endGame-newGame');
    if (!startNewGameButton) {
        startNewGameButton = document.createElement('button');
        startNewGameButton.classList.add('endGame-newGame');
        startNewGameButton.textContent = 'Начать новую игру';
        startNewGameButton.addEventListener('click', () => {
            dispatchEvent(new CustomEvent('startNewGame'));
            endGameDialog.close();
        });
        endGameDialog.appendChild(startNewGameButton);
    }
    root.appendChild(endGameDialog);
    endGameDialog.showModal();
};
//# sourceMappingURL=endgame.js.map
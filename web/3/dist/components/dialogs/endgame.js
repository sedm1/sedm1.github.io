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
    scoreHtml.textContent = 'Ваш счет: ' + score;
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
    let setRecordButton = endGameDialog.querySelector('.endGame-setRecordButton');
    let recordInputContainer = endGameDialog.querySelector('.endGame-recordContainer');
    if (!setRecordButton) {
        setRecordButton = document.createElement('button');
        setRecordButton.classList.add('endGame-setRecordButton');
        setRecordButton.textContent = 'Сохранить рекорд';
        setRecordButton.addEventListener('click', () => {
            if (recordInputContainer) {
                const inp = recordInputContainer.querySelector('input');
                inp === null || inp === void 0 ? void 0 : inp.focus();
                return;
            }
            recordInputContainer = document.createElement('div');
            recordInputContainer.classList.add('endGame-recordContainer');
            recordInputContainer.style.marginTop = '10px';
            recordInputContainer.style.display = 'flex';
            recordInputContainer.style.gap = '8px';
            recordInputContainer.style.alignItems = 'center';
            const input = document.createElement('input');
            input.type = 'text';
            input.placeholder = 'Введите ФИО';
            input.classList.add('endGame-input');
            input.style.padding = '6px 8px';
            input.style.fontSize = '14px';
            const confirmBtn = document.createElement('button');
            confirmBtn.textContent = 'Сохранить';
            confirmBtn.classList.add('endGame-confirmSave');
            confirmBtn.addEventListener('click', () => {
                const name = input.value.trim();
                if (!name) {
                    alert('Введите имя (ФИО) для сохранения рекорда');
                    input.focus();
                    return;
                }
                if (setRecordButton)
                    setRecordButton.style.display = 'none';
                recordInputContainer.style.display = 'none';
                const date = new Date().toISOString().slice(0, 10);
                alert('Рекорд сохранён');
                dispatchEvent(new CustomEvent('setRecord', {
                    detail: {
                        name,
                        score,
                        date
                    }
                }));
            });
            recordInputContainer.appendChild(input);
            recordInputContainer.appendChild(confirmBtn);
            endGameDialog.appendChild(recordInputContainer);
            input.focus();
        });
        endGameDialog.appendChild(setRecordButton);
    }
    root.appendChild(endGameDialog);
    endGameDialog.showModal();
};
//# sourceMappingURL=endgame.js.map
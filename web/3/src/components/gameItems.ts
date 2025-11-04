export const renderGameItems = (root: Element, score: number, canGoBack: boolean) => {
    const gameItems = createGameItems();

    if (canGoBack) {
        let backButton = gameItems.querySelector('.board-backButton')

        if (!backButton) {
            backButton = document.createElement('button');
            backButton.textContent = 'Сделать ход назад';
            backButton.classList.add('board-backButton');

            backButton.addEventListener('click', () => dispatchEvent(new CustomEvent('backButtonClick')));

            gameItems.appendChild(backButton);
        }
    }

    const scoreHtml = createScore()
    scoreHtml.textContent = 'Счет:' + score
    gameItems.appendChild(scoreHtml)


    root.appendChild(gameItems)

}

const createGameItems = (): Element => {
    let gameItems = document.querySelector('.gameItems')
    if (!gameItems) {
        gameItems = document.createElement('div')
        gameItems.classList.add('gameItems')
    }
    while (gameItems.firstChild) {
        gameItems.removeChild(gameItems.firstChild);
    }

    return gameItems
}

const createScore = (): Element => {
    let scoreHtml = document.querySelector('.scoreBlock')
    if (!scoreHtml) {
        scoreHtml = document.createElement('div')
        scoreHtml.classList.add('scoreBlock')
    }
    while (scoreHtml.firstChild) {
        scoreHtml.removeChild(scoreHtml.firstChild);
    }

    return scoreHtml
}
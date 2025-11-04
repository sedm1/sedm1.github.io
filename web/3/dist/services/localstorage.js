export const saveGameStateToLocalStorage = (fields, score) => {
    localStorage.setItem('2048-state', JSON.stringify({
        fields: fields,
        score: score
    }));
};
export const getGameState = () => {
    const state = localStorage.getItem('2048-state');
    if (!state)
        return null;
    return JSON.parse(state);
};
export const deleteGameState = () => {
    localStorage.removeItem('2048-state');
};
//# sourceMappingURL=localstorage.js.map
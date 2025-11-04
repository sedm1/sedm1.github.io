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
export const getScores = () => {
    const state = localStorage.getItem('2048-score');
    if (!state)
        return [];
    return JSON.parse(state);
};
export const setScore = (recordItem) => {
    const item = localStorage.getItem('2048-score');
    const state = item ? JSON.parse(item) : [];
    if (!state.length)
        localStorage.setItem('2048-score', JSON.stringify([]));
    state.push(recordItem);
    localStorage.setItem('2048-score', JSON.stringify(state));
};
//# sourceMappingURL=localstorage.js.map
const KEY = "weather_app";

export function loadState() {
    try {
        const raw = localStorage.getItem(KEY);
        return raw ? JSON.parse(raw) : null;
    } catch {
        return null;
    }
}

export function saveState(state) {
    try {
        localStorage.setItem(KEY, JSON.stringify(state));
    } catch { }
}

export function createInitialState() {
    return {
        currentCoords: null,
        cities: []
    };
}

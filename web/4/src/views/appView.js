import { createHeader } from "./components/header.js";
import { createTabs } from "./components/tabs.js";
import { createWeatherView } from "./components/weatherView.js";
import { getUserPosition } from "../services/geo.js";
import {
    loadState,
    saveState,
    createInitialState
} from "../services/store.js";

export function renderApp(root) {
    root.textContent = "";

    const state = loadState() || createInitialState();
    let isRestoring = true;

    const app = document.createElement("div");
    app.className = "weather";

    const view = createWeatherView();

    const tabs = createTabs({
        onSelect(coords, title) {
            view.update(coords, title);
            if (!isRestoring) {
                persist();
            }
        }
    });

    const header = createHeader(() => {
        view.refresh();
    });

    const layout = document.createElement("div");
    layout.className = "weather_layout";

    layout.appendChild(tabs.element);
    layout.appendChild(view.element);

    app.appendChild(header);
    app.appendChild(layout);
    root.appendChild(app);

    restore(state);

    function persist() {
        saveState({
            currentCoords: tabs.getCurrentCoords(),
            cities: tabs.getCities()
        });
    }

    async function restore(state) {
        if (state.cities.length) {
            tabs.setCities(state.cities);
        }

        if (state.currentCoords) {
            tabs.setCurrent(state.currentCoords);
            isRestoring = false;
            return;
        }

        try {
            const coords = await getUserPosition();
            tabs.setCurrent(coords);
        } catch {
        }

        isRestoring = false;
    }
}

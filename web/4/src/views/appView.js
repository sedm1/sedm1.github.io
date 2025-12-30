import { createHeader } from "./components/header.js";
import { createCurrentWeather } from "./components/currentWeather.js";
import { createCitiesList } from "./components/citiesList.js";
import { createAddCity } from "./components/addCity.js";
import { getUserPosition } from "../services/geo.js";

export function renderApp(root) {
    root.textContent = "";

    const app = document.createElement("div");
    app.className = "weather";

    const header = createHeader();
    const current = createCurrentWeather();
    const cities = createCitiesList();
    const addCity = createAddCity();

    app.appendChild(header);
    app.appendChild(current.element);
    app.appendChild(cities);
    app.appendChild(addCity);

    root.appendChild(app);

    initLocation(current);
}

async function initLocation(currentWeather) {
    try {
        const coords = await getUserPosition();
        currentWeather.update(coords);
    } catch {
        // тест
        currentWeather.update({ lat: 52.52, lon: 13.405 });
    }
}

import { createHeader } from "./components/header.js";
import { createCurrentWeather } from "./components/currentWeather.js";
import { createCitiesList } from "./components/citiesList.js";
import { createAddCity } from "./components/addCity.js";

export function renderApp(root) {
    const app = document.createElement("div");
    app.className = "weather";

    const header = createHeader();
    const current = createCurrentWeather();
    const cities = createCitiesList();
    const addCity = createAddCity();

    app.appendChild(header);
    app.appendChild(current);
    app.appendChild(cities);
    app.appendChild(addCity);

    root.appendChild(app);
}

import { getWeatherByCoords } from "../../services/weather.js";

export function createWeatherView() {
    const section = document.createElement("section");
    section.className = "weather_view";

    const title = document.createElement("div");
    title.className = "weather_view_title";

    const days = document.createElement("div");
    days.className = "weather_days";

    section.appendChild(title);
    section.appendChild(days);

    let lastCoords = null;

    return {
        element: section,
        update(coords, label) {
            lastCoords = coords;
            title.textContent = label;
            load(days, coords);
        },
        refresh() {
            if (lastCoords) load(days, lastCoords);
        }
    };
}

async function load(container, coords) {
    container.textContent = "";

    const loading = document.createElement("div");
    loading.className = "weather_day";
    loading.textContent = "Загрузка...";
    container.appendChild(loading);

    try {
        const data = await getWeatherByCoords(coords.lat, coords.lon);
        container.textContent = "";

        data.forEach((d) => {
            const day = document.createElement("div");
            day.className = "weather_day";
            day.textContent = `${d.min}° / ${d.max}°`;
            container.appendChild(day);
        });
    } catch {
        container.textContent = "";
        const err = document.createElement("div");
        err.className = "weather_day";
        err.textContent = "Ошибка";
        container.appendChild(err);
    }
}

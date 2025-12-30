import { getWeatherByCoords } from "../../services/weather.js";

export function createCurrentWeather() {
    const section = document.createElement("section");
    section.className = "weather_current";

    const location = document.createElement("div");
    location.className = "weather_location";
    location.textContent = "Текущее местоположение";

    const days = document.createElement("div");
    days.className = "weather_days";

    section.appendChild(location);
    section.appendChild(days);

    return {
        element: section,
        update(coords) {
            loadWeather(days, coords);
        }
    };
}

async function loadWeather(container, coords) {
    container.textContent = "";

    const loading = document.createElement("div");
    loading.className = "weather_day";
    loading.textContent = "Загрузка...";
    container.appendChild(loading);

    try {
        const data = await getWeatherByCoords(coords.lat, coords.lon);

        container.textContent = "";

        data.forEach((item) => {
            const day = document.createElement("div");
            day.className = "weather_day";
            day.textContent = `${item.min}° / ${item.max}°`;
            container.appendChild(day);
        });
    } catch {
        container.textContent = "";

        const error = document.createElement("div");
        error.className = "weather_day";
        error.textContent = "Ошибка загрузки";
        container.appendChild(error);
    }
}

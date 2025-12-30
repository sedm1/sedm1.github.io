import { getWeatherByCoords } from "../../services/weather.js";

export function createCitiesList() {
    const section = document.createElement("section");
    section.className = "weather_cities";

    const cities = [];

    return {
        element: section,
        addCity(city) {
            cities.push(city);
            renderCity(city);
        },
        setCities(list) {
            cities.length = 0;
            section.textContent = "";
            list.forEach((city) => {
                cities.push(city);
                renderCity(city);
            });
        },
        refresh() {
            section.textContent = "";
            cities.forEach(renderCity);
        },
        getCities() {
            return cities.slice();
        }
    };

    function renderCity(city) {
        const wrapper = document.createElement("div");
        wrapper.className = "weather_city";

        const name = document.createElement("div");
        name.className = "weather_city_name";
        name.textContent = city.name;

        const days = document.createElement("div");
        days.className = "weather_city_days";

        wrapper.appendChild(name);
        wrapper.appendChild(days);
        section.appendChild(wrapper);

        loadCityWeather(days, city);
    }
}

async function loadCityWeather(container, city) {
    container.textContent = "";

    const loading = document.createElement("div");
    loading.className = "weather_day";
    loading.textContent = "Загрузка...";
    container.appendChild(loading);

    try {
        const data = await getWeatherByCoords(city.lat, city.lon);

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
        error.textContent = "Ошибка";
        container.appendChild(error);
    }
}
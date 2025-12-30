import { filterCities, findCityByName } from "../../data/cities.js";

export function createAddCity(onAdd) {
    const wrapper = document.createElement("div");
    wrapper.className = "weather_add";

    const input = document.createElement("input");
    input.className = "weather_input";
    input.placeholder = "Добавить город";

    const list = document.createElement("div");
    list.className = "weather_suggest";

    const error = document.createElement("div");
    error.className = "weather_error";

    let selectedFromList = false;

    wrapper.appendChild(input);
    wrapper.appendChild(list);
    wrapper.appendChild(error);

    input.addEventListener("input", () => {
        list.textContent = "";
        error.textContent = "";
        selectedFromList = false;

        const value = input.value.trim();
        if (!value) return;

        const matches = filterCities(value);

        matches.forEach((city) => {
            const item = document.createElement("div");
            item.className = "weather_suggest_item";
            item.textContent = city.name;

            item.addEventListener("click", () => {
                selectedFromList = true;
                input.value = "";
                list.textContent = "";
                error.textContent = "";
                onAdd(city);
            });

            list.appendChild(item);
        });
    });

    input.addEventListener("blur", () => {
        setTimeout(() => {
            list.textContent = "";
        }, 150);

        if (selectedFromList) {
            selectedFromList = false;
            return;
        }

        const value = input.value.trim();
        if (!value) return;

        const city = findCityByName(value);
        if (!city) {
            error.textContent = "Город не найден";
        }
    });

    return wrapper;
}

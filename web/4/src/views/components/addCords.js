export function createAddCoords(onAdd) {
    const wrapper = document.createElement("div");
    wrapper.className = "weather_add_coords";

    const inputLat = document.createElement("input");
    inputLat.type = "number";
    inputLat.placeholder = "Широта";
    inputLat.step = "any";

    const inputLon = document.createElement("input");
    inputLon.type = "number";
    inputLon.placeholder = "Долгота";
    inputLon.step = "any";

    const button = document.createElement("button");
    button.type = "button";
    button.textContent = "Показать погоду";

    const error = document.createElement("div");
    error.className = "weather_error";

    wrapper.appendChild(inputLat);
    wrapper.appendChild(inputLon);
    wrapper.appendChild(button);
    wrapper.appendChild(error);

    button.addEventListener("click", () => {
        error.textContent = "";

        const lat = Number(inputLat.value);
        const lon = Number(inputLon.value);

        if (
            Number.isNaN(lat) ||
            Number.isNaN(lon) ||
            lat < -90 || lat > 90 ||
            lon < -180 || lon > 180
        ) {
            error.textContent = "Некорректные координаты";
            return;
        }

        onAdd({ lat, lon });
    });

    return wrapper;
}
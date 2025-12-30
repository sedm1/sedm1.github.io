export function createAddCity() {
    const wrapper = document.createElement("div");
    wrapper.className = "weather_add";

    const input = document.createElement("input");
    input.className = "weather_input";
    input.placeholder = "Добавить город";

    const error = document.createElement("div");
    error.className = "weather_error";

    wrapper.appendChild(input);
    wrapper.appendChild(error);

    return wrapper;
}

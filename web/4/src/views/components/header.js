export function createHeader() {
    const header = document.createElement("div");
    header.className = "weather_top";

    const title = document.createElement("h1");
    title.className = "weather_title";
    title.textContent = "Прогноз погоды";

    const refresh = document.createElement("button");
    refresh.className = "weather_refresh";
    refresh.type = "button";
    refresh.textContent = "Обновить";

    header.appendChild(title);
    header.appendChild(refresh);

    return header;
}

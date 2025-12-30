export function renderApp(root) {
  root.textContent = "";

  const app = document.createElement("div");
  app.className = "weather";

  const top = document.createElement("div");
  top.className = "weather_top";

  const title = document.createElement("h1");
  title.className = "weather_title";
  title.textContent = "Прогноз погоды";

  const refresh = document.createElement("button");
  refresh.className = "weather_refresh";
  refresh.type = "button";
  refresh.textContent = "Обновить";

  top.appendChild(title);
  top.appendChild(refresh);

  const current = document.createElement("section");
  current.className = "weather_current";

  const location = document.createElement("div");
  location.className = "weather_location";
  location.textContent = "Текущее местоположение";

  const days = document.createElement("div");
  days.className = "weather_days";

  for (let i = 0; i < 3; i += 1) {
    const day = document.createElement("div");
    day.className = "weather_day";
    day.textContent = "—";
    days.appendChild(day);
  }

  current.appendChild(location);
  current.appendChild(days);

  const cities = document.createElement("section");
  cities.className = "weather_cities";

  cities.appendChild(createCityBlock("Город"));

  const add = document.createElement("div");
  add.className = "weather_add";

  const input = document.createElement("input");
  input.className = "weather_input";
  input.placeholder = "Добавить город";

  const error = document.createElement("div");
  error.className = "weather_error";

  add.appendChild(input);
  add.appendChild(error);

  app.appendChild(top);
  app.appendChild(current);
  app.appendChild(cities);
  app.appendChild(add);

  root.appendChild(app);
}

function createCityBlock(name) {
  const city = document.createElement("div");
  city.className = "weather_city";

  const title = document.createElement("div");
  title.className = "weather_city_name";
  title.textContent = name;

  const days = document.createElement("div");
  days.className = "weather_city_days";

  for (let i = 0; i < 3; i += 1) {
    const day = document.createElement("div");
    day.className = "weather_day";
    day.textContent = "—";
    days.appendChild(day);
  }

  city.appendChild(title);
  city.appendChild(days);

  return city;
}
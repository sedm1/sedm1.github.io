export async function getWeatherByCoords(lat, lon) {
    const url = new URL("https://api.open-meteo.com/v1/forecast");

    url.searchParams.set("latitude", lat);
    url.searchParams.set("longitude", lon);
    url.searchParams.set("daily", "temperature_2m_max,temperature_2m_min");
    url.searchParams.set("forecast_days", "3");
    url.searchParams.set("timezone", "auto");

    const response = await fetch(url.toString());

    if (!response.ok) {
        throw new Error("Ошибка загрузки погоды");
    }

    const data = await response.json();

    return mapWeather(data);
}

function mapWeather(data) {
    const result = [];

    const dates = data.daily.time;
    const max = data.daily.temperature_2m_max;
    const min = data.daily.temperature_2m_min;

    for (let i = 0; i < 3; i += 1) {
        result.push({
            date: dates[i],
            max: max[i],
            min: min[i]
        });
    }

    return result;
}

export const CITIES = [
    { name: "Berlin", lat: 52.52, lon: 13.405 },
    { name: "Paris", lat: 48.8566, lon: 2.3522 },
    { name: "London", lat: 51.5074, lon: -0.1278 },
    { name: "Rome", lat: 41.9028, lon: 12.4964 },
    { name: "Madrid", lat: 40.4168, lon: -3.7038 },
    { name: "Vienna", lat: 48.2082, lon: 16.3738 }
];

export function findCityByName(name) {
    return CITIES.find((c) => c.name.toLowerCase() === name.toLowerCase());
}

export function filterCities(query) {
    if (!query) return [];
    return CITIES.filter((c) =>
        c.name.toLowerCase().includes(query.toLowerCase())
    );
}

import { createAddCity } from "./addCity.js";

export function createTabs({ onSelect }) {
    const wrapper = document.createElement("div");
    wrapper.className = "weather_tabs";

    let currentCoords = null;
    let cities = [];
    let activeTab = null;

    const currentTab = createTab("Текущее местоположение", () => {
        if (!currentCoords) return;
        onSelect(currentCoords, "Текущее местоположение");
        setActive(currentTab);
    });

    wrapper.appendChild(currentTab.element);

    const addCity = createAddCity((city) => {
        cities.push(city);

        const tab = createTab(city.name, () => {
            onSelect(city, city.name);
            setActive(tab);
        });

        wrapper.insertBefore(tab.element, addCity);
        tab.element.click(); // сразу активируем
    });

    wrapper.appendChild(addCity);

    return {
        element: wrapper,

        setCurrent(coords) {
            currentCoords = coords;
            currentTab.element.click();
        },

        setCities(list) {
            list.forEach((city) => {
                cities.push(city);

                const tab = createTab(city.name, () => {
                    onSelect(city, city.name);
                    setActive(tab);
                });

                wrapper.insertBefore(tab.element, addCity);
            });
        },

        getCities() {
            return cities.slice();
        },

        getCurrentCoords() {
            return currentCoords;
        }
    };

    function setActive(tab) {
        if (activeTab) activeTab.deactivate();
        activeTab = tab;
        tab.activate();
    }
}

function createTab(title, onClick) {
    const el = document.createElement("div");
    el.className = "weather_tab";
    el.textContent = title;

    el.addEventListener("click", onClick);

    return {
        element: el,
        activate() {
            el.classList.add("weather_tab--active");
        },
        deactivate() {
            el.classList.remove("weather_tab--active");
        }
    };
}

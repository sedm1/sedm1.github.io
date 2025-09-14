import { addToCart } from "./cart.js";

const PRODUCTS = [
    {
        "id": 0,
        "title": "Кроссовки SpeedRun",
        "price": 5200,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 42
    },
    {
        "id": 1,
        "title": "Кроссовки UrbanFlex",
        "price": 6100,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 38
    },
    {
        "id": 2,
        "title": "Кроссовки Street Classic",
        "price": 5400,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 43
    },
    {
        "id": 3,
        "title": "Кроссовки Runner Pro",
        "price": 6200,
        "img": "img/tovar.jpg",
        "sex": "unisex",
        "size": 41
    },
    {
        "id": 4,
        "title": "Кроссовки Urban Style",
        "price": 5800,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 37
    },
    {
        "id": 5,
        "title": "Кроссовки Sport Active",
        "price": 4900,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 44
    },
    {
        "id": 6,
        "title": "Кроссовки Light Air",
        "price": 5100,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 36
    },
    {
        "id": 7,
        "title": "Кроссовки AllTerrain",
        "price": 7000,
        "img": "img/tovar.jpg",
        "sex": "unisex",
        "size": 45
    },
    {
        "id": 8,
        "title": "Кроссовки RetroVibe",
        "price": 5600,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 43
    },
    {
        "id": 9,
        "title": "Кроссовки FlexRun",
        "price": 6400,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 39
    },
    {
        "id": 10,
        "title": "Кроссовки CityWalk",
        "price": 5300,
        "img": "img/tovar.jpg",
        "sex": "unisex",
        "size": 40
    },
    {
        "id": 11,
        "title": "Кроссовки UltraBoost",
        "price": 7500,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 44
    },
    {
        "id": 12,
        "title": "Кроссовки AirFlow",
        "price": 5600,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 38
    },
    {
        "id": 13,
        "title": "Кроссовки NeoRun",
        "price": 6000,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 42
    },
    {
        "id": 14,
        "title": "Кроссовки PowerStep",
        "price": 5800,
        "img": "img/tovar.jpg",
        "sex": "unisex",
        "size": 43
    },
    {
        "id": 15,
        "title": "Кроссовки CityMotion",
        "price": 5200,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 37
    },
    {
        "id": 16,
        "title": "Кроссовки SportLine",
        "price": 4900,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 44
    },
    {
        "id": 17,
        "title": "Кроссовки CloudStep",
        "price": 5100,
        "img": "img/tovar.jpg",
        "sex": "female",
        "size": 36
    },
    {
        "id": 18,
        "title": "Кроссовки MaxGrip",
        "price": 7000,
        "img": "img/tovar.jpg",
        "sex": "unisex",
        "size": 45
    },
    {
        "id": 19,
        "title": "Кроссовки UltraLight",
        "price": 5600,
        "img": "img/tovar.jpg",
        "sex": "male",
        "size": 42
    }
]

const renderCatalog = (products) => {
    const elCatalog = document.querySelector('.catalog_main')
    elCatalog.innerHTML = '';

    products.forEach(product => {
        const item = document.createElement('div');
        item.classList.add('catalog_mainItem');

        item.innerHTML = `
          <div class="catalog_mainItemImg">
            <img src="${product.img}" alt="${product.title}">
          </div>
          <h3 class="catalog_mainItemTitle">${product.title}</h3>
          <p class="catalog_mainItemPrice">${product.price} ₽</p>
          <button class="catalog_mainItemAdd" data-id="${product.id}">Добавить в корзину</button>
        `;

        elCatalog.appendChild(item);
    });
}

const addEventListenerOnAddButton = () => {
    const elAddButtons = document.querySelectorAll('.catalog_mainItemAdd');

    elAddButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = +button.dataset.id;
            const product = PRODUCTS.find(p => p.id === productId);

            addToCart(product)
        });
    });
}

window.addEventListener('load', function () {
    renderCatalog(PRODUCTS);

    addEventListenerOnAddButton()
});

export {
    PRODUCTS,
    renderCatalog,
    addEventListenerOnAddButton
}

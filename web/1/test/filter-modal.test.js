import { beforeEach, describe, it, expect, vi } from 'vitest';

function ensureLocalStorage() {
    let store = {};

    global.localStorage = {
        getItem: (k) => (k in store ? store[k] : null),

        setItem: (k, v) => {
            store[k] = String(v);
        },

        removeItem: (k) => {
            delete store[k];
        },

        clear: () => {
            store = {};
        }
    };
}

const PRODUCT = (id, price = 500, extra = {}) => (
    {
        id,
        title: `P${id}`,
        price, img: '',
        sex: 'male',
        size: 42,
        ...extra
    }
);

function readCart() {
    const raw = localStorage.getItem('cart');

    return raw ? JSON.parse(raw) : [];
}

let cartApi;

beforeEach(async () => {
    vi.resetModules();
    ensureLocalStorage();

    document.body.innerHTML = `
      <header>
        <button class="header_menuCart"><span class="header_menuCartCount">0</span></button>
      </header>
      <main>
        <button class="catalog_filtersButton">Применить</button>
        <input id="catalog_filtersItemPriceMin" type="number" value="0" />
        <input id="catalog_filtersItemPriceMax" type="number" value="10000" />
        <div class="catalog_filtersItemSize"></div>
        <div class="catalog_main"></div>
      </main>
      <div class="dialog_cart-bg"></div>
      <button class="dialog_cartClose"></button>
      <form><button class="dialog_cartMainFormSubmit">Отправить</button></form>
      <div class="dialog_cartMainProduct"></div>

      <p id="dialog_cart-count"></p>
        <p id="dialog_cart-price"></p>
    `;

    cartApi = await import('../scripts/cart.js');
    await import('../scripts/catalog.js');
    await import('../scripts/filters.js');
    window.dispatchEvent(new Event('load'));
});

describe('Фильтрация и корзина', () => {
    it('Счетчик меняется', () => {
        const counter = document.querySelector('.header_menuCartCount');
        expect(counter).toBeTruthy();

        cartApi.addToCart(PRODUCT(1, 500));
        const cart = readCart();
        expect(cart).toHaveLength(1);

        expect(counter.textContent).toBe('1');
        expect(counter.style.display).toBe('inline-block');
    });

    it('Открывает окно по клику', () => {
        document.querySelector('.header_menuCart').click();

        const bg = document.querySelector('.dialog_cart-bg');
        expect(bg.classList.contains('dialog_cart-bg-active')).toBe(true);

        expect(document.querySelector('#dialog_cart-count').textContent).toBe('0');
        expect(document.querySelector('#dialog_cart-price').textContent).toBe('0 руб.');
    });

    it('После фильтрации добавляется корректный товар', () => {
        document.querySelector('.catalog_filtersButton').click();

        const firstAdd = document.querySelector('.catalog_mainItemAdd');
        expect(firstAdd).toBeTruthy();

        firstAdd.click();

        const cart = readCart();
        expect(cart).toHaveLength(1);
    });
});

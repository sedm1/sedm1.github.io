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

let cartApi;

beforeEach(async () => {
    vi.resetModules();
    ensureLocalStorage();
    cartApi = await import('../scripts/cart.js');
});

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

describe('Корзина — удаление', () => {
    it('Удаление одного товара, когда его несколько', () => {
        const a = PRODUCT(1, 500);
        cartApi.addToCart(a);
        cartApi.addToCart(a);

        cartApi.deleteFromCart(1);
        const cart = readCart();

        expect(cart).toHaveLength(1);
        expect(cart[0]).toMatchObject({ id: 1, quantity: 1, price: 500 });
    });

    it('Полное удаление товара при его одинчности', () => {
        const b = PRODUCT(2, 700);
        cartApi.addToCart(b);

        cartApi.deleteFromCart(2);
        const cart = readCart();

        expect(cart).toHaveLength(0);
    });

    it('При неизвестном id не меняется', () => {
        const c = PRODUCT(3, 900);
        cartApi.addToCart(c);

        const before = readCart();
        cartApi.deleteFromCart(999);
        const after = readCart();

        expect(after).toEqual(before);
    });
});
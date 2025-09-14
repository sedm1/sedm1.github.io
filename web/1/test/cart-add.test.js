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

describe('Корзина — добавление', () => {
    it('добавляет новую позицию с quantity=1', () => {
        const product = PRODUCT(1, 1200);
        cartApi.addToCart(product);

        const cart = readCart();
        expect(cart).toHaveLength(1);
        expect(cart[0]).toMatchObject({ id: 1, price: 1200, quantity: 1 });
    });

    it('повторное добавление того же товара увеличивает quantity', () => {
        const product = PRODUCT(2, 2000);
        cartApi.addToCart(product);
        cartApi.addToCart(product);

        const cart = readCart();
        expect(cart).toHaveLength(1);
        expect(cart[0].quantity).toBe(2);
        expect(cart[0].id).toBe(2);
    });

    it('добавление разных товаров создаёт 2 позиции и корректные итоги', () => {
        const a = PRODUCT(3, 1500);
        const b = PRODUCT(4, 2500);

        cartApi.addToCart(a);
        cartApi.addToCart(b);

        const cart = readCart();
        expect(cart.map(x => x.id).sort()).toEqual([3, 4]);
        expect(cart.map(x => x.quantity)).toEqual([1, 1]);

        const totals = cartApi.calculateTotals(cart);
        expect(totals).toEqual({ totalItems: 2, totalPrice: 4000 });
    });
});
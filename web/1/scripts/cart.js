let cart = JSON.parse(localStorage.getItem('cart')) || [];

const saveCart = () => {
    localStorage.setItem('cart', JSON.stringify(cart));
    renderHeaderCountItem();
};

const renderHeaderCountItem = () => {
    const elCount = document.querySelector('.header_menuCartCount');
    if (!elCount) return;

    const totalCount = cart.reduce((acc, item) => acc + (item.quantity || 1), 0);

    if (totalCount > 0) {
        elCount.textContent = totalCount;
        elCount.style.display = 'inline-block';
    } else {
        elCount.style.display = 'none';
    }
};

const renderProductsWithQuantity = (products) => {
    const container = document.querySelector('.dialog_cartMainProduct');
    container.innerHTML = '';

    products.forEach(product => {
        const qty = product.quantity || 1;
        for (let i = 0; i < qty; i++) {
            const item = document.createElement('div');
            item.classList.add('dialog_cartMainProductItem');
            item.innerHTML = `
                <img src="${product.img}" alt="${product.title}">
                <div class="dialog_cartMainProductItemInfo">
                    <h3>${product.title}</h3>
                    <p>Цена: ${product.price}₽</p>
                </div>
                <button class="dialog_cartMainProductItemDelete" data-id="${product.id}">Удалить</button>
            `;
            container.appendChild(item);
        }
    });
};

const addToCart = (product) => {
    const existingProduct = cart.find(item => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }
    saveCart();
};

const calculateTotals = (products) => {
    let totalItems = 0;
    let totalPrice = 0;

    products.forEach(product => {
        const qty = product.quantity || 1;
        totalItems += qty;
        totalPrice += product.price * qty;
    });

    return { totalItems, totalPrice };
};

const deleteFromCart = (productId) => {
    const item = cart.find(p => p.id === productId);
    if (!item) return;

    if ((item.quantity || 1) > 1) {
        item.quantity -= 1;
    } else {
        cart = cart.filter(p => p.id !== productId);
    }
    saveCart();
};

const rerenderDialog = () => {
    const { totalItems, totalPrice } = calculateTotals(cart);
    document.querySelector('#dialog_cart-count').textContent = totalItems;
    document.querySelector('#dialog_cart-price').textContent = totalPrice + ' руб.';
    renderProductsWithQuantity(cart);
};

const openDialog = () => {
    document.body.classList.add('dialog-open')
    rerenderDialog();
    document.querySelector('.dialog_cart-bg').classList.add('dialog_cart-bg-active');
};

const closeDialog = () => {
    document.body.classList.remove('dialog-open')
    document.querySelector('.dialog_cart-bg').classList.remove('dialog_cart-bg-active');
}

const attachDialogHandlers = () => {
    const list = document.querySelector('.dialog_cartMainProduct');
    if (!list) return;

    list.addEventListener('click', (e) => {
        const btn = e.target.closest('.dialog_cartMainProductItemDelete');
        if (!btn) return;

        const id = Number(btn.getAttribute('data-id'));

        deleteFromCart(id);
        rerenderDialog();
    });
};

window.addEventListener('load', function () {
    renderHeaderCountItem();
    document.querySelector('.header_menuCart').addEventListener('click', openDialog);
    attachDialogHandlers();
    document.querySelector('.dialog_cartClose').addEventListener('click', closeDialog)

    document.querySelector('.dialog_cartMainFormSubmit').addEventListener('click', (e) => {
        e.preventDefault();

        this.alert('Заказ создан')
    })
});

export {
    addToCart,
    deleteFromCart
};
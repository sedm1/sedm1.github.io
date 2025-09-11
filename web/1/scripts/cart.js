let cart = JSON.parse(localStorage.getItem('cart')) || [];

const saveCart = () => {
    localStorage.setItem('cart', JSON.stringify(cart));

    renderHeaderCountItem()
};

const renderHeaderCountItem = () => {
    const elCount = document.querySelector('.header_menuCartCount');
    if (!elCount) return;

    const totalCount = cart.reduce((acc, item) => acc + item.quantity, 0);

    if (totalCount > 0) {
        elCount.textContent = totalCount;
        elCount.style.display = 'inline-block';
    } else {
        elCount.style.display = 'none';
    }
}

const addToCart = (product) => {
    const existingProduct = cart.find(item => item.id === product.id);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }

    saveCart();
};

const deleteFromCart = (productId) => {
    cart = cart.filter(item => item.id !== productId);

    saveCart();
};


window.addEventListener('load', function () {
    renderHeaderCountItem()
});

export {
    addToCart,
    deleteFromCart
}
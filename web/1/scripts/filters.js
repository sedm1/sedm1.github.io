import { PRODUCTS, renderCatalog, addEventListenerOnAddButton } from "./catalog.js"

export const getFilters = () => {
    const filters = {
        priceMin: null,
        priceMax: null,
        sex: null,
        size: null,
    }

    const priceMin = +document.querySelector('#catalog_filtersItemPriceMin').value
    const priceMax = +document.querySelector('#catalog_filtersItemPriceMax').value
    const sex = document.querySelector('input[name="catalog_filtersItemSex"]:checked')?.value;
    const sizeBtnsActive = document.querySelectorAll('.catalog_filtersItemSizeItem-active');

    const pickedSizes = [...sizeBtnsActive]
        .map(btn => Number(btn.dataset.size))
        .filter(n => Number.isFinite(n));

    filters.priceMax = priceMax === 0 ? null : priceMax;
    filters.priceMin = priceMin === 0 ? null : priceMin;
    filters.sex = sex;
    filters.size = pickedSizes.length ? new Set(pickedSizes) : null

    return filters
}

const onFilterButtonClick = () => {
    const filteredProduct = applyFilters(PRODUCTS, getFilters())

    renderCatalog(filteredProduct)
}

export const applyFilters = (products, filters) => {
    return products.filter(product => {
      if (filters.priceMin !== null && product.price < filters.priceMin) return false;
      if (filters.priceMax !== null && product.price > filters.priceMax) return false;
      if (filters.sex && product.sex !== filters.sex) return false;
      if (filters.size && !filters.size.has(product.size)) return false;
      return true;
    });
  };


window.addEventListener('load', function () {
    document.querySelector('.catalog_filtersButton').addEventListener('click', onFilterButtonClick)

    const sizeButtons = document.querySelectorAll('.catalog_filtersItemSizeItem');

    sizeButtons.forEach(sizeButton => {
        sizeButton.addEventListener('click', (e) => e.target.classList.toggle('catalog_filtersItemSizeItem-active'))
    });

});

function updatePriceDisplay(value) {
    const display = document.querySelector('.price-display');
    display.textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
}


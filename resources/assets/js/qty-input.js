// quantity input
document.querySelector('.qty-count--minus').addEventListener('click', () => {
    let qtySelector = document.querySelector('.product-qty');
    if (qtySelector.value > 1) {
        qtySelector.value--;
    }
});

document.querySelector('.qty-count--add').addEventListener('click', () => {
let qtySelector = document.querySelector('.product-qty');
qtySelector.value++;
});


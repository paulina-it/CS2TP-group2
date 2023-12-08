document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('input[type="number"]');
    function updateTotalPrice() {
        let totalPrice = 0;
        quantityInputs.forEach(input => {
            const priceAmount = input.parentElement.nextElementSibling;
            const price = parseFloat(priceAmount.textContent.replace('£', ''));
            const quantity = parseInt(input.value);
            totalPrice += price * quantity;
        });

        const totalPriceElement = document.querySelector('.totalPrice td:last-child');
        totalPriceElement.textContent = `£${totalPrice.toFixed(2)}`;
    }
    
    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotalPrice);
    });
});

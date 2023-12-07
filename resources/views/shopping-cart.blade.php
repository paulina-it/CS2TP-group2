<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="\CS2TP-group2\resources\assets\sass\components\_shoppingCart.scss">
    @vite(['resources/assets/sass/app.scss', 'resources/assets/js/cart.js'])
</head>
<body>
    @include('layouts.navigation')

    <h1 class="title">Shopping Cart</h1>

    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="/images/Anna-Karenina.jpg">
                        <div>
                            <p>Anna Karenina</p>
                            <small>Price: £12.90</small>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>                
                </td>
                <td><input type="number" value="1"></td>
                <td>£12.90</td>
            </tr>

            <tr>
                <td>
                    <div class="cart-info">
                        <img src="/images/Eugene-Onegin.jpg">
                        <div>
                            <p>Eugene Onegin</p>
                            <small>Price: £12.90</small>
                            <br>
                            <a href="">Remove</a>
                        </div>
                    </div>                
                </td>
                <td><input type="number" value="1"></td>
                <td>£12.90</td>
            </tr>

        </table>
        <div class="totalPrice">
            <table>
                <tr>
                    <td>Total</td>
                    <td>£25.80</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>£7.99</td>
                </tr>
            </table>
        </div>

        <div class="checkout-button">
            <button onclick="">Go To Checkout</button> <!-- add function for going to checkout page in js -->
        </div>

    </div>

    <div class="recommendedItems">
        <h2 class="like-container">You may also like...</h2>
        <div class="recommendedItems-container">
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 1">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 2">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 3">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>
            <div class="recommendedItem">
                <img src="/images/Anna-Karenina.jpg" alt="Item 4">
                <p>Anna Karenina</p>
                <small>Price: £12.90</small>
                <button>Add to Cart</button>
            </div>

        </div>
    </div>

    <script src="app.js"></script>
    <script src="cart.js"></script>

    @include('layouts.footer')

</body>
</html>
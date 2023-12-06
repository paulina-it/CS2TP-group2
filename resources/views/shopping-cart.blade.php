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

    <h1>Shopping Cart</h1>

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
                        <img src=public/images/Anna-Karenina.jpg>
                        <div>
                            <p>Anna Karenina</p>
                            <small>Price: £12.90</small>
                        </div>
                    </div>                
                </td>
                <td><input type="number" value="1"></td>
                <td>£12.90</td>
            </tr>
        </table>
    </div>

    <script src="app.js"></script>

    @include('layouts.footer')

</body>
</html>
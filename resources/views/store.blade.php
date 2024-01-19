<!DOCTYPE html>
<html>
    <head>
        <title>Store</title>
        <link href="{{ asset('css/store.css') }}" rel="stylesheet">
    </head>
    <body>
    <div class="add-products-form">
        <h3>Add a Product:</h3>
            <form action="/" method="post">
                @csrf
                <label for="productID">ID:</label>
                <input type="text" id="productID" name="productID" required>

                <label for="productName">Name:</label>
                <input type="text" id="productName" name="productName" required>

                <label for="productPrice">Price:</label>
                <input type="number" id="productPrice" name="productPrice" required>

                <input type="submit" name="addProduct" value="Add">
            </form>
        </div>
        <h1>Products:</h1>
       
        <div style="display: table-cell">
            <form action="/" method="post">
                @csrf
                <div class="items">
                    @foreach ($products as $product)
                    <div class='item'>
                        <div class='name'>{{ $product['name'] }}</div>
                        <div class='price'>{{ $product['price'] }}€</div>
                        <div class='input'><input type='number' id="amount-field" name="{{ $product['id'] }}" value='0'></div>
                    </div>
                    @endforeach
                </div>
                <center>
                    <input type="submit" name="addToCart" onclick="filterRequest()" value="add Items"></button>
                    <input type="submit" name="removeFromCart" onclick="filterRequest()" value="remove Items"></button>
                </center>
            </form>
        <h1>Cart:</h1>
        <table class="cart">
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Price</th>
            </tr>
                @if ($cart['total'] > 0)
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach (array_keys($cart['items']) as $key) <!-- iteriert jedes element der Schlüßel von $cart['items'] und gibt diese als Variable key wieder -->
                    <tr>
                        @if ($cart['items'][$key] > 0) 
                            <td>{{ $productName = $products[$key]['name'] }}</td>
                            <td>{{ $amount = $cart['items'][$key] }}</td>
                            <td>{{ $itemPrice = $products[$key]['priceCalc']($cart['items'][$key]) }}€</td>
                            @php
                                $totalPrice += $itemPrice;
                            @endphp
                        @endif
                    </tr>
                    @endforeach
                @endif
            <tr>
                @if ($cart['total'] > 0)
                    <td><b>Total:</b></td>
                    <td>{{ $cart['total'] }}</td>
                    <td>{{ $totalPrice }}€</td>
                @else
                    <td colspan="3">Cart is Empty</td>
                @endif
            </tr>
        </table>
        </div>
        <form action="/flush" method="POST">
            @csrf
            <button type="submit">Clear Cart</button>
        </form>
    </body>
    <script>
        function filterRequest() {
            var inputs = document.querySelectorAll("input[id='amount-field']");
            inputs.forEach(function(input) {
                if (input.value <= 0) {
                    input.removeAttribute("name");
                }
            });
        }
    </script>
</html>

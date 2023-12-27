<!DOCTYPE html>
<html>
    <head>
        <title>Store</title>
        <link href="{{ asset('css/store.css') }}" rel="stylesheet">
    </head>
    <body>
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
                    <input type="submit" onclick="filterRequest()" value="add To Cart"></button>
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
                    @foreach (array_keys($cart['items']) as $key) <!-- iteriert jedes element der Schlüßel von $cart['items'] und gibt diese als Variable key wieder -->
                    <tr>
                        <td>{{ $products[$key]['name'] }}</td>
                        <td>{{ $cart['items'][$key] }}</td>
                        <td>{{ $products[$key]['priceCalc']($cart['items'][$key]) }}€</td>
                    </tr>
                    @endforeach
                @endif
            <tr>
                @if ($cart['total'] > 0)
                    <td colspan="2"></td>
                    <td>hier kommt der Gesamtbetrag hin</td>
                @else
                    <td colspan="2"></td>
                    <td>Cart is Empty</td>
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

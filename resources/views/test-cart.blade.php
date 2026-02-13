<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Cart - Anti Diet Club</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Cart Test Page</h1>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Session Info</h2>
            <pre id="session-info" class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">Loading...</pre>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Cart Data</h2>
            <pre id="cart-data" class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">Loading...</pre>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Actions</h2>
            <button onclick="testAddToCart()" class="bg-blue-500 text-white px-4 py-2 rounded mr-2">Add Product 1</button>
            <button onclick="testGetCart()" class="bg-green-500 text-white px-4 py-2 rounded mr-2">Get Cart</button>
            <button onclick="testClearCart()" class="bg-red-500 text-white px-4 py-2 rounded">Clear Cart</button>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Response</h2>
            <pre id="response" class="bg-gray-800 text-yellow-400 p-4 rounded overflow-x-auto">No response yet</pre>
        </div>
    </div>

    <script>
        // Load session info on page load
        window.addEventListener('DOMContentLoaded', () => {
            getSessionInfo();
            getCartData();
        });

        function getSessionInfo() {
            fetch('/test-session')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('session-info').textContent = JSON.stringify(data, null, 2);
                })
                .catch(error => {
                    document.getElementById('session-info').textContent = 'Error: ' + error.message;
                });
        }

        function getCartData() {
            fetch('/test-cart-data')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('cart-data').textContent = JSON.stringify(data, null, 2);
                })
                .catch(error => {
                    document.getElementById('cart-data').textContent = 'Error: ' + error.message;
                });
        }

        function testAddToCart() {
            const formData = new FormData();
            formData.append('product_id', 1);
            formData.append('quantity', 1);

            fetch('/cart/add', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('response').textContent = JSON.stringify(data, null, 2);
                getSessionInfo();
                getCartData();
            })
            .catch(error => {
                document.getElementById('response').textContent = 'Error: ' + error.message;
            });
        }

        function testGetCart() {
            getSessionInfo();
            getCartData();
        }

        function testClearCart() {
            fetch('/test-clear-cart')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('response').textContent = JSON.stringify(data, null, 2);
                    getSessionInfo();
                    getCartData();
                })
                .catch(error => {
                    document.getElementById('response').textContent = 'Error: ' + error.message;
                });
        }
    </script>
</body>
</html>
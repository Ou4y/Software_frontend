<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/css/checkout.css?v=<?php echo time(); ?>">
    <title>checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include('../includes/header.php'); ?>

    <div class="container">
        <h1 class="page-title">Shopping Cart & Checkout</h1>
        
        <div class="cart-checkout-grid">
            <div class="cart-section">
                <div class="cart-items" id="cart-items">
                    <!-- Cart items will be dynamically loaded here -->
                </div>
            </div>

            <div class="checkout-section">
                <form id="checkout-form">
                    <div class="form-section">
                        <h2>Shipping Information</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" class="form-control" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="zipCode">ZIP Code</label>
                                <input type="text" id="zipCode" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h2>Payment Method</h2>
                        <div class="payment-methods">
                            <div class="payment-method selected">
                                <i class="fas fa-home"></i>
                                Cash on Delivery
                            </div>
                        </div>
                    </div>

                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax</span>
                            <span id="tax">$0.00</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span id="total">$0.00</span>
                        </div>
                        <button type="submit" class="checkout-btn">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Helper function to update cart totals
        function updateTotals() {
            let subtotal = 0;
            document.querySelectorAll('.cart-item').forEach(item => {
                const price = parseFloat(item.querySelector('.item-price').textContent.replace('$', ''));
                const quantity = parseInt(item.querySelector('.quantity-input').value);
                subtotal += price * quantity;
            });

            const tax = subtotal * 0.1; // 10% tax
            const total = subtotal + tax;

            // Update summary
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
        }

        // Load cart items from local storage
        function loadCartItems() {
            const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = ''; // Clear the container

            cartItems.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.classList.add('cart-item');
                itemElement.innerHTML = `
                    <img src="${item.productImage}" alt="${item.productImage}" class="item-image">
                    <div class="item-details">
                        <h3>${item.productTitle}</h3>
                        <p class="item-meta">Size: ${item.size} | Color: ${item.color}</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <input type="number" class="quantity-input" value="${item.quantity}" min="1">
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="item-price">$${item.price}</span>
                    <button class="remove-item" data-item-id="${item.productId}">
                        <i class="fas fa-times"> Remove</i>
                    </button>
                `;
                cartContainer.appendChild(itemElement);

                // Attach event listener to the remove button
                itemElement.querySelector('.remove-item').addEventListener('click', function (e) {
                    const itemId = e.target.closest('.remove-item').getAttribute('data-item-id');
                    removeItemFromCart(itemId);
                });
            });

            updateTotals();
        }

        // Remove item from cart and local storage
        function removeItemFromCart(itemId) {
            let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            cartItems = cartItems.filter(item => item.productId !== itemId);
            localStorage.setItem('cart', JSON.stringify(cartItems));
            loadCartItems(); // Reload the cart items
        }

        // Quantity Controls
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('quantity-btn')) {
                const itemElement = e.target.closest('.cart-item');
                const input = itemElement.querySelector('.quantity-input');
                const itemId = itemElement.querySelector('.remove-item').getAttribute('data-item-id');

                if (e.target.textContent === '-') {
                    if (input.value > 1) {
                        input.value = parseInt(input.value) - 1;
                    }
                } else {
                    input.value = parseInt(input.value) + 1;
                }

                // Update local storage with new quantity
                updateCartItemQuantity(itemId, input.value);
                updateTotals();
            }
        });

        // Update item quantity in local storage
        function updateCartItemQuantity(itemId, quantity) {
            let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
            cartItems = cartItems.map(item => {
                if (item.productId === itemId) {
                    item.quantity = quantity;
                }
                return item;
            });
            localStorage.setItem('cart', JSON.stringify(cartItems));
        }

        // Handle form submission
       // Handle form submission
document.querySelector('#checkout-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Get the cart items from local storage
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

    // Get the checkout details
    const paymentType = document.querySelector('.payment-method.selected').textContent.trim();
    const totalAmount = parseFloat(document.getElementById('total').textContent.replace('$', ''));

    // Ensure there are items in the cart before submitting
    if (cartItems.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    if (isNaN(totalAmount) || totalAmount <= 0) {
        alert("Invalid total amount.");
        return;
    }

    // Create the data to send
    const formData = new FormData();
    formData.append('cart_items', JSON.stringify(cartItems));
    formData.append('payment_type', paymentType);
    formData.append('total_amount', totalAmount);

    // Send the data via AJAX to the backend
    fetch('/path/to/CheckoutController.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Make sure your backend returns JSON
    .then(result => {
        if (result.success) {
            alert("Order placed successfully!");
            // Optionally clear the cart and redirect the user
            localStorage.removeItem('cart');
            window.location.href = '/thank-you'; // Redirect to a thank-you page or similar
        } else {
            alert(result.message || 'There was an error placing your order.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('There was an error placing your order.');
    });
});

        // Initialize cart items
        loadCartItems();
    </script>

<?php include('../includes/Footer.php'); ?>

</body>
</html>

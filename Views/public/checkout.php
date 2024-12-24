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
                <div class="cart-items">
                    <div class="cart-item">
                        <img src="../Assets/images/Product1.png?height=400&width=400" alt="Winter Jacket" class="item-image">
                        <div class="item-details">
                            <h3>Premium Winter Jacket</h3>
                            <p class="item-meta">Size: M | Color: Black</p>
                        </div>
                        <div class="quantity-controls">
                            <button class="quantity-btn">-</button>
                            <input type="number" value="1" min="1" class="quantity-input">
                            <button class="quantity-btn">+</button>
                        </div>
                        <span class="item-price">$299</span>
                        <button class="remove-item">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="cart-item">
                        <img src="../Assets/images/Product1.png?height=400&width=80" alt="Casual Sneakers" class="item-image">
                        <div class="item-details">
                            <h3>Casual Sneakers</h3>
                            <p class="item-meta">Size: 42 | Color: White</p>
                        </div>
                        <div class="quantity-controls">
                            <button class="quantity-btn">-</button>
                            <input type="number" value="1" min="1" class="quantity-input">
                            <button class="quantity-btn">+</button>
                        </div>
                        <span class="item-price">$159</span>
                        <button class="remove-item">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
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
                                <i class="fas fa-credit-card"></i>
                                Credit Card
                            </div>
                            <div class="payment-method">
                                <i class="fab fa-paypal"></i>
                                PayPal
                            </div>
                        </div>
                    </div>

                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>$458.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax</span>
                            <span>$45.80</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span>$503.80</span>
                        </div>
                        <button type="submit" class="checkout-btn">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Quantity Controls
        document.querySelectorAll('.quantity-controls').forEach(control => {
            const input = control.querySelector('.quantity-input');
            const [decreaseBtn, increaseBtn] = control.querySelectorAll('.quantity-btn');

            decreaseBtn.addEventListener('click', () => {
                const currentValue = parseInt(input.value);
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                    updateTotals();
                }
            });

            increaseBtn.addEventListener('click', () => {
                input.value = parseInt(input.value) + 1;
                updateTotals();
            });

            input.addEventListener('change', updateTotals);
        });

        // Remove Item
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', () => {
                const cartItem = button.closest('.cart-item');
                cartItem.remove();
                updateTotals();
            });
        });

        // Payment Method Selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', () => {
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('selected');
                });
                method.classList.add('selected');
            });
        });

        // Form Submission
        document.getElementById('checkout-form').addEventListener('submit', (e) => {
            e.preventDefault();
            // Add your order processing logic here
            alert('Order placed successfully!');
        });

        // Update Totals
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
            const summaryRows = document.querySelectorAll('.summary-row');
            summaryRows[0].querySelector('span:last-child').textContent = `$${subtotal.toFixed(2)}`;
            summaryRows[2].querySelector('span:last-child').textContent = `$${tax.toFixed(2)}`;
            document.querySelector('.summary-total span:last-child').textContent = `$${total.toFixed(2)}`;
        }
    </script>


<?php include('../includes/Footer.php'); ?>


</body>
</html>
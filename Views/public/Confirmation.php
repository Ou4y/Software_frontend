<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Fashion Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --ma-primary: #1a1a1a;
            --ma-secondary: #333;
            --ma-success: #22c55e;
            --ma-background: #ffffff;
            --ma-text: #333333;
            --ma-muted: #666666;
            --ma-border: #e5e5e5;
            --ma-shadow: rgba(0, 0, 0, 0.1);
        }

        .ma-confirm-wrapper * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .ma-confirm-wrapper {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.5;
            color: var(--ma-text);
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .ma-confirm-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .ma-confirm-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 4px var(--ma-shadow);
            text-align: center;
        }

        .ma-confirm-icon {
            width: 80px;
            height: 80px;
            background: #dcfce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
        }

        .ma-confirm-icon i {
            font-size: 40px;
            color: var(--ma-success);
        }

        .ma-confirm-title {
            font-size: 1.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--ma-primary);
        }

        .ma-confirm-message {
            color: var(--ma-muted);
            margin-bottom: 2rem;
        }

        .ma-confirm-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .ma-detail-group {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--ma-border);
        }

        .ma-detail-group:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .ma-detail-label {
            color: var(--ma-muted);
            font-weight: 500;
        }

        .ma-detail-value {
            font-weight: 600;
            color: var(--ma-primary);
        }

        .ma-confirm-steps {
            text-align: left;
            margin-bottom: 2rem;
        }

        .ma-steps-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .ma-steps-list {
            list-style: none;
        }

        .ma-step-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            margin-bottom: 0.75rem;
            color: var(--ma-muted);
        }

        .ma-step-item i {
            margin-top: 0.25rem;
            color: var(--ma-success);
        }

        .ma-confirm-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            background: var(--ma-primary);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.3s;
            cursor: pointer;
        }

        .ma-confirm-btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 640px) {
            .ma-confirm-card {
                padding: 1.5rem;
            }

            .ma-confirm-icon {
                width: 60px;
                height: 60px;
            }

            .ma-confirm-icon i {
                font-size: 30px;
            }

            .ma-confirm-title {
                font-size: 1.5rem;
            }

            .ma-detail-group {
                flex-direction: column;
                gap: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <div class="ma-confirm-wrapper">
        <div class="ma-confirm-container">
            <div class="ma-confirm-card">
                <div class="ma-confirm-icon">
                    <i class="fas fa-check"></i>
                </div>
                
                <h1 class="ma-confirm-title">Order Confirmed!</h1>
                <p class="ma-confirm-message">Thank you for your purchase. We'll send you a confirmation email with your order details.</p>

                <div class="ma-confirm-steps">
                    <h2 class="ma-steps-title">What's Next?</h2>
                    <ul class="ma-steps-list">
                        <li class="ma-step-item">
                            <i class="fas fa-envelope"></i>
                            <span>You'll receive an order confirmation email with details of your order</span>
                        </li>
                        <li class="ma-step-item">
                            <i class="fas fa-box"></i>
                            <span>We'll notify you when your order has been shipped</span>
                        </li>
                        <li class="ma-step-item">
                            <i class="fas fa-truck"></i>
                            <span>Your order will be delivered within 3-5 business days</span>
                        </li>
                    </ul>
                </div>

                <a href="index.php" class="ma-confirm-btn">
                    <i class="fas fa-shopping-bag"></i>
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</body>
</html>
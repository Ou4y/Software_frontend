<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store</title>
    <link rel="stylesheet" type="text/css" href="../Assets/css/Header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container header-content">
            <a href="../public/index.php" class="logo">X</a>
            <button class="nav-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <nav>
                <ul class="nav-menu">
                    <li><a href="../public/index.php" class="nav-link">Home</a></li>
                    <li><a href="../public/Browse.php" class="nav-link">Browse</a></li>
                    <li><a href="../public/Size.php" class="nav-link">Size Chart</a></li>
                </ul>
            </nav>
            
            <a href="../public/checkout.php" class="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count"></span>
            </a>
            


            <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])): ?>
            <a href="../public/myaccount.php" class="nav-link">My Account</a>
            <?php else: ?>
    
            <a href="../public/LoginSignup.php" class="nav-link">Login</a>
           <?php endif; ?>

        </div>
    </header>
</body>
</html>

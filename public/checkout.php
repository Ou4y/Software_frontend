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
    <div class="item">
    <img id="itemimg" src="../Assets/images/Product1.png"alt="product">
    <h1>special jersey royal black star</h1>
        <h3>size:M</h3>
        <h3>quantity:1</h3>
        <h2>450 LE</h2>
        <i class="fa-solid fa-trash-can fa-2x"></i>

</div>


<div class="payment">
<div class="dropdown" >
    <button class="dropdown-btn" onclick="toggleDropdown()">Shipment and Info</button>
    <div id="shipment-info" class="dropdown-content">
        <label for="full-name">Full Name:</label>
        <input type="text" id="full-name" name="full-name" placeholder="Enter full name">
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" placeholder="Enter address">

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone number">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter email">
    </div>

    <hr class="custom-line">


<div class="radio">
<label>
    <input type="radio" name="payment" value="visa" onclick="toggleVisaInfo(true)" >
    Visa
</label>
<br>

<label>
    <input type="radio" name="payment" value="cash_on_delivery" onclick="toggleVisaInfo(false)" >
    Cash on Delivery
</label>
</div>

<hr class="custom-line">


<div id="visa-info" class="form-block visa-info">
<h3>Visa Information</h3>

<label for="card-number">Card Number:</label>
<input type="text" id="card-number" name="card-number" placeholder="Card Number" >
<br>

<label for="expiry-date">Expiry Date:</label>
<input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" >
<br>

<label for="cvv">CVV:</label>
<input type="text" id="cvv" name="cvv" placeholder="CVV" >
</div>
<button class="button" type="submit">Confirm Order</button>

</div>



<div class="total">
<h4>shipping=50</h4>
 <h4>tshirt=450</h4>
 <h2>total=500</h2>
</div>
</div>
</div>
</div>

<script>
function toggleVisaInfo(show) {
const visaInfo = document.getElementById('visa-info');
visaInfo.style.display = show ? 'block' : 'none';
}
function toggleDropdown() {
    const dropdownContent = document.getElementById('shipment-info');
    dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
}

</script>


<?php include('../includes/Footer.php'); ?>


</body>
</html>
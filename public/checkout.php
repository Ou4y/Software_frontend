<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../Assets/css/checkout.css">
    <title>checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<?php include('../includes/header.php'); ?>



    <div class="item">
    <img id="itemimg" src="../Assets/images/Product1.png"alt="product">
    <h1>special jersey royal black star</h1>
        <h3>size:M</h3>
        <h3>quantity:1</h3>
        <h2>450 LE</h2>
        <i class="fa-solid fa-trash-can"></i>
</div>


<div class="confirm">
    <div class="account">
    <label for="checkbox1">Account</label>
    <input type="checkbox" id="checkbox1">   
 </div>



 <div class="payment">
 <h3>Payment Method</h3>

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

<div class="button-group">
<button type="button" onclick="  window.history.back()">Back</button>
<button type="submit">Confirm Order</button>
</div>
</div>



<div class="total">
<h3>shipping=50</h3>
 <h3>tshirt=450</h3>
 <h2>total=500</h2>
</div>

</div>

<script>
function toggleVisaInfo(show) {
const visaInfo = document.getElementById('visa-info');
visaInfo.style.display = show ? 'block' : 'none';
}
</script>


<?php include('../includes/Footer.php'); ?>


</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" type="text/css" href="../Assets/css/Product.css">
</head>
<body>



<?php include('../includes/header.php'); ?>



<main class="container">
 

 <div class="left-column">
   <img data-image="black" src="../Assets/images/Product1.png" alt="">
   <img data-image="blue" src="../Assets/images/Product1.png" alt="">
   <img data-image="red" class="active" src="../Assets/images/Product1.png" alt="">
 </div>


 <div class="right-column">

   <div class="product-description">
     <span>MEN</span>
     <h1>Special Jersey “Royal black Star”</h1>
     <p>Special Jersey “Royal black Star”Special Jersey “Royal black Star”</p>
   </div>

   <div class="product-configuration">


     <div class="product-color">
       <span>Color</span>

       <div class="color-choose">
         <div>
           <input data-image="red" type="radio" id="red" name="color" value="red" checked>
           <label for="red"><span></span></label>
         </div>
         <div>
           <input data-image="blue" type="radio" id="blue" name="color" value="blue">
           <label for="blue"><span></span></label>
         </div>
         <div>
           <input data-image="black" type="radio" id="black" name="color" value="black">
           <label for="black"><span></span></label>
         </div>
       </div>

     </div>


     <div class="cable-config">
       <span>Cable configuration</span>

       <div class="cable-choose">
         <button>X-Large</button>
         <button>Large</button>
         <button>Small</button>
       </div>

     </div>
   </div>


   <div class="product-price">
     <span>700 EGP</span>
     <a href="#" class="cart-btn">Add to cart</a>
   </div>
 </div>



</main>


<?php include('../includes/Footer.php'); ?>

</body>
</html>
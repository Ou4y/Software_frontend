    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../Assets/css/myaccount.css">
        <title>myaccount</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    </head>
    <body>


    <?php include('../includes/header.php'); ?>



  <div class="form1">
<div class="buttons">
<button onclick="showForm()">My Account</button>
<i class="fa-solid fa-user"></i>
<button>History</button>
<i class="fa-solid fa-clock-rotate-left"></i>
<button>Logout</button>
<i class="fa-solid fa-user-xmark"></i>
</div>
<div class="accountForm"id="accountForm">


<div class="profileimg">
<img id="itemimg" src="../Assets/images/profilePic.png"alt="profile ">

</div>


<div class="acc info">
<label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName"><br>
                
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName"><br>
                
                <label for="birthDate">Birth Date:</label>
                <input type="date" id="birthDate" name="birthDate"><br>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address"><br>

                <button type="submit">Save</button>
                </div>
</div>
  </div>
<script>
        function showForm() {
            const form = document.getElementById("accountForm");
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";  // Show the form
            } else {
                form.style.display = "none";  // Hide the form if it's already shown
            }
        }
    </script>


<?php include('../includes/Footer.php'); ?>



    </body>
    </html>
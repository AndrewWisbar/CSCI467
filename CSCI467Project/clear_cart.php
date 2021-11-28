<?php
session_start();
$_SESSION['cart'] = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Parts | Ecommerce Wedbsite </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="header">
    <div class="container">
      <div class="navbar">
          <div class="logo">
              <a href="index.php"><img src="pics/logo.jpeg" width="100px" height="50px"></a>
          </div>
          <nav>
            <ul id="MenuItems">
              <li> <a href="index.php">Home</a></li>
              <li> <a href="products.php">Products</a></li>
              <li> <a href="user_account.php">Login</a></li>
            </ul>
          </nav>
          <a href="cart.php"><img src="pics/view_cart.png" width="30px" height="30px"></a>

          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>

      <div class='small-container'>
        <h2 class='title'>Your Cart Has Been Cleared! </h2>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <style>
          .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
          }
          </style>

          <div class="container">
            <div class="center">
              <a href="products.php" class='btn'>Continue Shopping</a>
            </div>
          </div>
      </div>


          <!---------- js for toggle menu --------->
          <script>
            var MenuItems = document.getElementById("MenuItems");
            MenuItems.style.maxHeight = "0px";

            function menutoggle(){
              if(MenuItems.style.maxHeight == "0px")
                {
                  MenuItems.style.maxHeight = "200px"
                }
              else
                {
                  MenuItems.style.maxHeight = "0px"
                }
            }
          </script>



</body>
</html>
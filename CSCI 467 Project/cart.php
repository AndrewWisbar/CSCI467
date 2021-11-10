<?php

include 'database_connection.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - Auto Pars </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="header">
    <div class="container">
      <div class="navbar">
          <div class="logo">
              <img src="pics/logo.jpeg" width="120px" height="80px">
          </div>
          <nav>
            <ul id="MenuItems">
              <li> <a href="index.php">Home</a></li>
              <li> <a href="products.php">Products</a></li>
              <li> <a href="user_account.php">Login</a></li>
            </ul>
          </nav>
          <img src="pics/view_cart.png" width="30px" height="30px">
          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>
    </div>
    </div>
    <br>
    <br>
    <br>
    <br>


<!-----------cart items details --------->
<div class="small-container cart-page">
  <table style="width:400px">
    <tr>
      <th style="width:600px">Product<br> </th>
      <th style="width:600px" >Quantity <br> </th>
      <th>Price <br> </th>
    </tr>

    <?php
      session_start();
      $cartTotal = 0;
      if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
          echo "<tr><td><br><br><div class='cart-info'><img src='" . $item[0] .
          "' width='80%'><div><p>" . $item[1] . "</p><small> Price: $" . $item[2] .
                "</small><br><br><br><br></div></div></td><td style='text-align:center'>" . $item[3] .
                "</td><td>$" . $item[2] * $item[3] . "</td></tr>";
              $cartTotal += $item[2] * $item[3];
          }
        }


     ?>

  </table>

  <div class="total-price">
    <table>
      <tr>
        <td>Subtotal</td>
        <td>$<?php echo $cartTotal ?></td>
      </tr>
      <tr>
        <td>Tax</td>
        <td>$<?php echo round(.115 * $cartTotal, 2) ?></td>
      </tr>
      <tr>
        <td>Shipping</td>
        <td>$17</td>
      </tr>
      <tr>
        <td>Total</td>
        <td>$<?php $_SESSION['totalcost'] = round(1.115 * $cartTotal + 17, 2); echo $_SESSION['totalcost']; ?></td>
      </tr>
      <tr>
        <td> <a href='credit_card.php?price=' class='btn'>checkout</a> </td>
      </tr>
  </div>
      <tr>
        <td><a href='clear_cart.php' type=submit class='btn'>Clear Cart</a></td>
      </tr>
</div>
</div>
</table>
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


<!---------- footer --------->
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="footer-col-1">
        <!-- <p> Created By Enkhamgalan Tamillow</p> -->
        <h3>Download Our App</h3>
        <p>Download App for Android and iPhone. </p>
      </div>
      <div class="footer-col-2">
        <br>
        <br>
        <br>
        <img src="pics/logo.jpeg" width="100px">
      </div>

    </div>

  </div>

</div>
</body>
</html>
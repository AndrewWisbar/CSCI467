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
          <a href="cart.php"><img src="pics/view_cart.png" width="30px" height="30px"></a>
          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>
    </div>
    </div>
    <br>
    <br>
    <br>
<!--------single product details---------->

    <div class="small-container single-product">
      <div class="row">
        <div class="col-2">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <img src="<?php echo $_GET['picture'];?>" width="130%">
        </div>
        <div class="col-2">
          <br>
          <br>
          <br>
          <h2> <?php echo $_GET['description'];?> </h2>
          <br>
          <h4>$ <?php echo $_GET['price']; ?> </h4>

          <form name="form" action="" method="post">
            <input type="number" name="quantity" class="form-control" value=1 min=1>
            <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
            <?php
              session_start();
              if (!isset($_SESSION['cart'])) {
                  $_SESSION['cart'] = [];
              }
              if (isset($_POST['quantity'])) {
                array_push($_SESSION['cart'], [$_GET['picture'], $_GET['description'], $_GET['price'], $_POST['quantity']]);
              }
            ?>
          </form>

          <!-- <a href="add_to_cart.php" class="btn">Add To Cart</a> -->

          <p>Weight: <?php echo $_GET['weight'];?> </p>
          <br>
          <br>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>

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
        <br>
        <br>
        <br>
        <!-- <p> Created By Ethan Johnson</p> -->
        <h3>Download Our App</h3>
        <p>Download App for Android and iPhone. </p>
      </div>
      <div class="footer-col-2">
        <img src="downloads/autoparts.jpg" width="50px">
      </div>
    </div>
    <br>
    <br>
    <br>
  </div>
</div>
</body>
</html>

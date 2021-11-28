<?php
// session_start();

// $_SESSION['cart'] = [];

include 'database_connection.php'

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
              <a href="index.php"><img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg width="100px" height="50px"></a>
          </div>
          <nav>
            <ul id="MenuItems">
              <li> <a href="index.php">Home</a></li>
              <li> <a href="products.php">Products</a></li>
              <li> <a href="user_account.php">Login</a></li>
            </ul>
          </nav>
          <a href="cart.php"><img src="https://cdn3.vectorstock.com/i/1000x1000/43/22/shopping-cart-logo-design-vector-21804322.jpg" width="50px" height="50px"></a>

          <img src="https://thumbs.dreamstime.com/z/vector-logo-car-parts-auto-repair-180248070.jpg" class="menu-icon" onclick="menutoggle()">
      </div>
      <div class="row">
          <div class="col-2">
              <h1>Welcome to<br> the NIU Auto Repair Shop! </h1>
              <p> Looking for auto parts? <br> You are
                in the right place! <br>We have everything you need!
		Created by Ethan, Andrew, Thomas and William
              </p>
              <a href="products.php" class="btn">Shop Now &#8594;</a>
          </div>
          <div class="col-2">
              <img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg" width= "100px" height="100px">
          </div>
      </div>
    </div>
    </div>

<!-------- Top Sellers -------->
<div class='small-container'>
  <h2 class='title'>Top Sellers </h2>
  <?php
  /* change character set to utf8 */
  $conn->set_charset("utf8");

  // Collects data from "parts" table
  $sql = "SELECT * FROM parts LIMIT 12";
  $result = $conn->query($sql);
  echo "<div class='small-container'>";
  echo "<div class='row'>";
  if ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) {
      echo "<div class='col-4'>";
  		echo "<a href='product_details.php?price='" . $row['price'] . "&description="
      . $row['description'] . "&picture=" . $row['pictureURL'] . "&weight="
      . $row['weight'] . "></a><img src=" . $row['pictureURL'] . ">";
      echo "<a href='product_details.php?price=" . $row['price'] . "&description="
      . $row['description'] . "&picture=" . $row['pictureURL'] . "&weight="
      . $row['weight'] . "'><h4>" . $row['description'] . "</h4>" . "</a>";
      echo "<p>" . $row['price'] . "</p>";
      echo "</div>";
  	}
  } else {
  	Print "0 records found";
  }
  $conn->close();

  ?>
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
        <br>
        <br>
        <br>
        <!-- <p> Created by Ethan Johnson</p> -->
        <h3>Download Our App</h3>
        <p>Download App for Android and iPhone. </p>
      </div>
      <div class="footer-col-2">
        <br>
        <br>
        <br>
        <img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg%20width=" width="200px">
      </div>
    </div>
    <br>
    <br>
    <br>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>

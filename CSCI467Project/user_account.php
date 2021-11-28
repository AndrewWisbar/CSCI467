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
              <img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg" width="120px" height="80px">
          </div>
          <nav>
            <ul id="MenuItems">
              <li> <a href="index.php">Home</a></li>
              <li> <a href="products.php">Products</a></li>
              <li> <a href="user_account.php">Login</a></li>
            </ul>
          </nav>
          <a href="cart.php"><img src="https://cdn3.vectorstock.com/i/1000x1000/43/22/shopping-cart-logo-design-vector-21804322.jpg" width="50px" height="50px"></a>
          <img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg" class="menu-icon" onclick="menutoggle()">
      </div>
    </div>
  </div>
<!------------account-page--------------->
    <div class="account-page">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg" width="200%" height="200px">
            <br>
            <br>
          </div>
          <div class="col-2">
            <div class="form-container">
              <div class="form-btn">
                <span onclick="login()">Login</span>
                <span onclick="register()">Register</span>
                <hr id="Indicator">
              </div>
              <form id="LoginForm">
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">
                <button type="submit" name="btn">Login</button>
                <br>
                <a href="">Forgot password</a>
              </form>
              <form id="RegForm">
                <input type="text" placeholder="Username">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <button type="submit" name="btn">Register</button>
                <br>
                <a href="">Forgot password</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
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
        <br>
        <br>
        <br>
        <img src="https://thumbs.dreamstime.com/b/vector-logo-car-parts-auto-repair-180248070.jpg" width="100px">
      </div>
    </div>
    <br>
    <br>
    <br>
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
<!---------- js for for toggle form --------->
    <script>
      var LoginForm = document.getElementById("LoginForm");
      var RegForm = document.getElementById("RegForm");
      var Indicator = document.getElementById("Indicator");
        function register(){
            RegForm.style.transform = "translateX(0px)";
            LoginForm.style.transform = "translateX(0px)";
            Indicator.style.transform = "translateX(100px)";
        }
        function login(){
            RegForm.style.transform = "translateX(300px)";
            LoginForm.style.transform = "translateX(300px)";
            Indicator.style.transform = "translateX(0px)";
        }
    </script>
</body>
</html>

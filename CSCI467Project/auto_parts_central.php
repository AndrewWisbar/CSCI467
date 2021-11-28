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
            <img src="logo.jpeg" width="100px" height="50px">
          </div>
          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>
    </div>
  </div>
<!------------account-page--------------->
            <form method="post">
              <style >
                .center{
                  margin-left: auto;
                  margin-right: auto;
                }
              </style>
              <table class="center" style="width:30%;">
                  <tr>
                    <td><h2 class="title">Welcome to Auto Parts</h2></td>
                  </tr>
                  <tr>
                    <a href=""><td><input type="text" placeholder="Username"></td></a>
                  </tr>
                  <tr>
                  <a href=""> <td><input type="password" placeholder="Password"></td></a>
                  </tr>
                  <tr>
                  <td><input  type="submit" formaction="warehouse.php" class="btn" value="Warehouse"/></td>
                  </tr>
                  <tr>
                  <td><input type="submit" formaction="inventory.php" class="btn" value="Recieving Desk"/></td>
                  </tr>
                  <tr>
                  <td><input type="submit" formaction="shippingcost.php" class="btn" value="Managment"/></td>
                  </tr>
              </table>
            </form>
</body>
</html>
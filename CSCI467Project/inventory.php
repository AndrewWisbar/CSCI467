<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Parts | Ecommerce Warehouse </title>
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
		    <h1 class='title'>Warehouse Inventory Receiving Desk</h1>
		  <form action="http://students.cs.niu.edu/~z1826490/inventory.php" method="POST">
        <style >
          .center{
            margin-left: auto;
            margin-right: auto;
          }
        </style>
        <table class="center" style="width:30%;">
        <tr>
          <td><h3>Please fill out the information below</h></td>
        </tr>
        <tr>
          <td><p>If you forget the part_number, you can choose to enter description</p></td>
        </tr>
		    <tr>
          <td><label for = part_number>Part_number:</label><input type = "number" name = "part_number"><br></td>
        </tr>
		    <tr>
          <td><h5><label for = description>Description:</label><input type = "text" name = "description"></h5></td>
        </tr>
        <tr>
          <td><label for = quantityAvailable>Quantity:</label><input type = "number" name = "quantity"><br></td>
        </tr>
        <tr>
          <td><input type = "submit" class="btn" value = "Add to the inventory"></td>
        </tr>
        </table>
      </form>
</body>
</html>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"></link>
    <title>Auto Store</title>
</head>
<body>
    <form action="cart.php" method="post" id="cart_form"></form>
    <div id="header">
        <img src="wrench.png" alt="" id='logo'>
        <a href="index.php" class="invis-link">
            <h1 id="page-title">Auto Parts Store</h1>
        </a>
        <div id="search-div">
            <form action="./search_results.php" method="post" id="search-form">
                <input type="text" value="Search For Products" name="srch-field" id="srch-field">
                <input type="submit" form="search-form">
            </form>
        </div>
        <button type='submit' class='nav-btn' form='cart_form'>Cart</button>
    </div>
    <form action="./add_cart.php" method="post" id="add_form">
        <div class="prod-container">
            <?php
                /*
                prod_page.php

                This page is displayed when a user views a specific part,
                It shows the image the name/description of the product, as well as
                the available quantity
                */

                include "../Backend/PHP/connect.php";
                include "funcs.php";
                
                //connect to the legacy
                $leg_conn = legacy_connect();

                //get the details of the item
                $query = "SELECT * FROM parts \nWHERE number = " . $_GET['item'] . "\nLIMIT 1";
                $result = $leg_conn->query($query);
                if($result) {
                    $row = $result->fetch_assoc();
                }

                //get the qunatity of the item on hand
                $conn = open_connection();
                $query = "SELECT Quantity FROM inventory \nWHERE ItemID = " . $_GET['item'];
                $res2 = $conn->query($query);

                if($res2) {
                    $row2 = $res2->fetch_assoc();
                }

                //generate the HTML to show the item details

                //image
                print('<img src="' . $row['pictureURL'] . '" alt="product picture" class="main-img">');
                
                print('<div class="prod-info">');
                
                //name/description
                print('<h2>' .$row['description']. '</h2>');
                print('<div class="flex-container">');
                
                //price
                print('<p class="prod-price">$' . $row['price'] . '</p>');
                //quantity available
                print('<p class="prod-qty">Number Available: ' .$row2['Quantity']. '</p>');
                print('</div>');
                print('<div class="flex-container">');

                //quantity to add to cart
                print('<input type="number" id="qty" name="qty" value="1" min="1" max="' .$row2['Quantity']. '">');
                
                //add to cart button
                print('<button type="submit" name="add_to_cart" value="' . $row['number'] . '" class="add-btn">Add to Cart</button>');
                print('</div>');
            ?>
        </div></div>
    </form>
</body>
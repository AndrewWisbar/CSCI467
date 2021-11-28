<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"></link>
    <title>Auto Store</title>
</head>
<body>
    <form action="./clear_cart.php" method="post" id="clear_form"></form>
    <form action="./order_processing.php" method='post' id="submit_form"></form>
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
        <button class='nav-btn'>Home</button>
    </div>
    <h1>Your Cart:</h1>
    <form action="./update_cart.php" method='post' id="update_form">
        <?php
            session_start();
            include '../Backend/PHP/connect.php';
            $leg_conn = legacy_connect();
            $total_price = 0;
            $total_weight = 0;
            if(count($_SESSION['shopping_cart']) > 0) {
                print('<table class="cart_table">');
                print('<tr><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>');
                
                while($entry = current($_SESSION['shopping_cart'])) {
                
                    $query = "SELECT * FROM parts \nWHERE number = " . key($_SESSION['shopping_cart']) . "\nLIMIT 1";

                    $result = $leg_conn->query($query);

                    if($result) {
                        $row = $result->fetch_assoc();
                    }

                    print('<tr><td><img src="' . $row['pictureURL'] . '" alt=""></td><td>' . $row['description'] . '</td><td>' . $row['price'] . '</td><td><input type="number" value="' . $entry . '" min=0 max=99 name="' . key($_SESSION['shopping_cart']) . '" id="' . key($_SESSION['shopping_cart']) . '"></td><td>' . $entry * $row['price'] . '</td></tr>');
                    $total_price += $entry * $row['price'];
                    $total_weight += $entry * $row['weight'];
                    next($_SESSION['shopping_cart']);
                }
                print('</table>');
            }
            else {
                print("<h2>No Items in Cart</h2>");
            }
        ?>
    </form>
    <h3>Sub Total: $<?php print($total_price); ?></h3>
    <h3>Shipping Weight: <?php print($total_weight); ?></h3>
    <h3>Shipping Cost: $<?php print("0"); ?></h3>
    <h3>Total Price: $<?php print($total_price); ?></h3>
    <button type="submit" class="add_btn" form='update_form'>Update Cart</button>
    <button type="submit" class="add_btn" form='clear_form'>Clear Cart</button>
    <button type="submit" class="add_btn" form='submit_form'>Submit Order</button>
</body>
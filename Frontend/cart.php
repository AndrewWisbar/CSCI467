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
    <form action="./shipping_info.html" method='post' id="submit_form"></form>
    <form action="./" method='post' id="home_form"></form>
    <div id="header">
        <img src="wrench.png" alt="" id='logo'>
        <a href="index.php" class="invis-link">
            <h1 id="page-title">Auto Parts Store</h1>
        </a>
        <div id="search-div">
            <form action="./search_results.php" method="post" id="search-form">
                <input type="text" value="Search For Products" name="srch-field" id="srch-field">
                <input type="submit" form="search-form">
                <button type="submit" name="view-all" value=1 form="search-form">View All</button>
            </form>
        </div>
        <button type='submit' class='nav-btn' form='home_form'>Home</button>
    </div>
    <h1>Your Cart:</h1>
    <form action="./update_cart.php" method='post' id="update_form">
        <?php
        /*
        cart.php

        This script displays the items stored in a customers cart,
        as well as the sub total price, shipping price, total price and weight of the order
        */
            //Get session vars
            session_start();

            //needed for db connections
            include '../Backend/PHP/connect.php';
            
            //connect to both dbs
            $leg_conn = legacy_connect();
            $conn = open_connection();

            //set counters to 0
            $sub_price = 0;
            $total_weight = 0;

            //if we don't have a cart, make an empty one
            //to avoid errors
            if(!isset($_SESSION['shopping_cart'])) {
                $_SESSION['shopping_cart'] = array();
            }

            //if the cart has an item in it
            if(count($_SESSION['shopping_cart']) > 0) {
                print('<table class="cart_table">');
                print('<tr><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>');
                
                //for each item in the cart
                while($entry = current($_SESSION['shopping_cart'])) {
                
                    //get the part data from the legacy db
                    $query = "SELECT * FROM parts \nWHERE number = " . key($_SESSION['shopping_cart']) . "\nLIMIT 1";
                    $result = $leg_conn->query($query);
                    if($result) {
                        $row = $result->fetch_assoc();
                    }

                    //get the number in our inventory from new db
                    $query = "SELECT Quantity FROM inventory \nWHERE ItemID = " . key($_SESSION['shopping_cart']);
                    $res2 = $conn->query($query);
                    if($res2) {
                        $row2 = $res2->fetch_assoc();
                    }
    
                    //print the table row
                    print('<tr><td><img src="' . $row['pictureURL'] . '" alt=""></td>
                               <td>' . $row['description'] . '</td>
                               <td>' . $row['price'] . '</td>
                               <td><input type="number" value="' . $entry . '" min=1 max='.$row2['Quantity'].' name="' . key($_SESSION['shopping_cart']) . '" id="' . key($_SESSION['shopping_cart']) . '"></td>
                               <td>' . $entry * $row['price'] . '</td>
                               <td><button type="submit" name="remove" value="' . key($_SESSION['shopping_cart']) . '">Remove Item</button></td></tr>');
                    
                    //add up price and weight
                    $sub_price += $entry * $row['price'];
                    $total_weight += $entry * $row['weight'];

                    //get the next item
                    next($_SESSION['shopping_cart']);
                }
                print('</table>');


                //query for shipping rate
                $query = "SELECT rate FROM shiprate
                          WHERE bound = (SELECT MAX(bound)
                                         FROM shiprate
                                         WHERE bound <= ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $total_weight);
                $stmt->execute();

                //save our result in session
                $result = $stmt->get_result();
                $_SESSION['shipping'] = $result->fetch_row()[0];


                //print the totals/buttons
                //(This is awkward but we dont want them to display if there's no items in cart)
                print('<h3>Sub Total: $' . $sub_price . '</h3>');
                print('<h3>Shipping Weight:' . $total_weight . '</h3>');
                $_SESSION['totalWeight'] = $total_weight;
                print('<h3>Shipping Cost: ' . $_SESSION['shipping'] . '</h3>');
                print('<h3>Total Price: ' . $sub_price + $_SESSION['shipping'] . '</h3>'); 
                $_SESSION['totalPrice'] = $sub_price + $_SESSION['shipping'];
                print('<button type="submit" class="add_btn" form="update_form">Update Cart</button>');
                print('<button type="submit" class="add_btn" form="clear_form">Clear Cart</button>');
                print('<button type="submit" class="add_btn" form="submit_form">Submit Order</button>');

            }
            else {

                //if the cart is empty, say so
                print("<h2>No Items in Cart</h2>");
            }
        ?>
    </form>
</body>
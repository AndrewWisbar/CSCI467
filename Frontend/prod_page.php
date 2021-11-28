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
                include "../Backend/PHP/connect.php";
                include "funcs.php";

                $leg_conn = legacy_connect();

                $query = "SELECT * FROM parts \nWHERE number = " . $_GET['item'] . "\nLIMIT 1";

                $result = $leg_conn->query($query);

                if($result) {
                    $row = $result->fetch_assoc();
                }
                print('<img src="' . $row['pictureURL'] . '" alt="product picture" class="main-img">');
                print('<div class="prod-info">');
                print('<h2>' .$row['description']. '</h2>');
                print('<p class="prod-price">$' . $row['price'] . '</p>');
                print('<div class="flex-container">');
                print('<input type="number" id="qty" name="qty" value="1" min="0" max="99">');
                print('<button type="submit" name="add_to_cart" value="' . $row['number'] . '" class="add-btn">Add to Cart</button>');
                print('</div>');
            ?>
        </div></div>
    </form>
</body>
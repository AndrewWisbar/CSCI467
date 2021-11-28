<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"></link>
    <title>Auto Store</title>
</head>
<body>
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
        <button class='nav-btn'>Account</button> 
    </div>
        <table class="cart_table">
            <tr><th>Image</th><th>Name</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>
            <?php
                session_start();
                include '../Backend/PHP/connect.php';
                $leg_conn = legacy_connect();
                while($entry = current($_SESSION['shopping_cart'])) {
                    

                    $query = "SELECT * FROM parts \nWHERE number = " . key($_SESSION['shopping_cart']) . "\nLIMIT 1";

                    $result = $leg_conn->query($query);

                    if($result) {
                        $row = $result->fetch_assoc();
                    }

                    print('<tr><td><img src="' . $row['pictureURL'] . '" alt=""></td><td>' . $row['description'] . '</td><td>' . $row['price'] . '</td><td>' . $entry . '</td><td>' . $entry * $row['price'] . '</td></tr>');
                    next($_SESSION['shopping_cart']);
                }
            ?>
        </table>
</body>
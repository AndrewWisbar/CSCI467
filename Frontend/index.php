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
        <a href="index.php" class='invis-link'>
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
    
    <div id="main-content">
        <h3>Our Store</h3>
        <p>We are a local store specialized in the sale of auto parts.</p>
        <p>We are proud of our fast shipping, and dedication, and we stand behind the quality of our products</p>
    </div>
    <h3>Suggested Products</h3>
    <div class="grid-container">
        <?php
            session_start();
            if(!isset($_SESSION['shopping_cart'])) {
                $_SESSION['shopping_cart'] = array();
            }
            include "../Backend/PHP/connect.php";
            include "funcs.php";

            $leg_conn = legacy_connect();

            $query = "SELECT * FROM parts \nORDER BY RAND() \nLIMIT 5";

            $result = $leg_conn->query($query);

            if($result) {
                while($row = $result->fetch_assoc()) {
                    create_card($row);
                }
            }
        ?>
    </div>
</body>
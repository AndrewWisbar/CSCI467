<html>
    <head>
        <title>Confirmation Page</title>
    <meta charset="UTF-8"/>
    </head>
    <body>

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

<?php

echo "Order Processed!";

$output = "Your Order: $transactionID has been proccessed, $name. A confirmation email has been sent to $email."

echo $output;

session_destroy();

?>
</body>
</html>
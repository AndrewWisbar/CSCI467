<?php

    /*
    clear_cart.php

    this script is called when the user wants to clear the cart
    */

    session_start();

    //set the cart to an empty array
    $_SESSION['shopping_cart'] = array();
    header("Location: cart.php");
?>
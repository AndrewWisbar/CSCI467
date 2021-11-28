<?php
    session_start();
    $_SESSION['shopping_cart'] = array();
    while($item = current($_POST)) {
        $_SESSION['shopping_cart'][key($_POST)] = $item;
        next($_POST);
    }

    header("Location: cart.php");
?>
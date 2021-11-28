<?php
    session_start();
    $_SESSION['shopping_cart'] = array();
    header("Location: cart.php");
?>
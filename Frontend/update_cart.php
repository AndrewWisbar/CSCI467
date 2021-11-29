<?php
    session_start();
    if(isset($_POST['remove'])) {
        unset($_SESSION['shopping_cart'][$_POST['remove']]);
    }
    else {
        $_SESSION['shopping_cart'] = array();
        while($item = current($_POST)) {
            $_SESSION['shopping_cart'][key($_POST)] = $item;
            next($_POST);
        }
    }
    
    header("Location: cart.php");
?>
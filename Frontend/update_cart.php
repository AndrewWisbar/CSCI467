<?php
    session_start();

    //if a remove button was pressed, remove that item
    if(isset($_POST['remove'])) {
        unset($_SESSION['shopping_cart'][$_POST['remove']]);
    }
    else {

        //otherwise, update each item to the new quantity supplied
        $_SESSION['shopping_cart'] = array();
        while($item = current($_POST)) {
            $_SESSION['shopping_cart'][key($_POST)] = $item;
            next($_POST);
        }
    }
    
    //redirect user
    header("Location: cart.php");
?>
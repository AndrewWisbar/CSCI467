<?php
/*
add_cart.php

this script is used to add an item to the cart
*/
    session_start();

    //input protection
    if(isset($_POST['add_to_cart'])) {

        // get the id of the item to add
        $item_id = $_POST['add_to_cart'];

        //if we did not recieve a quantity, set it to 1
        if(!isset($_POST['qty'])) {
            $_POST['qty'] = 1;
        }

        //if the item alreadty exists in the cart, add it to the quantity
        if(isset($_SESSION['shopping_cart'][$item_id])) {
            $_SESSION['shopping_cart'][$item_id] += $_POST['qty'];
        }
        else {
            //otherwise add the item to the cart
            $_SESSION['shopping_cart'][$item_id] = $_POST['qty'];
        }
    }

    header("Location: cart.php");
?>
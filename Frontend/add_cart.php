<?php

        session_start();
        print_r($_POST);
        if(isset($_POST['add_to_cart'])) {
            $item_id = $_POST['add_to_cart'];
            if(!isset($_POST['qty'])) {
                $_POST['qty'] = 1;
            }

            if(isset($_SESSION['shopping_cart'][$item_id])) {
                $_SESSION['shopping_cart'][$item_id] += $_POST['qty'];
            }
            else {
                $_SESSION['shopping_cart'][$item_id] = $_POST['qty'];
            }
        }

        header("Location: cart.php");
    ?>
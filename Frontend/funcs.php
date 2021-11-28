
<?php

function create_card($info) {
                $name = $info['description'];
                $price = $info['price'];
                $pic_src = $info['pictureURL'];
                print('<form action="./add_cart.php" method="post" id="add_form">');
                print('<div class="grid-item"><a href="prod_page.php?item=' . $info['number'] . '">');
                print('<img class="prod-img" src="' . $pic_src . '" alt="' . $name . '">');
                print('<h3 class="prod-name">' . $name . '</h3>');
                print('</a><div class="flex-container">');
                print('<p class="prod-price">$' . $price . '</p>');
                print('<button type="submit" name="add_to_cart" value="' . $info['number'] . '" class="add-btn">Add to Cart</button>');
                print('</div></div></form>');

}


?>
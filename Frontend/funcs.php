
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

function draw_table($rows) {
    if(empty($rows)) {
        echo "<p>No results found.</p>";
    }
    else {
        echo "<table border=1 cellspacing=1>";
        echo "<tr>";
        foreach($rows[0] as $key => $item) {
            echo "<th>$key</th>";
        }
        echo "</tr>";
        foreach($rows as $row) {
            echo "<tr>";
            foreach($row as $key => $item) {
                echo "<td>$item</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
  }

?>
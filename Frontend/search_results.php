<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"></link>
    <title>Auto Store</title>
</head>
<body>
    <form action="cart.php" method="post" id="cart_form"></form>
    <div id="header">
        <img src="wrench.png" alt="" id='logo'>
        <a href="index.php" class="invis-link">
            <h1 id="page-title">Auto Parts Store</h1>
        </a>
        <div id="search-div">
            <form action="" method="post" id="search-form">
                <input type="text" value="Search For Products" name="srch-field" id="srch-field">
                <input type="submit" name="submit-srch" id="submit-srch" form="search-form">
                <button type="submit" name="view-all" value=1 form="search-form">View All</button>
            </form>
        </div>
        <button type='submit' class='nav-btn' form='cart_form'>Cart</button>
    </div>
    
        <?php
        /*
        search_results.php
        
        This page is displayed as the result of a user searching for parts,
        or clicking the view all button
        */
            include "../Backend/PHP/connect.php";
            include "funcs.php";

            $leg_conn = legacy_connect();

            //if the view all was pressed, the search field should be empty
            if(isset($_POST['view-all'])) {
                $_POST['srch-field'] = "";
            }


            //get all parts matching the search field
            $query = "SELECT * FROM parts \nWHERE description LIKE '%" . $_POST['srch-field'] . "%'";
            $result = $leg_conn->query($query);
            if($result->num_rows) {

                //if there are parts that match, generate a grid of results
                print('<div class="grid-container">');
                while($row = $result->fetch_assoc()) {

                    // for each part, create a row
                    create_card($row);
                }
                print("</div>");
            }
            else {

                // if no results could be found, tell the user
                print('<h1>No Results for search term: "' . $_POST['srch-field'] . '"</h1>');
            }
        ?>
</body>
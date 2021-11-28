<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"></link>
    <title>Auto Store</title>
</head>
<body>
    <div id="header">
        <img src="wrench.png" alt="" id='logo'>
        <a href="index.php" class="invis-link">
            <h1 id="page-title">Auto Parts Store</h1>
        </a>
        <div id="search-div">
            <form action="" method="post" id="search-form">
                <input type="text" value="Search For Products" name="srch-field" id="srch-field">
                <input type="submit" form="search-form">
            </form>
        </div>
        <button class='nav-btn'>Account</button>
        <button class='nav-btn'>Cart</button>
    </div>
    
        <?php
            include "../Backend/PHP/connect.php";
            include "funcs.php";

            $leg_conn = legacy_connect();

            $query = "SELECT * FROM parts \nWHERE description LIKE '%" . $_POST['srch-field'] . "%'";

            $result = $leg_conn->query($query);

            if($result->num_rows) {
                print('<div class="grid-container">');
                while($row = $result->fetch_assoc()) {
                    create_card($row);
                }
                print("</div>");
            }
            else {
                print('<h1>No Results for search term: "' . $_POST['srch-field'] . '"</h1>');
            }
        ?>
</body>
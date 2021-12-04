GROUP 4A 
Ethan Johnson   z1826490
William Nedrow  z1905075
Thomas Rowe     z1862731
Andrew Wisbar   z1888354


The project is divided into two sections, Frontend and Backend
The frontend folder contains all the files needed that can be viewed/used by a customer.
The backend contains all the interfaces that would be shown to employees at the warehouse.


in the backend folder is another folder which contains two sql scripts. 

    The first script, 'create_tables.sql' can be used to create a copy of the database needed for the website to function.

    The second script, 'data.sql' is for adding data to the inventory database. 
    For each item in the parts table, it adds a number to the database representing the number of that part that the warehouse currently holds.
    (these numbers we generated randomly) 
    This script, or some other method of adding data to the table should be executed before using the website.

Additionally, before the front end of the webstie can fully function, shipping brackets must be established in the database,
This could be done manually but can also be done using the admin interface found in backend/php.

    The brackets work as follows, 

    First a bound is supplied which is the lower bound on the weight of an order, 
    it is assumed that the next-highest bound in the table is the upper bound.
    Then it is given a rate, which is the shipping and handling charged to any order between those weights.

    EX.

    if the DB holds:

    bound        rate
    0            5
    50           10
    100          60

    then any order between 0 and 50 pounds, would be charged a shipping rate of 5 dollars, 
    any order between 50 and 100 pounds would be charge 10 dollars,
    and any order 100 pounds and up would be charged 60 dollars.
    
The website also uses an email service to send emails, as demonstrated to the TA, for our project we used xampp which includes the needed services.
But if the required services are not set up in advance, errors will be thrown when attempting to send the email

Orders are stored in the DB as follows;

    General order details, like total price and weight, and the shipping / email information are stored in the 'orderdetails' table,
    while the individual items and their quantity are stored in the 'orderquantity' table.
    This table uses the OrderID (foreign key from orderdetails) and the ItemID to retrieve the quantity ordered.

Happy Holidays from Group 4A
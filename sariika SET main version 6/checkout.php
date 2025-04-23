<?php include "template/header.php"?>

<link rel="stylesheet" href="css/checkout.css"> 

    <div class="checkout-container">
        <h2>Shipping Details</h2>

        <?php
        if (isset($_POST['submit'])) {
            try {
                require "config.php"; // Include the config file for DB connection
                
                // Database connection
                $connection = new PDO($dsn, $username, $password, $options);
                
                // Collecting the form data
                $new_user = array(
                    "firstname" => $_POST['firstname'],
                    "lastname" => $_POST['lastname'],
                    "email" => $_POST['email'],
                    "phoneno" => $_POST['phoneno'], 
                    "address" => $_POST['location'] 
                );
                
                // Preparing the SQL query to insert the data
                $sql = sprintf("INSERT INTO %s (%s) values (%s)", "customers",
                               implode(", ", array_keys($new_user)),
                               ":" . implode(", :", array_keys($new_user)));
                        
                // Preparing the statement and executing it
                $statement = $connection->prepare($sql);
                $statement->execute($new_user);
                
                echo "Record successfully added!";
                
            } catch (PDOException $error) {
                echo "<p><strong>Error:</strong> " . $error->getMessage() . "</p>";
            }

        }
        ?>

        <form method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" required>
            
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" required>
            
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>
            
            <label for="phoneno">Phone Number</label>
            <input type="text" name="phoneno" id="phoneno">
            
            <label for="location">Address</label>
            <input type="text" name="location" id="location">
            
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
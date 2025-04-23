<?php include "template/header.php" ;?>  
<?php



if (isset($_POST["submit"])) { //if theres a post request
    require "../userdb_config.php";
 header("home.php");

    try {
        $connection = new PDO($dsn, $username, $password, $options); 
        
        $new_account = array( //creating an array where in which the variables are equal to the items in the forum below
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
           
        );

        $sql = sprintf("INSERT INTO %s (%s) values (%s)", "site_users", //no idea what this all does
        implode(", ", array_keys($new_account)),
        ":" . implode(", :", array_keys($new_account)));
        $statement = $connection->prepare($sql);
        $statement->execute($new_account);

        
    } 
        catch(PDOException $error) { //error handler
        echo $sql . "<br>" . $error->getMessage();
        }
        header('Location:home.php');
        die;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>


<div class="topnav">
   <h1>LOGIN</h1>
</div>


 
<form method="post">
    <label for="username">Username </label>
    <input type ="text" name="username" id="username" required maxlength="20">
<br>
    <label for="email">email </label>
    <input type="email" name="email" id="email" required>
<br>
    <label for="password">password </label>
    <input type="password" name="password" id="password" required>
<br>   
    <input type="submit" name="submit" value="submit">
    
      </form>  


<?php include "template/footer.php" ;?>   
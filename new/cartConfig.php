<?php
/**
* Configuration for database connection
*
*/
//127.0.0.1 port 3306 user root no password 
$host = "localhost";
$username = "root";
$password = "";
$dbname = "checkout"; // will use later
$dsn = "mysql:host=$host;dbname=$dbname"; // will use later
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>

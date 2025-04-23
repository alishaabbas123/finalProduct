<?php
/**
* Configuration for database connection
*
*/
//127.0.0.1 port 3307 user root no password
$host = "localhost";
$username = "root";
$password = "";
$dbname = "user_accounts"; // will use later
$dsn = "mysql:host=$host;dbname=$dbname"; // will use later
$options = array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
?>
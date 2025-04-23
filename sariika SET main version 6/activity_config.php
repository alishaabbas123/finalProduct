<?php
/**
* Configuration for database connection
*
*/
//127.0.0.1 port 3307 user root no password
$host = "localhost";
$username = "root";
$password = "";
$dbname = "timetable"; // will use later
$dsn = "mysql:host=$host;dbname=$dbname"; // will use later
$options= [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];
try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
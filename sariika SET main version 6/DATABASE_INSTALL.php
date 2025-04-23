<?php
//127.0.0.1 port 3306 user root no password
require "pruserdb_config.php";
try {
    $connection = new PDO("mysql:host=$host", $username, $password,
    $options);
    $sql = file_get_contents("data/checkout.sql");
    $connection->exec($sql);
    echo "DATABASE HAS BEEN MADE. ";
    } catch(PDOException $error) {
    echo  "<br>" . $error->getMessage();
    }

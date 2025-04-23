<?php require "activity_config.php";

try {
    // Connect without specifying a database first
    $connection = new PDO("mysql:host=$host", $username, $password, $options);

    // Check if the database exists
    $dbExists = $connection->query("SHOW DATABASES LIKE 'timetable'")->rowCount() > 0;

    if (!$dbExists) {
        $connection->exec("CREATE DATABASE timetable");
        echo "Database 'timetable' created successfully.";
    } else {
        echo "Database 'timetable' already exists.";
    }

    // Use the database
    $connection->exec("USE timetable");

    // Load and execute SQL file to set up tables
    $sql = file_get_contents("data/timetable.sql");
    $connection->exec($sql);

} catch (PDOException $error) {
    echo "<br>" . $error->getMessage();
}

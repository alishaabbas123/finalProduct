<?php 

if (isset($_POST['save'])) {
    require "activity_config.php"; 

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->exec("USE timetable");  // Ensure correct database

        if (!isset($_POST['days'], $_POST['activity'], $_POST['description'], $_POST['time'], $_POST['date'])) {
            die("Error: Missing form fields.");
        }
        // Convert 'time' to full DATETIME format
        $formattedDateTime = $_POST['date'] . ' ' . $_POST['time'] . ':00'; 

        $new_user = [
            "actDay" => $_POST['days'],
            "actName" => $_POST['activity'],
            "actDesc" => $_POST['description'],
            "actTime" => $formattedDateTime,
            "date" => $_POST['date']
        ];

        $sql = "INSERT INTO activity (days, activity, description, time, date) 
                VALUES (:actDay, :actName, :actDesc, :actTime, :date)";

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        echo "New record created successfully!";
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
require "timetable.php";
if (isset($_POST['submit']) && $statement){
echo  ' successfully added';
}
?>

<?php include "template/header.php"?>
<link rel="stylesheet" href="timetable.css">

<?php
/**
* Delete a user
*/
require "template/common.php";
if (isset($_GET["id"])) {
    try {
        require_once 'timetable_database.php';
        $id = $_GET["id"];
        $sql = "DELETE FROM activity WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "User ". $id. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
try {
    require_once 'timetable_database.php';
    $sql = "SELECT * FROM activity";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<h2>Delete users</h2>
<?php if (isset($success)) echo $success; ?>
<table >
<thead>
<tr>
    <th>#</th>
    <th>Days</th>
    <th>Activity</th>
    <th>Description</th>
    <th>DateTime</th>
    
    <th>Delete</th>
</tr>
</thead>
<tbody>
<?php foreach ($result as $row) : ?>
<tr>
    <td><?php echo escape($row["id"]); ?></td>
    <td><?php echo escape($row["days"]); ?></td>
    <td><?php echo escape($row["activity"]); ?></td>
    <td><?php echo escape($row["description"]); ?></td>

    <td><?php echo escape($row["date"]); ?></td>
    <td><a href="deleteTimetable.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button><a href="timetable.php" class="update" >Go Back to timetable page </a></button>

<?php include "template/footer.php"?>

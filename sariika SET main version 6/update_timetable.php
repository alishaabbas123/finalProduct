<?php include "template/header.php"?>
<link rel="stylesheet" href="timetable.css">

<?php
/**
* List all users with a link to edit
*/
try {
require "template/common.php";
require_once 'timetable_database.php';
$sql = "SELECT * FROM activity";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->fetchAll();
} catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();
}
?>
<h2>Update users</h2>
<table>
<thead>
<tr>
<th>Tasks</th>
<th>Days</th>
<th>Activity</th>
<th>Description</th>
<th>DateTime</th>
<th>Action</th>
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
<td><a href="edit.php?id=<?php echo escape($row["id"]);
?>">Edit</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<button><a href="timetable.php">Back to timetable</a></button>
<?php include "template/footer.php"?>
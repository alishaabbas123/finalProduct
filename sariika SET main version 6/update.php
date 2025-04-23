<?php
/**
* List all users with a link to edit
*/
try {
require "template/common.php";
require_once 'DBconnect.php';
$sql = "SELECT * FROM users";
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
<th>#</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email Address</th>
<th>PhoneNo</th>
<th>Location</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php foreach ($result as $row) : ?>
<tr>
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["firstname"]); ?></td>
<td><?php echo escape($row["lastname"]); ?></td>
<td><?php echo escape($row["email"]); ?></td>
<td><?php echo escape($row["phoneno"]); ?></td>
<td><?php echo escape($row["address"]); ?></td>
<td><a href="update-single.php?id=<?php echo escape($row["id"]);
?>">Edit</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<a href="product2.php">Back to home</a>
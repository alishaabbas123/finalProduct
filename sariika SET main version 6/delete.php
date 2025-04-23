<?php
/**
* Delete a user
*/
require "template/common.php";
if (isset($_GET["id"])) {
    try {
        require_once 'DBconnect.php';
        $id = $_GET["id"];
        $sql = "DELETE FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $success = "User ". $id. " successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
try {
    require_once 'DBconnect.php';
    $sql = "SELECT * FROM users";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<h2>Delete users</h2>
<?php if (isset($success)) echo $success; ?>
<table>
<thead>
<tr>
    <th>#</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email Address</th>
    <th>Location</th>
    <th>Delete</th>
</tr>
</thead>
<tbody>
<?php foreach ($result as $row) : ?>
<tr>
    <td><?php echo escape($row["id"]); ?></td>
    <td><?php echo escape($row["firstname"]); ?></td>
    <td><?php echo escape($row["lastname"]); ?></td>
    <td><?php echo escape($row["email"]); ?></td>
    <td><?php echo escape($row["address"]); ?></td>
    <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<a href="product2.php">Back to home</a>

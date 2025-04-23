<?php
/**
* Use an HTML form to edit an entry in the
* users table.
*
*/
require "template/common.php";
if (isset($_POST['submit'])) {
try {
require_once 'DBconnect.php';
$user =[
"id" => escape($_POST['id']),
"firstname" => escape($_POST['firstname']),
"lastname" => escape($_POST['lastname']),
"email" => escape($_POST['email']),
"phoneno" => escape($_POST['phoneno']),
"location" => escape($_POST['location'])
];
$sql = "UPDATE users
        SET firstname = :firstname,
            lastname = :lastname,
            email = :email,
            phoneno = :phoneno,
            location = :location
        WHERE id = :id";


$statement = $connection->prepare($sql);
$statement->execute($user);
} catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();
}
}
if (isset($_GET['id'])) {
try {
require_once 'DBconnect.php';
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = :id";
$statement = $connection->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();
}
} else {
echo "Something went wrong!";
exit;
}
?>

<?php if (isset($_POST['submit']) && $statement) : ?>
<?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>
<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($user as $key => $value) : ?>
        <?php if ($key !== 'date' && $key !== 'age') : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php endif; ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>


<a href="product2.php">Back to home</a>
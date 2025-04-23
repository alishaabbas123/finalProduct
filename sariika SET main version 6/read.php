<?php
try {
    require "config.php"; // Include the config file for DB connection
    
    // Database connection
    $connection = new PDO($dsn, $username, $password, $options);
    
    // SQL to fetch all users
    $sql = "SELECT * FROM users";
    
    // Prepare and execute the statement
    $statement = $connection->prepare($sql);
    $statement->execute();
    
    // Fetch all the results
    $users = $statement->fetchAll();
} catch(PDOException $error) {
    echo "Error: " . $error->getMessage();
}
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['id']); ?></td>
            <td><?php echo htmlspecialchars($user['firstname']); ?></td>
            <td><?php echo htmlspecialchars($user['lastname']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo htmlspecialchars($user['phoneno']); ?></td>
            <td><?php echo htmlspecialchars($user['address']); ?></td>
            <td>
                <a href="update.php?id=<?php echo $user['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $user['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
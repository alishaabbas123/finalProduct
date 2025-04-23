<?php
session_start();
require_once 'DBconnect.php';

// Check if cart exists and has products
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Get all product ids from the cart session
    $product_ids = array_keys($_SESSION['cart']);  // Extract the product IDs from the cart

    // Convert the array of product IDs into a string for use in the SQL query
    $placeholders = implode(",", array_fill(0, count($product_ids), "?"));

    try {
        // Fetch only the products that are in the cart
        $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
        $statement = $connection->prepare($sql);
        $statement->execute($product_ids);  // Bind the product IDs to the placeholders
        $products = $statement->fetchAll();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "Your cart is empty.";
    exit;
}

// Handle product removal from the cart if the 'id' is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Remove the product from the session
    unset($_SESSION['cart'][$product_id]);

    // After removal, redirect to the same page to refresh the cart
    header("Location: deleteCart.php");
    exit;
}
?>
<h2>Your Cart - Remove Items</h2>

<?php if (!empty($products)) : ?>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['title']) ?></td>
                    <td>€<?= number_format($product['price'], 2) ?></td>
                    <td><?= $_SESSION['cart'][$product['id']]['quantity'] ?></td>
                    <td>€<?= number_format($product['price'] * $_SESSION['cart'][$product['id']]['quantity'], 2) ?></td>
                    <td><a href="deleteCart.php".php?id=<?= $product['id'] ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

<a href="cartt.php">Back to Cart</a>




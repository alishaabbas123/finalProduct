<?php
    session_start();
    require_once "DBconnect.php";
    require "template/header.php";

    if (empty($_SESSION['cart'])) {
        echo "Your cart is empty.";
        exit;
    }

    if (isset($_POST['continue_to_cart'])) {
        try {
        // Create empty order
            $sql = "INSERT INTO orders () VALUES ()";
            $statement = $connection->prepare($sql);
            $statement->execute();
            $order_id = $connection->lastInsertId();

        // Insert each item
            foreach ($_SESSION['cart'] as $product_id => $product) {
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                        VALUES (:order_id, :product_id, :quantity, :price)";
                $statement = $connection->prepare($sql);
                $statement->bindValue(':order_id', $order_id);
                $statement->bindValue(':product_id', $product_id);
                $statement->bindValue(':quantity', $product['quantity']);
                $statement->bindValue(':price', $product['price']);
                $statement->execute();
            }

            unset($_SESSION['cart']); // Clear the cart
            header("Location: checkout.php");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    // Fetch product details to display (for title)
    $product_ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
    $statement = $connection->prepare($sql);
    $statement->execute($product_ids);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);


    $subtotal = 0;
    foreach ($products as $product) {
        $product_id = $product['id'];
        $quantity = $_SESSION['cart'][$product_id]['quantity'];
        $subtotal += $product['price'] * $quantity;
    }

$shippingCost = 5;

$total = $subtotal + $shippingCost;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Your Cart</title>
        <link rel="stylesheet" href="css/cart.css?v=2">
    </head>
    <body>

        <h2>Your Cart</h2>

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
            <?php foreach ($products as $product): 
                $product_id = $product['id'];
                $quantity = $_SESSION['cart'][$product_id]['quantity'];
            ?>
            <tr>
                <td><?= htmlspecialchars($product['title']) ?></td>
                <td>€<?= number_format($product['price'], 2) ?></td>
                <td><?= $quantity ?></td>
                <td>€<?= number_format($product['price'] * $quantity, 2) ?></td>
                <td><a href="deleteCart.php?id=<?= $product_id ?>">Remove</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
        <p><strong>Subtotal:</strong> €<?= number_format($subtotal, 2) ?></p>
        <p><strong>Shipping:</strong> €<?= number_format($shippingCost, 2) ?></p>
        <p><strong>Total:</strong> €<?= number_format($total, 2) ?></p>

        
        <form method="POST" action="checkout.php">
            <button type="submit" name="continue_to_checkout">Continue to Checkout</button>
        </form>

    </body>
</html>

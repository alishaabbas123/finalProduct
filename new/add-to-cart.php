<?php
session_start();

// Check if the form was submitted
if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Update quantity if the product is already in the cart
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Add new product to the cart
        $_SESSION['cart'][$product_id] = [
            'quantity' => $quantity,
            'price' => $price,
            'name' => $product_name
        ];
    }

    // Redirect back to the product page or cart
    header('Location: producttt.php'); // 
    exit;
}

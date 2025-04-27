<?php

session_start();

// Setup: pretend a product is being added
$product_quantity = 2; // Change this to 0 or -1 to test failure

// Test
if ($product_quantity > 0) {
    echo "Test Valid Quantity: ✅ Quantity is valid ($product_quantity).<br>";
} else {
    echo "Test Valid Quantity: ❌ Quantity is invalid ($product_quantity).<br>";
}
?>

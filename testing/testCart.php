<?php
// Unit Test for Cart Total Calculation

session_start();
$_SESSION['cart'] = [
    ['title' => 'Product A', 'price' => 15, 'quantity' => 1],
    ['title' => 'Product B', 'price' => 10, 'quantity' => 2]
];

function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Run the test
$expected = 45;
$actual = calculateTotal($_SESSION['cart']);

echo "<h3>Cart Total Unit Test</h3>";
echo "Expected: €$expected<br>";
echo "Actual: €$actual<br>";

if ($actual === $expected) {
    echo "Test Passed";
} else {
    echo "Test Failed";
}
?>

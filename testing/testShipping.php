<?php

// Simulate selection
$shipping_option = 'next_day'; // Could be 'standard' or 'next_day'

// Decide shipping cost
$shipping_cost = 0;
if ($shipping_option == 'standard') {
    $shipping_cost = 5;
} elseif ($shipping_option == 'next_day') {
    $shipping_cost = 10;
}

// Test
if ($shipping_cost == 10) {
    echo "Test Shipping Cost:  Next-Day Shipping (€10) applied correctly.<br>";
} else {
    echo "Test Shipping Cost:  Shipping cost incorrect.<br>";
}
?>

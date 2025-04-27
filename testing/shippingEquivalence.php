<?php
// Simulate different shipping choices

function calculateShippingCost($shipping_option) {
    if ($shipping_option == 'standard') {
        return 5;
    } elseif ($shipping_option == 'next_day') {
        return 10;
    } else {
        return 0; // Invalid input
    }
}

// Test Cases (Partitions)
$test_cases = [
    'standard' => 5,   // Valid input
    'next_day' =>10,  // Valid input
    'express' => 0,    // Invalid input
    '' => 0,           // Empty input
    null => 0          // Null input
];

// Run tests
foreach ($test_cases as $input => $expected) {
    $result = calculateShippingCost($input);
    if ($result == $expected) {
        echo "Test Passed for input '$input': Shipping cost €$result.<br>";
    } else {
        echo "Test Failed for input '$input': Expected €$expected, Got €$result.<br>";
    }
}
?>

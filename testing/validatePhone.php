<?php
$phone = "0851234567";
$onlyDigits = true;
$i = 0;

while (isset($phone[$i])) {
    if ($phone[$i] != "0" && $phone[$i] != "1" && $phone[$i] != "2" &&
        $phone[$i] != "3" && $phone[$i] != "4" && $phone[$i] != "5" &&
        $phone[$i] != "6" && $phone[$i] != "7" && $phone[$i] != "8" &&
        $phone[$i] != "9") {
        $onlyDigits = false;
        break;
    }
    $i++;
}

if ($onlyDigits) {
    echo "Test passed: Phone number is valid.";
} else {
    echo "Test failed: Phone number contains invalid characters.";
}
?>

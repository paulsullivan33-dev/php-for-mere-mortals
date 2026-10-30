<?php
// types.php — PHP's types, shown not told.
declare(strict_types=1);

$whole = 42;              // int
$price = 3.75;            // float
$hall  = "Maple Street Hall"; // string
$open  = true;            // bool
$nothing = null;          // null

foreach ([$whole, $price, $hall, $open, $nothing] as $value) {
    printf("%-18s %s\n", var_export($value, true), gettype($value));
}

// Type juggling: a numeric string joins in arithmetic.
var_dump("5" + 3);        // int(8) — the string is converted
var_dump("5" == 5);       // true  — loose comparison converts
var_dump("5" === 5);      // false — strict comparison checks type too
var_dump(0 == "notice");  // false since PHP 8 (it was true in PHP 7)

// Strict types: this file declared strict_types=1,
// so passing a float where an int is promised is an error.
function chairs(int $rows): int
{
    return $rows * 6;
}
echo chairs(4), " chairs in 4 rows\n";
try {
    echo chairs(2.5), "\n";
} catch (TypeError $e) {
    echo "TypeError caught: ", $e->getMessage(), "\n";
}

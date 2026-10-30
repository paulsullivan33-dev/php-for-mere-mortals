<?php
// arrays.php — PHP's one collection type does lists and maps.
declare(strict_types=1);

// A list: integer keys, added one by one.
$notices = [];
$notices[] = "Lost glove, left on the piano";
$notices[] = "Hall closed early on Friday";
$notices[] = "Jumble sale — helpers needed";
echo count($notices), " notices\n";
foreach ($notices as $i => $text) {
    printf("  [%d] %s\n", $i, $text);
}

// A map: string keys. One array type, both jobs.
$hall = [
    "name"     => "Maple Street Hall",
    "seats"    => 120,
    "bookable" => true,
];
echo $hall["name"], " seats ", $hall["seats"], "\n";

// Nested: a list of maps, the shape database rows arrive in.
$rows = [
    ["name" => "Priya", "notice" => "Yoga moves to Thursdays"],
    ["name" => "Tom",   "notice" => "Spare ladder in the store room"],
];
foreach ($rows as $row) {
    printf("%s: %s\n", $row["name"], $row["notice"]);
}

// Sorting and filtering are ordinary function calls.
$sorted = $notices;
sort($sorted);
echo "Alphabetical first: ", $sorted[0], "\n";
$long = array_filter($notices, fn (string $n): bool => strlen($n) > 27);
echo count($long), " notices longer than 27 characters\n";

// A missing key is a warning, not a guess — shown live in chapter 12,
// here it is caught by asking first with ?? (null coalescing).
echo "Kitchen key: ", $hall["kitchen"] ?? "not listed", "\n";

<?php
// strings.php — text work: interpolation, mbstring, and regex.
declare(strict_types=1);

$name = "Priya";
$seats = 120;
echo "Hello $name, the hall seats {$seats}.\n";        // interpolation
echo 'Hello $name — single quotes do not interpolate.', "\n";

// Bytes are not characters. "Café" is 4 characters, 5 bytes in UTF-8.
$word = "Café";
printf("strlen: %d bytes; mb_strlen: %d characters\n", strlen($word), mb_strlen($word));
printf("mb_substr Café -> %s\n", mb_substr($word, 0, 3));

// Everyday string surgery.
$messy = "  Jumble SALE on Saturday  ";
echo trim($messy), "\n";
echo strtoupper("quiet please"), " / ", strtolower("LOUD"), "\n";
echo str_replace("Saturday", "Sunday", trim($messy)), "\n";
$parts = explode(", ", "tea, coffee, biscuits");
echo implode(" + ", $parts), "\n";
printf("Notice %03d of %d\n", 7, 42);

// Regular expressions: the same PCRE family as everywhere else.
$line = "Hall hire: 25 pounds per hour, Fridays only";
if (preg_match('/(\d+) pounds per hour/', $line, $m)) {
    echo "Price found: £", $m[1], " per hour\n";
}
$phone = "Call 01632 960 555 to book";
echo preg_replace('/\d{5} \d{3} \d{3}/', '[phone number]', $phone), "\n";

// Splitting on a pattern rather than a fixed string.
$tags = preg_split('/\s*;\s*/', "indoor; all ages ;free");
print_r($tags);

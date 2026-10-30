<?php
// broken.php — deliberate failures, for the errors chapter.
// Nothing here is an accident: a warning that lets the script
// continue, then a fatal error that stops it dead.
declare(strict_types=1);

header('Content-Type: text/plain');
echo "Starting up.\n";

$notices = ["one", "two"];
echo $notices[5];            // Warning: undefined array key; runs on
echo "Still running after the warning.\n";

this_function_does_not_exist();   // Fatal: the script stops here
echo "Never reached.\n";

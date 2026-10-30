<?php
// database.php — PDO from the command line: the same code the
// web app uses, with no web server in the way.
declare(strict_types=1);

$file = __DIR__ . '/hall.sqlite';
@unlink($file);   // start empty, so the run is repeatable

$db = new PDO('sqlite:' . $file);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec(
    'CREATE TABLE bookings (
        id    INTEGER PRIMARY KEY AUTOINCREMENT,
        name  TEXT NOT NULL,
        room  TEXT NOT NULL,
        seats INTEGER NOT NULL
    )'
);

// Values go in as parameters — never glued into the SQL text.
$add = $db->prepare(
    'INSERT INTO bookings (name, room, seats) VALUES (?, ?, ?)'
);
$add->execute(['Choir practice', 'Main hall', 30]);
$add->execute(['Chess club', 'Back room', 12]);
$add->execute(["O'Brien's quiz night", 'Main hall', 48]); // apostrophe and all

// Ask a question with a parameter, get rows back as maps.
$ask = $db->prepare('SELECT name, seats FROM bookings WHERE room = ? ORDER BY seats');
$ask->execute(['Main hall']);
foreach ($ask->fetchAll(PDO::FETCH_ASSOC) as $row) {
    printf("%s — %d seats\n", $row['name'], $row['seats']);
}

$count = $db->query('SELECT COUNT(*) FROM bookings')->fetchColumn();
echo "Bookings stored: $count\n";
echo "The database is one file: ", $file, " (", filesize($file), " bytes)\n";

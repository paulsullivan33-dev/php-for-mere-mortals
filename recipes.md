# Recipes

**Outcome:** a shelf of small, complete
things PHP does well, each one built
from parts already proven in earlier
chapters.

**Check:** each recipe names the
chapter whose transcript proves its
mechanism, so nothing here asks to be
taken on faith.

## Read a CSV file into rows

Chapter 6's shape, from a file instead
of a database: `fgetcsv` hands you one
row at a time as a list.

```php
$fh = fopen('members.csv', 'r');
while (($row = fgetcsv($fh)) !== false) {
    printf("%s — %s\n", $row[0], $row[1]);
}
fclose($fh);
```

## Answer with JSON instead of HTML

An endpoint is a script that sets a
different content type and prints data
instead of a page. The noticeboard's
notices, as JSON:

```php
header('Content-Type: application/json');
echo json_encode($notices, JSON_PRETTY_PRINT);
```

The browser's JavaScript, or another
program entirely, does the presenting.
Same database code as chapter 9
underneath — the *response* is the only
thing that changed.

## Remember something between requests

Chapter 2's statelessness has one
built-in exception: **sessions**. Call
`session_start()` before any output,
and `$_SESSION` becomes a per-visitor
map that survives from page to page,
keyed by a cookie the browser carries:

```php
session_start();
$_SESSION['visits'] = ($_SESSION['visits'] ?? 0) + 1;
echo "Visit number ", $_SESSION['visits'];
```

Chapter 6's `??` does the first-visit
duty. What sessions are *for* is
identity — who is logged in — and that
is also where their care begins: a
session cookie is a bearer token, and
chapter 14's production notes are where
its handling belongs.

## Send the board by email

PHP's `mail()` hands a message to the
machine's mail system — on a server
with chapter 14's wiring, that is the
Postfix of the series' mail guide:

```php
mail('hall@example.org', 'Tonight at the hall',
     "Choir practice moves to the main hall.\n");
```

The honest caveat is deliverability,
not syntax: a home server's mail is
routinely filed as spam by the big
receivers, which is a reputation and
DNS problem (the mail guide's
documented-only territory), not a PHP
one.

## Run one of your pages from cron

Anything in this guide that runs with
`php script.php` can be the command in
a cron line from the series' cron
guide — a nightly script that opens the
database (chapter 8), counts tomorrow's
bookings, and mails the list (the
recipe above) is that pattern wearing a
clock. Background work is where CLI PHP
quietly earns its keep in real systems:
imports, reminders, cleanups, reports.

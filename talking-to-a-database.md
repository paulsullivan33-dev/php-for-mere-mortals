# Talking to a Database

**Outcome:** from the command line, with
no web server anywhere, you can create
a table, store rows with parameterised
inserts, and read them back with a
parameterised question — the whole
database conversation of a real
application, in one script.

**Check:** run `php database.php` from
the lab and match transcript t13: two
Main hall bookings in seat order, three
bookings counted, and the database
named as a single file of 12,288 bytes.

## PDO: one door, many engines

**PDO** (PHP Data Objects) is PHP's
standard database layer. You open a
connection by naming the engine and the
target in one string:

```php
$db = new PDO('sqlite:' . $file);
```

On a MySQL server the string would read
`mysql:host=...;dbname=...` and a
username and password would follow as
extra arguments — and *nothing else in
the script would change*. That is the
point of the layer, and why this guide
teaches it rather than any engine's
private functions: the habits transfer.

Two settings go on immediately:

```php
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

Without it, PDO's historical default is
to fail *quietly* — a broken query
returns `false` and the page sails on
with missing data. With it, database
trouble raises an exception: named,
dated, and impossible to sail past.
Chapter 12 is about errors generally;
this is the setting that makes database
errors join the honest kind.

## Storing: parameters, never glue

The script stores three bookings. One
of them is the whole lesson:

```php
$add = $db->prepare(
    'INSERT INTO bookings (name, room, seats) VALUES (?, ?, ?)'
);
$add->execute(['Choir practice', 'Main hall', 30]);
$add->execute(["O'Brien's quiz night", 'Main hall', 48]);
```

The query's shape — its `?` holes — is
sent to the database first; the values
travel separately, as *values*. Two
things follow. The practical one: an
apostrophe in *O'Brien's* is stored as
an apostrophe, not mistaken for the end
of a quoted string (the transcript
reads it back intact). The protective
one: no value, however hostile, can
change the query's shape — which is
what SQL injection *is*, and why
parameterised queries are this guide's
standing rule from chapter 1 onward.
Glueing values into SQL text with
string concatenation is the old habit;
you will meet it in old tutorials, and
you now know the better shape by sight.

## Asking: rows arrive as maps

```php
$ask = $db->prepare(
    'SELECT name, seats FROM bookings WHERE room = ? ORDER BY seats'
);
$ask->execute(['Main hall']);
foreach ($ask->fetchAll(PDO::FETCH_ASSOC) as $row) {
    printf("%s — %d seats\n", $row['name'], $row['seats']);
}
```

`FETCH_ASSOC` asks for each row as a
map keyed by column name — chapter 6's
shape, exactly. (The alternatives are
objects, or arrays keyed by number; the
map is the most readable.) For a single
number, `fetchColumn()` reads one value
directly: the transcript's count of
bookings stored.

## Why SQLite here

SQLite keeps the entire database in
**one file** — 12,288 bytes for this
lab's three bookings — with no server
process, no accounts, and nothing to
install beyond the driver. For one
machine and a modest number of writers
it is a complete, serious database, and
the SQL you write is the SQL of the
series' SQL guide. Its honest edges are
named in chapter 14: many simultaneous
writers and network access belong to
MySQL, MariaDB or PostgreSQL. The
noticeboard of the next chapter uses
the same engine, through the same code,
behind a web page.

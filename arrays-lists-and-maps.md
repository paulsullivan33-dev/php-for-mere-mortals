# Arrays — One Collection, Two Jobs

**Outcome:** you can build, read, sort
and filter PHP's one collection type —
the array — and recognise the shape
database results arrive in, because it
is the same shape.

**Check:** run `php arrays.php` from
the lab and match transcript t02: three
notices listed with their numbers, a
hall described from a map, and two
notices counted as longer than 27
characters.

## One type, two shapes

Most languages give you a *list* (items
in order, found by number) and a *map*
(items found by name) as different
things. PHP's array is both at once:
the keys are integers or strings, and
the array remembers the order things
were added.

A list grows by appending:

```php
$notices = [];
$notices[] = "Lost glove, left on the piano";
$notices[] = "Hall closed early on Friday";
```

and is read back with its numbers:

```php
foreach ($notices as $i => $text) {
    printf("  [%d] %s\n", $i, $text);
}
```

A map is the same syntax with names for
keys:

```php
$hall = [
    "name"     => "Maple Street Hall",
    "seats"    => 120,
    "bookable" => true,
];
echo $hall["name"], " seats ", $hall["seats"], "\n";
```

## The shape of everything later

Put the two shapes together — a list
*of maps* — and you have the shape this
guide keeps meeting:

```php
$rows = [
    ["name" => "Priya", "notice" => "Yoga moves to Thursdays"],
    ["name" => "Tom",   "notice" => "Spare ladder in the store room"],
];
```

That is precisely what a database query
returns in chapter 8 (`FETCH_ASSOC`),
and what a decoded JSON document
becomes. Learn to walk it — an outer
`foreach` over rows, keys inside for
fields — and half of practical PHP is
already familiar.

## Everyday operations

Sorting is a function call that works
in place (`sort($sorted)`); filtering
keeps the items a small test accepts:

```php
$long = array_filter(
    $notices,
    fn (string $n): bool => strlen($n) > 27
);
echo count($long), " notices longer than 27 characters\n";
```

(the `fn` form is an *arrow function* —
a one-line function written where it is
used). Counting is `count()`. Nothing
here needs importing; it is all the
language itself.

## Asking without falling

Reading a key that is not there is a
**warning** — chapter 12 shows one
landing — and execution continues with
`null`, which is how small absences
become wrong pages far from their
cause. The everyday defence is to ask
with the null-coalescing operator,
which supplies a fallback instead:

```php
echo "Kitchen key: ", $hall["kitchen"] ?? "not listed", "\n";
```

Use `??` whenever a key's presence is a
hope rather than a guarantee — above
all for the request arrays of chapter
9, where the keys come from strangers.

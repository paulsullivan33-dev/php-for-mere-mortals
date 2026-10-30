# Types and Variables

**Outcome:** you can read a PHP value
and say what type it is, predict when
PHP will quietly convert a value to
another type, and stop it doing so when
the conversion would hide a mistake.

**Check:** run `php types.php` from the
lab (`php-lab/cli/`) and match your
output line for line against transcript
t01.

## Variables and the basic types

A variable starts with `$` — always,
everywhere — and takes its type from
the value you give it:

```php
$whole   = 42;                 // int
$price   = 3.75;               // float
$hall    = "Maple Street Hall"; // string
$open    = true;               // bool
$nothing = null;               // null
```

`gettype()` will tell you a value's
type, and transcript t01 shows it naming
all five — including its one historical
quirk: a float reports itself as
"double", a fossil name from the C
language that means the same thing.
`var_dump()` is the other everyday
witness: it prints the value *and* its
type together, and this guide uses it
whenever "what did it actually do?" is
the question.

## Type juggling, shown honestly

PHP converts values when an operation
seems to ask for it. The lab's three
lines, with their verdicts:

```php
var_dump("5" + 3);      // int(8)    — the string joined in
var_dump("5" == 5);     // bool(true) — loose == converts
var_dump("5" === 5);    // bool(false) — strict === checks type
```

Neither behaviour is a bug; both are
tools with edges. Loose comparison is
convenient for values that arrive as
text — and on the web, *everything*
arrives as text. Strict comparison is
how you ask "same value, same type, no
favours." The fourth line of the
transcript is the famous old trap, now
disarmed: in PHP 7, `0 == "notice"` was
true (any non-numeric string counted as
zero); since PHP 8 it is false. Old
tutorials were written against the old
rule — one more reason this guide pins
itself to PHP 8.

## Asking for strictness

A file may open (after `<?php`) with:

```php
declare(strict_types=1);
```

after which function arguments are no
longer juggled: pass a float where an
`int` is promised and PHP raises a
`TypeError` instead of rounding your
mistake into a wrong answer. The lab
script ends by doing exactly that on
purpose — chairs promised whole rows,
offered two and a half — and catching
the error to print it:

```
TypeError caught: chairs(): Argument #1 ($rows) must be of
type int, float given
```

Every script in this guide declares
strict types. It costs one line, and it
moves a whole family of surprises from
"wrong answer, silently" to "named
error, immediately" — which, as chapter
12 shows, is where errors are cheapest.

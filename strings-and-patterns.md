# Strings and Patterns

**Outcome:** you can put values into
text cleanly, cut and join text, count
it correctly when it contains accented
characters or emoji, and search it with
a regular expression.

**Check:** run `php strings.php` from
the lab and match transcript t03 — in
particular `strlen: 5 bytes; mb_strlen:
4 characters` for the word *Café*, and
the phone number replaced by
`[phone number]`.

## Quotes are a promise

Double quotes **interpolate**: variables
inside them are replaced by their
values, with braces for clarity where a
name runs into following text:

```php
echo "Hello $name, the hall seats {$seats}.\n";
```

Single quotes promise nothing: `'Hello
$name'` prints the dollar and the name,
literally. Both behaviours are in the
transcript, side by side. The rule of
thumb: double quotes when you mean
interpolation, single when you mean
"exactly this" — and never either, in
any language, as a way of building SQL
(chapter 8 uses parameters instead).

## Bytes are not characters

A string in PHP is a row of **bytes**.
For plain English the difference never
shows; for *Café* it does: four
characters, five bytes, because the é
takes two bytes in UTF-8 (the encoding
the web settled on). The core functions
count and cut by bytes; the **mbstring**
extension's `mb_` twins count and cut
by characters:

```php
printf("strlen: %d bytes; mb_strlen: %d characters\n",
       strlen($word), mb_strlen($word));   // 5, then 4
echo mb_substr($word, 0, 3);               // "Caf", never a torn é
```

Cutting by bytes can slice a character
in half and produce invalid text — the
kind of bug that only ever fires on a
real user's name. Wherever text came
from a person, reach for the `mb_`
version.

## Everyday surgery

The transcript's middle stretch is the
toolkit in one pass: `trim()` to strip
surrounding whitespace, `strtoupper` /
`strtolower` for case, `str_replace` for
plain substitution, `explode` to split
a string into an array on a separator
and `implode` to join one back, and
`printf` with a format (`%03d` pads a
number to three digits — "Notice 007 of
42"). None of it is exotic; together it
is most of the text work a small
application ever does.

## Regular expressions

For patterns rather than fixed strings,
PHP speaks **PCRE** — the same regex
family as the series' Regular
Expressions guide teaches — through
three everyday verbs:

- `preg_match('/(\d+) pounds per hour/',
  $line, $m)` — asks *does it match, and
  what did the brackets catch?* The
  lab's line about hall hire yields the
  price, £25, in `$m[1]`.
- `preg_replace('/\d{5} \d{3} \d{3}/',
  '[phone number]', $phone)` — replaces
  every match: a phone number in a
  notice becomes a placeholder, which is
  the shape of redaction tools
  everywhere.
- `preg_split('/\s*;\s*/', $tags)` —
  splits on a pattern (here, semicolons
  with sloppy spacing) rather than one
  fixed character.

The pattern sits between slashes, and
the slashes are part of the syntax —
the single most common beginner error
is leaving them off and being told,
mysteriously, that no delimiter was
found. Chapter 15 collects it with the
other regulars.

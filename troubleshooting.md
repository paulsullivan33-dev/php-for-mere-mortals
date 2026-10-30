# Troubleshooting

**Outcome:** the common PHP failures,
in the order you will meet them, each
with the reading that solves it.

**Check:** every entry below names its
evidence — the message, the command, or
the list that settles which fault you
have.

## The page shows the PHP source as text

The web server served the file instead
of running it: PHP was never handed the
request. Under the built-in server this
cannot happen to a `.php` file; under
Apache or nginx it is the classic sign
the FPM wiring of chapter 14 is missing
or the location rule doesn't match.
It is never a fault in the script —
the script never ran.

## "Call to undefined function"

A function the interpreter does not
have: either an extension is not loaded
(run `php -m` — chapter 4 — and look
for it; on the web side, check the
*web* setting's module list, not the
CLI's), or it is a library function and
the file defining it was never included
— for Composer projects, the missing
line is `require .../vendor/autoload.php`.

## "Class PDO not found" / "could not find driver"

PDO itself missing is the first;
the second is subtler: PDO is present
but the *driver* for your engine is
not. The driver list is its own array:

```
php -r 'print_r(PDO::getAvailableDrivers());'
```

If `sqlite` is absent from it, the
package you want is `php-sqlite3`
(chapter 3) — in the *web* setting too,
which is again a separate conf.d.

## A blank page, and nothing anywhere

Almost always a fatal error with
display off and the log going somewhere
you are not looking. Chapter 12's
drill: check the error log named by the
running setting (server log, FPM log,
or the `error_log` file), or reproduce
the request from the command line,
where display defaults to on and the
fatal will introduce itself.

## "Headers already sent"

Something printed before
`header()` ran — an echo, a stray space
before `<?php`, a newline after a
closing `?>` in an included file (the
reason chapter 4's habit omits the
closing tag in pure-PHP files). The
warning names the file and line where
output began; believe it, and go there
first.

## It works in the terminal, not in the browser

Two settings, two configuration files
(chapters 4 and 12). Different loaded
extensions, different error settings,
different working directory — a
relative path like `'sqlite:data.db'`
resolves in different places. Name the
difference before fixing: `php --ini`
for the CLI world, a `phpinfo()` page
for the web one, and absolute paths
(`__DIR__ . '/...'`) in code that must
work in both.

## Composer is slow, or says the JSON is invalid

Composer's own doctor is
`php composer.phar diagnose`. Behind a
strict proxy or firewall its downloads
fail in ways that look like corrupt
data (the lab's t11 captured one: a
packagist reply that "does not contain
valid JSON", cured by giving PHP its
curl extension so a different transport
carried the same request). Verify the
phar's hash before suspecting it —
chapter 11's check — and suspect the
network path before the packages.

## "No delimiter found" in a regex

The pattern arrived without its
slashes (chapter 7). `preg_match`
wants `'/pattern/'`, not `'pattern'` —
the first character of the string is
read *as* the delimiter, which is why
the error sounds like it is about
something else entirely.

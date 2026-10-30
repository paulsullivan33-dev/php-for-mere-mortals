# Composer and Packages

**Outcome:** Composer — PHP's package
manager — is installed *and verified*,
one real library is installed into a
project from its lock file, and your
own code uses that library through the
autoloader.

**Check:** transcripts t09 to t12 are
the lab's road, including its two
potholes. The destination proofs: the
installer's SHA-384 check answered
"Installer verified"; the phar's
SHA-256 matched the published sum
digit for digit; and `use-monolog.php`
wrote a real log line (t12).

## Installing, with the signature checked

Composer's own instructions offer an
installer script, and ask you to verify
it before running it — because running
an unverified installer is handing your
machine to whoever served the file. The
check is one comparison: the SHA-384 of
the downloaded installer must equal the
signature published at
composer.github.io. The lab downloaded
both files and ran the comparison in
PHP itself:

```
Installer verified
```

Only then was the installer run. The
lab's road had a pothole worth naming:
the installer, fetching Composer's
`composer.phar` with PHP's own download
machinery, could not get through this
sandbox's proxy ("Cannot connect to
HTTPS server through proxy" — kept
verbatim in t09), and an even earlier
attempt to fetch with PHP streams hit
an SSL timeout (t08). The detour used
the same discipline with a different
fetch: `curl` brought the phar, and its
**SHA-256 matched the published
`.sha256sum` exactly** (t10) before
`php composer.phar --version` reported
Composer 2.11.0 alive. The lesson
generalises beyond this sandbox: when a
download path fails, change the path if
you must — never skip the verification.

## Requiring a package

Inside a project folder, one command
fetches a library and everything it
needs:

```
$ php composer.phar require monolog/monolog
```

Transcript t12 shows the anatomy: a
`composer.json` created ("require":
monolog `^3.12`), the resolver locking
**monolog 3.12.1** and its one
dependency **psr/log 3.0.2**, the lock
written to `composer.lock`, both
packages downloaded and unpacked into
`vendor/`, and an autoload file
generated. The division of labour to
remember:

- **composer.json** is your statement:
  what the project needs, in version
  ranges (`^3.12` means "3.12 or any
  compatible later 3.x").
- **composer.lock** is the record: the
  exact versions that were resolved,
  once. It is the file you commit, so
  the next machine installs the same
  code, not today's newest.
- **vendor/** is the delivery: the
  packages themselves, owned by
  Composer, never edited by hand.

(The lab's first `require` attempt —
t11 — failed against the sandbox proxy
because the lab's PHP had no curl
extension loaded; adding the packaged
`php8.3-curl` to the lab's interpreter
fixed it, and t12 is the same command
succeeding. On a normal install the
curl extension arrives with the usual
packages and none of this arises.)

## Using the library

One line opens the door:

```php
require __DIR__ . '/vendor/autoload.php';
```

after which the library's classes are
simply *there*, by name — no list of
files to include. The lab's script
builds a Monolog logger, attaches a
file handler, and logs one event; the
proof it is the real library and not a
coincidence is two-fold: the script
prints where the `Logger` class was
loaded *from* (inside `vendor/monolog/…`),
and the log file holds the line, in
Monolog's own format:

```
[2026-10-30T12:56:53.827249+00:00] noticeboard.INFO: Notice pinned
{"name":"Priya","notice":"Yoga moves to Thursdays"} []
```

That is the everyday shape of modern
PHP: your code, the language, and a
`vendor/` of other people's solved
problems — with a lock file making the
whole arrangement repeatable.

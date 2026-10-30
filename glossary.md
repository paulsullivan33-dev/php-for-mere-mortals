# Glossary

The terms used in this guide, collected
in one place. Each is defined where it
first appears, too.

**Autoload** — Composer's generated file
(`vendor/autoload.php`) that lets code
use installed libraries by class name,
without listing every file by hand.

**Built-in server** — the small web
server inside PHP itself, started with
`php -S address:port`. For development
and learning; single-threaded; not for
the public internet.

**CLI** — the command-line interface:
running `php script.php` in a terminal,
with no web server involved.

**Composer** — PHP's package manager.
Downloads libraries, records their exact
versions in `composer.lock`, and builds
the autoload file.

**Escaping** — encoding text at the
moment it is placed into HTML (with
`htmlspecialchars`) so the browser shows
it as characters instead of treating it
as markup. The output half of injection
defence.

**Extension** — a loadable module that
gives PHP an ability the core lacks:
PDO, mbstring and the database drivers
are extensions. `php -m` lists the
loaded ones.

**Framework** — a structured set of
libraries and conventions (Laravel,
Symfony) that supplies the skeleton of a
large application. Built from the
language; not a substitute for knowing
it.

**PDO** — PHP Data Objects: the standard
database layer. One style of code,
parameterised queries, many engines.

**Parameterised query** — a query whose
values are sent to the database
separately from its structure, so a
value can never be mistaken for a
command. Also called a prepared
statement.

**PHP-FPM** — FastCGI Process Manager: a
pool of PHP processes that a production
web server (Apache, nginx) hands
requests to.

**php.ini** — PHP's configuration file:
error display, logging, limits, loaded
extensions. The CLI and web settings
live in separate files on packaged
installs, which explains a classic
"works in the terminal, not in the
browser" surprise.

**Request / response** — the web's basic
exchange: a browser asks (the request:
address, method, form fields), the
server answers (the response: an HTML
page). A PHP web script runs once per
request and persists nothing between
them unless it stores it.

**SQLite** — a complete database engine
kept in a single file, needing no server
process. This guide's lab database.

**Superglobal** — a variable PHP itself
fills in before your code runs:
`$_GET` (address parameters), `$_POST`
(form submissions), `$_SERVER` (facts
about the request) and their kin.

**Type juggling** — PHP's habit of
converting values between types when an
operation seems to ask for it (`"5" + 3`
is 8). Convenient, occasionally
surprising; chapter 5 shows it and the
strict comparisons that tame it.

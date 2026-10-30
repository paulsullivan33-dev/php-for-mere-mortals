# PHP for Mere Mortals

A very large share of the web was — and
still is — assembled at the moment of
the request by programs written in PHP:
the blogs, wikis, forums and small
organisation sites that ordinary people
actually run. This guide teaches the
language itself, in its modern PHP 8
form: the interpreter on the command
line first, then a complete, small web
application built and *proven* — a
noticeboard whose notices survive in a
database, whose hostile input is shown
to fail, and whose errors behave
exactly as configured.

The lab behind it ran genuine PHP
8.3.6 from the Ubuntu packages. It
demonstrated types and their juggling,
arrays in both their shapes, string and
regex work counted in bytes *and*
characters, and PDO database work with
parameterised queries — then served
the noticeboard from PHP's own built-in
server, posted a notice by form and
read it back three ways (the POST's
reply, the following page, and the
database file itself opened by a
separate process), attacked it with an
HTML injection and watched the output
escaping hold, refused an incomplete
submission with the application's own
message, ran one broken script three
ways to show errors displayed, hidden
and logged — and installed Composer
with its signature verified, required
the Monolog logging library, and used
it from a script whose output is a real
log line. The production wiring —
Apache or nginx with PHP-FPM,
OPcache, deployment — is described
honestly as documented-only in chapter
14; the BookStack guide in this series
runs a PHP application under a real
server.

## Who this is for

Anyone who keeps meeting PHP — in a
site they maintain, an application
they administer, a tutorial they are
trying to follow — and wants the
language underneath to stop being a
mystery. No previous programming is
assumed beyond the command line itself;
the guide starts with what the pieces
are and proves each one as it goes.

## The chapters

- [**What PHP is**](what-php-is.md) —
  the server-side language inside much
  of the web, and its two standing
  habits of safety
- [**The moving parts**](the-moving-parts.md) —
  interpreter, extensions, database,
  web server and Composer, and whose
  fault a failure is
- [**Installing PHP**](installing-php.md) —
  three packages on Ubuntu, and what
  each one is for
- [**First checks**](first-checks.md) —
  version, module list and settings
  file: the three questions that answer
  most surprises
- [**Types and variables**](types-and-variables.md) —
  types, juggling, loose and strict
  comparisons, and asking for strictness
- [**Arrays — one collection, two jobs**](arrays-lists-and-maps.md) —
  lists and maps in a single type, and
  the shape of database rows
- [**Strings and patterns**](strings-and-patterns.md) —
  interpolation, bytes versus
  characters, and regular expressions
- [**Talking to a database**](talking-to-a-database.md) —
  PDO and SQLite from the command line:
  parameters, never glue
- [**Your first web app**](your-first-web-app.md) —
  the noticeboard: a form, a database,
  and the complete round trip
- [**Proving it worked**](proving-it-worked.md) —
  the injection trial and the missing
  field, read back from the database
- [**Composer and packages**](composer-and-packages.md) —
  the package manager, installed with
  its signature verified, one library
  used for real
- [**Errors, shown and logged**](errors-shown-and-logged.md) —
  warnings and fatals, display versus
  logging, and the two-php.ini surprise
- [**Recipes**](recipes.md) — CSV in,
  JSON out, sessions, mail, and cron
- [**The production shape**](production-shape.md) —
  what replaces the built-in server,
  labelled documented-only
- [**The neighbours**](the-neighbours.md) —
  the applications, the other languages,
  the servers and the frameworks
- [**Limits**](limits.md) — the
  request-shaped life, the old web's old
  advice, and what PHP is not for
- [**Troubleshooting**](troubleshooting.md) —
  the regular failures, in the order
  you will meet them
- [**Glossary**](glossary.md) — the
  terms, collected in one place

## What it doesn't cover

Frameworks in depth: Laravel and
Symfony are characterised in chapter 15
but not taught — the guide teaches the
language they are built from, on
purpose. Production wiring is described
(chapter 14) but not performed, and the
guide says so rather than performing a
tidier fiction. WordPress gets its
characterised paragraph as the most
famous PHP application; administering
it is another guide's job, and this
series does not have that guide.
Nothing here teaches finding or
exploiting other people's PHP sites:
the one attack in the book is aimed at
the lab's own noticeboard, by its own
author, to prove its defence.

## How to use this guide

Read chapters 1 and 2 first — the
model (a request arrives, a script
runs, a page leaves) and the map of
parts make everything later a named
thing rather than a mystery. Chapters 3
to 8 are the language, each with a lab
script to run against its transcript.
Chapter 9 is the centre: build the
noticeboard, then chapter 10 tries to
break it. Chapters 11 and 12 are the
working tools — packages and errors —
and 13 to 15 are the shelf to come back
to. The lab itself lives in `php-lab/`:
fourteen numbered transcripts (t00 to
t13), the three command-line scripts,
the noticeboard's two files, and the
Composer project's script and manifest.

---

## Part of the series

This guide is one of the [For Mere Mortals](https://paulsullivan33-dev.github.io/mere-mortals/) guides: plain-language guides to the tools programmers and makers use.

Related guides:

- [BookStack for Mere Mortals](https://paulsullivan33-dev.github.io/bookstack-for-mere-mortals/)
- [Node.js for Mere Mortals](https://paulsullivan33-dev.github.io/nodejs-for-mere-mortals/)
- [SQL for Mere Mortals](https://paulsullivan33-dev.github.io/sql-for-mere-mortals/)
- [nginx for Mere Mortals](https://paulsullivan33-dev.github.io/nginx-for-mere-mortals/)
- [Caddy for Mere Mortals](https://paulsullivan33-dev.github.io/caddy-for-mere-mortals/)

## License

The writing in this guide is licensed under [CC BY 4.0](https://github.com/paulsullivan33-dev/php-for-mere-mortals/blob/main/LICENSE). Code examples and lab scripts are licensed under the [MIT License](https://github.com/paulsullivan33-dev/php-for-mere-mortals/blob/main/LICENSE-CODE).

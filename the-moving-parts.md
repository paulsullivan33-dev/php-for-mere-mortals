# The Moving Parts

**Outcome:** you can name each piece of
a PHP setup, say which piece does what,
and tell whose fault a failure is before
you start fixing it.

**Check:** for each of the five failures
at the end of this chapter, name the
part responsible.

A PHP setup has five parts. None of them
is large, and most confusion comes from
blurring two of them together.

## The interpreter

PHP itself is a program — `php` — that
reads source code and runs it. There is
no compile step the user manages: you
write a text file ending in `.php`, the
interpreter reads it, compiles it in
memory to an internal form, and executes
that. Edit the file, and the next run
sees the edit. This short loop — type,
run, look — is why PHP has always been
easy to learn in.

The same interpreter works in two very
different settings, and this guide uses
both:

- **On the command line** (the *CLI* —
  command line interface), where `php
  script.php` runs a file much as Python
  or Bash would, reading input and
  writing output in your terminal.
- **Behind a web server**, where each
  incoming request starts a fresh run of
  the relevant script, and everything
  the script prints becomes the page
  sent back.

## Extensions

The core interpreter is deliberately
small. Most specific abilities — talking
to a database, handling multi-byte text
such as emoji or accented characters,
working with images — live in
**extensions**: loadable modules the
administrator switches on. `php -m`
lists the ones currently loaded, and
chapter 4 makes reading that list a
habit, because "it worked on my machine"
very often means "my machine had the
extension loaded."

This guide's lab leans on three:
**PDO** (PHP Data Objects, the standard
way to talk to databases), its SQLite
driver, and **mbstring** (multi-byte
string functions that count and cut text
by characters rather than bytes).

## The database

Web applications keep their facts —
notices, accounts, orders — in a
database, separate from the code. PHP
more often than not talks to MySQL or
MariaDB in production; this guide's lab
uses **SQLite**, a complete database
held in a single file, because it needs
no server of its own and the ideas —
tables, queries, parameters — are the
same ones the bigger engines use. The
series' SQL guide covers the language of
queries itself.

## The web server

In production, a web server such as
Apache or nginx receives requests and
hands the PHP ones to the interpreter
(usually a pool of PHP processes called
**PHP-FPM** — FastCGI Process Manager).
That wiring is chapter 14's
documented-only territory: the concepts
matter, and the BookStack guide in this
series runs a PHP application under a
real server, so you can see the full
arrangement proved there.

For learning, PHP removes the middleman:
it ships a **built-in web server**,
started with one command, that serves a
folder of PHP files on an address you
choose. It is single-threaded and not
meant for the public, and chapter 9 says
so plainly — but everything an
application *does* (forms, databases,
escaping) behaves exactly as it will in
production, which makes it the honest
way to learn.

## Composer

Real PHP work rarely starts from an
empty folder. **Composer** is PHP's
package manager: it downloads libraries
other people have written, records exact
versions in a `composer.lock` file, and
generates the **autoload** file that
lets your code use them by name.
Chapter 11 installs it, verifies its
signature, and uses one small library
for real.

## Whose fault is it?

- *The page shows the PHP source as
  text* — the web server never handed
  the file to PHP. A server-wiring
  problem, not a code problem.
- *`Call to undefined function`* — an
  extension is not loaded, or the
  library that defines the function was
  never included. Chapter 4's list
  answers it.
- *The script runs but the data is
  stale or missing* — the database:
  wrong file, wrong table, or a query
  that asks for something else.
- *A warning about headers already
  sent* — the script printed something
  before trying to set a header; output
  order, a code problem.
- *The command-line run works, the web
  run does not* — the two settings use
  separate configuration files
  (`php.ini`), and the web one differs.
  Chapter 12 makes that visible.

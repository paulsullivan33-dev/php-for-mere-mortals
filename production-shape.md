# The Production Shape

**Outcome:** you can describe — part by
part — what changes when a PHP
application stops being a learning
exercise and starts serving the public,
and say which parts this guide proved,
which it pointed to, and which are
beyond its lab.

**Honesty first:** the wiring in this
chapter is *documented-only*. The lab
had no public server to wire, and this
guide will not pretend otherwise. What
it did prove is everything the wiring
exists to carry: the application, the
database conversation, the escaping,
the error discipline. The BookStack
guide in this series runs a real PHP
application under a real web server,
and is this chapter's standing proof by
reference.

## What replaces the built-in server

The built-in server of chapter 9 is
single-threaded, serves one request at
a time, and says DEVELOPMENT in its own
banner. Production swaps it for two
processes doing one job each:

- a **web server** — Apache, nginx or
  Caddy (the series has guides to the
  last two) — terminating visitors'
  connections, serving static files
  directly, and holding the TLS
  certificates;
- **PHP-FPM**, a pool of PHP worker
  processes waiting behind it. The web
  server passes each PHP request to a
  worker over the FastCGI protocol; the
  worker runs the script and hands back
  the page.

Your application's code does not change
for the move: the same `index.php`, the
same PDO, the same superglobals. What
changes is everything around it —
concurrency, restarts, a separate
php.ini (the `fpm` one, chapter 12's
lesson), and logs that go to files
because there is no terminal any more.

## The settings that change their meaning

- **`display_errors` off, `log_errors`
  on** — chapter 12's rule, now with
  strangers as the audience.
- **OPcache on.** The interpreter
  normally compiles each file afresh
  per run (chapter 2); OPcache keeps
  the compiled form in memory between
  runs. It is the single largest
  easy speed-up a PHP site gets, and it
  is a configuration switch, not a code
  change. (Its tuning — memory sizes,
  revalidation intervals — is
  documented-only here; the switch
  itself is one line.)
- **The document root points at the
  public folder only.** Chapter 9's
  placement of the database outside the
  served folder becomes the general
  rule: configuration files, `vendor/`,
  and anything not meant to be
  downloaded all live outside the one
  folder the web server can reach.

## The database grows up, or doesn't

SQLite's honest edge arrives when many
writers contend or the application
spans machines. The production step is
the one chapter 8 prepared for: change
PDO's connection string to a MySQL,
MariaDB or PostgreSQL server, keep the
queries and the code. Nothing about the
move is PHP's problem — the SQL dialect
differences and the server's care are
the database guides' territory.

## Deployment, briefly

The common shapes: a **shared host**,
where the provider owns the server and
you upload files (Composer runs there
too, or `vendor/` travels with the
upload); a **virtual server** you wire
as above; or the application packaged
in a container, as the series' Docker
guide teaches. Which is right is a
question of audience and budget, not of
PHP — the language has run under all
three for decades, which is precisely
its production reputation.

# What PHP Is

A large share of the web pages you have
ever opened were assembled, at the moment
you asked for them, by a program written
in PHP. WordPress, Wikipedia's software,
Facebook's earliest code, the wiki and
noticeboard and shop software running on
a million small servers — PHP is the
language inside a great deal of the web
that ordinary people and small
organisations actually run.

**PHP is a programming language built
for the web, and old enough to have
grown up with it.** It began in 1995 as
one programmer's small set of tools for
his own home page — the initials stood
for *Personal Home Page* — and became a
language in which a page could contain
ordinary HTML with pieces of program
mixed into it. Those pieces run on the
**server** (the machine that holds the
website), never in the visitor's browser.
By the time a page reaches you, the PHP
has already run and gone; what travels
is the finished HTML it produced.

That one idea — *the program runs on the
server, the visitor sees only its
output* — is the whole shape of PHP, and
this guide keeps returning to it. PHP
code sits between the web server that
receives a request and the database that
holds the site's facts. It reads the
request, asks the database questions,
and writes the answer as HTML.

Three honest things to say at the start:

- **PHP is unfashionable and enormous.**
  Fashion in programming moves faster
  than the web itself. PHP's share of
  running websites is larger than any
  rival's, because so much proven
  software is written in it.
- **PHP had a scruffy youth.** Early
  versions were loose about types and
  errors, and old tutorials still
  circulating teach habits the modern
  language has outgrown. This guide
  teaches the current, tidier PHP —
  version 8 — and names the old habits
  to avoid when you meet them.
- **PHP is not only for web pages.** It
  runs happily from the command line as
  a general scripting language, and this
  guide starts there, where nothing is
  hidden, before building a small web
  application for real in chapter 9.

The lab behind this guide installed
genuine PHP from the Ubuntu packages,
ran it first as a command-line language,
then served a working noticeboard
application — a form, a database, a
stored notice read back by the next
visitor — from PHP's own built-in web
server, and attacked it with a small
HTML injection to prove the output
encoding holds. Every step was captured
in the transcripts in `php-lab/`.

One safety rule belongs here, before any
procedure: a PHP application takes text
from strangers and stores it. The two
habits that keep that safe —
**parameterised queries** for the
database and **escaping** for the page —
are not advanced extras. They are how
the language is meant to be used, this
guide uses them from the first stored
notice onward, and chapter 10 proves
they work.

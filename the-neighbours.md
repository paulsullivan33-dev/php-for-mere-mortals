# The Neighbours

**Outcome:** you can place PHP among the
tools around it — what each neighbour
does instead, alongside, or on top — and
name the moment a job stops being a PHP
job.

**Check:** for each neighbour, say
whether you would reach for it *instead
of* PHP, *with* PHP, or *after* PHP.

## The applications written in PHP

Most people meet PHP through its
applications, not the language.
**WordPress** runs a large share of the
world's blogs and small sites;
**BookStack** — which has its own guide
in this series — is a PHP wiki; the
forums, shops and galleries of the last
twenty-five years are disproportionately
PHP. Knowing the language is what turns
"the admin screen won't do that" into
"then I'll read the code and do it
myself." You reach for these *with* PHP:
the application on top, the language
underneath when you need it.

## The other web languages

**Python** and **Ruby** build web
applications through frameworks (Django,
Rails) that supply structure PHP leaves
to you. **Node.js** — which has its own
guide in this series — runs JavaScript
on the server, one language for browser
and backend. The honest comparison is
not speed; it is shape. PHP's shape is
the oldest: a request arrives, a script
runs top to bottom, a page leaves, and
nothing persists between requests unless
you deliberately store it. That
statelessness is a limitation and a
great simplifier at once — a PHP script
cannot leak state from one visitor to
the next, because there is nowhere for
the state to hide.

## The servers underneath

**nginx** and **Caddy** — both with
guides in this series — receive the
requests and hand PHP its work; Apache
does the same with PHP woven closer in.
None of them replaces PHP, and PHP
replaces none of them: they are the
front door, PHP is a room behind it.
Chapter 14 describes the production
wiring; the built-in server of chapter 9
is the teaching substitute.

## The frameworks

**Laravel** is the framework most new
PHP is written in: routing, templates,
database models and queues as one
considered whole, at the price of
learning the framework alongside the
language. **Symfony** supplies similar
pieces à la carte and underpins Laravel
itself. This guide teaches neither — it
teaches the language they are built
from, deliberately, because framework
knowledge expires with versions and the
underneath does not. When a real project
outgrows chapter 9's noticeboard —
accounts, uploads, email — a framework
is the honest next step, reached for
*after* PHP, not instead of learning it.

## The database engines

**MySQL and MariaDB** are PHP's
traditional partners; **PostgreSQL** —
with its own guide in this series — is
the usual step up for heavier querying;
**SQLite**, this lab's engine, is the
right size for one machine and one
writer at a time. PDO speaks to all of
them with the same code and different
connection strings, which is precisely
why this guide teaches PDO rather than
any one engine's private functions.

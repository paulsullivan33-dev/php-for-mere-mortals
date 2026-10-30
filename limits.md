# Limits

**Outcome:** you can name what PHP
cannot do, should not do, and does
worse than its neighbours — before a
project leans on it for any of those.

**Check:** each limit below is stated
with its shape: the wall you will
actually meet, and what people use
instead.

## A request is a life, lived briefly

A web PHP script starts with nothing,
answers, and is gone (chapter 2).
Anything that must persist — a chat
room's *now*, a game state, a live
feed — has to be rebuilt from storage
on every request, farmed out to
another process, or served by something
else. Long-lived connections
(WebSockets and their kin) are the
shape PHP fits worst; Node.js and Go
were built for exactly that ground.

## One thread per request

A single PHP run is single-threaded:
it will not spread one slow job across
your machine's cores, and a script that
waits, waits alone. The FPM pool makes
*many visitors at once* scale well;
*making one visitor's heavy job faster*
is not in the model. Heavy computation
belongs in a background process (often
still PHP, run from cron or a queue —
chapter 13 — but out of the request's
way).

## The old web is full of old PHP

PHP's history is its documentation
problem: decades of tutorials teach the
removed `mysql_*` functions, SQL built
by gluing strings, errors suppressed
with `@`, and loose comparisons against
PHP 7's rules. The language today is
stricter and better than its search
results. Treat any PHP advice that
predates version 8 — or that never
names a version — as history, not
instruction; this guide's habits
(parameters, escaping, strict types,
exceptions on) are the current ones.

## Shared-nothing cuts both ways

The statelessness that makes PHP hard
to break makes some things genuinely
awkward: no in-memory cache of your own
survives between requests (the answers
are OPcache for code and a real cache
or database for data), and framework
boot costs are paid per request, which
is why OPcache is near-mandatory rather
than a tuning nicety (chapter 14).

## Numbers and text have edges

PHP's integer is the machine's (64-bit
on any modern build); money computed in
floats drifts the way floats do
everywhere, and serious money wants
integer minor units or the bcmath
extension. Strings are byte rows
(chapter 7): every tool that assumes
characters must be chosen deliberately,
with the `mb_` functions, or accented
names will eventually be cut in half.

## What it is not for

Not for desktop or mobile applications;
not for holding a million sockets; not
for replacing the database or the web
server it sits between. PHP's kingdom
is the request-and-page web, plus the
command-line chores around it — a
kingdom that happens to contain a very
large share of the web as it actually
exists.

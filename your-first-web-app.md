# Your First Web App

**Outcome:** a working noticeboard
serves from your own machine: a form, a
submission stored in the database, and
the next page load showing it — the
complete round trip every web
application is made of.

**Check:** transcript t04 is the lab's
run of exactly this chapter — a POST
answered with a 303 redirect, a GET
whose page lists "Yoga moves to
Thursdays", and a separate process
reading the same row out of the
database file.

## The application

The lab's app is the **Maple Street
Hall noticeboard** — invented, generic,
and complete in one file,
`php-lab/app/public/index.php`. A
visitor pins a notice (their name, a
line of text); the board lists every
notice, newest first. It is small on
purpose: the round trip is the subject,
and nothing may hide it.

Its moving parts, in the order a
request meets them:

1. **The database connects first**, and
   the table is created if it is not
   there — the same PDO code as chapter
   8, with one deliberate placement: the
   database file lives *beside* the
   served folder, not inside it, so no
   address can ever download it.
2. **A POST is answered before any page
   is drawn.** The script looks at
   `$_POST` — the superglobal PHP fills
   with the form's fields — trims both
   values, and checks they are present
   (chapter 10 puts that check on
   trial).
3. **A good notice is stored** with a
   parameterised insert, and the script
   replies with a redirect:
   `header('Location: /', true, 303)`.
   This is the **PRG pattern** — Post,
   Redirect, Get: the browser follows to
   a plain GET, so refreshing the page
   re-reads the board instead of pinning
   the notice twice.
4. **A GET draws the page**: the rows
   are fetched newest-first, and each is
   printed *through `htmlspecialchars`* —
   the escaping habit chapter 10 attacks
   and proves.

## The server

Chapter 2 promised a server with no
wiring, and here it is. From the folder
above the app:

```
$ php -S 127.0.0.1:8090 -t app/public
PHP 8.3.6 Development Server (http://127.0.0.1:8090) started
```

`php -S` starts PHP's **built-in web
server**: it serves the folder named
after `-t` on the address given, runs
each request's PHP, and logs every
request to the terminal. `127.0.0.1` is
loopback — the machine talking to
itself — so the board is reachable from
this machine only, which is the right
amount of public for a first app. The
server is single-threaded and carries
PHP's own warning that it is a
development tool; chapter 14 names what
production puts in its place. Everything
the *application* does, though, is
exactly what it will do there.

## The round trip, read closely

Transcript t04 deserves a slow read,
because all of web programming is in
it. The POST's reply is three facts: a
**303** (the redirect instruction), a
`Location: /` (where to go), and an
empty body (nothing to show yet — the
GET will do the showing). The GET's
page then contains the notice as
ordinary HTML, with the count in the
heading already at 1. And the third act
is the quiet one: a *separate* PHP
process, which never went near the web
server, opens the database file and
prints the row —

```
1 | Priya | Yoga moves to Thursdays | 2026-10-30 12:15:49
```

— which proves the notice is not an
echo or a trick of the browser, but a
fact stored on disk, in a file that
will still be there tomorrow. That
three-way agreement (the POST accepted
it, the page shows it, the database
holds it) is the standard of proof the
next chapter applies to the app's
safety.

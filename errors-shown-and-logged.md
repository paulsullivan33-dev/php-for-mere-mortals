# Errors, Shown and Logged

**Outcome:** you can make PHP show its
errors while you develop and hide them
— into a log, never into the void —
when visitors are watching, and you can
predict which of the two a given setup
will do.

**Check:** transcript t07 runs one
deliberately broken script three ways.
Match its three verdicts: on the
command line, a named warning then a
fatal, exit 255; in a browser with
display on, the same errors formatted
into the page; with display off, a 500
and a bare page, and the whole story in
the log file.

## Two severities, two fates

The lab's `broken.php` commits both
classic sins on purpose. First it reads
an array key that does not exist:

```
PHP Warning:  Undefined array key 5 in broken.php on line 11
```

A **warning** is PHP saying "that made
no sense, I have used `null` and
carried on" — and the script does carry
on; its next line prints. Then it calls
a function that does not exist:

```
PHP Fatal error:  Uncaught Error: Call to undefined function
this_function_does_not_exist() in broken.php:14
```

A **fatal error** ends the run: the
"Never reached" line after it never
prints, on any of the three runs. The
distinction matters for debugging
triage — output *after* a warning
exists and can mislead you about where
things stopped; output after a fatal
does not exist, and its absence is the
clue.

## The switchboard: php.ini

Two settings decide where errors go:

- **`display_errors`** — print them into
  the output (the page, or the
  terminal).
- **`log_errors`** with **`error_log`** —
  write them to a file instead, or as
  well.

Transcript t07's middle run starts the
server with `-d display_errors=1` — the
`-d` flag sets a `php.ini` value for
that run only, a tidy way to experiment
— and the visitor sees the warning and
the fatal set into the page as HTML,
file paths and all. The third run sets
`display_errors=0, log_errors=1` and an
`error_log` file: the visitor now gets
an HTTP **500**, the partial output
from before the fatal, and *nothing*
that names the fault — while the log
file quietly receives every word of it,
timestamped. Neither run lost any
information; they differ in *audience*.

The rule writes itself:

- **Developing:** display on. The error
  in your face, in the page, is the
  fastest teacher there is.
- **Serving visitors:** display off,
  logging on, and read the log. A shown
  error leaks file paths and code
  details to strangers and tells them
  precisely where to push next; a logged
  error keeps the same facts for the
  one person who should have them.

## The classic surprise, explained

You will meet this in the wild: "I set
`display_errors` in php.ini and nothing
changed." Chapter 4's lesson is the
usual answer — there is more than one
php.ini (command line, each web
setting), and the file edited was not
the file the failing run loaded.
`php --ini` on the command line, and a
throwaway page calling `phpinfo()` on
the web side, name the loaded file in
each world; a one-off `-d` flag, as the
lab used, sidesteps the question
entirely while you experiment. (Treat a
`phpinfo()` page as scaffolding: it
publishes your whole configuration, so
it comes down the moment it has
answered.)

# First Checks

**Outcome:** before writing a single
line of your own, you have asked the
interpreter who it is, what it can do,
and where its settings live — the three
questions that answer most later
surprises.

**Check:** the three commands below all
answer. Transcript t00 is the lab's own
answers, kept as the shape to compare
yours against.

## Who are you?

```
$ php --version
PHP 8.3.6 (cli) (built: Oct 19 2026 15:16:58) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.3.6, Copyright (c) Zend Technologies
```

Three facts live in that first line.
The **version** (8.3.6) decides which
language you have: anything in the 8.x
line runs everything in this guide. The
**(cli)** says this binary is the
command-line face. **(NTS)** — non
thread safe — is the normal build for
how PHP is usually run and not a
warning.

## What can you do?

```
$ php -m
```

prints the loaded **modules** —
extensions, in the vocabulary of chapter
2 — in two lists (plain PHP modules,
then Zend ones; the lab's run had OPcache
in the second). Read the list, don't
admire it: the four names this guide
leans on are `PDO`, `pdo_sqlite`,
`sqlite3` and `mbstring`, and all four
must be present. A missing name here is
the answer to the classic later riddle
"it worked on the other machine": that
machine had the extension, this one
does not, and the fix is its package
(chapter 3), not your code.

## Where do the settings live?

```
$ php --ini
```

names the configuration file this
setting loaded and the folder it scanned
for extension switches. On the lab's
packaged install the answers were
`/etc/php/8.3/cli/php.ini` and its
sibling `conf.d` — and the word to
carry forward is **cli**: a web setting
on the same machine reads *different*
files from a different folder
(`.../fpm/` or `.../apache2/`). When a
setting seems to change nothing, the
first suspicion is always that you
edited the other setting's file.

## A first conversation

The interpreter will also run code you
hand it directly, which makes a fine
smoke test:

```
$ php -r 'echo "PHP is awake.\n";'
PHP is awake.
```

and every script in this guide can be
syntax-checked without running it:

```
$ php -l types.php
No syntax errors detected in types.php
```

Finally, the habit that makes the rest
of the guide possible: PHP files begin
with `<?php` and, when a file is *only*
PHP, omit the closing `?>` on purpose —
a stray character after it would become
output. Every example here follows that
rule.

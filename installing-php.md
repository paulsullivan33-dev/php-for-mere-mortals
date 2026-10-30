# Installing PHP

**Outcome:** PHP runs on your machine,
from the official packages of your
operating system, and you know which
extra pieces you chose and why.

**Check:** `php --version` prints a
version in the 8.x line. If it prints
"command not found," the install did
not land — nothing else in this guide
can be checked until it does.

## On Ubuntu and Debian

Three packages carry this whole guide:

```
sudo apt update
sudo apt install php-cli php-sqlite3 php-mbstring
```

- **php-cli** is the interpreter and its
  command-line face — the `php` command
  itself, plus the common core
  extensions.
- **php-sqlite3** brings the SQLite
  database drivers (the raw one and,
  riding with it, PDO's), which chapter
  8 and the noticeboard of chapter 9
  use.
- **php-mbstring** brings the multi-byte
  string functions of chapter 7, which
  count and cut text by *characters* —
  the difference matters the first time
  a name has an accent in it.

Accept the dependencies the package
manager offers; on a current Ubuntu
that resolves to the `php8.3` family.
Note what this deliberately leaves out:
no Apache, no nginx, no MySQL server.
PHP the language needs none of them to
learn with, and chapter 14 is honest
about the production wiring being a
separate, later job.

## On other systems

- **macOS:** `brew install php` from
  Homebrew gives a current interpreter
  with the common extensions included.
- **Windows:** the official builds at
  windows.php.net are plain zip files;
  unzip, put the folder on your `PATH`,
  and copy `php.ini-development` to
  `php.ini` as the installer notes
  describe. Extensions there are `.dll`
  files switched on in that file.
- **Everywhere else:** your distribution
  almost certainly packages PHP the same
  way as Ubuntu — an interpreter package
  plus one package per extension family.

This guide's lab ran the Ubuntu route's
contents: the genuine `php8.3` packages,
version **8.3.6**, from Ubuntu noble.
(The lab machine is a shared sandbox
with no permission to install system
packages, so the lab downloaded the
very same `.deb` files and unpacked
them into its own folder, then ran the
interpreter from there — the criteria
page records the detour, and nothing in
the chapters depends on it. The version
output is identical either way, and
transcript t00 is the evidence.)

## What just arrived

Worth knowing what the packages put on
the machine:

- the `php` command;
- a configuration file per *setting* —
  on Ubuntu, `/etc/php/8.3/cli/php.ini`
  for the command line, with a `conf.d`
  folder beside it whose small files
  switch extensions on (a separate
  folder again for each web setting,
  which is the whole story of chapter
  12's classic surprise);
- no running service. Unlike a database
  or a web server, CLI PHP is not a
  daemon: nothing is listening anywhere
  until you run something. If a tutorial
  tells you to "restart PHP," it means
  the web pool of chapter 14, not this.

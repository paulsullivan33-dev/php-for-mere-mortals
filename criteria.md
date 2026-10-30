# Writing criteria for this guide

Every "for Mere Mortals" guide is written to the same nine-point
standard, so a reader who trusts one can trust the rest. Here it
is, with the verification notes for this particular guide below.

1. **Fix it first.** Reader outcomes lead, not action items: each
   chapter opens by naming the outcome it delivers, shows a check
   the reader can run to confirm they got it, and a reasonable
   reader finishes able to state what was done, what it means,
   and what to try next.
2. **Plain language.** Short sentences, everyday vocabulary,
   technical terms defined on first use. No slang, and no
   idioms that only make sense in one country — the reader may
   be translating as they go.
3. **No dead ends.** A guide never tells the reader to do
   something it cannot show them how to verify. Every claim a
   reader relies on — an install, a command, an output — is
   something this guide demonstrates or clearly labels
   documented-only below.
4. **Live-verified where it matters.** Procedures are run for
   real in the guide's lab wherever the build machine allows it,
   and the transcripts kept in the repository are the evidence.
   What could not be run is listed honestly below, never
   presented as if it had been.
5. **General audiences.** Nothing in this guide — examples,
   fixtures, names, addresses — is modelled on any particular
   reader or author's real life, network, or organisations.
   The noticeboard, its hall and its people are invented.
6. **Standalone.** A reader needs this guide, its lab, and
   nothing else. Where another guide would genuinely help, it
   is pointed to once, by name, and the chapter still completes
   without it.
7. **Honest about limits.** Chapter 16 names what the tool
   cannot do: the brief stateless life of a request,
   single-threaded runs, an ocean of outdated PHP advice, the
   shared-nothing model's costs, and the jobs PHP is simply
   not for.
8. **The ethics rule is in the text, early.** Chapter 1 states
   this guide's line before any procedure depends on it: the
   two habits that make a PHP application safe —
   parameterised queries and output escaping — are the
   default from the first stored notice, and the guide's one
   attack is aimed at its own lab application to prove its
   defence. Nothing here teaches probing anyone else's site.
9. **Builds clean.** The site builds with MkDocs in strict mode
   with no warnings, and a fresh reader following the chapters
   in order reaches the stated outcome of each.

## Verification notes for this guide

The build machine is a 2-CPU, ~7 GB Ubuntu 24.04 (noble)
sandbox, shared with other work. The interpreter throughout is
genuine Ubuntu **PHP 8.3.6** (package family
`8.3.6-0ubuntu0.24.04.13`) — the same build by two routes,
which the sandbox forced and this page records plainly:

- Transcripts **t00–t08** ran against the sandbox's
  pre-installed Ubuntu PHP 8.3.6 (`/usr/bin/php`, full packaged
  extension set) before a mid-lab service restart removed it
  from the machine image.
- Transcripts **t09–t13** ran against the *same packages*
  obtained the prescribed way: downloaded-only into a
  lab-private apt state (`php-cli`, `php-sqlite3`,
  `php-mbstring`, plus `php8.3-curl` added for chapter 11's
  reason) and extracted unmodified with `dpkg -x` into
  `php-labwork/root`. Because extraction runs no maintainer
  scripts, the packaged `conf.d` was empty; the lab ran the
  extracted binary with `-n` and loaded its extensions
  explicitly, in dependency order, via a wrapper kept in the
  labwork folder. Version output is identical by both routes
  (`PHP 8.3.6 (cli)`, same build date), and no chapter's
  teaching depends on the detour — a reader's ordinary
  `apt install` is the route chapter 3 teaches.

All transcripts live in `php-lab/` (t00–t13) with the lab's
source files beside them: `php-lab/cli/` (four scripts),
`php-lab/app/public/` (the noticeboard and the broken script),
`php-lab/greet/` (the Composer project's script and manifest).

Run for real, with transcripts as evidence:

- Version and the loaded-module list from the packaged
  install (t00).
- Types: the five basic types named by `gettype`, type
  juggling shown (`"5" + 3` → int(8)), loose versus strict
  comparison verdicts, PHP 8's `0 == "notice"` false, and a
  `TypeError` raised under `strict_types=1` and caught (t01).
- Arrays: list and map shapes, a list of maps, sort, an
  arrow-function filter (2 of 3 notices over 27 characters),
  and the `??` fallback for a missing key (t02).
- Strings: interpolation both ways, `strlen` 5 bytes versus
  `mb_strlen` 4 characters for *Café*, `mb_substr` cutting
  cleanly, everyday string surgery, and `preg_match` /
  `preg_replace` / `preg_split` with their outputs (t03).
- The noticeboard end to end on the built-in server,
  loopback only: a form POST answered 303, the following GET
  listing the stored notice, and a separate PHP process
  reading the same row from the SQLite file (t04).
- The injection trial: a name carrying
  `<script>alert(1)</script>` and a notice carrying real HTML
  were stored *verbatim* (database read-back proves it) and
  rendered fully escaped — raw `<script>alert` counted 0 in
  the returned page (t05).
- The validation trial: a POST with no name, and one with an
  empty notice, each refused with the application's own
  message; the page count and the database row count both
  stayed at 2 (t06).
- One broken script three ways: CLI (warning, then fatal,
  exit 255); web with `display_errors=1` (both errors
  formatted into the page); web with `display_errors=0` and
  logging on (HTTP 500, partial output only, full detail in
  the log file) (t07).
- Composer, the whole road: the official installer's
  SHA-384 check answered "Installer verified" (t09); the
  installer's own phar download then failed through the
  sandbox proxy, so the phar was fetched directly and its
  SHA-256 matched the published `.sha256sum` digit for digit
  before use (t10) — Composer 2.11.0. A first `require`
  failed on a proxy-garbled packagist reply (t11); with the
  packaged curl extension loaded, the same command locked and
  installed **monolog/monolog 3.12.1** with **psr/log
  3.0.2**, and a script used the class through the autoloader
  and wrote a real log line (t12).
- PDO from the CLI: table created, three bookings inserted
  with parameters (an apostrophe in *O'Brien's* stored and
  read back intact), a parameterised SELECT returning rows
  as maps, a count, and the database named as one 12,288-byte
  file (t13).

Failures kept verbatim, because they teach:

- PHP's own stream download of the Composer installer timed
  out on SSL through the sandbox proxy (t08) — the fetch path
  changed to curl; the signature check did not change and was
  never skipped.
- The Composer installer's internal phar download failed
  through the same proxy (t09), motivating the verified-phar
  detour (t10).
- The first `composer require` failed with a packagist reply
  that "does not contain valid JSON" (t11) until the curl
  extension gave Composer a working transport.
- Two template drafts of the noticeboard rendered "Priyaat"
  because PHP consumes one newline after a closing `?>` tag;
  the shipped template puts the sentence on one line, and
  t04's read-back shows it correct.

Documented only — described from the project's documentation,
not run, and the text does not claim otherwise:

- Apache/nginx + PHP-FPM production wiring, OPcache
  switching and tuning, TLS, and deployment shapes (chapter
  14). The BookStack guide in this series runs a PHP
  application under a real server and is the standing proof
  by reference.
- MySQL/MariaDB and PostgreSQL connections: PDO's contract
  is proven against SQLite and the connection-string change
  is described, but no database server was stood up for this
  guide.
- Laravel, Symfony and the other frameworks (chapter 15) —
  characterised, not installed.
- Sessions, JSON responses and `mail()` (chapter 13) are
  presented as recipes assembled from proven parts; the
  session and mail paths were not themselves executed in the
  lab (no mail system exists in the sandbox, and chapter 13
  says deliverability is a separate problem).
- Anything public-facing: every server run in the lab was
  loopback-only, and the built-in server is taught as a
  development tool, never as a way to publish a site.

Fixtures are this guide's own and deliberately generic: the
Maple Street Hall, its noticeboard, and invented people
pinning invented notices about yoga, ladders and jumble
sales. The 01632 phone number in chapter 7's regex example is
from the range reserved for fiction. Nothing is modelled on
any real person, hall or organisation.

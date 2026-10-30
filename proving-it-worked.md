# Proving It Worked

**Outcome:** the noticeboard is not just
running but *tested*: a hostile notice
fails to break the page, an incomplete
submission is refused, and both verdicts
are read off the responses and the
database, not assumed.

**Check:** transcripts t05 and t06 are
the trials described here. Your rerun
should match them verdict for verdict:
escaped output present, raw `<script>`
absent (a count of 0), the refusal
message shown, and the stored-row count
unchanged.

## Trial one: the injection

Chapter 1's safety rule has two halves,
and this trial exercises the output
half. A visitor named Eve submits a
notice with a live script tag in her
name and real HTML in the text:

```
name   Eve <script>alert(1)</script>
notice Free chairs <b>this weekend</b> & "quotes"
```

If the board printed those values raw,
every later visitor's browser would run
the script and style the text — the
stored notice would *be* code. The
board prints them through
`htmlspecialchars`, and transcript t05
shows what actually came back:

```
<p>Free chairs &lt;b&gt;this weekend&lt;/b&gt; &amp; &quot;quotes&quot;</p>
<p><small>Posted by Eve &lt;script&gt;alert(1)&lt;/script&gt; ...
```

Every angle bracket became its harmless
entity form: the browser will *display*
`<b>` as characters and make nothing of
it. The proof is finished two ways: a
search of the returned page for the raw
`<script>alert` counts **0**, and the
database read-back shows the stored row
holding Eve's text *verbatim* —

```
Eve <script>alert(1)</script> | Free chairs <b>this weekend</b> & "quotes"
```

— which is the real shape of the
defence: **store honestly, escape at
the moment of output.** The data stays
true; the danger is removed at the one
place it could act, the boundary
between your program and the browser.

## Trial two: the missing field

The form marks both fields `required`,
but that attribute is a courtesy a
browser may honour — `curl` ignores it
entirely, and so would an attacker. The
fence that counts is the server's own
check. Transcript t06 submits twice —
once with no name at all, once with a
name and an empty notice — and both
times the reply is the application's
own sentence:

```
<p class="error">Please give your name and a notice — both are needed.</p>
```

and the heading still counts 2 notices,
and the database still holds 2 rows.
Nothing was stored, nobody was shown a
stack trace, and the refusal came from
the application's validation, not from
the database complaining. That order —
validate at the door, store only what's
sound — is what keeps bad rows out of
the table instead of merely hiding
them.

## The pattern to keep

Both trials follow the shape this
series uses everywhere: **do the thing,
then read the result back from a place
the thing cannot fake.** The page is
what the app *claims*; the database
file, read by a process that never
spoke to the web server, is what
*is*. When the two agree — on a stored
notice, on an unchanged count — the
claim is proven. When a tutorial or a
vendor asks you to take the claim
alone, you now know the extra step to
insist on.

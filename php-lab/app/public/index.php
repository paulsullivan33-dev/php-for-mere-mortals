<?php
// The Maple Street Hall noticeboard — one file, three ideas:
// PDO with parameterised queries, server-side validation, and
// escaping at the moment of output.
declare(strict_types=1);

// The database lives OUTSIDE the served folder, so no URL can
// ever reach it. The folder is created on first run.
$dataDir = __DIR__ . '/../data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0775, true);
}
$db = new PDO('sqlite:' . $dataDir . '/notices.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec(
    'CREATE TABLE IF NOT EXISTS notices (
        id      INTEGER PRIMARY KEY AUTOINCREMENT,
        name    TEXT NOT NULL,
        notice  TEXT NOT NULL,
        created TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
    )'
);

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = trim($_POST['name'] ?? '');
    $notice = trim($_POST['notice'] ?? '');
    if ($name === '' || $notice === '') {
        // The form's "required" attributes are a courtesy for
        // browsers. This check is the actual fence: it runs on
        // the server, against whatever actually arrived.
        $error = 'Please give your name and a notice — both are needed.';
    } else {
        // The values travel separately from the query's shape,
        // so no value can ever be mistaken for SQL.
        $stmt = $db->prepare(
            'INSERT INTO notices (name, notice) VALUES (?, ?)'
        );
        $stmt->execute([$name, $notice]);
        // Redirect after a successful POST, so a browser refresh
        // re-reads the board instead of pinning the notice twice.
        header('Location: /', true, 303);
        exit;
    }
}

$notices = $db
    ->query('SELECT name, notice, created FROM notices ORDER BY id DESC')
    ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Maple Street Hall — Noticeboard</title>
</head>
<body>
<h1>Maple Street Hall — Noticeboard</h1>

<?php if ($error !== null): ?>
<p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form method="post" action="/">
<p><label>Your name
<input type="text" name="name" required></label></p>
<p><label>Notice
<input type="text" name="notice" required></label></p>
<p><button type="submit">Pin it</button></p>
</form>

<h2>Notices (<?= count($notices) ?>)</h2>
<?php foreach ($notices as $n): ?>
<article>
<p><?= htmlspecialchars($n['notice'], ENT_QUOTES, 'UTF-8') ?></p>
<p><small>Posted by <?= htmlspecialchars($n['name'], ENT_QUOTES, 'UTF-8') ?> at <?= htmlspecialchars($n['created'], ENT_QUOTES, 'UTF-8') ?> UTC</small></p>

</article>
<?php endforeach; ?>
</body>
</html>

<?php
include 'db.php';
include 'templates/header.php';

$stmt = $pdo->query("SELECT * FROM threads ORDER BY created_at DESC");
$threads = $stmt->fetchAll();

echo "<h2>Threads</h2>";
foreach ($threads as $thread) {
    echo "<a href='thread.php?id={$thread['id']}'>{$thread['title']}</a><br>";
}
?>

<?php include 'templates/footer.php'; ?>

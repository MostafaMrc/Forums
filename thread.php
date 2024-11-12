<?php
include 'db.php';
include 'templates/header.php';

$thread_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM threads WHERE id = ?");
$stmt->execute([$thread_id]);
$thread = $stmt->fetch();

echo "<h2>{$thread['title']}</h2>";

$post_stmt = $pdo->prepare("SELECT * FROM posts WHERE thread_id = ?");
$post_stmt->execute([$thread_id]);
$posts = $post_stmt->fetchAll();

foreach ($posts as $post) {
    echo "<p>{$post['content']} - User ID: {$post['user_id']}</p>";
}

if (isset($_SESSION['user_id'])): ?>
    <form method="POST" action="thread.php?id=<?= $thread_id ?>">
        <textarea name="content" placeholder="Write your reply..." required></textarea>
        <button type="submit">Post</button>
    </form>
<?php endif; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO posts (content, thread_id, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$content, $thread_id, $user_id]);

    header("Location: thread.php?id=$thread_id");
}
?>

<?php include 'templates/footer.php'; ?>

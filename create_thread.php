<?php
include 'db.php';
include 'templates/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO threads (title, user_id) VALUES (?, ?)");
    $stmt->execute([$title, $user_id]);

    header("Location: index.php");
}
?>

<h2>Create a New Thread</h2>
<form method="POST" action="create_thread.php">
    <input type="text" name="title" placeholder="Thread Title" required>
    <button type="submit">Create Thread</button>
</form>

<?php include 'templates/footer.php'; ?>

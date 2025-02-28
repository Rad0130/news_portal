<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: signup.html");
    exit;
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch saved articles
$saved_sql = "SELECT a.* FROM saved_articles sa JOIN articles a ON sa.article_id = a.id WHERE sa.user_id = {$user['id']}";
$saved_result = $conn->query($saved_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo $user['first_name']; ?>!</h1>
        <p>Email: <?php echo $user['email']; ?></p>
        <h2>Saved Articles</h2>
        <ul>
            <?php while ($article = $saved_result->fetch_assoc()): ?>
                <li>
                    <a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
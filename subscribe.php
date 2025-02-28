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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "INSERT INTO subscriptions (user_id, status) VALUES ({$user['id']}, 'active')";
    $conn->query($sql);
    echo "Subscription activated!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
</head>
<body>
    <h1>Subscribe for Ad-Free Access</h1>
    <form method="POST">
        <button type="submit">Subscribe Now</button>
    </form>
</body>
</html>
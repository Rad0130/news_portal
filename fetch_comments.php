<?php
include 'connect.php';

$article_id = $_GET['article_id'];
$sql = "SELECT c.*, u.first_name AS user_name FROM comments c JOIN users u ON c.user_id = u.id WHERE c.article_id = $article_id ORDER BY c.created_at DESC";
$result = $conn->query($sql);

$comments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
}

echo json_encode($comments);
?>
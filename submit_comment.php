<?php
include 'connect.php';

$data = json_decode(file_get_contents('php://input'), true);
$article_id = $data['article_id'];
$user_id = 1; // Replace with the logged-in user's ID
$comment = $data['comment'];

$sql = "INSERT INTO comments (article_id, user_id, comment) VALUES ($article_id, $user_id, '$comment')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}
?>
<?php
include 'connect.php';

header('Content-Type: application/json');

$sql = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $conn->query($sql);

$articles = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $articles[] = $row;
    }
}

echo json_encode($articles);
?>
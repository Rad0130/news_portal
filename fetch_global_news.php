<?php
$api_key = 'YOUR_NEWSAPI_KEY';
$endpoint = "https://newsapi.org/v2/top-headlines?country=us&apiKey=$api_key";

$response = file_get_contents($endpoint);
$news = json_decode($response, true);

header('Content-Type: application/json');
echo json_encode($news['articles']);
?>
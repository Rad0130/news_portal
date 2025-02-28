<?php
include 'connect.php';

$article_id = $_GET['id'];
$sql = "SELECT * FROM articles WHERE id = $article_id";
$result = $conn->query($sql);
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['title']; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="article-container">
        <h1><?php echo $article['title']; ?></h1>
        <p>By <?php echo $article['author']; ?> | <?php echo $article['created_at']; ?></p>
        <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>">
        <p><?php echo $article['content']; ?></p>
    </div>

    <!-- Comments Section -->
    <section class="comments">
        <h2>Comments</h2>
        <div id="comments-container">
            <!-- Comments will be dynamically loaded here -->
        </div>
        <textarea id="comment-input" placeholder="Write your comment here..."></textarea>
        <button onclick="submitComment(<?php echo $article_id; ?>)">Submit Comment</button>
    </section>

    <script>
        // Fetch comments for the article
        fetch(`fetch_comments.php?article_id=<?php echo $article_id; ?>`)
            .then(response => response.json())
            .then(data => {
                const commentsContainer = document.getElementById('comments-container');
                data.forEach(comment => {
                    const commentDiv = document.createElement('div');
                    commentDiv.classList.add('comment-item');
                    commentDiv.innerHTML = `
                        <p><strong>${comment.user_name}:</strong> ${comment.comment}</p>
                        <button onclick="upvoteComment(${comment.id})">Upvote (${comment.upvotes})</button>
                        <button onclick="downvoteComment(${comment.id})">Downvote (${comment.downvotes})</button>
                    `;
                    commentsContainer.appendChild(commentDiv);
                });
            })
            .catch(error => console.error('Error fetching comments:', error));

        // Submit a new comment
        function submitComment(articleId) {
            const commentInput = document.getElementById('comment-input');
            const comment = commentInput.value;

            fetch('submit_comment.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ article_id: articleId, comment })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload the page to show the new comment
                } else {
                    alert('Error submitting comment');
                }
            });
        }
    </script>
</body>
</html>
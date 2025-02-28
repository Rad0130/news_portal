<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll_id = $_POST['poll_id'];
    $option = $_POST['option'];

    // Fetch the poll
    $sql = "SELECT * FROM polls WHERE id = $poll_id";
    $result = $conn->query($sql);
    $poll = $result->fetch_assoc();

    // Update votes
    $votes = json_decode($poll['votes'], true);
    $votes[$option] += 1;

    $updated_votes = json_encode($votes);
    $update_sql = "UPDATE polls SET votes = '$updated_votes' WHERE id = $poll_id";
    $conn->query($update_sql);

    echo "Vote submitted successfully!";
    exit;
}

// Fetch the latest poll
$sql = "SELECT * FROM polls ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$poll = $result->fetch_assoc();
$options = json_decode($poll['options'], true);
$votes = json_decode($poll['votes'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polls</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="poll-container">
        <h1><?php echo $poll['question']; ?></h1>
        <form method="POST" action="polls.php">
            <?php foreach ($options as $key => $option): ?>
                <label>
                    <input type="radio" name="option" value="<?php echo $key; ?>" required>
                    <?php echo $option; ?>
                </label><br>
            <?php endforeach; ?>
            <input type="hidden" name="poll_id" value="<?php echo $poll['id']; ?>">
            <button type="submit">Vote</button>
        </form>
        <h2>Results:</h2>
        <ul>
            <?php foreach ($votes as $key => $vote_count): ?>
                <li><?php echo $options[$key]; ?>: <?php echo $vote_count; ?> votes</li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: signup.html");
    exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($query);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="July Chronicles - Your Gateway to Authentic News and Community Voices">
    <title>July Chronicles</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS -->
</head>
<body>
    <!-- Header -->
        <header>
        <h1>Welcome, <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>!</h1>
        <a href="logout.php"><button class="auth-button" onclick="window.location.href='index.html'">Logout</button></a>

        <button class="dark-mode-toggle" onclick="toggleDarkMode()">Toggle Dark Mode</button>
        <div class="language-switcher">
            <button onclick="setLanguage('en')">English</button>
            <button onclick="setLanguage('bn')">বাংলা</button>
        </div>
        <h1>July Chronicles</h1>
        <p>Your Gateway to Authentic News and Community Voices</p>
    </header>

    <!-- Navigation -->
    <nav>
        <a href="#home">Home</a>
        <a href="#categories">Categories</a>
        <a href="#trending">Trending</a>
        <a href="#advice-box">Advice Box</a>
        <a href="#about">About</a>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <section id="latest-news" class="latest-news">
            <h2>Latest News</h2>
            <div id="news-container" class="news-container">
                <!-- Articles will be dynamically loaded here -->
            </div>
        </section>
        <!-- Hero Section -->
        <section class="hero">
            <div>
                <h2>Breaking News</h2>
                <img class="brk" src="b.png" alt="Breaking News">
                <p>Stay updated with the latest news from Bangladesh and around the world.</p>
                <a href="#" class="btn">Read More</a>
            </div>

        </section>

        <section id="july-quota-reform" class="quota-reform-section">
            <div class="container">
                <!-- Title -->
                <h1 class="section-title">July Quota Reform Movement of Bangladesh</h1>
        
                <!-- Main Content -->
                <div class="content">
                    <div class="gallery">

                        <img src="jul5.jpg" alt="Quota Reform Protest 5">
                        <img src="jul1.jpg" alt="Quota Reform Protest 1">
                        <img src="jul2.jfif" alt="Quota Reform Protest 2">
                        <img src="jul3.jpg" alt="Quota Reform Protest 3">
                        <img src="jul4.webp" alt="Quota Reform Protest 4">
                    </div>
                    <!-- Left Column: Text -->
                    <div class="text-content">
                        <p class="section-description">
                            The Quota Reform Movement of Bangladesh was a significant student-led protest that took place in July 2018. 
                            The movement aimed to reform the government job quota system, which reserved 56% of government jobs for specific groups, 
                            leaving only 44% for the general population. Students and job seekers across the country demanded a fairer system, 
                            arguing that the existing quota system was outdated and discriminatory.
                        </p>
        
                        <h2>Causes of the Movement</h2>
                        <ul class="causes-list">
                            <li>The government job quota system reserved 56% of jobs for specific groups, including freedom fighters' families, women, and minorities.</li>
                            <li>Only 44% of jobs were open to the general population, creating frustration among students and job seekers.</li>
                            <li>Many argued that the quota system was outdated and did not reflect the current socio-economic realities of Bangladesh.</li>
                        </ul>
        
                        <h2>Effects of the Movement</h2>
                        <ul class="effects-list">
                            <li>The government announced the abolition of the quota system for government jobs in response to the protests.</li>
                            <li>The movement highlighted the power of student activism in Bangladesh.</li>
                            <li>It sparked a national conversation about fairness, equality, and meritocracy in public sector recruitment.</li>
                        </ul>
                    </div>
        
                    
                </div>
            </div>
        </section>

        <!-- Categories Section -->
       <!-- Categories Section -->
        <section class="categories" id="categories">
            <h2>News Categories</h2>
            <div class="news-item">
                <img src="sp.jpg" alt="Sports News" class="category-image">
                <h3>Sports</h3>
                <p>Catch up on the latest sports news and events.</p>
                <a href="https://www.tsports.com/" class="btn">Explore</a>
            </div>
            <div class="news-item">
                <img src="p.jpg" alt="Political News" class="category-image">
                <h3>Politics</h3>
                <p>Latest updates on political events and decisions in Bangladesh.</p>
                <a href="https://www.politico.com/" class="btn">Explore</a>
            </div>
            <div class="news-item">
                <img src="cu.webp" alt="Cultural News" class="category-image">
                <h3>Culture</h3>
                <p>Discover the rich cultural heritage of Bangladesh.</p>
                <a href="https://www.bbc.com/culture" class="btn">Explore</a>
            </div>
        </section>
        <!-- Trending News Section -->
        <section class="trending" id="trending">
            <h2>Trending News</h2>
            <div class="trending-item">
                <h3>Headline 1</h3>
                <p>Short description of the trending news.</p>
                <a href="#" class="btn">Read More</a>
            </div>
            <div class="trending-item">
                <h3>Headline 2</h3>
                <p>Short description of the trending news.</p>
                <a href="#" class="btn">Read More</a>
            </div>
        </section>

        <!-- Comments Section -->
        <section class="comments" id="comments">
            <h2>Community Comments</h2>
            <div id="comments-container">
                <!-- Comments will be dynamically loaded here -->
            </div>
            <textarea id="comment-input" placeholder="Write your comment here..." rows="4" style="width: 100%;"></textarea>
            <button class="btn" onclick="submitComment(1)">Submit Comment</button> <!-- Replace 1 with the article ID -->
        </section>

        <!-- Advice Box Section -->
        <section class="advice-box" id="advice-box">
            <h2>Advice Box</h2>
            <p>Have advice or suggestions? Share them with us!</p>
            <textarea id="advice-input" placeholder="Write your advice here..." rows="4" style="width: 100%;"></textarea>
            <button class="btn" onclick="submitAdvice()">Submit Advice</button>
        </section>
    </div>

    <section id="global-news">
        <h2>Global News</h2>
        <div id="global-news-container"></div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 July Chronicles. All rights reserved.</p>
    </footer>
    <script>
        // Fetch articles from the backend
        fetch('fetch_articles.php')
            .then(response => response.json())
            .then(data => {
                const newsContainer = document.getElementById('news-container');
                data.forEach(article => {
                    const articleDiv = document.createElement('div');
                    articleDiv.classList.add('news-item');
                    articleDiv.innerHTML = `
                        <img src="${article.image}" alt="${article.title}">
                        <h3>${article.title}</h3>
                        <p>${article.content.substring(0, 150)}...</p>
                        <a href="article.php?id=${article.id}" class="btn">Read More</a>
                    `;
                    newsContainer.appendChild(articleDiv);
                });
            })
            .catch(error => console.error('Error fetching articles:', error));

            function setLanguage(lang) {
        document.cookie = `language=${lang}; path=/`;
        location.reload();
    }

    // Apply language
    const lang = document.cookie.split('; ').find(row => row.startsWith('language=')).split('=')[1];
    if (lang === 'bn') {
        document.body.innerHTML = document.body.innerHTML.replace(/English Text/g, 'বাংলা টেক্সট');
    }
    </script>
    
    <script>
        fetch('fetch_global_news.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('global-news-container');
                data.forEach(article => {
                    const articleDiv = document.createElement('div');
                    articleDiv.classList.add('news-item');
                    articleDiv.innerHTML = `
                        <h3>${article.title}</h3>
                        <p>${article.description}</p>
                        <a href="${article.url}" target="_blank">Read More</a>
                    `;
                    container.appendChild(articleDiv);
                });
            });

            function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const isDarkMode = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
    }

    // Apply dark mode on page load
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
    </script>
    <script>
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
            alert(data.message);
            location.reload(); // Reload the page to show the new comment
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error submitting comment:', error));
}
    </script>
    <script>
        function submitAdvice() {
    const adviceInput = document.getElementById('advice-input');
    const advice = adviceInput.value;

    fetch('submit_advice.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ advice })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            adviceInput.value = ''; // Clear the input field
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error submitting advice:', error));
}
    </script>
</body>
</html>

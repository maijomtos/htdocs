<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWU Information Study | Home</title>
    <!-- SEO Best Practices -->
    <meta name="description" content="Welcome to the SWU Information Study platform. Access resources, courses, and connect with the academic community.">
    <!-- Local CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <nav class="navbar" id="main-nav">
        <a href="index.php" class="logo" id="nav-logo">SWU InfoStudy</a>
        <div class="nav-links">
            <a href="#" id="nav-courses">Courses</a>
            <a href="#" id="nav-about">About</a>
            <a href="#" id="nav-contact">Contact</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn-login" id="nav-logout">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
            <?php else: ?>
                <a href="login.php" class="btn-login" id="nav-login">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <main class="container">
        <section class="hero" id="hero-section">
            <div class="hero-text animate-fade-in" id="hero-text-content">
                <h1>Future of Information Study Begins Here.</h1>
                <p>
                    Empowering students at Srinakharinwirot University with modern tools, 
                    comprehensive resources, and cutting-edge learning environments.
                </p>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="#" class="cta-button" id="cta-dashboard">Go to Dashboard</a>
                <?php else: ?>
                    <a href="login.php" class="cta-button" id="cta-get-started">Get Started</a>
                <?php endif; ?>
            </div>
            
            <div class="hero-visual animate-fade-in delay-1" id="hero-visual-graphic">
                <div class="glass-card" style="text-align: center; border-radius: 50%; width: 400px; height: 400px; display: flex; align-items: center; justify-content: center;">
                    <div>
                        <h2 style="font-size: 3rem; background: linear-gradient(90deg, #D32F2F, #ff7e7e); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">SWU</h2>
                        <p style="color: var(--text-muted); margin-top: 10px; font-weight: 500;">Excellence in Education</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

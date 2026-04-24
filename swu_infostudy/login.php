<?php
session_start();
require_once 'db_connect.php';

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    
    if (empty($username) || empty($password)) {
        $errorMsg = "Please enter both username and password.";
    } else {
        // Query to fetch user
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $db_username, $db_password, $role);
                $stmt->fetch();
                
                // Verify password against standard BCRYPT hash
                if (password_verify($password, $db_password)) {
                    // Password is correct, start session
                    session_regenerate_id();
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['role'] = $role;
                    
                    header("Location: index.php");
                    exit();
                } else {
                    $errorMsg = "Invalid username or password.";
                }
            } else {
                $errorMsg = "Invalid username or password.";
            }
            $stmt->close();
        } else {
            $errorMsg = "Oops! Something went wrong. Please try again later.";
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SWU Information Study</title>
    <!-- SEO Best Practices -->
    <meta name="description" content="Sign in to the SWU Information Study portal.">
    <!-- Local CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="blob-1"></div>
    <div class="blob-2"></div>

    <nav class="navbar" id="login-nav">
        <a href="index.php" class="logo" id="nav-logo-login">SWU InfoStudy</a>
        <div class="nav-links">
            <a href="index.php" id="nav-home">Home</a>
        </div>
    </nav>

    <main class="container">
        <div class="glass-card animate-fade-in" id="login-card">
            <div class="login-header" id="login-header-group">
                <h2>Welcome Back</h2>
                <p>Please sign in to your account</p>
            </div>

            <?php if(!empty($errorMsg)): ?>
                <div class="error-msg" id="login-error-msg">
                    <?php echo htmlspecialchars($errorMsg); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="login-form">
                <div class="form-group" id="form-group-username">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" required autocomplete="username" autofocus>
                </div>
                
                <div class="form-group" id="form-group-password">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
                </div>
                
                <button type="submit" class="btn-submit" id="btn-submit-login">Sign In</button>
            </form>
            
            <div style="text-align: center; margin-top: 1.5rem; font-size: 0.85rem; color: var(--text-muted);" id="login-demo-credentials">
                Demo Accounts:<br>
                <strong>admin</strong> / password123<br>
                <strong>student</strong> / swu123
            </div>
        </div>
    </main>
</body>
</html>

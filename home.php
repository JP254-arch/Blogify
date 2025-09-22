<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Show banner if reader is logged in
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'reader') {
    $username = htmlspecialchars($_SESSION['user']['username']);
    echo "<div style='background: #f0f8ff; padding: 10px; margin-bottom: 15px; border-radius: 5px;'>
            👋 Welcome back, <strong>{$username}</strong>! You’re logged in as a <em>Reader</em>.
            <a href='logout.php' style='margin-left:15px;'>Logout</a>
          </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Blogify</title>
</head>
<body>
  <header>
    <h1>Blogify</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </nav>
  </header>

  <main>
    <h2>Latest Blog Posts</h2>
    <p>Latest blog posts will appear here...</p>
    <!-- TODO: add post loop from database -->
  </main>
</body>
</html>

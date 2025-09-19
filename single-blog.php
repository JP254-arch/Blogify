<?php
require "config/db.php";

// Fetch post by ID with author
$post = null;
if (isset($_GET['id'])) {
  $stmt = $conn->prepare("
    SELECT posts.*, users.username 
    FROM posts 
    JOIN users ON posts.user_id = users.id 
    WHERE posts.id = ?
  ");
  $stmt->execute([$_GET['id']]);
  $post = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $post ? htmlspecialchars($post['title']) : 'Blog Not Found' ?> - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">

      <!-- Logo -->
      <a href="index.php" class="text-2xl font-bold text-blue-600">Blogify</a>

      <!-- Navigation -->
      <nav class="hidden md:flex space-x-6 mx-auto">
        <a href="index.php" class="hover:text-blue-600">Home</a>
        <a href="blogs.php" class="hover:text-blue-600">Blogs</a>
        <a href="about.php" class="hover:text-blue-600">About</a>
        <a href="contact.php" class="hover:text-blue-600">Contact</a>
      </nav>

      <!-- Auth Links -->
      <div class="hidden md:flex space-x-6">
        <a href="login.php" class="hover:text-blue-600">Login</a>
        <a href="register.php" class="hover:text-blue-600">Register</a>
      </div>

      <!-- Mobile Menu Button -->
      <button class="md:hidden text-gray-600">☰</button>
    </div>
  </header>

  <!-- Blog Article -->
  <main class="container mx-auto px-1 py-16 max-w-3xl">
    <?php if ($post): ?>
      <h1 class="text-4xl font-bold mb-4"><?= htmlspecialchars($post['title']) ?></h1>
      <p class="text-gray-500 mb-6 text-sm">
        By <span class="font-semibold"><?= htmlspecialchars($post['username']) ?></span>
        • <?= date("F j, Y", strtotime($post['created_at'])) ?>
      </p>

      <img src="<?= $post['image'] ?: 'https://source.unsplash.com/1000x500/?blog,writing' ?>"
        alt="Blog Image"
        class="rounded-2xl shadow mb-6 w-full h-auto object-cover">

      <div class="prose max-w-none text-gray-700 text-lg leading-relaxed mb-10">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
      </div>

      <!-- Back to Blogs Button -->
      <div class="text-center">
        <a href="blogs.php"
          class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
          ← Back to Blogs
        </a>
      </div>

    <?php else: ?>
      <p class="text-center text-red-500 text-xl">Blog not found!</p>
    <?php endif; ?>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
    <div class="container mx-auto text-center">
      <p>&copy; <?= date("Y"); ?> Blogify. All rights reserved.</p>
    </div>
  </footer>

</body>

</html>
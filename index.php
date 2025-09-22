<?php
require "config/db.php";

// Fetch latest 3 posts
$stmt = $conn->query("
  SELECT posts.*, users.username 
  FROM posts 
  JOIN users ON posts.user_id = users.id 
  ORDER BY posts.created_at DESC 
  LIMIT 3
");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blogify - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <?php include "includes/navbar.php"; ?>

  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-blue-400 to-indigo-900 text-white py-20">
    <div class="container mx-auto text-center px-6">
      <h2 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Blogify</h2>
      <p class="text-lg md:text-xl mb-6">Discover stories, ideas, and inspiration from writers around the world.</p>
      <a href="blogs.php"
        class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-300">
        Explore Blogs
      </a>
    </div>
  </section>

  <!-- Featured Blogs -->
  <section class="py-16 container mx-auto px-6">
    <h3 class="text-3xl font-bold text-center mb-12">Latest Articles</h3>
    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ($posts as $post): ?>
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
          <img src="<?= $post['image'] ?: 'https://source.unsplash.com/800x400/?blog,writing' ?>"
            alt="Blog"
            class="w-full h-48 object-cover">
          <div class="p-6">
            <h4 class="font-bold text-xl mb-2"><?= htmlspecialchars($post['title']) ?></h4>
            <p class="text-gray-600 mb-4">
              <?= substr(htmlspecialchars($post['content']), 0, 80) ?>...
            </p>
            <a href="single-blog.php?id=<?= $post['id'] ?>"
              class="text-blue-600 font-semibold hover:underline">
              Read More →
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
    <div class="container mx-auto text-center">
      <p>&copy; <?= date("Y"); ?> Blogify. All rights reserved.</p>
    </div>
  </footer>

</body>

</html>
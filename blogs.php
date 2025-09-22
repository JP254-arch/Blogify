<?php 
require "config/db.php";   // Database connection

// Fetch all posts (latest first)
try {
  $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Error fetching posts: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blogify - Blogs</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <?php include "includes/navbar.php"; ?>

  <!-- Blogs Section -->
  <section class="py-16 container mx-auto px-6">
    <h3 class="text-3xl font-bold text-center mb-12">All Blog Posts</h3>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php if ($posts): ?>
        <?php foreach ($posts as $post): ?>
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
            <?php 
              
              $image = !empty($post['image']) 
                  ? htmlspecialchars($post['image']) 
                  : "https://source.unsplash.com/600x400/?blog";
            ?>
            <img src="<?= $image ?>" 
                 alt="<?= htmlspecialchars($post['title']) ?>"
                 class="w-full h-48 object-cover">

            <div class="p-6">
              <h4 class="font-bold text-xl mb-2"><?= htmlspecialchars($post['title']) ?></h4>
              <p class="text-gray-600 mb-4">
                <?= substr(htmlspecialchars($post['content']), 0, 120) ?>...
              </p>
              <a href="single-blog.php?id=<?= $post['id'] ?>" class="text-blue-600 font-semibold hover:underline">
                Read More →
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-center text-gray-500 col-span-3">No blog posts found.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
    <div class="container mx-auto text-center">
      <p>&copy; <?php echo date("Y"); ?> Blogify. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>

<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_role('author');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Author Dashboard - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <?php include __DIR__ . '/../includes/header.php'; ?>

  <main class="container mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-4">Welcome, Author <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p class="mb-6">This is your dashboard. You can create and manage your blog posts.</p>

    <div class="space-x-4">
      <a href="../posts/create.php" class="bg-green-600 text-white px-4 py-2 rounded">Create Post</a>
      <a href="<?= BASE_URL ?>blogs.php" class="bg-blue-600 text-white px-4 py-2 rounded">Posts</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>posts/dashboard.php" class="bg-yellow-600 text-white px-4 py-2 rounded">Manage Blogs</a>
      <?php endif; ?>
    </div>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
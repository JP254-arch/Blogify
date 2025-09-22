<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_role('reader');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Reader Dashboard - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <?php include __DIR__ . '/../includes/header.php'; ?>

  <main class="container mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-4">Welcome, Reader <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p class="mb-6">This is your dashboard. Browse and enjoy blog posts.</p>

    <div class="space-x-4">
      <a href="<?= BASE_URL ?>blogs.php" class="bg-blue-600 text-white px-4 py-2 rounded">View Posts</a>
    </div>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>

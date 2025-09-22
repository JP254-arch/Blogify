<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/auth_check.php';
require_role('admin');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Admin Dashboard - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
  <?php include __DIR__ . '/../includes/header.php'; ?>

  <main class="container mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-4">Welcome, Admin <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p class="mb-6">This is your dashboard. You can manage users and oversee the platform.</p>

    <div class="space-x-4">
      <a href="<?= BASE_URL ?>admin/manage_users.php" class="bg-blue-600 text-white px-4 py-2 rounded">Manage Users</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>posts/dashboard.php" class="bg-yellow-600 text-white px-4 py-2 rounded">Manage Blogs</a>
      <?php endif; ?>
    </div>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>

</html>
<?php
require_once __DIR__ . "/../config/config.php";
?>
<header class="bg-white shadow">
  <div class="container mx-auto flex items-center justify-between py-4 px-6">

    <!-- Logo -->
    <a href="<?= BASE_URL ?>index.php" class="text-2xl font-bold text-blue-600">Blogify</a>

    <!-- Center Navigation -->
    <nav class="hidden md:flex space-x-6 mx-auto">
      <a href="<?= BASE_URL ?>index.php" class="hover:text-blue-600">Home</a>
      <a href="<?= BASE_URL ?>blogs.php" class="hover:text-blue-600">Blogs</a>
      <a href="<?= BASE_URL ?>about.php" class="hover:text-blue-600">About</a>
      <a href="<?= BASE_URL ?>contact.php" class="hover:text-blue-600">Contact</a>

      <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Profile tab visible only when logged in -->
        <a href="<?= BASE_URL ?>posts/dashboard.php" class="hover:text-blue-600">Profile</a>
      <?php endif; ?>
    </nav>

    <!-- Right Side -->
    <div class="hidden md:flex space-x-6">
      <?php if (isset($_SESSION['user_id'])): ?>
        <!-- When logged in -->
        <span class="text-gray-700">
          Hi <?= htmlspecialchars($_SESSION['username']); ?> 👋
        </span>
        <a href="<?= BASE_URL ?>auth/logout.php" class="hover:text-red-600">Logout</a>
      <?php else: ?>
        <!-- When not logged in -->
        <a href="<?= BASE_URL ?>auth/login.php" class="hover:text-blue-600">Login</a>
        <a href="<?= BASE_URL ?>auth/register.php" class="hover:text-blue-600">Register</a>
      <?php endif; ?>
    </div>

    <!-- Mobile Menu Button -->
    <button class="md:hidden text-gray-600">☰</button>
  </div>
</header>

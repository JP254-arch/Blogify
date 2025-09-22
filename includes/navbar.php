<?php
require_once __DIR__ . "/../config/config.php";

$profileLink = null;
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        $profileLink = BASE_URL . "admin/dashboard.php";
    } elseif ($_SESSION['role'] === 'author') {
        $profileLink = BASE_URL . "author/dashboard.php";
    } elseif ($_SESSION['role'] === 'reader') {
        $profileLink = BASE_URL . "reader/dashboard.php";
    }
}
?>
<header class="bg-white shadow">
  <div class="container mx-auto flex items-center justify-between py-4 px-6">

    <!-- Logo -->
    <a href="<?= BASE_URL ?>index.php" class="text-2xl font-bold text-blue-600">Blogify</a>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex space-x-6 mx-auto">
      <a href="<?= BASE_URL ?>index.php" class="hover:text-blue-600">Home</a>
      <a href="<?= BASE_URL ?>blogs.php" class="hover:text-blue-600">Blogs</a>
      <a href="<?= BASE_URL ?>about.php" class="hover:text-blue-600">About</a>
      <a href="<?= BASE_URL ?>contact.php" class="hover:text-blue-600">Contact</a>

      <?php if ($profileLink): ?>
        <a href="<?= $profileLink ?>" class="hover:text-blue-600">Profile</a>
      <?php endif; ?>
    </nav>

    <!-- Desktop Right Side -->
    <div class="hidden md:flex space-x-6">
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="text-gray-700">Hi <?= htmlspecialchars($_SESSION['username']); ?> 👋 </span> |
        <a href="<?= BASE_URL ?>auth/logout.php" class="hover:text-red-600">Logout</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>auth/login.php" class="hover:text-blue-600">Login</a>
        <a href="<?= BASE_URL ?>auth/register.php" class="hover:text-blue-600">Register</a>
      <?php endif; ?>
    </div>

    <!-- Mobile Menu Button -->
    <button id="menu-btn" class="md:hidden text-gray-600 text-2xl focus:outline-none">☰</button>
  </div>

  <!-- Mobile Dropdown -->
  <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
    <nav class="flex flex-col space-y-4 py-4 px-6">
      <a href="<?= BASE_URL ?>index.php" class="hover:text-blue-600">Home</a>
      <a href="<?= BASE_URL ?>blogs.php" class="hover:text-blue-600">Blogs</a>
      <a href="<?= BASE_URL ?>about.php" class="hover:text-blue-600">About</a>
      <a href="<?= BASE_URL ?>contact.php" class="hover:text-blue-600">Contact</a>

      <?php if ($profileLink): ?>
        <a href="<?= $profileLink ?>" class="hover:text-blue-600">Profile</a>
        <a href="<?= BASE_URL ?>auth/logout.php" class="hover:text-red-600">Logout</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>auth/login.php" class="hover:text-blue-600">Login</a>
        <a href="<?= BASE_URL ?>auth/register.php" class="hover:text-blue-600">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<script>
  // Toggle mobile menu
  document.getElementById('menu-btn').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });
</script>

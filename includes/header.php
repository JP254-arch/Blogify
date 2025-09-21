<?php
require_once __DIR__ . "/../config/config.php";
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

      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>posts/dashboard.php" class="hover:text-blue-600">Profile</a>
      <?php endif; ?>
    </nav>

    <!-- Desktop Right Side -->
    <div class="hidden md:flex space-x-6">
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="text-gray-700">Hi <?= htmlspecialchars($_SESSION['username']); ?> 👋</span>
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
  <div id="mobile-menu" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out md:hidden bg-white border-t">
    <nav class="flex flex-col space-y-4 py-4 px-6">
      <a href="<?= BASE_URL ?>index.php" class="hover:text-blue-600">Home</a>
      <a href="<?= BASE_URL ?>blogs.php" class="hover:text-blue-600">Blogs</a>
      <a href="<?= BASE_URL ?>about.php" class="hover:text-blue-600">About</a>
      <a href="<?= BASE_URL ?>contact.php" class="hover:text-blue-600">Contact</a>

      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>posts/dashboard.php" class="hover:text-blue-600">Profile</a>
        <a href="<?= BASE_URL ?>auth/logout.php" class="hover:text-red-600">Logout</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>auth/login.php" class="hover:text-blue-600">Login</a>
        <a href="<?= BASE_URL ?>auth/register.php" class="hover:text-blue-600">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<script>
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  menuBtn.addEventListener('click', () => {
    if (mobileMenu.classList.contains('max-h-0')) {
      mobileMenu.classList.remove('max-h-0');
      mobileMenu.classList.add('max-h-screen');
    } else {
      mobileMenu.classList.remove('max-h-screen');
      mobileMenu.classList.add('max-h-0');
    }
  });
</script>

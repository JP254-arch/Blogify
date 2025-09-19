<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">

        <!-- Logo -->
        <a href="index.php" class="text-2xl font-bold text-blue-600">Blogify</a>

        <!-- Center Navigation -->
        <nav class="hidden md:flex space-x-6 mx-auto">
            <a href="index.php" class="hover:text-blue-600">Home</a>
            <a href="blogs.php" class="hover:text-blue-600">Blogs</a>
            <a href="about.php" class="hover:text-blue-600">About</a>
            <a href="contact.php" class="hover:text-blue-600">Contact</a>
        </nav>

        <!-- Right Side Auth Links -->
        <div class="hidden md:flex space-x-6 items-center">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="text-gray-700">Hi, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="hover:text-red-600">Logout</a>
            <?php else: ?>
                <a href="login.php" class="hover:text-blue-600">Login</a>
                <a href="register.php" class="hover:text-blue-600">Register</a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-gray-600">☰</button>
    </div>
</header>

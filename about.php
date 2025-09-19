<?php
// about.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogify - About</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
   <?php include "includes/navbar.php"; ?>


    <!-- About Section -->
    <section class="container mx-auto px-6 py-16 max-w-3xl">
        <h2 class="text-3xl font-bold mb-6">About Blogify</h2>
        <p class="text-lg leading-relaxed mb-4">
            Blogify is a platform built for writers, creators, and readers who want to share ideas and connect with the world.
            Our mission is to give everyone a voice and inspire through storytelling.
        </p>
        <p class="text-lg leading-relaxed">
            Whether you’re a seasoned writer or just starting, Blogify is your space to grow, learn, and inspire others.
        </p>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date("Y"); ?> Blogify. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
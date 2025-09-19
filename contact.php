
<?php
// contact.php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $msg = trim($_POST["message"] ?? "");

    if ($name && $email && $msg) {
        // Here you could send email or store in DB.
        // For now, just simulate success.
        $message = "Thank you, $name! Your message has been received.";
    } else {
        $message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogify - Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Navbar -->
    <?php include "includes/navbar.php"; ?>


    <!-- Contact Form -->
    <section class="container mx-auto px-6 py-16 max-w-3xl">
        <h2 class="text-3xl font-bold mb-6">Contact Us</h2>

        <?php if ($message): ?>
            <p class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form action="https://formspree.io/f/xjkenyqy" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
            <input type="text" name="name" placeholder="Your Name" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required>
            <input type="email" name="email" placeholder="Your Email" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required>
            <textarea name="message" rows="5" placeholder="Your Message" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300" required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700">
                Send Message
            </button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date("Y"); ?> Blogify. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
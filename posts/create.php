<?php
require "../config/db.php";
require "../includes/auth_check.php"; // this should start the session & block guests
include "../includes/navbar.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image = $_POST['image'] ?? null;

    if ($title && $content) {
        // ✅ Insert with user_id
        $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $content, $image]);
        header("Location: dashboard.php?success=created");
        exit;
    } else {
        $error = "Title and content are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Post - Blogify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Header -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-16 mb-10">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-4xl md:text-5xl font-bold">✍️ Create New Post</h2>
            <p class="text-lg mt-2">Share your thoughts with the world</p>
        </div>
    </section>

    <!-- Form -->
    <section class="container mx-auto px-6 pb-16 max-w-2xl">
        <div class="bg-white shadow-lg rounded-2xl p-8">
            <h3 class="text-2xl font-bold mb-6 text-gray-800">Post Details</h3>

            <?php if (!empty($error)): ?>
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Title</label>
                    <input type="text" name="title" placeholder="Post Title"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Content</label>
                    <textarea name="content" placeholder="Write your blog post..." rows="6"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div>
                    <label class="block mb-2 font-semibold text-gray-700">Image URL</label>
                    <input type="text" name="image" placeholder="https://example.com/image.jpg"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Optional</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
                        Publish Post
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <?php include "../includes/footer.php"; ?>

</body>
</html>

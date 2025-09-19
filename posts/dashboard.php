<?php
require "../config/db.php";
require "../includes/auth_check.php";
include "../includes/navbar.php";

$stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blogify - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Dashboard Header -->
    <section class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-16">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">📊 Dashboard</h2>
            <p class="text-lg md:text-xl">Manage your blog posts with ease</p>
            <div class="mt-6">
                <a href="create.php"
                    class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg shadow hover:bg-gray-100">
                    + New Post
                </a>
            </div>
        </div>
    </section>

    <!-- Posts Table -->
    <section class="py-16 container mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-4 px-6 text-left">Title</th>
                        <th class="py-4 px-6 text-center">Date</th>
                        <th class="py-4 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($posts): ?>
                        <?php foreach ($posts as $post): ?>
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="py-4 px-6 font-medium text-gray-800">
                                    <?= htmlspecialchars($post['title']) ?>
                                </td>
                                <td class="py-4 px-6 text-center text-gray-600">
                                    <?= date("M j, Y", strtotime($post['created_at'])) ?>
                                </td>
                                <td class="py-4 px-6 text-center space-x-3">
                                    <a href="view.php?id=<?= $post['id'] ?>"
                                        class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-lg hover:bg-blue-200">
                                        View
                                    </a>
                                    <a href="edit.php?id=<?= $post['id'] ?>"
                                        class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-lg hover:bg-green-200">
                                        Edit
                                    </a>
                                    <a href="delete.php?id=<?= $post['id'] ?>"
                                        onclick="return confirm('Are you sure you want to delete this post?')"
                                        class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-lg hover:bg-red-200">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="py-6 px-6 text-center text-gray-500">
                                No posts yet. <a href="create.php" class="text-blue-600 underline">Create one now</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; <?= date("Y"); ?> Blogify. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
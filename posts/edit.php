<?php
require "../config/db.php";
require "../includes/auth_check.php";
include "../includes/navbar.php";

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid ID");
}

$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image = $_POST['image'] ?? null;

    $stmt = $conn->prepare("UPDATE posts SET title=?, content=?, image=? WHERE id=?");
    $stmt->execute([$title, $content, $image, $id]);
    header("Location: dashboard.php?success=updated");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Post - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <!-- Header -->
  <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-16 mb-10">
    <div class="container mx-auto text-center px-6">
      <h2 class="text-4xl md:text-5xl font-bold">📝 Edit Post</h2>
      <p class="text-lg mt-2">Update your content and keep it fresh</p>
    </div>
  </section>

  <!-- Form -->
  <section class="container mx-auto px-6 pb-16 max-w-2xl">
    <div class="bg-white shadow-lg rounded-2xl p-8">
      <h3 class="text-2xl font-bold mb-6 text-gray-800">Post Details</h3>

      <form method="POST" class="space-y-6">
        <div>
          <label class="block mb-2 font-semibold text-gray-700">Title</label>
          <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required>
        </div>

        <div>
          <label class="block mb-2 font-semibold text-gray-700">Content</label>
          <textarea name="content" rows="6"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
            required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <div>
          <label class="block mb-2 font-semibold text-gray-700">Image URL</label>
          <input type="text" name="image" value="<?= htmlspecialchars($post['image']) ?>"
            class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <p class="text-sm text-gray-500 mt-1">Optional</p>
        </div>

        <div class="flex justify-end">
          <button type="submit"
            class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-indigo-700 transition">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </section>

  <?php include "../includes/footer.php"; ?>
</body>
</html>

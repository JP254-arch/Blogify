<?php
require "../config/db.php";
include "../includes/navbar.php";

$id = $_GET['id'] ?? null;
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $post ? htmlspecialchars($post['title']) : "Post Not Found" ?> - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <?php if ($post): ?>
    <!-- Header -->
    <section class="bg-gradient-to-r from-purple-600 to-pink-500 text-white py-16 mb-10">
      <div class="container mx-auto text-center px-6">
        <h1 class="text-4xl md:text-5xl font-bold"><?= htmlspecialchars($post['title']) ?></h1>
        <p class="mt-3 text-lg text-gray-200">
          Published on <?= date("F j, Y", strtotime($post['created_at'])) ?>
        </p>
      </div>
    </section>

    <!-- Post Content -->
    <section class="container mx-auto px-6 pb-16 max-w-3xl">
      <?php if (!empty($post['image'])): ?>
        <img src="<?= htmlspecialchars($post['image']) ?>"
          alt="Blog Image"
          class="rounded-2xl shadow-lg mb-8 w-full h-auto object-cover">
      <?php else: ?>
        <img src="https://source.unsplash.com/1000x500/?blog"
          alt="Default Blog Image"
          class="rounded-2xl shadow-lg mb-8 w-full h-auto object-cover">
      <?php endif; ?>

      <article class="prose lg:prose-lg max-w-none">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
      </article>
    </section>

  <?php else: ?>
    <!-- Not Found -->
    <section class="container mx-auto px-6 py-16 max-w-2xl">
      <div class="bg-red-100 border border-red-300 text-red-700 px-6 py-8 rounded-2xl shadow text-center">
        <h2 class="text-2xl font-bold mb-2">❌ Post not found</h2>
        <p class="text-gray-600">The blog post you’re looking for does not exist or was removed.</p>
      </div>
    </section>
  <?php endif; ?>

  <?php include "../includes/footer.php"; ?>
</body>
</html>

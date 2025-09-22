<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/auth_check.php';
require_role('admin');

// Handle role update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['role'])) {
    $userId = (int) $_POST['user_id'];
    $role = $_POST['role'];

    $allowedRoles = ['admin', 'author', 'reader'];
    if (in_array($role, $allowedRoles)) {
        $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $userId]);
        $message = "Role updated successfully!";
    } else {
        $message = "Invalid role selected!";
    }
}

// Fetch all users
$stmt = $conn->query("SELECT id, username, email, role FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Manage Users - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <?php include __DIR__ . '/includes/header.php'; ?>

  <main class="container mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-6">Manage Users</h1>

    <?php if (!empty($message)): ?>
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>

    <table class="w-full bg-white shadow rounded">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-3">ID</th>
          <th class="p-3">Username</th>
          <th class="p-3">Email</th>
          <th class="p-3">Role</th>
          <th class="p-3">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr class="border-b">
            <td class="p-3"><?= $user['id'] ?></td>
            <td class="p-3"><?= htmlspecialchars($user['username']) ?></td>
            <td class="p-3"><?= htmlspecialchars($user['email']) ?></td>
            <td class="p-3"><?= htmlspecialchars($user['role']) ?></td>
            <td class="p-3">
              <form method="post" class="flex space-x-2">
                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                <select name="role" class="border rounded px-2 py-1">
                  <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                  <option value="author" <?= $user['role'] === 'author' ? 'selected' : '' ?>>Author</option>
                  <option value="reader" <?= $user['role'] === 'reader' ? 'selected' : '' ?>>Reader</option>
                </select>
                <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded">Update</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

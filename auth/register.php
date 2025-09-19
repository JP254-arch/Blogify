<?php
// auth/register.php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/config.php';

$message = '';

// POST handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Basic validation
    if ($username === '' || $email === '' || $password === '' || $password_confirm === '') {
        $message = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
    } elseif ($password !== $password_confirm) {
        $message = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $message = 'Password must be at least 6 characters.';
    } else {
        try {
            // Check duplicate email or username
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ? LIMIT 1");
            $stmt->execute([$email, $username]);

            if ($stmt->fetch()) {
                $message = 'Email or username already registered.';
            } else {
                // Insert user
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $insert->execute([$username, $email, $hash]);

                $_SESSION['flash'] = 'Registration successful. You can now log in.';
                header('Location: ' . BASE_URL . 'auth/login.php');
                exit;
            }
        } catch (PDOException $e) {
            $message = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Register - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <?php include __DIR__ . '/../includes/header.php'; ?>

  <section class="py-16 container mx-auto px-6 max-w-md">
    <h2 class="text-3xl font-bold mb-6 text-center">Register</h2>

    <?php if (!empty($message)): ?>
      <div class="bg-red-50 text-red-700 border border-red-200 p-3 rounded mb-4"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post" class="bg-white p-6 shadow-lg rounded-lg space-y-4" novalidate>
      <input type="text" name="username" placeholder="Username" required class="w-full border p-3 rounded" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
      <input type="email" name="email" placeholder="Email" required class="w-full border p-3 rounded" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      <input type="password" name="password" placeholder="Password" required class="w-full border p-3 rounded">
      <input type="password" name="password_confirm" placeholder="Confirm password" required class="w-full border p-3 rounded">
      <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">Register</button>
    </form>

    <p class="mt-4 text-center">
      Already have an account? 
      <a href="<?= BASE_URL ?>auth/login.php" class="text-blue-600 underline">Login here</a>.
    </p>
  </section>

  <?php include __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>

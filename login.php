<?php
// login.php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/config/db.php';

$message = '';

// If we have a flash message from registration, show it once
$flash = $_SESSION['flash'] ?? null;
if ($flash) {
    unset($_SESSION['flash']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $message = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Invalid email format.';
    } else {
        try {
            $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Successful login
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to dashboard instead of index
                header('Location: posts/dashboard.php');
                exit;
            } else {
                $message = 'Invalid email or password.';
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
  <title>Login - Blogify</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <?php include __DIR__ . '/includes/navbar.php'; ?>

  <section class="py-16 container mx-auto px-6 max-w-md">
    <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>

    <?php if ($flash): ?>
      <div class="bg-green-50 text-green-700 border border-green-200 p-3 rounded mb-4"><?= htmlspecialchars($flash) ?></div>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
      <div class="bg-red-50 text-red-700 border border-red-200 p-3 rounded mb-4"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post" class="bg-white p-6 shadow-lg rounded-lg space-y-4" novalidate>
      <input type="email" name="email" placeholder="Email" required 
             class="w-full border p-3 rounded"
             value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      <input type="password" name="password" placeholder="Password" required 
             class="w-full border p-3 rounded">
      <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
        Login
      </button>
    </form>

    <p class="mt-4 text-center">
      Don't have an account? 
      <a href="register.php" class="text-blue-600 underline">Register here</a>.
    </p>
  </section>

  <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

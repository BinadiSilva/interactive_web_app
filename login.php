<?php
session_start();

$message = "";
$message_type = "";

if (isset($_SESSION['login_message'])) {
    $message = $_SESSION['login_message'];
    $message_type = $_SESSION['login_message_type'];
    unset($_SESSION['login_message']);
    unset($_SESSION['login_message_type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login | RecipeBook</title>
<link rel="stylesheet" href="css/styles.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="auth-page">

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Add&Bake</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        <li class="nav-item ms-2"><a class="btn btn-outline-dark btn-sm" href="register.php">Register</a></li>
      </ul>
    </div>
  </div>
</nav>

<section class="container py-5">
  <div class="auth-card mx-auto">
    <h2 class="text-center mb-4">Login to Your Account</h2>

    <?php if (!empty($message)): ?>
      <div class="form-message mb-3 <?php echo $message_type === 'success' ? 'success-text' : 'error-text'; ?>">
        <?php echo $message; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="auth/login.php">
      <div class="mb-3">
        <label for="loginEmail" class="form-label">Email</label>
        <input type="email" id="loginEmail" name="email" class="form-control" placeholder="Enter your email" required />
      </div>

      <div class="mb-3">
        <label for="loginPassword" class="form-label">Password</label>
        <input type="password" id="loginPassword" name="password" class="form-control" placeholder="Enter your password" required />
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-dark">Login</button>
      </div>
    </form>

    <p class="text-center mt-4 mb-0">
      Don’t have an account?
      <a href="register.php">Create one</a>
    </p>
  </div>
</section>

<footer class="bg-dark text-white text-center p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();

$message = "";
$message_type = "";

if (isset($_SESSION['register_message'])) {
    $message = $_SESSION['register_message'];
    $message_type = $_SESSION['register_message_type'];
    unset($_SESSION['register_message']);
    unset($_SESSION['register_message_type']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Register | RecipeBook</title>
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
<h2 class="text-center mb-4">Create New Account</h2>

<?php if (!empty($message)): ?>
<div class="form-message mb-3 <?php echo $message_type === 'success' ? 'success-text' : 'error-text'; ?>">
<?php echo $message; ?>
</div>
<?php endif; ?>

<form method="POST" action="auth/register.php">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Address</label>
<textarea name="address" class="form-control" required></textarea>
</div>

<div class="mb-3">
<label class="form-label">Contact Number</label>
<input type="text" name="phone" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Profile Photo URL (Optional)</label>
<input type="text" name="photo" class="form-control">
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="d-grid">
<button type="submit" class="btn btn-dark">Register</button>
</div>

</form>

<p class="text-center mt-4">
Already have an account? <a href="login.php">Login</a>
</p>

</div>
</section>

<footer class="bg-dark text-white text-center mt-5 p-4">
<p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

</body>
</html>
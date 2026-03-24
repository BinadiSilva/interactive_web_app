<?php
include("includes/auth_check.php");
include("includes/db.php");

$name = $_SESSION['username'] ?? "";
$email = $_SESSION['email'] ?? "";
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $user_message = trim($_POST["message"] ?? "");

    if (empty($name) || empty($email) || empty($user_message)) {
        $message = "Please fill all fields.";
        $message_type = "error";
    } else {
        $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $user_message);

        if ($stmt->execute()) {
            $message = "Message submitted successfully.";
            $message_type = "success";
        } else {
            $message = "Failed to submit message.";
            $message_type = "error";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
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
        <li class="nav-item"><a class="nav-link" href="recipes.php">Browse Recipes</a></li>
        <li class="nav-item"><a class="nav-link" href="add_recipe.php">Add Recipe</a></li>
        <li class="nav-item"><a class="nav-link active" href="contact.php">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item ms-2"><a class="btn btn-danger btn-sm" href="auth/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<section class="container mt-5 text-center">
  <h2>Contact Us</h2>
  <hr />
</section>

<section class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="" class="site-form">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?php echo htmlspecialchars($name); ?>" required />
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required />
        </div>

        <div class="mb-4">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-control" rows="6" placeholder="Enter your message" required></textarea>
        </div>

        <?php if (!empty($message)): ?>
          <div class="form-message mb-3 <?php echo $message_type === 'success' ? 'success-text' : 'error-text'; ?>">
            <?php echo htmlspecialchars($message); ?>
          </div>
        <?php else: ?>
          <div class="form-message mb-3"></div>
        <?php endif; ?>

        <div class="text-center">
          <button type="submit" class="btn btn-primary px-5">Submit</button>
        </div>
      </form>
    </div>
  </div>
</section>

<footer class="bg-dark text-white text-center mt-5 p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
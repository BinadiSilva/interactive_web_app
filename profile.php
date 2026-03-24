<?php
include("includes/auth_check.php");
include("includes/db.php");

$user_id = $_SESSION['user_id'];
$message = "";
$message_type = "";

/* CHANGE PASSWORD */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["change_password"])) {
    $new_password = trim($_POST["newPassword"]);
    $confirm_password = trim($_POST["confirmPassword"]);

    if (empty($new_password) || empty($confirm_password)) {
        $message = "Please fill both password fields.";
        $message_type = "error";
    } elseif ($new_password !== $confirm_password) {
        $message = "Passwords do not match.";
        $message_type = "error";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_sql = "UPDATE users SET password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $hashed_password, $user_id);

        if ($update_stmt->execute()) {
            $message = "Password changed successfully.";
            $message_type = "success";
        } else {
            $message = "Failed to change password.";
            $message_type = "error";
        }

        $update_stmt->close();
    }
}

/* GET USER DETAILS */
$user_sql = "SELECT id, username, email, address, phone, photo FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();
$user_stmt->close();

/* GET USER RECIPES */
$recipes = [];
$recipe_sql = "SELECT title FROM recipes WHERE user_id = ? ORDER BY id DESC";
$recipe_stmt = $conn->prepare($recipe_sql);
$recipe_stmt->bind_param("i", $user_id);
$recipe_stmt->execute();
$recipe_result = $recipe_stmt->get_result();

while ($row = $recipe_result->fetch_assoc()) {
    $recipes[] = $row['title'];
}
$recipe_stmt->close();

/* OPTIONAL REVIEWS TABLE CHECK */
$reviews = [];
$reviews_table_exists = false;

$table_check = $conn->query("SHOW TABLES LIKE 'reviews'");
if ($table_check && $table_check->num_rows > 0) {
    $reviews_table_exists = true;

    $review_sql = "SELECT review_text FROM reviews WHERE user_id = ? ORDER BY id DESC";
    $review_stmt = $conn->prepare($review_sql);
    $review_stmt->bind_param("i", $user_id);
    $review_stmt->execute();
    $review_result = $review_stmt->get_result();

    while ($row = $review_result->fetch_assoc()) {
        $reviews[] = $row['review_text'];
    }

    $review_stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>My Profile | RecipeBook</title>
<link rel="stylesheet" href="css/styles.css" />
<link rel="stylesheet" href="css/profile.css" />
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
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item ms-2"><a class="btn btn-danger btn-sm" href="auth/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<section class="container py-5">
  <div class="profile-page-card mx-auto">

    <div class="text-center mb-4">
      <?php if (!empty($user['photo'])): ?>
        <img src="<?php echo htmlspecialchars($user['photo']); ?>" class="profile-photo-preview" alt="Profile Photo" />
      <?php else: ?>
        <div class="profile-avatar-large mb-3">👤</div>
      <?php endif; ?>

      <h2><?php echo htmlspecialchars($user['username']); ?></h2>
      <p class="text-muted mb-1"><?php echo htmlspecialchars($user['email']); ?></p>
      <p class="text-muted">Welcome to your Add&Bake profile.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="profile-box h-100">
          <h4 class="mb-3">Personal Information</h4>

          <div class="profile-read-item">
            <span class="profile-label">Name</span>
            <span class="profile-value"><?php echo !empty($user['username']) ? htmlspecialchars($user['username']) : "-"; ?></span>
          </div>

          <div class="profile-read-item">
            <span class="profile-label">Email</span>
            <span class="profile-value"><?php echo !empty($user['email']) ? htmlspecialchars($user['email']) : "-"; ?></span>
          </div>

          <div class="profile-read-item">
            <span class="profile-label">Address</span>
            <span class="profile-value"><?php echo !empty($user['address']) ? htmlspecialchars($user['address']) : "-"; ?></span>
          </div>

          <div class="profile-read-item">
            <span class="profile-label">Contact Number</span>
            <span class="profile-value"><?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : "-"; ?></span>
          </div>

          <div class="profile-read-item">
            <span class="profile-label">Profile Photo</span>
            <span class="profile-value"><?php echo !empty($user['photo']) ? "Added" : "Not added"; ?></span>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="profile-box h-100">
          <h4 class="mb-3">Account & Activity</h4>

          <form method="POST" action="">
            <div class="mb-3">
              <label class="form-label fw-bold">Change Password</label>
              <input type="password" name="newPassword" class="form-control mb-2" placeholder="Enter new password" />
              <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm new password" />
            </div>

            <div class="text-center mb-3">
              <button type="submit" name="change_password" class="btn btn-outline-dark">Change Password</button>
            </div>
          </form>

          <?php if (!empty($message)): ?>
            <div class="form-message mb-4 <?php echo $message_type === 'success' ? 'success-text' : 'error-text'; ?>">
              <?php echo $message; ?>
            </div>
          <?php else: ?>
            <div class="form-message mb-4"></div>
          <?php endif; ?>

          <hr>

          <div class="mb-3">
            <h5>Reviews Given</h5>
            <ul class="list-group">
              <?php if ($reviews_table_exists && count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                  <li class="list-group-item"><?php echo htmlspecialchars($review); ?></li>
                <?php endforeach; ?>
              <?php elseif ($reviews_table_exists): ?>
                <li class="list-group-item">No reviews added yet.</li>
              <?php else: ?>
                <li class="list-group-item">Reviews table not created yet.</li>
              <?php endif; ?>
            </ul>
          </div>

          <div class="mb-3">
            <h5>Added Recipes</h5>
            <ul class="list-group">
              <?php if (count($recipes) > 0): ?>
                <?php foreach ($recipes as $recipe): ?>
                  <li class="list-group-item"><?php echo htmlspecialchars($recipe); ?></li>
                <?php endforeach; ?>
              <?php else: ?>
                <li class="list-group-item">No recipes added yet.</li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
      <a href="auth/logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
</section>

<footer class="bg-dark text-white text-center mt-5 p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
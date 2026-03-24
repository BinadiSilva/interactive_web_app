<?php
include("includes/auth_check.php");
include("includes/db.php");

$user_id = $_SESSION['user_id'];
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $ingredients = trim($_POST["ingredients"] ?? "");
    $steps = trim($_POST["steps"] ?? "");
    $image = trim($_POST["imageUrl"] ?? "");

    if (empty($name) || empty($category) || empty($ingredients) || empty($steps)) {
        $message = "Please fill all required fields.";
        $message_type = "error";
    } else {
        $sql = "INSERT INTO recipes (title, category, ingredients, instructions, image, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $category, $ingredients, $steps, $image, $user_id);

        if ($stmt->execute()) {
            $message = "Recipe submitted successfully.";
            $message_type = "success";
        } else {
            $message = "Failed to submit recipe.";
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
<title>Add Recipe</title>
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
        <li class="nav-item"><a class="nav-link active" href="add_recipe.php">Add Recipe</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item ms-2"><a class="btn btn-danger btn-sm" href="auth/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="text-center mb-4">Add Recipe</h2>

  <form method="POST" action="" class="site-form">
    <div class="mb-3">
      <label class="form-label">Recipe Name</label>
      <input type="text" class="form-control" name="name" required />
    </div>

    <div class="mb-3">
      <label class="form-label">Category</label>
      <select class="form-control" name="category" required>
        <option value="">Select Category</option>
        <option value="Breakfast">Breakfast</option>
        <option value="Lunch">Lunch</option>
        <option value="Dinner">Dinner</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Ingredients</label>
      <textarea class="form-control" name="ingredients" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Steps</label>
      <textarea class="form-control" name="steps" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Image URL (optional)</label>
      <input type="text" class="form-control" name="imageUrl" />
    </div>

    <?php if (!empty($message)): ?>
      <div class="form-message mb-3 <?php echo $message_type === 'success' ? 'success-text' : 'error-text'; ?>">
        <?php echo htmlspecialchars($message); ?>
      </div>
    <?php else: ?>
      <div class="form-message mb-3"></div>
    <?php endif; ?>

    <div class="text-center">
      <button type="submit" class="btn btn-outline-dark">SUBMIT RECIPE</button>
    </div>
  </form>
</div>

<footer class="bg-dark text-white text-center mt-5 p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
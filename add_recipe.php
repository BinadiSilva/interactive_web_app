<?php include("includes/auth_check.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Recipe</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="protected-page">
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
          <li class="nav-item" id="loginNav"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item ms-2" id="registerNav"><a class="btn btn-outline-dark btn-sm" href="register.php">Register</a></li>
          <li class="nav-item dropdown d-none ms-3" id="profileNav">
            <a class="nav-link d-flex align-items-center gap-2" href="profile.php">
              <span class="profile-avatar-small">👤</span>
              <span id="navUserName">Profile</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Add Recipe</h2>

    <form id="recipeForm" class="site-form">
      <div class="mb-3">
        <label class="form-label">Recipe Name</label>
        <input type="text" class="form-control" id="name" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>
        <select class="form-control" id="category" required>
          <option value="">Select Category</option>
          <option value="Breakfast">Breakfast</option>
          <option value="Lunch">Lunch</option>
          <option value="Dinner">Dinner</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Ingredients</label>
        <textarea class="form-control" id="ingredients" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Steps</label>
        <textarea class="form-control" id="steps" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Image URL (optional)</label>
        <input type="text" class="form-control" id="imageUrl" />
      </div>

      <div id="recipeMessage" class="form-message mb-3"></div>

      <div class="text-center">
        <button type="submit" class="btn btn-outline-dark">SUBMIT RECIPE</button>
      </div>
    </form>
  </div>

  <footer class="bg-dark text-white text-center mt-5 p-4">
    <p>© 2026 Add & Bake. All rights reserved.</p>
  </footer>

  <script src="js/auth.js"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
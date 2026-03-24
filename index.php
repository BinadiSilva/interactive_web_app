<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RecipeBook | Home</title>
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
        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>

        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="recipes.php">Browse Recipes</a></li>
          <li class="nav-item"><a class="nav-link" href="add_recipe.php">Add Recipe</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
          <li class="nav-item ms-2"><a class="btn btn-danger btn-sm" href="auth/logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item ms-2"><a class="btn btn-outline-dark btn-sm" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<section class="container py-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <h1 class="display-5 fw-bold mb-3">Welcome to RecipeBook</h1>
      <p class="lead mb-4">
        Discover delicious recipes, share your own dishes, and enjoy cooking with a simple and interactive recipe platform.
      </p>
      <a href="about.php" class="btn btn-dark me-2">Learn More</a>
      <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="login.php" class="btn btn-outline-dark">Get Started</a>
      <?php endif; ?>
    </div>
    <div class="col-md-6 text-center">
      <img src="images/chicken curry.jpg" alt="Recipe Hero" class="img-fluid rounded shadow" style="max-height: 350px; object-fit: cover;">
    </div>
  </div>
</section>

<section class="container py-4">
  <div class="text-center mb-5">
    <h2>Why Use RecipeBook?</h2>
    <p class="text-muted">Everything you need to explore and manage recipes in one place.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <div class="card-body">
          <h4 class="mb-3">🍽 Browse Recipes</h4>
          <p>Search and explore a collection of tasty Sri Lankan and international recipes.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <div class="card-body">
          <h4 class="mb-3">➕ Add Your Own</h4>
          <p>Logged-in users can submit their own recipes and share their cooking ideas with others.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <div class="card-body">
          <h4 class="mb-3">⭐ Reviews & Feedback</h4>
          <p>Read reviews and share your own feedback about the recipes you try.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container py-5">
  <div class="text-center mb-4">
    <h2>Popular Recipes</h2>
    <p class="text-muted">A few tasty favorites from our collection.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card h-100">
        <img src="images/hoppers.jpg" class="card-img-top" alt="Hoppers">
        <div class="card-body text-center">
          <h5>Hoppers</h5>
          <p>Traditional bowl-shaped pancakes with crispy edges and a soft center.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <img src="images/string hoppers.jpg" class="card-img-top" alt="String Hoppers">
        <div class="card-body text-center">
          <h5>String Hoppers</h5>
          <p>Soft steamed rice noodles served with sambol and curry.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100">
        <img src="images/kottu rotti.webp" class="card-img-top" alt="Kottu Roti">
        <div class="card-body text-center">
          <h5>Kottu Roti</h5>
          <p>A famous Sri Lankan street food loved for its spicy and rich flavor.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<footer class="bg-dark text-white text-center mt-5 p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include("includes/auth_check.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Recipe Details</title>
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
          <li class="nav-item"><a class="nav-link" href="add_recipe.php">Add Recipe</a></li>
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

  <div class="container mt-5 recipe-page">
    <h2 class="text-center mb-2" id="recipeTitle"></h2>

    <div class="text-center rating mb-2">⭐⭐⭐⭐☆</div>

    <div class="text-center recipe-meta mb-4">
      Submitted by <strong id="recipeAuthor"></strong> |
      Date: <span id="recipeDate"></span>
    </div>

    <hr />

    <div class="row align-items-center">
      <div class="col-md-6 text-center">
        <img id="recipeImage" class="recipe-img img-fluid" alt="Recipe Image" />
      </div>

      <div class="col-md-6">
        <h4 class="mb-3">Ingredients</h4>
        <ul id="recipeIngredients" class="ingredient-list"></ul>
      </div>
    </div>

    <hr />

    <h4 class="text-center mb-3">Cooking Instructions</h4>
    <div class="steps-box">
      <ol id="recipeSteps"></ol>
    </div>

    <div class="reviews-section mt-5">
      <h4 class="text-center mb-4">Recipe Reviews</h4>

      <div id="reviewList">
        <div class="review-card">
          <strong>Kasun</strong>
          <p>Very delicious recipe. Easy to cook!</p>
        </div>
      </div>
    </div>

    <div class="mt-5">
      <h5 class="text-center mb-3">Add Your Review</h5>

      <form id="reviewForm" class="site-form">
        <div class="mb-3">
          <input type="text" id="reviewName" class="form-control" placeholder="Your Name" required />
        </div>

        <div class="mb-3">
          <textarea id="reviewText" class="form-control" rows="3" placeholder="Write your review..." required></textarea>
        </div>

        <div id="reviewMessage" class="form-message mb-3"></div>

        <div class="text-center">
          <button type="submit" class="btn btn-dark">Submit Review</button>
        </div>
      </form>
    </div>

    <div class="text-center mt-4">
      <a href="recipes.html" class="btn btn-outline-dark">← Back to Recipes</a>
    </div>
  </div>

  <footer class="bg-dark text-white text-center mt-5 p-4">
    <p>© 2026 Add & Bake. All rights reserved.</p>
  </footer>

  <script src="js/auth.js"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
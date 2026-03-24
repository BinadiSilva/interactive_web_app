<?php include("includes/auth_check.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Browse Recipes</title>
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
        <li class="nav-item"><a class="nav-link active" href="recipes.php">Browse Recipes</a></li>
        <li class="nav-item"><a class="nav-link" href="add_recipe.php">Add Recipe</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
        <li class="nav-item ms-2"><a class="btn btn-danger btn-sm" href="auth/logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <input type="search" id="recipeSearch" class="form-control mb-4" placeholder="Search recipes..." />

  <div class="mb-4">
    <strong>Filter:</strong>
    <button class="btn btn-outline-secondary btn-sm filter-btn ms-2" data-filter="all">All</button>
    <button class="btn btn-outline-secondary btn-sm filter-btn" data-filter="breakfast">Breakfast</button>
    <button class="btn btn-outline-secondary btn-sm filter-btn" data-filter="lunch">Lunch</button>
    <button class="btn btn-outline-secondary btn-sm filter-btn" data-filter="dinner">Dinner</button>
  </div>

  <div class="row g-4">
    <div class="col-md-4 recipe-card breakfast">
      <div class="card h-100">
        <img src="images/string hoppers.jpg" class="card-img-top" alt="String Hoppers" />
        <div class="card-body text-center">
          <h5>String Hoppers</h5>
          <p>Traditional rice noodles served with coconut sambol.</p>
          <a href="recipe_details.php?recipe=string_hoppers" class="btn btn-outline-dark">VIEW DETAILS</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 recipe-card breakfast">
      <div class="card h-100">
        <img src="images/hoppers.jpg" class="card-img-top" alt="Hoppers" />
        <div class="card-body text-center">
          <h5>Hoppers</h5>
          <p>Fermented rice flour bowl-shaped pancakes.</p>
          <a href="recipe_details.php?recipe=hoppers" class="btn btn-outline-dark">VIEW DETAILS</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 recipe-card lunch">
      <div class="card h-100">
        <img src="images/chicken curry.jpg" class="card-img-top" alt="Chicken Curry" />
        <div class="card-body text-center">
          <h5>Chicken Curry</h5>
          <p>Spicy Sri Lankan chicken curry with coconut milk.</p>
          <a href="recipe_details.php?recipe=chicken_curry" class="btn btn-outline-dark">VIEW DETAILS</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 recipe-card lunch">
      <div class="card h-100">
        <img src="images/fish curry.jpg" class="card-img-top" alt="Fish Curry" />
        <div class="card-body text-center">
          <h5>Fish Curry</h5>
          <p>Traditional fish curry with goraka.</p>
          <a href="recipe_details.php?recipe=fish_curry" class="btn btn-outline-dark">VIEW DETAILS</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 recipe-card dinner">
      <div class="card h-100">
        <img src="images/kottu rotti.webp" class="card-img-top" alt="Kottu Roti" />
        <div class="card-body text-center">
          <h5>Kottu Roti</h5>
          <p>Popular Sri Lankan street food made with chopped roti.</p>
          <a href="recipe_details.php?recipe=kottu" class="btn btn-outline-dark">VIEW DETAILS</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 recipe-card dinner">
      <div class="card h-100">
        <img src="images/fried rice.jpg" class="card-img-top" alt="Fried Rice" />
        <div class="card-body text-center">
          <h5>Fried Rice</h5>
          <p>Rice stir-fried with vegetables and egg.</p>
          <a href="recipe_details.php?recipe=fried_rice" class="btn btn-outline-dark">VIEW DETAILS</a>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="bg-dark text-white text-center mt-5 p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
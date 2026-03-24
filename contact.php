<?php include("includes/auth_check.php"); ?>
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
      <form id="contactForm" class="site-form">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" id="contactName" class="form-control" placeholder="Enter your name" required />
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" id="contactEmail" class="form-control" placeholder="Enter your email" required />
        </div>

        <div class="mb-4">
          <label class="form-label">Message</label>
          <textarea id="contactMessage" class="form-control" rows="6" placeholder="Enter your message" required></textarea>
        </div>

        <div id="contactFormMessage" class="form-message mb-3"></div>

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

<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
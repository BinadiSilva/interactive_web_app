<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RecipeBook | About Us</title>
  <link rel="stylesheet" href="css/styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Add&Bake</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">

          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="about.php">About Us</a>
          </li>

          <!-- before login -->
          <li class="nav-item" id="loginNav">
            <a class="nav-link" href="login.php">Login</a>
          </li>

          <li class="nav-item" id="registerNav">
            <a class="nav-link" href="register.php">Register</a>
          </li>

          <!-- after login -->
          <li class="nav-item d-none auth-only">
            <a class="nav-link" href="recipes.php">Browse Recipes</a>
          </li>

          <li class="nav-item d-none auth-only">
            <a class="nav-link" href="add_recipe.php">Add Recipe</a>
          </li>

          <li class="nav-item d-none auth-only">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>

          <li class="nav-item dropdown d-none auth-only" id="profileNav">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
              <span class="profile-avatar-small">👤</span>
              <span id="navUserName">Profile</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
              <li><button class="dropdown-item text-danger" id="logoutBtn" type="button">Logout</button></li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- ABOUT HEADER -->
  <section class="container py-5">
    <div class="text-center mb-5">
      <h2>About Us</h2>
      <p class="lead">We share recipes, cooking ideas, and food inspiration.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="site-form">
          <p>
            RecipeBook is an interactive recipe sharing website created for food lovers who want to discover, save, and share delicious meals.
            Our platform allows users to explore different recipes, add their own dishes, and connect with others through reviews and cooking ideas.
          </p>
          <p>
            We believe cooking should be simple, enjoyable, and creative. That is why RecipeBook is designed to provide an easy and user-friendly
            experience for beginners as well as experienced cooks.
          </p>
          <p>
            Through this website, users can browse categorized recipes, read cooking instructions, submit reviews, and manage their own recipe contributions
            after logging into their accounts.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- MISSION / VISION -->
  <section class="container pb-5">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card h-100 p-3">
          <div class="card-body">
            <h4 class="mb-3">Our Mission</h4>
            <p>
              To create a simple and engaging online space where users can discover recipes, learn new cooking ideas,
              and share their own favorite meals with confidence.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card h-100 p-3">
          <div class="card-body">
            <h4 class="mb-3">Our Vision</h4>
            <p>
              To become a trusted and enjoyable digital recipe platform that inspires people to cook more,
              share more, and enjoy food together.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TEAM SECTION -->
  <section class="container pb-5">
    <div class="text-center mb-4">
      <h3>Why RecipeBook?</h3>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 text-center p-3">
          <div class="card-body">
            <h5>Easy to Use</h5>
            <p>A clean and simple interface for browsing and sharing recipes.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 text-center p-3">
          <div class="card-body">
            <h5>Interactive</h5>
            <p>Users can register, login, add recipes, and leave reviews.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 text-center p-3">
          <div class="card-body">
            <h5>Food Inspiration</h5>
            <p>Explore recipe ideas for breakfast, lunch, and dinner.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="bg-dark text-white text-center mt-5 p-4">
    <p>© 2026 Add & Bake. All rights reserved.</p>
  </footer>

  <script src="js/auth.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
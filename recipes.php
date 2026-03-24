<?php
include("includes/auth_check.php");
include("includes/db.php");

$search = trim($_GET['search'] ?? '');
$category = trim($_GET['category'] ?? '');

$sql = "SELECT id, title, category, ingredients, image FROM recipes WHERE 1=1";
$params = [];
$types = "";

if (!empty($search)) {
    $sql .= " AND title LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}

if (!empty($category) && strtolower($category) !== "all") {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>
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
  <form method="GET" action="recipes.php">
    <input
      type="search"
      name="search"
      class="form-control mb-4"
      placeholder="Search recipes..."
      value="<?php echo htmlspecialchars($search); ?>"
    />

    <div class="mb-4">
      <strong>Filter:</strong>
      <a href="recipes.php?category=all&search=<?php echo urlencode($search); ?>" class="btn btn-outline-secondary btn-sm ms-2">All</a>
      <a href="recipes.php?category=Breakfast&search=<?php echo urlencode($search); ?>" class="btn btn-outline-secondary btn-sm">Breakfast</a>
      <a href="recipes.php?category=Lunch&search=<?php echo urlencode($search); ?>" class="btn btn-outline-secondary btn-sm">Lunch</a>
      <a href="recipes.php?category=Dinner&search=<?php echo urlencode($search); ?>" class="btn btn-outline-secondary btn-sm">Dinner</a>
      <button type="submit" class="btn btn-dark btn-sm ms-2">Search</button>
    </div>
  </form>

  <div class="row g-4">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($recipe = $result->fetch_assoc()): ?>
        <div class="col-md-4">
          <div class="card h-100">
            <img
              src="<?php echo !empty($recipe['image']) ? htmlspecialchars($recipe['image']) : 'images/chicken curry.jpg'; ?>"
              class="card-img-top"
              alt="<?php echo htmlspecialchars($recipe['title']); ?>"
            />
            <div class="card-body text-center">
              <h5><?php echo htmlspecialchars($recipe['title']); ?></h5>
              <p><?php echo htmlspecialchars(substr($recipe['ingredients'], 0, 80)); ?>...</p>
              <a href="recipe_details.php?id=<?php echo $recipe['id']; ?>" class="btn btn-outline-dark">VIEW DETAILS</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-warning text-center">No recipes found.</div>
      </div>
    <?php endif; ?>
  </div>
</div>

<footer class="bg-dark text-white text-center mt-5 p-4">
  <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
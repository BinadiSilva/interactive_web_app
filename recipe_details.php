<?php
include("includes/auth_check.php");
include("includes/db.php");

$user_id = $_SESSION['user_id'];
$recipe_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$message = "";
$message_type = "";

if ($recipe_id <= 0) {
    header("Location: recipes.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_review"])) {
    $review_text = trim($_POST["reviewText"] ?? "");

    if (empty($review_text)) {
        $message = "Please write your review.";
        $message_type = "error";
    } else {
        $insert_sql = "INSERT INTO reviews (user_id, recipe_id, review_text) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iis", $user_id, $recipe_id, $review_text);

        if ($insert_stmt->execute()) {
            $message = "Review submitted successfully.";
            $message_type = "success";
        } else {
            $message = "Failed to submit review: " . $insert_stmt->error;
            $message_type = "error";
        }

        $insert_stmt->close();
    }
}

$recipe_sql = "SELECT recipes.*, users.username
               FROM recipes
               INNER JOIN users ON recipes.user_id = users.id
               WHERE recipes.id = ?";
$recipe_stmt = $conn->prepare($recipe_sql);
$recipe_stmt->bind_param("i", $recipe_id);
$recipe_stmt->execute();
$recipe_result = $recipe_stmt->get_result();
$recipe = $recipe_result->fetch_assoc();
$recipe_stmt->close();

if (!$recipe) {
    header("Location: recipes.php");
    exit();
}

$reviews = [];
$review_sql = "SELECT reviews.review_text, reviews.created_at, users.username
               FROM reviews
               INNER JOIN users ON reviews.user_id = users.id
               WHERE reviews.recipe_id = ?
               ORDER BY reviews.id DESC";
$review_stmt = $conn->prepare($review_sql);
$review_stmt->bind_param("i", $recipe_id);
$review_stmt->execute();
$review_result = $review_stmt->get_result();

while ($row = $review_result->fetch_assoc()) {
    $reviews[] = $row;
}
$review_stmt->close();

$ingredients_array = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $recipe['ingredients'])));
$steps_array = array_filter(array_map('trim', preg_split("/\r\n|\n|\r/", $recipe['instructions'])));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recipe Details</title>
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
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
                <li class="nav-item ms-2"><a class="btn btn-danger btn-sm" href="auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 recipe-page">
    <h2 class="text-center mb-2"><?php echo htmlspecialchars($recipe['title']); ?></h2>

    <div class="text-center rating mb-2">⭐⭐⭐⭐☆</div>

    <div class="text-center recipe-meta mb-4">
        Submitted by <strong><?php echo htmlspecialchars($recipe['username']); ?></strong> |
        Date: <span><?php echo htmlspecialchars($recipe['created_at']); ?></span>
    </div>

    <hr />

    <div class="row align-items-center">
        <div class="col-md-6 text-center">
            <img
                src="<?php echo !empty($recipe['image']) ? htmlspecialchars($recipe['image']) : 'images/chicken curry.jpg'; ?>"
                class="recipe-img img-fluid"
                alt="<?php echo htmlspecialchars($recipe['title']); ?>"
            />
        </div>

        <div class="col-md-6">
            <h4 class="mb-3">Ingredients</h4>
            <ul class="ingredient-list">
                <?php if (count($ingredients_array) > 0): ?>
                    <?php foreach ($ingredients_array as $ingredient): ?>
                        <li><?php echo htmlspecialchars($ingredient); ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No ingredients available.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <hr />

    <h4 class="text-center mb-3">Cooking Instructions</h4>
    <div class="steps-box">
        <ol>
            <?php if (count($steps_array) > 0): ?>
                <?php foreach ($steps_array as $step): ?>
                    <li><?php echo htmlspecialchars($step); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No instructions available.</li>
            <?php endif; ?>
        </ol>
    </div>

    <div class="reviews-section mt-5">
        <h4 class="text-center mb-4">Recipe Reviews</h4>

        <div id="reviewList">
            <?php if (count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review-card">
                        <strong><?php echo htmlspecialchars($review['username']); ?></strong>
                        <p class="mb-1"><?php echo htmlspecialchars($review['review_text']); ?></p>
                        <small class="text-muted"><?php echo htmlspecialchars($review['created_at']); ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="review-card">
                    <strong>No reviews yet</strong>
                    <p>Be the first to review this recipe.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mt-5">
        <h5 class="text-center mb-3">Add Your Review</h5>

        <form method="POST" action="" class="site-form">
            <div class="mb-3">
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" readonly />
            </div>

            <div class="mb-3">
                <textarea name="reviewText" class="form-control" rows="3" placeholder="Write your review..." required></textarea>
            </div>

            <?php if (!empty($message)): ?>
                <div class="form-message mb-3 <?php echo $message_type === 'success' ? 'success-text' : 'error-text'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php else: ?>
                <div class="form-message mb-3"></div>
            <?php endif; ?>

            <div class="text-center">
                <button type="submit" name="submit_review" class="btn btn-dark">Submit Review</button>
            </div>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="recipes.php" class="btn btn-outline-dark">← Back to Recipes</a>
    </div>
</div>

<footer class="bg-dark text-white text-center p-4">
    <p>© 2026 Add & Bake. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
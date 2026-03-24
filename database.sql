DROP DATABASE IF EXISTS recipe_book;
CREATE DATABASE recipe_book;
USE recipe_book;

-- ----------------------------
-- Table: users
-- ----------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(50) DEFAULT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------
-- Table: recipes
-- ----------------------------
CREATE TABLE recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    ingredients TEXT NOT NULL,
    instructions TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ----------------------------
-- Table: messages
-- ----------------------------
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------
-- Table: reviews
-- ----------------------------
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id INT NOT NULL,
    review_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE
);

-- ----------------------------
-- Sample user
-- ----------------------------
-- Note: this password value is only a placeholder hash for sample data.
-- For real login testing, register a new user through the website.
INSERT INTO users (id, username, email, password, address, phone, photo) VALUES
(1, 'sampleuser', 'sample@addbake.com', '$2y$10$sampleplaceholderhashsampleplaceholderhashsampleplace', 'Colombo, Sri Lanka', '0771234567', '');

-- ----------------------------
-- Sample recipes
-- ----------------------------
INSERT INTO recipes (id, title, category, ingredients, instructions, image, user_id) VALUES
(1, 'String Hoppers', 'Breakfast',
'Rice flour
Hot water
Salt
Coconut sambol
Fish curry',
'Mix rice flour with hot water and salt to form a soft dough.
Press the dough through a string hopper maker.
Steam the noodles for about 5 minutes.
Serve hot with coconut sambol and curry.',
'images/string hoppers.jpg', 1),

(2, 'Hoppers', 'Breakfast',
'Rice flour
Coconut milk
Yeast
Sugar
Salt',
'Prepare hopper batter using rice flour and coconut milk.
Allow the batter to ferment for several hours.
Pour batter into a hot hopper pan.
Cook until the edges become crispy.',
'images/hoppers.jpg', 1),

(3, 'Chicken Curry', 'Lunch',
'Chicken pieces
Onion
Garlic
Curry powder
Coconut milk',
'Saute onions and garlic with spices.
Add chicken pieces and cook well.
Pour coconut milk and simmer.
Cook until the curry becomes thick and flavorful.',
'images/chicken curry.jpg', 1),

(4, 'Fish Curry', 'Lunch',
'Fish
Onion
Garlic
Goraka
Curry powder',
'Prepare the spice base with onion and garlic.
Add fish pieces carefully.
Add goraka and curry mixture.
Cook until the gravy thickens.',
'images/fish curry.jpg', 1),

(5, 'Kottu Roti', 'Dinner',
'Godamba roti
Chicken
Egg
Vegetables
Sauce',
'Shred the roti into small pieces.
Cook vegetables, egg, and chicken together.
Add sauce and seasoning.
Mix with chopped roti until well combined.',
'images/kottu rotti.webp', 1),

(6, 'Fried Rice', 'Dinner',
'Rice
Carrot
Leeks
Egg
Soy sauce',
'Heat oil and fry vegetables lightly.
Add egg and scramble.
Add cooked rice and soy sauce.
Mix well and serve hot.',
'images/fried rice.jpg', 1);

-- ----------------------------
-- Sample messages
-- ----------------------------
INSERT INTO messages (id, name, email, message) VALUES
(1, 'Nimal', 'nimal@gmail.com', 'Hello, I like your recipe website.'),
(2, 'Kamal', 'kamal@gmail.com', 'Please add more dinner recipes.');

-- ----------------------------
-- Sample reviews
-- ----------------------------
INSERT INTO reviews (id, user_id, recipe_id, review_text) VALUES
(1, 1, 1, 'Very tasty and easy to prepare.'),
(2, 1, 3, 'The chicken curry was rich and delicious.'),
(3, 1, 5, 'Kottu recipe came out really well.');
# 🍽️ Add & Bake – Recipe Web Application

## 📌 Project Overview
Add & Bake is a web-based recipe sharing platform where users can:
- Register and login
- Add their own recipes
- Browse recipes
- View recipe details
- Submit reviews
- Send messages via contact form

This project is developed using:
- Frontend: HTML, CSS, Bootstrap, JavaScript
- Backend: PHP
- Database: MySQL

---

## ⚙️ How to Run the Project

### 1. Setup XAMPP
- Install XAMPP
- Start **Apache** and **MySQL**

### 2. Copy Project
- Place project folder inside:
htdocs/

### 3. Import Database
- Open **phpMyAdmin**
- Click **Import**
- Select `database.sql`
- Click **Go**

### 4. Run Project
Open browser and go to:
http://localhost/interactive_web_app/

---

## 🔐 Features

### User Authentication
- Register new users
- Login with email and password
- Logout functionality

### Recipe Management
- Add new recipes
- View all recipes
- View recipe details

### Reviews
- Users can submit reviews for recipes
- Reviews are stored and displayed

### Contact Form
- Users can send messages
- Messages stored in database

### Profile
- View user details
- Change password
- View added recipes and reviews

---

## 🗄️ Database Tables
- users
- recipes
- reviews
- messages

---

## 🧪 Testing Checklist
- ✅ Register user
- ✅ Login
- ✅ Logout
- ✅ Add recipe
- ✅ View recipes
- ✅ Add review
- ✅ Contact form submission
- ✅ Profile page

---

## 📁 Project Structure
/interactive_web_app
│── /auth
│── /includes
│── /css
│── /js
│── /images
│── index.php
│── login.php
│── register.php
│── profile.php
│── recipes.php
│── recipe_details.php
│── add_recipe.php
│── contact.php
│── database.sql

---

## 👨‍💻 Authors
- Binadi Silva
- Anupa Perera

---

## 📌 Notes
- Use XAMPP to run the project
- Import `database.sql` before running
- Register a new user for testing login
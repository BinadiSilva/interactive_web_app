const searchInput = document.getElementById("searchInput");
const filterButtons = document.querySelectorAll(".filter-btn");
const recipeCards = document.querySelectorAll(".recipe-card");

if (searchInput) {
  searchInput.addEventListener("keyup", function () {
    const value = searchInput.value.toLowerCase();

    recipeCards.forEach((card) => {
      const recipeName = card.getAttribute("data-name").toLowerCase();
      if (recipeName.includes(value)) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
}

filterButtons.forEach((button) => {
  button.addEventListener("click", function () {
    const category = this.getAttribute("data-category");

    recipeCards.forEach((card) => {
      const cardCategory = card.getAttribute("data-category");
      if (category === "all" || cardCategory === category) {
        card.style.display = "block";
      } else {
        card.style.display = "none";
      }
    });
  });
});

const recipeForm = document.getElementById("recipeForm");

if (recipeForm) {
  recipeForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("recipeName").value.trim();
    const category = document.getElementById("recipeCategory").value.trim();
    const ingredients = document.getElementById("recipeIngredientsInput").value.trim();
    const steps = document.getElementById("recipeStepsInput").value.trim();
    const message = document.getElementById("recipeMessage");

    if (name === "" || category === "" || ingredients === "" || steps === "") {
      message.style.color = "red";
      message.textContent = "Please fill in all required fields.";
      return;
    }

    message.style.color = "green";
    message.textContent = "Recipe submitted successfully!";
    recipeForm.reset();
  });
}

const contactForm = document.getElementById("contactForm");

if (contactForm) {
  contactForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("contactName").value.trim();
    const email = document.getElementById("contactEmail").value.trim();
    const text = document.getElementById("contactMessage").value.trim();
    const message = document.getElementById("contactFormMessage");

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    if (name === "" || email === "" || text === "") {
      message.style.color = "red";
      message.textContent = "Please fill in all fields.";
      return;
    }

    if (!email.match(emailPattern)) {
      message.style.color = "red";
      message.textContent = "Please enter a valid email address.";
      return;
    }

    message.style.color = "green";
    message.textContent = "Message sent successfully!";
    contactForm.reset();
  });
}

const recipeData = {
  "pancakes": {
    title: "Pancakes",
    image: "https://images.unsplash.com/photo-1528207776546-365bb710ee93?w=900",
    ingredients: ["2 cups flour", "2 eggs", "1 cup milk", "1 tbsp sugar", "1 tsp baking powder"],
    steps: [
      "Mix flour, sugar, and baking powder.",
      "Add eggs and milk, then mix well.",
      "Heat a pan and pour batter.",
      "Cook both sides until golden brown.",
      "Serve hot with syrup."
    ]
  },
  "chicken-rice": {
    title: "Chicken Rice",
    image: "https://images.unsplash.com/photo-1512058564366-18510be2db19?w=900",
    ingredients: ["1 cup rice", "200g chicken", "1 onion", "Salt", "Pepper"],
    steps: [
      "Cook rice separately.",
      "Fry onion until golden.",
      "Add chicken and cook well.",
      "Mix rice with chicken.",
      "Serve warm."
    ]
  },
  "pasta": {
    title: "Pasta",
    image: "https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=900",
    ingredients: ["200g pasta", "1 cup cream", "Cheese", "Salt", "Pepper"],
    steps: [
      "Boil pasta until soft.",
      "Prepare creamy sauce in another pan.",
      "Mix pasta with sauce.",
      "Add cheese on top.",
      "Serve hot."
    ]
  },
  "chocolate-cake": {
    title: "Chocolate Cake",
    image: "https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=900",
    ingredients: ["2 cups flour", "1 cup sugar", "Cocoa powder", "2 eggs", "Butter"],
    steps: [
      "Mix dry ingredients.",
      "Add eggs and butter.",
      "Pour into baking tray.",
      "Bake for 30 minutes.",
      "Let it cool and serve."
    ]
  },
  "omelette": {
    title: "Omelette",
    image: "https://images.unsplash.com/photo-1510693206972-df098062cb71?w=900",
    ingredients: ["2 eggs", "Salt", "Pepper", "Onion", "Tomato"],
    steps: [
      "Beat eggs in a bowl.",
      "Add chopped onion and tomato.",
      "Pour into hot pan.",
      "Cook both sides.",
      "Serve hot."
    ]
  },
  "vegetable-soup": {
    title: "Vegetable Soup",
    image: "https://images.unsplash.com/photo-1547592180-85f173990554?w=900",
    ingredients: ["Carrot", "Beans", "Potato", "Water", "Salt"],
    steps: [
      "Cut vegetables into small pieces.",
      "Boil water in a pot.",
      "Add vegetables and cook well.",
      "Season with salt.",
      "Serve warm."
    ]
  }
};

const recipeTitle = document.getElementById("recipeTitle");
const recipeImage = document.getElementById("recipeImage");
const recipeIngredients = document.getElementById("recipeIngredients");
const recipeSteps = document.getElementById("recipeSteps");

if (recipeTitle && recipeImage && recipeIngredients && recipeSteps) {
  const params = new URLSearchParams(window.location.search);
  const recipeKey = params.get("recipe");

  if (recipeKey && recipeData[recipeKey]) {
    const recipe = recipeData[recipeKey];

    recipeTitle.textContent = recipe.title;
    recipeImage.src = recipe.image;
    recipeImage.alt = recipe.title;

    recipe.ingredients.forEach((ingredient) => {
      const li = document.createElement("li");
      li.textContent = ingredient;
      recipeIngredients.appendChild(li);
    });

    recipe.steps.forEach((step) => {
      const li = document.createElement("li");
      li.textContent = step;
      recipeSteps.appendChild(li);
    });
  } else {
    recipeTitle.textContent = "Recipe Not Found";
    recipeIngredients.innerHTML = "<li>No ingredients available.</li>";
    recipeSteps.innerHTML = "<li>No steps available.</li>";
  }
}
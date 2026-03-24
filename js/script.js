document.addEventListener("DOMContentLoaded", function () {
  const currentUser =
    window.recipeBookAuth && typeof window.recipeBookAuth.getCurrentUser === "function"
      ? window.recipeBookAuth.getCurrentUser()
      : null;

  function showInlineMessage(elementId, text, type) {
    const el = document.getElementById(elementId);
    if (!el) return;
    el.textContent = text;
    el.className = "form-message mb-3 " + (type === "success" ? "success-text" : "error-text");
  }

  const search = document.getElementById("recipeSearch");
  if (search) {
    search.addEventListener("keyup", function () {
      const filter = search.value.toLowerCase();
      const cards = document.querySelectorAll(".recipe-card");

      cards.forEach(function (card) {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(filter) ? "" : "none";
      });
    });
  }

  const filterButtons = document.querySelectorAll(".filter-btn");
  filterButtons.forEach(button => {
    button.addEventListener("click", function () {
      const filter = this.dataset.filter;
      const cards = document.querySelectorAll(".recipe-card");

      filterButtons.forEach(btn => btn.classList.remove("active-filter"));
      this.classList.add("active-filter");

      cards.forEach(function (card) {
        if (filter === "all" || card.classList.contains(filter)) {
          card.style.display = "";
        } else {
          card.style.display = "none";
        }
      });
    });
  });

  const recipes = {
    string_hoppers: {
      title: "String Hoppers",
      author: "Binadi",
      date: "2026-03-15",
      image: "images/string hoppers.jpg",
      ingredients: ["Rice flour", "Hot water", "Salt", "Coconut sambol", "Fish curry"],
      steps: [
        "Mix rice flour with hot water and salt to form a soft dough.",
        "Press the dough through a string hopper maker.",
        "Steam the noodles for about 5 minutes.",
        "Serve hot with coconut sambol and curry."
      ]
    },
    hoppers: {
      title: "Hoppers",
      author: "Anupa",
      date: "2026-03-15",
      image: "images/hoppers.jpg",
      ingredients: ["Rice flour", "Coconut milk", "Yeast", "Sugar", "Salt"],
      steps: [
        "Prepare hopper batter using rice flour and coconut milk.",
        "Allow the batter to ferment for several hours.",
        "Pour batter into a hot hopper pan.",
        "Cook until the edges become crispy."
      ]
    },
    chicken_curry: {
      title: "Chicken Curry",
      author: "Community",
      date: "2026-03-15",
      image: "images/chicken curry.jpg",
      ingredients: ["Chicken pieces", "Onion", "Garlic", "Curry powder", "Coconut milk"],
      steps: [
        "Saute onions and garlic with spices.",
        "Add chicken pieces and cook well.",
        "Pour coconut milk and simmer.",
        "Cook until the curry becomes thick and flavorful."
      ]
    },
    fish_curry: {
      title: "Fish Curry",
      author: "Community",
      date: "2026-03-15",
      image: "images/fish curry.jpg",
      ingredients: ["Fish", "Onion", "Garlic", "Goraka", "Curry powder"],
      steps: [
        "Prepare the spice base with onion and garlic.",
        "Add fish pieces carefully.",
        "Add goraka and curry mixture.",
        "Cook until the gravy thickens."
      ]
    },
    kottu: {
      title: "Kottu Roti",
      author: "Community",
      date: "2026-03-15",
      image: "images/kottu rotti.webp",
      ingredients: ["Godamba roti", "Chicken", "Egg", "Vegetables", "Sauce"],
      steps: [
        "Shred the roti into small pieces.",
        "Cook vegetables, egg, and chicken together.",
        "Add sauce and seasoning.",
        "Mix with chopped roti until well combined."
      ]
    },
    fried_rice: {
      title: "Fried Rice",
      author: "Community",
      date: "2026-03-15",
      image: "images/fried rice.jpg",
      ingredients: ["Rice", "Carrot", "Leeks", "Egg", "Soy sauce"],
      steps: [
        "Heat oil and fry vegetables lightly.",
        "Add egg and scramble.",
        "Add cooked rice and soy sauce.",
        "Mix well and serve hot."
      ]
    }
  };

  const params = new URLSearchParams(window.location.search);
  const recipeKey = params.get("recipe");

  if (recipeKey && recipes[recipeKey]) {
    const recipe = recipes[recipeKey];

    const title = document.getElementById("recipeTitle");
    const author = document.getElementById("recipeAuthor");
    const date = document.getElementById("recipeDate");
    const image = document.getElementById("recipeImage");
    const ingredients = document.getElementById("recipeIngredients");
    const steps = document.getElementById("recipeSteps");

    if (title) title.textContent = recipe.title;
    if (author) author.textContent = recipe.author;
    if (date) date.textContent = recipe.date;
    if (image) image.src = recipe.image;

    if (ingredients) {
      ingredients.innerHTML = "";
      recipe.ingredients.forEach(item => {
        ingredients.innerHTML += `<li>${item}</li>`;
      });
    }

    if (steps) {
      steps.innerHTML = "";
      recipe.steps.forEach(step => {
        steps.innerHTML += `<li>${step}</li>`;
      });
    }
  }

  const reviewForm = document.getElementById("reviewForm");
if (reviewForm) {
  reviewForm.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!currentUser) {
      showInlineMessage("reviewMessage", "You must login first to submit a review.", "error");
      return;
    }

    const name = document.getElementById("reviewName").value.trim();
    const text = document.getElementById("reviewText").value.trim();

    if (!name || !text) {
      showInlineMessage("reviewMessage", "Please fill all fields.", "error");
      return;
    }

    const review = document.createElement("div");
    review.classList.add("review-card");
    review.innerHTML = `<strong>${name}</strong><p>${text}</p>`;

    document.getElementById("reviewList").appendChild(review);
    reviewForm.reset();

    const reviewKey = `userReviews_${currentUser.email}`;
    const savedReviews = JSON.parse(localStorage.getItem(reviewKey)) || [];
    savedReviews.push(text);
    localStorage.setItem(reviewKey, JSON.stringify(savedReviews));

    showInlineMessage("reviewMessage", "Review submitted successfully.", "success");
  });
}

  const recipeForm = document.getElementById("recipeForm");
if (recipeForm) {
  recipeForm.addEventListener("submit", function (e) {
    e.preventDefault();

    if (!currentUser) {
      showInlineMessage("recipeMessage", "You must login first to add a recipe.", "error");
      return;
    }

    const name = document.getElementById("name").value.trim();
    const category = document.getElementById("category").value.trim();
    const ingredients = document.getElementById("ingredients").value.trim();
    const steps = document.getElementById("steps").value.trim();

    if (!name || !category || !ingredients || !steps) {
      showInlineMessage("recipeMessage", "Please fill all required fields.", "error");
      return;
    }

    const recipeKey = `userRecipes_${currentUser.email}`;
    const savedRecipes = JSON.parse(localStorage.getItem(recipeKey)) || [];
    savedRecipes.push(name);
    localStorage.setItem(recipeKey, JSON.stringify(savedRecipes));

    recipeForm.reset();
    showInlineMessage("recipeMessage", "Recipe submitted successfully.", "success");
  });
}

  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();

      if (!currentUser) {
        showInlineMessage("contactFormMessage", "You must login first to send a message.", "error");
        return;
      }

      const name = document.getElementById("contactName").value.trim();
      const email = document.getElementById("contactEmail").value.trim();
      const message = document.getElementById("contactMessage").value.trim();

      if (!name || !email || !message) {
        showInlineMessage("contactFormMessage", "Please fill all fields.", "error");
        return;
      }

      contactForm.reset();
      showInlineMessage("contactFormMessage", "Message submitted successfully.", "success");
    });
  }
});
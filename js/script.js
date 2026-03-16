document.addEventListener("DOMContentLoaded", function(){

/* =================================
SEARCH FUNCTION (RECIPES PAGE)
================================= */

let search = document.getElementById("recipeSearch");

if(search){

search.addEventListener("keyup", function(){

let filter = search.value.toLowerCase();
let cards = document.querySelectorAll(".recipe-card");

cards.forEach(function(card){

let text = card.innerText.toLowerCase();

if(text.includes(filter)){
card.style.display = "";
}else{
card.style.display = "none";
}

});

});

}


/* =================================
FILTER BUTTONS
================================= */

let filterButtons = document.querySelectorAll(".filter-btn");

filterButtons.forEach(button => {

button.addEventListener("click", function(){

let filter = this.dataset.filter;
let cards = document.querySelectorAll(".recipe-card");

cards.forEach(function(card){

if(filter === "all"){
card.style.display = "";
}
else if(card.classList.contains(filter)){
card.style.display = "";
}
else{
card.style.display = "none";
}

});

});

});


/* =================================
RECIPE DATA
================================= */

const recipes = {

string_hoppers:{
title:"String Hoppers",
author:"Binadi",
date:"2026-03-15",
image:"images/string hoppers.jpg",
ingredients:[
"Rice flour",
"Hot water",
"Salt",
"Coconut sambol",
"Fish curry"
],
steps:[
"Mix rice flour with hot water and salt to form a soft dough.",
"Press the dough through a string hopper maker.",
"Steam the noodles for about 5 minutes.",
"Serve hot with coconut sambol and curry."
]
},

hoppers:{
title:"Hoppers",
author:"Anupa",
date:"2026-03-15",
image:"images/hoppers.jpg",
ingredients:[
"Rice flour",
"Coconut milk",
"Yeast",
"Sugar",
"Salt"
],
steps:[
"Prepare hopper batter using rice flour and coconut milk.",
"Allow the batter to ferment for several hours.",
"Pour batter into a hot hopper pan.",
"Cook until the edges become crispy."
]
},

kiribath:{
title:"Milk Rice (Kiribath)",
author:"Community",
date:"2026-03-15",
image:"images/milkrice.jpg",
ingredients:[
"Rice",
"Coconut milk",
"Salt"
],
steps:[
"Cook rice until soft.",
"Add coconut milk and salt.",
"Cook until the mixture thickens.",
"Spread on a tray and cut into pieces."
]
},

chicken_curry:{
title:"Chicken Curry",
author:"Community",
date:"2026-03-15",
image:"images/chicken curry.jpg",
ingredients:[
"Chicken pieces",
"Onion",
"Garlic",
"Curry powder",
"Coconut milk"
],
steps:[
"Saute onions and garlic with spices.",
"Add chicken pieces and cook well.",
"Pour coconut milk and simmer.",
"Cook until the curry becomes thick and flavorful."
]
}

};


/* =================================
LOAD RECIPE DETAILS
================================= */

const params = new URLSearchParams(window.location.search);
const recipe = params.get("recipe");

if(recipe && recipes[recipe]){

document.getElementById("recipeTitle").innerText = recipes[recipe].title;
document.getElementById("recipeAuthor").innerText = recipes[recipe].author;
document.getElementById("recipeDate").innerText = recipes[recipe].date;
document.getElementById("recipeImage").src = recipes[recipe].image;

let ingredientsHTML = "";

recipes[recipe].ingredients.forEach(function(i){
ingredientsHTML += `<li>${i}</li>`;
});

document.getElementById("recipeIngredients").innerHTML = ingredientsHTML;

let stepsHTML = "";

recipes[recipe].steps.forEach(function(s){
stepsHTML += `<li>${s}</li>`;
});

document.getElementById("recipeSteps").innerHTML = stepsHTML;

}


/* =================================
ADD REVIEW
================================= */

let reviewForm = document.getElementById("reviewForm");

if(reviewForm){

reviewForm.addEventListener("submit", function(e){

e.preventDefault();

let name = document.getElementById("reviewName").value.trim();
let text = document.getElementById("reviewText").value.trim();
let message = document.getElementById("reviewMessage");

if(name === "" || text === ""){

message.innerHTML = "⚠ Please fill all fields.";
message.style.color = "red";

return;

}

let review = document.createElement("div");
review.classList.add("review-card");

review.innerHTML = `<strong>${name}</strong><p>${text}</p>`;

document.getElementById("reviewList").appendChild(review);

message.innerHTML = "✔ Review submitted successfully!";
message.style.color = "green";

reviewForm.reset();

});

}


/* =================================
ADD RECIPE FORM
================================= */

let recipeForm = document.getElementById("recipeForm");

if(recipeForm){

recipeForm.addEventListener("submit", function(e){

e.preventDefault();

let name = document.getElementById("name").value;

if(name === ""){
alert("Recipe name is required");
return;
}

alert("Recipe submitted successfully!");

recipeForm.reset();

location.reload();

});

}


/* =================================
CONTACT FORM
================================= */

let contactForm = document.getElementById("contactForm");

if(contactForm){

contactForm.addEventListener("submit", function(e){

e.preventDefault();

alert("Message submitted successfully!");

contactForm.reset();

location.reload();

});

}

});
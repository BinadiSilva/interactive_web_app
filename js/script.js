// ===============================
// SEARCH BAR (recipes page)
// ===============================

document.addEventListener("DOMContentLoaded", function () {

const searchInput = document.querySelector('input[type="search"]');

if (searchInput) {

searchInput.addEventListener("keyup", function () {

let filter = searchInput.value.toLowerCase();
let cards = document.querySelectorAll(".card");

cards.forEach(function(card){

let title = card.innerText.toLowerCase();

if(title.includes(filter)){
card.style.display = "";
}else{
card.style.display = "none";
}

});

});

}

});


// ===============================
// ADD RECIPE FORM VALIDATION
// ===============================

document.addEventListener("DOMContentLoaded", function(){

const form = document.querySelector("form");

if(form && document.title === "Add Recipe"){

form.addEventListener("submit", function(e){

let name = document.querySelector('input[type="text"]').value.trim();
let category = document.querySelector("select").value;
let ingredients = document.querySelectorAll("textarea")[0].value.trim();
let steps = document.querySelectorAll("textarea")[1].value.trim();

if(name === ""){
alert("Recipe name is required");
e.preventDefault();
return;
}

if(category === "Select"){
alert("Please choose a category");
e.preventDefault();
return;
}

if(ingredients === ""){
alert("Ingredients cannot be empty");
e.preventDefault();
return;
}

if(steps === ""){
alert("Steps cannot be empty");
e.preventDefault();
return;
}

alert("Recipe submitted successfully!");

});

}

});


// ===============================
// CONTACT FORM VALIDATION
// ===============================

document.addEventListener("DOMContentLoaded", function(){

if(document.title === "Contact Us"){

const form = document.querySelector("form");

form.addEventListener("submit", function(e){

let name = document.querySelector('input[type="text"]').value.trim();
let email = document.querySelector('input[type="email"]').value.trim();
let message = document.querySelector("textarea").value.trim();

if(name === ""){
alert("Please enter your name");
e.preventDefault();
return;
}

if(email === "" || !email.includes("@")){
alert("Please enter a valid email");
e.preventDefault();
return;
}

if(message === ""){
alert("Message cannot be empty");
e.preventDefault();
return;
}

alert("Message sent successfully!");

});

}

});


// ===============================
// RECIPE RATING CLICK
// ===============================

document.addEventListener("DOMContentLoaded", function(){

const stars = document.querySelectorAll(".rating-star");

stars.forEach(function(star, index){

star.addEventListener("click", function(){

stars.forEach((s,i)=>{

if(i <= index){
s.classList.add("active");
}else{
s.classList.remove("active");
}

});

});

});

});
document.addEventListener("DOMContentLoaded",function(){

// =============================
// ADD RECIPE FORM VALIDATION
// =============================

let form=document.getElementById("recipeForm");

if(form){

form.addEventListener("submit",function(e){

let name=document.getElementById("name").value;

if(name===""){
alert("Recipe name is required");
e.preventDefault();
}

});

}


// =============================
// SEARCH FUNCTION (recipes page)
// =============================

let search=document.querySelector("input[type='search']");

if(search){

search.addEventListener("keyup",function(){

let filter=search.value.toLowerCase();
let cards=document.querySelectorAll(".card");

cards.forEach(function(card){

let text=card.innerText.toLowerCase();

if(text.includes(filter)){
card.style.display="";
}else{
card.style.display="none";
}

});

});

}


// =============================
// RECIPE DETAILS LOADING
// =============================

const recipes={

string_hoppers:{
title:"String Hoppers",
image:"images/string hoppers.jpg",
ingredients:[
"Rice flour",
"Hot water",
"Salt",
"Coconut sambol",
"Fish curry"
],
steps:[
"Mix rice flour with hot water",
"Press dough through string hopper maker",
"Steam for 5 minutes",
"Serve with sambol and curry"
]
},

hoppers:{
title:"Hoppers",
image:"images/hoppers.jpg",
ingredients:[
"Rice flour",
"Coconut milk",
"Yeast",
"Sugar"
],
steps:[
"Prepare hopper batter",
"Let batter ferment",
"Pour into hopper pan",
"Cook until crispy edges form"
]
},

kiribath:{
title:"Milk Rice (Kiribath)",
image:"images/milk rice.jpg",
ingredients:[
"Rice",
"Coconut milk",
"Salt"
],
steps:[
"Cook rice",
"Add coconut milk",
"Cook until thick",
"Cut into pieces"
]
},

pol_roti:{
title:"Pol Roti",
image:"images/roti.jpg",
ingredients:[
"Flour",
"Grated coconut",
"Salt",
"Green chilli"
],
steps:[
"Mix flour and coconut",
"Knead dough",
"Shape into flat discs",
"Cook on hot pan"
]
},

pittu:{
title:"Pittu",
image:"images/pittu.jpg",
ingredients:[
"Rice flour",
"Coconut",
"Salt"
],
steps:[
"Mix flour with water",
"Layer flour and coconut",
"Steam in pittu steamer"
]
},

rice_curry:{
title:"Rice and Curry",
image:"images/rice and curry.jpg",
ingredients:[
"Rice",
"Dhal curry",
"Chicken curry",
"Vegetable curry",
"Sambol"
],
steps:[
"Cook rice",
"Prepare curries",
"Serve together"
]
},

parippu:{
title:"Parippu (Dhal Curry)",
image:"images/parippu.jpg",
ingredients:[
"Red lentils",
"Coconut milk",
"Onion",
"Curry leaves"
],
steps:[
"Boil lentils",
"Add coconut milk",
"Season with spices"
]
},

chicken_curry:{
title:"Chicken Curry",
image:"images/chicken curry.jpg",
ingredients:[
"Chicken",
"Onion",
"Garlic",
"Curry powder",
"Coconut milk"
],
steps:[
"Cook onions",
"Add spices",
"Add chicken",
"Simmer with coconut milk"
]
},

fish_curry:{
title:"Fish Curry",
image:"images/fish curry.jpg",
ingredients:[
"Fish",
"Goraka",
"Onion",
"Spices"
],
steps:[
"Prepare curry base",
"Add fish pieces",
"Cook until thick"
]
},

jackfruit:{
title:"Jackfruit Curry (Polos)",
image:"images/jackfruit curry.jpg",
ingredients:[
"Young jackfruit",
"Coconut milk",
"Spices"
],
steps:[
"Cook jackfruit with spices",
"Add coconut milk",
"Simmer"
]
},

kottu:{
title:"Kottu Roti",
image:"images/kottu.jpg",
ingredients:[
"Godamba roti",
"Chicken",
"Egg",
"Vegetables"
],
steps:[
"Chop roti",
"Cook vegetables",
"Add egg and chicken",
"Mix together"
]
},

fried_rice:{
title:"Fried Rice",
image:"images/fried rice.jpg",
ingredients:[
"Rice",
"Vegetables",
"Egg",
"Soya sauce"
],
steps:[
"Heat wok",
"Cook vegetables",
"Add rice",
"Stir fry"
]
},

devilled_chicken:{
title:"Devilled Chicken",
image:"images/devilled chicken.jpg",
ingredients:[
"Chicken",
"Onion",
"Capsicum",
"Chilli sauce"
],
steps:[
"Fry chicken",
"Add vegetables",
"Add sauce",
"Cook until thick"
]
},

egg_roti:{
title:"Egg Roti",
image:"images/egg roti.jpg",
ingredients:[
"Godamba roti",
"Egg",
"Onion",
"Green chilli"
],
steps:[
"Add egg mixture to roti",
"Fold roti",
"Cook on pan"
]
},

noodles:{
title:"Vegetable Noodles",
image:"images/noodles.jpg",
ingredients:[
"Noodles",
"Vegetables",
"Soya sauce",
"Garlic"
],
steps:[
"Boil noodles",
"Cook vegetables",
"Add noodles and sauce"
]
}

};


// =============================
// LOAD RECIPE DETAILS
// =============================

const params=new URLSearchParams(window.location.search);
const recipe=params.get("recipe");

if(recipe && recipes[recipe]){

document.getElementById("recipeTitle").innerText=recipes[recipe].title;
document.getElementById("recipeImage").src=recipes[recipe].image;

let ingredientsHTML="";
recipes[recipe].ingredients.forEach(function(i){
ingredientsHTML+=`<li>${i}</li>`;
});
document.getElementById("recipeIngredients").innerHTML=ingredientsHTML;

let stepsHTML="";
recipes[recipe].steps.forEach(function(s){
stepsHTML+=`<li>${s}</li>`;
});
document.getElementById("recipeSteps").innerHTML=stepsHTML;

}

});
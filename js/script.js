document.addEventListener("DOMContentLoaded", function(){

console.log("JS working");

let recipeForm=document.getElementById("recipeForm");

if(recipeForm){

recipeForm.addEventListener("submit",function(e){

let name=document.getElementById("name").value;

if(name===""){
alert("Recipe name required");
e.preventDefault();
}

});

}

let search=document.querySelector('input[type="search"]');

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

});
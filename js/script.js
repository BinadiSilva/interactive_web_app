document.addEventListener("DOMContentLoaded", function(){

let recipeForm=document.getElementById("recipeForm");

if(recipeForm){
recipeForm.addEventListener("submit",function(e){

let name=document.getElementById("name").value;

if(name===""){
alert("Recipe name is required");
e.preventDefault();
}

});
}

let contactForm=document.getElementById("contactForm");

if(contactForm){
contactForm.addEventListener("submit",function(e){

let email=document.getElementById("email").value;

if(!email.includes("@")){
alert("Enter valid email");
e.preventDefault();
}

});
}

});
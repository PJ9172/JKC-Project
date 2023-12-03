const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
const  addmission = document.getElementById("add")
var c=0;
hamburger.addEventListener("click", () => {
  hamburger.classList.toggle("active");
  navMenu.classList.toggle("active");
  if (c==0) {
    document.getElementById("add").style.marginTop = "500px";
    c=c+1;
  }
  else{
    document.getElementById("add").style.marginTop = "10px";
    c=0
  }
})

document.querySelectorAll(".nav-link").forEach(n => n.addEventListener("click", () => {
  hamburger.classList.remove("active");
  navMenu.classList.remove("active");
  
  console.log("working11111")
}))
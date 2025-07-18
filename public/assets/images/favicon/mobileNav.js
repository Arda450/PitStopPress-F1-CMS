const myButton = document.querySelector(".myButton");
const mobileNav = document.querySelector(".mobile__nav");

myButton.addEventListener("click", () => {
  if (myButton.classList.contains("open")) {
    myButton.classList.remove("open");
  } else {
    myButton.classList.add("open");
  }
});

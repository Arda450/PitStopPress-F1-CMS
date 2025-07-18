const imgContainer = document.querySelector(".slider-img");
const textContainer = document.querySelector("#main-heading");
const btnBack = document.querySelector(".btn-back");
const btnForward = document.querySelector(".btn-forward");
const index = document.querySelector(".index");
const indexTotal = document.querySelector(".index-total");
const playPauseBtn = document.querySelector(".btn-play-pause");
const playPauseIcon = document.getElementById("playpause-icon");

const content = [
  {
    img: "/assets/images/image.slider/title-picture.webp",
    text: "Verstappen holds off charging Hamilton to claim 50th F1 victory at the United States GP",
    alt: "This is an image of Max Verstappen, celebrating on the podium after winning the US GP.",
  },
  {
    img: "/assets/images/image.slider/lando-norris-andrea-stella.webp",
    text: "Norris 'can compete' with the likes of Schumacher and Alonso says McLaren boss Stella",
    alt: "This is an image of Formula 1 driver Lando Norris with this McLaren team boss Andrea Stella.",
  },
  {
    img: "/assets/images/image.slider/mexican-gp.webp",
    text: "IT'S RACE WEEK: 5 storylines we're excited about ahead of the 2023 Mexico City Grand Prix",
    alt: "This is an image of formula 1 cars racing around the Mexican Gran Prix Circuit.",
  },
  {
    img: "/assets/images/image.slider/hamilton-and-leclerc.webp",
    text: "EXPLAINED: Why Hamilton and Leclerc were disqualified from the United States GP",
    alt: "This is an image of Ferrari driver Charles Leclerc and Mercedes driver Lewis Hamilton having a conversation.",
  },
];

let imageIndex = 0;
let isPlaying = false; // Variable to track play/pause state
let intervalId; // Variable to store the interval ID

function updateImage() {
  // assign the textContent of the index to the imageIndex, but starting from 1
  index.textContent = imageIndex + 1;

  // Fade out the current image, when it gets updated: opacity = 0
  imgContainer.classList.add("slide");

  // Set a timeout to change the image and fade it back in
  setTimeout(() => {
    imgContainer.src = content[imageIndex].img;
    imgContainer.alt = content[imageIndex].alt;
    // assigning the text keys in the content array to the #main-heading inside the html
    textContainer.textContent = content[imageIndex].text;
    // Fade in the new image after 300ms
    imgContainer.classList.remove("slide");
  }, 300);
}

// Function to handle the play/pause button click
playPauseBtn.addEventListener("click", playPauseHandler);
// Creating a play/pause function for the play/pause button

function playPauseHandler() {
  if (isPlaying) {
    // If playing, pause
    clearInterval(intervalId);
    isPlaying = false;
    playPauseIcon.classList.remove("fa-pause"); // Assuming you have an icon for pause
    playPauseIcon.classList.add("fa-play"); // Assuming you have an icon for play
  } else {
    // If paused, play
    intervalId = setInterval(() => {
      imageIndex = (imageIndex + 1) % content.length;
      updateImage();
    }, 3000);
    isPlaying = true;
    // It proceeds the slideshow
    playPauseIcon.classList.remove("fa-play"); // "fa-play", which already exists inside the html, gets removed
    playPauseIcon.classList.add("fa-pause"); // then class "fa-pause" gets added to the play-pause-btn
  }
}

document.addEventListener("DOMContentLoaded", () => {
  updateImage();
  indexTotal.textContent = content.length;

  btnBack.addEventListener("click", () => {
    imageIndex = (imageIndex - 1 + content.length) % content.length;
    // e.g. you are on the 3rd img so: imageindex = (2 - 1 + 4) % 4 = 1
    // so it gives you back the imageindex of 1, so the 2nd image :))
    updateImage();
  });

  btnForward.addEventListener("click", () => {
    imageIndex = (imageIndex + 1) % content.length;
    updateImage();
  });
});

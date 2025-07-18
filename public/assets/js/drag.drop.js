document.addEventListener("DOMContentLoaded", function () {
  // JavaScript-Funktion für Drag-and-Drop
  function handleDrop(event) {
    event.preventDefault();
    var file = event.dataTransfer.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById("image-preview").src = e.target.result;
      document.getElementById("image").value = e.target.result; // This line seems to be setting a non-existent element. Ensure there's an element with id="image" or remove this line if unnecessary.
    };
    reader.readAsDataURL(file);
  }

  function handleDragOver(event) {
    event.preventDefault();
  }

  function initDragAndDrop() {
    var dropContainer = document.querySelector(".drag-container");
    dropContainer.addEventListener("dragover", handleDragOver, false);
    dropContainer.addEventListener("drop", handleDrop, false);
    dropContainer.addEventListener("click", function (event) {
      // Prevent the file explorer from opening again
      if (event.target !== dropContainer) return;
      document.getElementById("myFile").click();
    });
    document
      .getElementById("myFile")
      .addEventListener("change", function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById("image-preview").src = e.target.result;
        };
        reader.readAsDataURL(file);
      });
  }

  initDragAndDrop();
});

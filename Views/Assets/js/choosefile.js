  const fileInput = document.getElementById("photo");
  const fileChosen = document.getElementById("file-chosen");

  fileInput.addEventListener("change", function() {
    fileChosen.textContent = this.files[0] ? this.files[0].name : "No file chosen";
  });


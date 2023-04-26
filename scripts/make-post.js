const imagePreview = document.getElementById("image-preview");
const fileInput = document.getElementById("file-input");
const h2El = document.getElementById("h2");

fileInput.addEventListener("change", (event) => {
  const file = event.target.files[0];
  const reader = new FileReader();
  h2El.classList.add("hidden");
  h2El.classList.remove("select-photo");
  reader.onload = (e) => {
    imagePreview.style.backgroundImage = `url(${e.target.result})`;
  };
  reader.readAsDataURL(file);
});

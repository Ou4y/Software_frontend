
  function toggleDropdown() {
    document.querySelector(".custom-multi-select").classList.toggle("open");
  }

  const checkboxes = document.querySelectorAll("#dropdown-options input[type='checkbox']");
  const selectedCategories = document.getElementById("selected-categories");

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const selected = Array.from(checkboxes)
        .filter((i) => i.checked)
        .map((i) => i.value);

      selectedCategories.textContent = selected.length
        ? selected.join(", ")
        : "Select category";
    });
  });
  document.addEventListener("click", function (e) {
    const multiSelect = document.querySelector(".custom-multi-select");
    if (!multiSelect.contains(e.target)) {
      multiSelect.classList.remove("open");
    }
  });


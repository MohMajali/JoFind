$(document).ready(function () {
  $(".category-link").on("click", function (e) {
    e.preventDefault();
    let categoryId = $(this).data("category-id");
    let dropdownMenu = $(this).next(".dropdown-menu");

    dropdownMenu.slideToggle(300);

    if (!dropdownMenu.children().length) {
      $.ajax({
        url: "Get_Sub_Categories.php",
        type: "POST",
        data: { category_id: categoryId },
        success: function (response) {
          let subcategories = JSON.parse(response);
          dropdownMenu.empty(); // Clear any existing subcategories

          // Populate the dropdown with fetched subcategories
          subcategories.forEach(function (subcategory) {
            dropdownMenu.append(
              `<a href="venues.php?sub_category_id=${subcategory.id}" class="dropdown-item">${subcategory.name}</a>`
            );
          });

          if (subcategories.length > 0) {
            dropdownMenu.slideDown(); // Show the dropdown menu with animation
          } else {
            dropdownMenu.empty();
          }
        },
        error: function () {
          alert("Error loading subcategories.");
        },
      });
    }
  });
});

var filteredMenu = document.getElementById('filtered-menu'),
    filterButton = document.getElementById ('filterButton');

function openFilter(){
    filteredMenu.classList.toggle("show");
    filterButton.classList.toggle ("background");
}

// profile page dropdown toggle

var logout_dropdown = document.getElementById('logout_dropdown');
    function opendropdown(){
        logout_dropdown.classList.toggle("show");
    }

    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }








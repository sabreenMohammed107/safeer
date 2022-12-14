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

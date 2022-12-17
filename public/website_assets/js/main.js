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



// ahmed sayed = user loging success so this how to show user profile and logout options
let menuToggle = document.querySelectorAll('.already_loged');
let navigation = document.querySelector('.menu.user_info_options');

menuToggle.forEach((itm)=>{
    itm.addEventListener('click' , function(){
        navigation.classList.toggle('active_user');
    })
})
// change lang
let myMainLang = document.querySelector('.profile_name');
myMainLang.onclick = function () {
    document.querySelectorAll('.profile_name img').forEach((lang) => {

        lang.classList.toggle('main-lang');
    })
}

// fav-heart
function setHeart(myfav){
    myfav.parentElement.parentElement.parentElement.parentElement.parentElement.children[1].classList.toggle('noHeartIsRed');
}


var images = document.getElementsByTagName("img");

for (var i = 0; i < images.length; i++) {
  images[i].onmouseover = function() {
    this.style.cursor = "pointer";
    // this.style.border = " 1px solid #1C4482";
  };
  images[i].onmouseout = function() {
    this.style.cursor = "pointer";
    // this.style.border = " 1px solid #1C4482";
  };
}

function changeImageOnClick(event) {
  // debugger;
  var targetElement = event.srcElement;
  // debugger;
  if (targetElement.tagName === "IMG") {
    mainImage.src = targetElement.getAttribute("src");
  }
}
//  sider for image 
var images = [ "tour-details-1.webp","tour-details-2.webp","tour-details-3.webp" ];
var slider = document.getElementById('mainImage');
var prevoiusButton = document.getElementById('previous');
var nextButton = document.getElementById('next');
var imageIndex = 0;

nextButton.addEventListener('click' , function (){
    imageIndex++;
    link = "./images/tour-details/" + images[imageIndex];
    slider.setAttribute('src' , link);

    if(imageIndex == images.length - 1 ){
        nextButton.setAttribute('disabled','');
        prevoiusButton.removeAttribute('disabled','')
    }
    else{
        prevoiusButton.removeAttribute('disabled','')
    }
})

prevoiusButton.addEventListener('click' , function (){
    imageIndex--;
    link = "./images/tour-details/" + images[imageIndex];
    slider.setAttribute('src' , link);

    if(imageIndex == 0 ){
        prevoiusButton.setAttribute('disabled','');
        nextButton.removeAttribute('disabled','')
    }
    else{
        nextButton.removeAttribute('disabled','')
    }
})
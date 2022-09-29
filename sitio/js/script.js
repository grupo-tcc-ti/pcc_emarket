var x = document.getElementsByClassName("productslider");

function clickDrop() {
  document.getElementById("myDropdown").classList.toggle("showMenuSuspenso");
}

window.onclick = function (event) {
  if (!event.target.matches(".myDropBtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("showMenuSuspenso")) {
        openDropdown.classList.remove("showMenuSuspenso");
      }
    }
  }
};

var imageSlider = [
  "../image/slider/1.jpg",
  "../image/slider/2.png",
  "../image/slider/3.jpg",
];
var num = 0;
function next() {
  var slider = document.getElementById("slider");
  num++;
  if (num >= imageSlider.length) {
    num = 0;
  }
  slider.src = imageSlider[num];
}
function prev() {
  var slider = document.getElementById("slider");
  num--;
  if (num < 0) {
    num = imageSlider.length - 1;
  }
  slider.src = imageSlider[num];
}

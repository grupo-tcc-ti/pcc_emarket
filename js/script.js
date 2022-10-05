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

function clickDrop1() {
  document.getElementById("myDropdownPerfil").classList.toggle("showMenuSuspensoPerfil");
}

window.onclick = function (event) {
  if (!event.target.matches(".link-conta")) {
    var dropdowns = document.getElementsByClassName("dropdown-content-perfil");
    for (let i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("showMenuSuspensoPerfil")) {
        openDropdown.classList.remove("showMenuSuspensoPerfil");
      }
    }
  }
};

var imageSlider = [
  "../pcc_emarket/image/slider/1.jpg",
  "../pcc_emarket/image/slider/2.png",
  "../pcc_emarket/image/slider/3.jpg",
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

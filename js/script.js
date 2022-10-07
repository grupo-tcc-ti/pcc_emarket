function clickDrop(idname = "") {
  document.getElementById(idname).classList.toggle('active');
  if (document.querySelector('.dropdown-content').id != idname) {
    var dropdowns = document.querySelectorAll(`nav:not(#${idname})`);
    dropdowns.forEach((openDropdown) => {
      if (openDropdown.classList.contains("active")) {
        openDropdown.classList.remove("active");
      }
    });
  }
};

window.onclick = function (event) {
  if (!event.target.matches(".btn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("active")) {
        openDropdown.classList.remove("active");
      }
    }
  }
};


let navdropdown = document.querySelectorAll('.header .dropdown . dropdown-content');
window.onscroll = () =>{
  navdropdown.classList.remove('active');
}




















/* ######################Funçao do departamento na barra: starts###################### */
function changeIconDepartamento(anchor) {
  anchor.closest('.dropdown').classList.toggle('active');

  // var icon = anchor.querySelector("i");
  // icon.classList.toggle('fa-solid fa-chevron-down');
  // icon.classList.toggle('fa-solid fa-xmark');
  //  anchor.querySelector("span").textContent = icon.classList.contains('fa-solid fa-chevron-down') ? "Departamento" : "Departamento";
};
/* ######################Funçao do departamento na barra: ends###################### */

/* ######################Functions for banner: starts ######################*/
const slider = document.querySelector(".slider"); //var slider dos banner
const nextBtn = document.querySelector(".next-btn"); //var botao proximo
const prevBtn = document.querySelector(".prev-btn"); //var botao anterior
const slides = document.querySelectorAll(".slide"); //var cada imagem
const slideIcons = document.querySelectorAll(".slide-icon"); //var icone dos botoes
const numberOfSlides = slides.length;
var slideNumber = 0;

//next button
nextBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove('active');
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove('active');
  });

  slideNumber++;

  if(slideNumber > (numberOfSlides - 1)){
    slideNumber = 0;
  }

  slides[slideNumber].classList.add('active');
  slideIcons[slideNumber].classList.add('active');
});

//previous button
prevBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove('active');
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove('active');
  });

  slideNumber--;

  if(slideNumber < 0){
    slideNumber = numberOfSlides - 1;
  }

  slides[slideNumber].classList.add('active');
  slideIcons[slideNumber].classList.add('active');
});

//autoplay
var playSlider;
var autoPlayTransicao = () => {
  playSlider = setInterval(function(){
    slides.forEach((slide) => {
      slide.classList.remove('active');
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove('active');
    });

    slideNumber++;

    if(slideNumber > (numberOfSlides - 1)){
      slideNumber = 0;
    }

    slides[slideNumber].classList.add('active');
    slideIcons[slideNumber].classList.add('active');
  }, 8000); //8 segundos == 8000 ms
}
autoPlayTransicao();

//mouse em cima do banner, para o autoplay
slider.addEventListener("mouseover", () => {
  clearInterval(playSlider);
});

//mouse fora do banner, volta o autoplay
slider.addEventListener("mouseout", () => {
  autoPlayTransicao();
});
/* ######################Functions for banner ends ######################*/
  
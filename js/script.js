function clickDrop(idname = "") {
  // "depart"
  document.getElementById(idname).classList.toggle("showMenuSuspenso");
};

// window.onclick = function (event) {
//   if (!event.target.matches(".link-depart")) {
//     var dropdowns = document.getElementsByClassName("dropdown-content");
//     for (let i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains("showMenuSuspenso")) {
//         openDropdown.classList.remove("showMenuSuspenso");
//       }
//     }
//   }
// };

var x = document.getElementsByClassName("productslider");
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

/* Funçao do departamento na barra: */
function changeIconDepartamento(anchor) {
  anchor.closest('.dropdown').classList.toggle('active');

  // var icon = anchor.querySelector("i");
  // icon.classList.toggle('fa-solid fa-chevron-down');
  // icon.classList.toggle('fa-solid fa-xmark');
  //  anchor.querySelector("span").textContent = icon.classList.contains('fa-solid fa-chevron-down') ? "Departamento" : "Departamento";
}

/* Functions para o banner: */
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
    slide.classList.remove("active");
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove("active");
  });

  slideNumber++;

  if(slideNumber > (numberOfSlides - 1)){
    slideNumber = 0;
  }

  slides[slideNumber].classList.add("active");
  slideIcons[slideNumber].classList.add("active");
});

//previous button
prevBtn.addEventListener("click", () => {
  slides.forEach((slide) => {
    slide.classList.remove("active");
  });
  slideIcons.forEach((slideIcon) => {
    slideIcon.classList.remove("active");
  });

  slideNumber--;

  if(slideNumber < 0){
    slideNumber = numberOfSlides - 1;
  }

  slides[slideNumber].classList.add("active");
  slideIcons[slideNumber].classList.add("active");
});

//autoplay
var playSlider;
var autoPlayTransicao = () => {
  playSlider = setInterval(function(){
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove("active");
    });

    slideNumber++;

    if(slideNumber > (numberOfSlides - 1)){
      slideNumber = 0;
    }

    slides[slideNumber].classList.add("active");
    slideIcons[slideNumber].classList.add("active");
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
  
const qryS = (selector) =>
  document.querySelector(selector) || {
    classList: {
      toggle: () => void 0,
    },
    classList: {
      remove: () => void 0,
    },
  };
const qrySA = (selector) =>
  document.querySelectorAll(selector) || {
    classList: {
      toggle: () => void 0,
    },
    classList: {
      remove: () => void 0,
    },
  };

window.onclick = function (event) {
  if (!event.target.matches('.isearch')) {
    if (!event.target.matches('.btn')) {

      let dropdowns = qrySA('.dropdown-content');
      dropdowns.forEach((openDropdown) => {
        if (openDropdown.classList.contains('active')) {
          openDropdown.classList.remove('active');
        }
      });
      let dropsearch = qryS('.nav-search');
      if (dropsearch.classList.contains('active')) {
        dropsearch.classList.remove('active');
      }
    }
  }

  // Toggle dark-mode function
  if (event.target.matches('#darkmode')) {
  mode = window?.matchMedia('(prefers-color-scheme: dark)');
  html = document.documentElement;
  if (html.classList.contains('light')) {
    // console.log('dont succumb to darkness...');
    html.classList.remove('light');
    html.classList.add('dark');
  } else if (html.classList.contains('dark')) {
    // console.log('let there be light!');
    html.classList.remove('dark');
    html.classList.add('light');
  } else {
    if (mode.matches) {
      html.classList.add('light');
    } else {
      html.classList.add('dark');
    }
  }
  }
};

var mode = window?.matchMedia('(prefers-color-scheme: dark)');
mode.addEventListener('change', () => {
  var html = document.documentElement;
  html.classList.remove('light');
  html.classList.remove('dark');
})

window.onscroll = () => {
  let dropdowns = qrySA('.dropdown-content');
  dropdowns.forEach((openDropdown) => {
    if (openDropdown.classList.contains('active')) {
      openDropdown.classList.remove('active');
    }
  });
  let dropdown = qryS('.nav-search');
  if (dropdown.classList.contains('active')) {
    dropdown.classList.remove('active');
  }
};

//Remove search-bar on resize
// var viewport_width = window.innerWidth;
// console.log(viewport_width);
window.addEventListener('resize', () => {
  let searchbar = qryS('.nav-search');
  if (window.innerWidth > 1042) {
    if (searchbar.classList.contains('active')){
      searchbar.classList.remove('active');
    }
  }
});

function clickDrop(idname = '') {
  qryS(`#${idname}`).classList.toggle('active');
  if (qryS('.dropdown-content').id != `#${idname}`) {
    // let dropdowns = qrySA(`nav:not(#${idname}).dropdown-content`);
    let dropdowns = qrySA(`nav:not(#${idname})`);
    dropdowns.forEach((openDropdown) => {
      if (openDropdown.classList.contains('active')) {
        openDropdown.classList.remove('active');
      }
    });
  }
}
/* ######################Funçao do departamento na barra: starts###################### */
function changeIconDepartamento(anchor) {
  anchor.closest('.dropdown').classList.toggle('active');

  // var icon = anchor.querySelector("i");
  // icon.classList.toggle('fa-solid fa-chevron-down');
  // icon.classList.toggle('fa-solid fa-xmark');
  //  anchor.querySelector("span").textContent = icon.classList.contains('fa-solid fa-chevron-down') ? "Departamento" : "Departamento";
}
/* ######################Funçao do departamento na barra: ends###################### */

/* ######################Functions for banner: starts ######################*/
const slider = qryS('.slider'); //var slider dos banner
const nextBtn = qryS('.next-btn'); //var botao proximo
const prevBtn = qryS('.prev-btn'); //var botao anterior
const slides = qrySA('.slide'); //var cada imagem
const slideIcons = qrySA('.slide-icon'); //var icone dos botoes
const numberOfSlides = slides.length;
var slideNumber = 0;

//next button
if ('className' in nextBtn) {
  // console.log(nextBtn); //debug
  // console.log(typeof nextBtn); //debug
  // console.log(nextBtn.length); //debug
  nextBtn.addEventListener('click', () => {
    slides.forEach((slide) => {
      slide.classList.remove('active');
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove('active');
    });

    slideNumber++;

    if (slideNumber > numberOfSlides - 1) {
      slideNumber = 0;
    }

    slides[slideNumber].classList.add('active');
    slideIcons[slideNumber].classList.add('active');
  });
}

//previous button
if ('className' in nextBtn) {
  // console.log(prevBtn); //debug
  prevBtn.addEventListener('click', () => {
    slides.forEach((slide) => {
      slide.classList.remove('active');
    });
    slideIcons.forEach((slideIcon) => {
      slideIcon.classList.remove('active');
    });

    slideNumber--;

    if (slideNumber < 0) {
      slideNumber = numberOfSlides - 1;
    }

    slides[slideNumber].classList.add('active');
    slideIcons[slideNumber].classList.add('active');
  });
}

//autoplay
var playSlider;
var autoPlayTransicao = () => {
  playSlider = setInterval(function () {
    if ('className' in slides) {
      slides.forEach((slide) => {
        slide.classList.remove('active');
      });
      slideIcons.forEach((slideIcon) => {
        slideIcon.classList.remove('active');
      });

      slideNumber++;

      if (slideNumber > numberOfSlides - 1) {
        slideNumber = 0;
      }

      slides[slideNumber].classList.add('active');
      slideIcons[slideNumber].classList.add('active');
    }
  }, 8000); //8 segundos == 8000 ms
};
autoPlayTransicao();

if ('className' in nextBtn) {
  //mouse em cima do banner, para o autoplay
  slider.addEventListener('mouseover', () => {
    clearInterval(playSlider);
  });
  //mouse fora do banner, volta o autoplay
  slider.addEventListener('mouseout', () => {
    autoPlayTransicao();
  });
}

/* ######################Functions for banner ends ######################*/

/* ###################### Login-Register script starts ######################*/
const container = qryS('.login-register .container'),
  togglePwd = qrySA('.togglePwd'),
  loginPwd = qrySA('.password'),
  signup = qryS('.signup-link'),
  login = qryS('.login-link');

togglePwd.forEach((eyeIcon) => {
  eyeIcon.addEventListener('click', () => {
    loginPwd.forEach((pwd) => {
      if (pwd.type === 'password') {
        pwd.type = 'text';
        togglePwd.forEach((icon) => {
          icon.classList.replace('fa-eye-slash', 'fa-eye');
        });
      } else {
        pwd.type = 'password';
        togglePwd.forEach((icon) => {
          icon.classList.replace('fa-eye', 'fa-eye-slash');
        });
      }
    });
  });
});

if ('className' in signup) {
  signup.addEventListener('click', () => {
    container.classList.add('active');
    //   console.log('signup'); //debug
  });
}
if ('className' in login) {
  login.addEventListener('click', () => {
    container.classList.remove('active');
    //   console.log('login'); //debug
  });
}

var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
if (document.URL.includes('?register')) {
  // window.location = "http://google.com";
  // console.log('signup'); //debug
  container.classList.add('active');
}
/* ###################### Login-Register script ends ######################*/


// Close message baloon
function closeMessage(msg) {
  msg.parentElement.classList.add('close');
  setTimeout(function () {
    return msg.parentElement.remove();
  }, 1000);
}

function peekProd() {
  var quickview = qryS('.quickview');
  quickview.classList.toggle('active');
}



// console.log(window.getComputedStyle(document.documentElement).getPropertyValue('--background-color'));
// console.log(window.getComputedStyle(document.documentElement).getPropertyValue('--font-color'));
// console.log(window.matchMedia("(prefers-color-scheme: dark)"));

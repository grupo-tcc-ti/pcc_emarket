// Funções query como objetos para evitar erros em páginas
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
  // esconde tags 'nav' caso o clique ocorra em qualquer lugar da tela
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

  // Aciona função 'Toggle dark-mode'
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
// detecta mudança do esquema de cores e remove as classes light e dark do html
var mode = window?.matchMedia('(prefers-color-scheme: dark)');
mode.addEventListener('change', () => {
  var html = document.documentElement;
  html.classList.remove('light');
  html.classList.remove('dark');
});

window.onscroll = () => {
  let dropdowns = qrySA('.dropdown-content');
  dropdowns.forEach((openDropdown) => {
    if (openDropdown.classList.contains('active')) {
      openDropdown.classList.remove('active');
    }
  });
  // remove a barra de pesquisa modo mobile on scroll
  let dropdown = qryS('.nav-search');
  if (dropdown.classList.contains('active')) {
    dropdown.classList.remove('active');
  }
  // header permanece visivel ao rolar a pagina
  const headerflex = qryS('#header .container');
  if (window.scrollY > 0) {
    // console.log(window.scrollY); //debug
    headerflex.style.setProperty('position', 'fixed');
  } else {
    headerflex.style.removeProperty('position');
  }

  const totop = qryS('.totop');
  if (window.scrollY > 220) {
    totop.classList.add('scrollup');
  } else {
    totop.classList.remove('scrollup');
  }
};

// console.log(window.innerWidth); //debug
//Remove search-bar on resize
window.addEventListener('resize', () => {
  let searchbar = qryS('.nav-search');
  if (window.innerWidth > 1042) {
    if (searchbar.classList.contains('active')) {
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
const loginRegister = qryS('.login-register .container'),
  btnSwitch = qrySA('.toggleBtn'),
  loginPwd = qrySA('.input-field.pwd'),
  signup = qryS('.signup-link'),
  login = qryS('.login-link');


btnSwitch.forEach((toggleBtn) => {
  toggleBtn.addEventListener('click', () => {
    loginPwd.forEach((pwd) => {
      console.log(loginPwd);
      if (pwd.type === 'password') {
        pwd.type = 'text';
        btnSwitch.forEach((toggleBtn) => {
          for (const icontoggle of toggleBtn.children) {
            icontoggle.classList.replace('fa-eye-slash', 'fa-eye');
          }
        });
      } else {
        pwd.type = 'password';
        btnSwitch.forEach((toggleBtn) => {
          for (const icontoggle of toggleBtn.children) {
            icontoggle.classList.replace('fa-eye', 'fa-eye-slash');
          }
        });
      }
    });
  });
});

if ('className' in signup) {
  signup.addEventListener('click', () => {
    loginRegister.classList.add('active');
    //   console.log('signup'); //debug
  });
}
if ('className' in login) {
  login.addEventListener('click', () => {
    loginRegister.classList.remove('active');
    //   console.log('login'); //debug
  });
}
/* ###################### Login-Register script page ######################*/

// aciona a parte de registro na página conta.php
var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
if (document.URL.includes('?register')) {
  // window.location = "http://google.com";
  // console.log('signup'); //debug
  loginRegister.classList.add('active');
}
/* ###################### Login-Register script ends ######################*/

// Close message baloon
function closeMessage(msg) {
  msg.parentElement.classList.add('close');
  setTimeout(function () {
    return msg.parentElement.remove();
  }, 1000);
}

// acionamento da janela quickvew
function peekProd(el) {
  const parent = el.parentElement;
  if (parent.classList.contains('active')) {
    parent.classList.toggle('active');
  }
  // 'get' quickview por iteração
  for (const child of parent.children) {
    if (child.classList.contains('quickview')) {
      child.classList.toggle('active');
    }
  }
  // Array.prototype.forEach.call(parent.children, (child) => {
  // console.log(child.classList.contains('quickview'));
  // });
}

// funcionamento de seleção de imagens da quickview
let closeBtn = qryS('#peek-prod');
let mainImage = qryS('.prod-img img');
let subImages = qrySA('.img-swip img');
subImages.forEach((image) => {
  image.onclick = () => {
    let src = image.getAttribute('src');
    mainImage.src = src;
  };
});



// console.log(window.getComputedStyle(document.documentElement).getPropertyValue('--background-color'));
// console.log(window.getComputedStyle(document.documentElement).getPropertyValue('--font-color'));
// console.log(window.matchMedia("(prefers-color-scheme: dark)"));

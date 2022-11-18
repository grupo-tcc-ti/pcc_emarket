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

let navbar = qryS('.header .flex .navbar');
let profile = qryS('.header .flex .profile');

qryS('#menu-btn').onclick = () => {
  navbar.classList.toggle('active');
  profile.classList.remove('active');
};

qryS('#user-btn').onclick = () => {
  profile.classList.toggle('active');
  navbar.classList.remove('active');
};

window.onscroll = () => {
  navbar.classList.remove('active');
  profile.classList.remove('active');
};

window.onclick = function (event) {
  // if (!event.target.matches("#user-btn")) {
  if (
    !event.target.matches('#menu-btn') &&
    !event.target.matches('#user-btn')
  ) {
    navbar.classList.remove('active');
    profile.classList.remove('active');
  }
};

let mainImage = qryS('.alterar-produto .image-container .main-image img');
let subImages = qrySA('.alterar-produto .image-container .sub-image img');

subImages.forEach((image) => {
  image.onclick = () => {
    let src = image.getAttribute('src');
    mainImage.src = src;
  };
});

// Close message baloon
function closeMessage(msg) {
  msg.parentElement.classList.add('close');
  setTimeout(function () {
    msg.parentElement.remove();
  }, 1000);
  console.log('hello!');
}

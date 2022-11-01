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

// const container = document.querySelector('.container'),
const container = qryS('.container'),
  // togglePwd = document.querySelectorAll('.togglePwd'),
  togglePwd = qrySA('.togglePwd'),
  // loginPwd = document.querySelectorAll('.password'),
  loginPwd = qrySA('.password'),
  // signup = document.querySelector('.signup-link'),
  signup = qryS('.signup-link'),
  // login = document.querySelector('.login-link');
  login = qryS('.login-link');

togglePwd.forEach((eyeIcon) => {
  eyeIcon.addEventListener('click', () => {
    // inputToggle(loginPwd, eyeIcon);
    // inputToggle(registerPwd, eyeIcon);
    // inputToggle(cRegisterPwd, eyeIcon);
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

signup.addEventListener('click', () => {
  container.classList.add('active');
//   console.log('signup'); //debug
});
login.addEventListener('click', () => {
  container.classList.remove('active');
//   console.log('login'); //debug
});

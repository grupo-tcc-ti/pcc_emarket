let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   profile.classList.remove('active');
}

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});

// function clearForm(form) {
//    // create data object with all form values
//    var data = {
//       "name": form.name.value ,
//       "image": form.image.files
//    };

//   // convert in JSON
//    var jsonData = JSON.stringify(data);

//   // save in cookies
//    document.cookie = "my_form=" + jsonData;

//   // redirect to form's action
//    window.location.href = form.getAttribute("action");

//   // prevent form from submitting
//    return false;
// };
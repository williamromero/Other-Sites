var indexlink = document.querySelector('.nav-main-logo');
indexlink.addEventListener("click", function () {
  location.assign("index.html");
});

var responsiveopen = document.querySelector('.responsive-icon');
responsiveopen.addEventListener("click", function () {

  var responsivelem = document.querySelector('.responsive-menu');
  responsivelem.classList.toggle("responsive-menu-activated");
  var responsivelist = document.querySelector('.responsive-menu-nav');
  responsivelist.classList.toggle("responsive-menu-nav-activated");

});

var serviceslink = document.querySelector('.services-link-box');
serviceslink.addEventListener("click", function (){
  location.assign("servicios.html");
});

var serviceslinktwo = document.querySelector('.services-link-box-two');
serviceslinktwo.addEventListener("click", function (){
  location.assign("servicios.html");
});

var entrepreneurslink = document.querySelector('.entrepreneurs-link-box');
entrepreneurslink.addEventListener("click", function () {
  location.assign("emprendedores.html");
});

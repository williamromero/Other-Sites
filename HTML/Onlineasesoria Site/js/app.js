window.addEventListener('load', function () {

  var fbfield = document.querySelector('.fb-field-box');
  var lnfield = document.querySelector('.ln-field-box');
  var faqfield = document.querySelector('.faq-field-box');
  var ctcfield = document.querySelector('.ctc-field-box');

  var responsivebutton = document.querySelector('.responsive-icon');
  responsivebutton.addEventListener('click', activateMenu);

  function activateMenu () {
    var menuList = document.querySelector('.navbar-responsive');
    menuList.classList.toggle('navbar-responsive-activated');
  }

  fbfield.addEventListener('click', function (){
    location.assign("https://www.facebook.com/onlineasesoria");
  });

  lnfield.addEventListener('click', function (){
    location.assign("https://www.linkedin.com/company/2372204");
  });

  faqfield.addEventListener('click', function (){
    location.assign("preguntas.html");
  });

  ctcfield.addEventListener('click', function () {
    location.assign("contacto.html");
  });

});


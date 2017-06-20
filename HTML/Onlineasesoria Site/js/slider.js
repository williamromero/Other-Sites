// APP.JS FILE TO UPLOAD INTERACTIONS
window.addEventListener('load', sliderOn, false );

var img_elem = document.querySelector('.frontpage-slider-box-imgs-elem');
var index = 0;
var img_array = [ "imgs/office-group-one.jpg", 
                  "imgs/office-group-two.jpg", 
                  "imgs/office-group-three.jpg",
                  "imgs/charts.jpg" 
                ];

var banner_txt = document.querySelector('.frontpage-slider-txt-parragraph');
var banner_ttl = document.querySelector('.frontpage-slider-txt-box-ribbon-label');

var responsivebutton = document.querySelector('.responsive-icon');
responsivebutton.addEventListener('click', activateMenu);

function activateMenu () {
  var menuList = document.querySelector('.navbar-responsive');
  menuList.classList.toggle('navbar-responsive-activated');
}

function sliderOn () {
  setInterval( 
    function changeImage() {
      img_elem.src = img_array[index];
      index++;
      switch (index) {
        case 0: 
          banner_ttl.innerHTML = 'AL ALCANCE DE TUS MANOS';
          banner_txt.innerHTML = 'UN SERVICIO DE ASESORÍA CONTABLE FISCAL Y LABORAL DE CALIDAD POR UN PRECIO INCREIBLE';
        break;
        case 1: 
          banner_ttl.innerHTML = 'PARA LOS EMPRENDEDORES';
          banner_txt.innerHTML = 'TE ACOMPAÑAMOS EN LA CREACIÓN DE TU EMPRESA, NO INCURRAS EN COSTES INNECESARIOS'; 
        break;
        case 2: 
          banner_ttl.innerHTML = 'ASESORÍA Y GESTIÓN CONTABLE - FISCAL';
          banner_txt.innerHTML = 'EXPERTOS CONTABLES Y FISCALISTAS TE AYUDARÁN A CUMPLIR CON TODAS TUS OBLIGACIONES, ASI COMO OPTIMIZAR LOS RECURSOS DE TU EMPRESA';
        break;
        case 3: 
          banner_ttl.innerHTML = 'ASESORÍA Y GESTIÓN LABORAL';
          banner_txt.innerHTML = 'TE AYUDAMOS EN LA ADMINISTRACIÓN Y CONTRO EFECTO DE LOS RECURSOS HUMANOS DE TU EMPRESA, CONFORME CON LA LEGISLACIÓN VIGENTE'; 
        break;
        case 4: 
          banner_ttl.innerHTML = 'AL ALCANCE DE TUS MANOS';
          banner_txt.innerHTML = 'UN SERVICIO DE ASESORÍA CONTABLE FISCAL Y LABORAL DE CALIDAD POR UN PRECIO INCREIBLE';
        break;
        default: console.log('Finished Cicle');    
      }
      img_elem.classList.remove('fsbie-opacity-zero');      
      if (index >= img_array.length ) {
        index = 0;
      } 
      setTimeout(
        function changeOpacity() {
          img_elem.classList.add('fsbie-opacity-zero');
      }, 4500);
    }, 5000);

}


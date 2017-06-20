window.addEventListener('load', function () {

  var services_one = document.querySelector('.services-input-one');
  var services_two = document.querySelector('.services-input-two');
  var services_three = document.querySelector('.services-input-three');
  var services_container_one = document.querySelector('.services-container-one');
  var services_container_two = document.querySelector('.services-container-two');
  var services_container_three = document.querySelector('.services-container-three');

  services_container_one.classList.add('services-container-one-activated');

  services_one.addEventListener("change", inputOne);
  function inputOne () {
    services_container_one.classList.add('services-container-one-activated');
    services_container_two.classList.remove('services-container-two-activated');
    services_container_three.classList.remove('services-container-three-activated');
  }

  services_two.addEventListener("change", inputTwo);
  function inputTwo () {
    services_container_one.classList.remove('services-container-one-activated');
    services_container_two.classList.add('services-container-two-activated');
    services_container_three.classList.remove('services-container-three-activated');
  }

  services_three.addEventListener("change", inputThree);
  function inputThree () {
    services_container_one.classList.remove('services-container-one-activated');
    services_container_two.classList.remove('services-container-two-activated');
    services_container_three.classList.add('services-container-three-activated');  
  }

});
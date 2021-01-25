const swiper = new Swiper('.swiper-container', {
  // Optional parameters
  loop: true,
  effect: 'fade',
  speed: 1000,

  autoplay: {
    delay: 2500
  },
  
})

const headerElement = document.getElementById('main-logo');

document.addEventListener('scroll', function(){
  const scrollY = window.pageYOffset;

  if (scrollY > 0) {
    headerElement.classList.add('active');
  } else {
    headerElement.classList.remove('active');
  }
});

document.addEventListener('DOMContentLoaded', function(){
  const open = document.getElementById('open');
  const overlay = document.querySelector('.overlay');
  const close = document.getElementById('close');

  open.addEventListener('click', () => {
    overlay.classList.add('show');
    open.classList.add('hide');
  });

  close.addEventListener('click', () => {
    overlay.classList.remove('show');
    open.classList.remove('hide');
  });
});


const showElements = document.querySelectorAll(".merit");
window.addEventListener("scroll", function() {
  for (let i =0; i < showElements.length; i++) {
    const getElementDistance = showElements[i].getBoundingClientRect().top + showElements[i].clientHeight*.5;
    if(window.innerHeight > getElementDistance){
      showElements[i].classList.add("show");
    }
  }
})

const displayElements = document.querySelectorAll(".feature-box");
window.addEventListener("scroll", function() {
  for (let i =0; i < displayElements.length; i++) {
    const getElementDistance = displayElements[i].getBoundingClientRect().top + displayElements[i].clientHeight*.7;
    if(window.innerHeight > getElementDistance){
      displayElements[i].classList.add("show");
    }
  }
})

const targetElements = document.querySelectorAll(".Course-box");
window.addEventListener("scroll", function() {
  for (let i =0; i < targetElements.length; i++) {
    const getElementDistance = targetElements[i].getBoundingClientRect().top + targetElements[i].clientHeight*.3;
    if(window.innerHeight > getElementDistance){
      targetElements[i].classList.add("show");
    }
  }
})






